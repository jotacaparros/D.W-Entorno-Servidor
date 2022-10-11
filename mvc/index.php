<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("config.php");
require_once("controller/clientes.php");
require_once("controller/facturas.php");
require_once("controller/facturaslineas.php");
require_once("controller/app.php");

if(isset($_GET['c'])) :
    $controlador = $_GET['c'];

    $metodo = '';
    
    switch ($controlador) :
        case 'clientes' :
            if(isset($_GET['m'])):
                $metodo = $_GET['m'];
            endif;

            if (method_exists('ClientesControlador', $metodo)):
                ClientesControlador::{$metodo}();
            else :
                ClientesControlador::index();
            endif; 
            break;
        
        case 'facturas' :
            if(isset($_GET['m'])):
                $metodo = $_GET['m'];
            endif;

            if (method_exists('FacturasControlador', $metodo)):
                FacturasControlador::{$metodo}();
            else :
                FacturasControlador::index();
            endif; 
            break;
        case 'facturaslineas' :
            if(isset($_GET['m'])):
                $metodo = $_GET['m'];
            endif;

            if (method_exists('FacturasLineasControlador', $metodo)):
                FacturasLineasControlador::{$metodo}();
            else :
                FacturasLineasControlador::index();
            endif; 
            break;            
    endswitch;
else :
    AppControlador::index();
endif;
?>