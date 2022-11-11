<?php  
require_once('controller/login.php');

if(!LoginControlador::Logueado()){
    header('location: '.URLSITE.'view/login.php');
    die();
}
require("layout/header.php"); ?>

<h1>FACTURAS</h1>
<br />

<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVA'); ?></h2>
<form action="<?php echo '?c=facturas&m=' .
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

<label for="cliente" class="form-label">Cliente</label>
<select class="form-control" name="cliente_id" id="cliente_id" required>
<?php
if ($opcion == 'NUEVA') :
?>
       <option value="" disabled selected>Seleccionar cliente</option>
<?php
endif;

foreach ($clientes->filas AS $cliente) :
?>

       <option value="<?php echo $cliente->id; ?>"
              
       <?php 
       if ($opcion == 'EDITAR')
              echo ($cliente->id == $factura->cliente_id ? 'selected' : ''); ?>
       >
              <?php echo $cliente->nombre; ?>
       </option>

<?php
endforeach;
?>
</select>
<br>
<button type="submit" class="btn btn-primary">Aceptar</button>

<a href="<?php echo URLSITE . '?c=facturas';?>">
    <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
</a>
</form>
<?php require("layout/footer.php"); ?>