<?php
session_start();
include('../Templates/header.php');
include('../Templates/menu.php');

$mensaje = "";

if (isset($_SESSION['item']) && isset($_SESSION['item']['estado'])) {
    if ($_SESSION['item']['estado'] == true) {
        $id = $_SESSION['item']['id'];
        $nombre = $_SESSION['item']['nombre'];
        $descripcion = $_SESSION['item']['descripcion'];
        $tipo = "<option selected>" . $_SESSION['item']['tipo'] . "</option>";
        if ($_SESSION['item']['imagen'] == "") {
            $imagen = "";
        } else {
            $imagen = $_SESSION['item']['imagen'];
        }
        $_SESSION['item'] = null;
    } else {
        $mensaje = $_SESSION['item']['mensaje'];
        $id = "";
        $nombre = "";
        $descripcion = "";
        $tipo = "<option selected value='' >Seleccione el tipo de item a registrar</option>";
        $imagen = "";
    }
} else {
    $id = "";
    $nombre = "";
    $descripcion = "";
    $tipo = "<option selected value='' >Seleccione el tipo de item a registrar</option>";
    $imagen = "";
}

if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
}
?>

<form action="../recursos/controlador/registro.php" method="post" enctype="multipart/form-data">
    <h2 class="text-center text-white">Registro de Flora, Fauna y Lugar</h2>

    <div class="container bg-dark text-white shadow-lg">

        <div class="row p-3">

            <div class="col-12 mb-4">
                <div class="row justify-content-md-center">
                    <div class="form-group col-4">
                        <label for="id">ID</label>
                        <input disabled class="form-control text-muted" type="text" value="<?php echo $id; ?>" />
                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="tipo">Tipo</label>
                        <select class="custom-select" name="tipo" id="tipo">
                            <?php echo $tipo; ?>
                            <option value="fauna">Fauna</option>
                            <option value="flora">Flora</option>
                            <option value="lugar">Lugar</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="nombre">Nombre</label>
                        <input class="form-control" type="text" value="<?php echo $nombre; ?>" name="nombre" id="nombre" placeholder="ingrese nombre" />
                    </div>
                    <div class="form-group col-12">
                        <label for="imagen">Imagen</label>
                        <input class="form-control" type="file" name="imagen" id="imagen" placeholder="agrege una imagen" />
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="descripcion">Descripcion</label>
                        <input class="form-control" type="text" value="<?php echo $descripcion; ?>" name="descripcion" id="descripcion" placeholder="agrege una descripcion" />
                    </div>
                </div>
            </div>

            <?php if (isset($imagen) && $imagen != "") { ?>
                <div class="col-6">
                    <div class="row justify-content-md-center">
                        <div class="form-group col-12">
                            <label>Imagen</label>
                            <img class="card-img" src="../imagenes_db/<?php echo $imagen; ?>" />
                        </div>
                    </div>
                </div><?php } ?>

            <div class="col-12 mt-2">
                <div class="row justify-content-md-center">
                    <button class="btn btn-success col-2 p-2 m-2" type="submit" name="btn_registro" value="ingreso">Ingresar</button>
                    <button class="btn btn-warning col-2 p-2 m-2" type="submit" name="btn_registro" value="modificar">Modificar</button>
                    <button class="btn btn-info col-2 p-2 m-2" type="submit" name="btn_registro" value="buscar">Buscar</button>
                    <button class="btn btn-danger col-2 p-2 m-2" type="submit" name="btn_registro" value="eliminar">Eliminar</button>
                    <button class="btn btn-success col-2 p-2 m-2" type="reset" name="btn_registro" value="ingreso">Limpiar</button>
                </div>
            </div>

            <?php echo "<div class='text-danger'>" . $mensaje . "</div>"; ?>

        </div>
</form>

<?php

if (isset($_GET['mensaje'])) {
    var_dump($_GET['mensaje']);
}
echo "<br>";
if (isset($_SESSION['item']['mensaje'])) {
    var_dump($_SESSION['item']['mensaje']);
}

include('../Templates/footer.php');
?>