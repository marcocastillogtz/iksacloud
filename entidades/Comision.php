<?php
class Comision
{

    private $codigo;
    private $vendedor;
    private $porcentaje;
    protected $db;

    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }

    function setcodigo($codigo)
    {
        $this->codigo = $codigo;
    }
    function getcodigo()
    {
        return $this->codigo;
    }
    function setvendedor($vendedor)
    {
        $this->vendedor = $vendedor;
    }
    function getvendedor()
    {
        return $this->vendedor;
    }
    function setporcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;
    }
    function getporcentaje()
    {
        return $this->porcentaje;
    }

    function getComisionFactura()
    {
        $query = "SELECT codigo_comision FROM comision WHERE codigo_comision not like 'R_%' ORDER BY codigo_comision asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getComisionRemision()
    {
        $query = "SELECT codigo_comision FROM comision WHERE codigo_comision like 'R_%' ORDER BY codigo_comision asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
