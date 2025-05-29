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
            width: auto;
            height: 1040px;
            overflow: hidden;
            margin: 0;
            padding: 0;
            position: relative;
            page-break-after: always; /* فصل الصفحات */
        }

        .page:last-child {
            page-break-after: auto; /* آخر صفحة ماتعملش فصل */
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
    </style>
</head>
<body>
   

    <!-- الصفحة الثانية -->
    <!-- اخطار بانتهاء اشتراك المؤمن عليه -->
    <div class="page">
        <img src="{{ public_path('pdfs/astmara6_1.jpg') }}" alt="Template 2" class="background">
        <div class="content">
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: -165px; right: 40px; font-size: 20px;">
                <p>{{ $employee->InsuranceOffice->name}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: -90px; right: 65px; font-size: 20px;">
                <p>{{ $employee->InsuranceOffice->number}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: -70px; right: 130px; font-size: 20px;">
                <p>{{ $employee->InsuranceOffice->register_number}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: -90px; right: 365px; font-size: 20px;">
                <p>{{ $employee->InsuranceOffice->Company}}</p>
            </div>
            <!-- بيانات المؤمن عليه -->
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 0px; right: 65px; font-size: 20px;">
                <p>{{ $employee->insurance_number}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 30px; right: 65px; font-size: 20px;">
                <p>{{ $employee->national_id}}</p>
            </div>
             <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 65px; right: 65px; font-size: 20px;">
                <p>{{ $employee->name}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 95px; right: 65px; font-size: 20px;">
                <p>{{$employee->name  }}</p>
            </div>

           
        </div>
    </div>
     <!-- الصفحة الأولى -->
    <div class="page">
        <img src="{{ public_path('pdfs/astmara6_2.jpg') }}" alt="Template 1" class="background">
        <div class="content">
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 210px; right: 85px; font-size: 18px;">
                <p>{{ $employee->InsuranceOffice->Company}}</p>
            </div>
             <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 235px; right: 85px; font-size: 18px;">
                <p>{{ $employee->InsuranceOffice->address}}</p>
            </div>
             <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 210px; right: 390px; font-size: 18px;">
                <p>{{ $employee->InsuranceOffice->number}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 250px; right: 125px; font-size: 18px;">
                <p>{{ $employee->name}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 250px; right: 390px; font-size: 18px;">
                <p>{{ $employee->insurance_number}}</p>
            </div>
           
        </div>
    </div>
</body>
</html>