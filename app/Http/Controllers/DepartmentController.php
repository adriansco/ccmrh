<?php

namespace App\Http\Controllers;

use App\Exports\DepartmentExport;
use App\Http\Requests\RequestDepartment;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('departments.index');
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(RequestDepartment $request)
    {
        Department::create($request->all());
        return redirect()->route('departments.index');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Department $department, RequestDepartment $request)
    {
        $department->update($request->all());
        return redirect()->route('departments.index');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index');
    }

    public function exportPdf()
    {
        $departments  = Department::get();
        $pdf =  PDF::loadView('pdf.departments', compact('departments'));
        return $pdf->download('departments-list.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new DepartmentExport, 'departments-list.xlsx');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $department = Employee::find($request->employee_id)
                ->departments()->whereNull('to_date')->first();
        }
        return response()->json($department);
    }
}
