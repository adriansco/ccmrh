<?php

namespace App\Http\Controllers;

use App\Exports\ExamExport;
use App\Http\Requests\RequestExam;
use App\Models\Exam;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        return view('exams.index', compact('exams'));
    }
    public function store(RequestExam $request)
    {
        $exam = Exam::create($request->all());
        return redirect()->route('exams.index');
    }
    public function exportExcel()
    {
        $name = 'exams-list-' . Carbon::now() . '.xlsx';
        return Excel::download(new ExamExport, $name);
    }
    public function exportPdf()
    {
        $exams  = Exam::get();
        $pdf =  PDF::loadView('pdf.exams', compact('exams'));
        $name = 'exams-list-' . Carbon::now() . '.pdf';
        return $pdf->download($name);
    }
    public function create()
    {
        return view('exams.create');
    }
    public function update(Exam $exam, RequestExam $request)
    {
        $exam->update($request->all());
        return redirect()->route('exams.index');
    }
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index');
    }
    public function edit(Exam $exam)
    {
        return view('exams.edit', compact('exam'));
    }
}
