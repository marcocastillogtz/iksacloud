<?php
class Permisos
{
    private $id;
    private $usuario;
    private $modulo;
    protected $db;

    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }

    function setId($id){
        $this->id = $id;
    }

    function getId(){
        return $this->id;
    }

    function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    function setModulo($modulo){
        $this->modulo = $modulo;
    }

    function getModulo(){
        return $this->modulo;
    }

    function getPermisos(){
        $sql = "SELECT * FROM permisos WHERE usuario = :user ";
        $stmt = $this->db->prepare($sql);
        // $stmt->bindParam(':modulo', $this->modulo);
        $stmt->bindParam(':user', $this->usuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    function addColumn($column){
        $query = "ALTER TABLE permisos ADD COLUMN $column ENUM('Enable','Disabled') DEFAULT 'Disabled';";
        $statement = $this->db->prepare($query);
        return $statement->execute();
    }

}
