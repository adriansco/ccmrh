<?php

namespace App\Http\Controllers;

use App\Models\DepartmentMaganer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = DB::table('department_manager')
            ->join('employees', 'employees.id', '=', 'department_manager.employee_id')
            ->join('departments', 'departments.id', '=', 'department_manager.department_id')
            ->select(DB::raw('CONCAT(employees.first_name, " ", employees.last_name) as name'), 'employees.status', 'departments.name as dep_name', 'department_manager.id', 'department_manager.from_date', 'department_manager.to_date', 'department_manager.employee_id', 'department_manager.type')
            ->where('employees.status', 'A')
            ->whereNull('department_manager.to_date')->get();
        /* return view('brigade.index', compact('employees')); */
        /* $managers = DepartmentMaganer::all(); */
        return view('managers.index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(DepartmentMaganer $manager)
    {
        $manager->delete();
        return redirect()->route('managers.index');
    }
}
