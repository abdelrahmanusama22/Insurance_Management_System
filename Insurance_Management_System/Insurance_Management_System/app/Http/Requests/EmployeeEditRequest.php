<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Don't forget to implement this method
    }
 /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */    public function rules(): array
    {
        return [
            'sap_number' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'national_id' => 'required|numeric|digits:14',
            'department' => 'required|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'hiring_date' => 'required|date',
            'job_title' => 'required|string|max:255',
            'gender' => 'required|in:ذكر,أنثى',
            'branch' => 'required|string|max:255',
            'phone' => 'nullable|numeric|digits:11',
            'license_image' => 'nullable|array|max:2',
            'license_image.*' => 'file|mimes:jpeg,png,jpg,pdf|max:2048',
            'license_expiry_date' => 'nullable|date',

            // Insurance data
            'insurance_number' => 'nullable|string|max:255',
            'labor_office' => 'nullable|string|max:255',
            'insurance_status' => 'nullable|string|max:255',
            'insurance_start_date' => 'nullable|date',
            'insurance_salary' => 'nullable|numeric|min:0',
            'gross_salary' => 'nullable|numeric|min:0',
            'employee_share' => 'nullable|numeric|min:0',
            'employer_share' => 'nullable|numeric|min:0',
            'total_insurance' => 'nullable|numeric|min:0',

            // Resignation data
            'resignation_date' => 'nullable|date',
            'registered_company' => 'nullable|string|max:255',
            'official_resignation_date' => 'nullable|date',

            // Documents
            'form_1' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'form_6' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'other_document' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',

            // Notes
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'sap_number.required' => 'رقم الساب هو حقل مطلوب.',
            'sap_number.numeric' => 'رقم الساب المدخل يجب ان يكون ارقام.',
            
            'name.required' => 'الاسم هو حقل مطلوب.',
            'name.string' => 'الاسم يجب أن يكون نصًا.',
            'name.max' => 'الاسم يجب أن لا يتجاوز 255 حرفًا.',
            
            'national_id.required' => 'الرقم القومي هو حقل مطلوب.',
            'national_id.numeric' => 'الرقم القومي المدخل يجب ان يكون ارقام.',
            'national_id.digits' => 'الرقم القومي المدخل يجب ان يكون 14 رقم.',
            
            'department.required' => 'الإدارة هي حقل مطلوب.',
            
            'phone.numeric' => 'رقم الهاتف المدخل يجب ان يكون ارقام.',
            'phone.digits' => 'رقم الهاتف المدخل يجب ان يكون 11 رقم.',
            
            'qualification.max' => 'المؤهل يجب أن لا يتجاوز 255 حرفًا.',
            
            'hiring_date.required' => 'تاريخ التعيين هو حقل مطلوب.',
            'hiring_date.date' => 'تاريخ التعيين يجب أن يكون تاريخًا صحيحًا.',
            
            'job_title.required' => 'المسمى الوظيفي هو حقل مطلوب.',
            
            'gender.required' => 'النوع هو حقل مطلوب.',
            'gender.in' => 'النوع يجب أن يكون إما "ذكر" أو "أنثى".',
            
            'branch.required' => 'الفرع هو حقل مطلوب.',
            
            'license_image.max' => 'يمكن رفع ملفين كحد أقصى للرخصة.',
            'license_image.*.mimes' => 'صورة الرخصة يجب أن تكون من نوع jpeg, png, jpg, أو pdf.',
            'license_image.*.max' => 'حجم صورة الرخصة يجب أن لا يتجاوز 2 ميجابايت.',
            
            'license_expiry_date.date' => 'تاريخ انتهاء الرخصة يجب أن يكون تاريخًا صحيحًا.',
            
            // Insurance messages
            'insurance_number.max' => 'الرقم التأميني يجب أن لا يتجاوز 255 حرفًا.',
            'labor_office.max' => 'اسم مكتب العمل يجب أن لا يتجاوز 255 حرفًا.',
            'insurance_status.max' => 'حالة التأمينات يجب أن لا تتجاوز 255 حرفًا.',
            'insurance_start_date.date' => 'تاريخ الالتحاق يجب أن يكون تاريخًا صحيحًا.',
            
            'insurance_salary.numeric' => 'الأجر التأميني يجب أن يكون رقمًا.',
            'insurance_salary.min' => 'الأجر التأميني يجب أن يكون أكبر من أو يساوي 0.',
            
            'gross_salary.numeric' => 'الأجر الشامل يجب أن يكون رقمًا.',
            'gross_salary.min' => 'الأجر الشامل يجب أن يكون أكبر من أو يساوي 0.',
            
            'employee_share.numeric' => 'نسبة الموظف يجب أن تكون رقمًا.',
            'employee_share.min' => 'نسبة الموظف يجب أن تكون أكبر من أو تساوي 0.',
            
            'employer_share.numeric' => 'نسبة صاحب العمل يجب أن تكون رقمًا.',
            'employer_share.min' => 'نسبة صاحب العمل يجب أن تكون أكبر من أو تساوي 0.',
            
            'total_insurance.numeric' => 'المجموع يجب أن يكون رقمًا.',
            'total_insurance.min' => 'المجموع يجب أن يكون أكبر من أو يساوي 0.',
            
            // Documents
            'form_1.mimes' => 'استمارة 1 يجب أن تكون من نوع jpeg, png, jpg, أو pdf.',
            'form_1.max' => 'حجم استمارة 1 يجب أن لا يتجاوز 2 ميجابايت.',
            
            'form_6.mimes' => 'استمارة 6 يجب أن تكون من نوع jpeg, png, jpg, أو pdf.',
            'form_6.max' => 'حجم استمارة 6 يجب أن لا يتجاوز 2 ميجابايت.',
            
            'other_document.mimes' => 'المستند الآخر يجب أن يكون من نوع jpeg, png, jpg, أو pdf.',
            'other_document.max' => 'حجم المستند الآخر يجب أن لا يتجاوز 2 ميجابايت.',
            
            // Notes
            'notes.max' => 'الملاحظات يجب أن لا تتجاوز 1000 حرف.',
        ];
    }
}