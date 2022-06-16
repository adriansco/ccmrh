<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a class="left-sidebar-toggle" href="#">Dashboard</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">Menu</li>
                        {{-- <li class="{{ !Route::is('dashboard.index') ?: 'active' }}"><a
                                href="{{ route('dashboard.index') }}">
                                <i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
                        </li> --}}
                        @can('admin.administration')
                            <li class="parent {{ !Route::is('employees*') ?: 'active open' }}">
                                <a href="#"><i class="icon las la-industry"></i><span>Empresa</span></a>
                                <ul class="sub-menu">
                                    <li class="{{ !Route::is('employees*') ?: 'active' }}">
                                        <a href="{{ route('employees.index') }}">Empleados</a>
                                    </li>
                                    <li class="{{ !Route::is('brigada*') ?: 'active' }}">
                                        <a href="{{ route('brigada.index') }}">Brigadistas</a>
                                    </li>
                                    <li class="{{ !Route::is('managers.*') ?: 'active' }}">
                                        <a href="{{ route('managers.index') }}">Responsables de área</a>
                                    </li>
                                    <li class="{{ !Route::is('departments*') ?: 'active' }}">
                                        <a href="{{ route('departments.index') }}">Departamentos</a>
                                    </li>
                                    <li class="{{ !Route::is('positions*') ?: 'active' }}">
                                        <a href="{{ route('positions.index') }}">Puestos de trabajo</a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        <li class="parent {{ !Route::is('notes*') ?: 'active open' }}">
                            <a href="#"><i class="icon las la-sync-alt"></i><span>Movimientos</span></a>
                            <ul class="sub-menu">
                                {{-- <li class="{{ !Route::is('petitions*') ?: 'active' }}">
                                    <a href="{{ route('petitions.index') }}">Agendas de inducción</a>
                                </li> --}}
                                <li class="{{ !Route::is('petitions*') ?: 'active' }}">
                                    <a href="{{ route('petitions.index') }}">Cambios</a>
                                </li>
                                <li class="{{ !Route::is('notes*') ?: 'active' }}">
                                    <a href="{{ route('notes.index') }}">Resultados</a>
                                </li>
                                <li class="{{ !Route::is('conditions*') ?: 'active' }}">
                                    <a href="{{ route('conditions.index') }}">Status para peticiones</a>
                                </li>
                                <li class="{{ !Route::is('categories*') ?: 'active' }}">
                                    <a href="{{ route('categories.index') }}">Categorías</a>
                                </li>
                                <li class="{{ !Route::is('exams*') ?: 'active' }}">
                                    <a href="{{ route('exams.index') }}">Filtros</a>
                                </li>
                                @can('admin.administration')
                                    <li>
                                        <a href="{{ route('not-foun-404') }}">Forgot Password</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        @can('admin.administration')
                            <li class="parent {{ !Route::is('users*') ?: 'active open' }}">
                                <a href="#"><i class="icon las la-tools"></i><span>Administrador</span></a>
                                <ul class="sub-menu">
                                    <li class="{{ !Route::is('admin.users*') ?: 'active' }}">
                                        <a href="{{ route('admin.users.index') }}">Usuarios</a>
                                    </li>
                                    <li class="{{ !Route::is('roles*') ?: 'active' }}">
                                        <a href="{{ route('roles.index') }}">Roles</a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        @can('admin.administration')
                            <li class="parent {{ !Route::is('contracts*') ?: 'active open' }}">
                                <a href="#"><i class="icon las la-file-alt"></i><span>Contratos</span></a>
                                <ul class="sub-menu">
                                    <li class="{{ !Route::is('contracts.*') ?: 'active' }}">
                                        <a href="{{ route('contracts.index') }}">Seguimiento de contratos</a>
                                    </li>
                                    {{-- <li class="{{ !Route::is('roles*') ?: 'active' }}">
                                        <a href="{{ route('roles.index') }}">otro</a>
                                    </li> --}}
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </div>
            </div>
        </div>
        <div class="progress-widget">
            <div class="progress-data"><span class="progress-value">60%</span><span class="name">Current
                    Project</span></div>
            <div class="progress">
                <div class="progress-bar progress-bar-primary" style="width: 60%;"></div>
            </div>
        </div>
    </div>
</div>
