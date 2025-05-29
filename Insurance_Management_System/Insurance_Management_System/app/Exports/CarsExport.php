<?php

namespace App\Exports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Carbon\Carbon;

class CarsExport implements FromCollection, WithHeadings, WithTitle
{
    protected $vehicleCategory;

    public function __construct($vehicleCategory)
    {
        $this->vehicleCategory = $vehicleCategory;
    }

    public function collection()
    {
        $query = Car::with('employee');

        // إذا كان "الكل"، نجيب كل السيارات بدون فلتر
        if ($this->vehicleCategory !== 'all') {
            $query->where('vehicle_category', $this->vehicleCategory);
        }

        return $query->get()->map(function ($car) {
            return [
                'اسم_السيارة' => $car->name,
                'نوع_السيارة' => $car->type,
                'بداية_الفحص' => $this->formatDate($car->inspection_start),
                'نهاية_الفحص' => $this->formatDate($car->inspection_end),
                'سنة_الصنع' => $car->manufacture_year,
                'الموظف' => $car->employee ? $car->employee->name : null,
                'الرقم_التأميني' => $car->insurance_number,
                'الموقع' => $car->location,
                'رقم_اللوحة' => $car->plate_number,
                'رقم_الشاسيه' => $car->chassis_number,
                'فئة_السيارة' => $car->vehicle_category,
                'التباع' => $car->car_driver,
                 'رقم_تأمين_السائق' => $car->insurance_number_driver,
                'عدد_الكيلومترات' => $car->mileage,
            ];
        });
    }

    private function formatDate($date)
    {
        if (!$date) {
            return null;
        }

        try {
            return is_string($date) ? Carbon::parse($date)->format('Y-m-d') : $date->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    private function formatDateTime($dateTime)
    {
        if (!$dateTime) {
            return null;
        }

        try {
            return is_string($dateTime) ? Carbon::parse($dateTime)->format('Y-m-d H:i:s') : $dateTime->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return null;
        }
    }

    public function headings(): array
    {
        return [
            'اسم_السيارة',
            'نوع_السيارة',
            'بداية_الفحص',
            'نهاية_الفحص',
            'سنة_الصنع',
            'الموظف',
            'الرقم_التأميني',
            'الموقع',
            'رقم_اللوحة',
            'رقم_الشاسيه',
            'فئة_السيارة',
            'التباع',
            'رقم_تأمين_السائق',
            'عدد_الكيلومترات',
           
        ];
    }

    public function title(): string
    {
        return 'Cars - ' . ($this->vehicleCategory === 'all' ? 'الكل' : $this->vehicleCategory);
    }
}