<?php 
include '../template/carrito.php'; 

include '../administrador/global/conexion.php';
?>


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
<body >

<?php include 'header.php'; ?>
<br><br><br>
<?php 


if ($_POST) {
    $IDVENTA= openssl_decrypt($_POST['IDVENTA'], COD, KEY); ;
    $IDPRODUCTO=openssl_decrypt($_POST['IDPRODUCTO'], COD, KEY); ;

   // print_r($IDVENTA);
    //print_r($IDPRODUCTO);

    $sentencia=$pdo->prepare("SELECT * FROM `tbldetalleventa` WHERE `IDVENTA` = :IDVENTA AND IDPRODUCTO=:IDPRODUCTO AND descargado<1;");
    $sentencia->bindParam(':IDVENTA', $IDVENTA);
    $sentencia->bindParam(':IDPRODUCTO', $IDPRODUCTO);
    $sentencia->execute();
    $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    //print_r($listaProductos);

    

    if ($sentencia->rowCount() > 0) {
        echo "<div class='container'>
        <div class='row'> 
        <div class='card h-100'>
            <div class='card-body d-flex flex-column text-center'>

                            <p>Codigo de recibo XRTSSGHHALEVAORFSAC</p>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>";
    }else {
        echo "<script>alert('Tus descargas se agotaron');</script>";
    }
}

?>


<br><br><br><br><br><br><br><br><br><br><br>
<br><br><br>
<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>