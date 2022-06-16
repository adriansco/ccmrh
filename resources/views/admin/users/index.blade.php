@extends('layouts.plantilla')

@section('title', 'Lista Empleados')

@section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datatables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" />
@endsection

@section('page-title', 'Usuarios')

@section('content')
    <div class="mb-2 text-right">
        <a href="{{ route('admin.users.create') }}" class="btn btn-space btn-primary"><i
                class="icon icon-left las la-user-plus"></i>Agregar</a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-header">Usuarios
                    {{-- <span class="text-right text-span"></span> --}}
                    {{-- <div class="tools">
                        <a href="{{ route('admin.users.pdf') }}" title="Descargar PDF"><span
                                class="icon lar la-file-pdf"></span></a>
                        <a href="{{ route('admin.users.excel') }}" title="Descargar EXCEL"><span
                                class="icon lar la-file-excel"></span></a>
                    </div> --}}
                </div>
                <div class="card-body">{{--  --}}
                    <table class="table table-striped table-hover table-fw-widget" id="table4" style="width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="centrar">
                                            <div class="btn-group-ea align-middle">
                                                <a class="btn btn-primary mr-1"
                                                    href="{{ route('admin.users.edit', $user) }}" role="button">Editar</a>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="event.preventDefault(); document.getElementById('delete-user-form-{{ $user->id }}').submit()">Eliminar</button>
                                            </div>
                                            <form id="delete-user-form-{{ $user->id }}"
                                                action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                style="display: none">
                                                @csrf
                                                @method('DELETE')
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
