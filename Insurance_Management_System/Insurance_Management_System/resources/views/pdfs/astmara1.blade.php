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
    <div class="page">
        <img src="{{ public_path('pdfs/astmara1_2.jpg') }}" alt="Template 2" class="background">
        <div class="content">
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: -170px; right: 0px; font-size: 20px;">
                <p>{{ $employee->InsuranceOffice->name}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: -45px; right: 78px; font-size: 20px;">
                <p>{{ $employee->InsuranceOffice->number}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: -25px; right: 78px; font-size: 20px;">
                <p>{{ $employee->InsuranceOffice->Company}}</p>
            </div>
             <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 40px; right: 78px; font-size: 20px;">
                <p>{{ $employee->insurance_number}}</p>
            </div>
             <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 65px; right: 78px; font-size: 20px;">
                <p>{{ $employee->national_id}}</p>
            </div>
             <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 85px; right: 78px; font-size: 20px;">
                <p>{{ $employee->name}}</p>
            </div>
             <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 120px; right: 40px; font-size: 14px;">
                <p>{{ $employee->qualification}}</p>
            </div>
             <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 105px; right: 425px; font-size: 20px;">
                <p>{{ $employee->job_title}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 105px; right: 425px; font-size: 20px;">
                <p>{{ $employee->job_title}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 105px; right: 425px; font-size: 20px;">
                <p>{{ $employee->job_title}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 220px; right: 85px; font-size: 20px;">
                <p>450</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 220px; right: 260px; font-size: 20px;">
                <p>{{ $employee->insurance_salary}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 220px; right: 470px; font-size: 20px;">
                <p>{{ $employee->gross_salary}}</p>
            </div>
             <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 465px; right: 70px; font-size: 20px;">
                <p>{{ $employee->phone}}</p>
            </div>
        </div>
    </div>
     <!-- الصفحة الأولى -->
    <div class="page">
        <img src="{{ public_path('pdfs/astmara1_1.jpg') }}" alt="Template 1" class="background">
        <div class="content">
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 265px; right: 75px; font-size: 20px;">
                <p>{{ $employee->InsuranceOffice->Company}}</p>
            </div>
             <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 290px; right: 75px; font-size: 20px;">
                <p>{{ $employee->InsuranceOffice->address}}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: 270px; right: 415px; font-size: 20px;">
                <p>{{ $employee->InsuranceOffice->number}}</p>
            </div>
        </div>
    </div>
</body>
</html>