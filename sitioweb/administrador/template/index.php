<?php include '../config/bd.php';?>
<?php 
session_start();

$mensaje = "";

if($_POST){
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $rol = $_POST['rol'];

    $query = $conexion->prepare("SELECT * FROM usuarios WHERE usuario=:usuario AND contraseña=:contrasenia AND rol=:rol");
    $query->bindParam(':usuario', $usuario);
    $query->bindParam(':contrasenia', $contrasenia);
    $query->bindParam(':rol', $rol);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    if($usuario){
        $_SESSION['usuario'] = "ok";
        $_SESSION['nombreUsuario'] = $usuario['usuario'];
        $_SESSION['rol'] = $usuario['rol'];
    
        if($usuario['rol'] == 'admin'){
            header("Location:../template/inicio.php"); 
            exit();
        } elseif($usuario['rol'] == 'cliente'){
            header("Location: ../../template/login.php"); 
            exit();
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
    <title>Administrador del sitio web</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <link rel="stylesheet" href="styles.css">

    <style>
        .nav-link:hover, .btn:hover {
            font-size: 1.1rem;
            transition: font-size 0.3s ease;
        }
     
    </style>
</head>
<body>
<?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb" ?>

<div class="container-fluid p-3" style="background: linear-gradient(135deg,rgb(83, 152, 231), #6A5ACD); box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand fw-bold text-white" href="index.php" style="font-size: 1.5rem;">
            <i class="fi fi-rr-supplier-alt"></i> Marketplace Pro
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light px-4 py-2" href="<?php echo $url;?>/administrador/seccion/registrarse.php" style="border-radius: 20px; transition: 0.3s;">
                        <i class="fi fi-rr-user"></i> Registrarse
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light px-4 py-2 d-flex align-items-center" href="<?php echo $url;?>/template/index.php" style="border-radius: 20px; transition: 0.3s;">
                        <i class="fi fi-rr-browser me-2"></i> Ver Sitio Web
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<hr class="my-1">

<br/>
<div class="container d-flex justify-content-center background-pattern">
    <div class="col-md-6 col-lg-4 bg-light p-4 rounded shadow">
        <h4 class="text-center">Iniciar Sesión</h4>
        <hr class="my-1">
        <?php if($_POST && $mensaje != "") { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php } ?>
        <form method="POST">
            <div class="mb-3 mt-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario" placeholder="Ingrese usuario" name="usuario">
            </div>
            <div class="mb-3">
                <label for="contrasenia" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="contrasenia" placeholder="Ingrese contraseña" name="contrasenia">
            </div>

            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-control" id="rol" name="rol">
                    <option value="admin">Administrador</option>
                    <option value="cliente">Cliente</option>
                </select>
            </div>

            <div class="form-check mb-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Recuérdame
                </label>
            </div>
           
            <button type="submit" class="btn btn-secondary w-100">Iniciar Sesión</button>
          
        </form>
    </div>
</div>

<br/><br/>
<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
