<?php 
require_once('controller/login.php');

if(!LoginControlador::Logueado()){
    header('location: '.URLSITE.'view/login.php');
    die();
}

require("layout/header.php"); ?>

<h1>Q3 MVC</h1>
<p>Bienvenido <?php echo $_SESSION['nombre'];?></p>
<br />

<?php require("layout/footer.php"); ?>