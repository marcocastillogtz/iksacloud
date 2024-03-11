<?php
class ListaPrecio
{
    private $id;
    private $estatus;
    private $tipo;
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
    function settipo($tipo)
    {
        $this->tipo = $tipo;
    }
    function gettipo()
    {
        return $this->tipo;
    }

    function getListaPrecio()
    {
        $query = "SELECT id,tipo FROM lista_precio_nombre WHERE estatus ='Activo' ORDER BY id asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
