<a class="btn btn-sm btn-rounded btn-primary" href="{{ route('departments.edit', $id) }}">Editar</a>
<a href="{{ route('departments.destroy', $id) }}" data-id="{{ $id }}" class="btn btn-sm btn-rounded btn-danger ml-1"
    id="destroyDepartment" type="submit">Eliminar</a>

    {{-- onclick="return confirm('¿Seguro que quieres eliminar el registro?, esta acción no se puede deshacer');" --}}
