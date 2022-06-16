@extends('layouts.plantilla')

@section('title', 'Detalles')

@section('csszone')

@endsection

@section('page-title', 'Detalles')

@section('breadcrumbs')
    <div class="page-head">
        <h2 class="page-head-title">Detalles empleado</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Empleados</a></li>
                {{-- <li class="breadcrumb-item"><a href="#">Tables</a></li> --}}
                <li class="breadcrumb-item active">Detalles empleado</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header">Detalles de: {{ $employee->first_name . ' ' . $employee->last_name }}</div>
                <div class="card-body table-responsive">

                    <div class="dropdown-divider"></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:10%;">Número de nómina</th>
                                <th style="width:10%;">Género</th>
                                <th style="width:15%;">Fecha de contratación</th>
                                <th style="width:15%;">Departamento actual</th>
                                <th style="width:10%;">Puesto actual</th>
                                <th style="width:10%;">Rol actual</th>
                                <th style="width:20%;" class="text-center">Jefe/Supervisor</th>
                                <th style="width:10%;" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $employee->payroll }}</td>
                                <td>{{ $employee->gender }}</td>
                                <td>{{ $employee->hire_date }}</td>
                                <td>{{ $department->name }}</td>
                                <td>
                                    @foreach ($employee->positions as $item)
                                        {{ $item->pivot->to_date ? '' : $item->name }}
                                    @endforeach
                                </td>
                                <td>
                                    <span>rol</span>
                                    {{-- @foreach ($employee->roles as $item)
                                        {{ $item->pivot->to_date ? '' : $item->name }}
                                    @endforeach --}}
                                </td>
                                <td class="text-center">
                                    {{--  --}}
                                    @foreach ($department->managers as $item)
                                        <span class="text-success">
                                            {{ $item->first_name . ' ' . $item->last_name }} - </span>
                                        @foreach ($item->positions as $caos)
                                            {{ $caos->pivot->to_date ? '' : $caos->name }}
                                        @endforeach
                                        <br>
                                    @endforeach
                                    {{--  --}}
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $employee->status == 'A' ? 'badge-success' : 'badge-danger' }}">{{ $employee->status }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-1 text-right">
                    <form action="{{ route('employees.destroy', $employee) }}" method="POST">
                        @csrf
                        @method('delete')
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-space btn-primary"><i
                                class="icon icon-left lar la-edit"></i>Modificar</a>
                        <button type="submit" class="btn btn-space btn-danger"><i
                                class="icon icon-left las la-eraser"></i>Eliminar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card card-table">
                <div class="card-header">
                    <div class="title">Histórico departamentos</div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th style="width:30%;">Nombre</th>
                                <th style="width:25%;">Fecha Inicio</th>
                                <th style="width:25%;">Fecha Fin</th>
                                {{-- <th class="actions" style="width:5%;"></th> --}}
                            </tr>
                        </thead>
                        <tbody class="no-border-x">
                            @foreach ($employee->departments as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->pivot->from_date }}</td>
                                    <td class="text-danger">{{ $item->pivot->to_date }}</td>
                                    {{-- <td class="actions"><a class="icon" href="#"><i
                                                class="mdi mdi-plus-circle-o"></i></a></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- <div class="col-12 col-lg-4">
            <div class="card card-table">
                <div class="card-header">
                    <div class="title">Histórico roles</div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th style="width:30%;">Nombre</th>
                                <th style="width:25%;">Fecha Inicio</th>
                                <th style="width:25%;">Fecha Fin</th>
                            </tr>
                        </thead>
                        <tbody class="no-border-x">
                            @foreach ($employee->roles as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->pivot->from_date }}</td>
                                    <td class="text-danger">{{ $item->pivot->to_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        <div class="col-12 col-lg-4">
            <div class="card card-table">
                <div class="card-header">
                    <div class="title">Histórico Puestos</div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th style="width:30%;">Nombre</th>
                                <th style="width:25%;">Fecha Inicio</th>
                                <th style="width:25%;">Fecha Fin</th>
                                {{-- <th class="actions" style="width:5%;"></th> --}}
                            </tr>
                        </thead>
                        <tbody class="no-border-x">
                            @foreach ($employee->positions as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->pivot->from_date }}</td>
                                    <td class="text-danger">{{ $item->pivot->to_date }}</td>
                                    {{-- <td class="actions"><a class="icon" href="#"><i
                                                class="mdi mdi-plus-circle-o"></i></a></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card card-table">
                <div class="card-header">
                    <div class="title">Histórico Grupos/Nóminas</div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th style="width:30%;">Nombre</th>
                                <th style="width:25%;">Fecha Inicio</th>
                                <th style="width:25%;">Fecha Fin</th>
                                {{-- <th class="actions" style="width:5%;"></th> --}}
                            </tr>
                        </thead>
                        <tbody class="no-border-x">
                            @foreach ($employee->groups as $item)
                                <tr>
                                    <td>{{ $item->code . ' - ' . $item->name }}</td>
                                    <td>{{ date('Y-m-d', strtotime($item->pivot->created_at)) }}</td>
                                    <td class="text-danger">{{ $item->pivot->finished_at }}</td>
                                    {{-- <td class="actions"><a class="icon" href="#"><i
                                                class="mdi mdi-plus-circle-o"></i></a></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
