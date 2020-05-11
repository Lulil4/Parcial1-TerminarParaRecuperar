<?php
include_once ("./clases/usuario.php");

$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;

if($email !== NULL && $clave !== NULL){

    $usuario = new Usuario($email, $clave);
    $usuario->guardarEnArchivo();
}