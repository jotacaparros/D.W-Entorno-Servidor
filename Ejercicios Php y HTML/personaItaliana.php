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

class PersonaItaliana extends Persona {
    function Saludar(){
        echo "Chao, soy $this->nombre";
     }
}
$lordCaraCulo = new PersonaItaliana;
$lordCaraCulo->SetNombre('Massimo Atraco ');
$lordCaraCulo->Saludar();
?>
