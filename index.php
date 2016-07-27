<?php

// Carga todo el proyecto
require __DIR__ . '/vendor/autoload.php';

foreach(['lib', 'controller', 'model'] as $f)
{
    foreach (glob(__DIR__ . "/app/$f/*.php") as $filename)
        require $filename;    
}

$defaultController = 'AlumnoController';

// Todo esta lógica hará el papel de un FrontController
if(!isset($_REQUEST['c'])){
    $controller = new $defaultController();
    $controller->Index();    
} else {
    
    // Obtenemos el controlador que queremos cargar
    $controller = $_REQUEST['c'] . 'Controller';
    $accion     = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    
    
    // Instanciamos el controlador
    $controller = new $controller();
    
    // Llama la accion
    call_user_func( array( $controller, $accion ) );
}