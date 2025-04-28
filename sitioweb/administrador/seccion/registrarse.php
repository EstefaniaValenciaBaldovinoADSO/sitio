<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">
<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb"; ?>
<?php

session_start();


include '../config/bd.php';


$txtUsuario = (isset($_POST['txtusuario'])) ? $_POST['txtusuario'] : "";
$txtNombre = (isset($_POST['txtnombre'])) ? $_POST['txtnombre'] : "";
$txtContrasenia = (isset($_POST['contrasenia'])) ? $_POST['contrasenia'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

if ($accion == "registrarse") {
    // Verificar si el usuario ya existe
    $verificarSQL = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE Usuario=:txtUsuario");
    $verificarSQL->bindParam(':txtUsuario', $txtUsuario);
    $verificarSQL->execute();
    $existe = $verificarSQL->fetchColumn(); // Obtiene el número de filas encontradas

    if ($existe > 0) {
        echo "<script>alert('El usuario ya existe. Por favor, elige otro nombre.');</script>";
    } else {
        // Si no existe, proceder con la inserción
        $txtFecha = date('Y-m-d H:i:s'); // Fecha actual
        $sentenciaSQL = $conexion->prepare("INSERT INTO usuarios (Usuario, `Nombres_y_apellido`, Contraseña, `fecha_registro`) VALUES (:txtUsuario, :txtNombre, :txtContrasenia, :txtFecha)");
        $sentenciaSQL->bindParam(':txtUsuario', $txtUsuario);
        $sentenciaSQL->bindParam(':txtNombre', $txtNombre);
        $sentenciaSQL->bindParam(':txtContrasenia', $txtContrasenia);
        
        $sentenciaSQL->bindParam(':txtFecha', $txtFecha);

        if ($sentenciaSQL->execute()) {
            echo "<script>alert('Registro exitoso. Por favor, inicie sesión.'); window.location.href='/sitioweb/administrador/template';</script>";
            exit();
        } else {
            echo "<script>alert('Hubo un error al crear el usuario. Inténtalo de nuevo.');</script>";
        }
    }
}
?>
<div class="container-fluid p-3"  style="background: linear-gradient(135deg,rgb(83, 152, 231), #6A5ACD); box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand fw-bold text-white" href="index.php" style="font-size: 1.5rem;">
            <i class="fi fi-rr-supplier-alt"></i> Marketplace Pro
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-outline-light px-4 py-2"" href="<?php echo $url;?>/administrador/template/index.php" style="border-radius: 20px; transition: 0.3s;">
                        <i class="fi fi-rr-user"></i> Iniciar Sesión
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light px-4 py-2" href="<?php echo $url;?>/template/index.php" style="border-radius: 20px; transition: 0.3s;">
                        <i class="fi fi-rr-browser me-2"></i> Ver Sitio Web
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<hr class="my-1">

<br/>

<div class="container d-flex justify-content-center">
    <div class="col-md-6 col-lg-4 bg-light p-4 rounded shadow">
        <h4 class="text-center">Registrarse</h4>
        <hr class="my-1">
        <form method="POST" action="registrarse.php">
            <div class="mb-3 mt-3">
                <label for="txtusuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" id="txtusuario" placeholder="Ingrese Usuario" name="txtusuario" required>
            </div>

            <div class="mb-3">
                <label for="txtnombre" class="form-label">Nombres y Apellidos:</label>
                <input type="text" class="form-control" id="txtnombre" placeholder="Ingrese su nombre y apellido" name="txtnombre" required>
            </div>

            <div class="mb-3">
                <label for="contrasenia" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="contrasenia" placeholder="Ingrese contraseña" name="contrasenia" required>
            </div>
            <div class="mb-3">
                <label for="contrasenia2" class="form-label">Repita Contraseña:</label>
                <input type="password" class="form-control" id="contrasenia2" placeholder="Repita contraseña" name="contrasenia2" required>
            </div>

            <div class="form-check mb-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="t&c" required> Acepto los términos y condiciones</label>
            </div>
            <input type="hidden" name="accion" value="registrarse">
            <button type="submit" class="btn btn-secondary w-100">Registrarse</button>
        </form>
    </div>
</div>

<br/>

<?php include '../template/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
