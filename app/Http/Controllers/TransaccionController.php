<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
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
        return view('index')->with([ 'transaccionesRealizadas' => $detallesTransacciones]);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productosDisponibles = DB::select('
            SELECT inventarios.*, productos.nombre AS nombre_producto, productos.CostoUnitario as costo_unitario
            FROM inventarios
            JOIN productos ON inventarios.producto_id = productos.id
        ');

        return view('create-transaccion')->with([ 'productosDisponibles' => $productosDisponibles]);
    }

    /**
     * permite registra una transaccion y el detalle de sus productos.
     */
    public function store(Request $request)
    {
   
        $transaccionId = DB::table('transacciones')->insertGetId([
            'Fecha' => now(),
            'Comentarios' => $request->Comentarios,
            'Codigo' => uniqid(),
        ]);

        $contador = 0;

        foreach ($request->productos_id as $inventarioId) {
            $inventario = DB::table('inventarios')->where('id', $inventarioId)->first();
            DB::table('detalle_transacciones')->insert([
                'transaccion_id' => $transaccionId,
                'producto_id' => $inventario->producto_id,
                'almacen_id' => $inventario->almacen_id,
                'Cantidad' => $request->Cantidad[$contador],
                'Costo' => $request->Costo[$contador],
            ]);
            // echo "Número: $inventario->id \n";
            $contador++;
        }
        dd($request->all());
    
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
