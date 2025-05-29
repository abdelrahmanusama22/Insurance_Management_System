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
    .form-label {
        font-weight: 600;
        color: #2563eb;
        margin-bottom: 8px;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #d1d5db;
        padding: 10px;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
    }
    .btn {
        border-radius: 50px;
        font-weight: 600;
        padding: 10px 25px;
        transition: all 0.3s ease;
    }
    .btn-success {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border: none;
        color: #fff;
    }
    .btn-success:hover {
        background: linear-gradient(135deg, #16a34a, #15803d);
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
    .invalid-feedback {
        font-size: 0.85rem;
        color: #dc2626;
    }
    .section-title {
        font-weight: 700;
        color: #2563eb;
        margin: 25px 0 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
    }
</style>

<div class="container py-5" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="mb-4 text-center text-dark fw-bold animate__animated animate__fadeInDown">
                <i class="fas fa-edit me-2"></i> تعديل مكتب التأمين
            </h2>

            <div class="card-container animate__animated animate__fadeInUp">
                <div class="card-header">
                    <i class="fas fa-building me-2"></i> بيانات مكتب التأمين
                </div>
                <div class="card-body">
                    <form action="{{ route('insurance_offices.update', $insuranceOffice->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">اسم المكتب <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $insuranceOffice->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="number" class="form-label">رقم المكتب <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number', $insuranceOffice->number) }}" required>
                                @error('number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="register_number" class="form-label">رقم التسجيل <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('register_number') is-invalid @enderror" id="register_number" name="register_number" value="{{ old('register_number', $insuranceOffice->register_number) }}" required>
                                @error('register_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">العنوان</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $insuranceOffice->address) }}">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="area" class="form-label">المنطقة</label>
                                <input type="text" class="form-control @error('area') is-invalid @enderror" id="area" name="area" value="{{ old('area', $insuranceOffice->area) }}">
                                @error('area')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="area2" class="form-label">المنطقة الإضافية</label>
                                <input type="text" class="form-control @error('area2') is-invalid @enderror" id="area2" name="area2" value="{{ old('area2', $insuranceOffice->area2) }}">
                                @error('area2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">المدينة</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $insuranceOffice->city) }}">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="police_officer" class="form-label">ضابط الشرطة</label>
                                <input type="text" class="form-control @error('police_officer') is-invalid @enderror" id="police_officer" name="police_officer" value="{{ old('police_officer', $insuranceOffice->police_officer) }}">
                                @error('police_officer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="office" class="form-label">المكتب</label>
                                <input type="text" class="form-control @error('office') is-invalid @enderror" id="office" name="office" value="{{ old('office', $insuranceOffice->office) }}">
                                @error('office')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="Company" class="form-label">الشركة</label>
                                <input type="text" class="form-control @error('Company') is-invalid @enderror" id="Company" name="Company" value="{{ old('Company', $insuranceOffice->Company) }}">
                                @error('Company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success me-3">
                                <i class="fas fa-save me-1"></i> حفظ التعديلات
                            </button>
                            <a href="{{ route('insurance_offices.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> رجوع
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // SweetAlert2 for success/error messages
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'تم بنجاح!',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            timer: 3000
        }).then(() => {
            window.location.href = '{{ route('insurance-offices.index') }}';
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'خطأ!',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    @endif
</script>

@endsection