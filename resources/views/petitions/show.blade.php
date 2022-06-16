@extends('layouts.plantilla')

@section('title', 'Detalles')

@section('csszone')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/datatables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" />
@endsection

@section('page-title', 'Detalles')

@section('breadcrumbs')
    <div class="page-head">
        <h2 class="page-head-title">Detalles del movimiento</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ route('petitions.index') }}">Movimientos</a></li>
                <li class="breadcrumb-item active">Detalles del movimiento</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    @php
    $maxdata = '0000-00-00';
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="card card-border-color card-border-color-primary">
                <div class="card-header">Detalles del movimiento {{ $petition->id }}</div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:10%;">Nombre del empleado</th>
                                <th style="width:10%;">Número de nómina</th>
                                <th style="width:10%;">Solicitante</th>
                                <th style="width:10%;">Categoría</th>
                                <th style="width:10%;">Departamento origen</th>
                                <th style="width:10%;">Departamento destino</th>
                                <th style="width:10%;" class="text-center">Fecha inicio</th>
                                <th style="width:10%;" class="text-center">Fecha fin</th>
                                <th style="width:10%;" class="text-center">Status actual</th>
                                <th style="width:10%;" class="text-center">Actualizado por</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $petition->employee->first_name . ' ' . $petition->employee->last_name }}</td>
                                <td>{{ $petition->employee->payroll }}</td>
                                <td>{{ $petition->user->name }}</td>
                                <td>{{ $petition->category->name }}</td>
                                <td>{{ $petition->department($petition->department_source) }}</td>
                                <td>{{ $petition->department($petition->department_destiny) }}</td>
                                <td class="text-center">{{ $petition->start_date }}</td>
                                @if (date('Y-m-d') > $petition->end_date)
                                    <td class="text-center text-danger">{{ $petition->end_date }}</td>
                                @else
                                    <td class="text-center text-success">{{ $petition->end_date }}</td>
                                @endif
                                @foreach ($petition->conditions as $item)
                                    @if ($item->pivot->date_change > $maxdata)
                                        @php
                                            $maxdata = $item->pivot->date_change;
                                        @endphp
                                        <td class="text-center">{{ $item->name }}</td>
                                        <td class="text-center">
                                            {{ $petition->findUser($item->pivot->user_id) }}</td>
                                    @endif
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                @can('admin.administration')
                    <div class="p-1 text-right">
                        <form action="{{ route('petitions.destroy', $petition) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="{{ route('petitions.edit', $petition) }}" class="btn btn-space btn-primary"><i
                                    class="icon icon-left lar la-edit"></i>Modificar</a>
                            <button type="submit" class="btn btn-space btn-danger"><i
                                    class="icon icon-left las la-eraser"></i>Eliminar</button>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    {{-- Historial cambios --}}
    <div class="row">
        {{-- <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">Latest Activity</div>
                <div class="card-body">
                    <ul class="user-timeline user-timeline-compact">
                        <li class="latest">
                            <div class="user-timeline-date">Just Now</div>
                            <div class="user-timeline-title">Create New Page</div>
                            <div class="user-timeline-description">Vestibulum lectus nulla, maximus in eros non, tristique.
                            </div>
                        </li>
                        <li>
                            <div class="user-timeline-date">Today - 15:35</div>
                            <div class="user-timeline-title">Back Up Theme</div>
                            <div class="user-timeline-description">Vestibulum lectus nulla, maximus in eros non, tristique.
                            </div>
                        </li>
                        <li>
                            <div class="user-timeline-date">Yesterday - 10:41</div>
                            <div class="user-timeline-title">Changes In The Structure</div>
                            <div class="user-timeline-description">Vestibulum lectus nulla, maximus in eros non, tristique.
                            </div>
                        </li>
                        <li>
                            <div class="user-timeline-date">Yesterday - 3:02</div>
                            <div class="user-timeline-title">Fix the Sidebar</div>
                            <div class="user-timeline-description">Vestibulum lectus nulla, maximus in eros non, tristique.
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
        <div class="col-12">
            <div class="card card-table">
                <div class="card-header">Histórico de actualizaciones</div>
                <div class="p-1 text-right">
                    <button class="btn btn-space btn-primary" data-toggle="modal" data-target="#addConditionModal"
                        type="button"><i class="icon icon-left las la-plus-circle"></i> Actualizar</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-fw-widget" id="table1" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Usuario que actualizo</th>
                                <th>Motivo</th>
                                <th class="text-center">Fecha de actualización</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($petition->conditions as $item)
                                <tr
                                    class="odd gradeX {{ $item->pivot->date_change == $maxdata ? 'table-success' : '' }}">
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $petition->findUser($item->pivot->user_id) }}</td>
                                    <td>{{ $item->pivot->comment }}</td>
                                    <td class="text-center"> {{ $item->pivot->date_change }}</td>
                                    <td>
                                        <div class="centrar">
                                            <a href="" data-id="" class="btn btn-primary ml-1 editbtn" id=""
                                                type="submit">Editar</a>
                                            <a href="" data-petition-id="" data-id=""
                                                class="btn btn-danger ml-1 destroystatus" id="" type="submit">Eliminar</a>
                                            {{-- <form action="{{ route('roles.destroy', $item) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-sm btn-primary "
                                                    href="{{ route('roles.edit', $item) }}">Editar</a>
                                                <button
                                                    onclick="return confirm('¿Seguro que quieres eliminar el registro?, esta acción no se puede deshacer');"
                                                    class="btn btn-sm btn-danger "
                                                    type="submit">Eliminar</button>
                                            </form> --}}
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

    {{-- Init Modal --}}
    <div class="modal fade" id="addConditionModal" tabindex="-1" aria-labelledby="addConditionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addConditionModalLabel">Agregar datos de actualización</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span
                            class="mdi mdi-close"></span></button>
                </div>
                <div class="modal-body">
                    <ul id="save_msgList"></ul>
                    <input type="hidden" id="petition_id" value="{{ $petition->id }}" />
                    <div class="form-group mb-3">
                        <label for="">Status</label>
                        <div class="">
                            <select class="form-control condition_id" id="condition_id" name="condition_id">
                                <option value="" selected disabled hidden>Seleccionar opción...</option>
                                @foreach ($conditions as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('exam') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="date_change">Fecha</label>
                        <input class="form-control date datetimepicker date_change" data-min-view="2"
                            data-date-format="yyyy-mm-dd" id="date_change" name="date_change" type="text"
                            placeholder="Fecha">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Comentarios</label>
                        <input type="text" required class="form-control comment">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-space btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary add-status">Guardar</button>
                </div>

            </div>
        </div>
    </div>
    {{-- End Modal --}}
@endsection

@section('scriptzone')
    <script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datatables/datatables.net/js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('lib/datatables/datatables.net-responsive/js/dataTables.responsive.min.js') }}"
        type="text/javascript"></script>
    {{-- <script src="{{ asset('lib/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"
        type="text/javascript"></script> --}}
    {{-- <script src="{{ asset('js/app-tables-datatables.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('js/app-condition-petition.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}" type="text/javascript"></script>
@endsection

{{-- @section('appzone', 'App.dataTables();') --}}

{{-- @section('scriptzone')
    <script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>
@endsection

@section('appzone', 'App.formElements();') --}}
