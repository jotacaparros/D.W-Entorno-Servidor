<?php
require_once('crypt.php');
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("model/usuarios.php");

class UsuariosControlador
{
    static function index()
    {
        $usuarios = new UsuariosModelo();
        $usuarios->Seleccionar();

        require_once("view/usuarios.php");
    }

    static function Nuevo()
    {
        $opcion = 'NUEVO'; // Opción de insertar un usuario.
        require_once("view/usuariosmantenimiento.php");
    }

    static function Insertar()
    {
        $usuario = new UsuariosModelo();

        $usuario->usuario = $_POST['usuario'];
        $usuario->contrasena = Crypt::Encriptar($_POST['contrasena']);
        $usuario->nombre = $_POST['nombre'];
        $usuario->foto_url = URLSITE . $_FILES['foto']['name'];
        $usuario->foto_nombre = $_FILES['foto']['name'];

        if ($usuario->Insertar() == 1)
            header("location:" . URLSITE . '?c=usuarios');
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $usuario->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    private static function SubirFoto($id){

        $carpetaDestino = 'C:\\xampp\\htdocs\\mvc\\imagenes\\';
        $nombrefoto = $id . '-' . basename($_FILES['foto']['name']);
        $ficheroDestino = $carpetaDestino . $nombrefoto;
        $tipoImagen = strtolower(pathinfo($ficheroDestino, PATHINFO_EXTENSION));

        $foto_url = URLSITE.'imagenes/'.$nombrefoto;

        $esImagen = getimagesize($_FILES['foto']['tmp_name']);
        if($esImagen === false){
            $_SESSION['CRUDMVC_ERROR']= "Al subir la foto.<br>". "No es una foto correcta . <br>" . "Usuario no modificado";
            return false;
        }

        if($_FILES['foto']['size'] > 524288){
            $_SESSION['CRUDMVC_ERROR'] = "Al subir la foto.<br>". "El tamaño excede los 500 Kb . <br>" . "Usuario no modificado";
            return false;
        }

        if($tipoImagen != 'jpg' && $tipoImagen != 'jpeg' && $tipoImagen != 'png'){
            $_SESSION['CRUDMVC_ERROR'] = "Al subir la foto.<br>". "Formato incorrecto . <br>" . "Usuario no modificado";
            return false;
        }

        if(!move_uploaded_file($_FILES['foto']['tmp_name'], $ficheroDestino)){
            $_SESSION['CRUDMVC_ERROR'] = "Al subir la foto.<br>". "No se ha podido guardar . <br>" . "Usuario no modificado";
            return false;
        }
        
        return $foto_url;

    }
    static function InsertarIDurl(){
        
    }

    static function Editar()
    {
        $usuario = new UsuariosModelo();

        $usuario->id = $_GET['id'];

        $opcion = 'EDITAR'; // Opción de modificar un usuario.

        if ($usuario->seleccionar())
            require_once("view/usuariosmantenimiento.php");
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $usuario->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $usuario = new UsuariosModelo();

        $usuario->id = $_GET['id'];
        $usuario->usuario = $_POST['usuario'];
        $usuario->contrasena = Crypt::Encriptar($_POST['contrasena']);
        $usuario->nombre = $_POST['nombre'];
        $usuario->foto_url = URLSITE.$usuario->id .'_'. $_FILES['foto']['name'];
        $usuario->foto_nombre = $_FILES['foto']['name'];

        if($_FILES['foto']['name']!=''){
            $usuario->foto_nombre = $_FILES['foto']['name'];

            $usuario->foto_url = self::SubirFoto($usuario->id);
            if($usuario->foto_url ===false){
                header("location:" . URLSITE . 'view/error.php');
                return;
            }
        }
        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($usuario->Modificar() == 1) || ($usuario->GetError() == ''))
            header("location:" . URLSITE . '?c=usuarios');
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $usuario->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Borrar()
    {
        $usuario = new UsuariosModelo();
        $usuario->id = $_GET['id'];

        if ($usuario->Borrar() == 1)
            header("location:" . URLSITE . '?c=usuarios');
        else 
        {
            $_SESSION["CRUDMVC_ERROR"] = $usuario->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
    static function Exportar()
    {
        //obj usuario acceso tabla usuarios bbdd y seleccion usuarios
       $usuarios = new ClientesModelo();
       $usuarios->Seleccionar();

       try {
            $fichero =fopen("usuarios.csv","w");

            foreach($usuarios->filas as $fila){
                $cadena = "$fila->id#$fila->usuario#$fila->contrasena#$fila->nombre\n";

                fputs($fichero,$cadena);
            }
       } catch (Exception $e) {
        
       }
       finally{
        fclose($fichero);
       }

       $rutafichero='usuarios.csv';
       $fichero= basename($rutafichero);

        header("Content-Type: application/octet-stream");
        header("Content-Length: " . filesize($rutafichero));
        header("Content-Disposition: attachment; filename=$fichero");
        readfile($rutafichero);
    }
    static function Importar(){
        $usuarios = new UsuariosModelo();
        try {
            $fichero= fopen("usuarios.csv","r");

            while ($campos=fgetcsv($fichero,0,'#')) {
                $usuarios->usuario = $campos[1];
                $usuarios->contrasena = $campos[2];
                $usuarios->nombre = $campos[3];
                if ($usuarios->Insertar() == 1)
                    header("location:" . URLSITE . '?c=usuarios');
                else 
                {
                    $_SESSION["CRUDMVC_ERROR"] = $usuarios->GetError();
                    header("location:" . URLSITE . "view/error.php");
                }
           
            }
            header("location:" . URLSITE . '?c=usuarios');
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