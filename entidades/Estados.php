<?php
class Estados
{
    private $id;
    private $estado;
    private $estatus;
    protected $db;

    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }
    function setid($id)
    {
        $this->id = $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setestatus($estatus)
    {
        $this->estatus = $estatus;
    }

    function getestatus()
    {
        return $this->estatus;
    }

    function setestado($estado)
    {
        $this->estado = $estado;
    }

    function getestado()
    {
        return $this->estado;
    }


    function getAll()
    {
        $query = "SELECT id_Estado,estado FROM estados WHERE estatus ='Activo' ORDER BY estado asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
