<?php
    $numero1 = $_POST["num1"];
    $numero2 = $_POST["num2"];
    
    if($numero1 > $numero2){
        echo "$numero1 es mayor que $numero2";
    }elseif($numero2 > $numero1){
        echo "$numero2 es mayor que $numero1";
    }else{
        echo "$numero2 es igual que $numero1";
    }


?>