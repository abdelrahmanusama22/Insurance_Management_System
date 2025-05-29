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

        .table {
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
        }

        .table thead th {
            background: linear-gradient(45deg, #343a40, #495057);
            color: white;
            font-weight: 600;
            border: none;
        }

        .table tbody tr {
            transition: background 0.2s ease, transform 0.2s ease;
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
            background: linear detal-gradient(45deg, #e0a800, #ffca2c);
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

        .pagination .page-link {
            border-radius: 50%;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: #007bff;
            color: white;
            transform: scale(1.1);
        }

        .pagination .page-item.active .page-link {
            background: #007bff;
            border-color: #007bff;
        }

        .animate__animated {
            animation-duration: 0.8s;
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card mb-4 animate__animated animate__fadeInDown">
                    <div class="card-body p-4">
                        {{-- رسائل التنبيه --}}
                        @if ($errors->has('file'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <div class="alert alert-danger alert-dismissible fade show animate__animated animate__shakeX"
                                    role="alert">
                                    <i class="fas fa-exclamation-triangle me-1"></i> {{ $errors->first('file') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- العنوان وأزرار التحكم --}}
                  <div class="row g-3 mt-4">
    <!-- استيراد ملف Excel -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title text-primary mb-3"><i class="fas fa-file-import me-2"></i>استيراد الموظفين</h5>
                <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="importFile" class="form-label">ملف Excel</label>
                        <input type="file" id="importFile" name="file" class="form-control form-control-sm" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-upload me-1"></i> استيراد
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- تصدير حسب الشركة -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title text-success mb-3"><i class="fas fa-building me-2"></i>تصدير حسب الشركة</h5>
                <form action="{{ route('exportemployee') }}" method="GET">
                    <div class="mb-2">
                        <label for="companyExport" class="form-label">اختر الشركة</label>
                        <select id="companyExport" name="registered_company" class="form-select form-select-sm">
                            <option value="الكل">الكل</option>
                            @foreach (App\Models\Employee::distinct()->pluck('registered_company') as $company)
                                @if ($company)
                                    <option value="{{ $company }}">{{ $company }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-download me-1"></i> تصدير
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- تصدير حسب مكتب التأمين -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title text-warning mb-3"><i class="fas fa-shield-alt me-2"></i>تصدير حسب مكتب التأمين</h5>
                <form action="{{ route('exportemployee') }}" method="GET">
                    <div class="mb-2">
                        <label for="officeExport" class="form-label">اختر المكتب</label>
                        <select id="officeExport" name="insurance_office_id" class="form-select form-select-sm">
                            <option value="الكل">الكل</option>
                            @foreach (\App\Models\InsuranceOffice::all() as $office)
                                <option value="{{ $office->id }}">{{ $office->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 text-white">
                        <i class="fas fa-download me-1"></i> تصدير
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

                        <div class="table-responsive">
                            <table class="table table-hover text-center align-middle">
                                <thead>
                                    <tr>
                                        <th>رقم الساب</th>
                                        <th>الاسم</th>
                                        <th>الإدارة</th>
                                        <th>الوظيفة</th>
                                        <th>مكتب التأمين</th>
                                        <th>الفرع</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($employees as $employee)
                                                                           <tr>

                                            <td>{{ $employee->sap_number }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->department }}</td>
                                            <td>{{ $employee->job_title }}</td>
                                            <td>{{ $employee->insuranceOffice->name }}</td>
                                            <td>{{ $employee->branch }}</td>

                                            <td>
                                                <a href="{{ route('employees.show', $employee->id) }}"
                                                    class="btn btn-sm btn-info me-1">
                                                    <i class="fas fa-eye"></i> عرض
                                                </a>
                                                <a href="{{ route('employees.edit', $employee->id) }}"
                                                    class="btn btn-sm btn-warning me-1">
                                                    <i class="fas fa-pencil-alt"></i> تعديل
                                                </a>
                                                <a href="{{ route('employees.pdf', $employee->id) }}"
                                                    class="btn btn-sm btn-primary" target="_blank">
                                                    <i class="fas fa-file-pdf"></i> اخلاء طرف
                                                </a>
                                                <a href="{{ route('employees_astkala.pdf', $employee->id) }}"
                                                    class="btn btn-sm btn-primary" target="_blank">
                                                    <i class="fas fa-file-pdf"></i>  أستقاله
                                                </a>
                                                 <a href="{{ route('employees_astmara1.pdf', $employee->id) }}"
                                                    class="btn btn-sm btn-primary" target="_blank">
                                                    <i class="fas fa-file-pdf"></i>  أستماره 1
                                                </a>
                                                <a href="{{ route('employees_astmara6.pdf', $employee->id) }}"
                                                    class="btn btn-sm btn-primary" target="_blank">
                                                    <i class="fas fa-file-pdf"></i>  أستماره 6
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-muted py-4">
                                                <i class="fas fa-exclamation-circle me-2"></i> لا يوجد موظفين حالياً.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4 animate__animated animate__fadeInUp">
                            {{ $employees->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dependencies -->
   
    <script>
        function confirmDelete(employeeId) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: 'حذف الموظف لا يمكن التراجع عنه!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء',
                customClass: {
                    confirmButton: 'btn btn-danger me-2',
                    cancelButton: 'btn btn-outline-secondary'
                },
                buttonsStyling: false,
                showClass: {
                    popup: 'animate__animated animate__zoomIn'
                },
                hideClass: {
                    popup: 'animate__animated animate__zoomOut'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteForm-${employeeId}`).submit();
                    Swal.fire({
                        title: 'تم الحذف!',
                        text: 'تم حذف الموظف بنجاح.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false,
                        showClass: {
                            popup: 'animate__animated animate__fadeIn'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOut'
                        }
                    });
                }
            });
        }
    </script>
@endsection
