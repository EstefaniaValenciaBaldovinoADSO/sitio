
<?php include '../template/carrito.php' ; ?>


<?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb"?>


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
<?php include 'header.php'; ?>
<br>
<div class="container">
    
<h5 >Detalle de Compra</h5>

<?php if (!empty($_SESSION['CARRITO'])) {?>

<table class="table table-light table-bordered">
    <t-body>
        <tr>
            <th width="40%">Descripcion</th>
            <th width="15%"class="text-center">Cantidad</th>
            <th width="20%" class="text-center">Precio</th>
            <th width="20%"class="text-center">Total</th>
            <th width="5%" class="text-center">---</th>
        </tr>
        <?php $total=0;?>
        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto ){?> 
        <tr>
            <td width="40%"><?php echo ($producto['TITULO']); ?></td>
            <td width="15%" class="text-center"><?php echo ($producto['CANTIDAD']); ?></td>
            <td width="20%" class="text-center">$<?php echo ($producto['PRECIO'] ); ?></td>
            <td width="20%" class="text-center">$<?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'], 2,); ?></td>            
            
            <td width="5%" class="text-center"> 
            <form action="" method="post">   
            <input type="hidden"  name="ID" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
                <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar" >Eliminar</button></td>
            </form>
        </tr>
        <?php $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);?>
        <?php }?>
           
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td  align="right"><h3>$<?php echo number_format($total,2); ?></h3></td>
            <td></td>
        </tr>
            <tr>
                <td colspan="5">
                    <form action="pagar.php" method="post">
                        <div class="alert alert-success" role="alert">
                        <div class="form-group">
                            <label for="my-input">Correo de contacto</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Ingresa el correo de contacto" required">

                        </div>
                        <small id="emailHelp" class="form-text text text-muted">
                            Los productos se enviaran al correo


                        </small>
                        </div>
                        <button type="submit" class= "btn btn-primary btn-lg btn-block" name="btnAccion" value="proceder" href="pagar.php">
                            Pagar
                        </button>
                    </form>

                </td>
            </tr>



    </t-body>
    


</table>
<?php }  else {?>
    <div class="alert alert-success">
        <strong>No hay productos en el carrito</strong>
    </div>
<?php }?>
</div>

<br><br><br><br><br><br><br><br><br>
<br><br><br><br><br>

<?php include 'footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>


</body>

</html>