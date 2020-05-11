<?php
include_once("accesoDb.php");
include_once("IParte2.php");

class Televisor implements IParte2{
    public $tipo;
    public $precio;
    public $paisOrigen;
    public $path;
    private $id;

    public function __construct($tipo, $precio, $paisOrigen, $path = ""){
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->paisOrigen = $paisOrigen;
        $this->path = $path;
        $this->id = null;
    }

    public function getID(){
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
    }

    public function toString(){
        return $this->tipo."-".$this->precio."-".$this->paisOrigen."-".$this->path;
    }

    public function agregar(){
        $objAccesoBD = accesoDb::ObtenerAcceso();
        $consulta = $objAccesoBD->RetornarConsulta("INSERT INTO televisores VALUES(:id, :tipo, :precio, :pais, :foto)");
        
        $consulta->bindValue(':id', $this->getID(), PDO::PARAM_INT);
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->precio);
        $consulta->bindValue(':pais', $this->paisOrigen, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->path, PDO::PARAM_STR);
        $funciona = $consulta->execute();
        return $funciona;
    }
    static function traer(){
        $objAccesoBD = accesoDb::ObtenerAcceso();
        $consulta = $objAccesoBD->RetornarConsulta("SELECT * FROM televisores");
        $consulta->execute();

        $televisores = array();
        $resultado = $consulta->fetchAll();
        foreach($resultado as $fila)
        {
            $televisor = new Televisor($fila['tipo'], $fila['precio'], $fila['pais'], $fila['foto']);
            $televisor->setID($fila['id']);
            array_push($televisores, $televisor);
        }

        return $televisores;
    }

    public function calcularIVA(){
        return ($this->precio * 1.21);
    }

    public function verificar($televisores){
        $noExiste = TRUE;

        foreach($televisores as $televisor)
        {
            if($televisor->tipo == $this->tipo && $televisor->pais == $this->pais)
            {
                $noExiste = FALSE;
                break;
            }
        }

        return $noExiste;
    }

    public function Modificar(){
        $objAccesoDb = AccesoDb::ObtenerAcceso();
        $tipo = $this->tipo;
        $precio = $this->precio;
        $pais = $this->paisOrigen;
        $foto = $this->path;
        $id = $this->getID();

        $consulta = $objAccesoDb->RetornarConsulta("UPDATE televisores SET tipo = :tipo, precio = :precio,
                                                    pais = :pais, foto = :foto WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $precio);
        $consulta->bindValue(':pais', $pais, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $foto, PDO::PARAM_STR);
        
        return $consulta->execute();
    }
}