@extends('layouts.plantilla')

@section('title', 'Lista roles')

@section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datatables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" />
@endsection

@section('page-title', 'Roles')

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
    <div class="mb-2 text-right">
        <a href="{{ route('roles.create') }}" class="btn btn-space btn-primary"><i
                class="icon icon-left las la-user-plus"></i>Agregar</a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-header">Roles
                    {{-- <span class="text-right text-span"></span> --}}
                    <div class="tools">
                        <a href="{{ route('roles.pdf') }}" title="Descargar PDF"><span
                                class="icon lar la-file-pdf"></span></a>
                        <a href="{{ route('roles.excel') }}" title="Descargar EXCEL"><span
                                class="icon lar la-file-excel"></span></a>
                    </div>
                </div>
                <div class="card-body">{{--  --}}
                    <table class="table table-striped table-hover table-fw-widget" id="table4">
                        <thead>
                            <tr>
                                <th style="width:15%;">ID</th>
                                <th>Nombre</th>
                                <th class="text-center" style="width:15%;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="centrar">
                                            <form action="{{ route('roles.destroy', $role) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-sm btn-rounded btn-primary "
                                                    href="{{ route('roles.edit', $role) }}">Editar</a>
                                                <button
                                                    onclick="return confirm('¿Seguro que quieres eliminar el registro?, esta acción no se puede deshacer');"
                                                    class="btn btn-sm btn-rounded btn-danger " type="submit">Eliminar</button>
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
