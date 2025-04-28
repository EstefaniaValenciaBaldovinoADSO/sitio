<?php 
session_start();
session_destroy();
header("Location:/sitioweb/administrador/template/index.php");
exit();
?>
