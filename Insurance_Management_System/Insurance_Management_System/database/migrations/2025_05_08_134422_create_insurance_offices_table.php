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
        Schema::create('insurance_offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');               // اسم المكتب
            $table->string('number')->unique();   // رقم المكتب
            $table->string('register_number');    // رقم التسجيل
            $table->string('address')->nullable();
            $table->string('area')->nullable();
            $table->string('area2')->nullable();
            $table->string('city')->nullable();
            $table->string('police_officer')->nullable();
            $table->string('office')->nullable();
            $table->string('Company')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_offices');
    }
};
