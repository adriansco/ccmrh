<div class="btn-group btn-hspace">
    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Abrir <span
            class="icon-dropdown mdi mdi-chevron-down"></span></button>
    <div class="dropdown-menu" role="menu">
        <a class="dropdown-item" href="{{ route('petitions.show', $id) }}">Ver</a>
        <a class="dropdown-item" href="{{ route('petitions.edit', $id) }}">Editar</a>
        <a class="dropdown-item" href="#">Actualizar status</a>
        <a class="dropdown-item" href="{{ route('petitions.exam', $id) }}">Ver exámenes</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Cancelar movimiento</a>
    </div>
</div>
