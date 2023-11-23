<?php 

include('../modelo/RegistroCs.php');

session_start();

$mensaje = "?mensaje=";

switch ($_POST['btn_registro']) {

    case 'ingreso':
        if (!$_POST['nombre']) {
            $mensaje = $mensaje . ' debes darle un nombre al item';
        }
        if (!$_POST['descripcion']) {
            $mensaje = $mensaje . ' agrega una descripcion';
        }
        if (!$_POST['tipo']) {
            $mensaje = $mensaje . ' selecciona un tipo';
        }
        if (!$_FILES['imagen']) {
            $mensaje = $mensaje.' agrega una imagen';
        }
        if ($mensaje == "?mensaje=") {
            $_SESSION['item'] = $registro->ingreso($_POST, $_FILES['imagen']);
        }
        if ($_SESSION['usuario']['perfil'] == 'guia') {
            header('location:../../Guia/GuiaRegistro.php'.$mensaje);
        } elseif ($_SESSION['usuario']['perfil'] == 'admin') {
            header('location:../../Administrador/AdministradorRegistro.php'.$mensaje);
        }
        break;

    case 'modificar':
        if (!$_POST['id']) {
            $mensaje = $mensaje . ' no hay un id existente';
        }
        if (!$_POST['tipo']) {
            $mensaje = $mensaje . ' selecciona un tipo';
        }
        if ($mensaje == "?mensaje=") {
            if ( empty($_FILES['imagen']) || $_FILES['imagen']['name'] == "" ){
                $_SESSION['item'] = $registro->modifico_sin_imagen($_POST);
            } else {
                $_SESSION['item'] = $registro->modifico_con_imagen($_POST, $_FILES['imagen']);
            }
        }
        if ($_SESSION['usuario']['perfil'] == 'guia') {
            header('location:../../Guia/GuiaRegistro.php'.$mensaje);
        } elseif ($_SESSION['usuario']['perfil'] == 'admin') {
            header('location:../../Administrador/AdministradorRegistro.php'.$mensaje);
        }
        break;

    case 'buscar':
        if (!$_POST['nombre']) {
            $mensaje = $mensaje . ' debes darle un nombre al item';
        }
        if (!$_POST['tipo']) {
            $mensaje = $mensaje . ' selecciona un tipo';
        }
        if ($mensaje == "?mensaje=") {
            $_SESSION['item'] = $registro->busco_nombre($_POST);
        }
        if ($_SESSION['usuario']['perfil'] == 'guia') {
            header('location:../../Guia/GuiaRegistro.php'.$mensaje);
        } elseif ($_SESSION['usuario']['perfil'] == 'admin') {
            header('location:../../Administrador/AdministradorRegistro.php'.$mensaje);
        }
        break;

    case 'eliminar':
        if (!$_POST['id']) {
            $mensaje = $mensaje . ' no hay un id existente';
        }
        if (!$_POST['tipo']) {
            $mensaje = $mensaje . ' selecciona un tipo';
        }
        if ($mensaje == "?mensaje=") {
            $_SESSION['item'] = $registro->elimino($_POST);
        }
        if ($_SESSION['usuario']['perfil'] == 'guia') {
            header('location:../../Guia/GuiaRegistro.php'.$mensaje);
        } elseif ($_SESSION['usuario']['perfil'] == 'admin') {
            header('location:../../Administrador/AdministradorRegistro.php'.$mensaje);
        }
        break;

    default:
        if (isset($_GET['home'])) {
            //carga informacion aleatoria al home
            $_SESSION['home'] = $registro->home($_GET['tipo']);
            header('location:../../Guia/GuiaInicio.php');
            if ($_SESSION['usuario']['perfil'] == 'guia') {
                header('location:../../Guia/GuiaInicio.php' . $mensaje);
            } elseif ($_SESSION['usuario']['perfil'] == 'admin') {
                header('location:../../Administrador/AdministradorHome.php' . $mensaje);
            }
        } else {
            //carga informacion aleatoria al home
            $_SESSION['home'] = $registro->home($_GET['tipo']);
            header('location:../../Guia/GuiaInicio.php');
            if ($_SESSION['usuario']['perfil'] == 'guia') {
                header('location:../../Guia/GuiaInicio.php' . $mensaje);
            } elseif ($_SESSION['usuario']['perfil'] == 'admin') {
                header('location:../../Administrador/AdministradorHome.php' . $mensaje);
            }
        }
}
?>