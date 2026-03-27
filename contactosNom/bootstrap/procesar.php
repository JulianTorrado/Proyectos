<?php 
//conexion//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
try {
    $host='localhost';
    $dbname='documentalsg_proyectos';
    $username='document_calidad';
    $password='calidad2017';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected to $dbname at $host successfully.";
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

//fin conexion//
//funcion registro//
            $nombres=$_REQUEST['nombres']; 
            $apellidos=$_REQUEST['apellidos'];
            $correo=$_REQUEST['correo'];
            $identificacion=rand(3,123);
            $telefono=$_REQUEST['telefono'];
            $asunto= "Feria colombia 4.0";
            $auth= $_REQUEST['auth'];
            $nombreEmpresa = $_REQUEST['nombreEmpresa'];
//if($_REQUEST['auth']==true){
    try {
        $sql = "INSERT INTO interesados (nombres, nombreEmpresa, apellidos,correo, identificacion, telefono, asunto , auth,  reg_fec) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ? ,?)";

        $pdo->prepare($sql)->execute(
            array( 
            $nombres, 
            $nombreEmpresa,
            $apellidos,
            $correo,
            $identificacion,
            $telefono,
            $asunto,
            $auth='0', 
            date('Y-m-d'), 
            )
        );
    } catch (Exception $e) {
        die($e->getMessage());
    }
//}