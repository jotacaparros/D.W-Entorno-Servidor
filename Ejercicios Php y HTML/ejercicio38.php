<?php
  $numero = 1;
  $contador = 0;
  
  while($numero > 0){
     $resultado = $numero / 10;
     $numero = intval($resultado);
     $contador++;
  }

  echo $contador;
?>

