<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Http\Requests\RequestEmployee;
use App\Http\Requests\RequestUpdate;
use App\Models\BrigadeDepartment;
use App\Models\DepartmentEmployee;
use App\Models\DepartmentMaganer;
use App\Models\Employee;
use App\Models\EmployeeGroup;
use App\Models\EmployeePosition;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:employees.index')->only('index');
        $this->middleware('can:employees.create')->only('create');
        $this->middleware('can:employees.store')->only('store');
        $this->middleware('can:employees.show')->only('show');
        $this->middleware('can:employees.edit')->only('edit');
        $this->middleware('can:employees.update')->only('update');
        $this->middleware('can:employees.destroy')->only('destroy');
        $this->middleware('can:employees.exportPdf')->only('exportPdf');
        $this->middleware('can:employees.exportExcel')->only('exportExcel');
    }

    public function index()
    {
        return view('employees.index');
    }
    public function create()
    {
        $departments = DB::table('departments')->get();
        $positions = DB::table('positions')->get();
        $groups = DB::table('groups')->get();
        return view('employees.create', compact('departments', 'positions', 'groups'));
    }

    public function store(RequestEmployee $request)
    {
        $employee = Employee::create($request->except(['department_id', 'position_id', 'group_code']));
        $position = DB::table('positions')
            ->where('id', $request->position_id)
            ->first();
        /* ini "Esto se pudo haber evitado, pero ya qué xD , es redundante, quizás lo quité" */
        $buscar = array("Gerente", "Supervisor", "Jefe", "Director");
        $encontrado = false;
        foreach ($buscar as $valor) {
            $coincidencia = strpos($position->name, $valor);
            if ($coincidencia !== false) {
                $type = $valor;
                $encontrado = true;
            }
        }
        if ($encontrado) {
            DepartmentMaganer::create([
                'department_id' => $request->department_id,
                'employee_id' => $employee->id,
                'type' => $type,
                'from_date' => $request->hire_date,
            ]);
        }
        /* fin */
        $request->request->add(['employee_id' => $employee->id]);
        /* $request->request->add(['from_date' => Carbon::now()->toDateString()]); */
        $request->request->add(['from_date' => $request->hire_date]);
        DepartmentEmployee::create($request->only(['department_id', 'employee_id', 'from_date']));
        EmployeePosition::create($request->only(['position_id', 'employee_id', 'from_date']));
        EmployeeGroup::create([
            'group_code' => $request->group_code,
            'employee_id' => $request->employee_id,
            'created_at' => $request->from_date,
        ]);

        return redirect()->route('employees.show', $employee);
    }

    public function show(Employee $employee)
    {
        $department = Employee::find($employee->id)
            ->departments()->whereNull('to_date')->first();
        /* buscar jefe de departamento */
        /* opbtener el departamento que tenga null y enviarlo a vista, igual el jefe */
        return view('employees.show', compact('employee', 'department'));
    }

    public function edit(Employee $employee)
    {
        $department = Employee::find($employee->id)
            ->departments()->select('department_id', 'name')->whereNull('to_date')->first();
        $position = Employee::find($employee->id)
            ->positions()->select('position_id', 'name')->whereNull('to_date')->first();
        unset($position['pivot']);
        unset($department['pivot']);
        return view('employees.edit', compact('employee', 'department', 'position'));
    }

    public function update(Employee $employee, RequestUpdate $request)
    {
        $employee->update($request->except(['department_id', 'position_id']));
        return redirect()->route('employees.show', $employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index');
    }

    public function exportPdf()
    {
        /* $employees  = Employee::get(); */
        $employees = DB::table('employees')
            ->join('department_employee', 'employees.id', '=', 'department_employee.employee_id')
            ->join('departments', 'department_employee.department_id', '=', 'departments.id')
            ->select('employees.*', 'departments.name as dep_name')
            ->whereNull('department_employee.to_date')->get();
        $pdf =  PDF::loadView('pdf.employees', compact('employees'));
        return $pdf->download('employees-list.pdf');
    }

    public function exportExcel()
    {
        $name = 'employees-list-' . Carbon::now() . '.xlsx';
        return Excel::download(new EmployeeExport, $name);
    }

    public function search(Request $request)
    {
        $employees = DB::table('employees')
            ->where('status', 'A')
            ->where(function ($query) use ($request) {
                $query->where('payroll', 'LIKE', '%' . $request->input('term', '') . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $request->input('term', '') . '%');
            })
            ->get(['id', DB::raw('CONCAT(payroll, " - " , first_name, " ", last_name) AS text')]);
        return ['results' => $employees];
    }

    public function employeeBrigadaCreate()
    {
        $employees = DB::table('employees')->get();
        $departments = DB::table('departments')->get();
        return view('brigade.create', compact('employees', 'departments'));
    }

    public function employeeBrigadaStore(Request $request)
    {
        BrigadeDepartment::create($request->all());
        return redirect()->route('brigada.index');
    }

    public function employeeBrigada()
    {
        $employees = DB::table('brigade_department')
            ->join('employees', 'employees.id', '=', 'brigade_department.employee_id')
            ->join('departments', 'departments.id', '=', 'brigade_department.department_id')
            ->select(DB::raw('CONCAT(employees.first_name, " ", employees.last_name) as name'), 'departments.name as dep_name', 'brigade_department.id', 'brigade_department.from_date', 'brigade_department.to_date')
            ->whereNull('brigade_department.to_date')->get();
        return view('brigade.index', compact('employees'));
    }

    public function destroyEmployeeBrigada(BrigadeDepartment $brigade)
    {
        $brigade->delete();
        return redirect()->route('brigada.index');
    }
}
