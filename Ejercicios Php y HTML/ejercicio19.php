<?php
$numero1 = $_POST["num1"];
$numero2 = $_POST["num2"];

if( ($numero1%2) == 0 && ($numero1%3) == 0 ){
    echo " $numero1 es múltiplo de 2 y de 3  simultáneamente  ";
}else{
   
    echo " $numero1 no es múltiplo de 2 ni de 3";
}

?>