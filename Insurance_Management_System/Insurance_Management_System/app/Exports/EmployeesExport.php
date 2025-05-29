<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $registered_company;

    public function __construct($registered_company = null)
    {
        $this->registered_company = $registered_company;
    }

    public function collection()
    {
        if ($this->registered_company && $this->registered_company !== 'الكل') {
            return Employee::where('registered_company', $this->registered_company)->get();
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
            $employee->insurance_office_id ? $employee->insuranceOffice->name : 'غير محدد',
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