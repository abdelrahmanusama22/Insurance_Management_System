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
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .table thead th {
            background: linear-gradient(45deg, #343a40, #495057);
            color: white;
            font-weight: bold;
        }

        .table tbody tr:hover {
            background: #f1faff;
        }

        .btn {
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(45deg, #007bff, #339cff);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #0056b3, #1d78d2);
            transform: scale(1.05);
        }

        .btn-warning {
            background: linear-gradient(45deg, #ffc107, #ffda57);
            border: none;
        }

        .btn-warning:hover {
            background: linear-gradient(45deg, #e0a800, #ffca2c);
            transform: scale(1.05);
        }

        .btn-danger {
            background: linear-gradient(45deg, #dc3545, #ff5c6b);
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(45deg, #c82333, #e83e4d);
            transform: scale(1.05);
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card animate__animated animate__fadeIn">
                    <div class="card-body">
                        {{-- العنوان وزر الإضافة --}}
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                            <h2 class="text-dark fw-bold"><i class="fas fa-building me-2"></i> مكاتب التأمين</h2>
                            <a href="{{ route('insurance_offices.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-1"></i> إضافة مكتب جديد
                            </a>
                        </div>

                        {{-- رسائل النجاح --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- جدول عرض المكاتب --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead>
                                    <tr>
                                        <th>الاسم</th>
                                        <th>الرقم التأميني</th>
                                        <th>رقم التسجيل</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($offices as $office)
                                        <tr>
                                            <td>{{ $office->name }}</td>
                                            <td>{{ $office->number }}</td>
                                            <td>{{ $office->register_number }}</td>
                                            <td>
                                                <a href="{{ route('insurance_offices.edit', $office->id) }}"
                                                    class="btn btn-warning me-1"><i class="fas fa-edit"></i> تعديل</a>
                                                <form action="{{ route('insurance_offices.destroy', $office->id) }}"
                                                    method="POST" class="d-inline-block"
                                                    onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> حذف</button>
                                                </form>
                                                <a href="{{ route('insurance_offices.show', $office->id) }}"
                                                    class="btn btn-info"><i class="fas fa-eye"></i> عرض التفاصيل</a>
                                                    
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">لا توجد مكاتب مسجلة حالياً.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div> {{-- card-body --}}
                </div> {{-- card --}}
            </div>
        </div>
    </div>
@endsection
