<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include '../template/cabecera.php';?>
<?php include '../config/bd.php';?>
<?php 
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtTitulo=(isset($_POST['txtTitulo']))?$_POST['txtTitulo']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtImagen=(isset($_FILES['txtSeleccionarImagen']['name']))?$_FILES['txtSeleccionarImagen']['name']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtCategoria=(isset($_POST['txtCategoria']))?$_POST['txtCategoria']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



switch($accion){

    case "agregar":
        $sentenciaSQL=$conexion->prepare("INSERT INTO producto (Titulo, Descripcion, Imagen, Precio, Categoria) VALUES (:txtTitulo, :txtDescripcion, :txtImagen, :txtPrecio, :txtCategoria);");
           
        $sentenciaSQL->bindParam(':txtTitulo',$txtTitulo);
        $fecha = new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtSeleccionarImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtSeleccionarImagen"]["tmp_name"];
        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../banners/".$nombreArchivo);
        }
        $sentenciaSQL->bindParam(':txtDescripcion',$txtDescripcion);
        $sentenciaSQL->bindParam(':txtImagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':txtPrecio',$txtPrecio);
        $sentenciaSQL->bindParam(':txtCategoria',$txtCategoria);
        $sentenciaSQL->execute();
        header("Location:productos.php");


        break;

    case "modificar":
        $sentenciaSQL=$conexion->prepare("UPDATE producto SET Titulo=:txtTitulo, Descripcion=:txtDescripcion, Categoria=:txtCategoria, Precio=:txtPrecio WHERE ID=:txtID;");
        $sentenciaSQL->bindParam(':txtTitulo',$txtTitulo);
        $sentenciaSQL->bindParam(':txtDescripcion',$txtDescripcion);
        $sentenciaSQL->bindParam(':txtPrecio',$txtPrecio);
        $sentenciaSQL->bindParam(':txtCategoria',$txtCategoria);
        $sentenciaSQL->bindParam(':txtID',$txtID);
        
        $sentenciaSQL->execute();

        if($txtImagen!=""){
            $fecha = new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtSeleccionarImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtSeleccionarImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../banners/".$nombreArchivo);
            $sentenciaSQL=$conexion->prepare("SELECT imagen FROM producto WHERE ID=:txtID;");
            $sentenciaSQL->bindParam(':txtID',$txtID);
            $sentenciaSQL->execute();
            $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
            if(isset($producto["imagen"]) && ($producto["imagen"]!="imagen.jpg")){
                if(file_exists("../../banners/".$producto["imagen"])){
                    unlink("../../banners/".$producto["imagen"]);
                }
            }
    
            $sentenciaSQL=$conexion->prepare("UPDATE producto SET Imagen=:txtImagen WHERE ID=:txtID;");
            $sentenciaSQL->bindParam(':txtImagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':txtID',$txtID);
            $sentenciaSQL->execute();
            

        }
        header("Location:productos.php");

        break;

    case "cancelar":
        header("Location:productos.php");

        break;

    case "Borrar":
        $sentenciaSQL=$conexion->prepare("SELECT imagen FROM producto WHERE ID=:txtID;");
        $sentenciaSQL->bindParam(':txtID',$txtID);
        $sentenciaSQL->execute();
        $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($producto["imagen"]) && ($producto["imagen"]!="imagen.jpg")){
            if(file_exists("../../banners/".$producto["imagen"])){
                unlink("../../banners/".$producto["imagen"]);
            }
        }


        $sentenciaSQL=$conexion->prepare("DELETE FROM producto WHERE ID=:txtID;");
        $sentenciaSQL->bindParam(':txtID',$txtID);
        $sentenciaSQL->execute();
        header("Location:productos.php");

        break;

    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM producto WHERE ID=:txtID;");
        $sentenciaSQL->bindParam(':txtID',$txtID);
        $sentenciaSQL->execute();
        $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtTitulo=$producto['Titulo'];
        $txtDescripcion=$producto['Descripcion'];
        $txtImagen=$producto['Imagen'];
        $txtPrecio=$producto['Precio'];
        $txtCategoria=$producto['Categoria'];
        break;
}

