<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Employee;
use Carbon\Carbon;
use App\Http\Requests\CarRequest;

use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
$cars = Car::with('employee')->paginate(100); // 100 عناصر لكل صفحة
return view('cars.index', compact('cars'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $employees = Employee::where('insurance_status', 'مؤمن عليه')->get();
        return view('cars.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request)
{
    $car = new Car($request->all());

    if ($request->hasFile('license_image_front')) {
        $car->license_image_front = $request->file('license_image_front')->store('uploads/car_licenses', 'public');
    }

    if ($request->hasFile('license_image_back')) {
        $car->license_image_back = $request->file('license_image_back')->store('uploads/car_licenses', 'public');
    }

    if ($request->hasFile('insurance_certificate')) {
        $car->insurance_certificate = $request->file('insurance_certificate')->store('uploads/car_insurance', 'public');
    }

    $car->save();

    return redirect()->route('cars.index')->with('success', 'تم إضافة السيارة بنجاح');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::findOrFail($id);
        $today = Carbon::now();
        $expiry = Carbon::parse($car->inspection_end); // عدل الاسم حسب العمود عندك

        $remainingDays = $today->diffInDays($expiry, false); // false عشان يرجع القيم السالبة لو التاريخ عدى

        return view('cars.show', compact('car', 'remainingDays'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::findOrFail($id);
        $employees = Employee::all();
        return view('cars.edit', compact('car', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, string $id)
{
   

    $car = Car::findOrFail($id);
    $car->update($request->all());

    if ($request->hasFile('license_image_front')) {
        // تصحيح المسار ليطابق دالة store
        $car->license_image_front = $request->file('license_image_front')->store('uploads/car_licenses', 'public');
    }

    if ($request->hasFile('license_image_back')) {
        // تصحيح المسار
        $car->license_image_back = $request->file('license_image_back')->store('uploads/car_licenses', 'public');
    }

    if ($request->hasFile('insurance_certificate')) {
        // تصحيح المسار
        $car->insurance_certificate = $request->file('insurance_certificate')->store('uploads/car_insurance', 'public');
    }

    $car->save();

    return redirect()->route('cars.index')->with('success', 'تم تعديل السيارة بنجاح');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'تم حذف السيارة بنجاح');
    }
}
