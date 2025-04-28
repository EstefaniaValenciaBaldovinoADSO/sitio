



<?php 
include '../template/carrito.php'; 

include '../administrador/global/conexion.php';

$conexion = new PDO('mysql:host=localhost;dbname=sitio', 'root', '');
$sentenciaSQL = $conexion->prepare("SELECT * FROM producto;");
$sentenciaSQL->execute();
$ListaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$mensaje = isset($mensaje) ? $mensaje : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketPlace Pro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb"; ?>
<?php include 'header.php'; ?>

<div class="container">
<?php if ($mensaje!="") 
   {?>
    <div class="alert alert-success">
        <?php echo $mensaje; ?>
        <a href="detalle.php" class="badge badge-success">Ver Carrito</a>
    </div>
    <?php }?>

    <div class="row">
        <div class="col-12 col-md-3 mb-4">
            <h5>Filtrar por Categoría</h5>
            <div class="dropdown mb-4">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Seleccionar Categoría
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="?categoria=todos">Todas las Categorías</a></li>
                    <li><a class="dropdown-item" href="?categoria=Producto">Productos</a></li>
                    <li><a class="dropdown-item" href="?categoria=Curso">Cursos</a></li>
                    <li><a class="dropdown-item" href="?categoria=Servicio">Servicios</a></li>
                </ul>
            </div>
        </div>

        <div class="col-12 col-md-1 d-none d-md-block">
            <div class="vr shadow"></div>
        </div>

        <div class="col-12 col-md-8">
            <div class="row">
                <?php 
                $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'todos';

                foreach ($ListaProductos as $producto) {
                    if ($categoria == 'todos' || $producto['Categoria'] == $categoria) { 
                ?>
                <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                    <div class="card h-100">
                        <img class="card-img-top img-hover" src="../banners/<?php echo ($producto['Imagen']); ?>" alt="" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column text-center">
                            
                            <h4 class="card-title text-primary"><?php echo ($producto['Titulo']); ?></h4>
                            
                            <p class="card-text text-muted flex-grow-1">Descripcion</p>
                            <p class="card-text fw-bold text-success">$<?php echo ($producto['precio']); ?></p>
                            
                            
                        </div>
                        <form action="" method="post">
                            <input type="hidden"  name="ID" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
                            <input type="hidden" name="titulo" value="<?php echo openssl_encrypt($producto['Titulo'], COD, KEY); ?>">
                            <input type="hidden" name="descripcion" value="<?php echo openssl_encrypt($producto['Descripcion'], COD, KEY); ?>">
                            <input type="hidden" name="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">
                            <input type="hidden" name="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">
                            
                            

                            <div class="d-flex justify-content-center">

                                <button class="btn btn-secondary w-75" name="btnAccion" value="agregar" type="submit">Comprar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php 
                    }
                } 
                ?>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>

<style>
    body {
        background-color: #f0f5f9;
    }
    .dropdown-menu {
        border-radius: 10px;
        background-color: #e3f2fd;
    }
    .dropdown-item:hover {
        background-color: #90caf9;
        color: white;
    }
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    }
    .btn-secondary {
        background-color: #64b5f6;
        border: none;
    }
    .btn-secondary:hover {
        background-color: #42a5f5;
    }
    .vr {
        background-color: #90caf9;
        width: 3px;
    }
</style>
