<?php 
    class Almacen {
        protected $db;

        private $id;
        private $clave;
        private $cantidad;
    

        public function __construct(){
            require_once("DBC.php");
            $object_connection = new DataBaseConnection();
            $this->db = $object_connection->connect();
        }

        function setId($idd)
        {
            $this->id = $idd;
        }

        function getId()
        {
            return $this->id;
        }


        function setClave($clavee){
            $this->clave = $clavee;
        }

        function getClave(){
            return $this->clave;
        }


        function setCantidad($cantidadd){
            $this->cantidad = $cantidadd;
        }

        function getCantidad(){
            return  $this->cantidad;
        }


        function getPackage(){
            $query = "SELECT id,clave,cantidad FROM almacen WHERE clave = :clave";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":clave", $this->clave);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC); 
        }


}