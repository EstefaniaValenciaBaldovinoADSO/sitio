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
$txtUsuario=(isset($_POST['txtUsuario']))?$_POST['txtUsuario']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtContrasenia=(isset($_POST['txtContrasenia']))?$_POST['txtContrasenia']:"";
$txtFecha=(isset($_POST['txtFecha']))?$_POST['txtFecha']:"";
$txtRol=(isset($_POST['txtRol']))?$_POST['txtRol']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



switch($accion){

    case "agregar":
        // Verificar si el usuario ya existe
        $verificarSQL = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE Usuario=:txtUsuario");
        $verificarSQL->bindParam(':txtUsuario', $txtUsuario);
        $verificarSQL->execute();
        $existe = $verificarSQL->fetchColumn(); // Obtiene el número de filas encontradas

        if ($existe > 0) {
            echo "<script>alert('El usuario ya existe. Por favor, elige otro nombre.');</script>";
        } else {
            // Si no existe, proceder con la inserción
            $txtFecha = date('Y-m-d H:i:s'); // Fecha actual
            $sentenciaSQL = $conexion->prepare("INSERT INTO usuarios (Usuario, `Nombres_y_apellido`, Contraseña, `fecha_registro`, `rol`) VALUES (:txtUsuario, :txtNombre, :txtContrasenia, :txtFecha, :txtRol)");
            $sentenciaSQL->bindParam(':txtUsuario', $txtUsuario);
            $sentenciaSQL->bindParam(':txtNombre', $txtNombre);
            $sentenciaSQL->bindParam(':txtContrasenia', $txtContrasenia);
            $sentenciaSQL->bindParam(':txtRol', $txtRol);
            $sentenciaSQL->bindParam(':txtFecha', $txtFecha);
    
            if ($sentenciaSQL->execute()) {
                header("Location: usuarios.php");
                exit();
            } else {
                echo "<script>alert('Hubo un error al crear el usuario. Inténtalo de nuevo.');</script>";
            }
        }
        break;

    case "modificar":
        // Verificar si el usuario ya existe
        $verificarSQL = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE Usuario=:txtUsuario AND ID!=:txtID");
        $verificarSQL->bindParam(':txtUsuario', $txtUsuario);
        $verificarSQL->bindParam(':txtID', $txtID);
        $verificarSQL->execute();
        $existe = $verificarSQL->fetchColumn(); // Obtiene el número de filas encontradas

        if ($existe > 0) {
            echo "<script>alert('El usuario no está disponible. Por favor, elige otro nombre.');</script>";
        } else {
            $sentenciaSQL=$conexion->prepare("UPDATE usuarios SET Usuario=:txtUsuario, `Nombres_y_apellido`=:txtNombre, Contraseña=:txtContrasenia, `rol`=:txtRol WHERE ID=:txtID;");
            $sentenciaSQL->bindParam(':txtUsuario',$txtUsuario);
            $sentenciaSQL->bindParam(':txtNombre', $txtNombre);
            $sentenciaSQL->bindParam(':txtContrasenia',$txtContrasenia);
            $sentenciaSQL->bindParam(':txtRol',$txtRol);
            $sentenciaSQL->bindParam(':txtID',$txtID);
            $sentenciaSQL->execute();
            header("Location:usuarios.php");
        }
   
        break;

    case "modificar":
        // Verificar si el usuario ya existe
        $verificarSQL = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE Usuario=:txtUsuario AND ID!=:txtID");
        $verificarSQL->bindParam(':txtUsuario', $txtUsuario);
        $verificarSQL->bindParam(':txtID', $txtID);
        $verificarSQL->execute();
        $existe = $verificarSQL->fetchColumn(); // Obtiene el número de filas encontradas

        if ($existe > 0) {
            echo "<script>alert('El usuario no está disponible. Por favor, elige otro nombre.');</script>";
        } else {
            $sentenciaSQL=$conexion->prepare("UPDATE usuarios SET Usuario=:txtUsuario, `Nombres_y_apellido`=:txtNombre, Contraseña=:txtContrasenia WHERE ID=:txtID;");
            $sentenciaSQL->bindParam(':txtUsuario',$txtUsuario);
            $sentenciaSQL->bindParam(':txtNombre',$txtNombre);
            $sentenciaSQL->bindParam(':txtContrasenia',$txtContrasenia);
            $sentenciaSQL->bindParam(':txtID',$txtID);
            $sentenciaSQL->execute();
            header("Location:usuarios.php");
        }
   
        break;

    case "cancelar":
        
        header("Location:usuarios.php");
        break;

    case "Borrar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM usuarios WHERE ID=:txtID;");
        $sentenciaSQL->bindParam(':txtID',$txtID);
        $sentenciaSQL->execute();
        $usuario=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
       

        $sentenciaSQL=$conexion->prepare("DELETE FROM usuarios WHERE ID=:txtID;");
        $sentenciaSQL->bindParam(':txtID',$txtID);
        $sentenciaSQL->execute();
        header("Location:usuarios.php");

        break;

    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM usuarios WHERE ID=:txtID;");
        $sentenciaSQL->bindParam(':txtID',$txtID);

        $sentenciaSQL->execute();
        $usuario=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtUsuario=$usuario['Usuario'];
        $txtNombre=$usuario['Nombres_y_apellido'];
        $txtContrasenia=$usuario['Contraseña'];
        $txtFecha=$usuario['fecha_registro'];
        $txtRol=$usuario['rol'];
        break;
    
  

}

