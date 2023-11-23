<?php/*
//parametros -> servidor; usuario de base de datos; contraseña del usuario

$conexion = mysqli_connect($servidor, $usuario, $contrasenna) or
die('<b>No se pudo establecer conexion con el servidor</b>');

//parametros -> conexion; cotejamiento

mysqli_set_charset($conexion, 'utf8');

//parametros -> conexion; base de datos dentro del servidor

$bd = mysqli_select_db($conexion, $base_datos) or
die('<b>No se pudo establecer conexion con la base de datos</b>');
?>
*/?>