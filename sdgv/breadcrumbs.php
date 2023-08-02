<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];

    $currentPath = parse_url($url)['path']; 

    $URL_MAP = array(
        '/sdgv/inicio.php' => array(
            array("path" => "/sdgv/inicio.php", "label" => "Inicio")
        ),
        '/sdgv/buscarvacantes.php' => array(
            array("path" => "/sdgv/inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/buscarvacantes.php", "label" => "Buscar Vacante")
        ),
        '/sdgv/muestravacantes.php' => array(
            array("path" => "/sdgv/inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/muestravacantes.php", "label" => "Mostrar vacantes abiertas")
        ),
        '/sdgv/faqs.php' => array(
            array("path" => "/sdgv/inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/faqs.php", "label" => "Ayuda")
        ),
        '/sdgv/sobrenosotros.php' => array(
            array("path" => "/sdgv/inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/sobrenosotros.php", "label" => "Sobre Nosotros")
        ),
        '/sdgv/ingreso.php' => array(
            array("path" => "/sdgv/inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/ingreso.php", "label" => "Ingresar")
        ),
        '/sdgv/registro.php' => array(
            array("path" => "/sdgv/inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/registro.php", "label" => "Registrarse")
        ),
        //CLIENTE
        '/sdgv/cliente_inicio.php' => array(
            array("path" => "/sdgv/cliente_inicio.php", "label" => "Inicio"),
        ),
        '/sdgv/perfil_usuario.php' => array(
            array("path" => "/sdgv/cliente_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/perfil_usuario.php", "label" => "Mi Perfil"),
        ),
        '/sdgv/editar_miperfil.php' => array(
            array("path" => "/sdgv/cliente_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/perfil_usuario.php", "label" => "Mi Perfil"),
            array("path" => "/sdgv/editar_miperfil.php", "label" => "Editar Perfil"),
        ),
        '/sdgv/cliente_postulaciones.php' => array(
            array("path" => "/sdgv/cliente_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/cliente_postulaciones.php", "label" => "Mis Postulaciones"),
        ),
        '/sdgv/buscarvacantes.php' => array(
            array("path" => "/sdgv/cliente_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/buscarvacantes.php", "label" => "Buscar Vacante")
        ),
        '/sdgv/vacantesabiertas.php' => array(
            array("path" => "/sdgv/cliente_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/vacantesabiertas.php", "label" => "Mostrar vacantes abiertas"),
        ),
        '/sdgv/postularse.php' => array(
            array("path" => "/sdgv/cliente_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/vacantesabiertas.php", "label" => "Mostrar vacantes abiertas"),
            array("path" => "/sdgv/postularse.php", "label" => "Postulacion a vacante"),
        ),
        '/sdgv/faqs.php' => array(
            array("path" => "/sdgv/cliente_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/faqs.php", "label" => "Ayuda")
        ),
        '/sdgv/sobrenosotros.php' => array(
            array("path" => "/sdgv/cliente_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/sobrenosotros.php", "label" => "Sobre Nosotros")
        ),
        //JEFE DE CATEDRA
        '/sdgv/jefecatedra_inicio.php' => array(
            array("path" => "/sdgv/jefecatedra_inicio.php", "label" => "Inicio"),
        ),
        '/sdgv/perfil_usuario.php' => array(
            array("path" => "/sdgv/jefecatedra_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/perfil_usuario.php", "label" => "Mi Perfil"),
        ),
        '/sdgv/editar_miperfil.php' => array(
            array("path" => "/sdgv/jefecatedra_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/perfil_usuario.php", "label" => "Mi Perfil"),
            array("path" => "/sdgv/editar_miperfil.php", "label" => "Editar Perfil"),
        ),
        '/sdgv/jefecatedra_vacantes.php' => array(
            array("path" => "/sdgv/jefecatedra_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/jefecatedra_vacantes.php", "label" => "Mis materias"),
        ),
        '/sdgv/obtener_postulaciones.php' => array(
            array("path" => "/sdgv/jefecatedra_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/jefecatedra_vacantes.php", "label" => "Mis materias"),
            array("path" => "/sdgv/obtener_postulaciones.php", "label" => "Postulaciones"),
        ),
        '/sdgv/cargar_orden_merito.php' => array(
            array("path" => "/sdgv/jefecatedra_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/cargar_orden_merito.php", "label" => "Cargar orden de merito"),
        ),
        '/sdgv/faqs.php' => array(
            array("path" => "/sdgv/jefecatedra_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/faqs.php", "label" => "Ayuda")
        ),
        '/sdgv/sobrenosotros.php' => array(
            array("path" => "/sdgv/jefecatedra_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/sobrenosotros.php", "label" => "Sobre Nosotros")
        ),
         //ADMIN
         '/sdgv/admin_inicio.php' => array(
            array("path" => "/sdgv/admin_inicio.php", "label" => "Inicio"),
        ),
        '/sdgv/perfil_usuario.php' => array(
            array("path" => "/sdgv/admin_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/perfil_usuario.php", "label" => "Mi Perfil"),
        ),
        '/sdgv/editar_miperfil.php' => array(
            array("path" => "/sdgv/admin_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/perfil_usuario.php", "label" => "Mi Perfil"),
            array("path" => "/sdgv/editar_miperfil.php", "label" => "Editar Perfil"),
        ),
        '/sdgv/listar_usuarios.php' => array(
            array("path" => "/sdgv/admin_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/listar_usuarios.php", "label" => "Gestion de Usuarios"),
        ),

        '/sdgv/editar_usuario.php' => array(
            array("path" => "/sdgv/admin_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/listar_usuarios.php", "label" => "Gestion de Usuarios"),
            array("path" => "/sdgv/editar_usuario.php", "label" => "Editar usuario"),
        ),

        '/sdgv/cargarvacante.php' => array(
            array("path" => "/sdgv/admin_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/cargarvacante.php", "label" => "Cargar nueva vacante"),
        ),
        '/sdgv/lista_vacantes.php' => array(
            array("path" => "/sdgv/admin_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/lista_vacantes.php", "label" => "Gestion de vacantes"),
        ),
        '/sdgv/lista_postulaciones.php' => array(
            array("path" => "/sdgv/admin_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/lista_postulaciones.php", "label" => "Gestion de postulaciones"),
        ),
        '/sdgv/editar_vacante.php' => array(
            array("path" => "/sdgv/admin_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/lista_vacantes.php", "label" => "Gestion de vacantes"),
            array("path" => "/sdgv/editar_vacante.php", "label" => "Editar vacante"),
        ),
        '/sdgv/obtener_usuario.php' => array(
            array("path" => "/sdgv/admin_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/lista_postulaciones.php", "label" => "Gestion de postulaciones"),
            array("path" => "/sdgv/obtener_usuario.php", "label" => "Obtener usuario"),
        ),
        '/sdgv/obtener_vacante.php' => array(
            array("path" => "/sdgv/admin_inicio.php", "label" => "Inicio"),
            array("path" => "/sdgv/lista_postulaciones.php", "label" => "Gestion de postulaciones"),
            array("path" => "/sdgv/obtener_vacante.php", "label" => "Obtener vacante"),
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
                        echo '<li class="breadcrumb-item active lead " aria-current="page">' . $row["label"] . '</li>';
                    } else {
                        echo '<li class="breadcrumb-item lead "><a href="' . $row["path"] . '">' . $row["label"] . '</a></li>';
                    }
                }
                ?>
            </ol>
        </nav>
    </div>

</body>
</html>
