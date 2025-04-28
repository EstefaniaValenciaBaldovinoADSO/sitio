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
if ($_POST) {
    $total=0;
    $SID=session_id();
    $Correo=$_POST['email'];
    foreach($_SESSION['CARRITO'] as $indice=>$producto){
        $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
    } 
    $sentencia=$pdo->prepare("INSERT INTO `tblventas` (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `status`) VALUES (NULL, :ClaveTransaccion, '', NOW(), :Correo, :Total, 'pendiente');");
    
    
    $sentencia->bindParam(":ClaveTransaccion", $SID);
    $sentencia->bindParam(":Correo", $Correo);
    $sentencia->bindParam(":Total", $total);
    $sentencia->execute();
    $idVenta=$pdo->lastInsertId();
   // echo "<h3>".$total."</h3>";
    
    foreach($_SESSION['CARRITO'] as $indice=>$producto){
        $sentencia=$pdo->prepare("INSERT INTO 
        `tbldetalleventa` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `COMPRA`) 
        VALUES (NULL, :IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO, :CANTIDAD, '0');");
            $sentencia->bindParam(":IDVENTA", $idVenta);
            $sentencia->bindParam(":IDPRODUCTO", $producto['ID']);
            $sentencia->bindParam(":PRECIOUNITARIO", $producto['PRECIO']);
            $sentencia->bindParam(":CANTIDAD", $producto['CANTIDAD']);
            
            $sentencia->execute();

}
}

?>
<br><br><br>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<style>
    
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }
    
    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 250px;
            display: inline-block;
        }
    }
    
</style>
<div class="container  bg-info-subtle rounded-end-pill shadow-sm border-start border-primary border-3  rounded-start-5">
    <div class="row">

        
        <div class="jumbotron text-center ">
            <br>
            <h1 class="display-4">¡Paso Final!</h1>
            <hr class="my-4">
            <p class="lead">Estas a punto de pagar con paypal la cantidad de:
                <h4>$<?php echo number_format($total,2);?></h4>
                <div id="paypal-button-container"> 
                    
                </div>
            </p>
            <hr class="my-4">
            <p>La orden de compra se emitira, luego de finalizado el pago con exito. <br>
                <strong>(Si tiene algun inconveniente comunicarse a soportech@marketplace.com)</strong>
            </p>
        
        </div>
</div>
</div>


 
 
<script>
    paypal.Button.render({
        env: 'sandbox', // sandbox | production
        style: {
            label: 'checkout',  // checkout | credit | pay | buynow | generic
            size:  'responsive', // small | medium | large | responsive
            shape: 'pill',   // pill | rect
            color: 'gold'   // gold | blue | silver | black
        },
 
        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
 
        client: {
            sandbox:    'AZBJVr7P9MF0aThuVBF_ouazPXKCEV826D1n3Q_lVpIZPy9G1p_D4byEf0K-zSyR-Twou4scvl4S2-vw',
            production: 'AVM24P5HFoD1T90FqSWUkx5qdbVDwbmK49AEi0_0UPwcpqMirj05V4NW5t8BrI9mc7yqfn7t8IR24pxL'
        },
 //AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R
        // Wait for the PayPal button to be clicked
 
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?php echo $total?>', currency: 'USD' }, 
                            description:"Compra de productos a Market place Pro  total: $ '<?php echo $total,2?>' ",
                            custom:"<?php echo $SID;?>#<?php echo openssl_encrypt($idVenta, COD, KEY);?>"
                        }
                    ]
                }
            });
        },
 
        // Wait for the payment to be authorized by the customer
 
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                console.log(data);
                window.location="verificador.php?paymentToken="+data.paymentToken+"&paymentID="+data.paymentID;
            });
        }
    
    }, '#paypal-button-container');
 
</script>





<br>
<br>
<br>
<br>
<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>