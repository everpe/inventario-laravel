<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaccionController extends Controller
{
    /**
     * Lista todas las ventas o transacciones que se han realizado.
     */
    public function index()
    {
        $detallesTransacciones = DB::table('detalle_transacciones')
        ->join('transacciones', 'detalle_transacciones.transaccion_id', '=', 'transacciones.id')
        ->join('productos', 'detalle_transacciones.producto_id', '=', 'productos.id')
        ->join('almacenes', 'detalle_transacciones.almacen_id', '=', 'almacenes.id')
        ->select('detalle_transacciones.*', 'transacciones.Comentarios', 'transacciones.Codigo as codigoTransaccion', 'transacciones.id as numeroTransaccion','productos.Nombre as nombreProducto', 'almacenes.nombre AS nombreAlmacen')
        ->get();
        // dd($detallesTransacciones);
        return view('index')->with([ 'transaccionesRealizadas' => $detallesTransacciones]);
    }

    /**
     * Permite visualizar una ruta que contiene el fomrulario para crear una DetalleTransanccion o Venta.
     */
    public function create()
    {
        $productosDisponibles = DB::select('
            SELECT inventarios.*, productos.nombre AS nombre_producto, productos.CostoUnitario as costo_unitario
            FROM inventarios
            JOIN productos ON inventarios.producto_id = productos.id
        ');

        return view('create-transaccion')->with([ 
            'productosDisponibles' => $productosDisponibles, 
            'codigoUidTransaccion' => uniqid()]);
    }

    /**
     * Perrmite registrar una transaccion o Venta y el detalle de sus productos.
     */
    public function store(Request $request)
    {
        //inserta transaccion o Encabezado
        $transaccionId = DB::table('transacciones')->insertGetId([
            'Fecha' => now(),
            'Comentarios' => $request->Comentarios,
            'Codigo' => $request->codigoTransaccionUid,
        ]);

        $contador = 0;

        //guardamos los items de la venta o detalles
        foreach ($request->productos_id as $inventarioId) {
            $inventario = DB::table('inventarios')->where('id', $inventarioId)->first();
            DB::table('detalle_transacciones')->insert([
                'transaccion_id' => $transaccionId,
                'producto_id' => $inventario->producto_id,
                'almacen_id' => $inventario->almacen_id,
                'Cantidad' => $request->Cantidad[$contador],
                'Costo' => $request->Costo[$contador],
            ]);
            $contador++;
        }


        //vuelvo y conslto todas las ventas en BD
        $detallesTransacciones = DB::table('detalle_transacciones')
        ->join('transacciones', 'detalle_transacciones.transaccion_id', '=', 'transacciones.id')
        ->join('productos', 'detalle_transacciones.producto_id', '=', 'productos.id')
        ->join('almacenes', 'detalle_transacciones.almacen_id', '=', 'almacenes.id')
        ->select('detalle_transacciones.*', 'transacciones.Comentarios', 'transacciones.Codigo as codigoTransaccion', 'transacciones.id as numeroTransaccion','productos.Nombre as nombreProducto', 'almacenes.nombre AS nombreAlmacen')
        ->get();
        //dd($request->all());
        return view('index')->with([ 'transaccionesRealizadas' => $detallesTransacciones]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }
         
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
