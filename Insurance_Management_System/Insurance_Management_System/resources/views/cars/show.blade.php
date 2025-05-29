@extends('layouts')

@section('content')

<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    .card-header {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        font-weight: 700;
        border-bottom: none;
        padding: 15px 20px;
    }
    .info-item {
        margin-bottom: 15px;
        padding: 12px 15px;
        background-color: #f8fafc;
        border-radius: 8px;
        border-left: 4px solid #3b82f6;
    }
    .info-label {
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 5px;
    }
    .info-value {
        font-size: 1.05rem;
        color: #1f2937;
    }
    .section-title {
        font-weight: 700;
        color: #2563eb;
        margin: 25px 0 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
    }
    .alert-expired {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #dc2626;
        border-radius: 10px;
        padding: 15px;
        font-weight: 600;
    }
    .countdown-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
    }
    .countdown-item {
        text-align: center;
        min-width: 80px;
        padding: 12px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .countdown-item span {
        display: block;
        font-size: 1.8rem;
        font-weight: 700;
    }
    .countdown-item small {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    .document-btn {
        border-radius: 50px;
        padding: 8px 15px;
        font-size: 0.85rem;
    }
    .btn-edit {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        border: none;
        color: white;
        font-weight: 600;
    }
    .btn-edit:hover {
        background: linear-gradient(135deg, #d97706, #f59e0b);
    }
    .accordion-button {
        font-weight: 600;
        padding: 12px 20px;
    }
    .accordion-button:not(.collapsed) {
        background-color: #f8fafc;
        color: #2563eb;
    }
</style>

<div class="container py-4" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="text-center mb-4 text-dark fw-bold animate__animated animate__fadeInDown">
                <i class="fas fa-car me-2"></i> تفاصيل السيارة
            </h2>

            <!-- المعلومات الأساسية -->
            <div class="card animate__animated animate__fadeInUp">
                <div class="card-header">
                    <i class="fas fa-info-circle me-2"></i> المعلومات الأساسية
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">اسم السيارة:</div>
                                <div class="info-value">{{ $car->name }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">النوع:</div>
                                <div class="info-value">{{ $car->type }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">سنة الصنع:</div>
                                <div class="info-value">{{ $car->manufacture_year }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">اسم الموظف المسؤول:</div>
                                <div class="info-value">{{ $car->employee->name }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">فئة المركبة:</div>
                                <div class="info-value">{{ $car->vehicle_category }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">الموقع:</div>
                                <div class="info-value">{{ $car->location }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- أرقام التعريف -->
            <div class="card animate__animated animate__fadeInUp">
                <div class="card-header">
                    <i class="fas fa-id-card me-2"></i> أرقام التعريف
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">رقم اللوحة:</div>
                                <div class="info-value">{{ $car->plate_number }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">رقم الشاسيه:</div>
                                <div class="info-value">{{ $car->chassis_number }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- بيانات التأمين -->
            <div class="card animate__animated animate__fadeInUp">
                <div class="card-header">
                    <i class="fas fa-shield-alt me-2"></i> بيانات التأمين
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">رقم التأمين:</div>
                                <div class="info-value">{{ $car->insurance_number }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">اسم التباع:</div>
                                <div class="info-value">{{ $car->car_driver }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">الرقم التأميني (التباع):</div>
                                <div class="info-value">{{ $car->insurance_number_driver }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">الرقم التأميني (السائق):</div>
                                <div class="info-value">{{ $car->insurance_number }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- الفحص والموقع -->
            <div class="card animate__animated animate__fadeInUp">
                <div class="card-header">
                    <i class="fas fa-calendar-check me-2"></i> مواعيد الفحص
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <div class="info-label">تاريخ الفحص:</div>
                        <div class="info-value">من {{ $car->inspection_start }} إلى {{ $car->inspection_end }}</div>
                    </div>
                    
                    @if($remainingDays < 0)
                        <div class="alert-expired animate__animated animate__shakeX">
                            <i class="fas fa-exclamation-triangle me-2"></i> 
                            الترخيص منتهي منذ {{ abs($remainingDays) }} يوم
                        </div>
                    @else
                        <div class="countdown-container">
                            <div class="countdown-item">
                                <span>{{ $remainingDays }}</span>
                                <small>أيام متبقية</small>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- الوثائق المرفقة -->
            <div class="card animate__animated animate__fadeInUp">
                <div class="card-header">
                    <i class="fas fa-file-alt me-2"></i> الوثائق المرفقة
                </div>
                <div class="card-body">
                    <div class="accordion" id="documentsAccordion">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header" id="headingDocuments">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseDocuments" aria-expanded="false" aria-controls="collapseDocuments">
                                    <i class="fas fa-folder-open me-2"></i> عرض الوثائق
                                </button>
                            </h2>
                            <div id="collapseDocuments" class="accordion-collapse collapse" aria-labelledby="headingDocuments" 
                                data-bs-parent="#documentsAccordion">
                                <div class="accordion-body">
                                    @if ($car->license_image_front)
                                        <div class="info-item">
                                            <div class="info-label">الوجه الأمامي لرخصة السيارة:</div>
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/' . $car->license_image_front) }}" 
                                                   download class="btn btn-sm document-btn btn-outline-success me-2">
                                                    <i class="fas fa-download me-1"></i> تنزيل
                                                </a>
                                                <a href="{{ asset('storage/' . $car->license_image_front) }}" 
                                                   target="_blank" class="btn btn-sm document-btn btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i> عرض
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($car->license_image_back)
                                        <div class="info-item">
                                            <div class="info-label">الوجه الخلفي لرخصة السيارة:</div>
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/' . $car->license_image_back) }}" 
                                                   download class="btn btn-sm document-btn btn-outline-success me-2">
                                                    <i class="fas fa-download me-1"></i> تنزيل
                                                </a>
                                                <a href="{{ asset('storage/' . $car->license_image_back) }}" 
                                                   target="_blank" class="btn btn-sm document-btn btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i> عرض
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($car->insurance_certificate)
                                        <div class="info-item">
                                            <div class="info-label">شهادة التأمين:</div>
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/' . $car->insurance_certificate) }}" 
                                                   download class="btn btn-sm document-btn btn-outline-success me-2">
                                                    <i class="fas fa-download me-1"></i> تنزيل
                                                </a>
                                                <a href="{{ asset('storage/' . $car->insurance_certificate) }}" 
                                                   target="_blank" class="btn btn-sm document-btn btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i> عرض
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    @unless ($car->license_image_front || $car->license_image_back || $car->insurance_certificate)
                                        <div class="text-center text-muted py-3">
                                            <i class="fas fa-exclamation-circle me-2"></i> لا توجد وثائق مرفقة
                                        </div>
                                    @endunless
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- أزرار التحكم -->
            <div class="d-flex justify-content-between mt-4 animate__animated animate__fadeInUp">
                <a href="{{ route('cars.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> رجوع للقائمة
                </a>
                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-edit">
                    <i class="fas fa-edit me-1"></i> تعديل البيانات
                </a>
            </div>
        </div>
    </div>
</div>

@endsection