<?php
if (isset($_GET["id"])&&isset($_GET["user"])) {
    require_once("../../../entidades/Pedido.php");
    $Pedido = new Pedido();
    genReport($Pedido); #se llama al metodo
    
} else { # si no se muestra un mensaje de error 
    echo json_encode(array(
        'error' => array(
            'code' => 400,
            'message' => 'Sin parametros :(',
        ),
    ));
}

function genReport($Pedido)
{
    /*
    require("../../../dataAccess/Local/Config/configDb.php");
    require("../../../dataAccess/Local/ClassConnectionMySQL.php");
    $NewConn = new ConnectionDB();
    $NewConn->CreateConnection();
    */

    $var_id = $_GET['id'];
    $var_user = $_GET['user'];

    $VAR_HOST = '192.168.0.38';
    $VAR_USER = 'Marco';
    $VAR_PASSWORD = 'Cbsu_it2024!';
    $VAR_DATABASE = 'iksasocket';

    $json = null;
    $Pedido->setId($var_id);
    $moduleData = $Pedido->genReportEmblemas();

    if ($moduleData) {
        foreach ($moduleData as $row) {
                require '../../phpjasperxml/PHPJasperXML.inc.php';
                require '../../phpjasperxml/sample/setting.php';

                $PHPJasperXML = new PHPJasperXML();
                $PHPJasperXML->arrayParameter=array("ID_PEDIDO"=>$row['PEDIDO'],"VAR_NAME"=>$row['NOMBRE_COMPLETO'],"ID_CLIENTE"=> $row['CLIENTE'],"VAR_USER"=> $var_user,"VAR_FOLIO"=>$row['FOLIO'],"VAR_VENDEDOR"=>$row['VENDEDOR']);
                $PHPJasperXML->load_xml_file("../../Reportes/Ventas/Emblemas.jrxml");
                //$PHPJasperXML->debugsql = true;
                $PHPJasperXML->transferDBtoArray($VAR_HOST,$VAR_USER,$VAR_PASSWORD,$VAR_DATABASE);
                $PHPJasperXML->outpage('I');
        }
    } else {
        $json[]=array(
            'validation' => 0
        );
    }
    

/*
    $searchOrder="SELECT * FROM (SELECT @primid_pedido :={$var_id} PEDIDO) alias, VISTA_REPORTPEDIDO;";
    $result_order = $NewConn->ExecuteQuery($searchOrder);

    if ($NewConn->GetCountAffectedRows() != null) {

        if ($result_order) {
            if ($row = $NewConn->GetRows($result_order)) {

                require '../../phpjasperxml/PHPJasperXML.inc.php';
                require '../../phpjasperxml/sample/setting.php';

                $PHPJasperXML = new PHPJasperXML();
                $PHPJasperXML->arrayParameter=array("ID_PEDIDO"=>$row[1],"VAR_NAME"=>$row[3],"ID_CLIENTE"=>$row[2],"VAR_USER"=>$var_user,"VAR_FOLIO"=>$row[5],"VAR_VENDEDOR"=>$row[4]);
                $PHPJasperXML->load_xml_file("../../Reportes/Ventas/Emblemas.jrxml");
                //* Importante: Cambiar los parametros de conexion 
                $PHPJasperXML->transferDBtoArray($VAR_HOST,$VAR_USER,$VAR_PASSWORD,$VAR_DATABASE);
                $PHPJasperXML->outpage('I');

            }
            $NewConn->SetFreeResult($result_order);
        } else {
            echo "No se pudo generar el documento";
        }
    }
    $NewConn->CloseConnection();
*/
    }
?>