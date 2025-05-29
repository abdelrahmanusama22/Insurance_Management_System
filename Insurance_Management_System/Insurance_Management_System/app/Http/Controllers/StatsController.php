<?php

namespace App\Http\Controllers;

use App\Models\InsuranceOffice;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function combinedStats()
    {
        // إحصائيات حسب مكتب التأمين
        $insuranceOfficeStats = DB::table('employees')
            ->join('insurance_offices', 'employees.insurance_office_id', '=', 'insurance_offices.id')
            ->select(
                'insurance_offices.name as insurance_office',
                DB::raw('COUNT(employees.id) as employee_count'),
                DB::raw('SUM(employees.employee_share) as total_employee_share'),
                DB::raw('SUM(employees.employer_share) as total_employer_share'),
                DB::raw('SUM(employees.total_insurance) as total_insurance_sum')
            )
            ->groupBy('insurance_offices.name')
            ->get();

        // إحصائيات حسب الشركة
        $companyStats = DB::table('employees')
            ->select(
                'registered_company',
                DB::raw('COUNT(*) as employee_count'),
                DB::raw('SUM(employee_share) as total_employee_share'),
                DB::raw('SUM(employer_share) as total_employer_share'),
                DB::raw('SUM(total_insurance) as total_insurance_sum')
            )
            ->whereNotNull('registered_company')
            ->groupBy('registered_company')
            ->get();

        return view('employee.labor_stats', compact('insuranceOfficeStats', 'companyStats'));
    }
}
