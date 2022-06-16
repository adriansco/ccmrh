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
        <h2 class="page-head-title">Modificar usuario</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
                {{-- <li class="breadcrumb-item"><a href="#">Tables</a></li> --}}
                <li class="breadcrumb-item active">Detalles usuario</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span
                        class="mdi mdi-close" aria-hidden="true"></span></button>
                <div class="icon"><span class="mdi mdi-check"></span></div>
                <div class="message"><strong>Bien!</strong> {{ session('info') }}.</div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header card-header-divider">Datos
                    {{ $user->name }}<span class="card-subtitle">Los campos
                        marcados con (*) son obligatorios.</span></div>
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12 form-group">
                            <label for="name">*Nombre</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Ingresar nombre"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="email">*Email</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Ingresar email"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Roles</label>
                            <div>
                                <div class="form-group">
                                    <select name="team[]" id="team" class="tags selectpicker" multiple>
                                        @foreach ($roles as $tdrop => $id)
                                            @if (old('team'))
                                                <option value="{{ $id->id }}"
                                                    {{ in_array($id->id, old('team')) ? 'selected' : '' }}>
                                                    {{ $id->name }}
                                                </option>
                                            @else
                                                <option value="{{ $id->id }}"
                                                    {{ $user->roles->contains($id->id) ? 'selected' : '' }}>
                                                    {{ $id->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- @foreach ($roles as $tdrop => $id)
                            {{ 'id =>' . $id }}
                            <br>
                            {{ 'tdrop => ' . $tdrop }}
                            <br>
                        @endforeach --}}
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
