<?php
    $numero1 = $_POST["num1"];
    $numero2 = $_POST["num2"];
    
if(($numero1 % $numero2) == 0){echo "Son múltiplos";
    }
    else{
        echo "No son múltiplos :(";
    }


?>