<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("model/facturasproveedores.php");
require_once("model/proveedores.php");


class FacturasProveedoresControlador
{
    static function index()
    {
        $facturas = new FacturasProveedoresModelo();

        if (isset($_GET['proveedor_id']))
        {
            $facturas->proveedor_id = $_GET['proveedor_id'];
            $facturas->SeleccionarProveedor();
        }
        else
            $facturas->Seleccionar();

        require_once("view/facturasproveedores.php");
    }

    static function Nuevo()
    {
        $proveedores = new ProveedoresModelo;

        $proveedores->Seleccionar();

        $opcion = 'NUEVA'; // Opción de insertar un proveedor.

        require_once("view/facturasproveedoresmantenimiento.php");
    }

    static function Insertar()
    {
        $facturas = new FacturasProveedoresModelo();

        $facturas->proveedor_id = $_POST['proveedor_id'];
        $facturas->numero = $_POST['numero'];
        $facturas->fecha = $_POST['fecha'];

        if ($facturas->Insertar() == 1)
            header("location:" . URLSITE . '?c=facturasproveedores');
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $facturas->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Editar()
    {
        $factura = new FacturasProveedoresModelo();
        $proveedores = new ProveedoresModelo();

        $factura->id = $_GET['id'];

        $opcion = 'EDITAR'; // Opción de modificar un proveedor.

        if ($factura->seleccionar() && $proveedores->Seleccionar())
            require_once("view/facturasproveedoresmantenimiento.php");
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $factura = new FacturasProveedoresModelo();

        $factura->id = $_GET['id'];
        $factura->proveedor_id = $_POST['proveedor_id'];
        $factura->numero = $_POST['numero'];
        $factura->fecha = $_POST['fecha'];

        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($factura->Modificar() == 1) || ($factura->GetError() == ''))
            header("location:" . URLSITE . "?c=facturasproveedores");
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Borrar()
    {
        $factura = new FacturasProveedoresModelo();
        $factura->id = $_GET['id'];

        if ($factura->Borrar() == 1)
            header("location:" . URLSITE. "?c=facturasproveedores");
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
?>