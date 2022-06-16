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
        <h2 class="page-head-title">Crear usuario</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
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
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name"></label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                type="text" placeholder="Nombre" autocomplete="off" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email"></label>
                            <input class="form-control @error('name') is-invalid @enderror" id="email" name="email"
                                type="email" placeholder="Email" autocomplete="off" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password"></label>
                            <input class="form-control @error('name') is-invalid @enderror" id="password" name="password"
                                type="password" placeholder="Contraseña">
                            @error('password')
                                <span class="invalid-feedback">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Roles</label>
                            <select name="team[]" id="team" class="tags selectpicker" multiple>
                                @foreach ($roles as $tdrop => $id)
                                    @if (old('team'))
                                        <option value="{{ $id->id }}"
                                            {{ in_array($id->id, old('team')) ? 'selected' : '' }}>
                                            {{ $id->name }}
                                        </option>
                                    @else
                                        <option value="{{ $id->id }}">
                                            {{ $id->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group login-submit"><button class="btn btn-primary btn-xl" type="submit"
                                data-dismiss="modal">Registrarme</button></div> --}}
                        <div class="col-12 pt-3">
                            <p class="text-right">
                                <button class="btn btn-space btn-primary" type="submit">Submit</button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-space btn-danger">Cancel</a>
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
@endsection

@section('appzone', 'App.formElements();')
