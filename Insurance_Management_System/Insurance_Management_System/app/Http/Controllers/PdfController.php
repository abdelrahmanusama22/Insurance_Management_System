<?php

namespace App\Http\Controllers;
use Barryvdh\Snappy\Facades\SnappyPdf;
use App\Models\InsuranceOffice;
use App\Models\Employee;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PdfController extends Controller
{
   
    public function downloadPdfeltarekcart2men($id)
    {
       $car = Car::with('employee')->findOrFail($id);
    $today = Carbon::now()->format('Y-m-d');
    $html = view('pdfs.car_report', compact('car', 'today'))->render();

    $pdf = SnappyPdf::loadHTML($html)
       ->setOption('encoding', 'UTF-8')
        ->setOption('page-size', 'A4')
        ->setOption('margin-top', 10)
        ->setOption('margin-bottom', 10)
        ->setOption('margin-left', 10)
        ->setOption('margin-right', 10)
        ->setOption('enable-local-file-access', true)
        ->setOption('no-images', false)
        ->setOption('disable-smart-shrinking', true)
        ->setOption('load-error-handling', 'ignore')
        ->setOption('enable-external-links', true)
        ->setOption('enable-internal-links', true)
        ->setOption('images', true)
        ->setOption('no-stop-slow-scripts', false) // السماح بالسكربتات البطيئة
        ->setOption('enable-javascript', false); // تفعيل الجافاسكربت


    $filename = "Car_{$car->id}_" . time() . ".pdf";
    return $pdf->inline($filename);
    }
    public function downloadPdfeltarekcara5la2($id)
    {
       $employee = Employee::with('insuranceOffice')->findOrFail($id);
    $today = Carbon::now()->format('Y-m-d');
    $html = view('pdfs.a5la2', compact('employee', 'today'))->render();

    $pdf = SnappyPdf::loadHTML($html)
      ->setOption('encoding', 'UTF-8')
        ->setOption('page-size', 'A4')
        ->setOption('margin-top', 10)
        ->setOption('margin-bottom', 10)
        ->setOption('margin-left', 10)
        ->setOption('margin-right', 10)
        ->setOption('enable-local-file-access', true)
        ->setOption('no-images', false)
        ->setOption('disable-smart-shrinking', true)
        ->setOption('load-error-handling', 'ignore')
        ->setOption('enable-external-links', true)
        ->setOption('enable-internal-links', true)
        ->setOption('images', true)
        ->setOption('no-stop-slow-scripts', false) // السماح بالسكربتات البطيئة
        ->setOption('enable-javascript', false); // تفعيل الجافاسكربت


    $filename = "a5la2_{$employee->name}_" . time() . ".pdf";
    return $pdf->inline($filename);
    }
  public function downloadPdfeltarekcarastkala($id)
    {
       $employee = Employee::with('insuranceOffice')->findOrFail($id);
    $today = Carbon::now()->format('Y-m-d');
    $html = view('pdfs.astkala', compact('employee', 'today'))->render();

    $pdf = SnappyPdf::loadHTML($html)
        ->setOption('encoding', 'UTF-8')
        ->setOption('page-size', 'A4')
        ->setOption('margin-top', 10)
        ->setOption('margin-bottom', 10)
        ->setOption('margin-left', 10)
        ->setOption('margin-right', 10)
        ->setOption('enable-local-file-access', true)
        ->setOption('no-images', false)
        ->setOption('disable-smart-shrinking', true)
        ->setOption('load-error-handling', 'ignore')
        ->setOption('enable-external-links', true)
        ->setOption('enable-internal-links', true)
        ->setOption('images', true)
        ->setOption('no-stop-slow-scripts', false) // السماح بالسكربتات البطيئة
        ->setOption('enable-javascript', false); // تفعيل الجافاسكربت

    $filename = "astkala_{$employee->name}_" . time() . ".pdf";
    return $pdf->inline($filename);
    }
     public function astmara1($id)
    {
       $employee = Employee::with('insuranceOffice')->findOrFail($id);
    $today = Carbon::now()->format('Y-m-d');
    $html = view('pdfs.astmara1', compact('employee', 'today'))->render();

    $pdf = SnappyPdf::loadHTML($html)
       ->setOption('encoding', 'UTF-8')
        ->setOption('page-size', 'A4')
        ->setOption('margin-top', 10)
        ->setOption('margin-bottom', 10)
        ->setOption('margin-left', 10)
        ->setOption('margin-right', 10)
        ->setOption('enable-local-file-access', true)
        ->setOption('no-images', false)
        ->setOption('disable-smart-shrinking', true)
        ->setOption('load-error-handling', 'ignore')
        ->setOption('enable-external-links', true)
        ->setOption('enable-internal-links', true)
        ->setOption('images', true)
        ->setOption('no-stop-slow-scripts', false) // السماح بالسكربتات البطيئة
        ->setOption('enable-javascript', false); // تفعيل الجافاسكربت

    $filename = "astmara1_{$employee->id}_" . time() . ".pdf";
    return $pdf->inline($filename);
    }
     public function astmara6($id)
    {
    $employee = Employee::with('insuranceOffice')->findOrFail($id);
    $today = Carbon::now()->format('Y-m-d');
    $html = view('pdfs.astmara6', compact('employee', 'today'))->render();

    $pdf = SnappyPdf::loadHTML($html)
      ->setOption('encoding', 'UTF-8')
        ->setOption('page-size', 'A4')
        ->setOption('margin-top', 10)
        ->setOption('margin-bottom', 10)
        ->setOption('margin-left', 10)
        ->setOption('margin-right', 10)
        ->setOption('enable-local-file-access', true)
        ->setOption('no-images', false)
        ->setOption('disable-smart-shrinking', true)
        ->setOption('load-error-handling', 'ignore')
        ->setOption('enable-external-links', true)
        ->setOption('enable-internal-links', true)
        ->setOption('images', true)
        ->setOption('no-stop-slow-scripts', false) // السماح بالسكربتات البطيئة
        ->setOption('enable-javascript', false); // تفعيل الجافاسكربت


    $filename = "astmara6_{$employee->name}_" . time() . ".pdf";
    return $pdf->inline($filename);
    }
}
