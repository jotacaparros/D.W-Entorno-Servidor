<?php  
require_once('controller/login.php');

if(!LoginControlador::Logueado()){
    header('location: '.URLSITE.'view/login.php');
    die();
}
require("layout/header.php"); ?>

<h1>FACTURAS PROVEEDORES</h1>
<br />

<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVA'); ?></h2>
<form action="<?php echo '?c=facturasproveedores&m=' .
              ($opcion == 'EDITAR' ? 'modificar&id=' . $factura->id : 'insertar'); ?>" 
       method="POST">

<label for="numero" class="form-label">Número</label>
<input type="text" class="form-control" name="numero" id="numero" 
       value="<?php echo ($opcion == 'EDITAR' ? $factura->numero : ''); ?>" required />
<br />
<label for="fecha" class="form-label">Fecha</label>
<input type="date" class="form-control" name="fecha" id="fecha" 
       value="<?php echo ($opcion == 'EDITAR' ? date('Y-m-d', strtotime($factura->fecha)) : date('Y-m-d')); ?>" 
       required />
<br />

<label for="proveedor" class="form-label">Proveedor</label>
<select class="form-control" name="proveedor_id" id="proveedor_id" required>
<?php
if ($opcion == 'NUEVA') :
?>
       <option value="" disabled selected>Seleccionar proveedor</option>
<?php
endif;

foreach ($proveedores->filas AS $proveedor) :
?>

       <option value="<?php echo $proveedor->id; ?>"
              
       <?php 
       if ($opcion == 'EDITAR')
              echo ($proveedor->id == $factura->proveedor_id ? 'selected' : ''); ?>
       >
              <?php echo $proveedor->nombre; ?>
       </option>

<?php
endforeach;
?>
</select>
<br>
<button type="submit" class="btn btn-primary">Aceptar</button>

<a href="<?php echo URLSITE . '?c=facturasproveedoresmantenimiento';?>">
    <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
</a>
</form>
<?php require("layout/footer.php"); ?>