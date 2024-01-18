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
      <a href="#">Usuarios</a>
      <ul class="dropdownmenu">
        <li>
          <a href="../../paginas/usuarios/listar_usuarios.php">Gestion de Usuarios</a>
        </li>
      </ul>
    </li>
    <li class="list-group-item menulink">
      <a href="#">Vacantes</a>
      <ul class="dropdownmenu">
        <li>
          <a href="../../paginas/vacantes/cargar_vacante.php">Cargar una nueva vacante</a>
        </li>
        <li>
          <a href="../../paginas/vacantes/lista_vacantes.php">Gestion de Vacantes</a>
        </li>
        <li>
          <a href="../../paginas/postulaciones/lista_postulaciones.php">Ver Postulaciones</a>
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