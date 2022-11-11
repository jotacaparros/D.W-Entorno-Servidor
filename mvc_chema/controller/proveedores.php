<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("model/proveedores.php");

class ProveedoresControlador
{
    static function index()
    {
        $proveedores = new ProveedoresModelo();
        $proveedores->Seleccionar();

        require_once("view/proveedores.php");
    }

    static function Nuevo()
    {
        $opcion = 'NUEVO'; // Opción de insertar un proveedor$proveedor.
        require_once("view/proveedoresmantenimiento.php");
    }

    static function Insertar()
    {
        $proveedor = new ProveedoresModelo();

        $proveedor->nombre = $_POST['nombre'];
        $proveedor->email = $_POST['email'];
        $proveedor->telefono = $_POST['telefono'];

        if ($proveedor->Insertar() == 1)
            header("location:" . URLSITE . '?c=proveedores');
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $proveedor->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Editar()
    {
        $proveedor = new ProveedoresModelo();

        $proveedor->id = $_GET['id'];

        $opcion = 'EDITAR'; // Opción de modificar un proveedor$proveedor.

        if ($proveedor->seleccionar())
            require_once("view/proveedoresmantenimiento.php");
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $proveedor->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $proveedor = new ProveedoresModelo();

        $proveedor->id = $_GET['id'];
        $proveedor->nombre = $_POST['nombre'];
        $proveedor->email = $_POST['email'];
        $proveedor->telefono = $_POST['telefono'];

        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($proveedor->Modificar() == 1) || ($proveedor->GetError() == ''))
            header("location:" . URLSITE . '?c=proveedores');
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $proveedor->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Borrar()
    {
        $proveedor = new ProveedoresModelo();
        $proveedor->id = $_GET['id'];

        if ($proveedor->Borrar() == 1)
            header("location:" . URLSITE . '?c=proveedores');
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $proveedor->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Exportar(){
        $proveedores = new ProveedoresModelo();
        $proveedores->Seleccionar();
        
        try {
            $fichero= fopen("proveedores.csv","w");
            foreach($proveedores->filas as $fila){
                $cadena = "$fila->id#$fila->nombre#$fila->email#$fila->telefono\n";

                fputs($fichero, $cadena);
            }
        } catch (Exception $e) {
           
        }
        finally{
            fclose($fichero);
        }
        $rutafichero='proveedores.csv';
        $fichero= basename($rutafichero);

        header("Content-Type: application/octet-stream");
        header("Content-Length: " . filesize($rutafichero));
        header("Content-Disposition: attachment; filename=$fichero");
        readfile($rutafichero);
    }
    static function Importar(){
        $proveedores = new proveedoresModelo();
        try {
            $fichero= fopen("proveedores.csv","r");

            while ($campos=fgetcsv($fichero,0,'#')) {
                $proveedores->nombre = $campos[1];
                $proveedores->email = $campos[2];
                $proveedores->telefono = $campos[3];
                if ($proveedores->Insertar() == 1)
                    header("location:" . URLSITE . '?c=proveedores');
                else 
                {
                    $_SESSION["CRUDMVC_ERROR"] = $proveedores->GetError();
                    header("location:" . URLSITE . "view/error.php");
                }
           
            }
            header("location:" . URLSITE . '?c=proveedores');
        } catch (Exception $e) {
            $_SESSION["CRUDMVC_ERROR"] = $e->getMessage();
            header("location:" . URLSITE . "view/error.php");
        }
        finally{
            fclose($fichero);
        }
    
    }
}
?>