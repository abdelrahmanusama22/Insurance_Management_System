@extends('layouts')

@section('content')
<style>
    .table-container {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        margin-bottom: 2rem;
    }
    .table thead th {
        background: linear-gradient(45deg, #1e3a8a, #3b82f6);
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
    }
    .table tbody tr:hover {
        background: #f1f5f9;
    }
    .card-header {
        background-color: #f8fafc;
        border-bottom: 1px solid #e1e7ec;
        border-radius: 12px 12px 0 0;
    }
    h2.section-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #1e3a8a;
    }
    .chart-container {
        max-width: 100%;
        margin: 2rem auto;
        padding: 1rem;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }
    canvas {
        max-height: 400px;
    }
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }
    @media (max-width: 768px) {
        .table-container, .chart-container {
            margin: 1rem;
        }
        h2.section-title {
            font-size: 1.2rem;
        }
    }
</style>

<div class="container py-5">
    <!-- إحصائيات حسب مكتب التأمين -->
    <div class="card shadow-lg table-container animate__animated animate__fadeInUp">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h2 class="mb-0 section-title"><i class="bi bi-geo-alt-fill me-2"></i>إحصائيات حسب مكتب التأمين</h2>
        </div>
        <div class="card-body">
            @if(count($insuranceOfficeStats) > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>مكتب التأمين</th>
                                <th>عدد الموظفين</th>
                                <th>مجموع حصة الموظف</th>
                                <th>مجموع حصة الشركة</th>
                                <th>إجمالي التأمين</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($insuranceOfficeStats as $stat)
                                <tr>
                                    <td>{{ $stat->insurance_office ?? 'غير محدد' }}</td>
                                    <td>{{ $stat->employee_count }}</td>
                                    <td>{{ number_format($stat->total_employee_share, 2) }} ج.م</td>
                                    <td>{{ number_format($stat->total_employer_share, 2) }} ج.م</td>
                                    <td>{{ number_format($stat->total_insurance_sum, 2) }} ج.م</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- مخطط عمودي لإحصائيات مكاتب التأمين -->
                <div class="chart-container">
                    <canvas id="insuranceOfficeChart"></canvas>
                </div>
            @else
                <div class="alert alert-info text-center">لا توجد بيانات متاحة حالياً.</div>
            @endif
        </div>
    </div>

    <!-- إحصائيات حسب الشركة -->
    <div class="card shadow-lg table-container animate__animated animate__fadeInUp animate__delay-1s">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h2 class="mb-0 section-title"><i class="bi bi-buildings-fill me-2"></i>إحصائيات حسب الشركة</h2>
        </div>
        <div class="card-body">
            @if(count($companyStats) > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>اسم الشركة</th>
                                <th>عدد الموظفين</th>
                                <th>مجموع حصة الموظف</th>
                                <th>مجموع حصة الشركة</th>
                                <th>إجمالي التأمين</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companyStats as $stat)
                                <tr>
                                    <td>{{ $stat->registered_company ?? 'غير محددة' }}</td>
                                    <td>{{ $stat->employee_count }}</td>
                                    <td>{{ number_format($stat->total_employee_share, 2) }} ج.م</td>
                                    <td>{{ number_format($stat->total_employer_share, 2) }} ج.م</td>
                                    <td>{{ number_format($stat->total_insurance_sum, 2) }} ج.م</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- مخطط دائري لإحصائيات الشركات -->
                <div class="chart-container">
                    <canvas id="companyChart"></canvas>
                </div>
            @else
                <div class="alert alert-info text-center">لا توجد بيانات متاحة حالياً.</div>
            @endif
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<!-- تضمين مكتبة Chart.js -->
<script>
    // مخطط مكاتب التأمين (Bar Chart)
    @if(count($insuranceOfficeStats) > 0)
        const insuranceOfficeCtx = document.getElementById('insuranceOfficeChart').getContext('2d');
        new Chart(insuranceOfficeCtx, {
            type: 'bar',
            data: {
                labels: [@foreach($insuranceOfficeStats as $stat)'{{ $stat->insurance_office ?? 'غير محدد' }}', @endforeach],
                datasets: [
                    {
                        label: 'عدد الموظفين',
                        data: [@foreach($insuranceOfficeStats as $stat){{ $stat->employee_count }}, @endforeach],
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'حصة الموظف (ج.م)',
                        data: [@foreach($insuranceOfficeStats as $stat){{ $stat->total_employee_share }}, @endforeach],
                        backgroundColor: 'rgba(16, 185, 129, 0.5)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'حصة الشركة (ج.م)',
                        data: [@foreach($insuranceOfficeStats as $stat){{ $stat->total_employer_share }}, @endforeach],
                        backgroundColor: 'rgba(245, 158, 11, 0.5)',
                        borderColor: 'rgba(245, 158, 11, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'إجمالي التأمين (ج.م)',
                        data: [@foreach($insuranceOfficeStats as $stat){{ $stat->total_insurance_sum }}, @endforeach],
                        backgroundColor: 'rgba(236, 72, 153, 0.5)',
                        borderColor: 'rgba(236, 72, 153, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'إحصائيات مكاتب التأمين'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'القيمة'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'مكتب التأمين'
                        }
                    }
                }
            }
        });
    @endif

    // مخطط الشركات (Pie Chart)
    @if(count($companyStats) > 0)
        const companyCtx = document.getElementById('companyChart').getContext('2d');
        new Chart(companyCtx, {
            type: 'pie',
            data: {
                labels: [@foreach($companyStats as $stat)'{{ $stat->registered_company ?? 'غير محددة' }}', @endforeach],
                datasets: [{
                    label: 'عدد الموظفين',
                    data: [@foreach($companyStats as $stat){{ $stat->employee_count }}, @endforeach],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(236, 72, 153, 0.7)',
                        'rgba(139, 92, 246, 0.7)',
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(249, 115, 22, 0.7)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(236, 72, 153, 1)',
                        'rgba(139, 92, 246, 1)',
                        'rgba(34, 197, 94, 1)',
                        'rgba(249, 115, 22, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'توزيع الموظفين حسب الشركة'
                    }
                }
            }
        });
    @endif
</script>

@endsection