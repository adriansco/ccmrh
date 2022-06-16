<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RoleController;
use App\Mail\StatusMailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| return view('welcome');
|
*/

/* Route::get('employees',[EmployeeController::class, 'index'])->name('employees.index'); */

Route::get('/', HomeController::class)->middleware('auth', 'verified');
Route::get('/admin', [HomeController::class, 'index'])->middleware('can:admin.dashboard', 'auth', 'verified')->name('dashboard.index');

/* App\Providers\ServiceProvider => Traducción de rutas*/
Route::resource('employees', EmployeeController::class)->middleware('auth', 'verified');
/* ->parameters(['nombre_url' => 'nombre_variable'])->names('employees') */
Route::get('employees-list-pdf', [EmployeeController::class, 'exportPdf'])->name('employees.pdf')->middleware('auth', 'verified');
Route::get('employees-list-excel', [EmployeeController::class, 'exportExcel'])->name('employees.excel')->middleware('auth', 'verified');
Route::get('employees-brigada', [EmployeeController::class, 'employeeBrigada'])->name('brigada.index')->middleware('auth', 'verified');
Route::get('employees-brigada-create', [EmployeeController::class, 'employeeBrigadaCreate'])->name('brigada.create')->middleware('auth', 'verified');
Route::post('employees-brigada-store', [EmployeeController::class, 'employeeBrigadaStore'])->name('brigada.store')->middleware('auth', 'verified');
Route::delete('delete-brigade/{brigade}', [EmployeeController::class, 'destroyEmployeeBrigada'])->name('brigada.destroy')->middleware('auth', 'verified');

Route::resource('managers', ManagerController::class)->middleware('auth', 'verified')->except('show', 'create', 'store', 'update', 'edit');

Route::resource('departments', DepartmentController::class)->middleware('auth', 'verified');
Route::get('departments-list-pdf', [DepartmentController::class, 'exportPdf'])->name('departments.pdf')->middleware('auth', 'verified');
Route::get('departments-list-excel', [DepartmentController::class, 'exportExcel'])->name('departments.excel')->middleware('auth', 'verified');

Route::resource('positions', PositionController::class)->except('show')->middleware('auth', 'verified');
Route::get('positions-list-pdf', [PositionController::class, 'exportPdf'])->name('positions.pdf')->middleware('auth', 'verified');
Route::get('positions-list-excel', [PositionController::class, 'exportExcel'])->name('positions.excel')->middleware('auth', 'verified');

Route::resource('notes', NoteController::class)->except('show')->middleware('auth', 'verified');
/* Route::get('notes-list-pdf', [NoteController::class, 'exportPdf'])->name('notes.pdf')->middleware('auth', 'verified');
Route::get('notes-list-excel', [NoteController::class, 'exportExcel'])->name('notes.excel')->middleware('auth', 'verified'); */

Route::resource('conditions', ConditionController::class)->except('show')->middleware('auth', 'verified');
Route::get('conditions-list-pdf', [ConditionController::class, 'exportPdf'])->name('conditions.pdf')->middleware('auth', 'verified');
Route::get('conditions-list-excel', [ConditionController::class, 'exportExcel'])->name('conditions.excel')->middleware('auth', 'verified');

Route::resource('categories', CategoryController::class)->except('show')->middleware('auth', 'verified');
Route::get('categories-list-pdf', [CategoryController::class, 'exportPdf'])->name('categories.pdf')->middleware('auth', 'verified');
Route::get('categories-list-excel', [CategoryController::class, 'exportExcel'])->name('categories.excel')->middleware('auth', 'verified');

Route::resource('petitions', PetitionController::class)->middleware('auth', 'verified');
Route::get('petitions/{petition}/exam', [PetitionController::class, 'petitionExam'])->name('petitions.exam');
Route::get('fetch-exam/{id}/', [PetitionController::class, 'fetchExam'])->name('petitions.fetch.exam');
Route::get('edit-exam/{id}/', [PetitionController::class, 'editExam'])->name('petitions.edit.exam');
Route::put('petitions/{id}/update-exam', [PetitionController::class, 'updateExamPetition'])->name('petitions.update.exam');
Route::delete('delete-exam/{id}', [PetitionController::class, 'destroyExamPetition'])->name('petitions.destroy.exam');
Route::post('petition-exam', [PetitionController::class, 'storeExamPetition'])->name('petitions.store.exam');
Route::post('petition-status', [PetitionController::class, 'storeStatus'])->name('petitions.store.status');
Route::get('fetch-status/{id}/', [PetitionController::class, 'fetchStatus'])->name('petitions.fetch.status');

Route::get('petitions-list-pdf', [PetitionController::class, 'exportPdf'])->name('petitions.pdf')->middleware('auth', 'verified');
Route::get('petitions-list-excel', [PetitionController::class, 'exportExcel'])->name('petitions.excel')->middleware('auth', 'verified');
/* (class)->only('index', 'edit', 'update') */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class)->except('show')->middleware('auth', 'verified');
});

Route::resource('roles', RoleController::class)->except('show')->middleware('auth', 'verified');
Route::get('roles-list-pdf', [RoleController::class, 'exportPdf'])->name('roles.pdf')->middleware('auth', 'verified');
Route::get('roles-list-excel', [RoleController::class, 'exportExcel'])->name('roles.excel')->middleware('auth', 'verified');

Route::resource('exams', ExamController::class)->except('show')->middleware('auth', 'verified');
Route::get('exams-list-pdf', [ExamController::class, 'exportPdf'])->name('exams.pdf')->middleware('auth', 'verified');
Route::get('exams-list-excel', [ExamController::class, 'exportExcel'])->name('exams.excel')->middleware('auth', 'verified');

Route::view('not-foun-404', 'pages/not-foun-404')->name('not-foun-404')->middleware('auth', 'verified');
Route::view('email', 'admin/mail/email')->name('email')->middleware('auth', 'verified');

Route::resource('contracts', ContractController::class)->middleware('auth', 'verified');
/* Route::view('login', 'auth/login')->name('login'); */

/* Route::get('email-test', function ($id) {
    $email = new StatusMailable($id);
    $emails = ['easuarez@vizcarra.com', 'icarvajal@vizcarra.com'];
    Mail::to($emails)->send($email);
    return "Enviado";
})->middleware('auth', 'verified'); */

Route::get('/home', function () {
    dd(Auth::user());
})->middleware('auth', 'verified');

/* https://www.youtube.com/watch?v=5-P5gBM6hDM&list=PLxFwlLOncxFIbxi2gQCN3SR5e3-WB-4T2&index=7 */

/* Route::get('employees/{id}/{employee?}', function ($id, $employee = null) {
    if ($employee) {
        return "Var: $id, Var: $employee";
    } else {
        return "Welcome: $id";
    }
}); */
