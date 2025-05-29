<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class Employees_insurance_Export implements FromCollection, WithHeadings, WithMapping
{protected $insurance_office_id;

    public function __construct($insurance_office_id = null)
    {
        $this->insurance_office_id = $insurance_office_id;
    }

    public function collection()
    {
        // لو المستخدم اختار "الكل"، رجّع كل الموظفين، غير كده فلتر حسب insurance_office_id
        if ($this->insurance_office_id && $this->insurance_office_id !== 'الكل') {
            return Employee::where('insurance_office_id', $this->insurance_office_id)->get();
        }

        return Employee::all();
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

    public function map($employee): array
    {
        return [
            $employee->sap_number,
            $employee->name,
            $employee->national_id,
            $employee->department,
            $employee->qualification,
            $employee->hiring_date,
            $employee->job_title,
            $employee->gender,
            $employee->branch,
            $employee->phone,
            $employee->license_expiry_date,
            $employee->insurance_number,
            $employee->insuranceOffice ? $employee->insuranceOffice->name : 'غير محدد', // اسم مكتب العمل
            $employee->insurance_status,
            $employee->insurance_start_date,
            $employee->insurance_salary,
            $employee->gross_salary,
            $employee->employee_share,
            $employee->employer_share,
            $employee->total_insurance,
            $employee->resignation_date,
            $employee->registered_company,
            $employee->official_resignation_date,
        ];
    }
}
