<?php
include "conexion.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./estilos.css">
</head>
<body>
    <div class="container-fluid d-flex-row m-0">
        <?php
        include "./admin_header.html";
        include "./admin_menu.html";
        include "./breadcrumbs.php";
        ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h1 class="text-center p-4 pt-3 titulo">Gestion de Usuarios</h2>
            <table class="tablaVacantes">
                    <tr class="tituloTabla">
                    
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <!--<th>Contraseña</th> -->
                    <th>Rol</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    </tr>
                    
                    <?php 
                    $vQuery = "SELECT usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.rol_id, roles.descripcion FROM usuarios
                     INNER JOIN roles ON usuarios.rol_id = roles.id";
                    $vResultado = mysqli_query($link,$vQuery);
                    while($row = $vResultado->fetch_array()){
                    ?>
                    <tr class="datosTabla">
                        
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['apellido'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <!--al final no muestro contra-->
                        <td><?php echo $row['descripcion'] ?></td>
                        <td>
                            <form action="editar_usuario.php" method="post">
                                <input type="hidden" name="iduser" readonly value="<?php echo $row['id'] ?>">
                                <input type="submit" class="btn btn-success exito" value= "Editar" name="submiteditar">
                            </form>
                        </td>
                        <td>
                            <?php
                            if($_SESSION['rol_id']==3){  //usuario admin no puede eliminar a otros admin
                                if($row['rol_id']!=3 && $row['rol_id']!=4){
                                ?>
                                <form action="eliminar_usuario.php" method="post">
                                    <input type="hidden" name="iduser" readonly value="<?php echo $row['id'] ?>">
                                    <input type="submit" class="btn btn-danger exito" value= "Eliminar" name="submiteliminar">
                                </form>
                                <?php
                                }else{
                                    ?>
                                    <form method="post">
                                        <input type="submit" class="btn btn-secondary exito" disabled value= "Eliminar" name="submiteliminar">
                                    </form>
                                    <?php
                                }
                            }else if($_SESSION['rol_id']==4){ //usuario superadmin si puede eliminar a los admin
                                ?>
                                <form action="eliminar_usuario.php" method="post">
                                    <input type="hidden" name="iduser" readonly value="<?php echo $row['id'] ?>">
                                    <input type="submit" class="btn btn-danger exito" value= "Eliminar" name="submiteliminar">
                                </form>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
            </table>
        </div>

        <?php
        include "./footer.html";
        ?>
    </div>
</body>
</html>