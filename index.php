<?php
//mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//mostrar errores

//echo md5(14699791);
require_once 'models/Database.php';

// Todo esta lógica hara el papel de un FrontController
if (!isset($_REQUEST['c'])) {
    $controller='usuarios';
    require_once "controllers/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    $controller->Index();
} else {
    session_start();
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    // Instanciamos el controlador
    require_once "controllers/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    // Llama la accion
    call_user_func(array($controller, $accion));
}