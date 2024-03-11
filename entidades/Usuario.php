<?php

class Usuario{
    private $id;
    private $name;
    private $middleName;
    private $lastName;
    private $email;
    private $phone;
    protected $db;
    public function __construct()
    {
        require_once("DBC.php");
        $database_object = new DataBaseConnection();
        $this->db = $database_object->connect();
    } 

    function setId($id){
        $this->id = $id;
    }

    function getId(){
        return $this->id;
    }

    function setName($name){
        $this->name = $name;
    }

    function getName(){
        return $this->name;
    }
    function setMiddleName($middleName){
        $this->middleName = $middleName;
    }

    function getMiddleName(){
        return $this->middleName;
    }

    function setLastName($lastName){
        $this->lastName = $lastName;
    }

    function getLastName(){
        return $this->lastName;
    }
    
    function setEmail($email){
        $this->email = $email;
    }

    function getEmail(){
        return $this->email;
    }

    function setPhone($phone){
        $this->phone = $phone;
    }

    function getPhone(){
        return $this->phone;
    }

    function saveUser(){
        $query = "INSERT INTO usuario (ID,NOMBRE,APELLIDO_P,APELLIDO_M,CORREO,TELEFONO) 
        VALUES(:id,:uname,:middlename,:lastname,:email,:phone)";

        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':uname', $this->name);
        $statement->bindParam(':middlename', $this->middleName);
        $statement->bindParam(':lastname', $this->lastName);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':phone', $this->phone);

        return $statement->execute();
    }

    function getUsers(){
        $query ="SELECT CONCAT_WS(' ',usuario.NOMBRE,usuario.APELLIDO_P,usuario.APELLIDO_M) AS USUARIO,usuario.ID  FROM usuario
        INNER JOIN login ON login.usuario_fk = usuario.id WHERE login.roll = 3 ORDER BY usuario asc;";
        
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
}   
?>