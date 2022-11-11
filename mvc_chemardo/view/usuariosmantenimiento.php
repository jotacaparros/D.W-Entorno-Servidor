<?php  
require_once('controller/login.php');

if(!LoginControlador::Logueado()){
    header('location: '.URLSITE.'view/login.php');
    die();
}
require("layout/header.php");
require_once("controller/crypt.php");
?>
<h1>USUARIOS</h1>
<br />
<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>
<form action="<?php echo '?c=usuarios&m=' .
              ($opcion == 'EDITAR' ? 'modificar&id=' . $usuario->id : 'insertar'); ?>" method="POST" enctype="multipart/form-data">
<label for="usuario" class="form-label">Usuario</label>
<input type="text" class="form-control" name="usuario" id="usuario" maxlength="45" 
       value="<?php echo ($opcion == 'EDITAR' ? $usuario->usuario : ''); ?>" required />
<br />
<label for="contrasena" class="form-label">Contrasena</label>
<input type="text" class="form-control" name="contrasena" id="contrasena"
       value="<?php echo ($opcion == 'EDITAR' ? Crypt::Desencriptar($usuario->contrasena) : ''); ?>" required />
<br />

<label for="nombre" class="form-label">Nombre</label>
<input type="text" class="form-control" name="nombre" id="nombre" maxlength="32" 
       value="<?php echo ($opcion == 'EDITAR' ? $usuario->nombre : ''); ?>" required />
<br />
<label for="foto" class="form-label">Foto Perfil</label>
<input type="file" name="foto" id="foto" accept=".jpg, .png, .jpeg">
<br />
<button type="submit" class="btn btn-primary">Aceptar</button>

<a href="<?php echo URLSITE . '?c=usuarios';?>">
    <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
</a>
</form>
<?php require("layout/footer.php"); ?>