<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketPlace Pro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">
</head>
<body>

<?php include 'cabecera.php'; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card w-100 shadow-lg" style="background-color: rgba(249, 206, 253, 0.54);"> 
            <img src="/sitioweb/banners/idea.png" class="card-img-top img-fluid mx-auto d-block mt-3" alt="Por qué escogernos" style="width: 100%; height: auto; max-width: 150px; object-fit: contain;">
            <div class="card-body d-flex flex-column text-center">
                <h5 class="card-title">Publicar Anuncios</h5>
                <p class="card-text flex-grow-1 text-justify">Información sobre cómo publicar anuncios en nuestro sitio web.</p>
            </div>
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card w-100 shadow-lg" style="background-color: rgba(141, 194, 251, 0.22);">
            <img src="/sitioweb/banners/future.png" class="card-img-top img-fluid mx-auto d-block mt-3" alt="Por qué escogernos" style="width: 100%; height: auto; max-width: 150px; object-fit: contain;">
            <div class="card-body d-flex flex-column text-center">
                <h5 class="card-title">Por qué escogernos</h5>
                <p class="card-text flex-grow-1 text-justify">Razones por las que deberías elegir nuestro servicio.</p>
            </div>
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card w-100 shadow-lg" style="background-color: rgba(243, 255, 188, 0.36);">
            <img src="/sitioweb/banners/debit-card.png" class="card-img-top img-fluid mx-auto d-block mt-3" alt="Pagos Aceptados" style="width: 100%; height: auto; max-width: 150px; object-fit: contain;">
                <div class="card-body d-flex-column text-center">
                    <h5 class="card-title">Pagos Aceptados</h5>
                    <p class="card-text flex-grow-1 text-justify">Información sobre los métodos de pago que aceptamos.</p>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div class="row mt-5">
        <div class="col-md-6">
            <h3>Contacto</h3>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-secondary">Enviar</button>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Ubicación</h3>
            <p class="text-justify">Dirección: 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</p>
            <div id="map" style="height: 300px; width: 100%;"></div>
            <script>
                function initMap() {
                    var location = { lat: 37.422, lng: -122.084 };
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: location
                    });
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                }
            </script>
        </div>
    </div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
