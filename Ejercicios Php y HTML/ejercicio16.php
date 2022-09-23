<?php
$numero1 = $_POST["num1"];
$numero2 = $_POST["num2"];

if($numero1 == 0 || $numero2 == 0){
    echo "El producto por 0 es 0";
}
else{
    echo "Todo correcto circule";
}

?>