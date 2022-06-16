@extends('layouts.plantilla')

@section('title', 'Create')

@section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}" />
@endsection

@section('page-title', 'Create')

@section('breadcrumbs')
    <div class="page-head">
        <h2 class="page-head-title">Create empleado</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Empleados</a></li>
                {{-- <li class="breadcrumb-item"><a href="#">Tables</a></li> --}}
                <li class="breadcrumb-item active">Detalles empleado</li>
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
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12 form-group">
                                <label for="first_name">Nombre</label>
                                {{-- {{ $errors->has('first_name') ? 'is-invalid' : '' }} --}}
                                <input class="form-control" id="first_name" name="first_name" type="text"
                                    placeholder="Ingresar nombre" value="{{ old('first_name') }}">
                                @error('first_name')
                                    {{-- class="invalid-feedback" --}}
                                    <span>
                                        <span class="text-danger">*{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 form-group">
                                <label for="last_name">Apellidos</label>
                                <input class="form-control" id="last_name" name="last_name" type="text"
                                    placeholder="Ingresar apellidos" value="{{ old('last_name') }}">
                                @error('last_name')
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 form-group">
                                <label for="gender">Genero</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="" selected>Seleccionar Opción</option>
                                    <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>M</option>
                                    <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>F</option>
                                </select>
                                @error('gender')
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 form-group">
                                <label for="status">Estado</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="" selected>Seleccionar Opción</option>
                                    <option value="A" {{ old('status') == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('status') == 'B' ? 'selected' : '' }}>B</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 form-group">
                                <label for="payroll">Número de nómina</label>
                                <input class="form-control" id="payroll" name="payroll" type="text"
                                    placeholder="Ingresar número de nómina" value="{{ old('payroll') }}">
                                @error('payroll')
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="group_code">*Nómina</label>
                                <select class="form-control select2" id="group_code" name="group_code">
                                    <option></option>
                                    @foreach ($groups as $item)
                                        <option value="{{ $item->code }}"
                                            {{ old('group_code') == $item->code ? 'selected' : '' }}>
                                            {{ $item->code . '-' . $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('group_code')
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 col-sm-12 form-group">
                                <label for="hire_date">Fecha de contratación</label>
                                <input class="form-control date datetimepicker" data-min-view="2"
                                    data-date-format="yyyy-mm-dd" id="hire_date" name="hire_date" type="text"
                                    placeholder="Fecha" value="{{ old('hire_date') }}">
                                @error('hire_date')
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
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
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 col-sm-12 form-group">
                                <label for="position_id">Puesto</label>
                                <select class="form-control select2" id="position_id" name="position_id">
                                    <option> </option>
                                    @foreach ($positions as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('position_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('position_id')
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-lg-12 col-lg-6 pb-4 pb-lg-0">
                                <p class="text-right">
                                    <button class="btn btn-space btn-primary" type="submit">Guardar</button>
                                    <a href="{{ route('employees.index') }}"
                                        class="btn btn-space btn-danger">Cancelar</a>
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
