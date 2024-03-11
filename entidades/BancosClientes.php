<?php
class BancosClientes
{
    private $id_bando;
    private $desc_banco;
    private $estatus;
    protected $db;

    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }

    function setid_bando($id_bando)
    {
        $this->id_bando = $id_bando;
    }
    function getid_bando()
    {
        return $this->id_bando;
    }
    function setdesc_banco($desc_banco)
    {
        $this->desc_banco = $desc_banco;
    }
    function getdesc_banco()
    {
        return $this->desc_banco;
    }
    function setestatus($estatus)
    {
        $this->estatus = $estatus;
    }
    function getestatus()
    {
        return $this->estatus;
    }


    function getBancos()
    {
        $query = "SELECT id_banco,desc_banco FROM bancos_clientes WHERE estatus = 'Activo' ORDER BY id_banco asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
