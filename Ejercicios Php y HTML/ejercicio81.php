<?php

$posibles = array(2, -5, 8);

function calcularArea($lado){

    if($lado < 0){

        throw new Exception('Error: No se pueden números negativos <br>');

    }
    return $lado * $lado;  
}

for($i = 0; $i < count($posibles); $i++){
    
    try{

       echo  calcularArea($posibles[$i]) . '<br>'; 

    }catch(Exception $e){

        echo $e -> getMessage();  

    }
}
?>