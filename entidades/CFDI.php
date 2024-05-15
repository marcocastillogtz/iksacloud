<?php

class CFDI
{
    private $msg_err_Esq;


    protected $db;
    protected $codigo;

    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }

    function getCFDI()
    {
        $query = "SELECT c_UsoCFDI,Descripcion FROM catalogo_cfdi WHERE Estatus ='Activo'";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getMessageERROR()
    {
        require_once('../diccionario.php');
        $sqlMessage = $this->msg_err_Esq;
        return getMessageSQL($sqlMessage);
    }
}