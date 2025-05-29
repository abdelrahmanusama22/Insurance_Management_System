<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\InsuranceOffice;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class EmployeesImport implements ToCollection, WithHeadings
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $row) {
            // تخطي الصف الأول إذا كان العنوان
            if ($row[0] === 'رقم الساب') {
                continue;
            }

            $sapNumber = $row[0] ?? null;
            $nationalId = $row[2] ?? null;

            // التحقق من التكرار
            $existingEmployee = Employee::where('sap_number', $sapNumber)
                ->orWhere('national_id', $nationalId)
                ->first();

            if ($existingEmployee) {
                throw ValidationException::withMessages([
                    'file' => ["تم إيقاف الاستيراد: يوجد موظف مكرر في الصف رقم " . ($index + 1) . 
                        " برقم ساب: {$sapNumber} أو رقم قومي: {$nationalId}"]
                ]);
            }

            // التعامل مع مكتب العمل
            $laborOfficeName = trim($row[12] ?? null);
            $insuranceOfficeId = null;

            if ($laborOfficeName && $laborOfficeName !== 'غير محدد') {
                $insuranceOffice = InsuranceOffice::where('name', $laborOfficeName)->first();

                if (!$insuranceOffice) {
                    // لو المكتب مش موجود، نرمي خطأ
                    throw ValidationException::withMessages([
                        'file' => ["مكتب العمل '{$laborOfficeName}' غير موجود في قاعدة البيانات في الصف رقم " . ($index + 1)]
                    ]);
                    // ملحوظة: لو عايزة نضيف المكتب تلقائيًا، هنشرح ده تحت
                } else {
                    $insuranceOfficeId = $insuranceOffice->id;
                }
            }

            $data = [
                'sap_number' => $sapNumber,
                'name' => $row[1] ?? null,
                'national_id' => $nationalId,
                'department' => $row[3] ?? null,
                'qualification' => $row[4] ?? null,
                'hiring_date' => $this->parseDate($row[5] ?? null),
                'job_title' => $row[6] ?? null,
                'gender' => $row[7] ?? null,
                'branch' => $row[8] ?? null,
                'phone' => $row[9] ?? null,
                'license_expiry_date' => $this->parseDate($row[10] ?? null),
                'insurance_number' => $row[11] ?? null,
                'insurance_office_id' => $insuranceOfficeId, // الحقل الجديد
                'insurance_status' => $row[13] ?? null,
                'insurance_start_date' => $this->parseDate($row[14] ?? null),
                'insurance_salary' => $row[15] ?? null,
                'gross_salary' => $row[16] ?? null,
                'employee_share' => $row[17] ?? null,
                'employer_share' => $row[18] ?? null,
                'total_insurance' => $row[19] ?? null,
                'resignation_date' => $this->parseDate($row[20] ?? null),
                'registered_company' => $row[21] ?? null,
                'official_resignation_date' => $this->parseDate($row[22] ?? null),
            ];

            Employee::create($data);
        }
    }

    protected function parseDate($date): ?string
    {
        if (empty($date)) return null;

        try {
            if (is_numeric($date)) {
                return Date::excelToDateTimeObject($date)->format('Y-m-d');
            }

            if ($parsedDate = Carbon::parse($date)) {
                return $parsedDate->format('Y-m-d');
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function headings(): array
    {
        return [
            'رقم الساب',
            'الاسم',
            'الرقم القومي',
            'الإدارة',
            'المؤهل',
            'تاريخ التعيين',
            'المسمى الوظيفي',
            'النوع',
            'الفرع',
            'الموبايل',
            'تاريخ انتهاء الرخصة',
            'الرقم التأميني',
            'مكتب العمل',
            'حالة التأمينات',
            'تاريخ الالتحاق بالتأمين',
            'الأجر التأميني',
            'الأجر الشامل',
            'حصة الموظف',
            'حصة صاحب العمل',
            'المجموع التأميني',
            'تاريخ الاستقالة',
            'الشركة المسجل عليها',
            'تاريخ الاستقالة الرسمي',
        ];
    }
}