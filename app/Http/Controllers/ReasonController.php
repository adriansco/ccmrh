<?php

namespace App\Http\Controllers;

use App\Exports\ReasonExport;
use App\Http\Requests\RequestReason;
use App\Models\Reason;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class ReasonController extends Controller
{
    public function index()
    {
        $reasons = Reason::all();
        return view('reasons.index', compact('reasons'));
    }
    public function store(RequestReason $request)
    {
        $reason = Reason::create($request->except(['department_id', 'position_id']));
        return redirect()->route('reasons.index');
    }
    public function exportExcel()
    {
        $name = 'reasons-list-' . Carbon::now() . '.xlsx';
        return Excel::download(new ReasonExport, $name);
    }
    public function exportPdf()
    {
        $reasons  = Reason::get();
        $pdf =  PDF::loadView('pdf.reasons', compact('reasons'));
        $name = 'reasons-list-' . Carbon::now() . '.pdf';
        return $pdf->download($name);
    }
    public function create()
    {
        return view('reasons.create');
    }
    public function update(Reason $reason, RequestReason $request)
    {
        $reason->update($request->all());
        return redirect()->route('reasons.index');
    }
    public function destroy(Reason $reason)
    {
        $reason->delete();
        return redirect()->route('reasons.index');
    }
    public function edit(Reason $reason)
    {
        return view('reasons.edit', compact('reason'));
    }
}
