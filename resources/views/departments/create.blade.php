@extends('layouts.plantilla')

@section('title', 'Create')

@section('page-title', 'Create')

@section('breadcrumbs')
    <div class="page-head">
        <h2 class="page-head-title">Create departamento</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">Departamentos</a></li>
                {{-- <li class="breadcrumb-item"><a href="#">Tables</a></li> --}}
                <li class="breadcrumb-item active">Detalles departamento</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header card-header-divider">Datos del departamento<span class="card-subtitle">Los campos
                        marcados con (*) son obligatorios.</span></div>
                <div class="card-body">
                    <form action="{{ route('departments.store') }}" method="POST">
                        @csrf
                        <div class="form-group pt-2">
                            <label for="name">Nombre</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Ingresar nombre"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row pt-3">
                            <div class="col-lg-12 col-lg-6 pb-4 pb-lg-0">
                                <p class="text-right">
                                    <button class="btn btn-space btn-primary" type="submit">Submit</button>
                                    <a href="{{ route('departments.index') }}"
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

{{-- @section('scriptzone')
    <script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>
@endsection

@section('appzone', 'App.formElements();') --}}
