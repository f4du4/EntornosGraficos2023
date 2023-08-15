<?php
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];

$currentPath = parse_url($url)['path'];

$URL_MAP = array(
    '/inicio.php' => array(
        array("path" => "/inicio.php", "label" => "Inicio")
    ),
    '/buscarvacantes.php' => array(
        array("path" => "/inicio.php", "label" => "Inicio"),
        array("path" => "/buscarvacantes.php", "label" => "Buscar Vacante")
    ),
    '/muestravacantes.php' => array(
        array("path" => "/inicio.php", "label" => "Inicio"),
        array("path" => "/muestravacantes.php", "label" => "Mostrar vacantes abiertas")
    ),
    '/vacantes_cerradas.php' => array(
        array("path" => "/inicio.php", "label" => "Inicio"),
        array("path" => "/vacantes_cerradas.php", "label" => "Resultados de concursos")
    ),
    '/faqs.php' => array(
        array("path" => "/inicio.php", "label" => "Inicio"),
        array("path" => "/faqs.php", "label" => "Ayuda")
    ),
    '/sobrenosotros.php' => array(
        array("path" => "/inicio.php", "label" => "Inicio"),
        array("path" => "/sobrenosotros.php", "label" => "Sobre Nosotros")
    ),
    '/ingreso.php' => array(
        array("path" => "/inicio.php", "label" => "Inicio"),
        array("path" => "/ingreso.php", "label" => "Ingresar")
    ),
    '/validaFormIngreso.php' => array(
        array("path" => "/inicio.php", "label" => "Inicio"),
        array("path" => "/ingreso.php", "label" => "Ingresar"),
        array("path" => "/validaFormIngreso.php", "label" => "Error en el Ingreso")
    ),
    '/registro.php' => array(
        array("path" => "/inicio.php", "label" => "Inicio"),
        array("path" => "/registro.php", "label" => "Registrarse")
    ),
    '/aprobacion_registro.php' => array(
        array("path" => "/inicio.php", "label" => "Inicio"),
        array("path" => "/registro.php", "label" => "Registrarse"),
        array("path" => "/aprobacion_registro.php", "label" => "Aprobacion del registro"),
    ),
    //CLIENTE
    '/cliente_inicio.php' => array(
        array("path" => "/cliente_inicio.php", "label" => "Inicio"),
    ),
    '/perfil_usuario.php' => array(
        array("path" => "/cliente_inicio.php", "label" => "Inicio"),
        array("path" => "/perfil_usuario.php", "label" => "Mi Perfil"),
    ),
    '/editar_miperfil.php' => array(
        array("path" => "/cliente_inicio.php", "label" => "Inicio"),
        array("path" => "/perfil_usuario.php", "label" => "Mi Perfil"),
        array("path" => "/editar_miperfil.php", "label" => "Editar Perfil"),
    ),
    '/cliente_postulaciones.php' => array(
        array("path" => "/cliente_inicio.php", "label" => "Inicio"),
        array("path" => "/cliente_postulaciones.php", "label" => "Mis Postulaciones"),
    ),
    '/buscarvacantes.php' => array(
        array("path" => "/cliente_inicio.php", "label" => "Inicio"),
        array("path" => "/buscarvacantes.php", "label" => "Buscar Vacante")
    ),
    '/vacantesabiertas.php' => array(
        array("path" => "/cliente_inicio.php", "label" => "Inicio"),
        array("path" => "/vacantesabiertas.php", "label" => "Mostrar vacantes abiertas"),
    ),
    '/vacantes_cerradas.php' => array(
        array("path" => "/cliente_inicio.php", "label" => "Inicio"),
        array("path" => "/vacantes_cerradas.php", "label" => "Resultados de concursos")
    ),
    '/postularse.php' => array(
        array("path" => "/cliente_inicio.php", "label" => "Inicio"),
        array("path" => "/vacantesabiertas.php", "label" => "Mostrar vacantes abiertas"),
        array("path" => "/postularse.php", "label" => "Postulacion a vacante"),
    ),
    '/faqs.php' => array(
        array("path" => "/cliente_inicio.php", "label" => "Inicio"),
        array("path" => "/faqs.php", "label" => "Ayuda")
    ),
    '/sobrenosotros.php' => array(
        array("path" => "/cliente_inicio.php", "label" => "Inicio"),
        array("path" => "/sobrenosotros.php", "label" => "Sobre Nosotros")
    ),
    //JEFE DE CATEDRA
    '/jefecatedra_inicio.php' => array(
        array("path" => "/jefecatedra_inicio.php", "label" => "Inicio"),
    ),
    '/perfil_usuario.php' => array(
        array("path" => "/jefecatedra_inicio.php", "label" => "Inicio"),
        array("path" => "/perfil_usuario.php", "label" => "Mi Perfil"),
    ),
    '/editar_miperfil.php' => array(
        array("path" => "/jefecatedra_inicio.php", "label" => "Inicio"),
        array("path" => "/perfil_usuario.php", "label" => "Mi Perfil"),
        array("path" => "/editar_miperfil.php", "label" => "Editar Perfil"),
    ),
    '/jefecatedra_vacantes.php' => array(
        array("path" => "/jefecatedra_inicio.php", "label" => "Inicio"),
        array("path" => "/jefecatedra_vacantes.php", "label" => "Mis materias"),
    ),
    '/obtener_postulaciones.php' => array(
        array("path" => "/jefecatedra_inicio.php", "label" => "Inicio"),
        array("path" => "/jefecatedra_vacantes.php", "label" => "Mis materias"),
        array("path" => "/obtener_postulaciones.php", "label" => "Postulaciones"),
    ),
    '/carga_puntaje_postu.php' => array(
        array("path" => "/jefecatedra_inicio.php", "label" => "Inicio"),
        array("path" => "/jefecatedra_vacantes.php", "label" => "Mis materias"),
        array("path" => "/obtener_postulaciones.php", "label" => "Postulaciones"),
        array("path" => "/carga_puntaje_postu.php", "label" => "Cargar Puntaje"),
    ),
    '/enviar_mail_postu.php' => array(
        array("path" => "/jefecatedra_inicio.php", "label" => "Inicio"),
        array("path" => "/jefecatedra_vacantes.php", "label" => "Mis materias"),
        array("path" => "/obtener_postulaciones.php", "label" => "Postulaciones"),
        array("path" => "/enviar_mail_postu.php", "label" => "Notificacion a ganador"),
    ),
    '/cargar_orden_merito.php' => array(
        array("path" => "/jefecatedra_inicio.php", "label" => "Inicio"),
        array("path" => "/cargar_orden_merito.php", "label" => "Cargar orden de merito"),
    ),
    '/faqs.php' => array(
        array("path" => "/jefecatedra_inicio.php", "label" => "Inicio"),
        array("path" => "/faqs.php", "label" => "Ayuda")
    ),
    '/sobrenosotros.php' => array(
        array("path" => "/jefecatedra_inicio.php", "label" => "Inicio"),
        array("path" => "/sobrenosotros.php", "label" => "Sobre Nosotros")
    ),
    //ADMIN
    '/admin_inicio.php' => array(
        array("path" => "/admin_inicio.php", "label" => "Inicio"),
    ),
    '/perfil_usuario.php' => array(
        array("path" => "/admin_inicio.php", "label" => "Inicio"),
        array("path" => "/perfil_usuario.php", "label" => "Mi Perfil"),
    ),
    '/editar_miperfil.php' => array(
        array("path" => "/admin_inicio.php", "label" => "Inicio"),
        array("path" => "/perfil_usuario.php", "label" => "Mi Perfil"),
        array("path" => "/editar_miperfil.php", "label" => "Editar Perfil"),
    ),
    '/listar_usuarios.php' => array(
        array("path" => "/admin_inicio.php", "label" => "Inicio"),
        array("path" => "/listar_usuarios.php", "label" => "Gestion de Usuarios"),
    ),

    '/editar_usuario.php' => array(
        array("path" => "/admin_inicio.php", "label" => "Inicio"),
        array("path" => "/listar_usuarios.php", "label" => "Gestion de Usuarios"),
        array("path" => "/editar_usuario.php", "label" => "Editar usuario"),
    ),

    '/cargarvacante.php' => array(
        array("path" => "/admin_inicio.php", "label" => "Inicio"),
        array("path" => "/cargarvacante.php", "label" => "Cargar nueva vacante"),
    ),
    '/lista_vacantes.php' => array(
        array("path" => "/admin_inicio.php", "label" => "Inicio"),
        array("path" => "/lista_vacantes.php", "label" => "Gestion de vacantes"),
    ),
    '/lista_postulaciones.php' => array(
        array("path" => "/admin_inicio.php", "label" => "Inicio"),
        array("path" => "/lista_postulaciones.php", "label" => "Gestion de postulaciones"),
    ),
    '/editar_vacante.php' => array(
        array("path" => "/admin_inicio.php", "label" => "Inicio"),
        array("path" => "/lista_vacantes.php", "label" => "Gestion de vacantes"),
        array("path" => "/editar_vacante.php", "label" => "Editar vacante"),
    ),
    '/obtener_usuario.php' => array(
        array("path" => "/admin_inicio.php", "label" => "Inicio"),
        array("path" => "/lista_postulaciones.php", "label" => "Gestion de postulaciones"),
        array("path" => "/obtener_usuario.php", "label" => "Obtener usuario"),
    ),
    '/obtener_vacante.php' => array(
        array("path" => "/admin_inicio.php", "label" => "Inicio"),
        array("path" => "/lista_postulaciones.php", "label" => "Gestion de postulaciones"),
        array("path" => "/obtener_vacante.php", "label" => "Obtener vacante"),
    ),
);

$linkData = $URL_MAP[$currentPath];
?>
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php
            $numItems = count($linkData);
            $i = 0;
            foreach ($linkData as $row) {
                $i++;
                if ($i === $numItems) {
                    echo '<li class="breadcrumb-item active" aria-current="page">' . $row["label"] . '</li>';
                } else {
                    echo '<li class="breadcrumb-item"><a href="' . $row["path"] . '">' . $row["label"] . '</a></li>';
                }
            }
            ?>
        </ol>
    </nav>
</div>