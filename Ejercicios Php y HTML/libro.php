<?php
   class Libro{
    
      private $autor;
      private $titulo;

      function SetAutor($x){
       $this->autor = $x;
      }

      function SetTitulo($y){
         $this->titulo = $y;
        }
      function datos(){
         $this->GetTitulo();
         $this->GetAutor();
      }

      function GetAutor(){
         echo "Autor: $this->autor";
      }
      function GetTitulo(){
         echo "Título: $this->titulo <br>";
      }
   }

   $antifragil = new Libro;
   $antifragil->SetAutor('Nassim Nicholas Taleb');
   $antifragil->SetTitulo('Antifrágil');
   $antifragil->datos();
?>