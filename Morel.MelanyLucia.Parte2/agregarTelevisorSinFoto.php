<?php
include_once ("./clases/televisor.php");

$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$paisOrigen = isset($_POST['paisOrigen']) ? $_POST['paisOrigen'] : NULL;


if($tipo !== NULL && $precio !== NULL && $paisOrigen !== NULL)
{
    $televisor = new Televisor($tipo, $precio, $paisOrigen);
    $noExiste = $televisor->verificar(Televisor::traer());

    if($noExiste){
        $televisor->agregar();
    }
    else{
        echo "El televisor ya existe.";
    }
}