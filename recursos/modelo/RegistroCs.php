<?php

require 'ConexionCs.php';

class Registro extends Conexion {
    function __construct()
    {
        parent::__construct();
        return $this;
    }

    public function ingreso($data, $img) {

        $img = parent::compruebo_imagen($img);

        if ($img['estado'] == false) {
            return $img;
        }

        //reviso que no exista el item
        switch ($data['tipo']) {

            case 'flora':
                $sql = "SELECT COUNT(nombre) FROM Flora WHERE nombre = ?";
                break;
            case 'fauna':
                $sql = "SELECT COUNT(nombre) FROM Fauna WHERE nombre = ?";
                break;
            case 'lugar':
                $sql = "SELECT COUNT(nombre) FROM Lugares WHERE nombre = ?";
                break;


            default:
                return array(
                    'estado' => false,
                    'mensaje' => "no seleciono el tipo de item",
                );
        }

        $query = $this->prepare($sql);

        $query->bind_param('s', $nombre);
        $nombre = $data['nombre'];

        $query->execute();

        $query->bind_result($resultado);
        $query->fetch();

        $query->close();

        if ($resultado > 0) {
            return array(
                'estado' => false,
                'mensaje' => "el item ya existe",
            );
        }
        //--------termino de comprobar si existe el item

        //ingreso del nuevo item

        $numero = rand(1, 10000);//genero un numero "aleatorio" para que no se repitan los nombres
        switch ($data['tipo']) {
            
            case 'flora':
                $sql = "INSERT INTO Flora (id, nombre, imagen, descripcion) VALUES (NULL, ?, ?, ?)";
                $ruta = "../../imagenes_db/";
                move_uploaded_file($img['tmp_name'], $ruta . "flora/" . $numero . "_" . $img['name']);
                $imagen = "flora/" . $numero . "_" . $img['name'];
                break;
            case 'fauna':
                $sql = "INSERT INTO Fauna (id, nombre, imagen, descripcion) VALUES (NULL, ?, ?, ?)";
                $ruta = "../../imagenes_db/";
                move_uploaded_file($img['tmp_name'], $ruta . "fauna/" . $numero . "_" . $img['name']);
                $imagen = "fauna/" . $numero . "_" . $img['name'];
                break;
            case 'lugar':
                $sql = "INSERT INTO Lugares (id, nombre, imagen, descripcion) VALUES (NULL, ?, ?, ?)";
                $ruta = "../../imagenes_db/";
                move_uploaded_file($img['tmp_name'], $ruta . "lugares/" . $numero . "_" . $img['name']);
                $imagen = "lugares/" . $numero . "_" . $img['name'];
                break;
        }

        $query = $this->prepare($sql);

        $query->bind_param('sss', $nombre, $imagen, $descripcion);
        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];

        $this->execute($query);
        $query->close();

