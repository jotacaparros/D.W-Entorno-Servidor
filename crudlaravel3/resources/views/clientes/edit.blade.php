@extends('layouts.app')
@section('content')

<div class="container">

<h1>Formulario para modificar un cliente </h1>
<br><br>
<form action= "{{ url('/clientes/' . $cliente->id) }}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH')}}
@include('clientes.form', ['submit' => 'Modificar cliente', 'cancel' => 'Cancelar la modificación']);
</form>

</div>

@endsection