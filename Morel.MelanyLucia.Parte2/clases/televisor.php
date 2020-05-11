<?php
include_once("accesoDb.php");
include_once("IParte2.php");

class Televisor implements IParte2{
    public $_tipo;
    public $_precio;
    public $_paisOrigen;
    public $_path;

    public function __construct($tipo, $precio, $paisOrigen, $path = ""){
        $this->_tipo = $tipo;
        $this->_precio = $precio;
        $this->_paisOrigen = $paisOrigen;
        $this->_path = $path;
    }

    public function toString(){
        return $this->GetTipo()."-".$this->GetPrecio()."-".$this->GetPaisOrigen()."-".$this->GetPathImagen();
    }

    public function agregar(){
        $objAccesoBD = accesoDb::ObtenerAcceso();
        $consulta = $objAccesoBD->RetornarConsulta("INSERT INTO televisores VALUES(:id, :tipo, :precio, :pais, :foto)");
        
        $consulta->bindValue(':id', null, PDO::PARAM_INT);
        $consulta->bindValue(':tipo', $this->_tipo, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->_precio);
        $consulta->bindValue(':pais', $this->_paisOrigen, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->_path, PDO::PARAM_STR);
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
            array_push($televisores, $televisor);
        }

        return $televisores;
    }

    public function calcularIVA(){
        return ($this->_precio * 1.21);
    }

    public function verificar($televisores){
        $existe = FALSE;

        foreach($televisores as $televisor)
        {
            if($televisor->_tipo == $this->_tipo && $televisor->_pais == $this->_pais)
            {
                $existe = TRUE;
                break;
            }
        }

        return $existe;
    }

}