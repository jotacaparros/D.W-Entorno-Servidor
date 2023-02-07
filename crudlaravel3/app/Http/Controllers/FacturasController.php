<?php

namespace App\Http\Controllers;

use App\Models\Facturas;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar = trim($request->get('buscar'));
        $facturas = DB::table('facturas')
                        ->select('*')
                        ->where('numero', 'LIKE', '%' . $buscar . '%')
                        ->orWhere('id_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('numero', 'asc')
                        ->paginate(10);

        return view('facturas.index', compact('facturas', 'buscar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('facturas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
          // Permitir el método POST
        

        $datosFactura = $request->except('_token');                           

        Facturas::insert($datosFactura);

        return redirect('facturas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facturas  $facturas
     * @return \Illuminate\Http\Response
     */
    public function show(Facturas $facturas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facturas  $facturas
     * @return \Illuminate\Http\Response
     */
    public function edit(Facturas $facturas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facturas  $facturas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facturas $facturas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facturas  $facturas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // $datos = Facturas::findOrFail($id);

        
        Facturas::destroy($id);

        return redirect('facturas')->with('mensaje', 'Factura borrada.');
    }
}
