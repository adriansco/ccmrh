@extends('layouts.plantilla')

@section('title', 'Lista status')

@section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datatables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" />
@endsection

@section('page-title', 'Condiciones petición')

@section('content')
    <div class="mb-2 text-right">
        <a href="{{ route('conditions.create') }}" class="btn btn-space btn-primary"><i
                class="icon icon-left las la-user-plus"></i>Agregar</a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-header">Condiciones petición
                    {{-- <span class="text-right text-span"></span> --}}
                    <div class="tools">
                        <a href="{{ route('conditions.pdf') }}" title="Descargar PDF"><span
                                class="icon lar la-file-pdf"></span></a>
                        <a href="{{ route('conditions.excel') }}" title="Descargar EXCEL"><span
                                class="icon lar la-file-excel"></span></a>
                    </div>
                </div>
                <div class="card-body">{{--  --}}
                    <table class="table table-striped table-hover table-fw-widget" id="table4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th class="text-center" style="width:20%;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($conditions as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="centrar">
                                            <form action="{{ route('conditions.destroy', $item) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-rounded btn-primary mr-1"
                                                    href="{{ route('conditions.edit', $item) }}">Editar</a>
                                                <button
                                                    onclick="return confirm('¿Seguro que quieres eliminar el registro?, esta acción no se puede deshacer');"
                                                    class="btn btn-rounded btn-danger " type="submit">Eliminar</button>
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
