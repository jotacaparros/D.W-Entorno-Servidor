<?php
if (session_status() === PHP_SESSION_NONE)
session_start();

class SalirControlador{
        public static function Salir(){
            unset($_SESSION['usuario']);
            unset($_SESSION['nombre']);
            unset($_SESSION['logueado']);
            unset($_SESSION['loggedstart']);

            header('location:'.URLSITE.'view/login.php');
        }
}

?>