@extends('layouts')

@section('content')
    <style>
        .btn-danger {
            background: linear-gradient(45deg, #dc3545, #ff5767);
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(45deg, #c82333, #e03e4d);
            transform: scale(1.05);
        }
    </style>

    <div class="container mt-4" dir="rtl">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">عرض بيانات الموظف</h4>
                    </div>

                    <div class="card-body">
                        {{-- البيانات الأساسية --}}
                        <h5 class="border-bottom pb-2 mb-3">البيانات الأساسية</h5>
                        <div class="row g-3">
                            @php
                                $fields = [
                                    'الاسم' => $employee->name,
                                    'رقم الساب' => $employee->sap_number,
                                    'الرقم القومي' => $employee->national_id,
                                    'القسم' => $employee->department,
                                    'المؤهل' => $employee->qualification ?? 'غير محدد',
                                    'تاريخ التعيين' => $employee->hiring_date,
                                    'المسمى الوظيفي' => $employee->job_title,
                                    'النوع' => $employee->gender,
                                    'الفرع' => $employee->branch,
                                    'رقم الموبايل' => $employee->phone,
                                ];
                            @endphp
                            @foreach ($fields as $label => $value)
                                <div class="col-md-6">
                                    <div class="bg-light p-2 rounded border">
                                        <strong>{{ $label }}:</strong> {{ $value }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- بيانات رخصة القيادة --}}
                        <h5 class="border-bottom pb-2 mt-4 mb-3">بيانات رخصة القيادة</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded border shadow-sm">
                                    <strong>تاريخ الانتهاء:</strong>
                                    {{ $employee->license_expiry_date ?? 'غير محدد' }}
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="accordion" id="accordionLicense">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingLicense">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseLicense"
                                                aria-expanded="false" aria-controls="collapseLicense">
                                                عرض صور البطاقة
                                            </button>
                                        </h2>
                                        <div id="collapseLicense" class="accordion-collapse collapse"
                                            aria-labelledby="headingLicense">
                                            <div class="accordion-body">
                                                <ul class="list-unstyled">

                                                    {{-- الوجه الأمامي --}}
                                                    @if ($employee->license_image_front)
                                                        <li class="mb-3">
                                                            <strong>الوجه الأمامي لرخصة القيادة:</strong><br>
                                                            <a href="{{ asset('storage/' . $employee->license_image_front) }}"
                                                                target="_blank"
                                                                class="btn btn-sm btn-outline-primary mt-1">عرض الصورة</a>
                                                        </li>
                                                    @endif

                                                    {{-- الوجه الخلفي --}}
                                                    @if ($employee->license_image_back)
                                                        <li class="mb-3">
                                                            <strong>الوجه الخلفي لرخصة القيادة:</strong><br>
                                                            <a href="{{ asset('storage/' . $employee->license_image_back) }}"
                                                                target="_blank"
                                                                class="btn btn-sm btn-outline-primary mt-1">عرض الصورة</a>
                                                        </li>
                                                    @endif

                                                    {{-- في حال عدم وجود أي صورة --}}
                                                    @unless ($employee->license_image_front || $employee->license_image_back)
                                                        <li class="text-muted">لا توجد صور مرفوعة</li>
                                                    @endunless

                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- بيانات التأمينات --}}
                        <h5 class="border-bottom pb-2 mt-4 mb-3">بيانات التأمينات</h5>
                        <div class="row g-3">
                            @php
                                $insuranceFields = [
                                    'الرقم التأميني' => $employee->insurance_number,
                                    'مكتب العمل' => $employee->insuranceOffice
                                        ? $employee->insuranceOffice->name
                                        : 'غير محدد',
                                    'حالة التأمينات' => $employee->insurance_status,
                                    'تاريخ الالتحاق' => $employee->insurance_start_date,
                                    'الأجر التأميني' => $employee->insurance_salary . ' ج.م',
                                    'الأجر الشامل' => $employee->gross_salary . ' ج.م',
                                    'نصيب الموظف (11%)' => $employee->employee_share . ' ج.م',
                                    'نصيب الشركة (18.75%)' => $employee->employer_share . ' ج.م',
                                    'إجمالي التأمين' => $employee->total_insurance . ' ج.م',
                                ];
                            @endphp
                            @foreach ($insuranceFields as $label => $value)
                                <div class="col-md-6">
                                    <div class="bg-light p-2 rounded border">
                                        <strong>{{ $label }}:</strong> {{ $value }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- بيانات ترك العمل --}}
                        <h5 class="border-bottom pb-2 mt-4 mb-3">بيانات ترك العمل</h5>
                        <div class="row g-3">
                            @php
                                $resignFields = [
                                    'تاريخ ترك العمل' => $employee->resignation_date,
                                    'الشركة المسجل عليها' => $employee->registered_company,
                                    'تاريخ الاستقالة الرسمي' => $employee->official_resignation_date,
                                ];
                            @endphp
                            @foreach ($resignFields as $label => $value)
                                <div class="col-md-6">
                                    <div class="bg-light p-2 rounded border">
                                        <strong>{{ $label }}:</strong> {{ $value }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- المستندات والملاحظات --}}
                        <div class="accordion mt-4" id="accordionDocsNotes">
                            {{-- المستندات --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingDocs">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseDocs" aria-expanded="false" aria-controls="collapseDocs">
                                        المستندات
                                    </button>
                                </h2>
                                <div id="collapseDocs" class="accordion-collapse collapse" aria-labelledby="headingDocs"
                                    data-bs-parent="#accordionDocsNotes">
                                    <div class="accordion-body">
                                        <ul class="list-group">
                                            {{-- استمارة 1 --}}
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span><strong>استمارة 1:</strong></span>
                                                @if ($employee->form_1)
                                                    <a href="{{ asset('storage/' . $employee->form_1) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary">عرض</a>
                                                @else
                                                    <span class="text-muted">غير مرفوعة</span>
                                                @endif
                                            </li>

                                            {{-- استمارة 6 --}}
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span><strong>استمارة 6:</strong></span>
                                                @if ($employee->form_6)
                                                    <a href="{{ asset('storage/' . $employee->form_6) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary">عرض</a>
                                                @else
                                                    <span class="text-muted">غير مرفوعة</span>
                                                @endif
                                            </li>

                                            {{-- مستند آخر --}}
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span><strong>مستند آخر:</strong></span>
                                                @if ($employee->other_document)
                                                    <a href="{{ asset('storage/' . $employee->other_document) }}"
                                                        target="_blank" class="btn btn-sm btn-outline-primary">عرض</a>
                                                @else
                                                    <span class="text-muted">غير مرفوعة</span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            {{-- الملاحظات --}}
                            <div class="accordion-item mt-2">
                                <h2 class="accordion-header" id="headingNotes">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseNotes" aria-expanded="false" aria-controls="collapseNotes">
                                        الملاحظات
                                    </button>
                                </h2>
                                <div id="collapseNotes" class="accordion-collapse collapse" aria-labelledby="headingNotes"
                                    data-bs-parent="#accordionDocsNotes">
                                    <div class="accordion-body">
                                        <div class="bg-light p-3 rounded border">
                                            {{ $employee->notes ?? 'لا توجد ملاحظات' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- أزرار الإجراءات --}}
                        <div class="text-end mt-4">
                            <a href="{{ route('employees.index') }}" class="btn btn-dark">
                                <i class="bi bi-arrow-right-circle"></i> رجوع للقائمة
                            </a>

                            <form id="deleteForm-{{ $employee->id }}"
                                action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger"
                                    onclick="confirmDelete({{ $employee->id }})">
                                    حذف
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('هل أنت متأكد أنك تريد حذف هذا الموظف؟')) {
                document.getElementById('deleteForm-' + id).submit();
            }
        }
    </script>
@endsection
