<?php

class Submodulo
{
    private $id;
    private $submodulo;
    private $estatus;
    private $modulo_id;
    private $icon;
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

    function setSubmodulo($submodulo)
    {
        $this->submodulo = $submodulo;
    }

    function getSubmodulo()
    {
        return $this->submodulo;
    }

    function setEstatus($estatus)
    {
        $this->estatus = $estatus;
    }

    function getEstatus()
    {
        return $this->estatus;
    }

    function setModuloId($modulo_id)
    {
        $this->modulo_id = $modulo_id;
    }

    function getModuloId()
    {
        return $this->modulo_id;
    }

    function setIcon($icon)
    {
        $this->icon = $icon;
    }

    function getIcon()
    {
        return $this->icon;
    }



    function getSubmodulos()
    {
        $query = "SELECT * FROM submodulos WHERE modulo=:mod ORDER BY modulo asc;";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':mod', $this->modulo_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAll()
    {
        $query = "SELECT * FROM submodulos ORDER BY id asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getNextID()
    {
        $query = "SELECT max(id)+1 as nextid FROM submodulos";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    function saveModule()
    {
        $query = "INSERT INTO submodulos (id,submodulo,estatus,modulo,icon) values(:id,:smod,:stat,:idmod,:icon)";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":id", $this->id);
        $statement->bindParam(":smod", $this->submodulo);
        $statement->bindParam(":stat", $this->estatus);
        $statement->bindParam(":idmod", $this->modulo_id);
        $statement->bindParam(":icon", $this->icon);
        return $statement->execute();
    }

    function getViewSubmodulos()
    {
        $query = "SELECT * FROM v_submodulos";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateSubmodule()
    {
        $query = "UPDATE submodulos SET submodulo = :submod, modulo=:mod, icon =:ico WHERE id = :idSubmod";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idSubmod", $this->id);
        $statement->bindParam(":submod", $this->submodulo);
        $statement->bindParam(":mod", $this->modulo_id);
        $statement->bindParam(":ico", $this->icon);
        return $statement->execute();
    }


    function deleteModule(){
        $query = "UPDATE submodulos SET estatus = :stat WHERE id = :idSubmod";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idSubmod",$this->id);
        $statement->bindParam(":stat",$this->estatus);
        return $statement->execute();
    }
}
