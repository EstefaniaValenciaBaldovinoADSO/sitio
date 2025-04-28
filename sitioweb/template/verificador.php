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
<?php 

//print_r($_GET);
$ClientID ="AZBJVr7P9MF0aThuVBF_ouazPXKCEV826D1n3Q_lVpIZPy9G1p_D4byEf0K-zSyR-Twou4scvl4S2-vw";
$Secret = "EMGom74cA9-9PGT8w4ttHaWGNjLV7nHLd6AtqSxowCV7yGNLWET_Gnvd4xHQ_xbKig8kfVMhba5ayw6T";

    $Login = curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");
    curl_setopt($Login, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($Login, CURLOPT_USERPWD, $ClientID.":".$Secret);
    curl_setopt($Login, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    $Respuesta = curl_exec($Login);
   
    $objRespuesta = json_decode($Respuesta);
    $AccessToken = $objRespuesta->access_token;


    $venta = curl_init("https://api.sandbox.paypal.com/v1/payments/payment/".$_GET['paymentID']);
    curl_setopt($venta, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer ".$AccessToken));
    
    curl_setopt($venta, CURLOPT_RETURNTRANSFER, true);
    
    $RespuestaVenta= curl_exec($venta);
    

    $objDatosTransaccion = json_decode($RespuestaVenta);
    
    $state=$objDatosTransaccion ->state;

    $email=$objDatosTransaccion ->payer->payer_info ->email;
    $currency=$objDatosTransaccion ->transactions[0]->amount->currency;
    $total=$objDatosTransaccion ->transactions[0]->amount->total;
    $custom=$objDatosTransaccion ->transactions[0]->custom;
    //print_r($custom);   
    $clave=explode("#", $custom);
    $SID=$clave[0];
    $claveVenta=openssl_decrypt($clave[1], COD, KEY);
    curl_close($venta);
    curl_close($Login);
    
    //echo $claveVenta;
    if ($state=="approved") {
        $mensajePaypal="<h4>El pago ha sido procesado correctamente, se presenta el detalle de su compra, para descargar su recibo,<br> haga clic en el boton descargar</h4>";

        $sentencia=$pdo->prepare("UPDATE `tblventas` SET `PaypalDatos`=:PaypalDatos, `status`='aprobado' WHERE `tblventas`. `ID`=:ID;");
        $sentencia->bindParam(":ID", $claveVenta);
        $sentencia->bindParam(":PaypalDatos", $RespuestaVenta);
        $sentencia->execute();

        $sentencia=$pdo->prepare ("UPDATE `tblventas` SET status='completo' WHERE ClaveTransaccion=:ClaveTransaccion AND Total=:TOTAL AND ID=:ID");
        $sentencia->bindParam(':ClaveTransaccion', $SID);
        $sentencia->bindParam(':TOTAL', $total);
        $sentencia->bindParam(':ID', $claveVenta);
        $sentencia->execute();

        $completado=$sentencia->rowCount();
       
    } else {
        $mensajePaypal="<h4>El pago no se ha podido procesar, favor de intentar nuevamente</h4>";
    }
//echo $mensajePaypal;
     
        
        foreach($_SESSION['CARRITO'] as $indice=>$producto){
            unset($_SESSION['CARRITO'][$indice]);
        }
   
        
        session_destroy();
?>

<br><br><br>
<div class="container bg-info-subtle rounded-end-pill shadow-sm border-start border-primary border-3 rounded-start-5">
    <div class="container">
        <div class="row">
            <h1 class="display-3  d-flex flex-column text-center">¡Listo!</h1>
            <hr class="my-2 w-75 mx-auto border border-dark opacity-50">

            <p class="lead ">
                <?php echo $mensajePaypal; ?> 
                <?php
                if ($completado >= 1) {
                    $sentencia = $pdo->prepare("SELECT * FROM tbldetalleventa, producto WHERE tbldetalleventa.IDPRODUCTO = producto.ID AND tbldetalleventa.IDVENTA = :ID");
                    $sentencia->bindParam(':ID', $claveVenta);
                    $sentencia->execute();
                    $listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                  //print_r($listaProductos); // <--- COMENTADO PARA QUE NO ARRUINE EL DISEÑO
                }
                ?> 
            </p>
        </div>

        <div class="row mt-3 align-items-center justify-content-center">
            <?php foreach ($listaProductos as $producto) { ?>
                <div class="col-md-4 col-lg-3 mb-4"> 
                    <div class="card h-100">
                        <img class="card-img-top" src="../banners/<?php echo $producto['Imagen']; ?>" alt="Imagen del producto">
                        <div class="card-body d-flex flex-column text-center">

                        
                            <h4 class="card-title"><?php echo $producto['Titulo']; ?></h4>
                            <p class="card-text"><?php echo $producto['Descripcion']; ?></p>
                        </div>
                    </div>
                </div>
                
            <?php } ?>
        </div>
        <form action="descargas.php" method="post">
            <input type="hidden" name="IDVENTA" id="" value=" <?php echo openssl_encrypt($claveVenta,COD, KEY); ?>">
            <input type="hidden" name="IDPRODUCTO" id="" value=" <?php echo openssl_encrypt($producto['IDPRODUCTO'], COD, KEY); ?>">

            <div class="d-flex justify-content-center mb-4">
                <button type="submit" class="btn btn-success">Descargar</button>
  
             </div>
        </form>

<br>
    </div>
</div>


<br><br><br>

<br><br>


<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>