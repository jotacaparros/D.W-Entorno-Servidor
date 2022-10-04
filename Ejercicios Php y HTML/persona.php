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

   $persona = new Persona;
   $persona ->SetNombre('Jorge');
   $persona->Saludar();
?>