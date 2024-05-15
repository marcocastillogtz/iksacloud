<?php

    class XLScartaPorte{
        private $id;
        private $cliente;
        private $pedido;
        private $folio_parent;
        private $layout_r;
        private $layout_f;
        private $documento;
        private $estatusCobranza;
        private $estatusDoc;
        private $cr;
        private $ar;
        private $sr;
        private $cf;
        private $af;
        private $sf;
        private $fap;
        private $fve;
        private $fapr;
        private $fver;
        private $aplicacion;
        private $clasificacion;
        private $observacion;

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

        
        function setCliente($cte){
            $this->cliente = $cte;
        }

        function getCliente(){
            return $this->cliente;
        }


        function setPedido($ped){
            $this->pedido = $ped;
        }

        function getPedido(){
            return $this->pedido;
        }

        function setFolioParent($folParent){
            $this->folio_parent = $folParent;
        }

        function getFolioParent(){
            return $this->folio_parent;
        }


        function setLayoutR($layoutR){
            $this->layout_r = $layoutR;
        }
        function getLayoutR(){
            return $this->layout_r;
        }


        function setLayoutF($layoutF){
            $this->layout_f = $layoutF;
        }
        function getLayoutF(){
            return $this->layout_f;
        }


        function setDocumento($doc){
            $this->documento = $doc;
        }
        function getDocument(){
            return $this->documento;
        }

        function setEstatusCobranza($statusCobranza){
            $this->estatusCobranza = $statusCobranza;
        }
        function getEstatusCobranza(){
            return $this->estatusCobranza;
        }


        function setEstatusDoc($statusDoc){
            $this->estatusDoc = $statusDoc;
        }
        function getEstatusDoc(){
            return $this->estatusDoc;
        }


        function setCR($CR){
            $this->cr = $CR;            
        }
        function getCR(){
            return $this->cr;
        }


        function setAR($AR){
            $this->ar = $AR;
        }

        function getAR(){
            return $this->ar;
        }

    
        function setSR($SR){
            $this->sr =$SR;
        }
        function getSR(){
            return $this->sr;
        }


        function setCF($CF){
            $this->cf = $CF;
        }
        function getCF(){
            return $this->cf;
        }


        function setAF($AF){
            $this->af = $AF;
        }
        function getAF(){
            return $this->af;
        }


        function setSF($SF){
            $this->sf = $SF;
        }
        function getSF(){
            return $this->sf;            
        }


        function setFAP($FAP){
            $this->fap = $FAP;
        }
        function getFAP(){
            return $this->fap;
        }


        function setFVE($FVE){
            $this->fve = $FVE;            
        }
        function getFVE(){
            return $this->fve;
        }


        function setFAPR($FAPR){
            $this->fapr = $FAPR;
        }
        function getFAPR(){
            return $this->fapr;
        }   



        function setFVER($FVER){
            $this->fver = $FVER;
        }

        function getFVER(){
            return $this->fver;   
        }

        function setAplicacion($apli) {
            $this->aplicacion = $apli;
        }
        function getAplicacion(){
            return $this->aplicacion;
        }
        
        function setClasificacion($clas) {
            $this->clasificacion = $clas;
        }
        function getClasificacion(){
            return $this->clasificacion;
        }


        function setObservacion($obs){
            $this->observacion = $obs;
        }
        function getObservacion(){
            return $this->observacion;
        }
        

        function getRelacionDocs(){
            $query = "SELECT xlscartaporte.id,pedido.metodo_envio,pedido.folio,xlscartaporte.layout_r,xlscartaporte.layout_f,xlscartaporte.documento FROM xlscartaporte
            INNER JOIN pedido ON pedido.id = xlscartaporte.pedido";

            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        }

    }
