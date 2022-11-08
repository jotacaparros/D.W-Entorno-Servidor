<?php

$nombreFichero = "ejercicio91.txt";
$cadenaTexto = "";
fopen($nombreFichero, r);

while($cadena = fgets($nombreFichero)){

    $cadenaTexto = "$cadenaTexto " . fgets($nombreFichero); 
}
fclose($nombreFichero);

$arrayDatos; 
$arrayDatos = explode(";", $cadenaTexto);
echo "<pre>";
echo $arrayDatos;
echo "</pre>";

?>