<?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb"?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="styles.css">

<div class="container-fluid p-3" style="background: linear-gradient(135deg, #4A90E2, #6A5ACD); box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand fw-bold text-white" href="index.php" style="font-size: 1.5rem;">
                  
        <i class="fi fi-ss-supplier-alt" style="font-size: 1.5rem;"></i> Marketplace Pro
        </a>
        
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="<?php echo $url?>/template/login.php" style="position: relative;">
                        <i class="fi fi-rr-home" style="font-size: 1.5rem;"></i>
                        <span class="nav-text">Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo $url?>/template/publicar.php" style="position: relative;">
                        <i class="fi fi-rr-apps" style="font-size: 1.5rem;"></i>
                        <span class="nav-text">Anuncios</span>
                    </a>
                </li>
                <li class="nav-item" style="position: relative;">
                    <a class="nav-link text-white" href="<?php echo $url?>/template/detalle.php">
                        <i class="fi fi-rr-shopping-cart" style="font-size: 1.5rem; position: relative;">
                            <span class="fs-6" style="font-size: 0.7rem;">(<?php echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']); ?>)</span>
                        </i>
                        <span class="nav-text">Carrito</span>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo $url?>/template/reseña.php" style="position: relative;">
                        <i class="fi fi-rr-comments" style="font-size: 1.5rem;"></i>
                        <span class="nav-text">Reseñas</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo $url?>/administrador/seccion/cerrar.php" style="position: relative;">
                        <i class="fi fi-rr-exit" style="font-size: 1.5rem;"></i>
                        <span class="nav-text">Cerrar</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>



<hr class="sidebar-divider m-1">

<style>
    .nav-link {
        transition: all 0.3s ease;
    }
    .nav-link:hover {
        color: #FFD700;
        transform: scale(1.1);
    }
    .nav-text {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 0.75rem;
        background-color: rgba(0, 0, 0, 0.7);
        padding: 0.2rem 0.5rem;
        border-radius: 0.3rem;
        color: white;
    }
    .nav-item:hover .nav-text {
        display: block;
    }
</style>
