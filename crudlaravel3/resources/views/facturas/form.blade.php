@if (count($errors) > 0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}
        @endforeach
    </ul>
</div>
@endif

<div class="form-group">
<label for="fecha">Fecha</label>
<input type="date" name="fecha" id="fecha" maxlength="64"
    value="{{ isset($factura->fecha) ? $factura->fecha : ''}}"
    class="form-control">
</div>

<br>
<div class="form-group">
<label for="base">Base</label>
<input type="number" placeholder="0.00" name="base" id="base" maxlength="64"
    value="{{ isset($factura->base) ? $factura->base : ''}}"
    class="form-control">
</div>

<br>
<div class="form-group">
<label for="importe">Importe</label>
<input type="number" placeholder="0.00" name="importe" id="importe" 
    value="{{ isset($factura->importe) ? $factura->importe : ''}}"
    class="form-control">
</div>

<br>
<div class="form-group">
<label for="importeiva">IVA</label>
<input type="number" placeholder="0.00" name="importeiva" id="importeiva" maxlength="4"
    value="{{ isset($factura->importeiva) ? $factura->importeiva : ''}}"
    class="form-control">
</div>

{{-- <input type="hidden"  name="cliente_id" value="{{ $cliente_id }}"> --}}

<br>
<input type="submit" value="{{ $submit }}"
    class="btn btn-primary">

<a href="{{ url('facturas/') }}">
    <input type="button" value="{{ $cancel }}"
    class="btn btn-success">
</a>