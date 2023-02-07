<div class="container">

    <h1>Formulario para modificar una factura </h1>
    <br><br>
    <form action= "{{ url('/facturas/' . $factura->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH')}}
    @include('facturas.form', ['submit' => 'Modificar factura', 'cancel' => 'Cancelar la modificación']);
    </form>
    
    </div>
    
    @endsection