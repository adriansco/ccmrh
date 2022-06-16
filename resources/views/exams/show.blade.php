@extends('layouts.plantilla')

@section('title', 'Detalles')

@section('page-title', 'Detalles')

@section('breadcrumbs')
    <div class="page-head">
        <h2 class="page-head-title">Detalles examen</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('exams.index') }}">Exámenes</a></li>
                {{-- <li class="breadcrumb-item"><a href="#">Tables</a></li> --}}
                <li class="breadcrumb-item active">Detalles examen</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header">Detalles del examen {{ $exam->name }}</div>
                <div class="card-body table-responsive">
                    <div class="mb-2 text-right">
                        <form action="{{ route('exams.destroy', $exam) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="{{ route('exams.edit', $exam) }}" class="btn btn-space btn-primary"><i
                                    class="icon icon-left lar la-edit"></i>Modificar</a>
                            <button
                                onclick="return confirm('¿Seguro que quieres eliminar el registro?, esta acción no se puede deshacer');"
                                type="submit" class="btn btn-space btn-danger"><i
                                    class="icon icon-left las la-eraser"></i>Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
