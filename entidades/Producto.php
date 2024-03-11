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

}

