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
        <h2 class="page-head-title">Modificar razón</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('notes.index') }}">Notas</a></li>
                {{-- <li class="breadcrumb-item"><a href="#">Tables</a></li> --}}
                <li class="breadcrumb-item active">Detalles razón</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header card-header-divider">Datos
                    {{ $note->name }}<span class="card-subtitle">Los campos
                        marcados con (*) son obligatorios.</span></div>
                <div class="card-body">
                    <form action="{{ route('notes.update', $note) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12 form-group">
                            <label for="name">*Nombre</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Ingresar nombre"
                                value="{{ old('name', $note->name) }}">
                            @error('name')
                                *{{ $message }}
                            @enderror
                        </div>
                        <div class="col-12 pt-3">
                            <p class="text-right">
                                <button class="btn btn-space btn-primary" type="submit">Submit</button>
                                <a href="{{ route('notes.index') }}" class="btn btn-space btn-danger">Cancel</a>
                            </p>
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
@endsection --}}

{{-- @section('appzone', 'App.formElements();') --}}
