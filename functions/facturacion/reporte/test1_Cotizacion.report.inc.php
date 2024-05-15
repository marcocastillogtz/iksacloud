<?php
if (isset($_GET["id"]) && isset($_GET["doc"]) && isset($_GET["lp"])) {
    genReport(); #se llama al metodo
} else { # si no se muestra un mensaje de error 
    echo json_encode(array(
        'error' => array(
            'code' => 400,
            'message' => 'Sin parametros :(',
        ),
    ));
}

function genReport()
{
    /*
    require("../../../dataAccess/Local/Config/configDb.php");
    require("../../../dataAccess/Local/ClassConnectionMySQL.php");
    $NewConn = new ConnectionDB();
    $NewConn->CreateConnection();
    */
    $dns='mysql:host=192.168.0.38;dbname=iksasocket';
    $username='Marco';
    $password = 'Cbsu_it2024!';

    require_once("DBC.php");
    $database_object = new DatabaseConnection();
    $this->db = $database_object->connect();
    
    $var_id = $_GET['id'];
    $var_doc = $_GET['doc'];
    $var_lp = $_GET['lp'];
    
    $var_porcentaje_rem = null;
    $var_porcentaje_fac = null;
    $searchOrder = "SELECT * FROM (SELECT @primid_pedido :={$var_id} PEDIDO) alias, VISTA_REPORTPEDIDO_2;";
    $result_order = $NewConn->ExecuteQuery($searchOrder);


    setlocale(LC_TIME, "es_MX");

    $time = date("a");
    if ($time == "am") {
        $time = "pm";
    } else {
        $time = "am";
    }
    $hora = date("G") - 6;
    $fecha = date("d") . "/" . date("m") . "/" . date("Y") . " " . $hora . ":" . date("i") . " " . $time;


    if ($NewConn->GetCountAffectedRows() != null) {

        if ($result_order) {

            if ($row = $NewConn->GetRows($result_order)) {
                $var_porcentaje_rem = substr($row[9], 0, 2);
                $var_porcentaje_fac = substr($row[9], 2, 4);

                require '../../phpjasperxml/PHPJasperXML.inc.php';
                require '../../phpjasperxml/sample/setting.php';

                $PHPJasperXML = new PHPJasperXML();
                // $PHPJasperXML->arrayParameter = array("idOrder" => $row[1], "Cliente" => $row[3], "idCliente" => "(" . $row[2] . ")", "fecha" => $fecha,"porcentaje_r"=>$row[10],"porcentaje_f"=>$row[11],"Observacion"=>$row[12]);
                $PHPJasperXML->arrayParameter = array("idOrder" => $row[1], "Comentario" => "Sin Comentario");

                if ($var_lp==24 && ($var_doc == "Remision" || $var_doc == "Mixto")) {
                    // $PHPJasperXML->load_xml_file("../../Reportes/facturacion/CotizacionFactura.jrxml");
                    $PHPJasperXML->load_xml_file("../../Reportes/facturacion/Carta Maestra/CartaMaestra_2_conIva.jrxml"); //Este documento no tiene iva en sus precios solo se aplica en el iva de la remision
               
                } else if ($var_doc == "Mixto") {
                    $PHPJasperXML->load_xml_file("../../Reportes/facturacion/Carta Maestra/CartaMaestra_2.jrxml");
                
                } else if ($var_doc == "Remision") {
                    // $PHPJasperXML->load_xml_file("../../Reportes/facturacion/CotizacionRem.jrxml");
                    $PHPJasperXML->load_xml_file("../../Reportes/facturacion/Carta Maestra/CartaMaestra.jrxml"); //Este documento se le aplica el iva de los precios

                } else if ($var_doc == "Factura") {
                    $PHPJasperXML->load_xml_file("../../Reportes/facturacion/Carta Maestra/CartaMaestra_f.jrxml");
                }


                // $PHPJasperXML->load_xml_file("../../Reportes/facturacion/Carta Maestra/CartaMaestra.jrxml");
                $PHPJasperXML->debugsql = false;
                $PHPJasperXML->transferDBtoArray($VAR_HOST, $VAR_USER, $VAR_PASSWORD, $VAR_DATABASE);
                $PHPJasperXML->outpage('I');
            }
            $NewConn->SetFreeResult($result_order);
        } else {
            echo "No se pudo generar el documento";
        }
    }
    $NewConn->CloseConnection();
}