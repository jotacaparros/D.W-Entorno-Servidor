<?php
$numeroA = $_POST['numero1'];
$numeroB = $_POST['numero2'];
$maxComunDivisor;
$producto;
$minimoComunMultiplo;
if($numeroA > $numeroB){
  for($i = $numeroB; $i > 1; $i--){
    if($numeroA % $i == 0 && $numeroB % $i == 00){
      echo "El máximo común divisor de $numeroA y $numeroB es $i <br>";
      $maxComunDivisor = $i;
      break; 
    }
  }
}elseif($numeroA < $numeroB){
  for($i = $numeroA; $i > 1; $i--){
    if($numeroA % $i == 0 && $numeroB % $i == 00){
      echo "El máximo común divisor de $numeroA y $numeroB es $i <br>";
      $maxComunDivisor = $i;
      break;
    }
  }
 }

 $producto = $numeroA * $numeroB;
 $minimoComunMultiplo = $producto / $maxComunDivisor;

 echo "El mínimo común múltiplo de $numeroA y $numeroB es $minimoComunMultiplo";
?>