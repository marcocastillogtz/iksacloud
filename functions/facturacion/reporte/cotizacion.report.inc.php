<?php


require_once("../../../entidades/Pedido.php");
$Pedido = new Pedido;

if (isset($_GET['id']) && isset($_GET['doc']) && isset($_GET['lp'])) {
    cotizacionReport($Pedido);

} else {
    echo 'Sin Parametros';
}


function cotizacionReport($Pedido)
{
    include_once("../../../functions/phpjasperxml/PHPJasperXML.inc.php");
    include_once("../../../functions/phpjasperxml/sample/setting.php");
    $PHPJasperXML = new PHPJasperXML();

    $varHost='192.168.0.38';
    $varUser='Marco';
    $varPassword='Cbsu_it2024!';
    $varDatabase='iksasocket';


    $Pedido->setId($_GET['id']);
    $Pedido->setDocumento($_GET['doc']);
    $Pedido->setListaPrecio($_GET['lp']);

    $moduleData = $Pedido->cotizacionReport();

    if ($moduleData) {
        $PHPJasperXML->arrayParameter = array("idOrder" => $_GET['id'], "Comentario" => "Sin Comentario");

        if ($_GET['lp'] == 24 && ($_GET['doc'] == "Remision" || $_GET['doc'] == "Mixto") ) {

            $PHPJasperXML->load_xml_file('../../Reportes/Ventas/CartaMaestra_2_conIva.jrxml');
        } else if ($_GET['doc'] == "Mixto"){

            $PHPJasperXML->load_xml_file('../../Reportes/Ventas/CartaMaestra_2.jrxml');
        }else if($_GET['doc'] == "Remision"){
            
            $PHPJasperXML->load_xml_file('../../Reportes/Ventas/CartaMaestra.jrxml');
        }else if($_GET['doc'] == "Factura"){
          
            $PHPJasperXML->load_xml_file('../../Reportes/Ventas/CartaMaestra_f.jrxml');
        }
        
        // $PHPJasperXML->debugsql = true;
        $dbdriver= "mysql";
        $PHPJasperXML->transferDBtoArray($varHost,$varUser,$varPassword,$varDatabase,$dbdriver);
        $PHPJasperXML->outpage('I');

    } else {
        echo 'No regreso ningun resultado';
    }
    
}

