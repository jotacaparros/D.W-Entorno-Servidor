<?php
$numero1 = $_POST["num1"];
$numero2 = $_POST["num2"];

if( $numero2 == 0){
    echo "Error no se puede dividir por 0";
}
else{
    $resultado = ($numero1/$numero2);
    echo $resultado;
}

?>