<?php

use Ratchet\Server\EchoServer;

class Clientes
{
    private $id_cliente;
    private $estatus;
    private $nombre_completo;
    private $rfc;
    private $mail;
    private $clasificacion;
    private $estado;
    private $municipio;
    private $poblacion;
    private $telefono;
    private $texto;
    private $remision;
    private $factura;
    private $cfdi;
    private $mdp_sat;
    private $com_remision;
    private $com_factura;
    private $cod_venta;
    private $lpa;
    private $modo;
    private $doc_alt;
    private $operacion;
    private $banco;
    private $cuenta_cliente;
    private $dias_limite;
    private $credito_limite;
    private $msg_err;


    private $startIndex;
    private $perPage;
    protected $db;

    public function __construct()
    {
        require_once("DBC.php");
        $object_connection = new DataBaseConnection();
        $this->db = $object_connection->connect();
    }

    function setid_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }
    function getid_cliente()
    {
        return $this->id_cliente;
    }
    function setestatus($estatus)
    {
        $this->estatus = $estatus;
    }
    function getestatus()
    {
        return $this->estatus;
    }
    function setnombre_completo($nombre_completo)
    {
        $this->nombre_completo = $nombre_completo;
    }
    function getnombre_completo()
    {
        return $this->nombre_completo;
    }
    function setrfc($rfc)
    {
        $this->rfc = $rfc;
    }
    function getrfc()
    {
        return $this->rfc;
    }
    function setmail($mail)
    {
        $this->mail = $mail;
    }
    function getmail()
    {
        return $this->mail;
    }
    function setclasificacion($clasificacion)
    {
        $this->clasificacion = $clasificacion;
    }
    function getclasificacion()
    {
        return $this->clasificacion;
    }
    function setestado($estado)
    {
        $this->estado = $estado;
    }
    function getestado()
    {
        return $this->estado;
    }
    function setmunicipio($municipio)
    {
        $this->municipio = $municipio;
    }
    function getmunicipio()
    {
        return $this->municipio;
    }
    function setpoblacion($poblacion)
    {
        $this->poblacion = $poblacion;
    }
    function getpoblacion()
    {
        return $this->poblacion;
    }
    function settelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    function gettelefono()
    {
        return $this->telefono;
    }
    function settexto($texto)
    {
        $this->texto = $texto;
    }
    function gettexto()
    {
        return $this->texto;
    }
    function setremision($remision)
    {
        $this->remision = $remision;
    }
    function getremision()
    {
        return $this->remision;
    }
    function setfactura($factura)
    {
        $this->factura = $factura;
    }
    function getfactura()
    {
        return $this->factura;
    }
    function setcfdi($cfdi)
    {
        $this->cfdi = $cfdi;
    }
    function getcfdi()
    {
        return $this->cfdi;
    }
    function setmdp_sat($mdp_sat)
    {
        $this->mdp_sat = $mdp_sat;
    }
    function getmdp_sat()
    {
        return $this->mdp_sat;
    }
    function setcom_remision($com_remision)
    {
        $this->com_remision = $com_remision;
    }
    function getcom_remision()
    {
        return $this->com_remision;
    }
    function setcom_factura($com_factura)
    {
        $this->com_factura = $com_factura;
    }
    function getcom_factura()
    {
        return $this->com_factura;
    }
    function setcod_venta($cod_venta)
    {
        $this->cod_venta = $cod_venta;
    }
    function getcod_venta()
    {
        return $this->cod_venta;
    }
    function setlpa($lpa)
    {
        $this->lpa = $lpa;
    }
    function getlpa()
    {
        return $this->lpa;
    }
    function setmodo($modo)
    {
        $this->modo = $modo;
    }
    function getmodo()
    {
        return $this->modo;
    }
    function setdoc_alt($doc_alt)
    {
        $this->doc_alt = $doc_alt;
    }
    function getdoc_alt()
    {
        return $this->doc_alt;
    }
    function setoperacion($operacion)
    {
        $this->operacion = $operacion;
    }
    function getoperacion()
    {
        return $this->operacion;
    }
    function setbanco($banco)
    {
        $this->banco = $banco;
    }
    function getbanco()
    {
        return $this->banco;
    }
    function setcuenta_cliente($cuenta_cliente)
    {
        $this->cuenta_cliente = $cuenta_cliente;
    }
    function getcuenta_cliente()
    {
        return $this->cuenta_cliente;
    }
    function setdias_limite($dias_limite)
    {
        $this->dias_limite = $dias_limite;
    }
    function getdias_limite()
    {
        return $this->dias_limite;
    }

    function setcredito_limite($credito_limite)
    {
        $this->credito_limite = $credito_limite;
    }
    function getcredito_limite()
    {
        return $this->credito_limite;
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

    function getErrSQL()
    {
        return $this->msg_err;
    }

    function getClients()
    {
        $query = "SELECT * FROM cliente WHERE estatus = 'Activo' ORDER BY CAST(id_cliente AS UNSIGNED) LIMIT :startIndex,:perPage";
        $statement = $this->db->prepare($query);

        $statement->bindParam(":startIndex", $this->startIndex, PDO::PARAM_INT);
        $statement->bindParam(":perPage", $this->perPage, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getViewClients()
    {
        $query = "SELECT * FROM clientes WHERE estatus = 'Activo' ORDER BY CAST(id_cliente AS UNSIGNED) asc LIMIT :startIndex,:perPage";
        $statement = $this->db->prepare($query);

        $statement->bindParam(":startIndex", $this->startIndex, PDO::PARAM_INT);
        $statement->bindParam(":perPage", $this->perPage, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function saveClient()
    {
        try {
            $query = "INSERT INTO 
            cliente (id_cliente, estatus, nombre_completo, rfc, mail, 
            clasificacion, estado, municipio, poblacion, telefono, texto, remision, factura, 
            cfdi, mdp_sat, com_remision, com_factura, cod_venta, lpa, modo, 
            doc_alt, operacion, banco, cuenta_cliente, dias_limite, credito_limite)
             VALUES (:arg1,:arg2,:arg3,:arg4,:arg5,:arg6,:arg7,:arg8,:arg9,:arg10,:arg11,:arg12,:arg13,:arg14
             ,:arg15,:arg16,:arg17,:arg18,:arg19,:arg20,:arg21,:arg22,:arg23,:arg24,:arg25,:arg26)";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":arg1", $this->id_cliente);
            $statement->bindParam(":arg2", $this->estatus);
            $statement->bindParam(":arg3", $this->nombre_completo);
            $statement->bindParam(":arg4", $this->rfc);
            $statement->bindParam(":arg5", $this->mail);
            $statement->bindParam(":arg6", $this->clasificacion);
            $statement->bindParam(":arg7", $this->estado);
            $statement->bindParam(":arg8", $this->municipio);
            $statement->bindParam(":arg9", $this->poblacion);
            $statement->bindParam(":arg10", $this->telefono);
            $statement->bindParam(":arg11", $this->texto);
            $statement->bindParam(":arg12", $this->remision);
            $statement->bindParam(":arg13", $this->factura);
            $statement->bindParam(":arg14", $this->cfdi);
            $statement->bindParam(":arg15", $this->mdp_sat);
            $statement->bindParam(":arg16", $this->com_remision);
            $statement->bindParam(":arg17", $this->com_factura);
            $statement->bindParam(":arg18", $this->cod_venta);
            $statement->bindParam(":arg19", $this->lpa);
            $statement->bindParam(":arg20", $this->modo);
            $statement->bindParam(":arg21", $this->doc_alt);
            $statement->bindParam(":arg22", $this->operacion);
            $statement->bindParam(":arg23", $this->banco);
            $statement->bindParam(":arg24", $this->cuenta_cliente);
            $statement->bindParam(":arg25", $this->dias_limite);
            $statement->bindParam(":arg26", $this->credito_limite);
            return $statement->execute();
        } catch (PDOException $e) {
            $this->msg_err = $e->getMessage();
            return $e->getMessage();
        }
    }

    function getCount()
    {
        $query = "SELECT COUNT(id_cliente) as counts FROM cliente where estatus='Activo'";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    function getClientById()
    {
        $query = "SELECT * FROM cliente WHERE id_cliente=:idCte";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idCte", $this->id_cliente);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateClientById()
    {
        $query = "UPDATE cliente set estatus=:sta,nombre_completo=:nme,rfc=:rfc,mail=:mail,clasificacion=:clsf
        ,estado=:edo,municipio=:mun,poblacion=:pob,telefono=:tel,texto=:txt,remision=:rem,factura=:fac,cfdi=:cfdi
        ,mdp_sat=:sat,com_remision=:crem,com_factura=:cfact,cod_venta=:vta,lpa=:lpa,modo=:mdo,doc_alt=:doc,operacion=:op,
        banco=:bco,cuenta_cliente=:cta_cte,dias_limite=:dl,credito_limite=:cdto_limite WHERE id_cliente=:idCte";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idCte", $this->id_cliente);
        $statement->bindParam(":sta", $this->estatus);
        $statement->bindParam(":nme", $this->nombre_completo);
        $statement->bindParam(":rfc", $this->rfc);
        $statement->bindParam(":mail", $this->mail);
        $statement->bindParam(":clsf", $this->clasificacion);
        $statement->bindParam(":edo", $this->estado);
        $statement->bindParam(":mun", $this->municipio);
        $statement->bindParam(":pob", $this->poblacion);
        $statement->bindParam(":tel", $this->telefono);
        $statement->bindParam(":txt", $this->texto);
        $statement->bindParam(":rem", $this->remision);
        $statement->bindParam(":fac", $this->factura);
        $statement->bindParam(":cfdi", $this->cfdi);
        $statement->bindParam(":sat", $this->mdp_sat);
        $statement->bindParam(":crem", $this->com_remision);
        $statement->bindParam(":cfact", $this->com_factura);
        $statement->bindParam(":vta", $this->cod_venta);
        $statement->bindParam(":lpa", $this->lpa);
        $statement->bindParam(":mdo", $this->modo);
        $statement->bindParam(":doc", $this->doc_alt);
        $statement->bindParam(":op", $this->operacion);
        $statement->bindParam(":bco", $this->banco);
        $statement->bindParam(":cta_cte", $this->cuenta_cliente);
        $statement->bindParam(":dl", $this->dias_limite);
        $statement->bindParam(":cdto_limite", $this->credito_limite);
        return $statement->execute();
    }

    function deleteClient()
    {
        $query = "UPDATE cliente set estatus='Suspendido' WHERE id_cliente=:idCte";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idCte", $this->id_cliente);
        return $statement->execute();
    }


    function getLastID()
    {
        $query = "SELECT CASE WHEN MAX(id_cliente)+1 IS NULL THEN 0 ELSE  MAX(id_cliente)+1 END AS ID FROM cliente";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    function getMessageERROR()
    {
        require_once('../diccionario.php');
        $sqlMessage = $this->msg_err;
        return getMessageSQL($sqlMessage);
    }

    function valDoc(){
        $query = "SELECT DOC_ALT FROM CLIENTE WHERE ID_CLIENTE=:idCliente";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":idCliente", $this->id_cliente);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function searchClient(){
        if ($this->doc_alt == "Remision") {
            // $query = "SELECT * FROM (SELECT @primid_cliente :={:idCliente} cliente) alias, COTIZACIONREMISION";
            $query = "SELECT * FROM (SELECT @primid_cliente := :idCliente cliente) alias, cotizacionRemision2;";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idCliente", $this->id_cliente,PDO::PARAM_INT);
            // echo'SELECT * FROM cotizacionRemision2(SELECT @primid_cliente := :idCliente cliente) alias, cotizacionFactura2';
        } else if($this->doc_alt == "Factura"){
            // $query = "SELECT * FROM (SELECT @primid_cliente :={:idCliente} cliente) alias, COTIZACIONFACTURA";
            $query = "SELECT * FROM (SELECT @primid_cliente :=:idCliente cliente) alias, cotizacionFactura2;";
            $statement = $this->db->prepare($query);
            $statement->bindParam(":idCliente", $this->id_cliente,PDO::PARAM_INT);
        }
        
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fillSelectClient(){
        $query = "SELECT ID_CLIENTE,NOMBRE_COMPLETO FROM cliente ORDER BY NOMBRE_COMPLETO ASC";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    


    function getClientBySeller(){
        $query = "SELECT id_cliente,nombre_completo FROM cliente WHERE clasificacion = :clasificacionnn";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":clasificacionnn", $this->clasificacion,PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
}
