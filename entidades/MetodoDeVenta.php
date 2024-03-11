<?php

class MetodoDeVenta
{
    private $codigo_venta;
    private $descripcion;
    private $codigo_r;
    private $codigo_f;

    private $msg_err_MVenta;

    private $startIndex;
    private $perPage;

    protected $db;

    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }

    function setcodigo_venta($codigo_venta)
    {
        $this->codigo_venta = $codigo_venta;
    }
    function getcodigo_venta()
    {
        return $this->codigo_venta;
    }
    function setdescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    function getdescripcion()
    {
        return $this->descripcion;
    }
    function setcodigo_r($codigo_r)
    {
        $this->codigo_r = $codigo_r;
    }
    function getcodigo_r()
    {
        return $this->codigo_r;
    }
    function setcodigo_f($codigo_f)
    {
        $this->codigo_f = $codigo_f;
    }
    function getcodigo_f()
    {
        return $this->codigo_f;
    }

    function setIndex($index)
    {
        $this->startIndex = $index;
    }
    function getIndex()
    {
        return $this->startIndex;
    }

    function setLastPage($perPage)
    {
        $this->perPage = $perPage;
    }
    function getLastPage()
    {
        return $this->perPage;
    }


    function getCodVenta()
    {
        $query = "SELECT * FROM tipo_venta WHERE Estatus='Activo' ORDER BY codigo_venta asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function saveMetVenta()
    {
        try {
            $query = "INSERT INTO tipo_venta(codigo_venta, descripcion, codigo_r, codigo_f)VALUES(:codVenta, :descVenta, :codR, :codF)";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":codVenta", $this->codigo_venta);
            $statement->bindParam(":descVenta", $this->descripcion);
            $statement->bindParam(":codR", $this->codigo_r);
            $statement->bindParam(":codF", $this->codigo_f);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err_MVenta = $e->getMessage();
            return $e->getMessage();
        }
    }

    function getIdMetVenta()
    {
            $query = "SELECT codigo_venta, descripcion, codigo_r, codigo_f FROM tipo_venta WHERE codigo_venta=:codVenta";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":codVenta", $this->codigo_venta);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateMetVenta()
    {
        try {
            $query = "UPDATE tipo_venta SET descripcion=:descVenta, codigo_r=:codR, codigo_f=:codF WHERE codigo_venta=:codVenta";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":codVenta", $this->codigo_venta);
            $statement->bindParam(":descVenta", $this->descripcion);
            $statement->bindParam(":codR", $this->codigo_r);
            $statement->bindParam(":codF", $this->codigo_f);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err_MVenta = $e->getMessage();
            return $e->getMessage();
        }
    }

    function deleteMetVenta()
    {
        try {
            $query = "UPDATE tipo_venta SET Estatus='Suspendido' WHERE codigo_venta=:codVenta";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":codVenta", $this->codigo_venta);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err_MVenta = $e->getMessage();
            return $e->getMessage();
        }
    }

    function getTipoVenta()
    {
        $query = "SELECT * FROM tipo_venta WHERE Estatus='Activo' ORDER BY codigo_venta asc LIMIT :startIndex,:perPage";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":startIndex", $this->startIndex, PDO::PARAM_INT);
        $statement->bindParam(":perPage", $this->perPage, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCountMetVenta()
    {
        $query = "SELECT COUNT(codigo_venta) as counts FROM tipo_venta where Estatus='Activo'";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getMessageERROR()
    {
        require_once('../diccionario.php');
        $sqlMessage = $this->msg_err_MVenta;
        return getMessageSQL($sqlMessage);
    }

}
