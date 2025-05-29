<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'inspection_start' => 'required|date',
            'inspection_end' => 'required|date',
            'manufacture_year' => 'required|integer',
            'employee_id' => 'required|exists:employees,id',
            'insurance_number' => 'required|string',
            'location' => 'required|string',
            'plate_number' => 'required|string',
            'chassis_number' => 'required|string|unique:cars,chassis_number',
            'vehicle_category' => 'required|string',
            'license_image_front' => 'nullable|image',
            'license_image_back' => 'nullable|image',
            'insurance_certificate' => 'nullable|image',
        ];

        
    }
    public function messages(): array
{
    return [
        'name.required' => 'اسم السيارة مطلوب',
        'type.required' => 'نوع السيارة مطلوب',
        'inspection_start.required' => 'تاريخ بداية الفحص مطلوب',
        'inspection_end.required' => 'تاريخ نهاية الفحص مطلوب',
        'manufacture_year.required' => 'سنة الصنع مطلوبة',
        'manufacture_year.integer' => 'سنة الصنع يجب أن تكون رقمًا صحيحًا',
        'employee_id.required' => 'اختيار الموظف مرتبط بالسيارة مطلوب',
        'employee_id.exists' => 'الموظف المختار غير موجود',
        'insurance_number.required' => 'رقم التأمين مطلوب',
        'location.required' => 'الموقع مطلوب',
        'plate_number.required' => 'رقم اللوحة مطلوب',
        'chassis_number.required' => 'رقم الشاسيه مطلوب',
        'chassis_number.unique' => 'رقم الشاسيه مسجل من قبل',
        'vehicle_category.required' => 'نوع النقل (ملاكي أو نقل تقيل) مطلوب',
        'license_image_front.image' => 'صورة الرخصة (وش) يجب أن تكون صورة',
        'license_image_back.image' => 'صورة الرخصة (ظهر) يجب أن تكون صورة',
        'insurance_certificate.image' => 'شهادة التأمين يجب أن تكون صورة',
    ];
}

}
