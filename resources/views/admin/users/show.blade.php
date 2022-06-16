@extends('layouts.plantilla')

@section('title', 'Detalles')

{{-- @section('csszone')
    
@endsection --}}

@section('page-title', 'Detalles')

@section('breadcrumbs')
    <div class="page-head">
        <h2 class="page-head-title">Detalles</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
                <li class="breadcrumb-item active">Detalles usuario</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header">{{ $user->name }}</div>
                <div class="card-body">
                    <p class="h5">Email: {{ $user->email }}</p>
                </div>
                <div class="p-1 text-right">
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                        @csrf
                        @method('delete')
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-space btn-primary"><i
                                class="icon icon-left lar la-edit"></i>Modificar</a>
                        <button type="submit" class="btn btn-space btn-danger"><i
                                class="icon icon-left las la-eraser"></i>Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
