<?php

class Modulos
{
    private $id;
    private $modulo;
    private $estatus;
    private $url;
    protected $db;

    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function setModulo($modulo)
    {
        $this->modulo = $modulo;
    }

    function getModulo()
    {
        return $this->modulo;
    }

    function setEstatus($estatus)
    {
        $this->estatus = $estatus;
    }

    function getEstatus()
    {
        return $this->estatus;
    }

    function setUrl($url)
    {
        $this->url = $url;
    }

    function getUrl()
    {
        return $this->url;
    }


    function getModulosActivos()
    {
        $query = "SELECT * FROM modulos WHERE estatus ='Enable' ORDER BY modulo asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getNextID()
    {
        $query = "SELECT max(id)+1 as nextid FROM modulos";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function saveModule(){
        $query = "INSERT INTO modulos (id,modulo,estatus,url) values(:idMod,:mod,:stat,:pth)";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idMod",$this->id);
        $statement->bindParam(":mod",$this->modulo);
        $statement->bindParam(":stat",$this->estatus);
        $statement->bindParam(":pth",$this->url);
        return $statement->execute();
    }


    function updateModule(){
        $query = "UPDATE modulos SET modulo = :mod, url=:pth, estatus =:stats WHERE id = :idMod";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idMod",$this->id);
        $statement->bindParam(":stats",$this->id);
        $statement->bindParam(":mod",$this->modulo);
        $statement->bindParam(":pth",$this->url);
        return $statement->execute();
    }


    function deleteModule(){
        $query = "UPDATE modulos SET estatus = :stat WHERE id = :idMod";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idMod",$this->id);
        $statement->bindParam(":stat",$this->estatus);
        return $statement->execute();
    }


    function getModulos()
    {
        $query = "SELECT * FROM modulos ORDER BY id asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }



}
