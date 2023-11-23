<?php
session_start();
include('../templates/header.php');
include('../templates/menu.php');


if (isset($_SESSION['home']) && $_SESSION['home']['id'] != "") {
    $id = $_SESSION['home']['id'];
    $nombre = $_SESSION['home']['nombre'];
    $descripcion = $_SESSION['home']['descripcion'];
    if ($_SESSION['home']['imagen'] == "") {
        $imagen = "../imagen/sunset_sea_island_palm_trees-1600x900.jpg";
    } else {
        $imagen = $_SESSION['home']['imagen'];
    }
    $_SESSION['home']['id'] = "";
} else {
    header('location:../recursos/controlador/registro.php?tipo=' . rand(1, 3) . '&home=');
}
?>

<div class="container mt-4">
    <h2 class="text-center text-white">Inicio</h2>
    <section class="row bg-dark shadow-lg">

        <div class="card col-2 m-4">
            <div class="card-header bg-secondary">Proximo Tour</div>
            <img class="card-img" src="../imagen/sunset_sea_island_palm_trees-1600x900.jpg" />
            <div class="card-body">
                <div class="card-title text-center">nombre tour</div>
                <div class="card-text text-center">
                    horario<br>
                    numero de vicitantes</div>
            </div>
        </div>

        <div class="card col-9 m-4">
            <div class="card-header bg-secondary">Flora, Fauna y Lugares de la Isla</div>
            <div class="card-body">
                <div class="card-title text-center"><?php echo $nombre; ?></div>
                <div class="row justify-content-md-center">
                    <div class="card-text text-center col-8"><?php echo $descripcion; ?></div>
                    <div class="col-3">
                        <img class="card-img" src="../imagenes_db/<?php echo $imagen; ?>" />
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<?php include('../templates/footer.php'); ?>