@extends('layouts')

@section('content')
    <div class="container">
        <h2 class="mb-4">إضافة موظف جديد</h2>
        <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- البيانات الأساسية --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">البيانات الأساسية</div>
                <div class="card-body row">

                    <div class="col-md-6 mb-3">
                        <label>رقم الساب</label>
                        <input type="text" name="sap_number"
                            class="form-control @error('sap_number') is-invalid @enderror">
                        @error('sap_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>الاسم</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>الرقم القومي</label>
                        <input type="text" name="national_id"
                            class="form-control @error('national_id') is-invalid @enderror">
                        @error('national_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>الإدارة</label>
                        <input type="text" name="department"
                            class="form-control @error('department') is-invalid @enderror">
                        @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>المؤهل</label>
                        <input type="text" name="qualification"
                            class="form-control @error('qualification') is-invalid @enderror">
                        @error('qualification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>تاريخ التعيين</label>
                        <input type="date" name="hiring_date"
                            class="form-control @error('hiring_date') is-invalid @enderror">
                        @error('hiring_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>المسمى الوظيفي</label>
                        <input type="text" name="job_title"
                            class="form-control @error('job_title') is-invalid @enderror">
                        @error('job_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>النوع</label>
                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="ذكر">ذكر</option>
                            <option value="أنثى">أنثى</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>الفرع</label>
                        <input type="text" name="branch" class="form-control @error('branch') is-invalid @enderror">
                        @error('branch')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>الموبايل</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>صورة رخصة القيادة (وجهه)</label>
                        <input type="file" name="license_image_front"
                            class="form-control @error('license_image_front') is-invalid @enderror">
                        @error('license_image_front')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>صورة رخصة القيادة (ظهر)</label>
                        <input type="file" name="license_image_back"
                            class="form-control @error('license_image_back') is-invalid @enderror">
                        @error('license_image_back')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>تاريخ انتهاء الرخصة</label>
                        <input type="date" name="license_expiry_date"
                            class="form-control @error('license_expiry_date') is-invalid @enderror">
                        @error('license_expiry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- بيانات التأمينات --}}
                    <div class="card mb-4 mb-3">
                        <div class="card-header bg-secondary text-white">بيانات التأمينات</div>
                        <div class="card-body row">

                            <div class="col-md-6 mb-3">
                                <label>الرقم التأميني</label>
                                <input type="text" name="insurance_number" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="insurance_office_id" class="form-label">اختر مكتب التأمين</label>
                                <select id="insurance_office_id" name="insurance_office_id" class="form-control"
                                    onchange="updateInsuranceInfo()">
                                    <option value="">اختر مكتب</option>
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}" data-number="{{ $office->number }}"
                                            data-register="{{ $office->register_number }}">
                                            {{ $office->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="insurance_number_office" id="hidden_insurance_number_office">
                            <input type="hidden" name="register_number_office" id="hidden_register_number_office">

                            <div class="col-md-6 mb-3">
                                <label for="insurance_number_office" class="form-label">الرقم التأميني للمكتب</label>
                                <input type="text" class="form-control" id="insurance_number_office"
                                    name="insurance_number_office" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="register_number_office" class="form-label">رقم تسجيل المكتب</label>
                                <input type="text" class="form-control" id="register_number_office"
                                    name="register_number_office" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="insurance_status" class="form-label">حالة التأمينات</label>
                                <select name="insurance_status" id="insurance_status" class="form-control">
                                    <option value="">-- اختر الحالة --</option>
                                    <option value="مؤمن عليه"
                                        {{ old('insurance_status') == 'مؤمن عليه' ? 'selected' : '' }}>مؤمن عليه</option>
                                    <option value="غير مؤمن عليه"
                                        {{ old('insurance_status') == 'غير مؤمن عليه' ? 'selected' : '' }}>غير مؤمن عليه
                                    </option>

                                </select>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label>تاريخ الالتحاق بالتأمينات</label>
                                <input type="date" name="insurance_start_date" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>الأجر التأميني</label>
                                <input type="number" step="0.01" name="insurance_salary" id="insurance_salary"
                                    class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>الأجر الشامل</label>
                                <input type="number" step="0.01" name="gross_salary" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>نسبة الموظف (11%)</label>
                                <input type="number" step="0.01" name="employee_share" id="employee_share"
                                    class="form-control" value="0" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>نسبة الشركة (18.75%)</label>
                                <input type="number" step="0.01" name="employer_share" id="employer_share"
                                    class="form-control" value="0" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>إجمالي التأمين</label>
                                <input type="number" step="0.01" name="total_insurance" id="total_insurance"
                                    class="form-control" value="0" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="registered_company" class="form-label">الشركة المسجل عليها</label>
                                <select name="registered_company" id="registered_company" class="form-control">
                                    <option value="">-- اختر الشركة --</option>
                                    <option value="الطارق للتجاره"
                                        {{ old('registered_company') == 'الطارق للتجاره' ? 'selected' : '' }}>الطارق
                                        للتجاره</option>
                                    <option value="الطارق للسيارات"
                                        {{ old('registered_company') == 'الطارق للسيارات' ? 'selected' : '' }}>الطارق
                                        للسيارات</option>
                                    <option value="الطارق القطاميه"
                                        {{ old('registered_company') == 'الطارق القطاميه' ? 'selected' : '' }}>الطارق
                                        القطاميه</option>
                                    <option value="ليدر" {{ old('registered_company') == 'ليدر' ? 'selected' : '' }}>
                                        ليدر</option>
                                    <option value="اليكس ترانس"
                                        {{ old('registered_company') == 'اليكس ترانس' ? 'selected' : '' }}>اليكس ترانس
                                    </option>
                                    <option value="AUA" {{ old('registered_company') == 'AUA' ? 'selected' : '' }}>AUA
                                    </option>
                                    <option value="MWA" {{ old('registered_company') == 'MWA' ? 'selected' : '' }}>MWA
                                    </option>
                                    <option value="A Travel"
                                        {{ old('registered_company') == 'A Travel' ? 'selected' : '' }}>A Travel</option>
                                </select>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label>تاريخ ترك العمل</label>
                                <input type="date" name="resignation_date" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>تاريخ الاستقالة الرسمي</label>
                                <input type="date" name="official_resignation_date" class="form-control">
                            </div>
                        </div>
                    </div>

                    {{-- المستندات --}}
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">المستندات</div>
                        <div class="card-body row">

                            <div class="col-md-4 mb-3">
                                <label>استمارة 1</label>
                                <input type="file" name="form_1" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>استمارة 6</label>
                                <input type="file" name="form_6" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>مستند آخر</label>
                                <input type="file" name="other_document" class="form-control">
                            </div>
                        </div>
                    </div>

                    {{-- الملاحظات --}}
                    <div class="card mb-4">
                        <div class="card-header bg-light">ملاحظات</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label>ملاحظات</label>
                                <textarea name="notes" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">حفظ الموظف</button>
                    </div>
        </form>
    </div>
    <script>
        document.getElementById('insurance_salary').addEventListener('input', function() {
            let salary = parseFloat(this.value) || 0;

            let employeeShare = +(salary * 0.11).toFixed(2);
            let employerShare = +(salary * 0.1875).toFixed(2);
            let total = +(employeeShare + employerShare).toFixed(2);

            document.getElementById('employee_share').value = employeeShare;
            document.getElementById('employer_share').value = employerShare;
            document.getElementById('total_insurance').value = total;
        });

        function updateInsuranceInfo() {
            var selectedOption = document.querySelector('#insurance_office_id option:checked');
            var insuranceNumber = selectedOption.getAttribute('data-number');
            var registerNumber = selectedOption.getAttribute('data-register');

            document.getElementById('insurance_number_office').value = insuranceNumber;
            document.getElementById('register_number_office').value = registerNumber;
        }
    </script>
   @endsection
