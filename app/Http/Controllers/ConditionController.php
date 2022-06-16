<?php

namespace App\Http\Controllers;

use App\Exports\ConditionExport;
use App\Http\Requests\RequestCondition;
use App\Models\Condition;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ConditionController extends Controller
{
    public function index()
    {
        $conditions = Condition::all();
        return view('conditions.index', compact('conditions'));
    }
    public function store(RequestCondition $request)
    {
        $request['name'] = strtoupper($request->name);
        Condition::create($request->all());
        return redirect()->route('conditions.index');
    }
    public function exportExcel()
    {
        $name = 'conditions-list-' . Carbon::now() . '.xlsx';
        return Excel::download(new ConditionExport, $name);
    }
    public function exportPdf()
    {
        $conditions  = Condition::get();
        $pdf =  PDF::loadView('pdf.conditions', compact('conditions'));
        $name = 'conditions-list-' . Carbon::now() . '.pdf';
        return $pdf->download($name);
    }
    public function create()
    {
        return view('conditions.create');
    }
    public function update(Condition $condition, RequestCondition $request)
    {
        $request['name'] = strtoupper($request->name);
        $condition->update($request->all());
        return redirect()->route('conditions.index');
    }
    public function destroy(Condition $condition)
    {
        $condition->delete();
        return redirect()->route('conditions.index');
    }
    public function edit(Condition $condition)
    {
        return view('conditions.edit', compact('condition'));
    }
}
