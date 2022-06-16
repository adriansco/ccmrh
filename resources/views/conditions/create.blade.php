@extends('layouts.plantilla')

@section('title', 'Crear')

{{-- @section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}" />
@endsection --}}

@section('page-title', 'Crear')

@section('breadcrumbs')
    <div class="page-head">
        <h2 class="page-head-title">Crear</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('conditions.index') }}">Razones</a></li>
                <li class="breadcrumb-item active">Crear</li>
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
                    <form action="{{ route('conditions.store') }}" method="POST">
                        @csrf
                        <div class="form-group pt-2">
                            <label for="name">Nombre</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Ingresar nombre"
                                value="{{ old('name') }}">
                            @error('name')
                                *{{ $message }}
                            @enderror
                        </div>
                        <div class="row pt-3">
                            <div class="col-lg-12 col-lg-6 pb-4 pb-lg-0">
                                <p class="text-right">
                                    <button class="btn btn-space btn-primary" type="submit">Submit</button>
                                    <a href="{{ route('conditions.index') }}" class="btn btn-space btn-secondary">Cancel</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('scriptzone')
    <script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>
@endsection

@section('appzone', 'App.formElements();') --}}
