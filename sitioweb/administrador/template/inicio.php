<?php include '../config/bd.php';?>

<?php 
session_start();


$mensaje = "";

if($_POST){
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $rol = $_POST['rol'];

    $query = $conexion->prepare("SELECT * FROM usuarios WHERE usuario=:usuario AND contraseña=:contrasenia");
    $query->bindParam(':usuario', $usuario);
    $query->bindParam(':contrasenia', $contrasenia);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    if($usuario){
        if($usuario['rol'] == 'admin'){
            $_SESSION['usuario'] = "ok";
            $_SESSION['nombreUsuario'] = "administrador";
            header("Location:inicio.php"); 
        } elseif($usuario['rol'] == 'cliente'){
            $_SESSION['usuario'] = "ok";
            $_SESSION['nombreUsuario'] = "cliente";
            header("Location:/sitioweb/template/login.php"); 
        } else {
            $mensaje = "Error: Rol no válido";
        }
    } else {
        $mensaje = "Error: Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-light">
<?php include 'cabecera.php'; ?>



<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh; margin-top: -50px;">
    <div class="card shadow-lg rounded-5">
        <div class="card-body">
            <h1 class="card-title display-4 text-center">Bienvenido al panel de administración</h1>
            <p class="card-text lead text-center">Este es el panel de administración de su sitio web. Desde aquí podrá gestionar los productos y servicios que se publican en su sitio web.</p>
            <hr class="my-4">
            <p class="text-center">Para comenzar, seleccione una de las opciones del menú superior.</p>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
    
</body>
</html>