<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar = trim($request->get('buscar'));
        $clientes = DB::table('clientes')
                        ->select('*')
                        ->where('nombre', 'LIKE', '%' . $buscar . '%')
                        ->orWhere('email', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('nombre', 'asc')
                        ->paginate(10);

        return view('clientes.index', compact('clientes', 'buscar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'nombre' => 'required|string|max:64',
            'direccion' => 'required|string|max:64',
            'email' => 'required|email|max:100',
            'telefono' => 'required|max:64',
            'logo' => 'required|max:50000|mimes:jpg,jpeg,png'

        ];

        $mensajes = [
            'required' => 'El :attribute es requerido.',
            'direccion.required' => 'La :attribute es requerida.'
        ];

        $this->validate($request, $campos, $mensajes);

        $datos = $request->except('_token');

        if($request->hasFile('logo'))
            $datos['logo'] = $request->file('logo')->store('uploads','public');

        Clientes::insert($datos);

        return redirect('clientes');

       // return response()->json($datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos = [
            'nombre' => 'required|string|max:64',
            'direccion' => 'required|string|max:64',
            'email' => 'required|email|max:100',
            'telefono' => 'required|max:64',
            'logo' => 'required|max:50000|mimes:jpg,jpeg,png'

        ];

        $mensajes = [
            'required' => 'El :attribute es requerido.',
            'direccion.required' => 'La :attribute es requerida.'
        ];

        if($request->hasFile('logo'))
        {
            $campos = ['logo' => 'required|max:50000|mimes:jpg,jpeg,png'];
            $mensaje = ['logo.required' => 'El logo es requerido.']; 
        }

        $this->validate($request, $campos, $mensajes);

        $datos = $request->except(['_token', '_method']);

        if ($request->hasFile('logo'))
        {
            $logo = Clientes::findOrFail($id);

            Storage::delete('public/' . $logo->logo);

            $datos['logo'] = $request->file('logo')->store('uploads', 'public');
        }


        Clientes::where('id', '=', $id)->update($datos);

        return redirect('clientes')->with('mensaje', 'Cliente modificado.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datos = Clientes::findOrFail($id);

        if($datos->logo != '')
            Storage::delete('public/' . $datos->logo);
        Clientes::destroy($id);

        return redirect('clientes')->with('mensaje', 'Cliente borrado.');
    }
}
