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
        private $total;

        protected $db;
        
        // fam_oferta
        // estatus_oferta

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


        function setTotal($totall){
            $this->total = $totall;
        }
        function getTotal(){
            return $this->total;
        }
        
        function setPaquete($paquete) {
            $this->paquete = $paquete;
        }
        function getPaquete(){
            return $this->paquete;
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

        function insertPartidaAdd(){
            // $query = "CALL ADD_ITEM_BACKORDER({$var_vendedor},:clavee,:descripcion,:precio,:cantidad,'{$var_cliente}', {$idPedido},{$var_total},:restrinccion,{$var_ofertaGrupo},'{$var_statusOferta}',{$var_listaPrecio}, '{$var_documento}',:folio);"; 
            
            $query = "CALL ADD_ITEM_BACKORDER(:folio,:clave,:cantidad,:desc,:precio,:restrinccion,:estatusOferta,:famOferta,:total,:idDetalle);"; 
            
            //echo "CALL ADD_ITEM_BACKORDER('$this->folio','$this->clave',$this->cantidad,'$this->descripcion',$this->precio,$this->restrinccion,'$this->estatusOferta',$this->famOferta,$this->total,$this->id);"; 
            
            
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idDetalle",$this->id);
            $statement->bindParam(":folio",$this->folio);
            $statement->bindParam(":clave",$this->clave);
            $statement->bindParam(":cantidad",$this->cantidad);
            $statement->bindParam(":desc",$this->descripcion);
            $statement->bindParam(":precio",$this->precio);
            $statement->bindParam(":restrinccion",$this->restrinccion);
            $statement->bindParam(":estatusOferta",$this->estatusOferta);
            $statement->bindParam(":famOferta",$this->famOferta);
            $statement->bindParam(":total",$this->total);
            
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        }

        function getOrderByFolioCheckout() {
            // $searchOrders="SELECT * FROM DETALLE_PEDIDO WHERE FOLIO='$serial';";
            $query = "SELECT * FROM detalle_pedido WHERE folio = :idd";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idd",$this->id);

            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        }

        function seeKey()  {
                $query =  "CALL COUNT_ITEM(:folio,:clave,:paquete)";
                $statement = $this->db->prepare($query);
                $statement->bindParam(":folio",$this->folio,PDO::PARAM_STR);
                $statement->bindParam(":clave",$this->clave,PDO::PARAM_STR);
                $statement->bindParam(":paquete",$this->paquete);

                // echo"CALL COUNT_ITEM('$this->folio','$this->clave',$this->paquete)";
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function getExistenciaProducto(){
            $query = "SELECT VENDEDOR,PRECIOLISTA,FOLIO FROM DETALLE_PEDIDO WHERE ID_DETALLE=:idDetalle LIMIT 1";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idDetalle",$this->id_detalle);

            // echo"SELECT VENDEDOR,PRECIOLISTA,FOLIO FROM DETALLE_PEDIDO WHERE ID_DETALLE=$this->id_detalle LIMIT 1";
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        

        function executeDevolucion() {
            $notify = 0;
            $agregados = 0;
            $cantidad = 0;
            //getInformation
        
            $query = "SELECT cantidad,agregados,estatus FROM detalle_pedido WHERE clave =:clave AND folio =:folio";
            $statement =  $this->db->prepare($query);
            $statement->bindParam(":folio",$this->folio);
            $statement->bindParam(":clave",$this->clave);
            // $statement->bindParam(":cantidad",$this->cantidad);

            $statement->execute();
            // return $statement->fetchAll(PDO::FETCH_ASSOC);
            // $valorcitos = $statement->fetchAll(PDO::FETCH_CLASS);
            $valorcitos = $statement->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($valorcitos);

            foreach ($valorcitos as $row) {
                // $cantidadd = $row['cantidad'];
                // $agregadoss = $row['agregados'];
                // $estatuss = $row['estatus'];
                if ($row['estatus'] == "AG") {
                    $cantidad =  $row['cantidad'] - $this->cantidad;
                    $agregados = 0;
                    $notify = 2;
                } else {
                    $cantidad = $row['cantidad'] + $this->cantidad;
                    $agregados = $row['agregados'] - $this->cantidad;
                    $notify = 1;
                }
                
               
            }
        //     function updateDevolucion($cant,$agreg,$not){
        //         echo 'esta es la cantidad'.$cant.'<br>';
        //         echo 'esto son los agregados'.$agreg.'<br>';
        //         echo 'esta es la noficacion'.$not.'<br>';
    
        //    }
        //     updateDevolucion($cantidad,$agregados,$notify);

            if ($notify == 1) {
                if ($agregados <= -1) {
                    return 2;
                } else {
                    try {
                        if ($notify == 1) {
                            $update_222 = "UPDATE detalle_pedido SET agregados = :ag, cantidad = :cant WHERE folio=:folio AND clave = :clave;";
                            // echo"UPDATE detalle_pedido SET agregados = :ag, cantidad = :cant WHERE folio=:folio AND clave = :clave;";
                        } else {
                            $update_222 = "UPDATE detalle_pedido SET agregados = :ag, cantidad = :cant WHERE folio=:folio  AND clave = :clave;";
                            // echo"UPDATE detalle_pedido SET agregados = :ag, cantidad = :cant WHERE folio=:folio  AND clave = :clave;";
                        }
                        
                        // echo "UPDATE detalle_pedido SET agregados = $agregados, cantidad = $cantidad WHERE folio=$this->folio  AND clave = $this->clave";
                        $statement_2 = $this->db->prepare($update_222);
                        $statement_2->bindParam(":cant",$cantidad,PDO::PARAM_INT);
                        $statement_2->bindParam(":ag",$agregados,PDO::PARAM_INT);
                        $statement_2->bindParam(":folio",$this->folio,PDO::PARAM_STR);
                        $statement_2->bindParam(":clave",$this->clave,PDO::PARAM_STR);
                        // var_dump($statement_2-> execute());
                        $statement_2->execute();
                        return 1;
                    }catch (PDOException $e) {
                        // echo $e;
                        return 0;
                    }

                }
                
            } else {
                if ($agregados <= -1) {
                    return 2;
                    //echo'testt 2';
                } else {
                    try {
                        
                        if ($notify == 2) {
                            $query ="UPDATE detalle_pedido SET cantidad = $cantidad WHERE folio = '$this->folio' AND clave = '$this->clave';";
                            // echo"UPDATE detalle_pedido SET cantidad = $cantidad WHERE folio = '$this->folio' AND clave = '$this->clave';";

                        } elseif($notify == 1){
                            $query = "UPDATE detalle_pedido SET agregados = $agregados where folio = '$this->folio' AND clave = '$this->clave' ";
                            // echo"UPDATE detalle_pedido SET agregados = $agregados where folio = $this->folio AND clave = $this->clave";

                        }else {
                            $query = "UPDATE detalle_pedido SET agregados = $agregados, cantidad = $cantidad WHERE folio = '$this->folio' AND clave = '$this->clave' ";
                            // echo"UPDATE detalle_pedido SET agregados = $agregados, cantidad = $cantidad WHERE folio = $this->folio AND clave= $this->clave";
                        }

                        
                        $statement = $this->db->prepare($query);
                        $statement->execute();

                        return 1;

                    } catch (PDOException $e) {
                        return 0;
                    }
                }
                
            }
        
            
        }

        

        function getInfoOrder(){
            $query ="SELECT vendedor,precioLista,folio FROM detalle_pedido WHERE id_detalle = :idDetalle LIMIT 1";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idDetalle",$this->id_detalle);
            
            // echo"SELECT vendedor,precioLista,folio FROM detalle_pedido WHERE id_detalle = $this->id_detalle LIMIT 1";

            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        }
    }