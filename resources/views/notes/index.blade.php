@extends('layouts.plantilla')

@section('title', 'Lista notas')

@section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datatables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" />
@endsection

@section('page-title', 'Notas')

@section('content')
    <div class="mb-2 text-right">
        <a href="{{ route('notes.create') }}" class="btn btn-space btn-primary"><i
                class="icon icon-left las la-user-plus"></i>Agregar</a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-header">Notas
                    {{-- <div class="tools">
                        <a href="{{ route('notes.pdf') }}" title="Descargar PDF"><span
                                class="icon lar la-file-pdf"></span></a>
                        <a href="{{ route('notes.excel') }}" title="Descargar EXCEL"><span
                                class="icon lar la-file-excel"></span></a>
                    </div> --}}
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-fw-widget" id="table4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th class="text-center" style="width:15%;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notes as $note)
                                <tr>
                                    <td>{{ $note->id }}</td>
                                    <td>{{ $note->name }}</td>
                                    <td>
                                        <div class="centrar">
                                            <form action="{{ route('notes.destroy', $note) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-sm btn-rounded btn-primary"
                                                    href="{{ route('notes.edit', $note) }}">Editar</a>
                                                <button
                                                    onclick="return confirm('¿Seguro que quieres eliminar el registro?, esta acción no se puede deshacer');"
                                                    class="btn btn-sm btn-rounded btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptzone')
    <script src="{{ asset('lib/datatables/datatables.net/js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('lib/datatables/datatables.net-responsive/js/dataTables.responsive.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('lib/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('js/app-tables-datatables.js') }}" type="text/javascript"></script>
@endsection

@section('appzone', 'App.dataTables();')
