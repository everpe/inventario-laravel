@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <br><br>
            <h2 class="text-white">Lista de ventas realizadas</h2>
        </div>
        <div>
            <a href="{{route('transacciones.create')}}" class="btn btn-success">Agregar nueva venta</a>
        </div>
    </div>

    <div class="col-12 mt-4">
        <table>
            <tbody>
                <table>
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Costo</th>
                            <th>Comentarios</th>
                            <th>Código Transacción</th>
                            <th>Número Transacción</th>
                            <th>Nombre Producto</th>
                            <th>Nombre Almacén</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaccionesRealizadas as $dato)
                        <tr>
                            <td>{{ $dato->Cantidad }}</td>
                            <td>{{ $dato->Costo }}</td>
                            <td>{{ $dato->Comentarios }}</td>
                            <td>{{ $dato->codigoTransaccion }}</td>
                            <td>{{ $dato->numeroTransaccion }}</td>
                            <td>{{ $dato->nombreProducto }}</td>
                            <td>{{ $dato->nombreAlmacen }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </tbody>
        </table>
    </div>
</div>
<style>
    table {
    width: 100%;
    border-collapse: collapse;
    background-color: #333;
    color: #fff;
}

/* Estilos para las celdas de la tabla */
td, th {
    padding: 10px;
    border: 1px solid #fff; /* Añade bordes a las celdas para mayor contraste */
}

/* Estilos para las filas pares */
tbody tr:nth-child(even) {
    background-color: #444; /* Color de fondo ligeramente más oscuro para filas pares */
}
</style>
@endsection