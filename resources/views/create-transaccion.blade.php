@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <br><br>
            <h2>Crear Nueva Facturación</h2>
        </div>
        <div>
            <a href="{{route('transacciones.index')}}" class="btn btn-info">Volver</a>
            <button type="button" id="agregarProducto" class="btn btn-primary">Agregar Producto</button>
        </div>
    </div>

    <form action="{{route('transacciones.store')}}"  method="POST">
        @csrf
        <div class="row">
            {{-- <h1>Facturación y ventas</h1> --}}
            {{-- <p>Número: <strong>001</strong></p>
            <p>Código: <strong>FACT-2024</strong></p> --}}
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Comentarios:</strong>
                    <textarea class="form-control" style="height:100px" name="Comentarios" placeholder="Comentarios de la venta ..."></textarea>
                </div>
            </div>
            <br><br><hr><br>
            <div id="productos-container">
                <div class="producto">
                    <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                        <div class="form-group">
                            <strong>Fecha Factura:</strong>
                            <input type="date" name="Fecha[]" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                        <div class="form-group">
                            <strong>Poductos disponibles</strong> <br>
                            <select name="productos_id[]" class="form-control">
                                <option value="">-- Productos en almacenes --</option>
                                @foreach($productosDisponibles as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre_producto }},  Disponible:{{ $producto->CantidadDisponible }},  Precio: {{$producto->costo_unitario }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            <input type="number" name="Cantidad[]" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                        <div class="form-group">
                            <strong>Costo :</strong>
                            <input type="number" name="Costo[]" class="form-control" max="9999999">
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-success">Registar nueva venta</button>
            </div>
        </div>
    </form>
</div>


<script>
    document.getElementById('agregarProducto').addEventListener('click', function () {
        var productosContainer = document.getElementById('productos-container');
        var productoHtml = `
            <div class="producto">
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Poductos disponibles </strong> <br>
                        <select name="productos_id[]" class="form-control">
                            <option value="">-- Productos en almacenes --</option>
                            @foreach($productosDisponibles as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre_producto }},  Disponible:{{ $producto->CantidadDisponible }},  Precio: {{$producto->costo_unitario }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Cantidad :</strong>
                        <input type="number" name="Cantidad[]" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Costo :</strong>
                        <input type="number" name="Costo[]" class="form-control">
                    </div>
                </div>
            </div>
        <hr>
        `;
        productosContainer.insertAdjacentHTML('beforeend', productoHtml);
    });
</script>
@endsection

