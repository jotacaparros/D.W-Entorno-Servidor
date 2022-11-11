<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("model/facturas.php");
require_once("model/clientes.php");

class FacturasControlador
{
    static function index()
    {
        $facturas = new FacturasModelo();

        if (isset($_GET['cliente_id']))
        {
            $facturas->cliente_id = $_GET['cliente_id'];
            $facturas->SeleccionarCliente();
        }
        else
            $facturas->Seleccionar();

        require_once("view/facturas.php");
    }

    static function Nuevo()
    {
        $clientes = new ClientesModelo;

        $clientes->Seleccionar();

        $opcion = 'NUEVA'; // Opción de insertar un cliente.

        require_once("view/facturasmantenimiento.php");
    }

    static function Insertar()
    {
        $facturas = new FacturasModelo();

        $facturas->cliente_id = $_POST['cliente_id'];
        $facturas->numero = $_POST['numero'];
        $facturas->fecha = $_POST['fecha'];

        if ($facturas->Insertar() == 1)
            header("location:" . URLSITE . '?c=facturas');
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $facturas->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Editar()
    {
        $factura = new FacturasModelo();
        $clientes = new ClientesModelo();

        $factura->id = $_GET['id'];

        $opcion = 'EDITAR'; // Opción de modificar un cliente.

        if ($factura->seleccionar() && $clientes->Seleccionar())
            require_once("view/facturasmantenimiento.php");
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $factura = new FacturasModelo();

        $factura->id = $_GET['id'];
        $factura->cliente_id = $_POST['cliente_id'];
        $factura->numero = $_POST['numero'];
        $factura->fecha = $_POST['fecha'];

        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($factura->Modificar() == 1) || ($factura->GetError() == ''))
            header("location:" . URLSITE . "?c=facturas");
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Borrar()
    {
        $factura = new FacturasModelo();
        $factura->id = $_GET['id'];

        if ($factura->Borrar() == 1)
            header("location:" . URLSITE. "?c=facturas");
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function RenumerarVista(){
        require_once("view/facturasrenumerar.php");
    }
    static function Renumerar(){

        $facturas = new FacturasModelo();
        $facturainicial = $_POST['numeroinicial'];
        $facturafinal = $_POST['numerofinal'];
        $nuevoinicio =  $_POST['nuevoinicio'];
        $facturas->Renumerar($facturainicial,$facturafinal,$nuevoinicio);
        header("location:" . URLSITE. "?c=facturas");
    }
}
?>