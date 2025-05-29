<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        'sap_number' => 'required|unique:employees,sap_number',         // رقم الساب
        'name' => 'required|string|max:255',                            // الاسم
        'national_id' => 'required|unique:employees,national_id|digits:14',
        'department' => 'required|string|max:255',                      // الإدارة
        'qualification' => 'nullable|string|max:255',                   // المؤهل
        'hiring_date' => 'required|date|before:resignation_date',       // تاريخ التعيين
        'job_title' => 'required|string|max:255',                       // المسمى الوظيفي
        'gender' => 'required|in:ذكر,أنثى',                             // النوع
        'branch' => 'required|string|max:255',                          // الفرع
        'phone' => 'nullable|digits:11',
        'license_image' => 'nullable|array|max:2',
        'license_image.*' => 'file|mimes:jpeg,png,jpg,pdf|max:2048',
        'license_expiry_date' => 'nullable|date',                       // تاريخ انتهاء الرخصة
        'insurance_office_id' => 'nullable|exists:insurance_offices,id', // مكتب العمل
        'insurance_status' => 'nullable|string|max:255',                // حالة التأمينات
        'insurance_start_date' => 'nullable|date',                      // تاريخ الالتحاق
        'insurance_salary' => 'nullable|numeric|min:0',                 // الأجر التأميني
        'gross_salary' => [
            'nullable',
            'numeric',
            'min:0',
            function ($attribute, $value, $fail) {
                if ($value !== null && $this->insurance_salary !== null && $value <= $this->insurance_salary) {
                    $fail('الأجر الشامل يجب أن يكون أكبر من الأجر التأميني.');
                }
            },
        ],                                                             // الأجر الشامل
        'employee_share' => 'nullable|numeric|min:0',                   // 11%
        'employer_share' => 'nullable|numeric|min:0',                   // 18.75%
        'total_insurance' => 'nullable|numeric|min:0',                  // المجموع
        'insurance_number_office' => 'nullable|string',
        'register_number_office' => 'nullable|string',
        'resignation_date' => 'nullable|date|after:hiring_date',        // تاريخ ترك العمل
        'registered_company' => 'nullable|string|max:255',             // الشركة المسجل عليها
        'official_resignation_date' => 'nullable|date|after:hiring_date', // تاريخ الاستقالة
        'form_1' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',    // استمارة 1
        'form_6' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',    // استمارة 6
        'other_document' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // مستند آخر
        'notes' => 'nullable|string|max:1000',                         // الملاحظات
    ];
}
    public function messages(): array
{
    return [
        // البيانات الأساسية
        'sap_number.required' => 'رقم الساب هو حقل مطلوب.',
        'sap_number.unique' => 'رقم الساب المدخل موجود مسبقًا.',
        'name.required' => 'الاسم هو حقل مطلوب.',
        'name.string' => 'الاسم يجب أن يكون نصًا.',
        'name.max' => 'الاسم يجب أن لا يتجاوز 255 حرفًا.',
        'national_id.unique' => 'الرقم القومي المدخل موجود مسبقًا.',
        'national_id.required' => 'الرقم القومي هو حقل مطلوب.',
        'national_id.digits' => 'الرقم القومي يجب أن يتكون من 14 رقمًا.',
        'department.required' => 'الإدارة هي حقل مطلوب.',
        'qualification.max' => 'المؤهل يجب أن لا يتجاوز 255 حرفًا.',
        'hiring_date.required' => 'تاريخ التعيين هو حقل مطلوب.',
        'hiring_date.before' => 'تاريخ التعيين يجب أن يكون قبل تاريخ ترك العمل.',
        'hiring_date.date' => 'تاريخ التعيين يجب أن يكون تاريخًا صحيحًا.',
        'phone.digits' => 'رقم الهاتف يجب أن يكون 11 رقمًا.',
        'job_title.required' => 'المسمى الوظيفي هو حقل مطلوب.',
        'gender.required' => 'النوع هو حقل مطلوب.',
        'gender.in' => 'النوع يجب أن يكون إما "ذكر" أو "أنثى".',
        'branch.required' => 'الفرع هو حقل مطلوب.',
        'phone.max' => 'رقم الهاتف يجب أن لا يتجاوز 15 حرفًا.',
        'license_image.mimes' => 'صورة الرخصة يجب أن تكون من نوع jpeg, png, jpg, أو pdf.',
        'license_image.max' => 'حجم صورة الرخصة يجب أن لا يتجاوز 2 ميجابايت.',
        'license_image.*.mimes' => 'صورة الرخصة يجب أن تكون من نوع jpeg, png, jpg, أو pdf.',
        'license_image.*.max' => 'حجم صورة الرخصة يجب أن لا يتجاوز 2 ميجابايت.',
        'license_expiry_date.date' => 'تاريخ انتهاء الرخصة يجب أن يكون تاريخًا صحيحًا.',
        'insurance_number_office.max' => 'الرقم التأميني يجب أن لا يتجاوز 255 حرفًا.',
        'insurance_office_id.exists' => 'مكتب العمل المحدد غير موجود.',
        'insurance_status.max' => 'حالة التأمينات يجب أن لا تتجاوز 255 حرفًا.',
        'insurance_start_date.date' => 'تاريخ الالتحاق يجب أن يكون تاريخًا صحيحًا.',
        'insurance_salary.numeric' => 'الأجر التأميني يجب أن يكون رقمًا.',
        'insurance_salary.min' => 'الأجر التأميني يجب أن يكون أكبر من أو يساوي 0.',
        'gross_salary.numeric' => 'الأجر الشامل يجب أن يكون رقمًا.',
        'gross_salary.min' => 'الأجر الشامل يجب أن يكون أكبر من أو يساوي 0.',
        'gross_salary' => 'الأجر الشامل يجب أن يكون أكبر من الأجر التأميني.', // رسالة مخصصة
        'employee_share.numeric' => 'نسبة الموظف يجب أن تكون رقمًا.',
        'employee_share.min' => 'نسبة الموظف يجب أن تكون أكبر من أو تساوي 0.',
        'employer_share.numeric' => 'نسبة صاحب العمل يجب أن تكون رقمًا.',
        'employer_share.min' => 'نسبة صاحب العمل يجب أن تكون أكبر من أو تساوي 0.',
        'total_insurance.numeric' => 'المجموع يجب أن يكون رقمًا.',
        'total_insurance.min' => 'المجموع يجب أن يكون أكبر من أو يساوي 0.',
        'resignation_date.date' => 'تاريخ ترك العمل يجب أن يكون تاريخًا صحيحًا.',
        'resignation_date.after' => 'تاريخ ترك العمل يجب أن يكون بعد تاريخ التعيين.',
        'official_resignation_date.date' => 'تاريخ الاستقالة الرسمي يجب أن يكون تاريخًا صحيحًا.',
        'official_resignation_date.after' => 'تاريخ الاستقالة الرسمي يجب أن يكون بعد تاريخ التعيين.',
        'form_1.mimes' => 'استمارة 1 يجب أن تكون من نوع jpeg, png, jpg, أو pdf.',
        'form_1.max' => 'حجم استمارة 1 يجب أن لا يتجاوز 2 ميجابايت.',
        'form_6.mimes' => 'استمارة 6 يجب أن تكون من نوع jpeg, png, jpg, أو pdf.',
        'form_6.max' => 'حجم استمارة 6 يجب أن لا يتجاوز 2 ميجابايت.',
        'other_document.mimes' => 'المستند الآخر يجب أن يكون من نوع jpeg, png, jpg, أو pdf.',
        'other_document.max' => 'حجم المستند الآخر يجب أن لا يتجاوز 2 ميجابايت.',
        'notes.max' => 'الملاحظات يجب أن لا تتجاوز 1000 حرف.',
    ];
}
}
