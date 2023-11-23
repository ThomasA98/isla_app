<?php 
//llamamos a la sesion activa
session_start();
//limpiamos la sesion activa
session_unset();
//destruir la sesion activa
session_destroy();
//redireccionar a index
header('location:../index.php');
?>