        return array(
            //retorna un false si todo funciono para vaciar las variables locales en GuiaRegistro.php
            'estado' => false,
            'mensaje' => "ingreso exitoso",
        );
    }

    public function modifico_con_imagen($data, $img) {

        $img = parent::compruebo_imagen($img);

        if ($img['estado'] == false) {
            return $img;
        }

        switch ($data['tipo']) {
            case 'flora':
                $sql = "UPDATE Flora SET nombre = ?, imagen = ?, descripcion = ? WHERE id = ?";
                $ruta = "../../imagenes_db/";
                move_uploaded_file($img['tmp_name'], $ruta . "flora/" . $data['id'] . "_" . $img['name']);
                $imagen = "flora/" . $data['id'] . "_" . $img['name'];
                break;
            case 'fauna':
                $sql = "UPDATE Fauna SET nombre = ?, imagen = ?, descripcion = ? WHERE id = ?";
                $ruta = "../../imagenes_db/";
                move_uploaded_file($img['tmp_name'], $ruta . "fauna/" . $data['id'] . "_" . $img['name']);
                $imagen = "fauna/" . $data['id'] . "_" . $img['name'];
                break;
            case 'lugar':
                $sql = "UPDATE Lugares SET nombre = ?, imagen = ?, descripcion = ? WHERE id = ?";
                $ruta = "../../imagenes_db/";
                move_uploaded_file($img['tmp_name'], $ruta . "lugares/" . $data['id'] . "_" . $img['name']);
                $imagen = "lugares/" . $data['id'] . "_" . $img['name'];
                break;

            default:
                return array(
                    'estado' => false,
                    'mensaje' => "no seleciono el tipo de item",
                );
        }

        $query = $this->prepare($sql);

        $query->bind_param('sssi', $nombre, $imagen, $descripcion, $id);
        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $id = $data['id'];

        $query->execute();
        $query->close();

        return $this->busco_id(array(
            'id' => $data['id'],
            'tipo' => $data['tipo'],
        ));
    }

    public function modifico_sin_imagen($data){

        switch ($data['tipo']) {
            case 'flora':
                $sql = "UPDATE Flora SET nombre = ?, descripcion = ? WHERE id = ?";
                break;
            case 'fauna':
                $sql = "UPDATE Fauna SET nombre = ?, descripcion = ? WHERE id = ?";
                break;
            case 'lugar':
                $sql = "UPDATE Lugares SET nombre = ?, descripcion = ? WHERE id = ?";
                break;

            default:
                return array(
                    'estado' => false,
                    'mensaje' => "no seleciono el tipo de item",
                );
        }

        $query = $this->prepare($sql);

        $query->bind_param('ssi', $nombre, $descripcion, $id);
        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $id = $data['id'];

        $query->execute();
        $query->close();

        return $this->busco_id(array(
            'id' => $data['id'],
            'tipo' => $data['tipo'],
        ));
    }

    public function busco_id($data){
        switch ($data['tipo']) {
            case 'flora':
                $sql = "SELECT id, nombre, imagen, descripcion FROM Flora WHERE id = ?";
                break;
            case 'fauna':
                $sql = "SELECT id, nombre, imagen, descripcion FROM Fauna WHERE id = ?";
                break;
            case 'lugar':
                $sql = "SELECT id, nombre, imagen, descripcion FROM Lugares WHERE id = ?";
                break;


            default:
                return array(
                    'estado' => false,
                    'mensaje' => "no seleciono el tipo de item",
                );
        }

        $query = $this->prepare($sql);

        $query->bind_param('i', $id);
        $id = $data['id'];

        $query->execute();

        $query->bind_result($id_db, $nombre_db, $imagen_db, $descripcion_db);
        $query->fetch();

        $query->close();

        if (!empty($id_db)) {
            return array(
                'estado' => true,
                'id' => $id_db,
                'nombre' => $nombre_db,
                'imagen' => $imagen_db,
                'descripcion' => $descripcion_db,
                'tipo' => $data['tipo'],
            );
        } else {
            return array(
                'estado' => false,
                'mensaje' => "no se encontro el item",
            );
        }
    }

    public function busco_nombre($data) {
        switch ($data['tipo']) {
            case 'flora':
                $sql = "SELECT id, nombre, imagen, descripcion FROM Flora WHERE nombre = ?";
                break;
            case 'fauna':
                $sql = "SELECT id, nombre, imagen, descripcion FROM Fauna WHERE nombre = ?";
                break;
            case 'lugar':
                $sql = "SELECT id, nombre, imagen, descripcion FROM Lugares WHERE nombre = ?";
                break;


            default:
                return array(
                    'estado' => false,
                    'mensaje' => "no seleciono el tipo de item",
                );
        }

        $query = $this->prepare($sql);

        $query->bind_param('s', $nombre);
        $nombre = $data['nombre'];

        $query->execute();

        $query->bind_result($id_db, $nombre_db, $imagen_db, $descripcion_db);
        $query->fetch();

        $query->close();

        if (!empty($id_db)){
            return array(
                'estado' => true,
                'id' => $id_db,
                'nombre' => $nombre_db,
                'imagen' => $imagen_db,
                'descripcion' => $descripcion_db,
                'tipo' => $data['tipo'],
            );
        } else {
            return array(
                'estado' => false,
                'mensaje' => "no se encontro el item",
            );
        }
    }

    public function elimino($data) {
        switch ($data['tipo']) {
            case 'flora':
                $sql = "DELETE FROM Flora WHERE id = ?";
                break;
            case 'fauna':
                $sql = "DELETE FROM Fauna WHERE id = ?";
                break;
            case 'lugar':
                $sql = "DELETE FROM Lugares WHERE id = ?";
                break;


            default:
                return array(
                    'estado' => false,
                    'mensaje' => "no seleciono el tipo de item",
                );
        }

        $query = $this->prepare($sql);

        $query->bind_param('i', $id);
        $id = $data['id'];

        $query->execute();
        $query->close();

        return array(
            'estado' => true,
            'id' => "",
            'nombre' => "",
            'imagen' => "",
            'descripcion' => "",
            'tipo' => "",
        );
    }

    public function home($tipo) {
        switch ($tipo) {
            case 1:
                $sql = "SELECT * FROM Flora ORDER BY rand() LIMIT 1";
                break;
            case 2:
                $sql = "SELECT * FROM Fauna ORDER BY rand() LIMIT 1";
                break;
            case 3:
                $sql = "SELECT * FROM Lugares ORDER BY rand() LIMIT 1";
                break;
            
            default:
                dir("algo salio mal");
                break;
        }

        $query = $this->prepare($sql);

        $query->execute();

        $query->bind_result($id_db, $nombre_db, $imagen_db, $descripcion_db);
        $query->fetch();

        $query->close();

        return array(
            'id' => $id_db,
            'nombre' => $nombre_db,
            'imagen' => $imagen_db,
            'descripcion' => $descripcion_db,
        );
    }

}

$registro = new Registro;

?>