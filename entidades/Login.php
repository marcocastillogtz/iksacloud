<?php
class login
{
    private $id;
    private $estatus;
    private $usuario;
    private $contrasena;
    private $clasificacion;
    private $texto;
    private $fk_usuario;
    private $roll;
    private $cliente_asignado;
    private $log;
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

    function setEstatus($estatus)
    {
        $this->estatus = $estatus;
    }
    function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    
    function getUsuario(){
        return $this->usuario;
    }

    function setcontrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    function setClasificacion($clasificacion)
    {
        $this->clasificacion = $clasificacion;
    }

    function setTexto($texto)
    {
        $this->texto = $texto;
    }

    function setFK_User($fk_usuario)
    {
        $this->fk_usuario = $fk_usuario;
    }

    function setRoll($roll)
    {
        $this->roll = $roll;
    }

    function setClienteAsignado($cliente_asignado)
    {
        $this->cliente_asignado = $cliente_asignado;
    }

    function setLog($log){
        $this->log = $log;
    }

    function setUrl($url)
    {
        $this->url = $url;
    }



    function saveLog(){
        $query = "INSERT INTO login (USUARIO,CONTRASENA,USUARIO_FK) 
        VALUES(:user,:pswd,:fk_user)";
        $statement = $this->db->prepare($query);

        $statement->bindParam(":user",$this->usuario);
        $statement->bindParam(":pswd",$this->contrasena);
        $statement->bindParam(":fk_user",$this->fk_usuario);

        return $statement->execute();
    }


    function updateStatus(){
        $query = "UPDATE login SET log = :status WHERE usuario = :fk_user";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":status",$this->log);
        $statement->bindParam(":fk_user",$this->usuario);
        return $statement->execute();
    }


    function getLogUser(){
        $query = "SELECT * FROM login WHERE usuario = :user AND contrasena = :keysecret";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":user",$this->usuario);
        $statement->bindParam(":keysecret",$this->contrasena);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getPermission(){
        $query = "SELECT * FROM usuario u inner join login l on l.usuario_fk = u.ID inner join roles r on l.roll = r.nivel inner join permisos p on l.id_registro = p.usuario order by r.nivel asc";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getLooter1(){
        $query = "SELECT * FROM (SELECT @primid_loot := :status) ALIAS, LOOTER;";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":status",$this->estatus);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getLooter2(){
        $query = "SELECT * FROM (SELECT @primid_loot := :status) ALIAS, LOOTER;";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":status",$this->estatus);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getLooter3(){
        $query = "SELECT * FROM (SELECT @primid_loot := :status) ALIAS, LOOTER;";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":status",$this->estatus);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
