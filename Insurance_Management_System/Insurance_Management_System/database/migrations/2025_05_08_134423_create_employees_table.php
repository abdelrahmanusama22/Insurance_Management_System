<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();

        // البيانات الأساسية للموظف
        $table->string('sap_number')->unique();         // رقم الساب
        $table->string('name');                         // الاسم
        $table->string('national_id')->nullable()->unique();        // الرقم القومي
        $table->string('department');                   // الإدارة التابع ليها
        $table->string('qualification')->nullable();    // المؤهل
        $table->date('hiring_date');                    // تاريخ التعيين
        $table->string('job_title');                    // المسمى الوظيفي
        $table->string('insurance_number_driver')->nullable();  
        $table->enum('gender', ['ذكر', 'أنثى']);         // النوع
        $table->string('branch');                       // الفرع
        $table->string('phone')->nullable();            // الموبايل
        $table->string('license_image_front')->nullable();    // صورة رخصة القيادة
        $table->string('license_image_back')->nullable();
        $table->date('license_expiry_date')->nullable();// تاريخ انتهاء الرخصة

        // بيانات التأمينات
        $table->string('insurance_number')->nullable();     // الرقم التأميني
        $table->string('insurance_office')->nullable();         // مكتب العمل
        $table->string('insurance_number_office')->nullable(); 
        $table->string('register_number_office')->nullable(); 
        $table->string('insurance_status')->nullable();     // حالة التأمينات
        $table->date('insurance_start_date')->nullable();   // تاريخ الالتحاق
        $table->decimal('insurance_salary', 10, 2)->default(0)->nullable();   // الأجر التأميني
        $table->decimal('gross_salary', 10, 2)->default(0)->nullable();        // الأجر الشامل
        $table->decimal('employee_share', 10, 2)->default(0)->nullable();      // 11%
        $table->decimal('employer_share', 10, 2)->default(0)->nullable();      // 18.75%
        $table->decimal('total_insurance', 10, 2)->default(0)->nullable();     // المجموع

        $table->date('resignation_date')->nullable();        // تاريخ ترك العمل
        $table->string('registered_company')->nullable();                // الشركة المسجل عليها
        $table->date('official_resignation_date')->nullable(); // تاريخ الاستقالة

        // المستندات
        $table->string('form_1')->nullable();      // استمارة 1
        $table->string('form_6')->nullable();      // استمارة 6
        $table->string('other_document')->nullable(); // خانة أخرى

        // ملاحظات
        $table->text('notes')->nullable();         // الملاحظات
$table->unsignedBigInteger('insurance_office_id')->nullable();

$table->foreign('insurance_office_id')
      ->references('id')->on('insurance_offices')
      ->onDelete('set null');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
