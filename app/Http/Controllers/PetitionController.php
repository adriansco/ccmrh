<?php

namespace App\Http\Controllers;

use App\Exports\PetitionExport;
use App\Http\Requests\RequestPetition;
use App\Models\Condition;
use App\Models\ConditionPetitionUser;
use App\Models\Employee;
use App\Models\Exam;
use App\Models\ExamPetition;
use App\Models\Note;
use App\Models\Petition;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PetitionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:petitions.index')->only('index', 'show');
        /* $this->middleware('can:petitions.create')->only('create'); */
        /* $this->middleware('can:petitions.create')->only('create');
        $this->middleware('can:petitions.store')->only('store');
        $this->middleware('can:petitions.show')->only('show');
        $this->middleware('can:petitions.edit')->only('edit');
        $this->middleware('can:petitions.update')->only('update');
        $this->middleware('can:petitions.destroy')->only('destroy');
        $this->middleware('can:petitions.exportPdf')->only('exportPdf');
        $this->middleware('can:petitions.exportExcel')->only('exportExcel'); */
    }

    public function index()
    {
        return view('petitions.index');
    }

    public function create()
    {
        $departments = DB::table('departments')->get();
        $categories = DB::table('categories')->get();
        $groups = DB::table('groups')->get();
        $positions = DB::table('positions')->get();
        return view('petitions.create', compact('departments', 'categories', 'groups', 'positions'));
    }
    /* RequestPetition */
    public function store(RequestPetition $request)
    {
        /* usuario que creo la petición */
        $user_id = auth()->user()->id;
        /* tomar en cuenta sí, no */
        if ($request->check1 == 'on') {
            $compensated = 'Sí';
        } else {
            $compensated = 'No';
        }
        /* contar arreglo de id para saber cuantos empleados son */
        $flag = count($request->id);
        for ($i = 0; $i < $flag; $i++) {
            $employee = Employee::find($request->id[$i]);
            /* validar si tiene un departamento */
            if (count($employee->departments) === 0) {
                print("no tiene departamento");
            } else {
                foreach ($employee->departments as $item) {
                    if (is_null($item->pivot->to_date)) {
                        $petition = Petition::create([
                            'category_id' => $request->category_id,
                            'user_id' => $user_id,
                            'employee_id' => $request->id[$i],
                            'department_source' => $item->id,
                            'department_destiny' => $request->department_destiny,
                            'compensated' => $compensated,
                            'start_date' => $request->start_date,
                            'end_date' => $request->end_date,
                            'group_code' => $request->group_code,
                            'position_source_id' => 1,
                            'position_destiny_id' => $request->position_destiny_id,
                        ]);
                        ConditionPetitionUser::create([
                            'user_id' => $user_id,
                            'condition_id' => 1,
                            'petition_id' => $petition->id,
                            'comment' => 'Se crea la petición',
                            'date_change' => Carbon::now(),
                        ]);
                    }
                }
            }
        }

        return redirect()->route('petitions.show', $petition);

        /*
        $request->request->add(['employee_id' => $request->id]);
        unset($request['id']);
        $petition = Petition::create($request->all());
        ConditionPetitionUser::create([
            'user_id' => auth()->user()->id,
            'condition_id' => 1,
            'petition_id' => $petition->id,
            'comment' => 'Se crea la petición',
            'date_change' => Carbon::now(),
        ]);
        return redirect()->route('petitions.show', $petition); */
    }

    public function show(Petition $petition)
    {
        $conditions = DB::table('conditions')->get();
        return view('petitions.show', compact('petition', 'conditions'));
    }

    public function edit(Petition $petition)
    {
        $departments = DB::table('departments')->get();
        $categories = DB::table('categories')->get();
        return view('petitions.edit', compact('petition', 'departments', 'categories'));
    }

    public function update(Petition $petition, RequestPetition $request)
    {
        $request->request->add(['user_id' => auth()->user()->id]);
        $request->request->add(['employee_id' => $request->id]);
        unset($request['id']);
        $petition->update($request->all());
        return redirect()->route('petitions.show', $petition);
    }

    public function destroy(Petition $petition)
    {
        $petition->delete();
        return redirect()->route('petitions.index');
    }

    public function exportPdf()
    {
        $petitions  = Petition::get();
        $pdf =  PDF::loadView('pdf.petitions', compact('petitions'));
        return $pdf->download('petitions-list.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new PetitionExport, 'petitions-list.xlsx');
    }

    public function petitionExam(Petition $petition)
    {
        $notes = DB::table('notes')->get();
        $exams = DB::table('exams')->get();
        return view('petitions.exam', compact('petition', 'notes', 'exams'));
    }

    public function editExam($id)
    {
        $exam = Exam::find($id);
        if ($exam) {
            return response()->json([
                'status' => 200,
                'exam' => $exam,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => '¡No se encontró registro!'
            ]);
        }
    }

    public function storeExamPetition(Request $request)
    {
        $exam_petition = ExamPetition::where([
            ['exam_id', '=', $request->input('exam_id')],
            ['petition_id', '=', $request->input('petition_id')]
        ])->get();
        $exam = Exam::find($request->input('exam_id'));
        $flag = count($exam_petition);
        $validator = Validator::make($request->all(), [
            'petition_id' => 'required',
            'exam_id' => 'required',
            'note_id' => 'required',
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } elseif ($flag >= 1) {
            return response()->json([
                'status' => 401,
                'message' => 'La petición solo puede tener un examen del tipo: ' . $exam->name,
            ]);
        } else {
            $exam_petition = new ExamPetition();
            $exam_petition->user_id = auth()->user()->id;
            $exam_petition->exam_id = $request->input('exam_id');
            $exam_petition->petition_id = $request->input('petition_id');
            $exam_petition->note_id = $request->input('note_id');
            $exam_petition->feedback = $request->input('comment');
            $exam_petition->date = Carbon::now();
            $exam_petition->save();
            return response()->json([
                'status' => 200,
                'message' => 'Examen agregado con éxito.'
            ]);
        }
    }

    public function updateExamPetition(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'petition_id' => 'required',
            'id' => 'required',
            'note' => 'required',
            'comment' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $exam_petition = ExamPetition::where([
                ['exam_id', '=', $id],
                ['petition_id', '=', $request->petition_id]
            ])->first();

            if ($exam_petition) {
                $exam_petition->note_id = $request->note;
                $exam_petition->feedback = $request->comment;
                $exam_petition->user_id = auth()->user()->id;
                $exam_petition->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'El registro se actualizó correctamente',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => '¡No se encontró registro!'
                ]);
            }
        }
    }

    public function storeStatus(Request $request)
    {
        /* Captura de errores */
        $validator = Validator::make($request->all(), [
            'petition_id' => 'required',
            'date_change' => 'required',
            'condition_id' => 'required',
            'comment' => 'required',
        ]);
        /* Buscar unión que coincida o no con lo registrado */
        $condition_petition = ConditionPetitionUser::where([
            ['condition_id', '=', $request->input('condition_id')],
            ['petition_id', '=', $request->input('petition_id')]
        ])->get();
        /* Solo lo hago para mostrar el nombre de la condición en el error */
        $condition = Condition::find($request->input('condition_id'));
        /* Contador de condiciones por petición */
        $flag = count($condition_petition);
        /* captura de errores */
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } elseif ($flag >= 1) {
            return response()->json([
                'status' => 401,
                'message' => 'La petición solo puede tener un status del tipo: ' . $condition->name,
            ]);
        } else {
            $petitions = ConditionPetitionUser::where([['petition_id', '=', $request->input('petition_id')]])->get();
            /* Verifica todos los estados de los registros para cambiarlos a 0, si se puede mejorar, mejóralo (Y) */
            foreach ($petitions as $item) {
                if ($item->ctrl >= 1) {
                    $item->update([
                        'ctrl' => '0',
                    ]);
                }
            }
            $condition_petition = new ConditionPetitionUser();
            $condition_petition->user_id = auth()->user()->id;
            $condition_petition->condition_id = $request->input('condition_id');
            $condition_petition->petition_id = $request->input('petition_id');
            $condition_petition->comment = $request->input('comment');
            $condition_petition->ctrl = '1';
            $condition_petition->date_change = $request->input('date_change');
            $condition_petition->save();
            return response()->json([
                'status' => 200,
                'message' => 'Examen agregado con éxito.'
            ]);
        }
    }

    public function fetchExam($id)
    {
        $petitions = Petition::find($id);
        $exams = $petitions->exams;
        /* Agregar desde acá el nombre de la nota y el del usuario */
        for ($i = 0; $i < count($exams); $i++) {
            $exams[$i]->note = Note::find($exams[$i]->pivot->note_id)->name;
            $exams[$i]->user = User::find($exams[$i]->pivot->user_id)->name;
        }
        return response()->json([
            'exams' => $exams,
        ]);
    }

    public function fetchStatus($id)
    {
        $petitions = Petition::find($id);
        $conditions = $petitions->conditions;
        /* Agregar desde acá el nombre de la nota y el del usuario */
        for ($i = 0; $i < count($conditions); $i++) {
            /* $conditions[$i]->note = Note::find($conditions[$i]->pivot->note_id)->name; */
            $conditions[$i]->user = User::find($conditions[$i]->pivot->user_id)->name;
        }
        return response()->json([
            'conditions' => $conditions,
        ]);
    }

    public function destroyExamPetition(Request $request, $id)
    {
        $exam_petition = ExamPetition::where([
            ['exam_id', '=', $id],
            ['petition_id', '=', $request->petition_id]
        ])->first();
        if ($exam_petition) {
            $exam_petition->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Eliminado correctamente.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => '¡No se encontró registro!'
            ]);
        }
    }
}
