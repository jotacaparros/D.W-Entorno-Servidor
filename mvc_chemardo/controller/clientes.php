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
        $opcion = 'NUEVO'; // Opción de insertar un cliente.
        require_once("view/clientesmantenimiento.php");
    }

    static function Insertar()
    {
        $cliente = new ClientesModelo();

        $cliente->nombre = $_POST['nombre'];
        $cliente->email = $_POST['email'];
        $cliente->telefono = $_POST['telefono'];

        if ($cliente->Insertar() == 1)
            header("location:" . URLSITE . '?c=clientes');
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
        $cliente->telefono = $_POST['telefono'];

        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($cliente->Modificar() == 1) || ($cliente->GetError() == ''))
            header("location:" . URLSITE . '?c=clientes');
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
            header("location:" . URLSITE . '?c=clientes');
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Exportar()
    {
        //obj cliente acceso tabla clientes bbdd y seleccion clientes
       $clientes = new ClientesModelo();
       $clientes->Seleccionar();

       try {
            $fichero =fopen("clientes.csv","w");

            foreach($clientes->filas as $fila){
                $cadena = "$fila->id#$fila->nombre#$fila->email#$fila->telefono\n";

                fputs($fichero,$cadena);
            }
       } catch (Exception $e) {
        
       }
       finally{
        fclose($fichero);
       }

       $rutafichero='clientes.csv';
       $fichero= basename($rutafichero);

        header("Content-Type: application/octet-stream");
        header("Content-Length: " . filesize($rutafichero));
        header("Content-Disposition: attachment; filename=$fichero");
        readfile($rutafichero);
    }
    static function Importar(){
        $clientes = new ClientesModelo();
        try {
            $fichero= fopen("clientes.csv","r");

            while ($campos=fgetcsv($fichero,0,'#')) {
                $clientes->nombre = $campos[1];
                $clientes->email = $campos[2];
                $clientes->telefono = $campos[3];
                if ($clientes->Insertar() == 1)
                    header("location:" . URLSITE . '?c=clientes');
                else 
                {
                    $_SESSION["CRUDMVC_ERROR"] = $clientes->GetError();
                    header("location:" . URLSITE . "view/error.php");
                }
           
            }
            header("location:" . URLSITE . '?c=clientes');
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