<?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb"?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">
<link rel="stylesheet" href="styles.css">

<style>
    .nav-link:hover, .btn:hover {
        font-size: 1.1rem; /* Ajusta el tamaño según tus necesidades */
        transition: font-size 0.3s ease;
    }
</style>

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
                    <a class="nav-link text-white" href="nosotros.php">Sobre nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light px-4 py-2" href="<?php echo $url?>/administrador/template/index.php" style="border-radius: 20px; transition: 0.3s;">
                        <i class="fi fi-rr-user"></i> Iniciar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<hr class="my-1">
