@extends('layouts.plantilla')

@section('title', 'Aplicar examen')

@section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}" />
@endsection

@section('page-title', 'Aplicar examen')

@section('breadcrumbs')
    <div class="page-head">
        <h2 class="page-head-title">Aplicar examen</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('petitions.index') }}">Peticiones</a></li>
                {{-- <li class="breadcrumb-item"><a href="#">Tables</a></li> --}}
                <li class="breadcrumb-item active">Detalles petición</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header">Detalles del movimiento {{ $petition->id }}</div>
                <input type="hidden" value="{{ $petition->id }}" name="petition_id" id="petition_id">
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:15%;">Nombre del empleado</th>
                                <th style="width:10%;">Número de nómina</th>
                                <th style="width:15%;">Solicitante</th>
                                <th style="width:10%;">Categoría</th>
                                <th style="width:15%;">Departamento origen</th>
                                <th style="width:15%;">Departamento destino</th>
                                <th style="width:10%;" class="text-center">Fecha inicio</th>
                                <th style="width:10%;" class="text-center">Fecha fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $petition->employee->first_name . ' ' . $petition->employee->last_name }}</td>
                                <td>{{ $petition->employee->payroll }}</td>
                                <td>{{ $petition->user->name }}</td>
                                <td>{{ $petition->category->name }}</td>
                                <td>{{ $petition->department($petition->department_source) }}</td>
                                <td>{{ $petition->department($petition->department_destiny) }}</td>
                                <td class="text-center">{{ $petition->start_date }}</td>
                                <td class="text-center">{{ $petition->end_date }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header">Exámenes de la petición {{ $petition->id }}</div>
                @can('admin.administration')
                    <div class="p-1 text-right">
                        <button class="btn btn-space btn-primary" data-toggle="modal" data-target="#AddStudentModal"
                            type="button"><i class="icon icon-left las la-plus-circle"></i> Agregar</button>
                    </div>
                @endcan
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th style="width:10%;">Nombre</th>
                                <th style="width:15%;">Fecha Aplicación</th>
                                <th style="width:25%;">Comentarios</th>
                                <th style="width:10%;">Status</th>
                                <th style="width:15%;">Usuario</th>
                                <th class="text-center" style="width:20%;">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="content">
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Add Modal --}}
            <div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="AddStudentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="AddStudentModalLabel">Agregar datos del examen</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span
                                    class="mdi mdi-close"></span></button>
                        </div>
                        <div class="modal-body">
                            <ul id="save_msgList"></ul>
                            <input type="hidden" id="exam_id" />
                            <div class="form-group mb-3">
                                <label for="">Examen</label>
                                <div class="">
                                    <select class="form-control exam_id" id="exam_id" name="exam_id">
                                        <option value="" selected disabled hidden>Seleccionar opción...</option>
                                        @foreach ($exams as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('exam') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Status</label>
                                <div class="">
                                    <select class="form-control note_id" id="note_id" name="note_id">
                                        <option value="" selected disabled hidden>Seleccionar opción...</option>
                                        @foreach ($notes as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('note') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Comentarios</label>
                                <input type="text" required class="form-control comment">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-space btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary add-exam">Guardar</button>
                        </div>

                    </div>
                </div>
            </div>
            {{-- Edit Modal --}}
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Editar datos del examen.</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span
                                    class="mdi mdi-close"></span></button>
                        </div>

                        <div class="modal-body">
                            <ul id="update_msgList"></ul>
                            <input type="hidden" id="exam_id" />
                            <div class="form-group mb-3">
                                <label for="">Nombre</label>
                                <input type="text" id="name" disabled class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Status</label>
                                <div class="">
                                    <select class="form-control" id="note" name="note">
                                        <option value="" selected disabled hidden>Seleccionar opción...</option>
                                        @foreach ($notes as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('note') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Comentarios</label>
                                <input type="text" id="comment" name="comment" required class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary md-close" type="button" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary updateExam">Actualizar</button>
                        </div>

                    </div>
                </div>
            </div>
            {{-- Edn- Edit Modal --}}
        </div>
    </div>
@endsection

@section('scriptzone')
    <script src="{{ asset('lib/datatables/datatables.net/js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>
    {{-- ver si es mejor usar datatable --}}
    <script src="{{ asset('js/app-petition-exam.js') }}" type="text/javascript"></script>
@endsection

@section('appzone', 'App.formElements();', 'App.dataTables();')
