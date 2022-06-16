@extends('layouts.plantilla')

@section('title', 'Petición')

@section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}" />
@endsection

@section('page-title', 'Petición')

@section('breadcrumbs')
    <div class="page-head">
        <h2 class="page-head-title">Crear petición</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('positions.index') }}">Peticiones</a></li>
                <li class="breadcrumb-item active">Crear petición</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header card-header-divider">Datos<span class="card-subtitle">Los campos
                        marcados con (*) son obligatorios.</span></div>
                <div class="card-body">
                    <form action="{{ route('petitions.store') }}" method="POST" class="row g-3">
                        @csrf

                        <div class="col-md-12 col-sm-12 form-group">
                            <table class="table table-sm table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>*Empleado</th>
                                        {{-- <th>*Departamento origen</th>
                                        <th>*Puesto origen</th> --}}
                                        <th class="text-center align-middle">
                                            <button type="button" class="btn btn-info addRow">
                                                <i class="las la-plus"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{-- onchange="myFunction()" --}}
                                            <select name="id[]" id="employee" data-ctrl="0"
                                                class="form-control select2"></select>
                                            @error('id[]')
                                                <span class="text-danger">*{{ $message }}</span>
                                            @enderror
                                        </td>
                                        {{-- <td><input class="form-control" id="department_source" name="department_source[]"
                                                type="text" hidden>
                                            <input class="form-control" id="department_source_name"
                                                name="department_source_name[]" type="text" placeholder="..." disabled>
                                        </td>
                                        <td><input class="form-control" id="position_source_id"
                                                name="position_source_id[]" type="text" hidden>
                                            <input class="form-control" id="position_source_name"
                                                name="position_source_name" type="text" placeholder="..." disabled>
                                        </td> --}}
                                        <td class="text-center align-middle">
                                            {{-- <a href="#" class="btn btn-danger">-</a> --}}
                                            <button type="button" class="btn btn-danger removeRow"><i
                                                    class="las la-minus"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="group_code">*Tipo de nómina</label>
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
                        <div class="col-md-4 form-group">
                            <label for="department_destiny">*Departamento destino</label>
                            <select class="form-control select2" id="department_destiny" name="department_destiny">
                                <option></option>
                                @foreach ($departments as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('department_destiny') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('department_destiny')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="position_destiny_id">*Puesto destino</label>
                            <select class="form-control select2" id="position_destiny_id" name="position_destiny_id">
                                <option></option>
                                @foreach ($positions as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('position_destiny_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('position_destiny_id')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="category_id">*Categoría</label>
                            <select class="form-control select2" id="category_id" name="category_id">
                                <option></option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="start_date">*Fecha Inicio</label>
                            <input class="form-control date datetimepicker" data-min-view="2" data-date-format="yyyy-mm-dd"
                                id="start_date" name="start_date" type="text" placeholder="Fecha"
                                value="{{ old('start_date') }}">
                            @error('start_date')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">*Fecha fin</label>
                            <input class="form-control date datetimepicker" data-min-view="2" data-date-format="yyyy-mm-dd"
                                id="end_date" name="end_date" type="text" placeholder="Fecha"
                                value="{{ old('end_date') }}">
                            @error('end_date')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 pt-3 pb-1">
                            <div class="be-checkbox custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="check1" name="check1">
                                <label class="custom-control-label" for="check1">¿Aplica compensación?</label>
                            </div>
                        </div>
                        <div class="col-12">
                            {{-- mensaje o terminos --}}
                        </div>
                        <div class="col-12 pt-3">
                            <p class="text-right">
                                <button class="btn btn-space btn-primary" type="submit">Guardar</button>
                                <a href="{{ route('petitions.index') }}" class="btn btn-space btn-danger">Cancelar</a>
                            </p>
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
    <script src="{{ asset('js/app-add-row.js') }}" type="text/javascript"></script>

    {{-- <script>
        function myFunction() {
            var x = document.getElementById("employee").value;
            document.getElementById("demo").innerHTML = "You selected: " + x;
        }
    </script> --}}
@endsection

@section('appzone', 'App.formElements();')
