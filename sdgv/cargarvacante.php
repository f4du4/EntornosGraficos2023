<?php
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Vacante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./estilos.css">
    <script>

        function validaSoloLetras(target) {
            console.log({target})
            var regEx = /^[A-Z a-z]+$/;
            if(target.value.match(regEx)) {
                if(!!target.nextElementSibling) {
                    target.nextElementSibling.classList.add("hidden");
                    target.nextElementSibling.classList.remove("shown");
                }
                return true;
            }
            else {
                if(!!target.nextElementSibling) {
                    target.nextElementSibling.classList.remove("hidden");
                    target.nextElementSibling.classList.add("shown");
                }
                return false;
            }
        }   
    </script>
</head>
<body>
    <div class="container-fluid d-flex-row m-0">
        
        <?php
        include "./admin_header.html";
        include "./admin_menu.html";
        include "./breadcrumbs.php";
        $vQuery = "SELECT * FROM materias";
        $vResult = mysqli_query($link,$vQuery);
        ?>
        <div class="row d-flex-row justify-content-center pt-2">
            <h2 class="text-center p-4 pt-5 titulo">Cargar vacante</h2>
            <p class="text-center descripcion">Completa los siguientes datos</p>
            <form method="POST" class="d-flex flex-column iniciosesion">
                <div class="d-flex justify-content-between formdiv m-2">
                    <label class="formlabel" for="">Puesto vacante:</label>
                    <div class="containerError">
                        <input class="px-3" type="text" name="Nom" placeholder="Ej: Profesor" required onchange="validaSoloLetras(this)"/>
                        <div class="error hidden">Puesto de vacante invalido: solo ingresar letras</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between formdiv m-2">
                    <label class="formlabel" for="">Descripcion de la vacante:</label>
                    <input class="px-3" type="text" name="Desc" placeholder="Ej: Profesor suplente turno noche"/>   
                </div>
                <div class="d-flex justify-content-between formdiv m-2">
                    <label class="formlabel" for="">Fecha de Inicio:</label>
                    <input class="px-3" type="datetime" name="Ini" placeholder="YYYY-MM-DD HH:MM:SS" required/>
                </div>
                <div class="d-flex justify-content-between formdiv m-2 position-relative">
                    <label class="formlabel" for="">Fecha de Cierre:</label>
                    <input class="px-3" type="datetime" name="Fin" placeholder="YYYY-MM-DD HH:MM:SS" required>
                </div>
                <div class="d-flex justify-content-between formdiv m-2">
                    <label class="formlabel" for="">Materia:</label>
                    <select class="form-control px-3 ms-3" id="selectItem" name="Mat">
                            <?php 
                                while($row = mysqli_fetch_array($vResult)) {
                            ?>
                                <option
                                    value="<?php echo $row['id']; ?>">
                                    <?php echo $row['nombreMat']; ?>
                                </option>
                                <?php } ?>
                        </select>
                </div>
                <button type="submit" name="submit" class="mt-3 mb-3 p-2 click boton">CARGAR</button>
            </form>
            <?php 
                
                if(isset($_POST["submit"])) { 
                    $vPuesto = $_POST['Nom'];
                    $vDesc = $_POST['Desc'];
                    $vFechaIni = $_POST['Ini'];
                    $vFechaFin = $_POST['Fin'];
                    $vMateria = $_POST['Mat'];
                    $expresionReg = "/^[A-Z a-z]+$/";
                    if(preg_match($expresionReg,$vPuesto) == 0){
                        ?>
                        <h2 class="errorBackend">El puesto ingresado es invalido: solo letras</h2>
                        <?php
                    }else{
                        $addVacanteQuery="INSERT INTO vacantes (nombre, descripcion, fechaIni, fechaFin, materia) VALUES ('$vPuesto','$vDesc', '$vFechaIni', '$vFechaFin', '$vMateria')";
                        mysqli_query($link, $addVacanteQuery) or die (mysqli_error($link));
                        ?>
                        <h2 class="correctoBackend">¡Vacante cargada Exitosamente!</h2>
                        <?php
                    }
                }

            ?>
        </div>
        <?php
        include "./footer.html";
        ?>
    </div>
</body>
</html>