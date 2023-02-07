@extends('layouts.app')
@section('content')

<div class="container">

<h1> Gestión de los clientes</h1>


@if (Session::has('mensaje'))

<div class="alert alert-success alert-dismissible" role="alert">
    {{ Session::get('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif
<div class="form-row">
    <form action="{{ route('clientes.index') }}" method="GET">
        <div class="row">
            <div class="col-sm-3 my-1"><input type="text" class="form-control" name="buscar" value={{ $buscar }}></div>
            <div class="col-auto my-1"><input type="submit" class="btn btn-primary" value="buscar"></div>
        </div>
    </form>
</div>
<br><br>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Logo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{ $cliente->id }}</td>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->direccion }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>
                @if ($cliente->logo != '')
                    <img src="{{ asset('storage') . '/' . $cliente->logo }}" height="80" width="70" class="img-thumbnail img-fluid">
                @endif                
            </td>
            <td>
                <a href="{{ url('/clientes/' . $cliente->id . '/edit')}}"
                    class="btn btn-success">Editar</a> 
                
                <form action="{{ url('/clientes/' . $cliente->id) }}" method="POST"
                    class="d-inline">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" 
                        onclick="return confirm('¿Quiere borrar el cliente seleccionado?')"
                        value="Borrar"
                        class="btn btn-danger">
                </form>

                {{-- <a href="{{ url('/facturas/create')}}"
                    class="btn btn-warning">Crear factura</a>  --}}
                    <a href="{{ route('facturas.create') }}" class="btn btn-warning">Crear factura</a>

            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7">
                <a href="{{ url('clientes/create') }}" 
                class="btn btn-primary">Nuevo</a>
            </td>
        </tr>
    </tfoot>
</table>

{!! $clientes->links() !!}

</div>

@endsection