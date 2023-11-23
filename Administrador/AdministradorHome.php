<?php 

session_start();
include('../templates/header.php');
include('../templates/menu.php');

?>
<body>
    <div id="header">
        <ul class="nav">
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Opciones</a>
                <ul>
                    <li><a href="AdministradorGuia.html"> Guia </a></li>
                    <li><a href="#">Administrativo </a></li>
                    <li><a href="AdministradorVisitas.html">Visita</a></li>
                    <li><a href="AdministradorTuristas.html">Turista </a>
                    </li>
                </ul>
            </li>
            <li><a href="#">visitas</a>
                <ul>
                    <li><a href="AdministradorCargo.html">personal a cargo</a></li>
                    <li><a href="AdministradorCalendario.html">calendario </a></li>
                </ul>
            </li>
            <li><a href="#">Contacto</a></li>
        </ul>
    </div>

    <div class="container">
        <form action="" method="">
            <h1>Bienvenido al Parque Nacional Mas grande de la Region </h1>
            <img src="../imagen/fyf.jpg" width="180px">
            <div>
                <label>Nombre de Usuario</label>
                <input class="validate" type="text" placeholder="Ingrese Correo" name="name">
            </div>
            <div>
                <label>Ingreso de Contraseña</label>
                <input class="validate" type="password" placeholder="Ingrese Contraseña" name="password">
            </div>
            <div>
                <label for="tipo">Invitado:</label>
                <input type="checkbox" name="tipo" id="tipo" checked>
                <br>
                <label for="tipo">Guia:</label>
                <input type="checkbox" name="tipo" id="tipo">
                <br>
                <label for="tipo">Administrativo:</label>
                <input type="checkbox" name="tipo" id="tipo">
            </div>
            <br>
            <div>
                <input type="submit" name="btn" value="ingresar">
            </div>
        </form>
    </div>
    
     
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
</body>

</html>