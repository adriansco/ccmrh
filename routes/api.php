<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('employees', function () {
    /* return datatables()->eloquent(App\Models\Employee::query())->toJson(); */
    /* $data = Employee::all(); */
    /* $data = Employee::select('*'); */
    /* ->eloquent(App\Models\Employee::query()) */
    $data = DB::table('employees')
        ->join('department_employee', 'employees.id', '=', 'department_employee.employee_id')
        ->join('departments', 'department_employee.department_id', '=', 'departments.id')
        ->join('employee_position', 'employees.id', '=', 'employee_position.employee_id')
        ->join('positions', 'employee_position.position_id', '=', 'positions.id')
        ->select('employees.*', 'departments.name as dep_name', 'positions.name as pos_name')
        ->whereNull('department_employee.to_date')
        ->whereNull('employee_position.to_date')->get();
    return DataTables::of($data)
        ->addColumn('btn', 'employees/actions')
        ->rawColumns(['btn'])
        ->toJson();
});

/* Route::group(["middleware" => "apikey.validate"], function () {
    //Rutas
    Route::post("login", "Api\UserController@postLogin");
    Route::get("cursos", "Api\CursoController@getCursos");
}); */


Route::get('departments', function () {
    /* return datatables()->eloquent(App\Models\Employee::query())->toJson(); */
    return datatables()
        ->eloquent(App\Models\Department::query())
        ->addColumn('btn', 'departments/actions')
        ->rawColumns(['btn'])
        ->toJson();
});

Route::get('positions', function () {
    /* return datatables()->eloquent(App\Models\Employee::query())->toJson(); */
    return datatables()
        ->eloquent(App\Models\Position::query())
        ->addColumn('btn', 'positions/actions')
        ->rawColumns(['btn'])
        ->toJson();
});

/* Route::get('petitions', function () {
    //return datatables()->eloquent(App\Models\Employee::query())->toJson();
    return datatables()
        ->eloquent(App\Models\Petition::query())
        ->addColumn('btn', 'petitions/actions')
        ->rawColumns(['btn'])
        ->toJson();
})->middleware('can:admin.api'); */

Route::get('petitions', function () {
    /* Consulta del lado del servidor para traer las peticiones y sus detalles */
    /* Al final ya no supe si todo era necesario */
    $data1 = DB::table('condition_petition_user')
        ->select('petition_id', 'condition_id', 'ctrl', DB::raw('MAX(date_change) as date'))
        ->groupBy('petition_id', 'condition_id', 'ctrl');

    $data = DB::table('petitions')
        ->join('categories', 'categories.id', '=', 'petitions.category_id')
        ->join('employees', 'employees.id', '=', 'petitions.employee_id')
        ->join('departments', 'departments.id', '=', 'petitions.department_source')
        ->join('users', 'users.id', '=', 'petitions.user_id')
        ->leftJoinSub($data1, 'maximo', function ($join) {
            $join->on('maximo.petition_id', '=', 'petitions.id');
        })
        ->join('conditions', 'conditions.id', 'maximo.condition_id')
        ->select('petitions.id', 'petitions.compensated', 'petitions.group_code', 'petitions.start_date', 'petitions.end_date', 'categories.name as category', DB::raw('CONCAT(employees.first_name, " ", employees.last_name) AS full_name'), 'departments.name as department_source', DB::raw("(SELECT name FROM departments WHERE departments.id = petitions.department_destiny) as department_destiny"), 'users.name as user', 'conditions.name as status')
        ->where('maximo.ctrl', '1')
        ->groupBy('petitions.id', 'petitions.compensated', 'petitions.group_code', 'petitions.start_date', 'petitions.end_date', 'categories.name', 'full_name', 'departments.name', 'department_destiny', 'users.name', 'conditions.name')
        ->get();
    return DataTables::of($data)
        ->addColumn('btn', 'petitions/actions')
        ->rawColumns(['btn'])
        ->toJson();
});
/* buscar */
Route::get('employees/search', [EmployeeController::class, 'search']);
Route::get('departments/search', [DepartmentController::class, 'search']);
Route::get('positions/search', [PositionController::class, 'search']);
