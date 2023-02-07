
@extends('layouts.app')
@section('content')

<div class="container">

<h1>Inserta factura</h1>

<br><br>
<form action= "{{ url('/facturas')}}" method="post" enctype="multipart/form-data">
@csrf
@include('facturas.form', ['submit' => 'Añadir factura', 'cancel' => 'Cancelar la modificación']);
{{-- <label for="nombre">Nombre</label>
<input type="text" name="nombre" id="nombre" maxlength="64">
<br>
<label for="direccion">Direccion</label>
<input type="text" name="direccion" id="direccion" maxlength="64">
<br>
<label for="email">Email</label>
<input type="email" name="email" id="email" maxlength="100">
<br>
<label for="telefono">Teléfono</label>
<input type="text" name="telefono" id="telefono" maxlength="11">
<br>
<label for="logo">Logo</label>
<input type="file" name="logo" id="logo" maxlength="image/*">
<br>
<input type="submit" value="Enviar"> --}}
</form>

</div>

@endsection