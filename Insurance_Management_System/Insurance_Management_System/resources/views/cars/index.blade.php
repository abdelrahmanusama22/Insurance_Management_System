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
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .table thead th {
            background: linear-gradient(45deg, #343a40, #495057);
            color: white;
            font-weight: 600;
            border: none;
        }

        .table tbody tr:hover {
            background: #f1faff;
            transform: scale(1.01);
        }

        .btn {
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success {
            background: linear-gradient(45deg, #28a745, #34c759);
            border: none;
            padding: 10px 25px;
        }

        .btn-success:hover {
            background: linear-gradient(45deg, #218838, #2ba94c);
            transform: scale(1.05);
        }

        .btn-info {
            background: linear-gradient(45deg, #17a2b8, #2bc4de);
            border: none;
        }

        .btn-info:hover {
            background: linear-gradient(45deg, #138496, #1a9cb7);
            transform: scale(1.05);
        }

        .btn-warning {
            background: linear-gradient(45deg, #ffc107, #ffd750);
            border: none;
        }

        .btn-warning:hover {
            background: linear-gradient(45deg, #e0a800, #ffca2c);
            transform: scale(1.05);
        }

        .btn-danger {
            background: linear-gradient(45deg, #dc3545, #ff5767);
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(45deg, #c82333, #e03e4d);
            transform: scale(1.05);
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card mb-4 animate__animated animate__fadeInDown">
                    <div class="card-body p-4">
                        <div class="container mt-4">
                            <div class="row align-items-center mb-4">
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <h2 class="text-dark fw-bold">
                                        <i class="fas fa-car-side me-2"></i> قائمة السيارات
                                    </h2>
                                </div>

                                <div class="col-md-4 mb-2 mb-md-0 text-md-center text-start">
                                    <a href="{{ route('cars.create') }}"
                                        class="btn btn-success w-100 animate__animated animate__pulse animate__infinite">
                                        <i class="fas fa-plus-circle me-1"></i> إضافة سيارة جديدة
                                    </a>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <form action="{{ route('cars.export') }}" method="GET" class="card p-3 shadow-sm">
                                        @csrf
                                        <h5 class="mb-3 text-dark fw-bold">
                                            <i class="fas fa-file-export me-2 text-primary"></i> تصدير البيانات
                                        </h5>
                                        <div class="mb-3">
                                            <label for="vehicle_category" class="form-label">اختر نوع السيارة:</label>
                                            <select name="vehicle_category" id="vehicle_category" class="form-select">
                                                <option value="">-- اختر النوع --</option>
                                                <option value="all">الكل</option>
                                                <option value="ملاكي">ملاكي</option>
                                                <option value="نقل تقيل">نقل تقيل</option>
                                                <!-- أضف أنواع أخرى هنا -->
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-download me-1"></i> تصدير
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <form action="{{ route('cars.import') }}" method="POST" enctype="multipart/form-data"
                                        class="card p-3 shadow-sm">
                                        @csrf
                                        <h5 class="mb-3 text-dark fw-bold">
                                            <i class="fas fa-file-import me-2 text-success"></i> استيراد البيانات
                                        </h5>
                                        <div class="mb-3">
                                            <label for="file" class="form-label">اختر ملف Excel:</label>
                                            <input type="file" name="file" id="file" class="form-control"
                                                accept=".xls,.xlsx" required>
                                        </div>
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="fas fa-upload me-1"></i> استيراد
                                        </button>
                                    </form>
                                </div>


                            </div>
                            <!-- استبدلي الـ session messages الحالية بالكود ده -->
                            <div class="mb-4">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn"
                                        role="alert">
                                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn"
                                        role="alert">
                                        <i class="fas fa-exclamation-circle me-2"></i> حدثت أخطاء أثناء الاستيراد:
                                        <ul class="mb-0 mt-2" style="padding-right: 20px;">
                                            @foreach (explode(' | ', session('error')) as $error)
                                                @if (trim($error) !== 'تم استيراد بعض السجلات، لكن حدثت الأخطاء التالية:')
                                                    <li>{{ $error }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-hover text-center align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم السيارة</th>
                                        <th>نوع السيارة</th>
                                        <th>اسم الموظف</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cars as $car)
                                        <tr class="animate__animated animate__fadeInUp"
                                            style="animation-delay: {{ $loop->iteration * 0.1 }}s;">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $car->name }}</td>
                                            <td>{{ $car->type }}</td>
                                            <td>{{ $car->employee->name }}</td>
                                            <td>
                                                <a href="{{ route('cars.show', $car->id) }}"
                                                    class="btn btn-sm btn-info me-1">
                                                    <i class="fas fa-eye"></i> عرض
                                                </a>
                                                <a href="{{ route('cars.edit', $car->id) }}"
                                                    class="btn btn-sm btn-warning me-1">
                                                    <i class="fas fa-pencil-alt"></i> تعديل
                                                </a>
                                                <form action="{{ route('cars.destroy', $car->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i> حذف
                                                    </button>
                                                </form>

                                                <a href="{{ route('cars.pdf', $car->id) }}" class="btn btn-sm btn-primary"
                                                    target="_blank">
                                                    <i class="fas fa-file-pdf"></i> شهادة تأمين سيدى جابر
                                                </a>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-muted py-4">
                                                <i class="fas fa-exclamation-circle me-2"></i> لا يوجد سيارات حالياً.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4 animate__animated animate__fadeInUp">
                            {{ $cars->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
