<?php
try
{
 // Abrimos el fichero en modo escritura.
 $fichero = fopen("fichero.txt","w");
 // Escribimos la primera línea de texto.
 $string = "1ª línea de texto\n";
 fputs($fichero, $string);
 // Escribimos la segunda línea de texto.
 $string = "2ª línea de texto\n";
 fputs($fichero, $string);
 // Escribimos la tercera línea de texto.
 $string = "3ª línea de texto\n\n";
 fputs($fichero, $string);
 // Cerramos el fichero.
 fclose($fichero);
 // Volvemos a abrir el fichero, esta vez en modo añadir.
 $fichero = fopen("fichero.txt","a");
 // Añadimos la cuarta línea de texto directamente.
 fputs($fichero, "4ª línea de texto, añadida con modo \"a\"\n");
 // Añadimos la quinta línea de texto directamente.
 fputs($fichero, "5ª línea de texto, añadida con modo \"a\"");
 // Cerramos el fichero...
 fclose($fichero);
 // y lo volvemos a abrir en modo lectura.
 $fichero = fopen("fichero.txt", "r");
 // Leemos línea a línea, y la mostramos, hasta que devuelva false.
 while ($cadena = fgets($fichero))
 {
//  echo $cadena . "<br/>";
 }
}
catch (exception $e)
{
 // Si hay algún problema mostramos mensaje de error.
 echo $e->getMessage();
}
finally
{
 // Cerramos el fichero.
 fclose($fichero);
}
$rutaFichero = 'files/fichero.txt';
$fichero = basename($rutaFichero);
header("Content-Type: application/octet-stream");
header("Content-Length: " . filesize($rutaFichero));
header("Content-Disposition: attachment; filename=$fichero");
readfile($rutaFichero);
?>