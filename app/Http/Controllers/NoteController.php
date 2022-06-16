<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestNote;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('notes.index', compact('notes'));
    }
    public function store(RequestNote $request)
    {
        $note = Note::create($request->except(['department_id', 'position_id']));
        return redirect()->route('notes.index');
    }
    /* public function exportExcel()
    {
        $name = 'notes-list-' . Carbon::now() . '.xlsx';
        return Excel::download(new NoteExport, $name);
    }
    public function exportPdf()
    {
        $notes  = Note::get();
        $pdf =  PDF::loadView('pdf.notes', compact('notes'));
        $name = 'notes-list-' . Carbon::now() . '.pdf';
        return $pdf->download($name);
    } */
    public function create()
    {
        return view('notes.create');
    }
    public function update(Note $note, RequestNote $request)
    {
        $note->update($request->all());
        return redirect()->route('notes.index');
    }
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index');
    }
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }
}
