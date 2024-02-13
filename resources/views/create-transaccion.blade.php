@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Crear Nueva Salida</h2>
        </div>
        <div>
            <a href="{{route('transacciones.index')}}" class="btn btn-primary">Volver</a>
        </div>
    </div>

    <form action="{{route('transacciones.store')}}"  method="POST">
        @csrf
        <div class="row">
            <h1>Factura</h1>
            <p>Número: <strong>001</strong></p>
            <p>Código: <strong>FACT-2024</strong></p>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Comentarios:</strong>
                    <textarea class="form-control" style="height:150px" name="Comentarios" placeholder="Comentarios venta.."></textarea>
                </div>
            </div>
            <br><br><hr><br>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Fecha Factura:</strong>
                    <input type="date" name="Fecha" class="form-control" id="">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Estado (inicial):</strong>
                    <select name="status" class="form-select" id="">
                        <option value="">-- Elige el status --</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="En progreso">En progreso</option>
                        <option value="Completada">Completada</option>
                    </select>
                    <select name="producto_id">
                        @foreach($productosDisponibles as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre_producto }} {{ $producto->CantidadDisponible }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </form>
</div>
@endsection