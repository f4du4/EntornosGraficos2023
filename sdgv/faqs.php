<?php
         session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs</title>
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
         
         if($_SESSION['email'] != null && $_SESSION['email'] != ''){
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
        <div class="row d-flex-row justify-content-center pt-2">
            <h2 class="text-center p-4 pt-3 titulo">FAQs</h2>
            <p class="introfaqs p-3">En esta seccion se presentan las 
                respuestas a algunas preguntas frecuentes que pueden tener quienes desean postularse a 
                una/s vacante/s:</p>
            <p class="questionfaqs px-5">1. ¿Puedo visualizar todas las vacantes de la Universidad Tecnológica Nacional 
                FRRo sin necesidad de crearme un usuario en el sistema de gestion de vacantes?</p>
            <p class="answerfaqs fw-normal px-5">Si, es posible, podras visualizar las vacantes abiertas, cuando son sus 
                fechas limites de postulación, cual es el puesto que se busca, e incluso el orden de merito.</p>
            <p class="questionfaqs px-5">2. ¿Puedo postularme a una vacante de la Universidad Tecnológica 
                Nacional FRRo sin estar registrado en el sistema de gestion de vacantes, es decir sin tener un usuario?</p>
            <p class="answerfaqs fw-normal px-5">No es posible, para ello necesitas registrarte en el sistema.</p>
            <p class="questionfaqs px-5">3. ¿Qué requisitos debo cumplir para postularme?</p>
            <p class="answerfaqs fw-normal px-5">Los requisitos y aptitudes requeridas para la vacante están definidos
                en el orden de merito de cada vacante, por lo que no todas las vacantes tienen el mismo tipo ni la misma
                cantidad de requisitos.</p>
            <p class="questionfaqs px-5">4. ¿Qué pasos debo realizar en el sitio para postularme a una vacante?</p>
            <p class="answerfaqs fw-normal px-5">En primer lugar, usted puede observar las vacantes abiertas o buscar alguna
                vacante de una materia en particular en las opciones que tiene en la seccion "Vacantes", y alli le apareceran
                dos opciones una es "Mostrar vacantes abiertas" y otra de "Buscar vacante". <br>Si encontró alguna vacante 
                a la cual le interesa postularse, debe registrarse en el sistema en la seccion "Registrarse", y luego
                de haberse logueado podrá ingresar al sistema. Una vez que inició su sesión en el sistema, elige nuevamente
                la opcion del menu principal "Vacantes" y de las opciones que ésta despliega, elige "Mostrar Vacantes abiertas",
                que una vez que usted ya se logueó, le aparece una nueva columna en la tabla que le permite postularse 
                a cualquiera de las vacantes que alli se muestran. Presiona el boton "Postular" en aquella vacante que 
                le interesa postularse, y luego le mostrara algunos de sus datos y algunos datos de la vacante para que pueda corroborar
                que son correctos antes de enviar la postulación, y además, <strong>debe cargar su CV en formato pdf </strong>
                para que luego el jefe de catedra a cargo de su postulacion pueda visualizarlo y elegir al postulante
                que más se adecúa al puesto requerido.</p>
            <p class="questionfaqs px-5">5. ¿Cómo puedo saber si mi postulacion fue aprobada o no?</p>
            <p class="answerfaqs fw-normal px-5">Usted conocerá todo el tiempo el estado de su vacante siempre que esté logueado, a traves de 
                la sección "Mis Postulaciones" que se encuentra dentro de la opción "Vacantes" del menú. En dicha sección usted podra ver 
                todas las postulaciones que ha realizado, y cada una tiene su propio estado: <br>
                - "En espera" indica que la vacante aun sigue abierta. <br>
                - "Finalizada" indica que la vacante ya está cerrada, y comienza en proceso de selección. <br>
                - "Aceptada" indica que fue seleccionado para cubrir la vacante. <br>
                - "Rechazada" indica que no fue seleccionado para cubrir la vacante. <br>
            </p>
            <p class="questionfaqs px-5">6. ¿Puedo modificar mis datos? Por ejemplo, si cambio de email, o la contraseña, u otro.</p>
            <p class="answerfaqs fw-normal px-5">Si, una vez logueado, en cualquier momento puede cambiar sus datos personales 
                lo puede hacer a traves de la seccion "Mi Perfil" que se encuentra dentro de la opción "Perfil" del menú. <br></p>
            <p class="questionfaqs px-5">7. Si aun tengo dudas en como utilizar el sistema, ¿puedo comunicarlas de alguna manera?</p>
            <p class="answerfaqs fw-normal px-5">Si, en cualquier momento que tengas alguna duda, comentario, u oportunidad de mejora para hacernos, podes
                 dejarla expresa en la seccion "Sobre Nosotros", que esta dentro de la seccion de "Ayuda". Alli podras completar un formulario en el que 
                 solo necesitas dejar tu nombre, tu email para que nos contactemos con vos para responder tu comentario, y tu comentario. Apenas envies tu comentario, lo recibiremos 
                 y responderemos apenas sea posible. <br></p>
        </div>
        <?php
        include "./footer.html";
        ?>
    </div>
</body>
</html>