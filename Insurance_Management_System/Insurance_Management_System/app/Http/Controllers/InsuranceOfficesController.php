<?php

namespace App\Http\Controllers;

use App\Models\InsuranceOffice;
use App\Http\Requests\InsuranceOfficesRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InsuranceOfficesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = InsuranceOffice::all();
        return view('insurance_offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('insurance_offices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsuranceOfficesRequest $request): RedirectResponse
    {
        try {
            InsuranceOffice::create($request->validated());
            return redirect()->route('insurance_offices.index')->with('success', 'تم إنشاء المكتب بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء الإنشاء: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $insuranceOffice = InsuranceOffice::findOrFail($id);
        return view('insurance_offices.show', compact('insuranceOffice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $insuranceOffice = InsuranceOffice::findOrFail($id);
        return view('insurance_offices.edit', compact('insuranceOffice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InsuranceOfficesRequest $request, InsuranceOffice $insuranceOffice): RedirectResponse
    {
        try {
            $insuranceOffice->update($request->validated());
            return redirect()->route('insurance_offices.index')->with('success', 'تم التعديل بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء التعديل: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InsuranceOffice $insuranceOffice): RedirectResponse
    {
        try {
            // فحص لو فيه موظفين مرتبطين (اختياري)
            if ($insuranceOffice->employees()->exists()) {
                return redirect()->back()->with('error', 'لا يمكن حذف المكتب لأنه مرتبط بموظفين.');
            }

            $insuranceOffice->delete();
            return redirect()->route('insurance-offices.index')->with('success', 'تم الحذف بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء الحذف: ' . $e->getMessage());
        }
    }
}