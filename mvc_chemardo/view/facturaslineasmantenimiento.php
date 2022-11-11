<?php  
require_once('controller/login.php');

if(!LoginControlador::Logueado()){
    header('location: '.URLSITE.'view/login.php');
    die();
}
require("layout/header.php"); ?>

<h1>FACTURAS LINEAS</h1>
<br />

<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVA'); ?></h2>
<form action="<?php echo '?c=facturaslineas&m=' .
              ($opcion == 'EDITAR' ? 'modificar&id=' . $facturaslineas->id . '&factura_id='. $facturaslineas->factura_id
                                   : 'insertar&factura_id=' . $factura_id) ?>" 
       method="POST">

<label for="referencia" class="form-label">Referencia</label>
<input type="number" class="form-control" name="referencia" id="referencia" 
       value="<?php echo ($opcion == 'EDITAR' ? $facturaslineas->referencia : ''); ?>" required />
<br />
<label for="descripcion" class="form-label">Descripción</label>
<input type="text" class="form-control" name="descripcion" id="descripcion" 
       value="<?php echo ($opcion == 'EDITAR' ? $facturaslineas->descripcion : ''); ?>" required />
<br />
                                                         
<label for="cantidad" class="form-label">Cantidad</label>
<input type="number" class="form-control" name="cantidad" id="cantidad" 
       value="<?php echo ($opcion == 'EDITAR' ? $facturaslineas->cantidad : ''); ?>" required />
<br />
<label for="precio" class="form-label">Precio</label>
<input type="number" class="form-control" name="precio" id="precio" 
       value="<?php echo ($opcion == 'EDITAR' ? $facturaslineas->precio : ''); ?>" required />
<br />
<label for="iva" class="form-label">IVA</label>
<input type="number" class="form-control" name="iva" id="iva" 
       value="<?php echo ($opcion == 'EDITAR' ? $facturaslineas->iva : ''); ?>" required />
<br />

<br>
<button type="submit" class="btn btn-primary">Aceptar</button>

<a href="<?php echo URLSITE . '?c=facturaslineas&factura_id=' . 
    ($opcion == 'EDITAR' ? $facturaslineas->factura_id : $factura_id); ?>">
    <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
</a>
</form>
<?php require("layout/footer.php"); ?>