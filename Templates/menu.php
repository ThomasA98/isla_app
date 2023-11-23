<?php 
$menu = '
    <header>
        <nav class="bg-dark m-4 pt-2">
            <ul class="nav nav-tabs justify-content-md-center">';

switch ($_SESSION['usuario']['perfil']) {
    case 'guia':
        $menu = $menu.'
            <li class="nav-item mr-4">
                <a class="nav-link" href="GuiaInicio.php">Bienvenido '.$_SESSION['usuario']['user']. '</a>
            </li>
            <li class="nav-item mr-4"><a class="nav-link" href="GuiaHorario.php">Horario</a></li>
            <li class="nav-item mr-4"><a class="nav-link" href="GuiaRegistro.php">Registro</a></li>
            <li class="nav-item mr-4"><a class="nav-link" href="GuiaAsistenciaTour.php">Asistencia a Tour</a></li>
        ';
    break;

    case 'admin':
        $menu = $menu. '
            <li class="nav-item mr-4">
                <a class="nav-link" href="AdministradorHome.php">Bienvenido '.$_SESSION['usuario']['user']. '</a>
            </li>
            <li class="nav-item mr-4"><a class="nav-link" href="#">Designar Horario</a></li>
            <li class="nav-item mr-4"><a class="nav-link" href="#">Agendar Tour</a></li>
            <li class="nav-item mr-4"><a class="nav-link" href="AdministradorRegistro.php">Registro</a></li>
            <li class="nav-item mr-4"><a class="nav-link" href="#">Nuevo Tour</a></li>
        ';
    break;

    case 'cliente':
        $menu = $menu.'
            <li class="nav-item mr-4">
                <a class="nav-link" href="#">Bienvenido '.$_SESSION['usuario']['user'].'</a>
            </li>
            <li class="nav-item mr-4"><a class="nav-link" href="#">Inscripcion</a></li>
            <li class="nav-item mr-4"><a class="nav-link" href="#">Comentar Tour</a></li>
            <li class="nav-item mr-4"><a class="nav-link" href="#">Comentar Flora y Fauna</a></li>
        ';
    break;
}

$menu = $menu.'
                <li class="nav-item mr-4"><a class="nav-link" href="../Templates/salir.php">Cerrar sesion</a></li>
            </ul></nav></header>
        ';

echo $menu;
?>