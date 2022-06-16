@extends('layouts.plantilla')

@section('title', 'Modificar')

@section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}" />
@endsection

@section('page-title', 'Modificar')

@section('breadcrumbs')
    <div class="page-head">
        <h2 class="page-head-title">Modificar empleado</h2>
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
                <div class="card-header card-header-divider">Datos del empleado
                    {{ $employee->first_name . ' ' . $employee->last_name }}<span class="card-subtitle">Los campos
                        marcados con (*) son obligatorios.</span></div>
                <div class="card-body">
                    <form action="{{ route('employees.update', $employee) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6 form-group">
                            <label for="first_name">*Nombre</label>
                            <input class="form-control" id="first_name" name="first_name" type="text"
                                placeholder="Ingresar nombre" value="{{ old('first_name', $employee->first_name) }}">
                            @error('first_name')
                                *{{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="last_name">*Apellidos</label>
                            <input class="form-control" id="last_name" name="last_name" type="text"
                                placeholder="Ingresar apellidos" value="{{ old('last_name', $employee->last_name) }}">
                            @error('last_name')
                                *{{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="gender">*Genero</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="" selected>Seleccionar Opción</option>
                                <option value="M" {{ old('gender', $employee->gender) == 'M' ? 'selected' : '' }}>M
                                </option>
                                <option value="F" {{ old('gender', $employee->gender) == 'F' ? 'selected' : '' }}>F
                                </option>
                            </select>
                            @error('gender')
                                *{{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="status">*Estado</label>
                            <select class="form-control" id="status" name="status">
                                <option value="" selected>Seleccionar Opción</option>
                                <option value="A" {{ old('status', $employee->status) == 'A' ? 'selected' : '' }}>A
                                </option>
                                <option value="B" {{ old('status', $employee->status) == 'B' ? 'selected' : '' }}>B
                                </option>
                            </select>
                            @error('status')
                                *{{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="payroll">*Número de nómina</label>
                            <input class="form-control" id="payroll" name="payroll" type="text"
                                placeholder="Ingresar número de nómina" value="{{ old('payroll', $employee->payroll) }}">
                            @error('payroll')
                                *{{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="hire_date">*Fecha de contratación</label>
                            <input class="form-control date datetimepicker" data-min-view="2" data-date-format="yyyy-mm-dd"
                                id="hire_date" name="hire_date" type="text" placeholder="Fecha"
                                value="{{ old('hire_date', $employee->hire_date) }}">
                            @error('hire_date')
                                *{{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="department_id">*Departamento</label>
                            <input class="form-control" id="department_id" name="department_id" type="text"
                                placeholder="Ingresar número de nómina"
                                value="{{ old('department_id', $department->name) }}" disabled>
                            @error('department_id')
                                *{{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="position_id">*Puesto</label>
                            <input class="form-control" id="position_id" name="position_id" type="text"
                                placeholder="Ingresar número de nómina"
                                value="{{ old('position_id', $position->name) }}" disabled>
                            @error('position_id')
                                *{{ $message }}
                            @enderror
                        </div>

                        <div class="col-12">
                            {{-- mensaje o terminos --}}
                        </div>
                        <div class="col-12 pt-3">
                            <p class="text-right">
                                <button class="btn btn-space btn-primary" type="submit">Submit</button>
                                <a href="{{ route('employees.index') }}" class="btn btn-space btn-danger">Cancel</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('content')
    <h1>Show {{ $employee }}</h1>
@endsection --}}

@section('scriptzone')
    <script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>
@endsection

@section('appzone', 'App.formElements();')
