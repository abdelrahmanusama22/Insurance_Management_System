<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Car Report</title>
    <style>
        @font-face {
            font-family: 'Lateef';
            src: url('file:///C:/xampp/htdocs/Insurance_Management_System/public/fonts/Lateef-Regular.ttf') format('truetype');
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Lateef', sans-serif;
            direction: rtl;
            text-align: right;
        }

        .page {
            width: 800px;
            height: 1040px;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        img.background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .content {
            position: absolute;
            top: 2in;
            right: 1in;
            font-size: 14px;
            color: #000;
            z-index: 1;
        }

        .license-image {
            position: absolute;
            top: 300px;
            right: 20px;
            width: 300px;
            height: 200px;
            object-fit: cover;
            z-index: 99;
            border: 1px solid red; /* عشان نشوف المكان */
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- صورة الخلفية -->
        <img src="{{ public_path('pdfs/t2men.jpg') }}" alt="Template" class="background">

        <!-- المحتوى -->
        <div class="content">
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 130px; right: 20px; font-size: 16px;">
                <p>{{ $car->plate_number }}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 130px; right: 220px; font-size: 16px;">
                <p>{{ $car->vehicle_category }}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 180px; right: 20px; font-size: 16px;">
                <p>{{ $car->chassis_number }}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 170px; right: 220px; font-size: 16px;">
                <p>اسم التباع</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 190px; right: 220px; font-size: 16px;">
                <p>{{ $car->car_driver }}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 170px; right: 450px; font-size: 16px;">
                <p>الرقم التأمينى (التباع)</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 190px; right: 450px; font-size: 16px;">
                <p>{{ $car->insurance_number_driver }}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 225px; right: 30px; font-size: 16px;">
                <p>اسم السائق</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 245px; right: -20px; font-size: 16px;">
                <p>{{ $car->employee->name }}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 225px; right: 230px; font-size: 16px;">
                <p>الرقم التأمينى (السائق)</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 245px; right: 220px; font-size: 16px;">
                <p>{{ $car->insurance_number }}</p>
            </div>
            <!-- صورة الرخصة بتاعة الموظف (الوجه الأمامي) -->
           <div style="position: absolute; top: 300px; right: 200px; border: 1px solid blue;">
                @if ($car->employee && !empty($car->employee->license_image_front))
                    <img src="{{ storage_path('app/public/' . $car->employee->license_image_front) }}" 
                         alt="Employee License Front" 
                         class="license-image">
                @else
                    <p style="font-size: 16px; color: red;">لا توجد صورة رخصة للموظف</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>