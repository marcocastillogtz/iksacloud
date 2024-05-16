<?php
    class surtirPedido {
        private $idSurtirP;
        private $almacen;
        private $usuario;
        private $porcentaje;
        private $horaAsignada;
        private $horaInicio;
        private $horaFinal;
        private $tiempoEstimado;
        private $autorizado;
        private $idPedido;
        private $observacion;
        private $token;
        private $msg_err;

        protected $db;


        public function __construct()
        {
            require_once("DBC.php");
            $object_connection = new DataBaseConnection();
            $this->db = $object_connection->connect();
        }
    


        function setIdSurtirPedido($idSurtirPedido)
        {
            $this->idSurtirP = $idSurtirPedido;
        }
    
        function getIdSurtirPedido()
        {
            return $this->idSurtirP;
        }


        function setAlmacen($almacenn){
            $this->almacen = $almacenn;            
        }
        function getAlmacen(){
            return $this->almacen;
        }


        function setUsuario($usuarioo){
            $this->usuario = $usuarioo;
        }
        function getUsuario(){
            return $this->usuario;
        }


        function setPorcentaje($porcentajee){
            $this->porcentaje = $porcentajee;
        }
        function getPorcentaje(){
            return $this->porcentaje;
        }



        function setHoraAsignada($horaAsignadaa){
            $this->horaAsignada = $horaAsignadaa;
        }
        function getHoraAsignada(){
            return $this->horaAsignada;
        }


        function  setHoraInicio($horaInicioo){
            $this->horaInicio = $horaInicioo;
        }
        function getHoraInicio(){
            return $this->horaInicio;
        }


        function setHoraFinal($horaFinall){
            $this->horaFinal = $horaFinall;
        }
        function getHoraFinal(){
            return $this->horaFinal;
        }

        function setTiempoEstimado($tiempoEstimadoo){
            $this->tiempoEstimado = $tiempoEstimadoo;
        }

        function getTiempoEstimado(){
            return $this->tiempoEstimado;
        }



        function setAutorizado($autorizadoo){
            $this->autorizado = $autorizadoo;
        }

        function getAutorizado(){
            return $this->autorizado;
        }


        function setIdPedido($idPedidoo){
            $this->idPedido = $idPedidoo;
        }
        function getIdPedido() {
            return $this->idPedido;
        }

        
        function setObservaciones($observaciones){
            $this->observacion = $observaciones;
        }

        function getObservaciones(){
            return $this->observacion;
        }
        

        function setToken($tokenn){
            $this->token = $tokenn;
        }
        function getToken(){
            return $this->token;
        }


        function getErrSQL()
        {
            return $this->msg_err;
        }

        function saveLooter() {
            $query = "CALL register_looter(:token,:orden);";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":token",$this->token);
            $statement->bindParam(":orden",$this->idPedido);
            //return $statement->execute();
            // echo'CALL register_looter('.$this->token.','.$this->idPedido.')';
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        

        function autorizarPedido() {
            try {
                // $query = "UPDATE SURTIR_PEDIDO SET hora_final=CURRENT_TIMESTAMP(), AUTORIZADO=1, TIEMPO_ESTIMADO=CONCAT_WS(' ',TIMEDIFF(hora_final,hora_inicio),'min'), OBSERVACION='$var_observacion' WHERE id_pedido=$var_id AND USUARIO=$var_usuario;";
                $query = "UPDATE surtir_pedido SET hora_final=CURRENT_TIMESTAMP(),autorizado = 1,tiempo_estimado=CONCAT_WS(' ',TIMEDIFF(hora_final,hora_inicio),'min'), observacion=:observacioness WHERE id_pedido =:idd AND usuario = :usuario;";
                $statement =  $this->db->prepare($query);
                $statement->bindParam(":idd",$this->idSurtirP,PDO::PARAM_INT);
                $statement->bindParam(":usuario",$this->usuario,PDO::PARAM_INT);
                $statement->bindParam(":observacioness",$this->observacion,PDO::PARAM_STR);
                
                // $statement->bindParam(":porcentaje",$this->porcentaje,PDO::PARAM_INT);
                return $statement->execute();          
    
            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
            }
        }

        function getPedidoProgress() {
            $query = "SELECT * FROM surtiendo;";
            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        }
    }