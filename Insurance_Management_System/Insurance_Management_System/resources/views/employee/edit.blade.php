@extends('layouts')

@section('content')
    <div class="container">
        <h2 class="mb-4">تعديل بيانات الموظف</h2>
        <form method="POST" action="{{ route('employees.update', $employee->id) }}" enctype="multipart/form-data" id="updateEmployeeForm">
            @csrf
            @method('PUT')

            {{-- البيانات الأساسية --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">البيانات الأساسية</div>
                <div class="card-body row">
                    <div class="col-md-6 mb-3">
                        <label>رقم الساب</label>
                        <input type="text" name="sap_number" class="form-control @error('sap_number') is-invalid @enderror" value="{{ old('sap_number', $employee->sap_number) }}">
                        @error('sap_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>الاسم</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $employee->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>الرقم القومي</label>
                        <input type="text" name="national_id" class="form-control @error('national_id') is-invalid @enderror" value="{{ old('national_id', $employee->national_id) }}">
                        @error('national_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>الإدارة</label>
                        <input type="text" name="department" class="form-control @error('department') is-invalid @enderror" value="{{ old('department', $employee->department) }}">
                        @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>المؤهل</label>
                        <input type="text" name="qualification" class="form-control @error('qualification') is-invalid @enderror" value="{{ old('qualification', $employee->qualification) }}">
                        @error('qualification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>تاريخ التعيين</label>
                        <input type="date" name="hiring_date" class="form-control @error('hiring_date') is-invalid @enderror" value="{{ old('hiring_date', $employee->hiring_date) }}">
                        @error('hiring_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>المسمى الوظيفي</label>
                        <input type="text" name="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ old('job_title', $employee->job_title) }}">
                        @error('job_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>النوع</label>
                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="ذكر" {{ old('gender', $employee->gender) == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                            <option value="أنثى" {{ old('gender', $employee->gender) == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>الفرع</label>
                        <input type="text" name="branch" class="form-control @error('branch') is-invalid @enderror" value="{{ old('branch', $employee->branch) }}">
                        @error('branch')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>الموبايل</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $employee->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>صورة رخصة القيادة (وجه)</label>
                        <input type="file" name="license_image_front" class="form-control @error('license_image_front') is-invalid @enderror">
                        @if ($employee->license_image_front)
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-image me-1"></i> الصورة الحالية:
                                <a href="{{ asset('storage/' . $employee->license_image_front) }}" target="_blank">عرض</a>
                            </small>
                        @endif
                        @error('license_image_front')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>صورة رخصة القيادة (ظهر)</label>
                        <input type="file" name="license_image_back" class="form-control @error('license_image_back') is-invalid @enderror">
                        @if ($employee->license_image_back)
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-image me-1"></i> الصورة الحالية:
                                <a href="{{ asset('storage/' . $employee->license_image_back) }}" target="_blank">عرض</a>
                            </small>
                        @endif
                        @error('license_image_back')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>تاريخ انتهاء الرخصة</label>
                        <input type="date" name="license_expiry_date" class="form-control @error('license_expiry_date') is-invalid @enderror" value="{{ old('license_expiry_date', $employee->license_expiry_date) }}">
                        @error('license_expiry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- بيانات التأمينات --}}
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">بيانات التأمينات</div>
                <div class="card-body row">
                    <div class="col-md-6 mb-3">
                        <label>الرقم التأميني</label>
                        <input type="text" name="insurance_number" class="form-control @error('insurance_number') is-invalid @enderror" value="{{ old('insurance_number', $employee->insurance_number) }}">
                        @error('insurance_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="insurance_office_id" class="form-label">اختر مكتب التأمين</label>
                        <select id="insurance_office_id" name="insurance_office_id" class="form-control @error('insurance_office_id') is-invalid @enderror" onchange="updateInsuranceInfo()">
                            <option value="">اختر مكتب</option>
                            @foreach ($offices as $office)
                                <option value="{{ $office->id }}" data-number="{{ $office->number }}" data-register="{{ $office->register_number }}" {{ old('insurance_office_id', $employee->insurance_office_id) == $office->id ? 'selected' : '' }}>
                                    {{ $office->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('insurance_office_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="hidden" name="insurance_number_office" id="hidden_insurance_number_office" value="{{ old('insurance_number_office', $employee->insurance_number_office) }}">
                    <input type="hidden" name="register_number_office" id="hidden_register_number_office" value="{{ old('register_number_office', $employee->register_number_office) }}">

                    <div class="col-md-6 mb-3">
                        <label for="insurance_number_office" class="form-label">الرقم التأميني للمكتب</label>
                        <input type="text" class="form-control" id="insurance_number_office" value="{{ old('insurance_number_office', $employee->insurance_number_office) }}" readonly>
                        @error('insurance_number_office')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="register_number_office" class="form-label">رقم تسجيل المكتب</label>
                        <input type="text" class="form-control" id="register_number_office" value="{{ old('register_number_office', $employee->register_number_office) }}" readonly>
                        @error('register_number_office')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="insurance_status" class="form-label">حالة التأمينات</label>
                        <select name="insurance_status" id="insurance_status" class="form-control @error('insurance_status') is-invalid @enderror">
                            <option value="">-- اختر الحالة --</option>
                            <option value="مؤمن عليه" {{ old('insurance_status', $employee->insurance_status) == 'مؤمن عليه' ? 'selected' : '' }}>مؤمن عليه</option>
                            <option value="غير مؤمن عليه" {{ old('insurance_status', $employee->insurance_status) == 'غير مؤمن عليه' ? 'selected' : '' }}>غير مؤمن عليه</option>
                        </select>
                        @error('insurance_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>تاريخ الالتحاق بالتأمينات</label>
                        <input type="date" name="insurance_start_date" class="form-control @error('insurance_start_date') is-invalid @enderror" value="{{ old('insurance_start_date', $employee->insurance_start_date) }}">
                        @error('insurance_start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>الأجر التأميني</label>
                        <input type="number" step="0.01" name="insurance_salary" id="insurance_salary" class="form-control @error('insurance_salary') is-invalid @enderror" value="{{ old('insurance_salary', $employee->insurance_salary) }}">
                        @error('insurance_salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>الأجر الشامل</label>
                        <input type="number" step="0.01" name="gross_salary" class="form-control @error('gross_salary') is-invalid @enderror" value="{{ old('gross_salary', $employee->gross_salary) }}">
                        @error('gross_salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>نسبة الموظف (11%)</label>
                        <input type="number" step="0.01" name="employee_share" id="employee_share" class="form-control" value="{{ old('employee_share', $employee->employee_share) }}" readonly>
                        @error('employee_share')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>نسبة الشركة (18.75%)</label>
                        <input type="number" step="0.01" name="employer_share" id="employer_share" class="form-control" value="{{ old('employer_share', $employee->employer_share) }}" readonly>
                        @error('employer_share')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>إجمالي التأمين</label>
                        <input type="number" step="0.01" name="total_insurance" id="total_insurance" class="form-control" value="{{ old('total_insurance', $employee->total_insurance) }}" readonly>
                        @error('total_insurance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="registered_company" class="form-label">الشركة المسجل عليها</label>
                        <select name="registered_company" id="registered_company" class="form-control @error('registered_company') is-invalid @enderror">
                            <option value="">-- اختر الشركة --</option>
                            <option value="الطارق للتجاره" {{ old('registered_company', $employee->registered_company) == 'الطارق للتجاره' ? 'selected' : '' }}>الطارق للتجاره</option>
                            <option value="الطارق للسيارات" {{ old('registered_company', $employee->registered_company) == 'الطارق للسيارات' ? 'selected' : '' }}>الطارق للسيارات</option>
                            <option value="الطارق القطاميه" {{ old('registered_company', $employee->registered_company) == 'الطارق القطاميه' ? 'selected' : '' }}>الطارق القطاميه</option>
                            <option value="ليدر" {{ old('registered_company', $employee->registered_company) == 'ليدر' ? 'selected' : '' }}>ليدر</option>
                            <option value="اليكس ترانس" {{ old('registered_company', $employee->registered_company) == 'اليكس ترانس' ? 'selected' : '' }}>اليكس ترانس</option>
                            <option value="AUA" {{ old('registered_company', $employee->registered_company) == 'AUA' ? 'selected' : '' }}>AUA</option>
                            <option value="MWA" {{ old('registered_company', $employee->registered_company) == 'MWA' ? 'selected' : '' }}>MWA</option>
                            <option value="A Travel" {{ old('registered_company', $employee->registered_company) == 'A Travel' ? 'selected' : '' }}>A Travel</option>
                        </select>
                        @error('registered_company')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>تاريخ ترك العمل</label>
                        <input type="date" name="resignation_date" class="form-control @error('resignation_date') is-invalid @enderror" value="{{ old('resignation_date', $employee->resignation_date) }}">
                        @error('resignation_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>تاريخ الاستقالة الرسمي</label>
                        <input type="date" name="official_resignation_date" class="form-control @error('official_resignation_date') is-invalid @enderror" value="{{ old('official_resignation_date', $employee->official_resignation_date) }}">
                        @error('official_resignation_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- المستندات --}}
            <div class="card mb-4">
                <div class="card-header bg-info text-white">المستندات</div>
                <div class="card-body row">
                    <div class="col-md-4 mb-3">
                        <label>استمارة 1</label>
                        <input type="file" name="form_1" class="form-control @error('form_1') is-invalid @enderror">
                        @if ($employee->form_1)
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-file-alt me-1"></i> المستند الحالي:
                                <a href="{{ asset('storage/' . $employee->form_1) }}" target="_blank">عرض</a>
                            </small>
                        @endif
                        @error('form_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>استمارة 6</label>
                        <input type="file" name="form_6" class="form-control @error('form_6') is-invalid @enderror">
                        @if ($employee->form_6)
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-file-alt me-1"></i> المستند الحالي:
                                <a href="{{ asset('storage/' . $employee->form_6) }}" target="_blank">عرض</a>
                            </small>
                        @endif
                        @error('form_6')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>مستند آخر</label>
                        <input type="file" name="other_document" class="form-control @error('other_document') is-invalid @enderror">
                        @if ($employee->other_document)
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-file-alt me-1"></i> المستند الحالي:
                                <a href="{{ asset('storage/' . $employee->other_document) }}" target="_blank">عرض</a>
                            </small>
                        @endif
                        @error('other_document')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- الملاحظات --}}
            <div class="card mb-4">
                <div class="card-header bg-light">ملاحظات</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>ملاحظات</label>
                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="4">{{ old('notes', $employee->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary">تحديث الموظف</button>
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

        // Trigger insurance calculations on page load
        window.addEventListener('load', function() {
            let salary = parseFloat(document.getElementById('insurance_salary').value) || 0;
            let employeeShare = +(salary * 0.11).toFixed(2);
            let employerShare = +(salary * 0.1875).toFixed(2);
            let total = +(employeeShare + employerShare).toFixed(2);

            document.getElementById('employee_share').value = employeeShare;
            document.getElementById('employer_share').value = employerShare;
            document.getElementById('total_insurance').value = total;

            // Trigger insurance office fields update on page load
            updateInsuranceInfo();
        });

        function updateInsuranceInfo() {
            var selectedOption = document.querySelector('#insurance_office_id option:checked');
            var insuranceNumber = selectedOption ? selectedOption.getAttribute('data-number') : '';
            var registerNumber = selectedOption ? selectedOption.getAttribute('data-register') : '';

            document.getElementById('insurance_number_office').value = insuranceNumber;
            document.getElementById('register_number_office').value = registerNumber;
            document.getElementById('hidden_insurance_number_office').value = insuranceNumber;
            document.getElementById('hidden_register_number_office').value = registerNumber;
        }

        // SweetAlert2 confirmation
        document.getElementById('updateEmployeeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'تأكيد التحديث',
                text: 'هل أنت متأكد من تحديث بيانات الموظف؟',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'نعم، تحديث',
                cancelButtonText: 'إلغاء',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-secondary ms-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
    @endsection