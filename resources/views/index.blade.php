@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">Lista de ventas realizadas</h2>
        </div>
        <div>
            <a href="{{route('transacciones.create')}}" class="btn btn-success">Agregar nueva venta</a>
        </div>
    </div>

    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Id</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Costo</th>
                <th>Cantidad</th>
            </tr>
            <tr>
                <td class="fw-bold">Estudiar Laravel</td>
                <td>Ver video: tu primer CRUD con laravel 10 en el canal de YouDevs</td>
                <td>
                    31/03/23
                </td>
                <td>
                    <span class="badge bg-warning fs-6">Pendiente</span>
                </td>
                <td>
                    <p>53</p>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection