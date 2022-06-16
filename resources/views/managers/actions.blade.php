{{-- <a class="btn btn-rounded btn-space btn-primary" href="{{ route('employees.show', $id) }}">Ver</a>
<a class="btn btn-rounded btn-space btn-success" href="{{ route('employees.edit', $id) }}">Editar</a>
<a class="btn btn-rounded btn-space btn-secondary" href="#">Cambio</a> --}}
<div class="btn-group btn-hspace">
    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Abrir <span
            class="icon-dropdown mdi mdi-chevron-down"></span></button>
    <div class="dropdown-menu" role="menu"><a class="dropdown-item"
            href="{{ route('employees.show', $id) }}">Ver</a><a class="dropdown-item"
            href="{{ route('employees.edit', $id) }}">Editar</a><a class="dropdown-item" href="#">Cambio</a>
        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Separated link</a>
    </div>
</div>
