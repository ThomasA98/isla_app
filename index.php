<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eva sum 1</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fondo.css">
</head>

<body>

    <?php
    if ($_GET) {
        $mensaje = $_GET['mensaje'];
    } else {
        $mensaje = '<b>Ingresa tu usuario y contraseña</b>';
    }
    ?>


    <div class="container bg-dark text-white shadow-lg mt-5">
        <form action="recursos/controlador/login.php" method="post">

            <h2 class="text-center h2">Inicio de Sesion</h2>
            <div class="row">
                <div class="form-group col-6">
                    <label for="user">Usuario</label>
                    <input class="form-control" type="text" name="user" id="user" />
                </div>

                <div class="form-group col-6">
                    <label for="pass">Contraseña</label>
                    <input class="form-control" type="password" name="pass" id="pass" />
                </div>

                <div class="form-group col-6">
                    <button type="submit" class="btn btn-success col-2 p-2 m-2" name="buton" id="buton" value="login">Iniciar</button>
                </div>

                <div class="form-group col-6">
                    <?php if ($mensaje) {
                        echo $mensaje;
                    } ?>
                </div>

            </div>
        </form>
    </div>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php include('templates/footer.php') ?>