<?php  
require_once('controller/login.php');

if(!LoginControlador::Logueado()){
    header('location: '.URLSITE.'view/login.php');
    die();
}
require("layout/header.php"); ?>

<h1>FACTURAS</h1>
<br />

<h2>Renumerar</h2>
<form action="<?php echo '?c=facturas&m=renumerar'; ?>" 
       method="POST">

<label for="numeroinical" class="form-label">Número Inicial</label>
<input type="number" class="form-control" name="numeroinicial" id="numeroinicial" required/>
<br/>
<label for="numerofinal" class="form-label">Numero final</label>
<input type="number" class="form-control" name="numerofinal" id="numerofinal" required/>
<br />

<label for="nuevoinicio" class="form-label">Nuevo numero inicial</label>
<input type="number" class="form-control" name="nuevoinicio" id="nuevoinicio" required>

<br>
<button type="submit" class="btn btn-primary">Aceptar</button>

<a href="<?php echo URLSITE . '?c=facturas';?>">
    <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
</a>
</form>
<?php require("layout/footer.php"); ?>