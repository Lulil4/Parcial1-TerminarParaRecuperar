<?php
include_once ("./clases/usuario.php");

$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;
if($email != NULL && $clave != NULL){
    $usuario = new Usuario($email, $clave);
    if (Usuario::verificarExistencia($usuario)){
        if (setcookie($usuario->getEmail(), date("d/m/Y-H:i:s"))){
            header("Locale: ./listadoUsuarios.php");
        }
        else{
            echo "error al crear la cookie!!";
        }
    }
    else{
        echo "El usuario no existe";
    }
}