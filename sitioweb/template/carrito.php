<?php 
session_start();
include '../administrador/global/config.php'; 
include '../administrador/global/conexion.php'; 

$mensaje = "";

if (isset($_POST['btnAccion'])) {
    
    switch ($_POST['btnAccion']) {
        case 'agregar':
            
            if (is_numeric(openssl_decrypt($_POST['ID'], COD, KEY))) {

                    $ID=openssl_decrypt($_POST['ID'], COD, KEY);
                    $mensaje.= "Ok ID Correcto<br/>" .$ID;

                } else {

                    $mensaje.= "Ups.. ID Incorrecto <br/>" .$ID;

                }
                
                if (is_string(openssl_decrypt($_POST['titulo'], COD, KEY))) {
                    $TITULO=openssl_decrypt($_POST['titulo'], COD,KEY);
                    $mensaje.= "Ok cantidad<br/>" .$TITULO;
                }else { $mensaje.="Uppss....algo pasa con el titulo<br/>"; break; }
             
                if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
                    $CANTIDAD=openssl_decrypt($_POST['cantidad'], COD, KEY);
                    $mensaje.= "Ok cantidad<br/>" .$CANTIDAD;
                } else {
                    $mensaje.="Ups...algo pasa con la cantidad<br/>"; break;
                }

                if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                    $PRECIO=openssl_decrypt($_POST['precio'], COD, KEY);
                    $mensaje.= "Ok precio <br/>" .$PRECIO;

                } else {
                    $mensaje.="Ups...algo pasa con el precio <br/>" ; break;
                }
            

            if (!isset($_SESSION['CARRITO'])) { 
                // Agregar producto al carrito
            $producto = array(
                'ID' => $ID,
                'TITULO' => $TITULO,
                'CANTIDAD' => $CANTIDAD,
                'PRECIO' => $PRECIO,
            );
                $_SESSION['CARRITO'][0] = $producto;
                $mensaje= "Producto Agregado al carrito";
            } else {
                $idProductos=array_column($_SESSION['CARRITO'], "ID");
                if (in_array($ID,$idProductos)) {
                    echo " <script>alert('El Producto ya ha sido seleccionado')</script>";
                    $mensaje= "";
                    
                } else {
                    
                $NumeroProductos = count($_SESSION['CARRITO']);
                $producto = array(
                    'ID' => $ID,
                    'TITULO' => $TITULO,
                    'CANTIDAD' => $CANTIDAD, 
                    'PRECIO' => $PRECIO,
                );
                    
                $_SESSION['CARRITO'][$NumeroProductos] = $producto;
                $mensaje= "Producto Agregado al carrito";
            }
                    # code...
                }
                


            
            //$mensaje .= print_r($_SESSION, true);
            
            break;
            case 'Eliminar':
                if (is_numeric(openssl_decrypt($_POST['ID'], COD, KEY))) {

                    $ID=openssl_decrypt($_POST['ID'], COD, KEY);
                    
                    foreach($_SESSION['CARRITO'] as $indice=>$producto){
                        if ($producto['ID']==$ID) {
                            unset($_SESSION['CARRITO'][$indice]);

                            echo " <script>alert('Producto borrado...')</script>";
                    
                        }   else {

                    $mensaje.= "Ups.. ID Incorrecto <br/>" .$ID;

                }
                break;
    }
}
}
}
?>