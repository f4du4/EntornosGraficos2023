<?php

$usuario = $_SESSION["email"];
?>
<nav class="row m-0 menunav d-flex-row container-fluid">
  <ul class="list-group-horizontal d-flex justify-content-around align-items-center m-0 p-2">
    <li class="list-group-item menulink">
      <a href="#"><?php echo $usuario ?></a>
      <ul class="dropdownmenu">
        <li>
          <a href="../../paginas/usuarios/perfil_usuario.php">Mi Perfil</a>
        </li>
        <li>
          <a href="../../controladora/usuarios/cerrar_sesion.php">Cerrar Sesion</a>
        </li>
      </ul>
    </li>
    <li class="list-group-item menulink">
      <a href="#">Vacantes</a>
      <ul class="dropdownmenu">
        <li>
          <a href="../../paginas/vacantes/buscar_vacantes.php">Buscar vacantes</a>
        </li>
        <li>
          <a href="../../paginas/vacantes/vacantes_abiertas.php">Mostrar vacantes abiertas</a>
        </li>
        <li>
          <a href="../../paginas/postulaciones/cliente_postulaciones.php">Mis postulaciones</a>
        </li>
        <li>
          <a href="../../paginas/vacantes/vacantes_cerradas.php">Resultados concursos</a>
        </li>
      </ul>
    </li>
    <li class="list-group-item menulink">
      <a href="#">Ayuda</a>
      <ul class="dropdownmenu">
        <li>
          <a href="../../paginas/ayuda/faqs.php">FAQs</a>
        </li>
        <li>
          <a href="../../paginas/ayuda/sobre_nosotros.php">Sobre Nosotros</a>
        </li>
      </ul>
    </li>
  </ul>
</nav>