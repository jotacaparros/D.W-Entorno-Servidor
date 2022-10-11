<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("model/clientes.php");

class ClientesControlador
{
    static function index()
    {
        $clientes = new ClientesModelo();
        $clientes->Seleccionar();

        require_once("view/clientes.php");
    }

    static function Nuevo()
    {
        $opcion = 'NUEVA'; // Opción de insertar un cliente.
        require_once("view/clientesmantenimiento.php");
    }

    static function Insertar()
    {
        $cliente = new ClientesModelo();

        $cliente->nombre = $_POST['nombre'];
        $cliente->email = $_POST['email'];

        if ($cliente->Insertar() == 1)
            header("location:" . URLSITE);
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Editar()
    {
        $cliente = new ClientesModelo();

        $cliente->id = $_GET['id'];

        $opcion = 'EDITAR'; // Opción de modificar un cliente.

        if ($cliente->seleccionar())
            require_once("view/clientesmantenimiento.php");
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $cliente = new ClientesModelo();

        $cliente->id = $_GET['id'];
        $cliente->nombre = $_POST['nombre'];
        $cliente->email = $_POST['email'];

        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($cliente->Modificar() == 1) || ($cliente->GetError() == ''))
            header("location:" . URLSITE);
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Borrar()
    {
        $cliente = new ClientesModelo();
        $cliente->id = $_GET['id'];

        if ($cliente->Borrar() == 1)
            header("location:" . URLSITE);
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
?>