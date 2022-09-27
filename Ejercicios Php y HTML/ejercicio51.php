<?php
$numeroA = $_POST['numero1'];
$numeroB = $_POST['numero2'];

if($numeroA > $numeroB){
  for($i = $numeroB; $i > 1; $i--){
    if($numeroA % $i == 0 && $numeroB % $i == 00){
      echo "El máximo común divisor de $numeroA y $numeroB es $i";
      break; 
    }
  }
}elseif($numeroA < $numeroB){
  for($i = $numeroA; $i > 1; $i--){
    if($numeroA % $i == 0 && $numeroB % $i == 00){
      echo "El máximo común divisor de $numeroA y $numeroB es $i";
      break;
    }
  }
 }

 
?>