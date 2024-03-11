<?php
    class DetallePedido{
        private $id;
        private $vendedor;
        private $clave;
        private $descripcion;
        private $precio;
        private $cantidad;
        private $fecha;
        private $cliente;
        private $id_detalle;
        private $estatus;
        private $monto;
        private $folio;
        private $restrinccion;
        private $famOferta;
        private $famAcuerdo;
        private $estatusOferta;
        private $paquete;
        private $pieza;
        private $porcentaje;
        private $comision;
        private $precioLista;
        private $movimiento;
        private $agregados;
        private $notificacion;
        private $comisionF;
        private $porcentajeF;
        private $paqueteSL;
        private $piezaSL;
        private $folioDevolucion;
        private $cantidadDevolucion;
        private $motivoDevolucion;
        private $fechaDevolucion;
        private $msg_err_Esq;

        protected $db;


        public function __construct()
        {
            require_once("DBC.php");
            $object_connection = new DataBaseConnection();
            $this->db = $object_connection->connect();
        }

        function setId($id) {
            $this->id = $id;
        }
        function getId(){
            return $this->id;
        }


        function setVendedor($vendedor){
            $this->vendedor = $vendedor;
        }
        function getVendedor(){
            return $this->vendedor;
        }

        function setClave($clave) {
            $this->clave = $clave;            
        }
        function getClave() {
            return $this->clave;    
        }
        


        function setDescripcion($desc){
            $this->descripcion = $desc;
        }

        function getDescripcion(){
            return $this->descripcion;
        }

        function setPrecio($precio){
            $this->precio = $precio;
        }

        function getPrecio(){
            return $this->precio;
        }


        function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }
        function getCantidad(){
            return $this->cantidad;
        }


        function setFecha($fecha){
            $this->fecha = $fecha;
        }
        function getFecha(){
            return $this->fecha;
        }

        function setCliente($cliente){
            $this->cliente = $cliente;
        }
        function getCliente(){
            return $this->cliente;
            
        }

        function setIdDetalle($idDetalle){
            $this->id_detalle = $idDetalle;
        }

        function getIdDetalle(){
            return $this->id_detalle;
        }


        function setEstatus($status){
            $this->estatus = $status;
        }
        function getEstatus(){
            return $this->estatus;
        }


        function setMonto($monto){
            $this->monto = $monto;
        }
        function getMonto(){
            return $this->monto;
        }

        function setFolio($folio){
            $this->folio = $folio;
        }
        function getFolio() {
            return $this->folio;
        }


        function setRestrinccion($restrinccion){
            $this->restrinccion = $restrinccion;
        }

        function getRestrinccion(){
            return $this->restrinccion;
        }


        function setFamOferta($famOferta){
            $this->famOferta = $famOferta;            
        }
        function getFamOferta(){
            return $this->famOferta;
        }


        function setFamAcuerdo($famAcuerdo){
            $this->famAcuerdo = $famAcuerdo;
        }
        function getFamAcuerdo(){
            return $this->famAcuerdo;
        }


        function setEstatusOferta($estatusOferta){
            $this->estatusOferta = $estatusOferta;
        }
        function getEstatusOferta() {
            return $this->estatusOferta;
        }


        function setFolioDevolucion($folioDevolucionn){
            $this->folioDevolucion = $folioDevolucionn;
        }
        function getFolioDevolucion(){
            return $this->folioDevolucion;
        }

        
        function showOrder() {
            $query="SELECT ID,CLAVE,DESCRIPCION,PRECIO,CANTIDAD,MONTO,ESTATUS_OFERTA FROM DETALLE_PEDIDO 
            WHERE ID_DETALLE=:idDetalle ORDER BY ID DESC;";
            
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idDetalle", $this->id_detalle);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);

            //echo $searchOrder;
    
        }

        function showOrderPreview(){
            $query="SELECT * FROM VISTA_PEDIDOPORSURTIR;";
            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function saveFolio(){
            $query="SELECT CLAVE FROM DETALLE_PEDIDO WHERE ID_DETALLE=:idDetalle";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idDetalle",$this->id_detalle);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function getQuantityStore(){
            // SELECT CANTIDAD FROM DETALLE_PEDIDO WHERE CLAVE='" . $Key . "' AND ID_DETALLE=" . $GLOBALS["var_id"]
            $query ="SELECT CANTIDAD FROM DETALLE_PEDIDO WHERE CLAVE = :clave AND ID_DETALLE= :idDetalle";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idDetalle",$this->id_detalle);
            $statement->bindParam(":clave",$this->clave);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function setIndicator(){
            $query = "CALL INDICADORES(:id)";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":id",$this->id);    
            // $statement->execute();
            // return $statement->fetchAll(PDO::FETCH_ASSOC);
            return $statement->execute();

        }


        function getDataProductDetallePedido(){
            $query = "SELECT CLAVE,DESCRIPCION,PRECIO,CANTIDAD,MONTO,FAM_OFERTA FROM DETALLE_PEDIDO WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":id",$this->id);
             
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        }

        
        function getLPInsert(){
            $query = "CALL volcarInformacion(:id,:folio,:folioNvo);";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":id",$this->id);
            $statement->bindParam(":folio",$this->folio);
            $statement->bindParam(":folioNvo",$this->folioDevolucion);

            //echo"CALL volcarInformacion($this->id,$this->folio,$this->folioDevolucion);";
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }


        function getLPUpdate() {
            try {
                $query= "CALL validar_precio(:id,:cantidad,:folioNvo);";
                $statement = $this->db->prepare($query);
                $statement->bindParam(":id",$this->id);
                $statement->bindParam(":folioNvo",$this->folioDevolucion);
                $statement->bindParam(":cantidad",$this->cantidad);

                return $statement->execute();
            } catch (PDOException $e) {
                $this->msg_err_Esq = $e->getMessage();
                return $e->getMessage();
            }
        }

        function getMessageERROR()
        {
            require_once('../diccionario.php');
            $sqlMessage = $this->msg_err_Esq;
            return getMessageSQL($sqlMessage);
        }


        function resetDetallePed(){
            // $query="UPDATE DETALLE_PEDIDO SET CANTIDAD='0' WHERE FOLIO='{$var_folio}' AND CLAVE='{$var_clave}';";
            // $query="UPDATE detalle_pedido SET CANTIDAD='0' WHERE FOLIO=:folio AND CLAVE=:clave;";
            $query="UPDATE detalle_pedido SET CANTIDAD='0' WHERE id=:idd";
            // echo"UPDATE detalle_pedido SET CANTIDAD='0' WHERE id=$this->id";
           
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idd",$this->id,PDO::PARAM_INT); 

            return $statement->execute();      
        }

        function eliminarPartidaBackOrder(){
            $query="UPDATE detalle_pedido SET estatus='DLT' WHERE id=:idd ";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idd",$this->id,PDO::PARAM_INT);
            return $statement->execute();
        }

    }