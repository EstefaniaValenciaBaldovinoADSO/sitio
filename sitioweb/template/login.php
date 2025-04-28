<?php include '../administrador/config/bd.php';?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketPlace Pro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">

    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-light">


<?php 
session_start();

?>

<?php include 'header.php'; ?>

<br>
<br>


    <div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold text-primary">Bienvenido al panel de control, selecciona una opcion </h2>
    
    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-lg border-0 text-center custom-card">
                <div class="card-body">
                    <i class="bi bi-shop display-4 text-info"></i>
                    <h5 class="card-title mt-3 text-info">Explorar Productos</h5>
                    <p class="card-text text-muted">Descubre nuestra variedad de productos y servicios.</p>
                    <a  href="<?php echo $url?>/template/publicar.php" class="btn btn-outline-info">Ver Productos</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-lg border-0 text-center custom-card">
                <div class="card-body">
                    <i class="bi bi-cart-check display-4 text-success"></i>
                    <h5 class="card-title mt-3 text-success">Mis Compras</h5>
                    <p class="card-text text-muted">Consulta el carrito y detalle</p>
                    <a href="<?php echo $url?>/template/carrito.php" class="btn btn-outline-success">Ver Compras</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-lg border-0 text-center custom-card">
                <div class="card-body">
                    <i class="bi bi-person-circle display-4 text-primary"></i>
                    <h5 class="card-title mt-3 text-primary">Mi Perfil</h5>
                    <p class="card-text text-muted">Gestiona tu información personal y preferencias.</p>
                    <a href="<?php echo $url?>/template/perfil.php" class="btn btn-outline-primary">Ver Perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-card {
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .custom-card:hover {
        transform: scale(1.05);
        box-shadow: 0px 10px 20px rgba(0, 0, 255, 0.3);
    }

    .custom-card i {
        transition: color 0.3s ease;
    }

    .custom-card:hover i {
        color: #00bcd4;
    }
</style>
<br>
<br>
<br>
<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>