

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<?php include '../config/bd.php';?>
<?php 

if(!isset($_SESSION['usuario'])){
    header("Location:../index.php");
}else{
    if($_SESSION['usuario']=="ok"){
        $nombreUsuario=$_SESSION['nombreUsuario'];
    }
}
?>



<div class="container-ms p-2" style="background-color:rgba(57, 112, 251, 0.82);">
<nav class="navbar navbar-expand-lg navbar-light" >
    <a class="navbar-brand" href="index.php">Marketplace Pro</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb"?>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">

            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $url;?>/administrador/template/inicio.php">Inicio</a>                
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url;?>/administrador/seccion/usuarios.php">Administracion de usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url;?>/administrador/seccion/productos.php">Anuncios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url;?>/template/index.php">Ver Sitio Web </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url;?>/administrador/seccion/cerrar.php">Cerrar Sesión</a>
            </li>
        </ul>
    </div>
</nav>
</div>
<hr class="my-1">