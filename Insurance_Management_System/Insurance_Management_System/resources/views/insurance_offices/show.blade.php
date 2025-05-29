@extends('layouts')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        min-height: 100vh;
    }
    .card-container {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(8px);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    .card-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }
    .card-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: 0.5s;
    }
    .card-container:hover::before {
        left: 100%;
    }
    .card-header {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        font-weight: 700;
        padding: 15px 20px;
        border-bottom: none;
    }
    .card-body {
        padding: 25px;
    }
    .info-item {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .info-label {
        font-weight: 700;
        color: #2563eb;
        margin-bottom: 5px;
    }
    .info-value {
        font-size: 1.05rem;
        color: #333;
    }
    .btn {
        border-radius: 50px;
        font-weight: 600;
        padding: 10px 25px;
        transition: all 0.3s ease;
    }
    .btn-warning {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        border: none;
        color: #fff;
    }
    .btn-warning:hover {
        background: linear-gradient(135deg, #d97706, #f59e0b);
        transform: translateY(-2px);
    }
    .btn-secondary {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        border: none;
        color: #fff;
    }
    .btn-secondary:hover {
        background: linear-gradient(135deg, #4b5563, #374151);
        transform: translateY(-2px);
    }
    .section-title {
        font-weight: 700;
        color: #2563eb;
        margin: 25px 0 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
    }
    .accordion-button {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        font-weight: 600;
        border-radius: 10px !important;
        padding: 12px 20px;
    }
    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, #2563eb, #1e40af);
        color: white;
    }
    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
    }
    .accordion-body {
        background-color: #f8fafc;
        border-radius: 0 0 10px 10px;
    }
</style>

<div class="container py-5" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="mb-4 text-center text-dark fw-bold animate__animated animate__fadeInDown">
                <i class="fas fa-building me-2"></i> تفاصيل مكتب التأمين
            </h2>

            <div class="card-container animate__animated animate__fadeInUp">
                <div class="card-header">
                    <i class="fas fa-info-circle me-2"></i> بيانات مكتب التأمين
                </div>
                <div class="card-body">
                    {{-- البيانات الأساسية --}}
                    <h5 class="section-title">البيانات الأساسية</h5>
                    <div class="row g-3">
                        @php
                            $basicFields = [
                                'اسم المكتب' => $insuranceOffice->name ?? '—',
                                'رقم المكتب' => $insuranceOffice->number ?? '—',
                                'رقم التسجيل' => $insuranceOffice->register_number ?? '—',
                                'العنوان' => $insuranceOffice->address ?? '—',
                            ];
                        @endphp
                        @foreach ($basicFields as $label => $value)
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded border shadow-sm">
                                    <strong>{{ $label }}:</strong> {{ $value }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- التفاصيل الإضافية --}}
                    <h5 class="section-title mt-4">تفاصيل إضافية</h5>
                    <div class="row g-3">
                        @php
                            $additionalFields = [
                                'المنطقة' => $insuranceOffice->area ?? '—',
                                'المنطقة الإضافية' => $insuranceOffice->area2 ?? '—',
                                'المدينة' => $insuranceOffice->city ?? '—',
                                'ضابط الشرطة' => $insuranceOffice->police_officer ?? '—',
                                'المكتب' => $insuranceOffice->office ?? '—',
                                'الشركة' => $insuranceOffice->Company ?? '—',
                            ];
                        @endphp
                        @foreach ($additionalFields as $label => $value)
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded border shadow-sm">
                                    <strong>{{ $label }}:</strong> {{ $value }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- الملاحظات (اختياري، لو عايزة نضيف حقل ملاحظات) --}}
                    <div class="accordion mt-4" id="accordionNotes">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header" id="headingNotes">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseNotes" aria-expanded="false" aria-controls="collapseNotes">
                                    <i class="fas fa-sticky-note me-2"></i> الملاحظات
                                </button>
                            </h2>
                            <div id="collapseNotes" class="accordion-collapse collapse" aria-labelledby="headingNotes"
                                data-bs-parent="#accordionNotes">
                                <div class="accordion-body">
                                    <div class="bg-light p-3 rounded border shadow-sm">
                                        {{ $insuranceOffice->notes ?? 'لا توجد ملاحظات' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('insurance_offices.edit', $insuranceOffice->id) }}" class="btn btn-warning me-3">
                            <i class="fas fa-edit me-1"></i> تعديل
                        </a>
                        <a href="{{ route('insurance_offices.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> رجوع للقائمة
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection