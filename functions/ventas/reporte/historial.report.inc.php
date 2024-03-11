<?php
if (isset($_GET["id"]) && isset($_GET["obs"]) && isset($_GET["user"])) {
// if (isset($_GET["orden"]) && isset($_GET["comentario"]) && isset($_GET["user"])) {
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

    // require("../../../dataAccess/Local/Config/configDb.php");
    // require("../../../dataAccess/Local/ClassConnectionMySQL.php");
    // $NewConn = new ConnectionDB();
    // $NewConn->CreateConnection();

    $var_id = $_GET['id'];
    $observacion = $_GET['obs'];


    $VAR_HOST = '192.168.0.38';
    $VAR_USER = 'Marco';
    $VAR_PASSWORD = 'Cbsu_it2024!';
    $VAR_DATABASE = 'iksasocket';


    setlocale(LC_TIME,"es_MX");

    $time =date("a");
    $hora = date("G")-6;
    $fecha= date("d")."/".date("m")."/".date("Y")." ".$hora.":".date("i")." ".$time;


    
    require '../../phpjasperxml/PHPJasperXML.inc.php';
    require '../../phpjasperxml/sample/setting.php';
    $PHPJasperXML = new PHPJasperXML();
    $PHPJasperXML->arrayParameter = array("idOrder" => $var_id, "Observacion" => $observacion, "fecha"=>$fecha);

    // $PHPJasperXML->load_xml_file("../../Reportes/Administracion/ReporteMovimientos.jrxml");
    $PHPJasperXML->load_xml_file("../../Reportes/Ventas/ReporteMovimientos.jrxml");

    $PHPJasperXML->debugsql = false;
    $PHPJasperXML->transferDBtoArray($VAR_HOST,$VAR_USER,$VAR_PASSWORD,$VAR_DATABASE);
    $PHPJasperXML->outpage('I');



}
