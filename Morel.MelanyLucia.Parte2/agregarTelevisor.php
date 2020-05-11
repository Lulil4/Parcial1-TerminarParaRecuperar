<?php
include_once ("./clases/televisor.php");

$id = isset($_POST['id']) ? $_POST['id'] : NULL;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$paisOrigen = isset($_POST['paisOrigen']) ? $_POST['paisOrigen'] : NULL;
$foto = isset($_FILES['foto']) ? $_FILES['foto'] : NULL;

if($tipo !== NULL && $precio !== NULL && $paisOrigen !== NULL && $foto !== NULL && $id != NULL)
{
    $televisores = Televisor::traer();
    $televisor = new Televisor($tipo, $precio, $paisOrigen);
    $televisor->setID($id);
    $destino = "./fotos/" . $_FILES["foto"]["name"];
    $tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);
    $destino = "fotos/" . $_POST["txtDni"] . "-" . $_POST["txtApellido"] . "." . $tipoArchivo;
    $televisor->path = $path;
    if($televisor->Verificar(Televisor::traer())) 
    {
        foreach($televisores as $teleDentro){
            if ($teleDentro->getID() == $_POST["id"]){
                unlink($teleDentro->path);
                break;
            }
        }

        unlink($televisor->path);
        if($televisor->Agregar()){
            move_uploaded_file($_FILES["fileFoto"]["tmp_name"], $destino);
            header("location: ./listado.php");
        }
        else{
            echo "Error al agregar juguete.";
        }
    }
    else{
        echo "El juguete ya existe.";
    }
    
}