$sentenciaSQL=$conexion->prepare("SELECT * FROM producto;");
$sentenciaSQL->execute();
$ListaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?> 


<div class="container">
    <div class="row">
        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    Datos del Producto
                </div>
                <div class="card-body p-3">
                    <form method="POST" enctype="multipart/form-data" action="productos.php">
                        <div class="form-group">
                            <label for="txtID">ID:</label>
                            <input type="text" required readonly  name="txtID" id="txtID" class="form-control" placeholder="ID" value="<?php echo $txtID; ?>">
                        </div>

                        <div class="form-group">
                            <label for="txtTitulo">Título:</label>
                            <input type="text" required class="form-control" value="<?php echo $txtTitulo;?>" name="txtTitulo" id="txtTitulo" placeholder="Título Anuncio">
                        </div>

                        <div class="form-group">
                            <label for="txtDescripcion">Descripción:</label>
                            <input type="text" required class="form-control" value="<?php echo $txtDescripcion;?>" name="txtDescripcion" id="txtDescripcion" placeholder="Descripción">
                        </div>

                        <div class="form-group">
                            <label for="txtSeleccionarImagen">Imagen:</label>
                            <br/>
                                <?php 
                                if($txtImagen!=""){?>
                                    <img class='img-thumbnail rounded' src='../../banners/<?php echo $txtImagen;?>' width='40' alt='' srcset=''>
                            
                                <?php }?>

                            <input type="file" class="form-control" name="txtSeleccionarImagen" id="txtSeleccionarImagen" placeholder="Elegir Archivo">

                        </div>

                        <div class="form-group">
                            <label for="txtPrecio">Precio:</label>
                            <input type="decimal" required class="form-control" value="<?php echo $txtPrecio;?>" name="txtPrecio" id="txtPrecio" placeholder="Precio">
                        </div>

                        <div class="form-group">
                            <label for="txtCategoria" class="form-label">Categoria:</label>
                                <select lass="form-control" id="txtCategoria" name="txtCategoria">
                                    <option type="enum" required value="Producto">Producto</option>
                                    <option type="enum" required value="Servicio">Servicio</option>
                                    <option type="enum" required value="Curso">Curso</option>
                                </select>
                              
                        
                        </div>
                        <br><br>
                        <div class="d-flex gap-2" role="group" aria-label="">

                            <button type="submit" name="accion" <?php echo $accion=="Seleccionar"?"disabled":"";?> value="agregar" class="btn btn-success">Agregar</button>
                            <button type="submit" name="accion" <?php echo $accion!="Seleccionar"?"disabled":"";?> value="modificar" class="btn btn-warning">Modificar</button>
                            <button type="submit" name="accion" <?php echo $accion!="Seleccionar"?"disabled":"";?> value="cancelar" class="btn btn-info">Cancelar</button>

                        </div>

                    </form>
                    <br><br>

                </div>

            </div>


        </div>

        <div class="col-md-8">
            <table class="table table-bordered">

                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ListaProductos as $producto){?>

                    <tr>
                        <td><?php echo $producto['ID'];?></td>
                        <td><?php echo $producto['Titulo'];?></td>
                        <td><?php echo $producto['Descripcion'];?></td>
                        <td><?php echo $producto['precio'];?></td>
                        <td><?php echo $producto['Categoria'];?></td>
                        <td>
                            <img class='img-thumbnail rounded' src="../../banners/<?php echo $producto['Imagen'];?>" width="40" alt="" srcset="">
                        
                    </td>
                        <td>
                            <form method="POST" style="display: flex; gap: 5px;">
                                <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['ID'];?>"/>
                                <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                                <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>

                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            
        </div>


</div>
</div>

<?php include '../template/footer.php';?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>


    
</body>

</html>