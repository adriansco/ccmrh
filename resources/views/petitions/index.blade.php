@extends('layouts.plantilla')

@section('title', 'Peticiones')

@section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datatables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/colvis.min.css') }}" type="text/css" />
@endsection

@section('page-title', 'Peticiones')

@section('content')
    @can('admin.administration')
        <div class="mb-2 text-right">
            <a href="{{ route('petitions.create') }}" class="btn btn-space btn-primary"><i
                    class="icon icon-left las la-user-plus"></i>Agregar</a>
        </div>
    @endcan
    {{-- @can('admin.actions')
        {{ 'sdasdasddsa' }}
    @endcan
    @can('admin.actions')
        {{ 'asdasdasda' }}
        {{ auth()->user()->id }}
        {{ auth()->user()->roles[0]->name }}
    @endcan --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-header">Peticiones
                    {{-- <span class="text-right text-span"></span> --}}
                    <div class="tools">
                        <a href="{{ route('petitions.pdf') }}" title="Descargar PDF"><span
                                class="icon lar la-file-pdf"></span></a>
                        <a href="{{ route('petitions.excel') }}" title="Descargar EXCEL"><span
                                class="icon lar la-file-excel"></span></a>
                    </div>
                </div>
                {{-- <div>
                    Toggle column: <a class="toggle-vis" data-column="0" href="#">Name</a> - <a class="toggle-vis"
                        data-column="1" href="#">Position</a> - <a class="toggle-vis" data-column="2"
                        href="#">Office</a> - <a class="toggle-vis" data-column="3" href="#">Age</a> - <a
                        class="toggle-vis" data-column="4" href="#">Start
                        date</a> - <a class="toggle-vis" data-column="5" href="#">Salary</a>
                </div> --}}
                <div class="card-body">
                    {{-- <div class="page-head">
                        <div class="btn-group btn-hspace">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                data-toggle="dropdown">Ocultar/Mostrar columna
                                <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item toggle-vis" data-column="0" href="#">Id</a>
                                <a class="dropdown-item toggle-vis" data-column="1" href="#">¿Aplica compensación?</a>
                                <a class="dropdown-item toggle-vis" data-column="2" href="#">Categoría</a>
                            </div>
                        </div>
                    </div> --}}
                    <table class="table table-striped table-hover table-fw-widget" style="" id="table9">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>¿Compensación?</th>
                                <th>Categoría</th>
                                <th>User</th>
                                <th>Empleado</th>
                                <th>Departamento origen</th>
                                <th>Departamento destino</th>
                                <th>Status</th>
                                <th>Cambio de nómina</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
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
    <script src="{{ asset('js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/buttons.colVis.min.js') }}" type="text/javascript"></script>
@endsection

@section('appzone', 'App.dataTables();')
