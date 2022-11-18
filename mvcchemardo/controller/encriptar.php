<?php
require_once('crypt.php');
$nombre = '1234';
$nombreEncriptado = Crypt::Encriptar($nombre);
echo '<pre>';
echo $nombreEncriptado;
echo '<br>';

$nombreDesencriptado = Crypt::Desencriptar($nombreEncriptado);

echo $nombreDesencriptado;
echo '<pre>';
?>