<?php
if (isset($_GET["id"]) && isset($_GET["user"])) {
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
    $var_id = $_GET['id'];
    $var_user = $_GET['user'];

    $VAR_HOST = '192.168.0.38';
    $VAR_USER = 'Marco';
    $VAR_PASSWORD = 'Cbsu_it2024!';
    $VAR_DATABASE = 'iksasocket';

    $json = null;
    $Pedido->setId($var_id);
    $moduleData = $Pedido->genReportPaqueteria();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            require '../../phpjasperxml/PHPJasperXML.inc.php';
            require '../../phpjasperxml/sample/setting.php';

            $PHPJasperXML = new PHPJasperXML();
            $PHPJasperXML->arrayParameter=array("ID_PEDIDO"=>$row['PEDIDO'],"VAR_NAME"=>$row['NOMBRE_COMPLETO'],"ID_CLIENTE"=> $row['CLIENTE'],"VAR_USER"=> $var_user,"VAR_FOLIO"=>$row['FOLIO'],"VAR_VENDEDOR"=>$row['VENDEDOR']);
            $PHPJasperXML->load_xml_file("../../Reportes/Ventas/Paqueteria.jrxml");

            $PHPJasperXML->transferDBtoArray($VAR_HOST,$VAR_USER,$VAR_PASSWORD,$VAR_DATABASE);
            $PHPJasperXML->outpage('I');
        }
    } else {
        $json[] = array(
            'validation' => 0
        );
    }
    
    //$searchOrder="SELECT * FROM (SELECT @primid_pedido :={$var_id} PEDIDO) alias, VISTA_REPORTPEDIDO;";

   /*
    if ($moduleData) {
        require('../../phpjasperxml/PHPJasperXML.inc.php');
        require('../../phpjasperxml/sample/setting.php');
        $host = '192.168.0.38';
        $user = 'Marco';
        $password ='Cbsu_it2024!';
        $database = 'iksasocket';


        foreach ($moduleData as $row) {
 
            // echo $row['PEDIDO'].'<br>';
            // echo $row['ID'].'<br>';
            // echo $row['CLIENTE'].'<br>';
            // echo $row['NOMBRE_COMPLETO'].'<br>';
            // echo $row['VENDEDOR'].'<br>';
            // echo $row['FOLIO'].'<br>';

            $PHPJasperXML = new PHPJasperXML();
            $PHPJasperXML->arrayParameter=array("ID_PEDIDO"=>$row['PEDIDO'],"VAR_NAME"=>$row['NOMBRE_COMPLETO'],"ID_CLIENTE"=> $row['CLIENTE'],"VAR_USER"=> $var_user,"VAR_FOLIO"=>$row['FOLIO'],"VAR_VENDEDOR"=>$row['VENDEDOR']);
            // $PHPJasperXML->debugsql = true;
            
            $PHPJasperXML->load_xml_file("../../Reportes/Ventas/Paqueteria.jrxml");
            $PHPJasperXML->transferDBtoArray($host,$user,$password,$database);
            $PHPJasperXML->outpage('I');
            
        }
    } else {
        $json[] = array(
            'validation' => 0
        );
    }

    return $json;
    */

    

}
