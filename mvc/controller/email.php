<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();


class EmailControlador
{
    static function texto()
    {
        require_once("view/emailmantenimiento.php");
    }

    static function mime()
    {
        require_once("view/emailmimemantenimiento.php");
    }
    static function enviarmime()
    {
        if ($_FILES["fichero"]["size"] > 500000)
        {
            $_SESSION['CRUDMVC_ERROR']="El fichero {$_FILES["fichero"]["name"]} excede el tamaño máximo permitido (500000).";
            header('Location: ' . URLSITE . 'view/error.php');
            return;
        }
        $destinatario = $_POST['to'];
        $destinatario_cc = $_POST['cc'];
        $destinatario_bcc = $_POST['bcc'];
        $asunto = $_POST['subject'];
        $contenidoHTML = $_POST['message'];
        $cabecera= "Para: ". $destinatario."\r\n";
        $cabecera.= "From: ".$_SESSION['nombre']." <". $_SESSION['usuario'].">". "\r\n";
        if($_POST['cc'] != ''){
            $cabecera.= 'Cc: ' . $destinatario_cc . "\r\n";
        }
        if($_POST['bcc'] != ''){
            $cabecera.= 'Bcc: ' . $destinatario_bcc . "\r\n";
        }
        $cabecera.= 'X-Priority:1' . "\r\n";
        $limiteMIME = '==Limite_Multiparte_x'. md5(time()) . 'x';
        $cabecera .= 'MIME-Version: 1.0' . "\r\n";
        $cabecera .= 'Content-Type: multipart/mixed; boundary="' . $limiteMIME . '"' . "\r\n";
        $mensaje = '--' . $limiteMIME . "\r\n";
        $mensaje .= 'Content-Type: text/html; charset="UTF-8"' . "\r\n";
        $mensaje .= 'Content-Transfer-Encoding: 8bit' . "\r\n\n";
        $mensaje .= $contenidoHTML . "\r\n";


        $fichero = $_FILES["fichero"]["tmp_name"];
        $fp = @fopen($fichero,"rb");
        $datos = @fread($fp, filesize($fichero));
        fclose($fp);
        $datos = chunk_split(base64_encode($datos));
        $mensaje .= '--' . $limiteMIME. "\r\n";
        $mensaje .= 'Content-Type: application/octet-stream;' .
         ' name=' . basename($fichero) . "\r\n";
        $mensaje .= 'Content-Description: ' . basename($fichero) . "\r\n";
        $mensaje .= 'Content-Disposition: attachment;' . "\r\n";
        $mensaje .= 'filename="' . basename($_FILES["fichero"]["name"]) . '";' .
         ' size=' . filesize($fichero). ';' . "\r\n";
        $mensaje .= 'Content-Transfer-Encoding: base64;' . "\r\n";
        $mensaje .= $datos . "\r\n";
        $mensaje .= '--' . $limiteMIME .'--';

        
            if (mail($destinatario, $asunto, $mensaje, $cabecera) == true)
            echo 'Mensaje enviado correctamente.';
            else{
    
                $_SESSION['CRUDMVC_ERROR'] = 'Al enviar el email . <br>';
                $_SESSION['CRUDMVC_ERROR'] .= "Para -> $destinatario .<br>";
                $_SESSION['CRUDMVC_ERROR'] .= "CC -> {$_POST['cc']}.<br>";
                $_SESSION['CRUDMVC_ERROR'] .= "BCC -> {$_POST['bcc']}.<br>";
                $_SESSION['CRUDMVC_ERROR'] .= "Asunto -> $asunto . <br>";
                
                $mensaje = str_replace(array("\r\n","\r","\n"),'<br>',$mensaje);
    
                $_SESSION['CRUDMVC_ERROR'] .= "Mensaje -> $mensaje . <br>";
    
                header('Location: ' . URLSITE . 'view/error.php');
            }
        
        
    }
    static function enviartexto()
    {
        $destinatario = $_POST['to'];
        $destinatario_cc = $_POST['cc'];
        $destinatario_bcc = $_POST['bcc'];
        $asunto = $_POST['subject'];
        $mensaje = $_POST['message'];
        $cabecera= "Para: ". $destinatario."\r\n";
        $cabecera.= "From: ".$_SESSION['nombre']." <". $_SESSION['usuario'].">". "\r\n";
        if($_POST['cc'] != ''){
            $cabecera.= 'Cc: ' . $destinatario_cc . "\r\n";
        }
        if($_POST['bcc'] != ''){
            $cabecera.= 'Bcc: ' . $destinatario_bcc . "\r\n";
        }
        $cabecera.= 'X-Priority:1' . "\r\n";

        if (mail($destinatario, $asunto, $mensaje, $cabecera) == true)
            echo 'Mensaje enviado correctamente.';
        else
            echo 'Error al enviar el mensaje.';
    }

}
?>