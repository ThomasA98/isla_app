<?php 

require 'ConexionCs.php';

class Acceso extends Conexion {
    function __construct()
    {
        parent::__construct();
        return $this;
    }

    public function login(){
        $data = ( count( func_get_args() ) > 0 ) ? func_get_args()[0]: func_get_args();

        $sql = "SELECT idUsuarios, user, pass, perfil FROM usuarios 
        WHERE user = ? and pass = ?";

        $consulta = $this->prepare($sql);

        $consulta->bind_param('ss',$user, $pass);
        $user = $data['user'];
        $pass = $data['pass'];

        $this->execute($consulta);
        $consulta->bind_result($idUsuarios_bd, $user_bd, $pass_bd, $perfil_bd);

        $consulta->fetch();

        if ($pass == $pass_bd){
            $info = array(
                'estado' => true,
                'idusuario' => $idUsuarios_bd,
                'user' => $user_bd,
                'pass' => $pass_bd,
                'perfil' => $perfil_bd,
            );
        } else {
            $info = array(
                'estado' => false,
                'mensaje' => '<b>El usuario no es valido</b>',
            );
        }

        return $info;
    }
}

$accesos = new Acceso;

?>