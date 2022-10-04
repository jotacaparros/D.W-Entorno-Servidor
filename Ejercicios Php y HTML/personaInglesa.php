<?php
   class Persona{
    
    private $nombre = '';

    function SetNombre($x){
     $this->nombre = $x;
    }

    function Saludar(){
       echo "Hola, soy $this->nombre";
    }
 }
class PersonaInglesa extends Persona{
    
    function TomarTe(){
        echo ' Estoy tomando té.';
    }


}
$lordCaraCulo = new PersonaInglesa;
$lordCaraCulo->SetNombre('Butt Von Cara Culo. ');
$lordCaraCulo->Saludar() . $lordCaraCulo->TomarTe();
?>
