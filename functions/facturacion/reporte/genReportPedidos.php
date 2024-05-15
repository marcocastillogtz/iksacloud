<?php

    if (isset($_GET['fechaInicio']) && isset($_GET['fechaFinal']) && isset($_GET['cliente']) && isset($_GET['vendedor']) ) {
        genReport();
    } else {
        echo'Sin Parametros';
    }
    
    function genReport(){
        $fechaInicio = $_GET['fechaInicio'];
        $fechaFinal = $_GET['fechaFinal'];
        $cliente = $_GET['cliente'];
        $vendedor = $_GET['vendedor'];

        require "../../phpjasperxml/PHPJasperXML.inc.php";
        require "../../phpjasperxml/sample/setting.php";
        $file="";
        $PHPJasperXML = new PHPJasperXML();

        $VAR_HOST = '192.168.0.38';
        $VAR_USER = 'Marco';
        $VAR_PASSWORD = 'Cbsu_it2024!';
        $VAR_DATABASE = 'iksasocket';

        if ($vendedor == "*" && $cliente == "*" && $fechaInicio == "null" && $fechaFinal == "null") {
            $PHPJasperXML->arrayParameter = array(
                "CLIENTE" => "Todos","VENDEDOR" => "Todos", "FECHA_A" => "Hasta hoy","FECHA_B" =>"Hasta hoy",
                "QUERY" => "(PEDIDO.ESTATUS = 'PS' OR PEDIDO.ESTATUS = 'FT' )"
            );
            // echo 1;
        }else if ($vendedor != "*"  && $cliente == "*" && $fechaInicio == "null" && $fechaFinal == "null") {
           $PHPJasperXML->arrayParameter = array(
                "CLIENTE" => "Todos","VENDEDOR" => $vendedor,"FECHA_A" => "Hasta hoy","FECHA_B" => "Hasta hoy",
                "QUERY" => "(PEDIDO.ESTATUS = 'PS' OR PEDIDO.ESTATUS = 'FT') AND VENDEDOR = {$vendedor} "
           );
        //    echo 2;
        }else if($vendedor != "*" && $cliente != "*" && $fechaInicio == "null" && $fechaFinal == "null"){
            $PHPJasperXML->arrayParameter = array(
                "CLIENTE" => $cliente,"VENDEDOR" => $vendedor,"FECHA_A" => "Hasta hoy","FECHA_B" => "Hasta hoy",
                "QUERY" => "(PEDIDO.ESTATUS = 'PS' OR PEDIDO.ESTATUS = 'FT') AND VENDEDOR = $vendedor AND PEDIDO.CLIENTE = $cliente " 
            );
            // echo 3;
        }else if ($vendedor == "*" && $cliente == "*" && $fechaInicio != "null" && $fechaFinal != "null"){
            $PHPJasperXML->arrayParameter = array(
                "CLIENTE" => "Todos", "VENDEDOR"=> "Todos","FECHA_A" => $fechaInicio,"FECHA_B" =>$fechaFinal,
                "QUERY" =>"(PEDIDO.ESTATUS = 'PS' OR PEDIDO.ESTATUS = 'FT') AND FECHA BETWEEN '{$fechaInicio}'  AND '{$fechaFinal}' "
            );
            // echo 4;
        }else if($vendedor != "*" && $cliente == "*" && $fechaInicio != "null" && $fechaFinal != "null"){
            $PHPJasperXML->arrayParameter = array(
                "CLIENTE" => "Todos","VENDEDOR" => "Todos","FECHA_A" => $fechaInicio,"FECHA_B" => $fechaFinal,
                "QUERY" =>"(PEDIDO.ESTATUS = 'PS' OR PEDIDO.ESTATUS = 'FT') AND FECHA BETWEEN '{$fechaInicio}' AND '{$fechaFinal}' AND VENDEDOR = $vendedor "
            );
            // echo 5;
        }else if($vendedor != "*" && $cliente != "*" && $fechaInicio != "null" && $fechaFinal != "null"){
            $PHPJasperXML->arrayParameter = array(
                "CLIENTE" => "Todos","VENDEDOR" => "Todos","FECHA_A" => $fechaInicio,"FECHA_B" => $fechaFinal,
                "QUERY" => "(PEDIDO.ESTATUS = 'PS' OR PEDIDO.ESTATUS = 'FT') AND FECHA BETWEEN  '{$fechaInicio}' AND '{$fechaFinal}' AND VENDEDOR = $vendedor AND PEDIDO.CLIENTE = $cliente"
            );
            // echo 6;
        }


        $file="../../Reportes/facturacion/invoiceOrder.jrxml";
        $PHPJasperXML->debugsql=false;
        $PHPJasperXML->load_xml_file($file);
        $PHPJasperXML->transferDBtoArray($VAR_HOST,$VAR_USER,$VAR_PASSWORD,$VAR_DATABASE);
        $PHPJasperXML->outpage('I');

    }

