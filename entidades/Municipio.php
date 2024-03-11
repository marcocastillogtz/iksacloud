<?php
class Municipios
{

    protected $db;
    private $idMunicipio;
    private $estatus;
    private $municipio;
    private $idestado;

    private $estado;

    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }

    function setidMunicipio($idMunicipio)
    {
        $this->idMunicipio = $idMunicipio;
    }
    function getidMunicipio()
    {
        return $this->idMunicipio;
    }
    function setestatus($estatus)
    {
        $this->estatus = $estatus;
    }
    function getestatus()
    {
        return $this->estatus;
    }
    function setmunicipio($municipio)
    {
        $this->municipio = $municipio;
    }
    function getmunicipio()
    {
        return $this->municipio;
    }
    function setidestado($idestado)
    {
        $this->idestado = $idestado;
    }
    function getidestado()
    {
        return $this->idestado;
    }

   
    function setEstado($estado){
        return $this->estado = $estado;
    }


    function Municipios()
    {
        $query = "SELECT idMunicipio,municipio FROM municipios WHERE estatus ='Activo' ORDER BY idMunicipio asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getMunicipioById() {
        $query = "SELECT idMunicipio,municipio FROM municipios WHERE estatus ='Activo' AND estado=:fkid ORDER BY idMunicipio asc";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':fkid', $this->idestado);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function saveMunicipio() {
        /*
        $query = "INSERT INTO municipios(estatus,estado) values('Activo',:estado)";
        $statement = $this->db->prepare($query);
        // $statement->bindParam(':municipio', $this->municipio);
        $statement->bindParam(':estado', $this->estado);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
        */
        $query = "INSERT INTO municipios(estatus,municipio,estado)VALUES('Activo',:municipio,:estado);";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(":municipio",$this->municipio);
        $statement->bindParam(":estado",$this->estado);
        

        return $statement->execute();
    }

    function getMunicipios(){
        $query = "SELECT idMunicipio,municipio,estados.estado FROM municipios INNER JOIN  estados ON municipios.estado = estados.id_Estado WHERE municipios.estado = :setidestado AND municipios.estatus = 'Activo' ORDER BY municipio";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":setidestado",$this->idestado);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateMunicipio(){
        $query = "UPDATE municipios SET municipio=:clv where idMunicipio = :idPart";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idPart",$this->idMunicipio);
        $statement->bindParam(":clv",$this->municipio);

        return $statement->execute();
    }


    function deleteMunicipio() {
        //$query = "UPDATE municipios SET estatus='Suspendido' WHERE idMunicipio = :idPart";
        $query = "UPDATE municipios SET estatus='Suspendido' where idMunicipio = :idPart";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idPart",$this->idMunicipio);

        return $statement->execute();
    }
}
