<?php
        session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quienes Somos?</title>
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
        
        if($_SESSION['email'] != null && $_SESSION['email'] !='') {
            if($_SESSION['rol_id']==1){
                include "./cliente_header.html";
                include "./cliente_menu.html";
           }else if($_SESSION['rol_id']==2){
                   include "./jefecatedra_header.html";
                   include "./jefecatedra_menu.html";
           }else if($_SESSION['rol_id']==3){
                include "./admin_header.html";
                include "./admin_menu.html";
            }else if($_SESSION['rol_id']==4){
               include "./superadmin_header.html";
               include "./superadmin_menu.html";
           }
        }else {
            include "./header.html";
            include "./menu.html";
            
        }
        include "./breadcrumbs.php";
        ?>
        <div class="row d-flex-row pt-2">
            <h1 class="text-start inicio p-2 m-3">¿Quienes Somos?</h1>
            <h3 class="text-start inicio p-2  m-3">UTN FRRo</h3>
            <p class="quienessomos p-2  m-3">La Facultad Regional Rosario o FRRo es una de las facultades pertenecientes 
                a la Universidad Tecnológica Nacional o UTN de la República Argentina. Dicha regional se sitúa actualmente 
                en la calle Zeballos 1341 de la ciudad de Rosario, en la Provincia de Santa Fe y consta de 5 carreras de
                 grado: Ingeniería Mecánica, Ingeniería Civil, Ingeniería en Sistemas de Información, Ingeniería Eléctrica e Ingeniería 
                 Química y varias carreras de posgrado. <br><br>El actual edificio se comenzó a construir en el año 1965 en la gestión del primer Decano electo, el Ing. Eduardo Arbones.
                En el año 1969 se inauguró el anexo y al año siguiente la planta baja y el primer piso del edificio central, habiéndose llegado en la actualidad a un nivel de cuatro pisos y el ala sur del quinto. 
                Para 2012 se compró en la cuadra de enfrente, 10 metros en diagonal, dos ex edificios (un comercio y otro desconocido) el cual sirven para posgrado y otro anexo más, donde se dictan cátedras diversas.</p>
        </div>
        <?php
        include "./footer.html";
        ?>
    </div>
</body>
</html>