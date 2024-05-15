<?php
    class Logistica
    {
        private $id_logistica;
        private $logistica;
        private $web;
        private $telefono;
  
        protected $db;


        public function __construct()
        {
            require_once("DBC.php");
            $object_connection = new DataBaseConnection();
            $this->db = $object_connection->connect();
        }


        function setIdLogistica($idLog)
        {
            $this->id_logistica = $idLog;
        }
    
        function getIdLogistica(){
            return $this->id_logistica;
        }



        function setLogistica($logistica)
        {
            $this->logistica = $logistica;
        }
    
        function getLogistica(){
            return $this->logistica;
        }


        function setWeb($web)
        {
            $this->web = $web;
        }
    
        function getWeb(){
            return $this->web;
        }


        function setTelefono($tel)
        {
            $this->telefono = $tel;
        }
    
        function getTelefono(){
            return $this->telefono;
        }

        function fillSelectLogistica() {
            $query = "SELECT logistica from logistica ORDER BY logistica ASC;";
            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>