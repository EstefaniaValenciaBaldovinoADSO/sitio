<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MarketPlace Pro</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <style>
    .card {
      transition: transform 0.2s, box-shadow 0.2s;
      aspect-ratio: 1 / 1; /* Ajusta la proporción según necesites */
      display: flex;
      flex-direction: column;
}

.card img {
  flex-grow: 1;
  object-fit: cover;
}

.card-body {
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}


    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

   


  </style>
</head>
<body>

<?php include 'cabecera.php'; ?>

<header class="fullscreen-carousel">
  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../banners/banner5.png" class="d-block w-100 d-block h-110" alt="banner 1">
    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
    </div>
    </div>
    <div class="carousel-item">
    <img src="../banners/baner.png" class="d-block w-100" alt="banner 2">
    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
    </div>
    </div>
    <div class="carousel-item">
    <img src="../banners/banner4.png" class="d-block w-100" alt="banner 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
  </div>
</header>
<hr class="my-1">
<br>

<div class="container">
  <h3 class="mb-4">Anuncios Recientes</h3>
  <div class="row" id="servicios-lista">

  <?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb"?>

<?php 
include '../administrador/config/bd.php';

$conexion = new PDO('mysql:host=localhost;dbname=sitio', 'root', '');
$sentenciaSQL = $conexion->prepare("SELECT * FROM producto ORDER BY id DESC LIMIT 4;");
$sentenciaSQL->execute();
$ListaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<br/><br/>

  <?php foreach ($ListaProductos as $producto) { ?>
    <div class="col-12 col-md-6 col-lg-3 mb-4 d-flex align-items-stretch">
    <div class="card h-100">
      <img class="card-img-top" src="../banners/<?php echo $producto['Imagen']; ?>" alt="" style="height: 200px; object-fit: cover;">
      <div class="card-body d-flex flex-column">
      <h4 class="card-title text-center"><?php echo $producto['Titulo']; ?></h4>
      <div class="text-center flex-grow-1">
        <p class="card-text text-left"><?php echo $producto['Descripcion']; ?></p>
      </div>
      <div class="text-center">
        <p class="card-text"><?php echo $producto['precio']; ?></p>
      </div>
      </div>
      <div class="text-center mb-2">
      <a name="" id="" class="btn btn-secondary" href="#" role="button" onclick="alert('Inicie sesión para comprar')">Comprar</a>
      </div>
    </div>
    </div>
  <?php } ?>
 
  </div>
</div>
<br>
<hr class="my-3">
<section class="container my-4">
  <h3 class="mb-4 text-center">Testimonios</h3>
  <div class="row">
    <div class="col-md-4">
    <div class="card-testimonio ">
      <div class="card-body">
      <p class="card-text ">"Excelente servicio, muy profesional. ¡Lo recomiendo demasiado!"</p>
      <footer class="blockquote-footer">Juan Pérez</footer>
      </div>
    </div>
    </div>
    <div class="col-md-4  border-black border-2">
    <div class="card-testimonio">
      <div class="card-body ">
      <p class="card-text">"El servicio cumplió todas mis expectativas. ¡Gran trabajo!"</p>
      <footer class="blockquote-footer">Ana Gómez</footer>
      </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="card-testimonio  ">
      <div class="card-body">
      <p class="card-text">"Muy buena atención y calidad de servicio. Volveré a contratar."</p>
      <footer class="blockquote-footer">Carlos López</footer>
      </div>
    </div>
    </div>
  </div>
  </section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>