<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("model/facturasproveedores.php");
require_once("model/facturaslineasproveedores.php");

class FacturasLineasProveedoresControlador
{
    static function index()
    {
        $facturaslineas = new FacturasLineasProveedoresModelo();
        $facturaslineas->id = 0;
        $facturaslineas->factura_id = $_GET['factura_id'];
        
        $factura_id = $_GET['factura_id'];

        $facturaslineas->Seleccionar();

        require_once("view/facturaslineasproveedores.php");
    }

    static function Nuevo()
    {
        $factura_id = $_GET['factura_id'];

        $opcion = 'NUEVA'; // Opción de insertar un cliente.

        require_once("view/facturaslineasproveedoresmantenimiento.php");
    }

    static function Insertar()
    {
        $facturaslineas = new FacturasLineasProveedoresModelo();

        $facturaslineas->factura_id = $_GET['factura_id'];
        $facturaslineas->referencia = $_POST['referencia'];
        $facturaslineas->descripcion = $_POST['descripcion'];
        $facturaslineas->cantidad = $_POST['cantidad'];
        $facturaslineas->precio = $_POST['precio'];
        $facturaslineas->iva = $_POST['iva'];
        $facturaslineas->importe = $_POST['importe'];

        if ($facturaslineas->Insertar() == 1)
            header("location:" . URLSITE . '?c=facturaslineasproveedores&factura_id='. $_GET['factura_id']);
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $facturaslineas->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Editar()
    {
        $facturaslineas = new FacturasLineasProveedoresModelo();

        $facturaslineas->id = $_GET['id'];

        $opcion = 'EDITAR'; // Opción de modificar un cliente.

        if ($facturaslineas->seleccionar())
            require_once("view/facturaslineasproveedoresmantenimiento.php");
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $facturaslineas->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $facturaslineas = new FacturasLineasProveedoresModelo();

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
            header("location:" . URLSITE . "?c=facturaslineasproveedores&factura_id=" . $_GET['factura_id']);
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $facturaslineas->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Borrar()
    {
        $facturalineas = new FacturasLineasProveedoresModelo();
        $facturalineas->id = $_GET['id'];

        if ($facturalineas->Borrar() == 1)
            header("location:" . URLSITE. "?c=facturaslineasproveedores&factura_id=" . $_GET['factura_id']);
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $facturalineas->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
?>