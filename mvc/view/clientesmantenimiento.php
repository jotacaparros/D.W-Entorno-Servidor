<?php require("layout/header.php"); ?>
<h1>CLIENTES</h1>
<br />
<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>
<form action="<?php echo '?c=clientes&m=' .
              ($opcion == 'EDITAR' ? 'modificar&id=' . $cliente->id : 'insertar'); ?>" method="POST">
<label for="nombre" class="form-label">Nombre</label>
<input type="text" class="form-control" name="nombre" id="nombre" 
       value="<?php echo ($opcion == 'EDITAR' ? $cliente->nombre : ''); ?>" required />
<br />
<label for="email" class="form-label">Email</label>
<input type="email" class="form-control" name="email" id="email" 
       value="<?php echo ($opcion == 'EDITAR' ? $cliente->email : ''); ?>" required />
<br />

<label for="telefono" class="form-label">Teléfono</label>
<input type="number" class="form-control" name="telefono" id="telefono" 
       value="<?php echo ($opcion == 'EDITAR' ? $cliente->telefono : ''); ?>" required />
<br />

<button type="submit" class="btn btn-primary">Aceptar</button>

<a href="<?php echo URLSITE . '?c=clientes';?>">
    <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
</a>
</form>
<?php require("layout/footer.php"); ?>