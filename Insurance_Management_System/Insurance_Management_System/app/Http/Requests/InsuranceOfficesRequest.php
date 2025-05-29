<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class InsuranceOfficesRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'number' => ['required','string','max:255','unique:insurance_offices,number'],
            'register_number' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'area' => ['nullable', 'string', 'max:255'],
            'area2' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'police_officer' => ['nullable', 'string', 'max:255'],
            'office' => ['nullable', 'string', 'max:255'],
            'Company' => ['nullable', 'string', 'max:255'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'اسم المكتب مطلوب.',
            'name.string' => 'اسم المكتب يجب أن يكون نصًا.',
            'name.max' => 'اسم المكتب لا يمكن أن يتجاوز 255 حرفًا.',
            'number.required' => 'رقم المكتب مطلوب.',
            'number.string' => 'رقم المكتب يجب أن يكون نصًا.',
            'number.max' => 'رقم المكتب لا يمكن أن يتجاوز 255 حرفًا.',
            'number.unique' => 'رقم المكتب موجود بالفعل، اختر رقمًا آخر.',
            'register_number.required' => 'رقم التسجيل مطلوب.',
            'register_number.string' => 'رقم التسجيل يجب أن يكون نصًا.',
            'register_number.max' => 'رقم التسجيل لا يمكن أن يتجاوز 255 حرفًا.',
            'address.string' => 'العنوان يجب أن يكون نصًا.',
            'address.max' => 'العنوان لا يمكن أن يتجاوز 255 حرفًا.',
            'area.string' => 'المنطقة يجب أن تكون نصًا.',
            'area.max' => 'المنطقة لا يمكن أن تتجاوز 255 حرفًا.',
            'area2.string' => 'المنطقة الإضافية يجب أن تكون نصًا.',
            'area2.max' => 'المنطقة الإضافية لا يمكن أن تتجاوز 255 حرفًا.',
            'city.string' => 'المدينة يجب أن تكون نصًا.',
            'city.max' => 'المدينة لا يمكن أن تتجاوز 255 حرفًا.',
            'police_officer.string' => 'اسم ضابط الشرطة يجب أن يكون نصًا.',
            'police_officer.max' => 'اسم ضابط الشرطة لا يمكن أن يتجاوز 255 حرفًا.',
            'office.string' => 'المكتب يجب أن يكون نصًا.',
            'office.max' => 'المكتب لا يمكن أن يتجاوز 255 حرفًا.',
            'Company.string' => 'اسم الشركة يجب أن يكون نصًا.',
            'Company.max' => 'اسم الشركة لا يمكن أن يتجاوز 255 حرفًا.',
        ];
    }
}
