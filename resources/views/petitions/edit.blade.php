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
        <h2 class="page-head-title">Modificar petición</h2>
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
                <div class="card-header card-header-divider">Datos de la petición
                    {{ $petition->id }}<span class="card-subtitle">Los campos
                        marcados con (*) son obligatorios.</span></div>
                <div class="card-body">
                    <form action="{{ route('petitions.update', $petition) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12 form-group">
                            <label for="id">*Empleado</label>
                            <select name="id" id="employee" class="form-control select2">
                                @if ($petition->employee->id)
                                    <option value="{{ $petition->employee->id }}" selected>
                                        {{ $petition->employee->payroll . ' - ' . $petition->employee->first_name . ' ' . $petition->employee->last_name }}
                                    </option>
                                @endif
                            </select>
                            @error('id')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="department_source_name">*Departamento origen</label>
                            <input class="form-control" id="department_source" name="department_source" type="text" hidden
                                value="{{ old('department_source_name', $petition->department_source) }}">
                            <input class="form-control" id="department_source_name" name="department_source_name"
                                type="text" placeholder="..."
                                value="{{ $petition->department($petition->department_source) }}" disabled>
                            @error('department_source')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="department_destiny">*Departamento destino</label>
                            <select class="form-control select2" id="department_destiny" name="department_destiny">
                                <option></option>
                                @foreach ($departments as $item)
                                    @if (old('department_destiny') == $item->id)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @elseif ($item->id == $petition->department_destiny)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('department_destiny')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="category_id">*Categoría</label>
                            <select class="form-control select2" id="category_id" name="category_id">
                                <option></option>
                                @foreach ($categories as $item)
                                    @if (old('category_id') == $item->id)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @elseif ($item->id == $petition->category_id)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="start_date">*Fecha inicio</label>
                            <input class="form-control date datetimepicker" data-min-view="2" data-date-format="yyyy-mm-dd"
                                id="start_date" name="start_date" type="text" placeholder="Fecha"
                                value="{{ old('end_date', $petition->start_date) }}">
                            @error('start_date')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">*Fecha fin</label>
                            <input class="form-control date datetimepicker" data-min-view="2" data-date-format="yyyy-mm-dd"
                                id="end_date" name="end_date" type="text" placeholder="Fecha"
                                value="{{ old('end_date', $petition->end_date) }}">
                            @error('end_date')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            {{-- mensaje o terminos --}}
                        </div>
                        <div class="col-12 pt-3">
                            <p class="text-right">
                                <button class="btn btn-space btn-primary" type="submit">Submit</button>
                                <a href="{{ route('petitions.index') }}" class="btn btn-space btn-danger">Cancel</a>
                            </p>
                        </div>
                    </form>
                    {{--  --}}
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
