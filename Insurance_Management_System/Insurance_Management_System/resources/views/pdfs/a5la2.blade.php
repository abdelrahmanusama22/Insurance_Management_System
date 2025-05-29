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

        
    </style>
</head>
<body>
    <div class="page">
        <!-- صورة الخلفية -->
        <img src="{{ public_path('pdfs/a5la2.jpg') }}" alt="Template" class="background">

        <!-- المحتوى -->
        <div class="content">
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: -80px; right: 205px; font-size: 13px;">
                <p>{{ $employee->name }}</p>
            </div>
            <div style="display: flex; justify-content: space-between; width: 300px; position: absolute; top: -80px; right: 433px; font-size: 13px;">
                <p>{{ $employee->job_title }}</p>
            </div>
            </div>
        </div>
    
</body>
</html>