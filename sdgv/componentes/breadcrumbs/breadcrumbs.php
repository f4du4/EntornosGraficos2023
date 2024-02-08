<?php
require_once "../../index.php";
if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on") {
  $url = "https://";
} else {
  $url = "http://";
}
// Append the host(domain name, ip) to the URL.
$url .= $_SERVER["HTTP_HOST"];

// Append the requested resource location to the URL
$url .= $_SERVER["REQUEST_URI"];

$currentPath = parse_url($url)["path"];

$URL_MAP = [
  "/sdgv/paginas/inicio/inicio.php" => [
    ["path" => "../../paginas/inicio/inicio.php", "label" => "Inicio"],
  ],
  "/sdgv/paginas/vacantes/buscar_vacantes.php" => [
    ["path" => "../../paginas/inicio/inicio.php", "label" => "Inicio"],
    [
      "path" => "../../paginas/vacantes/buscar_vacantes.php",
      "label" => "Buscar Vacante",
    ],
  ],
  "/sdgv/paginas/vacantes/muestra_vacantes.php" => [
    ["path" => "../../paginas/inicio/inicio.php", "label" => "Inicio"],
    [
      "path" => "../../paginas/vacantes/muestra_vacantes.php",
      "label" => "Mostrar vacantes abiertas",
    ],
  ],
  "/sdgv/paginas/vacantes/vacantes_cerradas.php" => [
    ["path" => "../../paginas/inicio/inicio.php", "label" => "Inicio"],
    [
      "path" => "../../paginas/vacantes/vacantes_cerradas.php",
      "label" => "Resultados de concursos",
    ],
  ],
  "/sdgv/paginas/ayuda/faqs.php" => [
    ["path" => "../../paginas/inicio/inicio.php", "label" => "Inicio"],
    ["path" => "../../paginas/ayuda/faqs.php", "label" => "Ayuda"],
  ],
  "/sdgv/paginas/ayuda/sobre_nosotros.php" => [
    ["path" => "../../paginas/inicio/inicio.php", "label" => "Inicio"],
    [
      "path" => "../../paginas/ayuda/sobre_nosotros.php",
      "label" => "Sobre Nosotros",
    ],
  ],
  "/sdgv/paginas/ingreso/ingreso.php" => [
    ["path" => "../../paginas/inicio/inicio.php", "label" => "Inicio"],
    ["path" => "../../paginas/ingreso/ingreso.php", "label" => "Ingresar"],
  ],
  "/sdgv/controladora/ingreso/valida_form_ingreso.php" => [
    ["path" => "../../paginas/inicio/inicio.php", "label" => "Inicio"],
    ["path" => "../../paginas/ingreso/ingreso.php", "label" => "Ingresar"],
    [
      "path" => "../../controladora/ingreso/valida_form_ingreso.php",
      "label" => "Error en el Ingreso",
    ],
  ],
  "/sdgv/paginas/registro/registro.php" => [
    ["path" => "../../paginas/inicio/inicio.php", "label" => "Inicio"],
    [
      "path" => "../../paginas/registro/registro.php",
      "label" => "Registrarse",
    ],
  ],
  "/sdgv/paginas/registro/aprobacion_registro.php" => [
    ["path" => "../../paginas/inicio/inicio.php", "label" => "Inicio"],
    [
      "path" => "../../paginas/registro/registro.php",
      "label" => "Registrarse",
    ],
    [
      "path" => "../../paginas/registro/aprobacion_registro.php",
      "label" => "Aprobacion del registro",
    ],
  ],
  //CLIENTE
  "/sdgv/paginas/inicio/cliente_inicio.php" => [
    [
      "path" => "../../paginas/inicio/cliente_inicio.php",
      "label" => "Inicio",
    ],
  ],
  "/sdgv/paginas/usuarios/perfil_usuario.php" => [
    [
      "path" => "../../paginas/inicio/cliente_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/perfil_usuario.php",
      "label" => "Mi Perfil",
    ],
  ],
  "/sdgv/paginas/usuarios/editar_mi_perfil.php" => [
    [
      "path" => "../../paginas/inicio/cliente_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/perfil_usuario.php",
      "label" => "Mi Perfil",
    ],
    [
      "path" => "../../paginas/usuarios/editar_mi_perfil.php",
      "label" => "Editar Perfil",
    ],
  ],
  "/sdgv/paginas/usuarios/error_editar_perfil_usuario.php" => [
    [
      "path" => "../../paginas/inicio/cliente_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/perfil_usuario.php",
      "label" => "Mi Perfil",
    ],
    [
      "path" => "../../paginas/usuarios/editar_mi_perfil.php",
      "label" => "Editar Perfil",
    ],
  ],
  "/sdgv/paginas/postulaciones/cliente_postulaciones.php" => [
    [
      "path" => "../../paginas/inicio/cliente_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/postulaciones/cliente_postulaciones.php",
      "label" => "Mis Postulaciones",
    ],
  ],
  "/sdgv/paginas/vacantes/buscar_vacantes.php" => [
    [
      "path" => "../../paginas/inicio/cliente_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/buscar_vacantes.php",
      "label" => "Buscar Vacante",
    ],
  ],
  "/sdgv/paginas/vacantes/vacantes_abiertas.php" => [
    [
      "path" => "../../paginas/inicio/cliente_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/vacantes_abiertas.php",
      "label" => "Mostrar vacantes abiertas",
    ],
  ],
  "/sdgv/paginas/vacantes/vacantes_cerradas.php" => [
    [
      "path" => "../../paginas/inicio/cliente_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/vacantes_cerradas.php",
      "label" => "Resultados de concursos",
    ],
  ],
  "/sdgv/paginas/postulaciones/postularse.php" => [
    [
      "path" => "../../paginas/inicio/cliente_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/vacantes_abiertas.php",
      "label" => "Mostrar vacantes abiertas",
    ],
    [
      "path" => "../../paginas/postulaciones/postularse.php",
      "label" => "Postulacion a vacante",
    ],
  ],
  "/sdgv/paginas/ayuda/faqs.php" => [
    [
      "path" => "../../paginas/inicio/cliente_inicio.php",
      "label" => "Inicio",
    ],
    ["path" => "../../paginas/ayuda/faqs.php", "label" => "Ayuda"],
  ],
  "/sdgv/paginas/ayuda/sobre_nosotros.php" => [
    [
      "path" => "../../paginas/inicio/cliente_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/ayuda/sobre_nosotros.php",
      "label" => "Sobre Nosotros",
    ],
  ],
  //JEFE DE CATEDRA
  "/sdgv/paginas/inicio/jefecatedra_inicio.php" => [
    [
      "path" => "../../paginas/inicio/jefecatedra_inicio.php",
      "label" => "Inicio",
    ],
  ],
  "/sdgv/paginas/usuarios/perfil_usuario.php" => [
    [
      "path" => "../../paginas/inicio/jefecatedra_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/perfil_usuario.php",
      "label" => "Mi Perfil",
    ],
  ],
  "/sdgv/paginas/usuarios/editar_mi_perfil.php" => [
    [
      "path" => "../../paginas/inicio/jefecatedra_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/perfil_usuario.php",
      "label" => "Mi Perfil",
    ],
    [
      "path" => "../../paginas/usuarios/editar_mi_perfil.php",
      "label" => "Editar Perfil",
    ],
  ],
  "/sdgv/paginas/usuarios/error_editar_perfil_usuario.php" => [
    [
      "path" => "../../paginas/inicio/jefecatedra_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/perfil_usuario.php",
      "label" => "Mi Perfil",
    ],
    [
      "path" => "../../paginas/usuarios/editar_mi_perfil.php",
      "label" => "Editar Perfil",
    ],
  ],
  "/sdgv/paginas/vacantes/jefecatedra_vacantes.php" => [
    [
      "path" => "../../paginas/inicio/jefecatedra_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/jefecatedra_vacantes.php",
      "label" => "Mis materias",
    ],
  ],
  "/sdgv/paginas/vacantes/jefecatedra_notifica_ganador.php" => [
    [
      "path" => "../../paginas/inicio/jefecatedra_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/jefecatedra_notifica_ganador.php",
      "label" => "Notificacion ganador vacante",
    ],
  ],
  "/sdgv/paginas/postulaciones/obtener_postulaciones.php" => [
    [
      "path" => "../../paginas/inicio/jefecatedra_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/jefecatedra_vacantes.php",
      "label" => "Mis materias",
    ],
    [
      "path" => "../../paginas/postulaciones/obtener_postulaciones.php",
      "label" => "Postulaciones",
    ],
  ],
  "/sdgv/paginas/postulaciones/carga_puntaje_postu.php" => [
    [
      "path" => "../../paginas/inicio/jefecatedra_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/jefecatedra_vacantes.php",
      "label" => "Mis materias",
    ],
    [
      "path" => "../../paginas/postulaciones/obtener_postulaciones.php",
      "label" => "Postulaciones",
    ],
    [
      "path" => "../../paginas/postulaciones/carga_puntaje_postu.php",
      "label" => "Cargar Puntaje",
    ],
  ],
  "/sdgv/paginas/postulaciones/enviar_mail_postu.php" => [
    [
      "path" => "../../paginas/inicio/jefecatedra_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/jefecatedra_vacantes.php",
      "label" => "Mis materias",
    ],
    [
      "path" => "../../paginas/postulaciones/obtener_postulaciones.php",
      "label" => "Postulaciones",
    ],
    [
      "path" => "../../paginas/postulaciones/enviar_mail_postu.php",
      "label" => "Notificacion a ganador",
    ],
  ],
  "/sdgv/paginas/vacantes/cargar_orden_merito.php" => [
    [
      "path" => "../../paginas/inicio/jefecatedra_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/cargar_orden_merito.php",
      "label" => "Cargar orden de merito",
    ],
  ],
  "/sdgv/paginas/ayuda/faqs.php" => [
    [
      "path" => "../../paginas/inicio/jefecatedra_inicio.php",
      "label" => "Inicio",
    ],
    ["path" => "../../paginas/ayuda/faqs.php", "label" => "Ayuda"],
  ],
  "/sdgv/paginas/ayuda/sobre_nosotros.php" => [
    [
      "path" => "../../paginas/inicio/jefecatedra_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/ayuda/sobre_nosotros.php",
      "label" => "Sobre Nosotros",
    ],
  ],
  //ADMIN
  "/sdgv/paginas/inicio/admin_inicio.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
  ],
  "/sdgv/paginas/usuarios/perfil_usuario.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/perfil_usuario.php",
      "label" => "Mi Perfil",
    ],
  ],
  "/sdgv/paginas/usuarios/editar_mi_perfil.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/perfil_usuario.php",
      "label" => "Mi Perfil",
    ],
    [
      "path" => "../../paginas/usuarios/editar_mi_perfil.php",
      "label" => "Editar Perfil",
    ],
  ],
  "/sdgv/paginas/usuarios/error_editar_perfil_usuario.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/perfil_usuario.php",
      "label" => "Mi Perfil",
    ],
    [
      "path" => "../../paginas/usuarios/editar_mi_perfil.php",
      "label" => "Editar Perfil",
    ],
  ],
  "/sdgv/paginas/usuarios/listar_usuarios.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/listar_usuarios.php",
      "label" => "Gestion de Usuarios",
    ],
  ],

  "/sdgv/paginas/usuarios/carga_usuario.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/listar_usuarios.php",
      "label" => "Gestion de Usuarios",
    ],
    [
      "path" => "../../paginas/usuarios/carga_usuario.php",
      "label" => "Alta de Usuario",
    ],
  ],

  "/sdgv/paginas/usuarios/editar_usuario.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/listar_usuarios.php",
      "label" => "Gestion de Usuarios",
    ],
    [
      "path" => "../../paginas/usuarios/editar_usuario.php",
      "label" => "Editar usuario",
    ],
  ],

  "/sdgv/paginas/usuarios/aprobacion_eliminar_usuario.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/usuarios/listar_usuarios.php",
      "label" => "Gestion de Usuarios",
    ],
    [
      "path" => "../../paginas/usuarios/aprobacion_eliminar_usuario.php",
      "label" => "Baja de Usuario",
    ],
  ],
  "/sdgv/paginas/vacantes/cargar_vacante.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/cargar_vacante.php",
      "label" => "Cargar nueva vacante",
    ],
  ],
  "/sdgv/paginas/vacantes/lista_vacantes.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/lista_vacantes.php",
      "label" => "Gestion de vacantes",
    ],
  ],
  "/sdgv/paginas/postulaciones/lista_postulaciones.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/postulaciones/lista_postulaciones.php",
      "label" => "Gestion de postulaciones",
    ],
  ],
  "/sdgv/paginas/vacantes/editar_vacante.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/lista_vacantes.php",
      "label" => "Gestion de vacantes",
    ],
    [
      "path" => "../../paginas/vacantes/editar_vacante.php",
      "label" => "Editar vacante",
    ],
  ],
  "/sdgv/paginas/vacantes/aprobacion_eliminar_vacante.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/vacantes/lista_vacantes.php",
      "label" => "Gestion de Usuarios",
    ],
    [
      "path" => "../../paginas/vacantes/aprobacion_eliminar_vacante.php",
      "label" => "Baja de Vacante",
    ],
  ],
  "/sdgv/paginas/usuarios/obtener_usuario.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/postulaciones/lista_postulaciones.php",
      "label" => "Gestion de postulaciones",
    ],
    [
      "path" => "../../paginas/usuarios/obtener_usuario.php",
      "label" => "Obtener usuario",
    ],
  ],
  "/sdgv/paginas/vacantes/obtener_vacante.php" => [
    [
      "path" => "../../paginas/inicio/admin_inicio.php",
      "label" => "Inicio",
    ],
    [
      "path" => "../../paginas/postulaciones/lista_postulaciones.php",
      "label" => "Gestion de postulaciones",
    ],
    [
      "path" => "../../paginas/vacantes/obtener_vacante.php",
      "label" => "Obtener vacante",
    ],
  ],
];

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
          echo '<li class="breadcrumb-item active" aria-current="page">' .
            $row["label"] .
            "</li>";
        } else {
          echo '<li class="breadcrumb-item"><a href="' .
            $row["path"] .
            '">' .
            $row["label"] .
            "</a></li>";
        }
      }
      ?>
    </ol>
  </nav>
</div>