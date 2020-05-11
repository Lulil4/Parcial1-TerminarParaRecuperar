<?php
class Usuario{
    private $_email;
    private $_clave;

    public function __construct($email, $clave){
        $this->_email = $email;
        $this->_clave = $clave;
    }

    public function getEmail(){
        return $this->_email;
    }

    public function getClave(){
        return $this->_clave;
    }

    public function toString(){
        return $this->_email . " - " . $this->_clave;
    }

    public function guardarEnArchivo(){
        $path = "./archivos/usuarios.txt";
        $fArchivo = fopen($path, "w");
        fwrite($fArchivo, $this->toString() . "\r\n");
		fclose($fArchivo);
    }

    public static function traerTodos(){

        $path = "./archivos/usuarios.txt";
        $fArchivo = fopen($path, "r");
        $cantidadUsuarios = 0;
        $arrUsuarios = array();
        $usuario;
        while(!feof($fArchivo)){
            $usuario = explode(" - ", fgets($fArchivo));
            $usuario[0] = trim($usuario[0]); 

            if($usuario[0] != ""){

                $usuario[1] = trim($usuario[1]);

                $arrUsuarios[$cantidadUsuarios] = new Usuario($usuario[0], $usuario[1]);
            }
            $cantidadUsuarios++;
        }
        fclose($fArchivo);
        return $arrUsuarios;
    }

    public static function verificarExistencia($usuario){
        $existe = FALSE;
        $usuarios = Usuario::traerTodos();
        foreach($usuarios as $usuarioDentro)
        {
            if($usuarioDentro->getEmail() == $usuario->getEmail() && $usuarioDentro->getClave() == $usuario->getClave())
            {
                $existe = TRUE;
                break;
            }
        }
        return $existe;
    }
}