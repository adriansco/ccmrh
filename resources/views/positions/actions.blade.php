<div class="centrar">
    <form action="{{ route('positions.destroy', $id) }}" method="POST">
        @csrf
        @method('delete')
        <a class="btn btn-sm btn-rounded btn-primary mr-1" href="{{ route('positions.edit', $id) }}">Editar</a>
        <button onclick="return confirm('¿Seguro que quieres eliminar el registro?, esta acción no se puede deshacer');"
            class="btn btn-sm btn-rounded btn-danger ml-1" type="submit">Eliminar</button>
    </form>
</div>
