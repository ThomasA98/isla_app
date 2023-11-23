<?php 

class Conexion{
    /** Crear parametros de conexion */
    private $servidor = 'localhost';
    private $user = 'pLoginUser';
    private $pass = 'asd123';
    private $base_datos = 'plogin';

    protected $conexion;
    protected $secured;

    function __construct(){
        $this->conexion = new mysqli($this->servidor, $this->user, $this->pass, $this->base_datos);
        if ($this->conexion->connect_errno) {
            die('error en la conexion a mysql: ('.$this->conexion->connect_errno.') - '.$this->conexion->connect_error);
        }
    }

    public function proteger_text($text){
        //elimina etiquetas php y html del texto
        $this->secured = strip_tags($text);
        // htmlspecialchars -> combierte caracteres especiales de html
        // stripslashes -> elimina barras diagonales
        $this->secured = htmlspecialchars( trim( stripslashes($text) ) ,ENT_QUOTES, 'UTF-8');
    }

    protected function prepare($consulta) {
        if (!( $consulta = $this->conexion->prepare($consulta) ) ) {
            die('error al preparar la consulta: (' . $this->conexion->connect_errno . ') - ' . $this->conexion->connect_error);
        }
        return $consulta;
    }

    protected function execute($sentencia) {
        if ( !($sentencia->execute()) ) {
            die('error al executar la consulta: (' . $this->conexion->connect_errno . ') - ' . $this->conexion->connect_error);
        }
        return $sentencia;
    }

    protected function compruebo_imagen($img) {
        // compruebo que las caracteristicas del archivo enviado sean las correctas
        $error = "";
        if ($img['name'] == NULL || $img['name'] == "") {
            $error = $error . " no se encontro el nombre de la imagen";
        }
        if ($img['size'] > 3000000) {
            $error = $error . " el tamanno de la imagen es superior a lo permitido";
        }
        if (!($img['type'] == 'image/jpg'
        || $img['type'] == 'image/png'
        || $img['type'] == 'image/gif'
        || $img['type'] == 'image/jpeg')) {
            $error = $error . " el tipo de archivo no es permitido";
        }
        if ($error != "") {
            //retorno los errores
            return array(
                'estado' => false,
                'mensaje' => $error,
            );
        } else {
            //en caso de no haber errores retorno los valores recibidos de $img
            return array(
                'estado' => true,
                'type' => $img['type'],
                'name' => $img['name'],
                'size' => $img['size'],
                'tmp_name' => $img['tmp_name'],
            );
        }
    }
}

$conexion = new Conexion;

?>