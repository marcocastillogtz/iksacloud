<?php
class Poblacion
{
    private $idPoblacion;
    private $estatus;
    private $municipioId;
    private $estadoId;


    protected $db;

    private $poblacion;
    
    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }

    function setidPoblacion($idPoblacion)
    {
        $this->idPoblacion = $idPoblacion;
    }
    function getidPoblacion()
    {
        return $this->idPoblacion;
    }
    function setestatus($estatus)
    {
        $this->estatus = $estatus;
    }
    function getestatus()
    {
        return $this->estatus;
    }
    function setmunicipioId($municipioId)
    {
        $this->municipioId = $municipioId;
    }
    function getmunicipioId()
    {
        return $this->municipioId;
    }
    function setestadoId($estadoId)
    {
        $this->estadoId = $estadoId;
    }
    function getestadoId()
    {
        return $this->estadoId;
    }

    function setPoblacion($poblacion){
         $this->poblacion = $poblacion;
    }

    function Poblacion()
    {
        $query = "SELECT idPoblacion,poblacion FROM poblaciones WHERE estatus ='Activo' ORDER BY idPoblacion asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getMunicipioById()
    {
        $query = "SELECT idPoblacion,poblacion FROM poblaciones WHERE estatus ='Activo' AND municipio=:fkid ORDER BY idPoblacion asc";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':fkid', $this->municipioId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function savePoblacion() {
        $query = "INSERT INTO poblaciones(estatus,poblacion,municipio,estado)VALUES('Activo',:poblacion,:municipio,:estado);";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(":poblacion",$this->poblacion);
        $statement->bindParam(":municipio",$this->municipioId);
        $statement->bindParam(":estado",$this->estadoId);

        return $statement->execute();
    }

    function getPoblacionMunicipioById(){
        $query = "SELECT idPoblacion,estatus,poblacion,municipio,estado FROM poblaciones WHERE estado = :estado and municipio = :municipio and estatus='Activo';";

        $statement = $this->db->prepare($query);
        $statement->bindParam(":estado",$this->estadoId);
        $statement->bindParam(":municipio",$this->municipioId);  
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
        //return $statement->fetchAll(PDO::FETCH_ASSOC);
        //echo"SELECT idPoblacion,estatus,poblacion,municipio,estado FROM poblaciones WHERE estado = $this->estadoId and municipio = $this->municipioId ";
    }

    function updatePoblacion(){
        $query = "UPDATE poblaciones SET poblacion=:poblacion where idPoblacion = :idPoblacion";

        $statement = $this->db->prepare($query);
        $statement->bindParam(":idPoblacion",$this->idPoblacion);
        $statement->bindParam(":poblacion",$this->poblacion);

        return $statement->execute();
    }

    function deletePoblacion(){
        $query = "UPDATE poblaciones SET estatus ='Suspendido' where idPoblacion = :idPoblacion";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idPoblacion",$this->idPoblacion);

        return $statement->execute();
    }

}
