<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("model/facturas.php");
require_once("model/facturaslineas.php");

class FacturasLineasControlador
{
    static function index()
    {
        $facturaslineas = new FacturasLineasModelo();
        $facturaslineas->id = 0;
        $facturaslineas->factura_id = $_GET['factura_id'];
        
        $factura_id = $_GET['factura_id'];

        $facturaslineas->Seleccionar();

        require_once("view/facturaslineas.php");
    }

    static function Nuevo()
    {
        $factura_id = $_GET['factura_id'];

        $opcion = 'NUEVA'; // Opción de insertar un cliente.

        require_once("view/facturaslineasmantenimiento.php");
    }

    static function Insertar()
    {
        $facturaslineas = new FacturasLineasModelo();

        $facturaslineas->factura_id = $_GET['factura_id'];
        $facturaslineas->referencia = $_POST['referencia'];
        $facturaslineas->descripcion = $_POST['descripcion'];
        $facturaslineas->cantidad = $_POST['cantidad'];
        $facturaslineas->precio = $_POST['precio'];
        $facturaslineas->iva = $_POST['iva'];
        $facturaslineas->importe = $_POST['importe'];

        if ($facturaslineas->Insertar() == 1)
            header("location:" . URLSITE . '?c=facturaslineas&factura_id='. $_GET['factura_id']);
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $facturaslineas->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Editar()
    {
        $facturaslineas = new FacturasLineasModelo();

        $facturaslineas->id = $_GET['id'];

        $opcion = 'EDITAR'; // Opción de modificar un cliente.

        if ($facturaslineas->seleccionar())
            require_once("view/facturaslineasmantenimiento.php");
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $facturaslineas->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $facturaslineas = new FacturasLineasModelo();

        $facturaslineas->id = $_GET['id'];
        $facturaslineas->referencia = $_POST['referencia'];
        $facturaslineas->descripcion = $_POST['descripcion'];
        $facturaslineas->cantidad = $_POST['cantidad'];
        $facturaslineas->precio = $_POST['precio'];
        $facturaslineas->iva = $_POST['iva'];

        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($facturaslineas->Modificar() == 1) || ($facturaslineas->GetError() == ''))
            header("location:" . URLSITE . "?c=facturaslineas&factura_id=" . $_GET['factura_id']);
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $facturaslineas->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Borrar()
    {
        $facturalineas = new FacturasLineasModelo();
        $facturalineas->id = $_GET['id'];

        if ($facturalineas->Borrar() == 1)
            header("location:" . URLSITE. "?c=facturaslineas&factura_id=" . $_GET['factura_id']);
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $facturalineas->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
?>