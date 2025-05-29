<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'نظام الموظفين')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Animate.css CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    {{-- Custom CSS --}}
    <style>
        body {
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        .navbar {
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.85));
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: 700;
            color: #007bff !important;
            font-size: 1.5rem;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        .navbar-brand:hover {
            color: #0056b3 !important;
            transform: scale(1.05);
        }
        .nav-link {
            color: #2c3e50 !important;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            background: linear-gradient(45deg, #007bff, #00d4ff);
            color: white !important;
            transform: translateY(-2px);
        }
        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            animation: dropdownFadeIn 0.3s ease;
        }
        .dropdown-item {
            color: #2c3e50;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .dropdown-item:hover {
            background: #007bff;
            color: white !important;
        }
        .navbar-toggler {
            border: none;
            padding: 10px;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0, 123, 255, 0.75)' style='width: 10px; height: 10px' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        .btn-logout {
            background: linear-gradient(45deg, #dc3545, #ff5767);
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            color: white !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            background: linear-gradient(45deg, #c82333, #e03e4d);
            transform: scale(1.05);
        }
        @keyframes dropdownFadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .navbar-nav-centered {
            display: flex;
            justify-content: center;
            flex-grow: 1;
        }
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.95);
                border-radius: 10px;
                margin-top: 10px;
                padding: 15px;
            }
            .nav-link {
                margin: 5px 0;
            }
            .navbar-nav-centered {
                justify-content: flex-start;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg animate__animated animate__fadeInDown">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-users-cog me-2"></i> نظام الموظفين
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav navbar-nav-centered mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('employees.index') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                            <i class="fas fa-users me-1"></i> قائمة الموظفين
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('employees.create') ? 'active' : '' }}" href="{{ route('employees.create') }}">
                            <i class="fas fa-user-plus me-1"></i> إضافة موظف
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cars.index') ? 'active' : '' }}" href="{{ route('cars.index') }}">
                            <i class="fas fa-car me-1"></i> قائمة السيارات
                        </a>
                    </li>
                   <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('cars.create') ? 'active' : '' }}" href="{{ route('cars.create') }}">
        <i class="fas fa-car me-1"></i><span class="text-success fw-bold"> +</span> إضافة سيارة
    </a>
</li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('insurance_offices.index') ? 'active' : '' }}" href="{{ route('insurance_offices.index') }}">
                            <i class="fas fa-building me-1"></i> قائمه مكتب تأمين
                        </a>
                    </li>

                     <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('insurance_offices.create') ? 'active' : '' }}" href="{{ route('insurance_offices.create') }}">
                            <i class="fas fa-plus me-1"></i> إضافة مكتب تأمين
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('labor.stats') ? 'active' : '' }}" href="{{ route('labor.stats') }}">
                            <i class="fas fa-chart-bar me-1"></i> احصائيات التأمينات
                        </a>
                    </li>
                </ul>
                 <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name ?? 'المستخدم' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-cog me-2"></i> الإعدادات</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item btn-logout">
                                        <i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="py-5">
        @yield('content')
    </main>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
    


</body>
</html>
