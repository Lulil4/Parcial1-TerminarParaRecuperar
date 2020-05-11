<?php
class AccesoDb
{
    private static $_objAccesoDb;
    private $_objPDO;

    public function __construct()
    {
        try
        {
            $usuario = "root";
            $clave = "";
            $dsn = "mysql:host=localhost;dbname=productos_bd;charset=utf8";
            $this->_objPDO = new PDO($dsn, $usuario, $clave);
        }
        catch(PDOException $error)
        {
            print "Error!!!<br/>".$error->getMessage();
            die();
        }
    }

    public function RetornarConsulta($sql)
    {
        return $this->_objPDO->prepare($sql);
    }

    public static function ObtenerAcceso()
    {
        if (!isset(self::$_objAccesoDb)) {       
            self::$_objAccesoDb = new AccesoDb(); 
        }
 
        return self::$_objAccesoDb;        
    }

    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida!!!', E_USER_ERROR);
    }
}