$sentenciaSQL=$conexion->prepare("SELECT * FROM usuarios;");
$sentenciaSQL->execute();
$ListaUsuarios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row">
        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    Datos del cliente
                </div>
                <div class="card-body p-3">
                    <form method="POST" enctype="multipart/form-data" action="usuarios.php">
                        <div class="form-group">
                            <label for="txtID">ID:</label>
                            <input type="text" required readonly  name="txtID" id="txtID" class="form-control" placeholder="ID" value="<?php echo $txtID; ?>">
                        </div>

                        <div class="form-group">
                            <label for="txtUsuario">Usuario:</label>
                            <input type="text" required class="form-control" value="<?php echo $txtUsuario;?>" name="txtUsuario" id="txtUsuario" placeholder="Ingrese su nuevo usuario">
                       
                        </div>

                        <div class="form-group">
                            <label for="txtNombre">Nombres y Apellido:</label>
                            <input type="text" class="form-control" value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre" placeholder="Ingrese su nombre y apellido">
                            
                        </div>

                        <div class="form-group">
                            <label for="txtContrasenia">Contraseña:</label>
                            <input type="password" required class="form-control" value="<?php echo $txtContrasenia;?>" name="txtContrasenia" id="txtContrasenia" placeholder="Ingrese su nueva contraseña">
                        
                        </div>

                        <div class="form-group">
                            <label for="txtFecha">Fecha Registro de Usuario:</label>
                            <input type="timestamp" required readonly class="form-control" value="<?php echo $txtFecha;?>" name="txtFecha" id="txtFecha" placeholder="Fecha de registro">

                        </div>
                        <div class="form-group">
                           
                            <label for="txtRol" class="form-label">Rol:</label>
                                <select class="form-control" id="txtRol" name="txtRol">
                                    <option type="enum" required value="admin">Administrador</option>
                                    <option type="enum" required value="cliente">Cliente</option>
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
                        <th>Usuario</th>
                        <th>Nombres y Apellidos</th>
                        <th>Contraseña</th>
                        <th>Fecha Registro Usuario</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ListaUsuarios as $usuario){?>

                    <tr>
                        <td><?php echo $usuario['ID'];?></td>
                        <td><?php echo $usuario['Usuario'];?></td>
                        <td><?php echo $usuario['Nombres_y_apellido'];?></td>
                        <td><?php echo $usuario['Contraseña'];?></td>
                        <td><?php echo $usuario['fecha_registro'];?></td>
                        <td><?php echo $usuario['rol'];?></td>
                        
                        <td>
                            <form method="POST" style="display: flex; gap: 5px;">
                                <input type="hidden" name="txtID" id="txtID" value="<?php echo $usuario['ID'];?>"/>
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