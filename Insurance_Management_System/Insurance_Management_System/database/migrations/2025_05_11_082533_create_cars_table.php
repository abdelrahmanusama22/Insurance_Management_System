<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم السيارة
            $table->string('type'); // نوع السيارة
            $table->date('inspection_start'); // بداية الفحص
            $table->date('inspection_end'); // نهاية الفحص
            $table->year('manufacture_year'); // سنة الصنع
            $table->unsignedBigInteger('employee_id'); // الموظف المرتبط بالعربية
            $table->string('insurance_number'); // الرقم التأميني
            $table->string('insurance_number_driver')->nullable();  
            $table->string('location'); // الموقع
            $table->string('plate_number'); // رقم اللوحة
            $table->string('chassis_number'); // رقم الشاسيه
            $table->string('license_image_front')->nullable(); // صورة الرخصة (وش)
            $table->string('license_image_back')->nullable(); // صورة الرخصة (ضهر)
            $table->string('insurance_certificate')->nullable(); // شهادة الرخصة التأمينية
            $table->string('vehicle_category');
            $table->string('car_driver')->nullable(); // تباع السيارة
            $table->string('mileage'); // عدد الكيلومترات
            $table->timestamps();
    
            // الربط بجدول الموظفين
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
