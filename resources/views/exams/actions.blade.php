<div class="btn-group btn-hspace">
    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Abrir <span
            class="icon-dropdown mdi mdi-chevron-down"></span></button>
    <div class="dropdown-menu" role="menu">
        <a class="dropdown-item" href="{{ route('departments.show', $id) }}">Ver</a>
        <a class="dropdown-item" href="{{ route('departments.edit', $id) }}">Editar</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Dar de baja</a>
    </div>
</div>
