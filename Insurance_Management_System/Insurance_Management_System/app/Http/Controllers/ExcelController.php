<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;
use App\Exports\CarsExport;
use App\Imports\CarsImport;
use App\Exports\Employees_insurance_Export;
use Illuminate\Support\Facades\Log;
use App\Models\Car;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function export(Request $request)
    {
           $company = $request->input('registered_company');
    return Excel::download(new EmployeesExport($company), 'employees.xlsx');
    }

    public function import(Request $request)
    {
         $request->validate([
        'file' => 'required|file|mimes:xlsx,xls',
    ]);

    try {
        $import = new EmployeesImport();
        Excel::import($import, $request->file('file'));

        return redirect()->back()->with('success', 'تم استيراد البيانات بنجاح.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()->withErrors($e->errors());
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'حدث خطأ أثناء الاستيراد: ' . $e->getMessage());
    }
    }
    public function exportcar(Request $request)
    {
        // أخذ نوع السيارة من الاختيار
        $vehicleCategory = $request->vehicle_category;

        // التحقق إذا كان تم تحديد نوع السيارة
        if (empty($vehicleCategory)) {
            return back()->with('error', 'من فضلك اختر نوع السيارة');
        }

        // تصدير البيانات بناءً على نوع السيارة
        return Excel::download(new CarsExport($vehicleCategory), 'cars_' . $vehicleCategory . '.xlsx');
    }
    
    public function exportemployee(Request $request)
    {
        // أخذ نوع السيارة من الاختيار
        $insurance_office_id = $request->input('insurance_office_id', 'الكل');
    return Excel::download(new Employees_insurance_Export($insurance_office_id), 'employees_insurance.xlsx');
    }
   public function importcar(Request $request)
{
    try {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ], [
            'file.required' => 'يرجى رفع ملف للاستيراد.',
            'file.mimes' => 'الملف يجب أن يكون بصيغة xlsx، xls، أو csv.',
            'file.max' => 'حجم الملف يجب ألا يتجاوز 2 ميجابايت.',
        ]);

        if (!class_exists(\App\Imports\CarsImport::class)) {
            Log::error('Class App\Imports\CarsImport does not exist.');
            return redirect()->back()->with('error', 'خطأ في النظام: كلاس الاستيراد غير موجود. يرجى التواصل مع المبرمج.');
        }

        $file = $request->file('file');
        if ($file->getSize() === 0) {
            Log::error('Uploaded file is empty.');
            return redirect()->back()->with('error', 'الملف المرفوع فاضي. يرجى رفع ملف يحتوي على بيانات.');
        }

        $import = new CarsImport();
        Excel::import($import, $file);

        if ($import->getErrors()) {
            Log::error('Import failed with validation errors:', $import->getErrors());
            return redirect()->back()->with('error', 'فشل الاستيراد: ' . implode(' | ', $import->getErrors()))->withInput();
        }

        return redirect()->back()->with('success', 'تم استيراد بيانات السيارات بنجاح!');

    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        $failures = $e->failures();
        $errorMessages = [];
        foreach ($failures as $failure) {
            $row = $failure->row();
            $errors = implode(', ', $failure->errors());
            $errorMessages[] = "الصف {$row}: {$errors}";
        }
        Log::error('Validation errors during import:', ['errors' => $errorMessages]);
        return redirect()->back()->with('error', 'فشل الاستيراد بسبب أخطاء في البيانات: ' . implode(' | ', $errorMessages))->withInput();

    } catch (\Maatwebsite\Excel\Exceptions\NoTypeDetectedException $e) {
        Log::error('No file type detected for uploaded file.', ['exception' => $e->getMessage()]);
        return redirect()->back()->with('error', 'خطأ في الملف: لا يمكن التعرف على نوع الملف. تأكدي من أن الملف بصيغة xlsx، xls، أو csv صالح.')->withInput();

    } catch (\Exception $e) {
        Log::error('Unexpected error during import:', ['exception' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        return redirect()->back()->with('error', 'حدث خطأ غير متوقع أثناء الاستيراد: ' . $e->getMessage() . '. يرجى التحقق من الملف أو التواصل مع المبرمج.')->withInput();
    }
}
}
