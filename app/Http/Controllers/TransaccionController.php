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
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
 
        // $productosDisponibles = DB::select('SELECT * FROM inventarios');

        $productosDisponibles = DB::select('
        SELECT inventarios.*, productos.nombre AS nombre_producto
        FROM inventarios
        JOIN productos ON inventarios.producto_id = productos.id
    ');

            // Retornar la vista 'create-transaccion' con los datos pasados
        return view('create-transaccion')->with([
            'productosDisponibles' => $productosDisponibles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   
        $transaccionId = DB::table('transacciones')->insertGetId([
            // Colocar aquí los valores de los campos de la tabla 'transacciones'
            'Fecha' => now(),
            'Comentarios' => $request->Comentarios,
            'Codigo' => uniqid(),
            // Otros campos de la transacción
        ]);
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
