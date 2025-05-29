@extends('layouts')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
        background-attachment: fixed;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 10%, transparent 10%);
        background-size: 30px 30px;
        opacity: 0.3;
        z-index: -1;
    }

    .card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(5px);
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .btn-primary {
        background: linear-gradient(45deg, #1e3a8a, #3b82f6);
        border: none;
        padding: 10px 25px;
        font-weight: bold;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #1e40af, #2563eb);
        transform: scale(1.05);
    }

    .btn-outline-secondary {
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        transform: scale(1.05);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card p-4 animate__animated animate__fadeInDown">
                <h2 class="mb-4 fw-bold text-center text-dark">تعديل بيانات السيارة</h2>

                <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" id="updateCarForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>اسم السيارة</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $car->name) }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>نوع السيارة</label>
                            <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $car->type) }}">
                            @error('type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="vehicle_category" class="form-label">نوع النقل</label>
                            <select name="vehicle_category" id="vehicle_category" class="form-control @error('vehicle_category') is-invalid @enderror">
                                <option value="">-- اختر النوع --</option>
                                <option value="ملاكي" {{ old('vehicle_category', $car->vehicle_category) == 'ملاكي' ? 'selected' : '' }}>ملاكي</option>
                                <option value="نقل تقيل" {{ old('vehicle_category', $car->vehicle_category) == 'نقل تقيل' ? 'selected' : '' }}>نقل تقيل</option>
                            </select>
                            @error('vehicle_category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>رقم الشاسيه</label>
                            <input type="text" name="chassis_number" class="form-control @error('chassis_number') is-invalid @enderror" value="{{ old('chassis_number', $car->chassis_number) }}">
                            @error('chassis_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3" id="car_driver_wrapper" style="display: {{ old('vehicle_category', $car->vehicle_category) == 'نقل تقيل' ? 'block' : 'none' }};">
                            <label>اسم التباع</label>
                            <select name="car_driver" class="form-control @error('car_driver') is-invalid @enderror">
                                <option value="">اختر تباع</option>
                                @foreach ($employees as $employee)
                                    @if ($employee->job_title == 'تباع')
                                        <option value="{{ $employee->name }}"
                                            data-insurance="{{ $employee->insurance_number }}"
                                            {{ old('car_driver', $car->car_driver) == $employee->name ? 'selected' : '' }}>
                                            {{ $employee->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('car_driver')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3" id="insurance_number_wrapper" style="display: {{ old('vehicle_category', $car->vehicle_category) == 'نقل تقيل' ? 'block' : 'none' }};">
                            <label>الرقم التأميني للتباع</label>
                            <input type="text" name="insurance_number_driver" id="insuranceNumberDriver" class="form-control @error('insurance_number_driver') is-invalid @enderror" value="{{ old('insurance_number_driver', $car->insurance_number_driver) }}">
                            @error('insurance_number_driver')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>كيلومترات السيارة</label>
                            <input type="text" name="mileage" class="form-control @error('mileage') is-invalid @enderror" value="{{ old('mileage', $car->mileage) }}">
                            @error('mileage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>تاريخ بداية الفحص</label>
                            <input type="date" name="inspection_start" class="form-control @error('inspection_start') is-invalid @enderror" value="{{ old('inspection_start', $car->inspection_start) }}">
                            @error('inspection_start')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>تاريخ نهاية الفحص</label>
                            <input type="date" name="inspection_end" class="form-control @error('inspection_end') is-invalid @enderror" value="{{ old('inspection_end', $car->inspection_end) }}">
                            @error('inspection_end')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>سنة الصنع</label>
                            <input type="number" name="manufacture_year" class="form-control @error('manufacture_year') is-invalid @enderror" value="{{ old('manufacture_year', $car->manufacture_year) }}">
                            @error('manufacture_year')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>اسم الموظف</label>
                            <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" id="employeeSelect">
                                <option value="">اختر موظف</option>
                                @foreach ($employees as $employee)
                                    @if ($employee->job_title != 'تباع')
                                        <option value="{{ $employee->id }}"
                                            data-insurance="{{ $employee->insurance_number }}"
                                            {{ old('employee_id', $car->employee_id) == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('employee_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>الرقم التأميني</label>
                            <input type="text" name="insurance_number" id="insuranceNumber" class="form-control @error('insurance_number') is-invalid @enderror" value="{{ old('insurance_number', $car->insurance_number) }}" readonly>
                            @error('insurance_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>الموقع الخاص بالسيارة</label>
                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $car->location) }}">
                            @error('location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>رقم اللوحة</label>
                            <input type="text" name="plate_number" class="form-control @error('plate_number') is-invalid @enderror" value="{{ old('plate_number', $car->plate_number) }}">
                            @error('plate_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>صورة الرخصة (الوجه)</label>
                            <input type="file" name="license_image_front" class="form-control @error('license_image_front') is-invalid @enderror">
                            @if ($car->license_image_front)
                                <small class="text-muted mt-1 d-block">
                                    <i class="fas fa-image me-1"></i> الصورة الحالية:
                                    <a href="{{ asset('storage/' . $car->license_image_front) }}" target="_blank">عرض</a>
                                </small>
                            @endif
                            @error('license_image_front')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>صورة الرخصة (الظهر)</label>
                            <input type="file" name="license_image_back" class="form-control @error('license_image_back') is-invalid @enderror">
                            @if ($car->license_image_back)
                                <small class="text-muted mt-1 d-block">
                                    <i class="fas fa-image me-1"></i> الصورة الحالية:
                                    <a href="{{ asset('storage/' . $car->license_image_back) }}" target="_blank">عرض</a>
                                </small>
                            @endif
                            @error('license_image_back')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>شهادة الرخصة التأمينية</label>
                            <input type="file" name="insurance_certificate" class="form-control @error('insurance_certificate') is-invalid @enderror">
                            @if ($car->insurance_certificate)
                                <small class="text-muted mt-1 d-block">
                                    <i class="fas fa-file-alt me-1"></i> المستند الحالي:
                                    <a href="{{ asset('storage/' . $car->insurance_certificate) }}" target="_blank">عرض</a>
                                </small>
                            @endif
                            @error('insurance_certificate')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary me-2">
                            <i class="fas fa-times me-2"></i> إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> تحديث السيارة
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const vehicleCategory = document.getElementById("vehicle_category");
        const carDriverWrapper = document.getElementById("car_driver_wrapper");
        const insuranceNumberWrapper = document.getElementById("insurance_number_wrapper");

        function toggleCarDriver() {
            if (vehicleCategory.value === "نقل تقيل") {
                carDriverWrapper.style.display = "block";
                insuranceNumberWrapper.style.display = "block";
            } else {
                carDriverWrapper.style.display = "none";
                insuranceNumberWrapper.style.display = "none";
            }
        }

        vehicleCategory.addEventListener("change", toggleCarDriver);

        // Call once on load to set initial state
        toggleCarDriver();

        // Trigger insurance number update on page load
        const employeeSelect = document.getElementById('employeeSelect');
        const selectedEmployeeOption = employeeSelect.options[employeeSelect.selectedIndex];
        if (selectedEmployeeOption) {
            document.getElementById('insuranceNumber').value = selectedEmployeeOption.getAttribute('data-insurance') || '';
        }

        const carDriverSelect = document.querySelector('select[name="car_driver"]');
        const selectedDriverOption = carDriverSelect.options[carDriverSelect.selectedIndex];
        if (selectedDriverOption) {
            document.getElementById('insuranceNumberDriver').value = selectedDriverOption.getAttribute('data-insurance') || '';
        }
    });

    document.getElementById('employeeSelect').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const insuranceNumber = selectedOption.getAttribute('data-insurance');
        document.getElementById('insuranceNumber').value = insuranceNumber || '';
    });

    document.querySelector('select[name="car_driver"]').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const insuranceNumber = selectedOption.getAttribute('data-insurance');
        document.getElementById('insuranceNumberDriver').value = insuranceNumber || '';
    });
</script>
<script>
    // SweetAlert2 confirmation
    document.getElementById('updateCarForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'تأكيد التحديث',
            text: 'هل أنت متأكد من تحديث بيانات السيارة؟',
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