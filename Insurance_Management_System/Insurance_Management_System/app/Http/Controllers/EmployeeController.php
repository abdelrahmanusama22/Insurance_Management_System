<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\InsuranceOffice;

use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeEditRequest;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('insuranceOffice')->paginate(100);
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $offices = InsuranceOffice::all();
    return view('employee.create', compact('offices'));    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
{
    // التحقق من المدخلات تم بواسطة EmployeeRequest
    $cleaned = $request->validated();  // الحصول على المدخلات الموثوقة

    // رفع الملفات وتخزين المسارات
    if ($request->hasFile('form_1')) {
        $cleaned['form_1'] = $request->file('form_1')->store('uploads/forms', 'public');
    }
    if ($request->hasFile('form_6')) {
        $cleaned['form_6'] = $request->file('form_6')->store('uploads/forms', 'public');
    }
    if ($request->hasFile('other_document')) {
        $cleaned['other_document'] = $request->file('other_document')->store('uploads/forms', 'public');
    }
    if ($request->hasFile('license_image_front')) {
        $cleaned['license_image_front'] = $request->file('license_image_front')->store('uploads/licenses', 'public');
    }
    if ($request->hasFile('license_image_back')) {
        $cleaned['license_image_back'] = $request->file('license_image_back')->store('uploads/licenses', 'public');
    }

    // إنشاء الموظف وتخزين البيانات
    Employee::create($cleaned);

    // إعادة التوجيه مع رسالة نجاح
    return redirect()->route('employees.index')->with('success', 'تم إضافة الموظف بنجاح');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // استرجاع الموظف باستخدام المعرف
        $employee = Employee::findOrFail($id);
$offices = InsuranceOffice::all();
       
        return view('employee.show', compact('employee', 'offices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $offices = InsuranceOffice::all();
    $employee = Employee::findOrFail($id);
    return view('employee.edit', compact('employee', 'offices'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeEditRequest $request, Employee $employee)
{
    // التحقق من المدخلات
    $cleaned = $request->validated();

    // رفع الملفات الجديدة مع حذف القديمة إن وجدت
    if ($request->hasFile('form_1')) {
        // حذف القديم لو موجود
        if ($employee->form_1) {
            Storage::disk('public')->delete($employee->form_1);
        }
        $cleaned['form_1'] = $request->file('form_1')->store('uploads/forms', 'public');
    }

    if ($request->hasFile('form_6')) {
        if ($employee->form_6) {
            Storage::disk('public')->delete($employee->form_6);
        }
        $cleaned['form_6'] = $request->file('form_6')->store('uploads/forms', 'public');
    }

    if ($request->hasFile('other_document')) {
        if ($employee->other_document) {
            Storage::disk('public')->delete($employee->other_document);
        }
        $cleaned['other_document'] = $request->file('other_document')->store('uploads/forms', 'public');
    }

    if ($request->hasFile('license_image_front')) {
        if ($employee->license_image_front) {
            Storage::disk('public')->delete($employee->license_image_front);
        }
        $cleaned['license_image_front'] = $request->file('license_image_front')->store('uploads/licenses', 'public');
    }

    if ($request->hasFile('license_image_back')) {
        if ($employee->license_image_back) {
            Storage::disk('public')->delete($employee->license_image_back);
        }
        $cleaned['license_image_back'] = $request->file('license_image_back')->store('uploads/licenses', 'public');
    }

    // تحديث الموظف
    $employee->update($cleaned);

    // إعادة التوجيه برسالة نجاح
    return redirect()->route('employees.index')->with('success', 'تم تحديث بيانات الموظف بنجاح');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'تم حذف الموظف بنجاح');
    }


    public function search(Request $request)
{
    $query = $request->input('query');
    $employees = Employee::where('name', 'LIKE', "%{$query}%")
        ->orWhere('sap_number', 'LIKE', "%{$query}%")
        ->orWhere('national_id', 'LIKE', "%{$query}%")
        ->paginate(100);

    return view('employee.index', compact('employees'));

}
}