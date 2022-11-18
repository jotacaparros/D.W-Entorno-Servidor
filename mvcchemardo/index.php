<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("config.php");


require_once("controller/app.php");
require_once("controller/login.php");





if(isset($_GET['c'])) :
    $controlador = $_GET['c'];

    $metodo = '';

    if(isset($_GET['m'])):
        $metodo = $_GET['m'];
    endif;
    
    switch ($controlador) :
        case 'salir' :
            require_once("controller/salir.php");
            if (method_exists('SalirControlador', $metodo)):
                SalirControlador::{$metodo}();
            endif; 
            break;
        case 'email' :
            require_once("controller/email.php");
            if (method_exists('EmailControlador', $metodo)):
                EmailControlador::{$metodo}();
            else :
                AppControlador::index();
            endif; 
            break;
        case 'clientes' :
            require_once("controller/clientes.php");
            if (method_exists('ClientesControlador', $metodo)):
                ClientesControlador::{$metodo}();
            else :
                ClientesControlador::index();
            endif; 
            break;
        case 'usuarios' :
            require_once("controller/usuarios.php");
            if (method_exists('UsuariosControlador', $metodo)):
                UsuariosControlador::{$metodo}();
            else :
                UsuariosControlador::index();
            endif; 
            break;
        
        case 'facturas' :
            require_once("controller/facturas.php");
            if (method_exists('FacturasControlador', $metodo)):
                FacturasControlador::{$metodo}();
            else :
                FacturasControlador::index();
            endif; 
            break;
        case 'facturaslineas' :
            require_once("controller/facturaslineas.php");
            if (method_exists('FacturasLineasControlador', $metodo)):
                FacturasLineasControlador::{$metodo}();
            else :
                FacturasLineasControlador::index();
            endif; 
            break;
        case 'proveedores' :
            require_once("controller/proveedores.php");
            if (method_exists('ProveedoresControlador', $metodo)):
                ProveedoresControlador::{$metodo}();
            else :
                ProveedoresControlador::index();
            endif; 
            break;
        case 'facturasproveedores' :
            require_once("controller/facturasproveedores.php");
            if (method_exists('FacturasProveedoresControlador', $metodo)):
                FacturasProveedoresControlador::{$metodo}();
            else :
                FacturasProveedoresControlador::index();
            endif; 
            break;
        case 'facturaslineasproveedores' :
            require_once("controller/facturaslineasproveedores.php");
            if (method_exists('FacturasLineasProveedoresControlador', $metodo)):
                FacturasLineasProveedoresControlador::{$metodo}();
            else :
                FacturasLineasProveedoresControlador::index();
            endif; 
            break;
        case 'login' :
            if (method_exists('LoginControlador', $metodo)):
                LoginControlador::{$metodo}();
            else :
                //LoginControlador::index();
            endif; 
            break;            
    endswitch;
else :
    AppControlador::index();
endif;
?>