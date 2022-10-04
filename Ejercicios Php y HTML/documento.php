<?php
require_once('Crypt.php');
   class Documento {
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
         echo "Autor: $this->autor <br>";
      }
      function GetTitulo(){
         echo "Título: $this->titulo <br>";
      }
   }
   class Libro extends Documento{
    private $paginas;
    
    function SetPaginas($z){
      $this->paginas = $z;
    }
    function datos(){
      Documento::datos();
      $this->GetPaginas();
    }
   function GetPaginas(){
      echo "Páginas: $this->paginas <br>";
   } 
   }

   $antifragil = new Libro;
   $antifragil->SetAutor('Nassim Nicholas Taleb');
   $antifragil->SetTitulo('Antifrágil');
   $antifragil->SetPaginas(368);
   $antifragil->datos();   

   echo Crypt::Encriptar('enriqueta17');
   echo '<hr>';
   echo Crypt::Desencriptar('YkJNK2JTeUpJT1VhWG55Q3VDcm13dz09');

?>