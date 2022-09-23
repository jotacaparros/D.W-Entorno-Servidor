<?php
$numero1 = $_POST["num1"];
$numero2 = $_POST["num2"];

if(($numero1 % 10) == 0){
    echo "$numero1 es multiple de 10";
    
    if(($numero2 % 10) == 0){
        echo " y $numero2 también es multiple de 10"; 
    }else{
        echo " y $numero2 no es multiple de 10";
    }  
}
else{
    echo "No son múltiplos de 10 :(";
}

?>