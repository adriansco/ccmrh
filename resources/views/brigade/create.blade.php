@extends('layouts.plantilla')

@section('title', 'Crear')

@section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}" />
@endsection

@section('page-title', 'Crear')

@section('breadcrumbs')
    <div class="page-head">
        <h2 class="page-head-title">Agregar Brigadista</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Brigadistas</a></li>
                {{-- <li class="breadcrumb-item"><a href="#">Tables</a></li> --}}
                <li class="breadcrumb-item active">Agregar brigadista</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header card-header-divider">Datos del empleado<span class="card-subtitle">Los campos
                        marcados con (*) son obligatorios.</span></div>
                <div class="card-body">
                    <form action="{{ route('brigada.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="employee_id">*Empleado</label>
                                <select name="employee_id" id="employee" class="form-control select2"></select>
                                @error('employee_id')
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 col-sm-12 form-group">
                                <label for="type">Tipo</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="" selected>Seleccionar Opción</option>
                                    <option value="BPA" {{ old('type') == 'BPA' ? 'selected' : '' }}>Brigada de Primeros Auxilios</option>
                                    <option value="BRS" {{ old('type') == 'BRS' ? 'selected' : '' }}>Brigada de Rescate y Salvamento</option>
                                    <option value="BPCI" {{ old('type') == 'BPCI' ? 'selected' : '' }}>Brigada de Prevención y Combate de Incendios</option>
                                    <option value="BE" {{ old('type') == 'BE' ? 'selected' : '' }}>Brigada de Evacuación</option>
                                    <option value="BC" {{ old('type') == 'BC' ? 'selected' : '' }}>Brigada de Comunicación</option>
                                </select>
                                @error('type')
                                    *{{ $message }}
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 form-group">
                                <label for="from_date">Fecha de inicio</label>
                                <input class="form-control date datetimepicker" data-min-view="2"
                                    data-date-format="yyyy-mm-dd" id="from_date" name="from_date" type="text"
                                    placeholder="Fecha" value="{{ old('from_date') }}">
                                @error('from_date')
                                    *{{ $message }}
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 form-group">
                                <label for="department_id">Departamento</label>
                                <select class="form-control select2" id="department_id" name="department_id">
                                    <option> </option>
                                    @foreach ($departments as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('department_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    *{{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-lg-12 col-lg-6 pb-4 pb-lg-0">
                                <p class="text-right">
                                    <button class="btn btn-space btn-primary" type="submit">Submit</button>
                                    <a href="{{ route('employees.index') }}"
                                        class="btn btn-space btn-secondary">Cancel</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptzone')
    <script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>
@endsection

@section('appzone', 'App.formElements();')
