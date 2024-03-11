<?php

class Esquema
{
    private $id_esquema;
    private $id_cliente;
    private $precio_lista;
    private $documento;
    private $hora;
    private $fecha;
    private $estatus;
    private $tipo;
    private $comision_esq;

    private $msg_err_Esq;

    private $startIndex;
    private $perPage;

    protected $db;
    protected $codigo;

    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }

    function setid_Esquema($id_esquema)
    {
        $this->id_esquema = $id_esquema;
    }
    function getid_Esquema()
    {
        return $this->id_esquema;
    }

    function setid_Cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }
    function getid_Cliente()
    {
        return $this->id_cliente;
    }

    function setPrecioLista($precio_lista)
    {
        $this->precio_lista = $precio_lista;
    }
    function getPrecioLista()
    {
        return $this->precio_lista;
    }

    function setDocumento($documento)
    {
        $this->documento = $documento;
    }
    function getDocumento()
    {
        return $this->documento;
    }

    function setHora($hora)
    {
        $this->hora = $hora;
    }
    function getHora()
    {
        return $this->hora;
    }

    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    function getFecha()
    {
        return $this->fecha;
    }

    function setEstatus($estatus)
    {
        $this->estatus = $estatus;
    }
    function getEstatus()
    {
        return $this->estatus;
    }

    function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
    function getTipo()
    {
        return $this->tipo;
    }

    function setComisionEsq($comision_esq)
    {
        $this->comision_esq = $comision_esq;
    }
    function getComisionEsq()
    {
        return $this->comision_esq;
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


    function getEsquema()
    {
        $query = "SELECT nombre_completo, esquema.* FROM cliente INNER JOIN esquema ON cliente.id_cliente=esquema.cliente ORDER BY id asc LIMIT :startIndex,:perPage";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":startIndex", $this->startIndex, PDO::PARAM_INT);
        $statement->bindParam(":perPage", $this->perPage, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getIdEsquema()
    {
            $query = "SELECT nombre_completo, esquema.* FROM cliente INNER JOIN esquema ON cliente.id_cliente=esquema.cliente WHERE id=:idEsq";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idEsq", $this->id_esquema);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateEsquema()
    {
        try {
            // $query = "UPDATE esquema SET precio_lista=:preLista, estatus=:estEsq, comision_esquema=:comEsq WHERE id=:idEsq";
            $query = "UPDATE esquema SET estatus=:estEsq WHERE id=:idEsq";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":estEsq", $this->estatus);
            // $statement->bindParam(":preLista", $this->precio_lista);
            // $statement->bindParam(":comEsq", $this->codigo);
            $statement->bindParam(":idEsq", $this->id_esquema);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err_Esq = $e->getMessage();
            return $e->getMessage();
        }
    }

    function getClienteEsquema()
    {
        $query = "SELECT DISTINCT nombre_completo, cliente FROM cliente INNER JOIN esquema ON cliente.id_cliente=esquema.cliente";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getEsquemaDocum()
    {
        $query = "SELECT id, precio_lista, estatus, tipo, comision_esquema FROM esquema WHERE cliente=:idCliente AND documento=:doc";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idCliente", $this->id_cliente);
        $statement->bindParam(":doc", $this->documento);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCountEsquema()
    {
        $query = "SELECT COUNT(id) as counts FROM esquema";
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