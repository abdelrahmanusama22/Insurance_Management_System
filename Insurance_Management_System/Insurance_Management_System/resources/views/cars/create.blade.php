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

        .btn-success {
            background: linear-gradient(45deg, #28a745, #34c759);
            border: none;
            padding: 10px 25px;
            font-weight: bold;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: linear-gradient(45deg, #218838, #2ba94c);
            transform: scale(1.05);
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card p-4 animate__animated animate__fadeInDown">
                    <h2 class="mb-4 fw-bold text-center text-dark">إضافة سيارة جديدة</h2>

                    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>اسم السيارة</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>نوع السيارة</label>
                                <input type="text" name="type" class="form-control" value="{{ old('type') }}">
                                @error('type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="vehicle_category" class="form-label">نوع النقل</label>
                                <select name="vehicle_category" id="vehicle_category" class="form-control">
                                    <option value="">-- اختر النوع --</option>
                                    <option value="ملاكي" {{ old('vehicle_category') == 'ملاكي' ? 'selected' : '' }}>ملاكي
                                    </option>
                                    <option value="نقل تقيل" {{ old('vehicle_category') == 'نقل تقيل' ? 'selected' : '' }}>
                                        نقل تقيل</option>
                                </select>
                                @error('vehicle_category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>رقم الشاسيه</label>
                                <input type="text" name="chassis_number" class="form-control"
                                    value="{{ old('chassis_number') }}">
                                @error('chassis_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3" id="car_driver_wrapper" style="display: none;">
                                <label>اسم التباع</label>
                                <select name="car_driver" class="form-control">
                                    <option value="">اختر تباع</option>
                                    @foreach ($employees as $employee)
                                        @if ($employee->job_title == 'تباع')
                                            <option value="{{ $employee->name }}"
                                                data-insurance="{{ $employee->insurance_number }}"
                                                {{ old('car_driver') == $employee->name ? 'selected' : '' }}>
                                                {{ $employee->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('car_driver')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3" id="insurance_number_wrapper" style="display: none;">
                                <label>الرقم التأمينى للتباع</label>
                                <input type="text" name="insurance_number_driver" id="insuranceNumberDriver"
                                    class="form-control" value="{{ old('insurance_number_driver') }}">
                                @error('insurance_number_driver')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-3">
                                <label>كيلومترات السياره</label>
                                <input type="text" name="mileage" class="form-control" value="{{ old('mileage') }}">
                                @error('mileage')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>تاريخ بداية الفحص</label>
                                <input type="date" name="inspection_start" class="form-control"
                                    value="{{ old('inspection_start') }}">
                                @error('inspection_start')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>تاريخ نهاية الفحص</label>
                                <input type="date" name="inspection_end" class="form-control"
                                    value="{{ old('inspection_end') }}">
                                @error('inspection_end')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>سنة الصنع</label>
                                <input type="number" name="manufacture_year" class="form-control"
                                    value="{{ old('manufacture_year') }}">
                                @error('manufacture_year')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>اسم الموظف</label>
                                <select name="employee_id" class="form-control" id="employeeSelect">
                                    <option value="">اختر موظف</option>
                                    @foreach ($employees as $employee)
                                        @if ($employee->job_title != 'تباع')
                                            <option value="{{ $employee->id }}"
                                                data-insurance="{{ $employee->insurance_number }}">
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
                                <input type="text" name="insurance_number" id="insuranceNumber" class="form-control"
                                    value="{{ old('insurance_number') }}" readonly>
                                @error('insurance_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>الموقع الخاص بالسيارة</label>
                                <input type="text" name="location" class="form-control" value="{{ old('location') }}">
                                @error('location')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>رقم اللوحة</label>
                                <input type="text" name="plate_number" class="form-control"
                                    value="{{ old('plate_number') }}">
                                @error('plate_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>صورة الرخصة (الوجه)</label>
                                <input type="file" name="license_image_front" class="form-control">
                                @error('license_image_front')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>صورة الرخصة (الظهر)</label>
                                <input type="file" name="license_image_back" class="form-control">
                                @error('license_image_back')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>شهادة الرخصة التأمينية</label>
                                <input type="file" name="insurance_certificate" class="form-control">
                                @error('insurance_certificate')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus-circle me-2"></i> إضافة السيارة

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
        });
        document.getElementById('employeeSelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const insuranceNumber = selectedOption.getAttribute('data-insurance');

            document.getElementById('insuranceNumber').value = insuranceNumber || '';
        });
        document.querySelector('select[name="car_driver"]').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const insuranceNumber = selectedOption.getAttribute('data-insurance');

            // تعيين الرقم التأميني في الحقل تلقائيًا
            document.getElementById('insuranceNumberDriver').value = insuranceNumber || '';
        });
    </script>
   
@endsection
