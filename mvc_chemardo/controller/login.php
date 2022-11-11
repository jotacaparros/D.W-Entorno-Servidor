<?php
if (session_status() === PHP_SESSION_NONE)
session_start();

require_once('model/login.php');

class LoginControlador{

    static function Loguearse(){
        $login = new LoginModelo();

        $login->usuario = $_POST['usuario'];
        $login->contrasena = $_POST['contrasena'];

        if($login->Loguearse()){
            header('location:'.URLSITE);
            return;
        }
        header('location:'.URLSITE.'view/login.php');
    }

    static function Logueado(){
        if (!isset($_SESSION['logueado'])){
            return false;
        }
        if ($_SESSION['logueado'] === false){
            return false;
        }

        if(time() - $_SESSION['loggedstart']>(15*60)){
            session_unset();
            session_destroy();
            
            return false;
        }

        $_SESSION['loggedstart']= time();
        return true;
    }
}
?>