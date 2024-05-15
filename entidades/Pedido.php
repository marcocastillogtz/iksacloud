<?php

    class Pedido
    {
        private $db;
        private $id;
        private $cliente;
        private $vendedor;
        private $fecha;
        private $hora;
        private $documento;
        private $estatus;
        private $observacion;
        private $metodo_envio;
        private $folio;
        private $movimiento;
        private $guia;
        private $logistica;
        private $prioridad;
        private $usuario;
        private $autorizado;
        private $precioIva;
        private $cantidad;
        private $monto;
        private $restrinccion;
        private $famOferta;
        private $listaPrecio;
        private $envio;
        private $clave;
        private $descripcion = '';
        private $pieza;
        private $paquete; 
        private $emblema;
        private $estatusDevolucion;
        private $almacenA;
        private $almacenB;

        private $msg_err;
        private $fecha2;

        private $factura;
        private $remision;
        private $comment;

        private $banco;

        public function __construct()
        {
            require_once("DBC.php");
            $database_object = new DatabaseConnection();
            $this->db = $database_object->connect();
        }

        function getErrSQL()
        {
            return $this->msg_err;
        }
        
        function setId($id)
        {
            $this->id = $id;
        }
    

        function getId()
        {
            return $this->id;
        }

        function setCliente($cliente)
        {
            $this->cliente = $cliente;
        }

        function getcliente()
        {
            return $this->cliente;
        }

        function setVendedor($vendedor)
        {
            $this->vendedor = $vendedor;
        }

        function getVendedor()
        {
            return $this->vendedor;
        }

        function setFecha($fecha)
        {
            $this->fecha = $fecha;
        }

        function getFecha()
        {
            return $this->fecha;
        }

        function setHora($hora)
        {
            $this->hora = $hora;
        }

        function getHora()
        {
            return $this->hora;
        }

        function setDocumento($documento)
        {
            $this->documento = $documento;
        }

        function getDocumento()
        {
            return $this->documento;
        }

        function setEstatus($estatus)
        {
            $this->estatus = $estatus;
        }

        function getEstatus()
        {
            return $this->estatus;
        }

        function setObservacion($observacion)
        {
            $this->observacion = $observacion;
        }

        function getObservacion()
        {
            return $this->observacion;
        }

        function setMetodoEnvio($metodo_envio)
        {
            $this->metodo_envio = $metodo_envio;
        }

        function getMetodoEnvio()
        {
            return $this->metodo_envio;
        }

        function setFolio($folio)
        {
            $this->folio = $folio;
        }

        function getFolio()
        {
            return $this->folio;
        }

        function setUsuario($usuario)
        {
            $this->usuario = $usuario;
        }

        function getUsuario()
        {
            return $this->usuario;
        }

        function setAutorizado($autorizado)
        {
            $this->autorizado = $autorizado;
        }

        function getAutorizado()
        {
            return $this->autorizado;
        }

        function closeConnectio()
        {
            $this->db = null;
        }
    
        function setPrecioIva($precioIva){
            $this->precioIva = $precioIva;
        }
        function getPrecioIva(){
            return $this->precioIva;
        }


        function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }
        function getCantidad(){
            return $this->cantidad;
        }


        function setMonto($monto) {
            $this->monto = $monto;
        }
        function getMonto(){
            return $this->monto;
        }


        function setRestriccion($restrinccion){
            $this->restrinccion = $restrinccion;
        }
        function getRestrinccion() {
            return $this->restrinccion;
        }

        
        function setFamOferta($famOfertaa) {
            $this->famOferta = $famOfertaa;
        }
        function getFamOferta(){
            return $this->famOferta;
        }
        
        
        function setListaPrecio($listaPrecio) {
            $this->listaPrecio = $listaPrecio;
        }
        function getListaPrecio(){
            return $this->listaPrecio;
        }
        
        
        function setEnvio($envio){
            $this->envio = $envio;
        }
        function getEnvio(){
            return $this->envio;
        }


        function setClave($clave){
            $this->clave = $clave;
        }
        function getClave(){
            return $this->clave;
        }


        function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        function getDescripcion(){
            return $this->descripcion;
        }

        
        function setMovimiento($mov){
            $this->movimiento = $mov;    
        }
        function getMovimiento(){
            return $this->movimiento;
        }


        function setGuia($guia) {
            $this->guia = $guia;
        }
        function getGuia(){
            return $this->guia;
        }


        function setLogistica($logistica){
            $this->logistica = $logistica;    
        }
        function getLogistica(){
            return $this->logistica;
        }
        
        function setPrioridad($prioridad){
            $this->prioridad = $prioridad;
        }
        function getPrioridad(){
            return $this->prioridad;
        }

        function setPieza($pieza){
            $this->pieza = $pieza;
        }
        function gePieza(){
            return $this->pieza;        
        }


        function setPaquete($paquete){
            $this->paquete = $paquete;
        }
        function getPaquete(){
            return $this->paquete;
        }

        function setEmblema($emblema){
            $this->emblema = $emblema;
        }

        function getEmblema(){
            return $this->emblema;
        }


        function setEstatusDevolucion($estatusDevolucion){
            $this->estatusDevolucion = $estatusDevolucion;
        }

        function getFuncion(){
            return $this->estatusDevolucion;
        }


        function setAlmacenA($almacenA){
            $this->almacenA = $almacenA;
        }
        function getAlmacenA(){
            return $this->almacenA;
        }


        function setAlmacenB($almacenB) {
            $this->almacenB = $almacenB;
        }
        function getAlmacenB(){
            return $this->almacenB;    
        }


        function setFecha2($fecha2)
        {
            $this->fecha2 = $fecha2;
        }

        function getFecha2()
        {
            return $this->fecha;
        }

        
        
        // $Pedido->setFactura($_GET['fac']);
        // $Pedido->setRemision($_GET['rem']);
        // $Pedido->setComment($_GET['comment']);

        function setFactura($fact){
            $this->factura = $fact;
        }
        function getFactura(){
            return $this->factura;
        }


        function setRemision($rem){
            $this->remision = $rem;
        }
        function getRemision(){
            return $this->remision;
        }


        function setComment($comment){
            $this->comment = $comment;
        }
        function getComment(){
            return $this->comment;
        }


        function setBanco($bank){
            $this->banco = $bank;
        }

        function getBanco(){
            return $this->banco;
        }

        function saveOrder()
        {
            $query = "INSERT INTO pedido (id, cliente, vendedor, fecha, hora, documento,estatus,observacion,metodo_envio,folio)
            VALUES (:id_order,:client_id,:seller_id,:date_order,:time_order,:document,:status_order,:note,:method_send,:folio)";

            $statement = $this->db->prepare($query);
            $statement->bindParam(':id_order', $this->id);
            $statement->bindParam(':client_id', $this->cliente);
            $statement->bindParam(':seller_id', $this->vendedor);
            $statement->bindParam(':date_order', $this->fecha);
            $statement->bindParam(':time_order', $this->hora);
            $statement->bindParam(':document', $this->documento);
            $statement->bindParam(':status_order', $this->estatus);
            $statement->bindParam(':note', $this->observacion);
            $statement->bindParam(':method_send', $this->metodo_envio);
            $statement->bindParam(':folio', $this->folio);

            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }

        function get_all_new_orders()
        {
            $query = "SELECT * FROM pedido ORDER BY id DESC";
            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function getIdOrder() {
            //$hora=null;
            // $mifecha =new DateTime();
            // $mifecha->modify('-4 hours');
            // $mifecha->modify('-59 minute');
            // $mifecha->modify('-59 second');
            // $hora=$mifecha->format('H:i:s');
            date_default_timezone_set('America/Mexico_City');
            $hora = date('h:i:s');

            $var_statusOferta='S/O';
            $query="CALL PEDIDO_ID(:cliente,:vendedor,:documento,:clave,:descripcion,:precioIva,
            :cantidad,:monto,:restrinccion,:famOferta,:statusOferta,:listaPrecio,:hora);";

            $statement = $this->db->prepare($query);
            $statement->bindParam(':cliente',$this->cliente,PDO::PARAM_INT);
            $statement->bindParam(':vendedor',$this->vendedor);
            $statement->bindParam(':documento',$this->documento,PDO::PARAM_INT);
            $statement->bindParam(':clave',$this->clave);
            $statement->bindParam(':descripcion',$this->descripcion);
            $statement->bindParam(':precioIva',$this->precioIva,PDO::PARAM_INT);
            $statement->bindParam(':cantidad',$this->cantidad,PDO::PARAM_INT);
            $statement->bindParam(':monto',$this->monto,PDO::PARAM_INT);
            $statement->bindParam(':restrinccion',$this->restrinccion);
            $statement->bindParam(':famOferta',$this->famOferta,PDO::PARAM_INT);
            $statement->bindParam(':statusOferta',$var_statusOferta);
            $statement->bindParam(':listaPrecio',$this->listaPrecio,PDO::PARAM_INT);
            $statement->bindParam(':hora',$hora);
            return $statement->execute();

        }

        
        function searchObservacion(){
            $query="SELECT OBSERVACION FROM PEDIDO WHERE ID=:id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":id",$this->id,PDO::PARAM_INT);

            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function getTotal() {
            $query="CALL TOTAL(:id);";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":id",$this->id,PDO::PARAM_INT);

            $statement->execute();
        }

        function selectFilter(){
            // $searchOrder = "SELECT * FROM PEDIDO WHERE ID=" . $var_id . " AND (ESTATUS='AT' OR ESTATUS='PS')";
            // echo"SELECT * FROM PEDIDO WHERE ID='$this->id' AND (ESTATUS='AT' OR ESTATUS='PS')";


            $query="SELECT * FROM PEDIDO WHERE ID=:id AND (ESTATUS='AT' OR ESTATUS='PS')";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":id",$this->id,PDO::PARAM_INT);

            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        }

        function enviarPedido(){
            try {
                $query="UPDATE pedido SET estatus = 'PS', prioridad = :prioridad WHERE id=:id;";
                // echo "UPDATE pedido SET estatus = 'PS', prioridad = $this->prioridad WHERE id=$this->id;";
                $statement = $this->db->prepare($query);
                $statement->bindParam(":id",$this->id,PDO::PARAM_INT);
                $statement->bindParam(":prioridad",$this->prioridad);
                return $statement->execute();
            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
                return $e->getMessage();
            }
        }


        function genReport(){
            // echo 'SELECT * FROM (SELECT @primid_pedido := {'.$this->id.'} PEDIDO) alias, VISTA_REPORTPEDIDO';
            
            $query = "SELECT * FROM (SELECT @primid_pedido := :idd PEDIDO) alias, VISTA_REPORTPEDIDO;";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);

            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
            
        }

        function genReportPiezas(){
            // SELECT * FROM (SELECT @primid_pedido :={$var_id} PEDIDO) alias, VISTA_REPORTPEDIDO;
            $query = "SELECT * FROM (SELECT @primid_pedido :=:idd PEDIDO) alias, VISTA_REPORTPEDIDO";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);

            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        }

        function genReportEmblemas(){
            // SELECT * FROM (SELECT @primid_pedido :={$var_id} PEDIDO) alias, VISTA_REPORTPEDIDO;
            $query = "SELECT * FROM (SELECT @primid_pedido :=:idd PEDIDO) alias, VISTA_REPORTPEDIDO";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);

            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        }

        function genReportPaqueteria(){
            $query = "SELECT * FROM (SELECT @primid_pedido :=:idd PEDIDO) alias, VISTA_REPORTPEDIDO";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);

            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        
        
        function deleteDepositosAut(){
            $query = "UPDATE pedido SET estatus ='DLT' WHERE id=:idd;";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);
            
            return $statement->execute();
        }

        function showPedidosEspera(){
            try {
                $query = "SELECT * FROM VISTA_PEDIDOPORAUTORIZAR";
                $statement = $this->db->prepare($query);
                
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
                return $e->getMessage();
            }
        }


        function historialPedidos(){
            try {
                $query = "CALL getHisorialPedido()";
                $statement = $this->db->prepare($query);

                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
                
            } catch (PDOException  $e) {
                $this-> msg_err = $e->getMessage();
                return $e->getMessage();
            }    
        }

        function buscarPedido(){
            try {
                $query = "CALL historialFilters(:vendedor,:cliente,:estatus,:fecha);";
                // CALL historialFilters(21,'640','AT','2024-02-23');
                //echo"CALL historialFilters($this->vendedor,$this->cliente,$this->estatus,$this->fecha);";

                $statement = $this->db->prepare($query);
                $statement->bindParam(":vendedor",$this->vendedor,PDO::PARAM_STR_CHAR);
                $statement->bindParam(":cliente",$this->cliente,PDO::PARAM_STR_CHAR);
                $statement->bindParam(":estatus",$this->estatus,PDO::PARAM_STR_CHAR);
                $statement->bindParam(":fecha",$this->fecha,PDO::PARAM_STR_CHAR);

                
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
                return $e->getMessage();
            }    
        }


        function showOrderBack(){
            try {
        
                if ($this->clave == "*") {
            
                    $query="SELECT DISTINCT(PEDIDO.FOLIO),CLIENTE.NOMBRE_COMPLETO,PEDIDO.FECHA,DATEDIFF(NOW(),PEDIDO.FECHA) AS RETRASO,PEDIDO.DOCUMENTO,PEDIDO.ID FROM PEDIDO
                    INNER JOIN DETALLE_PEDIDO ON PEDIDO.FOLIO = DETALLE_PEDIDO.FOLIO
                    INNER JOIN cliente ON PEDIDO.CLIENTE =cliente.ID_CLIENTE
                    WHERE PEDIDO.FOLIO != NULL || PEDIDO.FOLIO !=''
                    AND pedido.ID=detalle_pedido.ID_DETALLE AND (DETALLE_PEDIDO.ESTATUS='EN' OR DETALLE_PEDIDO.ESTATUS='FT')
                    AND DETALLE_PEDIDO.CANTIDAD>0 ORDER BY RETRASO ASC;";
                } else {
                    $query="SELECT DISTINCT(PEDIDO.FOLIO),CLIENTE.NOMBRE_COMPLETO,PEDIDO.FECHA,DATEDIFF(NOW(),PEDIDO.FECHA) AS RETRASO,PEDIDO.DOCUMENTO,PEDIDO.ID FROM PEDIDO
                    INNER JOIN DETALLE_PEDIDO ON PEDIDO.FOLIO = DETALLE_PEDIDO.FOLIO
                    INNER JOIN cliente ON PEDIDO.CLIENTE =cliente.ID_CLIENTE
                    WHERE PEDIDO.FOLIO != NULL || PEDIDO.FOLIO !=''
                    AND PEDIDO.FECHA=DETALLE_PEDIDO.FECHA AND (DETALLE_PEDIDO.ESTATUS='EN' OR DETALLE_PEDIDO.ESTATUS='FT')
                    AND DETALLE_PEDIDO.CANTIDAD>0 AND DETALLE_PEDIDO.CLAVE=':clave' ORDER BY RETRASO ASC;";
                }
                    
                $statement = $this->db->prepare($query);
                $statement->bindParam(":clave",$this->clave,PDO::PARAM_INT);

                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
                return $e->getMessage();
            }
        }
        
        function showProductsDemand(){
            
            try {
                $query="SELECT SUM(DETALLE_PEDIDO.cantidad) AS CANTIDAD,COUNT(DISTINCT(DETALLE_PEDIDO.cliente))AS NCLIENTE,DETALLE_PEDIDO.CLAVE 
                FROM detalle_pedido 
                INNER JOIN PEDIDO ON PEDIDO.FOLIO = DETALLE_PEDIDO.FOLIO
                WHERE PEDIDO.FOLIO != NULL || PEDIDO.FOLIO !='' AND DETALLE_PEDIDO.CANTIDAD>0 AND DETALLE_PEDIDO.ESTATUS='EN' OR DETALLE_PEDIDO.ESTATUS='FT'
                GROUP BY DETALLE_PEDIDO.CLAVE  ORDER BY CANTIDAD DESC;";

                $statement = $this->db->prepare($query);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
                return $e->getMessage();
            }
        
        }

        function getDetallePedidoBackOrder(){
            try {
                // $query="SELECT FOLIO,CLAVE,CANTIDAD,ID_DETALLE,ESTATUS_OFERTA,ID FROM DETALLE_PEDIDO WHERE FOLIO=:folio AND CANTIDAD > 0;";
                $query="SELECT FOLIO,CLAVE,CANTIDAD,ID_DETALLE,ESTATUS_OFERTA,ID FROM DETALLE_PEDIDO WHERE FOLIO=:folio AND CANTIDAD > 0 AND estatus NOt LIKE'%DLT%';";
                $statement = $this->db->prepare($query);
                $statement->bindParam(":folio",$this->folio,PDO::PARAM_STR);

                //echo$query="SELECT FOLIO,CLAVE,CANTIDAD,ID_DETALLE,ESTATUS_OFERTA FROM DETALLE_PEDIDO WHERE FOLIO='$this->folio' AND CANTIDAD > 0;";
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);


            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
                return $e->getMessage();
            }
        }
        

        function getLP(){
            $query="SELECT DISTINCT(DETALLE_PEDIDO.PRECIOLISTA) AS LP,PEDIDO.FOLIO,PEDIDO.CLIENTE,PEDIDO.VENDEDOR,PEDIDO.DOCUMENTO,PEDIDO.ESTATUS,DETALLE_PEDIDO.ID_DETALLE,DETALLE_PEDIDO.ESTATUS_OFERTA   
            FROM PEDIDO 
            INNER JOIN DETALLE_PEDIDO ON PEDIDO.ID = DETALLE_PEDIDO.ID_DETALLE
            WHERE PEDIDO.FOLIO=:folio;";
            
            $statement = $this->db->prepare($query);
            $statement->bindParam(":folio",$this->folio,PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        }


        function actualizarPedido() {
            try {
                $query="UPDATE PEDIDO SET ESTATUS='E', METODO_ENVIO=:metodoEnvio WHERE ID=:id AND ESTATUS='P';";
                $statement = $this->db->prepare($query);
                $statement->bindParam(":id",$this->id,PDO::PARAM_INT);
                $statement->bindParam(":metodoEnvio",$this->metodo_envio,PDO::PARAM_STR);
                //echo"UPDATE PEDIDO SET ESTATUS='E', METODO_ENVIO='$this->metodo_envio' WHERE ID=$this->id AND ESTATUS='P';";
                
                return $statement->execute();

                

            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
                return $e->getMessage();
            }
        }

        function showPedidoSeguimiento() {
            $query = "SELECT pedido.id,pedido.cliente,cliente.nombre_completo,pedido.estatus,CONCAT_WS(' ',usuario.nombre,usuario.apellido_p,usuario.apellido_m) AS vendedor,pedido.fecha,pedido.guia,pedido.logistica FROM pedido
            INNER JOIN cliente ON pedido.cliente = cliente.id_cliente
            INNER JOIN usuario ON pedido.vendedor = usuario.id
            WHERE pedido.estatus NOT LIKE 'HS' AND (pedido.estatus NOT LIKE 'DN' OR pedido.estatus NOT LIKE 'AT') AND (pedido.estatus NOT LIKE 'DLT')
            ORDER BY fecha DESC LIMIT 500;";
            
            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        }

        function buscarSeguimiento(){
            $query = "CALL searchSeguimiento(:vendedor,:cliente,:fecha1,:fecha2)";
            $statement = $this->db->prepare($query);

            $statement->bindParam(":vendedor",$this->vendedor,PDO::PARAM_STR);
            $statement->bindParam(":cliente",$this->cliente,PDO::PARAM_STR);
            $statement->bindParam(":fecha1",$this->fecha,PDO::PARAM_STR);
            $statement->bindParam(":fecha2",$this->fecha2,PDO::PARAM_STR);
            
            //echo"CALL searchSeguimiento('$this->vendedor','$this->cliente','$this->fecha','$this->fecha2')";
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function sendGuia(){
            try {
                $query = "UPDATE pedido SET metodo_envio = :metodoEnvio,logistica = :logistica,guia =:guia WHERE id=:idd";
                $statement = $this->db->prepare($query);
                $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);
                $statement->bindParam(":metodoEnvio",$this->metodo_envio,PDO::PARAM_STR);
                $statement->bindParam(":logistica",$this->logistica,PDO::PARAM_STR);
                $statement->bindParam(":guia",$this->guia,PDO::PARAM_STR);
            
                //echo"UPDATE pedido SET metodo_envio = $this->metodo_envio,logistica = $this->logistica,guia =$this->guia WHERE id=$this->id;";
                return $statement->execute();

            } catch (PDOException $e) {

                $this->msg_err = $e->getMessage();

            }
        }

        function changeStatuss() {
            try {
                $query = "UPDATE PEDIDO SET ESTATUS='HS' WHERE ID=:idd;";
                $statement = $this->db->prepare($query);
                $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);

                // echo"UPDATE PEDIDO SET ESTATUS='HS' WHERE ID=$this->id;";
                return $statement->execute();
            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
            }
        }

        function progresoPedidos(){
            try {
                $query = "SELECT * FROM SURTIENDO;";
                $statement = $this->db->prepare($query);
                
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);

            } 
            catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
            }
        }

        function pedidosScanLoot(){
            try {
                $query = "SELECT * FROM loots";
                $statement = $this->db->prepare($query); 
                $statement->execute();   
                return $statement->fetchAll(PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
            }
        }

        function getInformationAlmacen(){
            try {
                $query = "SELECT id,pieza,emblema,paquete FROM pedido WHERE id=:idd;";
                $statement = $this->db->prepare($query); 
                $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);

                $statement->execute();   
                return $statement->fetchAll(PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
            }

        }

        function takeOrder() {
            $var_valor = null;
            $folio = $this->folio;
            $user  = $this->usuario;
            $concatQuery = "";


            if ($user == 16) {
                $var_valor = "A";
                $concatQuery = ",ALMACEN_B=1";
            } else if($user == 14 || $user == 40 || $user == 41){
                $var_valor = "B";
                $concatQuery = ",ALMACEN_A=1";
            }
            
            $query = "UPDATE pedido SET movimiento = '$var_valor' $concatQuery WHERE folio = '$folio'";
            $statement = $this->db->prepare($query);

            return $statement-> execute();
        }
        

        function getDocFacturados(){
            try {
                $query = "SELECT * FROM invoices;";
                $statement = $this->db->prepare($query);

                $statement->execute();   
                return $statement->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
            }
        }

        function updateOrderaaaa(){
          
            try {
                
                // $query = "SELECT CLAVE FROM detalle_pedido where id = :idd and estatus ='AG';";
                // $query = "SELECT CLAVE FROM detalle_pedido where id_detalle = :idd and estatus ='AG';";
                
                $query = "SELECT CLAVE FROM detalle_pedido where id_detalle = :idd and estatus ='AG';";
                $statement = $this->db->prepare($query); 
                $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);
                $statement->execute();   
                $valores = $statement->fetchAll(PDO::FETCH_ASSOC);
            
                // var_dump($valores);

                if (isset($valores)) {
                    foreach ($valores as $row) {
                        $clavesitaa = $row['CLAVE'];
                        // $queryUpdate = "UPDATE detalle_pedido SET estatus = 'PS',agregados = (SELECT cantidad FROM detalle_pedido WHERE id_detalle = :idd AND clave = '$row[0]'AS TBA),folio = :folio,cantidad = 0 WHERE id_detalle = :idd AND CLAVE = '$row[0]' ";
                        
                        // $queryUpdate = "UPDATE detalle_pedido SET estatus = :stus ,agregados = (SELECT cantidad FROM detalle_pedido WHERE id_detalle = :idd AND clave = :cve  AS TBA),folio = :folio,cantidad = :cant WHERE id_detalle = :idd AND CLAVE = :cve; ";
                        $queryUpdate = "UPDATE detalle_pedido SET estatus = 'PS' ,agregados = (SELECT * FROM (SELECT cantidad FROM detalle_pedido WHERE id_detalle = :idd AND clave = '$clavesitaa')  AS TBA),folio = :folio,cantidad = 0 WHERE id_detalle = :idd AND CLAVE = '$clavesitaa'; ";
                        
                        //echo"UPDATE detalle_pedido SET estatus = 'PS' ,agregados = (SELECT * FROM (SELECT cantidad FROM detalle_pedido WHERE id_detalle = $this->id AND clave = $clavesitaa)  AS TBA),folio = $this->folio,cantidad = 0 WHERE id_detalle = $this->id AND CLAVE = $clavesitaa";

                        $statement_3 = $this->db->prepare($queryUpdate);
                        $statement_3->bindParam(":idd",$this->id,PDO::PARAM_INT);
                        $statement_3->bindParam(":folio",$this->folio,PDO::PARAM_STR);
                        $statement_3->execute();
                        
                        // return 1;
                    }
                        return 1;

                      // if ($statement_3->execute()) {
                        //     return $this->genReportXls();
                        // } else {
                        //       return 'No se ejecuto el update';
                        // }

                    // var_dump($statement_3->execute()); 
                    // return $statement_3->fetchAll(PDO::FETCH_ASSOC);

                }else{
                    echo 'array vacio';
                    return -2;
                }

            } catch (PDOException $e) {
                // echo 'error try catch';
                $this->msg_err = $e->getMessage();
            }

            /*
            try {
                $query = "SELECT CLAVE FROM detalle_pedido where id = :idd and estatus ='AG';";
                $statement = $this->db->prepare($query);
                $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);
                $statement->bindParam(":folio",$this->folio,PDO::PARAM_STR);

                // echo'SELECT CLAVE FROM detalle_pedido where id = '.$this->id .' and estatus = "AG";';
                $statement->execute();
                $valores = $statement->fetchAll(PDO::FETCH_ASSOC);

                if ($valores) {
                    foreach ($valores as $row) {
                        $queryUpdate = "UPDATE detalle_pedido SET estatus = 'PS',agregados = (SELECT cantidad FROM detalle_pedido WHERE id_detalle = :idd AND clave = '$row[0]'AS TBA),folio = :folio,cantidad = 0 WHERE id_detalle = :idd AND CLAVE = '$row[0]' ";
                    }
                    
                    $statement_3 = $this->db->prepare($queryUpdate);
                    $statement_3->bindParam(":idd",$this->id,PDO::PARAM_INT);
                    $statement_3->bindParam(":folio",$this->folio,PDO::PARAM_STR);
                    $statement_3->execute();

                    // $this->genReportXls();
                    
                    // return 1;


                    // return $this-> genReportXls();

                    if ($statement_3->execute()) {
                        return 401;
                    } else {
                        return 402;
                    }
                    
                    
                } else {
                    return -2;
                }
                
                
            } catch (PDOException $e) {
                $this->msg_err = $e->getMessage();
            }
            */
        }



        function genReportXls() {
            // echo'ejecutando genReportXLS';
            try {
                // $query = "SELECT * FROM PEDIDO WHERE ID=:idd OR FOLIO=:folio";
                $query = "SELECT folio,documento,metodo_envio,id,cliente from pedido WHERE id=:idd OR folio=:folio;";
                $statement = $this->db->prepare($query);
                $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);
                $statement->bindParam(":folio",$this->folio,PDO::PARAM_STR);

                $statement->execute();
                $valorcitoos = $statement->fetchAll(PDO::FETCH_ASSOC);

                if ($valorcitoos) {
                    foreach ($valorcitoos as $row) {
                        $folioLayout = $row['folio'];
                        $tipoDocumento = $row['documento'];
                        $tipoEnvio = $row['metodo_envio'];
                        $document = substr($tipoDocumento, 0, 1); /*substring*/
                        $idMoviento = $row['id'];
                        $idCliente = $row['cliente'];
                    }
                } else {
                    echo'No hay Documentos';
                }
                
                $FechaHoy = strftime("%d/%m/%Y");
                $claveEsqImpuesto = 1;
                $numAlmacen = 1;
                $iva = 16;

                $selectClient = "SELECT mdp_sat,cfdi,com_remision,com_factura FROM cliente WHERE id_cliente = $idCliente";
                $statement = $this->db->prepare($selectClient);
                $statement->execute();
                $valorr = $statement->fetchAll(PDO::FETCH_ASSOC);

                if ($valorr) {
                    foreach ($valorr as $row) {
                        $metodoPago = $row['mdp_sat'];
                        $usoCFDI = $row['cfdi'];
                        $claveVendedorRemision = $row['com_remision'];
                        $claveVendedorFactura = $row['com_factura'];
                    }
                }
                
                // include_once("../../../functions/phpjasperxml/PHPJasperXML.inc.php");
                // include_once("../../../functions/phpjasperxml/sample/setting.php");

                // include_once("../iksasocket/functions/phpjasperxml/PHPJasperXML.inc.php");
                // include_once("../iksasocket/functions/phpjasperxml/sample/setting.php");

                // include_once("../functions/phpjasperxml/PHPJasperXML.inc.php");
                // include_once("../functions/phpjasperxml/sample/setting.php");

                include_once("../../functions/phpjasperxml/PHPJasperXML.inc.php");
                include_once("../../functions/phpjasperxml/sample/setting.php");

                $dbdriver="mysql";
                $varHost='192.168.0.38';
                $varUser='Marco';
                $varPassword='Cbsu_it2024!';
                $varDatabase='iksasocket';
                $PHPJasperXML = new PHPJasperXML("en","XLS");
                
                $folio = $this->remision;
                // echo'ddd';
                // echo $document;

                if ($document == "F") {

                    
                    $PHPJasperXML->arrayParameter = array("FechaA"=>$FechaHoy,"NumAlmacen"=>$numAlmacen,"ClaveEsqImpuesto"=>$claveEsqImpuesto,
                    "IVA"=>$iva,"ID_DETALLE"=>$this->id,"FOLIO_LAYOUT"=>$folio,"ID_VENDEDOR"=>$claveVendedorFactura,"METODO_PAGO"=>$metodoPago,
                    "USO_CFDI"=>$usoCFDI,"Observaciones"=>$this->comment );

                    // $PHPJasperXML->load_xml_file("../functions/Reportes/movimientos/Full/Factura.jasper");
                    // $PHPJasperXML->load_xml_file("../../iksasocket/functions/Reportes/movimientos/Full/factura.jasper");

                    // $PHPJasperXML->load_xml_file("../../Reportes/movimientos/Full/factura.jrxml");
                    // $PHPJasperXML->load_xml_file("../functions/Reportes/movimientos/Full/factura.jrxml");

                    // $PHPJasperXML->load_xml_file("../../iksasocket/functions/Reportes/movimientos/Full/factura.jrxml");
                    
                    $PHPJasperXML->load_xml_file("../../functions/Reportes/movimientos/Full/factura.jrxml");
                    
                    $dbdriver = "mysql";
                    $PHPJasperXML->debugsql = true;
                    $PHPJasperXML->transferDBtoArray($varHost,$varUser,$varPassword,$varDatabase,$dbdriver);
                    // $PHPJasperXML->outpage('D',$folio.".xls");
                    $PHPJasperXML->outpage('D',$this->folio.".xls");
                    
                    // $INSERT_LOYUT = "INSERT INTO xlscartaporte(id,cliente,pedido,folio_parent,layout_r,documento)
                    // VALUES($this->id,$idCliente,$this->id,'$folioLayout','$this->remision','$tipoDocumento') ON DUPLICATE KEY UPDATE LAYOUT_R = $this->remision";

                    $INSERT_LOYUT = "INSERT INTO xlscartaporte(id,cliente,pedido,folio_parent,layout_r,documento)
                    VALUES(:idd,$idCliente,:idd,'$folioLayout',:remision,'$tipoDocumento') ON DUPLICATE KEY UPDATE LAYOUT_R = :remision";

                 
                    $statement = $this->db->prepare($INSERT_LOYUT);
                    $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);
                    $statement->bindParam(":folio",$this->folio,PDO::PARAM_STR);
                    $statement->bindParam(":remision",$this->remision,PDO::PARAM_STR);

                    $statement->execute();
                    // echo 12;
                    // return 12;

                } else if($document == "R"){
                    
                    $PHPJasperXML->arrayParameter = array("FechaA" => $FechaHoy,"NumAlmacen" => $numAlmacen,"ClaveEsqImpuesto" => $claveEsqImpuesto,
                    "IVA"=>$iva,"ID_DETALLE"=>$this->id,"FOLIO_LAYOUT"=>$folio,"ID_VENDEDOR"=>$claveVendedorRemision,"Observaciones" => $this->comment);
                    
                    $PHPJasperXML->load_xml_file("../../functions/Reportes/movimientos/Mixto/remision_60.jrxml");

                    $PHPJasperXML->debugsql = false;
                    $PHPJasperXML->transferDBtoArray($varHost,$varUser,$varPassword,$varDatabase,$dbdriver);
                    $PHPJasperXML->outpage('D',$this->folio.'.xls');
                    /*
                    $INSERT_LOYUT_2 = "INSERT INTO xlscartaporte(id,cliente,pedido,folio_parent,layout_r,documento)
                    values(:idd,$idCliente,:idd,'$folioLayout',:remision,'$tipoDocumento') ON DUPLICATE KEY UPDATE COT_SAE = :remision";

                    $statement = $this->db->prepare($INSERT_LOYUT_2);
                    $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);
                    $statement->bindParam(":folio",$this->folio,PDO::PARAM_STR);
                    $statement->bindParam(":remision",$this->remision,PDO::PARAM_STR);

                    $statement->execute();
                    */
                    // echo"INSERT INTO xlscartaporte(id,cliente,pedido,folio_parent,layout_r,documento) VALUES($this->id,$idCliente,$this->id,$this->folio,$this->remision,$tipoDocumento);";
                    

                
                        // $INSERT_LOYUT_2 = "INSERT INTO xlscartaporte(id,cliente,pedido,folio_parent,layout_r,documento) 
                        // VALUES($this->id,$idCliente,$this->id,'$this->folio','$this->remision','$tipoDocumento');";

                        $queryyy = "INSERT INTO xlscartaporte(id,cliente,pedido,folio_parent,layout_r,documento)
                        VALUES($this->id,$idCliente,$this->id,'$this->folio','$this->remision','$tipoDocumento');";
                        $statement22 = $this->db->prepare($queryyy); 
                        $statement22->execute();

                        // $INSERT_LOYUT_22 = "INSERT INTO xlscartaporte(cliente)VALUES(88); ";
                        // $statementeee = $this->db->prepare($INSERT_LOYUT_22);
                        // $statementeee->execute();
                        // var_dump($statementeee->fetchAll(PDO::FETCH_ASSOC));

                    

                }
                

            } catch (PDOException $e) {
                //throw $th;
                $e;
            }
        }

        // FACTURAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
       
        function genReportFacturaXls() {
            // echo'hola 1.1';
            include_once("../../../functions/phpjasperxml/PHPJasperXML.inc.php");
            include_once("../../../functions/phpjasperxml/sample/setting.php");

            $dbdriver="mysql";
            $varHost='192.168.0.38';
            $varUser='Marco';
            $varPassword='Cbsu_it2024!';
            $varDatabase='iksasocket';
            $PHPJasperXML = new PHPJasperXML("en","XLS");


            $FechaHoy = strftime("%d/%m/%Y");
            $NumAlmacen=1;
            $ClaveEsqImpuesto=1;
            $iva=16;
            $metodoPagoSat;
            try {
                
                $query = "SELECT folio,documento,metodo_envio,id,cliente from pedido WHERE id=:idd OR folio=:folio;";
                $statement = $this->db->prepare($query);
                $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);
                $statement->bindParam(":folio",$this->folio,PDO::PARAM_STR);

                $statement->execute();
                $valorcitooo = $statement->fetchAll(PDO::FETCH_ASSOC);

                if ($valorcitooo) {
                    
                    foreach ($valorcitooo as $row) {
                        $folioLayout = $row['folio'];
                        $tipoDocumento = $row['documento'];
                        $tipoEnvio = $row['metodo_envio'];
                        $document = substr($tipoDocumento, 0, 1); /*substring*/
                        $idMoviento = $row['id'];
                        $idCliente = $row['cliente'];
                    }

                    $selectClient = "SELECT max(id) as id,
                                    case
                                        when id is null then 0
                                    else
                                        max(id)
                                    end as id_row FROM xlscartaporte WHERE documento = '$tipoDocumento' AND pedido = $this->id";

                    

                    $statement = $this->db->prepare($selectClient);
                    $statement->execute();
                    $valorr = $statement->fetchAll(PDO::FETCH_ASSOC);

                    /*
                    $queryClientee = "SELECT mdp_sat,cfdi,com_remision,com_factura FROM cliente";
                    $statement = $this->db->prepare($queryClientee);
                    $statement->execute();
                    $valoorr = $statement->fetchAll(PDO::FETCH_ASSOC);
                    */
                    if ($valorr) {
                        
                        $queryClientee = "SELECT metodo_pago,mdp_sat,cfdi,com_remision,com_factura FROM cliente";
                        $statement = $this->db->prepare($queryClientee);
                        $statement->execute();
                        $valoorr = $statement->fetchAll(PDO::FETCH_ASSOC);

                    } else {
                        echo'No se obtubo un id';
                    }
                    

                    if ($valoorr) {
                        foreach ($valoorr as $row) {
                           
                            $metodoPago = $row['metodo_pago'];
                            $metodoPagoSat = $row['mdp_sat'];
                            $uso_cfdi = $row['cfdi'];
                            $clave_vendedor_remision = $row['com_remision'];
                            $clave_vendedor_factura = $row['com_factura'];

                        }
                        // echo 'este es un document';
                        // echo $document;
                        // echo 'fin del document';

                        if ($document == "F") {
                            $Foliioo = $this->remision;
                            echo 'hola...25';
                            $PHPJasperXML->arrayParameter=array("FechaA" => $FechaHoy,"NumAlmacen" => $NumAlmacen,"ClaveEsqImpuesto" => $ClaveEsqImpuesto,
                                "IVA" => $iva,"ID_DETALLE" => $idMoviento,"FOLIO_LAYOUT" => $folioLayout,"ID_VENDEDOR" => $clave_vendedor_factura,
                                "METODO_PAGO" => $metodoPago,"FORMA_PAGO_SAT" => $metodoPagoSat,"USO_CFDI" => $uso_cfdi, "Observaciones" => $this->comment
                            );

                            $PHPJasperXML->load_xml_file("../../Reportes/movimientos/2023/Full/factura.jrxml");
                            $dbdriver= "mysql";
                            $PHPJasperXML->debugsql = true;

                            $PHPJasperXML->transferDBtoArray($varHost,$varUser,$varPassword,$varDatabase,$dbdriver);
                            $PHPJasperXML->outpage('I',$Foliioo.'.xls');
                            // $PHPJasperXML->outpage('I',$Foliioo.".xls");

                            $INSERT_LOYUT3 = "INSERT INTO xlscartaporte(id,cliente,pedido,folio_parent,layout_r,documento)values($idMoviento,$tipoDocumento,$folioLayout,$Foliioo,$tipoDocumento)";
                            $statement = $this->db->prepare($INSERT_LOYUT3);
                            $statement->execute();
                            // echo 44;
                            // return 44;
                        }else if($document == "R" && $listaPrecio <> 24){
                            // echo 'hola...35';
                            $PHPJasperXML->arrayParameter=array("FechaA" => $FechaHoy,"NumAlmacen" => $NumAlmacen,"ClaveEsqImpuesto" => $ClaveEsqImpuesto,
                                "IVA" => $iva,"ID_DETALLE" => $idMoviento,"FOLIO_LAYOUT" => $folioLayout,"ID_VENDEDOR" => $clave_vendedor_factura,
                                "METODO_PAGO" => $metodoPago,"FORMA_PAGO_SAT" =>$metodoPagoSat,"USO_CFDI" => $uso_cfdi,"Observaciones" =>$this->comment
                            );

                            $PHPJasperXML->load_xml_file('../../Reportes/movimientos/2023/Mixto/remision_60.jrxml');
                            $dbdriver="mysql";
                            // $PHPJasperXML->debugsql = true;
                            $PHPJasperXML->transferDBtoArray($varHost,$varUser,$varPassword,$varDatabase,$dbdriver);
                            $PHPJasperXML->outpage('I',$folioLayout.'.xls');

                            $INSERT_LOYUT4 = "INSERT INTO xlscartaporte(id,cliente,pedido,folio_parent,layout_r,documento)values($idMoviento,$tipoDocumento,$folioLayout,$Foliioo,$tipoDocumento)";
                            $statement = $this->db->prepare($INSERT_LOYUT4);
                            $statement->execute();
                            // echo 55;
                            // return 55;
                        }else{
                            // echo 'hola...45';

                            $PHPJasperXML->arrayParameter = array("FechaA" => $FechaHoy,"NumAlmacen" => $numAlmacen,"ClaveEsqImpuesto" => $ClaveEsqImpuesto,
                                "IVA" => $iva,"ID_DETALLE" => $idMoviento,"FOLIO_LAYOUT" => $folioLayout,
                                "ID_VENDEDOR" => $clave_vendedor_factura,"Observaciones" => $this->comment
                            );
                            $PHPJasperXML->load_xml_file('../../Reportes/movimientos/2023/Mixto/factura_40sinIva.jrxml');
                            $dbdriver= "mysql";
                            $PHPJasperXML->transferDBtoArray($varHost,$varUser,$varPassword,$varDatabase,$dbdriver);
                            $PHPJasperXML->outpage('I',$folioLayout.'xls');

                            $INSERT_LOYUT5 = "INSERT INTO xlscartaporte(id,cliente,pedido,folio_parent,layout_r,documento)values($idMoviento,$tipoDocumento,$folioLayout,$Foliioo,$tipoDocumento)";
                            $statement = $this->db->prepare($INSERT_LOYUT5);
                            $statement->execute();
                            // echo 66;  
                            // return 66;  
                        }

                        $update_pedido = "UPDATE pedido SET estatus = 'FT' WHERE ID = $idMovimiento ";
                        $statement = $this->db->prepare($update_pedido);    

                        $insert_doc = "INSERT INTO remision (id,pedido,cot_sae) values ($pedido,$pedido,$remision) ON DUPLICATE KEY UPDATE";
                        $statement = $this->db->prepare($insert_doc);
                    } 

                } else {
                    echo'No hay Documentos';
                }

            } catch (PDOException $e) {
                $e;
            }
        }


        ////////////carta maestra ///////////////////////////////////////////////////////////////////////

        function cotizacionReport(){
            try {
                
                $query = "SELECT * FROM (SELECT @primid_pedido :=:idd PEDIDO) alias, VISTA_REPORTPEDIDO_2;";
                $statement = $this->db->prepare($query);
                $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);
                
                
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                echo $e;
            }
        }

        function getVendedoress(){
            try {
                $query = "SELECT login.clasificacion,CONCAT_WS(' ',usuario.nombre,usuario.apellido_p,usuario.apellido_m) AS nombre from usuario INNER JOIN login on usuario.id = login.usuario_fk WHERE roll = 3";
                $statement = $this->db->prepare($query);
                $statement->execute();

                return $statement->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                echo $e;
            }
        }

        
        function searchPedidoRelationDocs(){
            try {

                $query = "CALL searchPedidoRelationDocs(:banco,:desde,:hasta)";
                $statement = $this->db->prepare($query);
                $statement->bindParam(":banco",$this->banco,PDO::PARAM_INT);
                $statement->bindParam(":desde",$this->fecha,PDO::PARAM_STR);
                $statement->bindParam(":hasta",$this->fecha2,PDO::PARAM_STR);

                // echo"CALL searchPedidoRelationDocs($this->banco,'$this->fecha','$this->fecha2')";
                
                $statement->execute();

                return $statement->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                echo $e;
            }
        }



}
