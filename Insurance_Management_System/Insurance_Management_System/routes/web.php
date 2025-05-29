<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InsuranceOfficesController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return view('welcome');
});



// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grouped: ProfileController (under auth)
Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
    // resource routes as is
Route::resource('cars', CarController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('insurance_offices', InsuranceOfficesController::class);

// Grouped: ExcelController
Route::controller(ExcelController::class)->group(function () {
    Route::get('/export', 'export')->name('employees.export');
    Route::post('/import', 'import')->name('employees.import');
    Route::get('/exportcar', 'exportcar')->name('cars.export');
    Route::get('/exportemplotees', 'exportemployee')->name('exportemployee');
    Route::post('/importcars', 'importcar')->name('cars.import');
});
// Grouped: StatsController
Route::controller(StatsController::class)->group(function () {
    Route::get('/insurance_office/stats', 'combinedStats')->name('labor.stats');
});

// Grouped: PdfController
Route::controller(PdfController::class)->group(function () {
    Route::get('cars/{id}/pdf', 'downloadPdfeltarekcart2men')->name('cars.pdf');
    Route::get('employees/{id}/a5la2pdf', 'downloadPdfeltarekcara5la2')->name('employees.pdf');
    Route::get('employees/{id}/astkalapdf', 'downloadPdfeltarekcarastkala')->name('employees_astkala.pdf');
    Route::get('employees/{id}/astmara1pdf', 'astmara1')->name('employees_astmara1.pdf');
    Route::get('employees/{id}/astmara6pdf', 'astmara6')->name('employees_astmara6.pdf');
});
});

require __DIR__.'/auth.php';
