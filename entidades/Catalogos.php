<?php

class Catalogo
{
    private $c_FormaPago;
    private $Descripcion;

    private $c_UsoCFDI;
    private $c_RegimenFiscal;
    private $msg_err;

    private $startIndex;
    private $perPage;

    protected $db;

    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }

    function setc_FormaPago($c_FormaPago)
    {
        $this->c_FormaPago = $c_FormaPago;
    }
    function getc_FormaPago()
    {
        return $this->c_FormaPago;
    }

    function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;
    }
    function getDescripcion()
    {
        return $this->Descripcion;
    }


    function getErrSQL()
    {
        return $this->msg_err;
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


    function getCatalogoSAT()
    {
        $query = "SELECT * FROM catalogo_sat WHERE Estatus='Activo' ORDER BY c_FormaPago asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCatalogoCFDI()
    {
        $query = "SELECT * FROM catalogo_cfdi WHERE Estatus='Activo' ORDER BY c_UsoCFDI asc LIMIT :startIndex,:perPage";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":startIndex", $this->startIndex, PDO::PARAM_INT);
        $statement->bindParam(":perPage", $this->perPage, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCatalogoRegimenFiscal()
    {
        $query = "SELECT * FROM catalogo_reg_sat WHERE Estatus='Activo' ORDER BY c_RegimenFiscal asc LIMIT :startIndex,:perPage";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":startIndex", $this->startIndex, PDO::PARAM_INT);
        $statement->bindParam(":perPage", $this->perPage, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteRegimenFiscal()
    {
        try {
            $query = "UPDATE catalogo_reg_sat SET Estatus='Suspendido' WHERE c_RegimenFiscal=:idReg";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idReg", $this->c_FormaPago);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err = $e->getMessage();
            return $e->getMessage();
        }
    }

    function saveRegimenFiscal()
    {
        try {
            $query = "INSERT INTO catalogo_reg_sat(c_RegimenFiscal, Descripcion)VALUES(:idReg, :descReg)";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idReg", $this->c_FormaPago);
            $statement->bindParam(":descReg", $this->Descripcion);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err = $e->getMessage();
            return $e->getMessage();
        }
    }

    function getIdRegimenFiscal()
    {
        $query = "SELECT c_RegimenFiscal, Descripcion FROM catalogo_reg_sat WHERE c_RegimenFiscal=:idReg";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idReg", $this->c_FormaPago);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateRegimenFiscal()
    {
        try {
            $query = "UPDATE catalogo_reg_sat SET c_RegimenFiscal=:idReg, Descripcion=:descReg WHERE c_RegimenFiscal=:idReg";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idReg", $this->c_FormaPago);
            $statement->bindParam(":descReg", $this->Descripcion);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err = $e->getMessage();
            return $e->getMessage();
        }
    }

    function getCountRegimenFiscal()
    {
        $query = "SELECT COUNT(c_RegimenFiscal) as counts FROM catalogo_reg_sat where Estatus='Activo'";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getformPagoSAT()
    {
        $query = "SELECT * FROM catalogo_sat WHERE Estatus='Activo' ORDER BY c_FormaPago asc LIMIT :startIndex,:perPage";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":startIndex", $this->startIndex, PDO::PARAM_INT);
        $statement->bindParam(":perPage", $this->perPage, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function saveCatalogoSAT()
    {
        try {
            $query = "INSERT INTO catalogo_sat(c_FormaPago, Descripcion)VALUES(:idSAT, :descSAT)";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idSAT", $this->c_FormaPago);
            $statement->bindParam(":descSAT", $this->Descripcion);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err = $e->getMessage();
            return $e->getMessage();
        }
    }

    function getIdCatalogoSAT()
    {
        $query = "SELECT c_FormaPago, Descripcion FROM catalogo_sat WHERE c_FormaPago=:idSAT";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idSAT", $this->c_FormaPago);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateCatalogoSAT()
    {
        try {
            $query = "UPDATE catalogo_sat SET c_FormaPago=:idSAT, Descripcion=:descSAT WHERE c_FormaPago=:idSAT";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idSAT", $this->c_FormaPago);
            $statement->bindParam(":descSAT", $this->Descripcion);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err = $e->getMessage();
            return $e->getMessage();
        }
    }

    function deleteCatalogoSAT()
    {
        try {
            $query = "UPDATE catalogo_sat SET Estatus='Suspendido' WHERE c_FormaPago=:idSAT";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idSAT", $this->c_FormaPago);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err = $e->getMessage();
            return $e->getMessage();
        }
    }

    function getCountCatalogoSAT()
    {
        $query = "SELECT COUNT(c_FormaPago) as counts FROM catalogo_sat where Estatus='Activo'";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function saveCatalogoCFDI()
    {
        try {
            $query = "INSERT INTO catalogo_cfdi(c_UsoCFDI, Descripcion)VALUES(:idCFDI, :descCFDI)";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idCFDI", $this->c_FormaPago);
            $statement->bindParam(":descCFDI", $this->Descripcion);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err = $e->getMessage();
            return $e->getMessage();
        }
    }

    function updateCatalogoCFDI()
    {
        try {
            $query = "UPDATE catalogo_cfdi SET c_UsoCFDI=:idCFDI, Descripcion=:descCFDI WHERE c_UsoCFDI=:idCFDI";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idCFDI", $this->c_FormaPago);
            $statement->bindParam(":descCFDI", $this->Descripcion);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err = $e->getMessage();
            return $e->getMessage();
        }
    }

    function getIdCatalogoCFDI()
    {
        $query = "SELECT c_UsoCFDI, Descripcion FROM catalogo_cfdi WHERE c_UsoCFDI=:idCFDI";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idCFDI", $this->c_FormaPago);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteCatalogoCFDI()
    {
        try {
            $query = "UPDATE catalogo_cfdi SET Estatus='Suspendido' WHERE c_UsoCFDI=:idCFDI";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idCFDI", $this->c_FormaPago);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err = $e->getMessage();
            return $e->getMessage();
        }
    }


    function getCountCFDI()
    {
        $query = "SELECT COUNT(c_UsoCFDI) as counts FROM catalogo_cfdi where Estatus='Activo'";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    function getMessageERROR()
    {
        require_once('../diccionario.php');
        $sqlMessage = $this->msg_err;
        return getMessageSQL($sqlMessage);
    }
}
