<?php

namespace App\Http\Controllers;

use App\Exports\PositionExport;
use App\Http\Requests\RequestPosition;
use App\Models\Employee;
use App\Models\Position;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PositionController extends Controller
{
    public function index()
    {
        return view('positions.index');
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(RequestPosition $request)
    {
        $position = Position::create($request->all());
        return redirect()->route('positions.index');
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Position $position, RequestPosition $request)
    {
        $position->update($request->all());
        return redirect()->route('positions.index');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('positions.index');
    }

    public function exportPdf()
    {
        $positions  = Position::get();
        $pdf =  PDF::loadView('pdf.positions', compact('positions'));
        return $pdf->download('positions-list.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new PositionExport, 'positions-list.xlsx');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $position = Employee::find($request->employee_id)
                ->positions()->whereNull('to_date')->first();
        }
        return response()->json($position);
    }
}
