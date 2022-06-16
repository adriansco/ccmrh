@extends('layouts.plantilla')

@section('title', 'Agregar')

@section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}" />
@endsection

@section('page-title', 'Agregar')

@section('breadcrumbs')
    <div class="page-head">
        <h2 class="page-head-title">Agregar contrato</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('contracts.index') }}">Contratos</a></li>
                <li class="breadcrumb-item active">Agregar</li>
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
                    <form action="{{ route('contracts.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col col-md-6 form-group">
                                <label for="id">*Empleado</label>
                                <select name="id" id="employee" class="form-control select2"></select>
                                @error('id')
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                                {{-- <input type="text" class="form-control" placeholder="First name"> --}}
                            </div>

                            <div class="col col-md-6 form-group">
                                <label for="department_source_name">*Departamento</label>
                                <input class="form-control" id="department_source" name="department_source" type="text"
                                    hidden>
                                <input class="form-control" id="department_source_name" name="department_source_name"
                                    type="text" placeholder="..." disabled>
                                @error('department_source')
                                    <span class="text-danger">*{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col col-md-6 form-group">
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

                            <div class="col col-md-6 form-group">
                                <label for="init_date">Contrato inicial</label>
                                <input class="form-control date datetimepicker" data-min-view="2"
                                    data-date-format="yyyy-mm-dd" id="init_date" name="init_date" type="text"
                                    placeholder="Fecha" value="{{ old('init_date') }}">
                                @error('init_date')
                                    *{{ $message }}
                                @enderror
                            </div>

                            <div class="col col-md-6 form-group">
                                <label for="end_date">Fin contrato</label>
                                <input class="form-control date datetimepicker" data-min-view="2"
                                    data-date-format="yyyy-mm-dd" id="end_date" name="end_date" type="text"
                                    placeholder="Fecha" value="{{ old('end_date') }}">
                                @error('end_date')
                                    *{{ $message }}
                                @enderror
                            </div>

                            <div class="col-md-6 col-sm-12 form-group">
                                <label for="result">Resultado</label>
                                <select class="form-control" id="result" name="result">
                                    <option value="" selected>Seleccionar opción</option>
                                    <option value="P" {{ old('result') == 'P' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="A" {{ old('result') == 'A' ? 'selected' : '' }}>Ampliar</option>
                                    <option value="B" {{ old('result') == 'B' ? 'selected' : '' }}>Baja</option>
                                </select>
                                @error('result')
                                    *{{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-lg-12 col-lg-6 pb-4 pb-lg-0">
                                <p class="text-right">
                                    <button class="btn btn-space btn-primary" type="submit">Guardar</button>
                                    <a href="{{ route('contracts.index') }}"
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
