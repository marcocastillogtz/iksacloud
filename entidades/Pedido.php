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

        // $query="CALL PEDIDO_ID('{$var_cliente}',{$var_vendedor},'{$var_documento}','{$var_clave}','{$var_desc}',{$var_precio},
        // {$var_cantidad},{$var_total},'{$var_restriccion}',{$var_ofertaGrupo}, '{$var_statusOferta}', {$var_listaPrecio}, '{$hora}');";
        
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
        
        $statement->bindParam(':statusOferta',$this->$var_statusOferta);
        $statement->bindParam(':listaPrecio',$this->listaPrecio,PDO::PARAM_INT);
        $statement->bindParam(':hora',$hora);

        // $statement->bindParam(':envio',$this->envio);
        
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

}
