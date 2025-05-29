<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function boot()
{
    parent::boot();

    static::saving(function ($employee) {
        $insuranceSalary = $employee->insurance_salary ?? 0;

        $employee->employee_share = round($insuranceSalary * 0.11, 2);
        $employee->employer_share = round($insuranceSalary * 0.1875, 2);
        $employee->total_insurance = round($employee->employee_share + $employee->employer_share, 2);
    });
}

    public function cars()
{
    return $this->hasMany(Car::class);
}
public function insuranceOffice()
{
    return $this->belongsTo(InsuranceOffice::class);
}


}
