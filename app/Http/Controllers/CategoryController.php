<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCategory;
use App\Models\Category;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }
    public function store(RequestCategory $request)
    {
        Category::create($request->all());
        return redirect()->route('categories.index');
    }
    public function exportExcel()
    {
        $name = 'categories-list-' . Carbon::now() . '.xlsx';
        return Excel::download(new RequestCategory, $name);
    }
    public function exportPdf()
    {
        $categories  = Category::get();
        $pdf =  PDF::loadView('pdf.categories', compact('categories'));
        $name = 'categories-list-' . Carbon::now() . '.pdf';
        return $pdf->download($name);
    }
    public function create()
    {
        return view('categories.create');
    }
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }
    public function update(Category $category, RequestCategory $request)
    {
        $category->update($request->all());
        return redirect()->route('categories.index');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }
}
