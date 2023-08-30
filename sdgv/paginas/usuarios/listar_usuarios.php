<?php
require_once "../../index.php";
include BASE_PATH . "/controladora/db/conexion.php";
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
    <link rel="stylesheet" href="../../estilos/estilos.css">
</head>

<body>
    <div class="container-fluid d-flex-row m-0">
        <?php include BASE_PATH .
            "/componentes/mapeador/mapeador_header.php"; ?>
        <div class="row d-flex d-flex-row justify-content-center pt-2">
            <h1 class="text-center p-4 pt-3 titulo">Gestion de Usuarios</h1>

            <?php
            if ($_SESSION["rol_id"] == 4) { ?>
                <h3 class="text-center p-4 pt-3 titulo">Carga de Usuarios</h3>
                <p class="text-center descripcion">Si desea cargar un nuevo usuario, por favor seleccione el boton</p>
                <form action="./carga_usuario.php" method="POST" class="d-flex flex-column iniciosesion">
                    <button type="submit" name="submitcargausuario" class="mt-4 mb-5 p-2 click boton">ALTA USUARIO</button>
                </form>
            <?php
            }
            ?>
            <table class="tablaVacantes">
                <tr class="tituloTabla">

                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>

                <?php
                $vQuery = "SELECT usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.rol_id, usuarios.id, roles.descripcion FROM usuarios
                     INNER JOIN roles ON usuarios.rol_id = roles.id";
                $vResultado = mysqli_query($link, $vQuery);
                while ($row = $vResultado->fetch_array()) { ?>
                    <tr class="datosTabla">

                        <td><?php echo $row["nombre"]; ?></td>
                        <td><?php echo $row["apellido"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["descripcion"]; ?></td>
                        <td>
                            <form action="./editar_usuario.php" method="post">
                                <input type="hidden" name="iduser" readonly value="<?php echo $row["id"]; ?>">
                                <input type="submit" class="btn btn-success exito" value="Editar" name="submiteditar">
                            </form>
                        </td>
                        <td>
                            <?php if ($_SESSION["rol_id"] == 3) {
                                if (
                                    $row["rol_id"] != 3 &&
                                    $row["rol_id"] != 4
                                ) { ?>
                                    <form action="../../controladora/usuarios/eliminar_usuario.php" method="post">
                                        <input type="hidden" name="iduser" readonly value="<?php echo $row["id"]; ?>">
                                        <input type="submit" class="btn btn-danger exito" value="Eliminar" name="submiteliminar">
                                    </form>
                                <?php } else { ?>
                                    <form method="post">
                                        <input type="submit" class="btn btn-secondary exito" disabled value="Eliminar" name="submiteliminar">
                                    </form>
                                <?php }
                            } elseif ($_SESSION["rol_id"] == 4) { ?>
                                <form action="../../controladora/usuarios/eliminar_usuario.php" method="post">
                                    <input type="hidden" name="iduser" readonly value="<?php echo $row["id"]; ?>">
                                    <input type="submit" class="btn btn-danger exito" value="Eliminar" name="submiteliminar">
                                </form>
                            <?php }
                            ?>
                        </td>
                    </tr>
                <?php }
                mysqli_close($link);
                mysqli_free_result($vResultado);
                ?>
            </table>
        </div>

        <?php include BASE_PATH . "/componentes/footer/footer.html"; ?>
    </div>
</body>

</html>