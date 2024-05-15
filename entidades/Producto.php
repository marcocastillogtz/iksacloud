<?php 
class Producto{
    private $clave;
    private $estado;
    private $descripcion;
    private $fecha_alta;
    private $stock_minimo;
    private $stock_maximo;
    private $imagen;
    private $modelo;
    private $modelo_inicial;
    private $modelo_final;
    private $marca;
    private $precio;
    private $oferta;
    private $categoria;
    private $almacen_a;
    private $color;
    private $clave_sat;
    private $clave_unidad;
    private $fk_lp;
    private $startIndex;
    private $perPage;
    private $folio;
    private $msg_err_Esq;


    private $vendedor;
    private $cantidad;
    private $cliente;
    private $pedido;
    private $total;
    private $restrinccion;
    private $estatusOferta;
    private $documento;


    protected $db;

    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }

    function setClave($clave)
    {
        $this->clave = $clave;
    }
    function getClave()
    {
        return $this->clave;
    }


    function setEstado($estado){
        $this->estado = $estado;
    }
    function getEstado(){
        return $this->estado;
    }


    function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    function getDescripcion(){
        return $this->descripcion;
    }


    function setFechaAlta($fechaAltaa) {
        $this->fecha_alta = $fechaAltaa;
    }
    function getFechaAlta(){
        return $this->fecha_alta;
    }


    function setStockMinimo($stockMinimo){
        $this->stock_minimo = $stockMinimo;
    }
    function getStockMinimo(){
        return $this->stock_minimo;
    }


    function setStockMaximo($stockMaximo) {
        $this->stock_maximo = $stockMaximo;
    }

    function getStockMaximo(){
        return $this->stock_maximo;
    }
    

    function setImagen($imagen){
        $this->imagen = $imagen;
    }

    function getImagen(){
        return $this->imagen;    
    }
    

    function setModelo($modelo){
        $this->modelo = $modelo;
    }

    function getModelo(){
        return $this->modelo;
    }
    

    
    function setModeloInicial($modeloInicial){
        $this->modelo_inicial = $modeloInicial;
    }

    function getModeloInicial(){
        return $this->modelo_inicial;
    }

    

    function setModeloFinal($modeloFinal) {
        $this->modelo_final = $modeloFinal;
    }
    
    function getModeloFinal(){
        return $this-> modelo_final;
    }



    function setMarca($marca) {
        $this->marca = $marca;
    }
    function getMarca(){
        return $this->marca;
    }



    function setPrecio($precio){
        $this->precio = $precio;
    }

    function  getPrecio()  {
       return $this->precio; 
    }



    function setOferta($oferta){
        $this->oferta = $oferta;
    }
    function getOferta(){
        return $this->oferta;
    }

    
    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    function getCategoria(){
        return $this->categoria;
    }
    
    
    function setAlmacenA($almacenA){
        $this->almacen_a =$almacenA;
    }
    function getAlmacenA(){
        return $this->almacen_a;
    }



    function setColor($color){
        $this->color = $color;
    }
    function getColor(){
        return $this->color;
    }


    function setClaveSat($sat){
        $this->clave_sat = $sat;
    }
    function getClaveSat(){
        return $this->clave_sat;
    }

    function setClaveUnidad($Unidad){
        $this->clave_unidad = $Unidad;
    }
    function getClaveUnidad(){
        return $this->clave_unidad;   
    }

    function setFkListaPrecio($fk_lp){
        $this->fk_lp = $fk_lp;
    }
    function getFkListaPrecio(){
        return $this->fk_lp;   
    }
    function setIndex($index)
    {
        $this->startIndex = $index;
    }
    
    function getIndex()
    {
        return $this->startIndex;
    }

    function setLastPage($perPage)
    {
        $this->perPage = $perPage;
    }

    function getLastPage()
    {
        return $this->perPage;
    }

    function setFolio($fol){
        $this->folio =$fol;
    }
    function getFolio(){
        return $this->folio;
    }

    function setVendedor($vendedor){
        $this->vendedor = $vendedor;
    }
    function getVendedor(){
        return $this->vendedor;        
    }


    function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }
    function getCantidad(){
        return $this->cantidad;
    }


    function setCliente($cliente){
        $this->cliente = $cliente;
    }
    function getCliente(){
        return $this->cliente;        
    }



    function setPedido($pedido){
        $this->pedido = $pedido;    
    }
    function getPedido(){
        return $this->pedido;
    }

    function setTotal($total){
        $this->total = $total;
    }
    function getTotal(){
        return $this->total;
    }

    function setRestrinccion($restrinccion){
        $this->restrinccion = $restrinccion;
    }
    function getRestrinccion(){
        return $this->restrinccion;
    }

    function setEstatusOferta($estatusOferta) {
        $this->estatusOferta = $estatusOferta;
    }
    function getEstatusOferta(){
        return $this->estatusOferta;
    }

    function setDocumento($documento){
        $this->documento = $documento;
    }
    function getDocumento() {
        return $this->documento;
    }

    function getMessageERROR()
    {
        require_once('../diccionario.php');
        $sqlMessage = $this->msg_err_Esq;
        return getMessageSQL($sqlMessage);
    }

    function getInfoClave(){
        $query="SELECT PRODUCTO.CLAVE AS CLAVE,
        PRODUCTO.DESCRIPCION AS DESCRIPCION,
        PRODUCTO.PRECIO,
        CASE WHEN LISTADEPRECIO.PRECIO IS NULL THEN 0 ELSE LISTADEPRECIO.PRECIO END AS PRICE_SPECIAL,
        CASE WHEN OFERTA.GRUPO IS NULL THEN 0 ELSE OFERTA.GRUPO END AS FAME_SALE,
        CASE WHEN OFERTA.PRECIO IS NULL THEN 0 ELSE OFERTA.PRECIO END AS PRICE_SALE,
        CASE WHEN OFERTA.RESTRICCION IS NULL THEN 'S/D' ELSE OFERTA.RESTRICCION END AS RESTRICCION
        FROM OFERTA 
        RIGHT JOIN PRODUCTO ON OFERTA.CLAVE=PRODUCTO.CLAVE
        RIGHT JOIN LISTADEPRECIO ON PRODUCTO.CLAVE=LISTADEPRECIO.CLAVE
        WHERE LISTADEPRECIO.FK_IDLP=:precio AND PRODUCTO.CLAVE=:clave AND PRODUCTO.ESTADO='Activo';";

        $statement = $this->db->prepare($query);
        $statement->bindParam(":precio",$this->precio, PDO::PARAM_INT);
        $statement->bindParam(":clave",$this->clave, PDO::PARAM_STR);

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    function getKardex(){
        //$query="SELECT * FROM  (SELECT @primid_lp:=:fk_lp) alias,kardex_producto LIMIT :startIndex,:perPage;";
        /*
        $query="SELECT * FROM  (SELECT @primid_lp:=:fk_lp) alias,kardex_producto;";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(":fk_lp",$this->fk_lp, PDO::PARAM_INT);
        $statement->bindParam(":startIndex",$this->startIndex, PDO::PARAM_INT);
        $statement->bindParam(":perPage",$this->perPage, PDO::PARAM_INT);
        */
        $query="SELECT * FROM  (SELECT @primid_lp:=:fk_lp) alias,kardex_producto;";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":fk_lp",$this->fk_lp, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function consultarClave(){
        
        $query = "CALL searchItem(:clave,:folio)";

        $statement = $this->db->prepare($query);
        $statement->bindParam(":clave",$this->clave,PDO::PARAM_STR);
        $statement->bindParam(":folio",$this->folio,PDO::PARAM_STR);
        
        //echo"CALL searchItem($this->clave,$this->folio)";

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    function getCount()
    {
        $query = "SELECT COUNT(clave) as counts FROM producto where estado='Activo'";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function catalogo() {
        // $query = "SELECT * FROM (SELECT @primid_lp :={:listaPrecios} ID_LP, @primid_clave :='{:clavee}' PRODUCT) ALIAS, CATALOGO_1;"; 
        $query = "SELECT * FROM (SELECT @primid_lp :=:listaPrecios ID_LP, @primid_clave :=:clavee PRODUCT) ALIAS, CATALOGO_1;"; 
        $statement = $this->db->prepare($query);
        $statement->bindParam(":listaPrecios",$this->fk_lp,PDO::PARAM_INT);
        $statement->bindParam(":clavee",$this->clave,pdo::PARAM_STR);
        // echo"SELECT * FROM (SELECT @primid_lp :={$this->fk_lp} ID_LP, @primid_clave :='{$this->clave}' PRODUCT) ALIAS, CATALOGO_1;";
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function agregarItem(){
        try {        
            $query = "CALL ADD_ITEM_INVOICE(:vendedor,:clave,:descripcion,:precio,:cantidad,:cliente,:pedido,:total,
            :folio,:restrinccion,:ofertaGrupo,:estatusOferta,:listaPrecio,:documento)";
            
            $statement = $this->db->prepare($query);

            $statement->bindParam(":vendedor",$this->vendedor);
            $statement->bindParam(":clave",$this->clave);
            $statement->bindParam(":descripcion",$this->descripcion);
            $statement->bindParam(":precio",$this->precio);
            $statement->bindParam(":cantidad",$this->cantidad);
            $statement->bindParam(":cliente",$this->cliente);
            $statement->bindParam(":pedido",$this->pedido);
            $statement->bindParam(":total",$this->total);
            $statement->bindParam(":folio",$this->folio);
            $statement->bindParam(":restrinccion",$this->restrinccion);
            $statement->bindParam(":ofertaGrupo",$this->oferta);
            $statement->bindParam(":estatusOferta",$this->estatusOferta);
            $statement->bindParam(":listaPrecio",$this->fk_lp);
            $statement->bindParam(":documento",$this->documento);

        
            // echo "CALL ADD_ITEM_INVOICE($this->vendedor,'$this->clave','$this->descripcion',$this->precio,$this->cantidad,$this->cliente,$this->pedido,$this->total,
            // '$this->folio','$this->restrinccion',$this->oferta,'$this->estatusOferta',$this->fk_lp,'$this->documento')";
        
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $this->msg_err_Esq = $e->getMessage();
            return $e->getMessage();
        }
        
    }

}

