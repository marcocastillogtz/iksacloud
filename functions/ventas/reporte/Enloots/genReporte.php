<?php
    if (isset($_GET['order']) && isset($_GET['user'])) {
        genReport();
    } else {
        echo json_encode(array(
            'error' => array(
                'code' => 400,
                'message' => 'Sin parametros :(ssss',
            ),
        ));
    }

    function genReport(){
        $id = $_GET['order'];
        $user = $_GET['user'];
        
        $VAR_HOST = '192.168.0.38';
        $VAR_USER = 'Marco';
        $VAR_PASSWORD = 'Cbsu_it2024!';
        $VAR_DATABASE = 'iksasocket';

        require '../../../phpjasperxml/PHPJasperXML.inc.php';
        require '../../../phpjasperxml/sample/setting.php';

        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->arrayParameter = array("ID_PEDIDO" => $id, "Observacion" => $user);
        $PHPJasperXML->load_xml_file("../../../Reportes/Ventas/scanloot.jrxml");

        $PHPJasperXML->debugsql = false;
        $PHPJasperXML->transferDBtoArray($VAR_HOST,$VAR_USER,$VAR_PASSWORD,$VAR_DATABASE);
        $PHPJasperXML->outpage('I');

    }
    