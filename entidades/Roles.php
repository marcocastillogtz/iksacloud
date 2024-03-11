<?php

class Roles{
    private $db;
    private $nivel;
    private $descripcion;
    private $estatus;

    private $msg_err_Rol;

    public function __construct()
    {
            require_once("DBC.php");
            $database_object = new DatabaseConnection();
            $this->db = $database_object->connect();
    }


    function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }

    function getNivel()
    {
        return $this->nivel;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function setEstatus($estatus)
    {
        $this->estatus = $estatus;
    }

    function getEstatus()
    {
        return $this->estatus;
    }

    function get_all_rolls($where)
    {
        $query = "SELECT * FROM roles $where ORDER BY nivel DESC";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getRole()
    {
        $query = "SELECT * FROM roles WHERE estatus = 'Enable'";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getIdRole()
    {
        $query = "SELECT nivel, descripcion FROM roles WHERE nivel = :nivRol";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":nivRol", $this->nivel);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateRole()
    {
        try {
            $query = "UPDATE roles SET descripcion = :descRol WHERE nivel = :nivRol";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":descRol", $this->descripcion);
            $statement->bindParam(":nivRol", $this->nivel);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err_Rol = $e->getMessage();
            return $e->getMessage();
        }
        
    }

    function deleteRole()
    {
        try {
            $query = "UPDATE roles SET estatus = 'Disabled' WHERE nivel = :nivRol";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":nivRol", $this->nivel);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err_Rol = $e->getMessage();
            return $e->getMessage();
        }
    }

    function insertRole()
    {
        try {
            $query = "INSERT INTO roles(descripcion, estatus)VALUES(:descRol, 'Enable')";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":descRol", $this->descripcion);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err_Rol = $e->getMessage();
            return $e->getMessage();
        }
    }


    function getMessageERROR()
    {
        require_once('../diccionario.php');
        $sqlMessage = $this->msg_err_Rol;
        return getMessageSQL($sqlMessage);
    }
}
