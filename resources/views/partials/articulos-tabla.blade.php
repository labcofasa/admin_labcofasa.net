@foreach($articulos as $articulo)
    <tr>
        <td>{{ $articulo->codigo }}</td>
        <td>{{ $articulo->nombre }}</td>
        <td>
            <button class="btn btn-danger btn-sm" data-id="{{ $articulo->codigo }}" onclick="eliminarArticulo(this)">Eliminar</button>
        </td>
    </tr>
@endforeach
