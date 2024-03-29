@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <br>
        <div>
            <a href="{{route('transacciones.index')}}" class="btn btn-outline-info">Volver</a>
           
        </div>
        <div>
            <h2 class="center">Facturación</h2>
            <br>
            <h4> <b>Código de factura: </b>{{$codigoUidTransaccion}} </h4>
            <button type="button" id="agregarProducto" class="btn btn-primary">Agregar producto</button>
        </div>
    </div>

    <form action="{{route('transacciones.store')}}"  method="POST">
        @csrf
        <input type="hidden" name="codigoTransaccionUid" value="{{ $codigoUidTransaccion }}">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Comentarios:</strong>
                    <textarea class="form-control" style="height:100px" name="Comentarios" placeholder="Comentarios de la venta ..."></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Fecha Factura:</strong>
                    <input type="date" name="Fecha[]" class="form-control">
                </div>
            </div>
            <br><br>
            <div id="productos-container">
                <div class="producto">
                    <hr>
                    <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                        <div class="form-group">
                            <strong>Poductos disponibles</strong> <br>
                            <select name="productos_id[]" class="form-control producto-select">
                                <option value="">-- Productos en almacenes --</option>
                                @foreach($productosDisponibles as $producto)
                                {{-- <option value="{{ $producto->id }}">{{ $producto->nombre_producto }},  Disponible:{{ $producto->CantidadDisponible }},  Precio: {{$producto->costo_unitario }}</option> --}}
                                <option value="{{ $producto->id }}" data-costo="{{ $producto->costo_unitario }}" data-cantidad-disponible="{{ $producto->CantidadDisponible }}">{{ $producto->nombre_producto }}, Disponible: {{ $producto->CantidadDisponible }}, Precio: {{ $producto->costo_unitario }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            <input type="number" name="Cantidad[]" class="form-control cantidad-input">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                        <div class="form-group">
                            <strong>Costo :</strong>
                            <input type="number" name="Costo[]" class="form-control costo-input" readonly>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-success">Registrar nueva venta</button>
            </div>
        </div>
    </form>
</div>



<script>
    // Crea dinámicamente los inputs para agregar productos
    document.getElementById('agregarProducto').addEventListener('click', function () {
        var productosContainer = document.getElementById('productos-container');
        var productoHtml = `
            <div class="producto">
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Productos disponibles</strong> <br>
                        <select name="productos_id[]" class="form-control producto-select">
                            <option value="">-- Productos en almacenes --</option>
                            @foreach($productosDisponibles as $producto)
                                <option value="{{ $producto->id }}" data-costo="{{ $producto->costo_unitario }}" data-cantidad-disponible="{{ $producto->CantidadDisponible }}">{{ $producto->nombre_producto }}, Disponible: {{ $producto->CantidadDisponible }}, Precio: {{ $producto->costo_unitario }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Cantidad:</strong>
                        <input type="number" name="Cantidad[]" class="form-control cantidad-input">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Costo :</strong>
                        <input type="number" name="Costo[]" class="form-control costo-input" readonly>
                    </div>
                </div>
                <hr>
            </div>
        `;
        productosContainer.insertAdjacentHTML('beforeend', productoHtml);
        // Después de agregar el nuevo campo dinámico, vincular el evento de cambio nuevamente
        document.querySelectorAll('.cantidad-input, .producto-select').forEach(function(element) {
            element.addEventListener('change', calcularCosto);
        });
    });




    //validaciones de Costo, y Cantidad disponible en inventario
    function calcularCosto() {
        var productoSelects = document.querySelectorAll('.producto-select');
        productoSelects.forEach(function(select) {
            var cantidadInput = select.closest('.producto').querySelector('.cantidad-input');
            var costoInput = select.closest('.producto').querySelector('.costo-input');
            var costoUnitario = parseFloat(select.options[select.selectedIndex].getAttribute('data-costo'));
            var cantidad = parseFloat(cantidadInput.value);
            var cantidadDisponible = parseFloat(select.options[select.selectedIndex].getAttribute('data-cantidad-disponible'));
            
            // Verificar si la cantidad ingresada es mayor que la cantidad disponible
            if (cantidad > cantidadDisponible) {
                alert('¡La cantidad ingresada excede la cantidad disponible!');
                cantidadInput.value = cantidadDisponible; // Establecer la cantidad disponible como la cantidad máxima permitida
                cantidad = cantidadDisponible; // Actualizar la cantidad con la cantidad disponible
            }
            
            // Calcular el costo solo si la cantidad es válida
            if (!isNaN(costoUnitario) && !isNaN(cantidad)) {
                costoInput.value = (costoUnitario * cantidad).toFixed(2);
            } else {
                costoInput.value = '';
            }
        });
    }
    //Llamar a la función calcularCosto cada vez que cambia la cantidad o se selecciona un nuevo producto
    document.querySelectorAll('.cantidad-input, .producto-select').forEach(function(element) {
        element.addEventListener('change', calcularCosto);
    });



</script>




<style>
    .center{
        text-align: center;
    }
</style>


@endsection

