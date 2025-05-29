<?php

namespace App\Imports;

use App\Models\Car;
use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CarsImport implements ToCollection, WithHeadingRow, WithValidation, WithCustomValueBinder
{
    protected $errors = [];

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value) && Date::isDateTime($cell)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }
        return $value;
    }

    public function collection(Collection $rows)
    {
        Log::info('Raw rows imported:', $rows->toArray());

        // التحقق من الرؤوس
        $expectedHeadings = $this->headings();
        $actualHeadings = array_keys($rows->first() ? $rows->first()->toArray() : []);
        if ($actualHeadings !== $expectedHeadings) {
            $this->errors[] = 'Invalid column headings. Expected: ' . implode(', ', $expectedHeadings);
            Log::error('Invalid headings:', ['expected' => $expectedHeadings, 'actual' => $actualHeadings]);
            return;
        }

        if ($rows->isEmpty()) {
            $this->errors[] = 'The file contains no data.';
            Log::error('Empty file uploaded.');
            return;
        }

        foreach ($rows as $index => $row) {
            $row = $row->mapWithKeys(function ($value, $key) {
                return [trim($key) => is_string($value) ? trim($value) : $value];
            });

            Log::info("Processing row {$index}:", $row->toArray());

            // التحقق من أن الصف ليس فاضيًا
            if ($row->filter()->isEmpty()) {
                $this->errors[] = "Row " . ($index + 2) . ": The row is empty.";
                Log::error("Empty row detected at index {$index}.");
                continue;
            }

            $validator = Validator::make($row->toArray(), $this->rules(), $this->customValidationMessages());

            if ($validator->fails()) {
                $this->errors[] = "Row " . ($index + 2) . ": " . implode(', ', $validator->errors()->all());
                Log::error("Validation failed for row {$index}:", $validator->errors()->all());
                continue;
            }

            $employee = Employee::where('name', trim($row['employee'] ?? ''))->first();

            if (!$employee) {
                $this->errors[] = "Row " . ($index + 2) . ": Employee '{$row['employee']}' not found.";
                Log::error("Employee not found for row {$index}: {$row['employee']}");
                continue;
            }

            // التحقق من تكرار رقم اللوحة
            if (Car::where('plate_number', trim($row['plate_number']))->exists()) {
                $this->errors[] = "Row " . ($index + 2) . ": Plate number '{$row['plate_number']}' already exists.";
                Log::error("Duplicate plate number for row {$index}: {$row['plate_number']}");
                continue;
            }

            Car::create([
                'name' => trim($row['car_name']),
                'type' => trim($row['car_type']),
                'inspection_start' => $this->transformDate($row['inspection_start']),
                'inspection_end' => $this->transformDate($row['inspection_end']),
                'manufacture_year' => (int) $row['manufacture_year'],
                'employee_id' => $employee->id,
                'insurance_number' => trim($row['insurance_number']),
                'location' => trim($row['location']),
                'plate_number' => trim($row['plate_number']),
                'chassis_number' => trim($row['chassis_number']),
                'vehicle_category' => trim($row['vehicle_category']),
                'car_driver' => trim($row['car_driver'] ?? null),
                'insurance_number_driver' => trim($row['insurance_number_driver'] ?? null),
                'mileage' => trim($row['mileage']),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'car_name' => ['required', 'string', 'max:255'],
            'car_type' => ['required', 'string', 'max:255'],
            'inspection_start' => ['required', 'date'],
            'inspection_end' => ['required', 'date', 'after_or_equal:inspection_start'],
            'manufacture_year' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'employee' => ['required', 'string'],
            'insurance_number' => ['required', 'numeric', 'max:10000000'],
            'location' => ['required', 'string', 'max:255'],
            'plate_number' => ['required', 'string', 'max:255'],
            'chassis_number' => ['required', 'string', 'max:255'],
            'vehicle_category' => ['required', 'string', 'max:255'],
            'car_driver' => ['nullable', 'string', 'max:255'],
            'insurance_number_driver' => ['nullable', 'string', 'max:255'],
            'mileage' => ['required', 'numeric', 'min:0', 'max:1000000'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'car_name.required' => 'Car name is required.',
            'car_type.required' => 'Car type is required.',
            'inspection_start.required' => 'Inspection start date is required.',
            'inspection_start.date' => 'Inspection start date must be a valid date.',
            'inspection_end.required' => 'Inspection end date is required.',
            'inspection_end.date' => 'Inspection end date must be a valid date.',
            'inspection_end.after_or_equal' => 'Inspection end date must be on or after inspection start date.',
            'manufacture_year.required' => 'Manufacture year is required.',
            'employee.required' => 'Employee name is required.',
            'insurance_number.required' => 'Insurance number is required.',
            'insurance_number.numeric' => 'Insurance number must be a number.',
            'insurance_number.max' => 'Insurance number cannot exceed 10,000,000.',
            'location.required' => 'Location is required.',
            'plate_number.required' => 'Plate number is required.',
            'chassis_number.required' => 'Chassis number is required.',
            'vehicle_category.required' => 'Vehicle category is required.',
            'mileage.required' => 'Mileage is required.',
            'mileage.numeric' => 'Mileage must be a number.',
            'mileage.min' => 'Mileage cannot be negative.',
            'mileage.max' => 'Mileage cannot exceed 1,000,000.',
        ];
    }

    protected function transformDate($value)
    {
        try {
            $value = trim($value);
            if (!$value || empty($value)) {
                throw new \Exception('Invalid date');
            }

            // إذا كان القيمة رقم تسلسلي (Excel serial date)
            if (is_numeric($value)) {
                $date = Date::excelToDateTimeObject($value)->format('Y/m/d');
                Log::info('Parsed Excel serial date:', ['input' => $value, 'output' => $date]);
                return $date;
            }

            // إذا كان القيمة نص (مثل 2025-05-01)
            $date = Carbon::parse($value)->format('Y/m/d');
            Log::info('Parsed string date:', ['input' => $value, 'output' => $date]);
            return $date;
        } catch (\Exception $e) {
            Log::error('Invalid date format:', ['value' => $value, 'error' => $e->getMessage()]);
            throw new \Exception('Invalid date: ' . $value);
        }
    }

    protected function transformDateTime($value)
    {
        try {
            $value = trim($value);
            if (!$value || empty($value)) {
                return now()->format('Y-m-d H:i:s');
            }

            // إذا كان القيمة رقم تسلسلي
            if (is_numeric($value)) {
                $dateTime = Date::excelToDateTimeObject($value)->format('Y-m-d H:i:s');
                Log::info('Parsed Excel serial datetime:', ['input' => $value, 'output' => $dateTime]);
                return $dateTime;
            }

            // إذا كان القيمة نص
            $dateTime = Carbon::parse($value)->format('Y-m-d H:i:s');
            Log::info('Parsed string datetime:', ['input' => $value, 'output' => $dateTime]);
            return $dateTime;
        } catch (\Exception $e) {
            Log::error('Invalid datetime format:', ['value' => $value, 'error' => $e->getMessage()]);
            return now()->format('Y-m-d H:i:s');
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function headings(): array
    {
        return [
            'car_name',
            'car_type',
            'inspection_start',
            'inspection_end',
            'manufacture_year',
            'employee',
            'insurance_number',
            'location',
            'plate_number',
            'chassis_number',
            'vehicle_category',
            'car_driver',
            'insurance_number_driver',
            'mileage',
        ];
    }
}
