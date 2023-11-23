<?php 

session_start();

include('../modelo/AccesosCs.php');

if (isset($_POST['buton']) && $_POST['buton'] == "login") {

    if ($_POST['user'] == "") {
        $mensaje = " <b>no ingresaste el nombre de usuario</b>";
    }
    if ($_POST['pass'] == "") {
        $mensaje = $mensaje . " <b>no ingresaste la contraseña de usuario</b>";
    }
    if (isset($mensaje) && $mensaje != "") {
        session_unset();
        session_destroy();
        header('location:../../index.php?mensaje=' . $mensaje);
    }

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $params = array(
        'user'=>$user,
        'pass'=>$pass,
    );

    $login = $accesos->login($params);

    //esto es solo mio, no pertenece a la clase
    if ($login['estado']) {
        $_SESSION['usuario']['estado'] = $login['estado'];
        $_SESSION['usuario']['id'] = $login['idusuario'];
        $_SESSION['usuario']['user'] = $login['user'];
        $_SESSION['usuario']['pass'] = $login['pass'];
        $_SESSION['usuario']['perfil'] = $login['perfil'];
    } else {
        session_unset();
        session_destroy();
        header('location:../../index.php?mensaje='.$login['mensaje']);
    }
    /** Envio al usuario a la paguina dependiendo de su perfil de usuario */
    if ($_SESSION['usuario']['perfil'] == 'guia') {
        header('location:../../Guia/GuiaInicio.php');
    } elseif ($_SESSION['usuario']['perfil'] == 'admin') {
        header('location:../../Administrador/AdministradorHome.php');
    } elseif ($_SESSION['usuario']['perfil'] == 'cliente') {
        header('location:../../Cliente/ClienteCalendario.html');
    }
} else {
    session_unset();
    session_destroy();
    header('location:../../index.php?');
}

?>