<?php 
$host="localhost";
$usuario="root";
$bd="sitio";
$contrasenia="";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
    if($conexion){
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
    exit(); 
}
?> 
