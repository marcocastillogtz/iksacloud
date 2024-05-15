<?php
include_once("../../phpjasperxml/PHPJasperXML.inc.php");
include_once('../../phpjasperxml/sample/setting.php');

require("../../../dataAccess/Local/Config/configDb.php");
require("../../../dataAccess/Local/ClassConnectionMySQL.php");
$NewConn = new ConnectionDB();
$NewConn->CreateConnection();

if (isset($_GET['submit']) && isset($_GET['fac']) && isset($_GET['rem']) && isset($_GET['comment'])&&isset($_GET['lp'])) {
  $pedido = $_GET['submit'];
  $factura = $_GET['fac'];
  //$order = $_GET['order'];
  $remision = $_GET['rem'];
  $id_xls = 0;
  $comentario = $_GET['comment'];
  $listadeprecio =$_GET['lp'];
  $id_cliente = 0; 
  $idVendedor = null;
  $folio_parent = null;
  $tipoDocumento = null;
  $tipoEnvio = null;
  $idlayout = 0;
  $metodo_pago = null;
  $forma_pago_sat = null;
  $uso_cfdi = null;
  $clave_vendedor_remision = null;
  $clave_vendedor_factura = null;


  function getSerial($valor)
  {
    $var_return = "0";
    $longitud = strlen($valor);
    if ($longitud == 1) {
      $var_return = "000000000";
    } else if ($longitud == 2) {
      $var_return = "00000000";
    } else if ($longitud == 3) {
      $var_return = "0000000";
    } else if ($longitud == 4) {
      $var_return = "000000";
    } else if ($longitud == 5) {
      $var_return = "00000";
    } else if ($longitud == 6) {
      $var_return = "0000";
    } else if ($longitud == 7) {
      $var_return = "000";
    } else if ($longitud == 8) {
      $var_return = "00";
    } else if ($longitud == 9) {
      $var_return = "0";
    } else if ($longitud == 10) {
      $var_return = "";
    }
    return $var_return;
  }

  function getCustomer($id)
  {
    $var_return = "0";
    $valor = is_numeric($id);
    if ($valor == true) {
      $lenght = strlen($valor);
      if ($lenght == 1) {
        $var_return = "00";
      } else if ($lenght == 2) {
        $var_return = "0";
      }
      return $var_return . "" . $id;
    } else {
      return $id;
    }
  }

  $select_p = "SELECT * FROM PEDIDO WHERE ID='$pedido' OR FOLIO='$pedido'";
  $result = $NewConn->ExecuteQuery($select_p);
  if ($result) {

    if ($pedido_detalle = $NewConn->GetRows($result)) {
      $PHPJasperXML = new PHPJasperXML("en", "XLS");

      $folio_layout = $pedido_detalle[9];
      $tipoDocumento = $pedido_detalle[5];
      $tipoEnvio = $pedido_detalle[8];
      $document = substr($tipoDocumento, 0, 1);
      $idVendedor = $pedido_detalle[2];
      $id_cliente = $pedido_detalle[1];
    }

    $select_layout = "SELECT MAX(ID) AS ID, 
    CASE WHEN ID IS NULL THEN  0
    ELSE MAX(ID) END AS ID_ROW
    FROM XLSCARTAPORTE WHERE DOCUMENTO='{$pedido_detalle[5]}' AND PEDIDO=$pedido";

    $result_idlayout = $NewConn->ExecuteQuery($select_layout);

    if ($result_idlayout) {

      if ($layoutxls = $NewConn->GetRows($result_idlayout)) {
        $idlayout = $layoutxls[1];
      }
      $code = null;
      $next_idLayout = $id_xls;
      $next_idLayout;
      $FOLIO = null;

      /*is decrepeted */
       setlocale(LC_TIME, "es_MX");
       $FechaHoy = strftime("%d/%m/%Y");

      // $FechaHoy = DateTimeImmutable::createFromFormat('U',time());
      // $FechaHoy->format('d-m-Y');

      $ClaveEsqImpuesto = 1;
      $NumAlmacen = 1;
      $iva = 16;

      $select_cliente = "SELECT METODO_DE_PAGO,FORMA_PAGO_SAT,CFDI,COM_REMISION,COM_FACTURA FROM CLIENTE WHERE ID_CLIENTE='$id_cliente'";
      $result_cliente = $NewConn->ExecuteQuery($select_cliente);

      if ($result_cliente) {
        if ($info_cliente = $NewConn->GetRows($result_cliente)) {
          $metodo_pago = $info_cliente[0];
          $forma_pago_sat = $info_cliente[1];
          $uso_cfdi = $info_cliente[2];
          $clave_vendedor_remision = $info_cliente[3];
          $clave_vendedor_factura = $info_cliente[4];
        }
        if ($document == "F") {
          //factura al 100%
          $FOLIO = $factura;
          $PHPJasperXML->arrayParameter = array("FechaA" => $FechaHoy, "NumAlmacen" => $NumAlmacen, "ClaveEsqImpuesto" => $ClaveEsqImpuesto, "IVA" => $iva, "ID_DETALLE" => $pedido, "FOLIO_LAYOUT" => $FOLIO, "ID_VENDEDOR" => $clave_vendedor_factura, "METODO_PAGO" => $metodo_pago, "FORMA_PAGO_SAT" => $forma_pago_sat, "USO_CFDI" => $uso_cfdi, "Observaciones" => $comentario);
          $PHPJasperXML->load_xml_file("../../Reportes/facturacion/2021/FLayoutSAEFactura.jrxml");
          $dbdriver = "mysql";
          $PHPJasperXML->transferDBtoArray($VAR_HOST,$VAR_USER,$VAR_PASSWORD,$VAR_DATABASE,$dbdriver);
          $PHPJasperXML->outpage('D', $FOLIO . ".xls");
          $INSERT_LAYOUT = "INSERT INTO XLSCARTAPORTE (ID,CLIENTE,PEDIDO,FOLIO_PARENT,LAYOUT_F,DOCUMENTO) VALUES($pedido,$id_cliente,$pedido,'$folio_layout','$factura','$tipoDocumento') ON DUPLICATE KEY UPDATE LAYOUT_F='$factura';";
          $result_insert = $NewConn->ExecuteQuery($INSERT_LAYOUT);
        } else if ($document == "R" && $listadeprecio<>24) {
          //factura al 40%
          $FOLIO = $factura;
          $PHPJasperXML->arrayParameter = array("FechaA" => $FechaHoy, "NumAlmacen" => $NumAlmacen, "ClaveEsqImpuesto" => $ClaveEsqImpuesto, "IVA" => $iva, "ID_DETALLE" => $pedido, "FOLIO_LAYOUT" => $FOLIO, "ID_VENDEDOR" => $clave_vendedor_factura, "Observaciones" => $comentario);
          $PHPJasperXML->load_xml_file("../../Reportes/facturacion/2023/Mixto/factura_40.jrxml"); // factura 40% mas iva
          $dbdriver = "mysql";
          $PHPJasperXML->transferDBtoArray($VAR_HOST,$VAR_USER,$VAR_PASSWORD,$VAR_DATABASE,$dbdriver);
          $PHPJasperXML->outpage('D', $FOLIO . ".xls");
          $INSERT_LAYOUT = "INSERT INTO XLSCARTAPORTE (ID,CLIENTE,PEDIDO,FOLIO_PARENT,LAYOUT_F,DOCUMENTO) VALUES($pedido,$id_cliente,$pedido,'$folio_layout','$factura','$tipoDocumento') ON DUPLICATE KEY UPDATE LAYOUT_F='$factura';";
          $result_insert = $NewConn->ExecuteQuery($INSERT_LAYOUT);
        }else{
          $FOLIO = $factura;
          $PHPJasperXML->arrayParameter = array("FechaA" => $FechaHoy, "NumAlmacen" => $NumAlmacen, "ClaveEsqImpuesto" => $ClaveEsqImpuesto, "IVA" => $iva, "ID_DETALLE" => $pedido, "FOLIO_LAYOUT" => $FOLIO, "ID_VENDEDOR" => $clave_vendedor_factura, "Observaciones" => $comentario);
          // $PHPJasperXML->load_xml_file("../../Reportes/facturacion/2021/RLayoutSAEFacSinIva.jrxml");
          $PHPJasperXML->load_xml_file("../../Reportes/facturacion/2023/Mixto/factura_40sinIva.jrxml"); // factura 40% mas iva
          $dbdriver = "mysql";
          $PHPJasperXML->transferDBtoArray($VAR_HOST,$VAR_USER,$VAR_PASSWORD,$VAR_DATABASE,$dbdriver);
          $PHPJasperXML->outpage('D', $FOLIO . ".xls");
          $INSERT_LAYOUT = "INSERT INTO XLSCARTAPORTE (ID,CLIENTE,PEDIDO,FOLIO_PARENT,LAYOUT_F,DOCUMENTO) VALUES($pedido,$id_cliente,$pedido,'$folio_layout','$factura','$tipoDocumento') ON DUPLICATE KEY UPDATE LAYOUT_F='$factura';";
          $result_insert = $NewConn->ExecuteQuery($INSERT_LAYOUT);
        }
        $UPDATE_PEDIDO = "UPDATE PEDIDO SET ESTATUS='FT' WHERE ID='{$pedido}'";
        $result_update = $NewConn->ExecuteQuery($UPDATE_PEDIDO);

        $INSERT_DOC = "INSERT INTO FACTURA (ID,PEDIDO,COT_SAE) VALUES($pedido,$pedido,'$factura') ON DUPLICATE KEY UPDATE COT_SAE='$factura' ";
        $result_inser_doc = $NewConn->ExecuteQuery($INSERT_DOC);

        $NewConn->SetFreeResult($result);
        $NewConn->SetFreeResult($result_idlayout);
        $NewConn->CloseConnection();
      }
    }
  }
}
