<?php
    if (isset($_GET['arrData'])) {
        require_once("../../entidades/Pedido.php");
        $Pedido = new Pedido;

        require_once("../../entidades/Clientes.php");
        $Cliente = new Clientes;

        require_once("../../entidades/XLScartaPorte.php");
        $XLScartaPorte = new XLScartaPorte;

        require_once("../../entidades/BancosClientes.php");
        $BancoClientes = new BancosClientes;

        $response = "";

        $data = $_GET['arrData'];
        // if ($data[0] == "getClienteRelacionDoc") {
        //     $response = getClienteRelacionDoc($Cliente);
        // }
        if ($data[0] == "getBancoRelacionDoc") {
            $response = getBancoRelacionDoc($BancoClientes);
        }else if($data[0] == "searchPedidoRelationDocs"){
            $response = searchPedidoRelationDocs($Pedido);
        }else if($data[0] == "getRelacionDocs"){
            $response = getRelacionDocs($XLScartaPorte);
        }
        
        else{
            $response = array('action' => 'none', 'validation' => 211, 'message' => 'No se tiene el modo de filtro.');
        }

        echo json_encode($response);
    } else {
        $response = null;
        $response[] = array('action' => 'none', 'validation' => 404, 'message' => 'No se recibieron parametros.');
        echo json_encode($response);
    }
    
    function getRelacionDocs($XLScartaPorte){
        $json = null;
        $moduleData = $XLScartaPorte->getRelacionDocs();

        if ($moduleData) {
            foreach ($moduleData as $row) {
                $json[] = array(
                    'validation' => 1,
                    'id' => $row['id'],
                    'metodo_envio'=> $row['metodo_envio'],
                    'folio' => $row['folio'],
                    'layout_r' => $row['layout_r'],
                    'layout_f' => $row['layout_f'],
                    'documento' => $row['documento']

                );
            }
        } else {
            $json[] = array(
                'validation' => 0,
                'message' => 'Sin resultados'
            );
        }
        return $json;
    }
/*
    function getClienteRelacionDoc($Cliente) {
        $json = null;
        $moduleData = $Cliente->fillSelectClient();
        // var_dump($moduleData);

        if ($moduleData) {
            foreach ($moduleData as $row) {
                $json[] = array(
                    'validation' => 1,
                    'cliente' =>$row['NOMBRE_COMPLETO']
                    
                );
            }    
        }else{
            $json[] = array(
                'validation' => 0,
                'message' => 'Sin resultados'
            );
        }

        return $json;
    }
*/
function getBancoRelacionDoc($BancoClientes){
    $json  = null;
    $data = $_GET['arrData'];
    $moduleData = $BancoClientes->getBancos();

    if ($moduleData) {
        foreach ($moduleData as $row) {
           $json[] = array(
                'validation' => 1,
                'idBanco' => $row['id_banco'],
                'descBanco' => $row['desc_banco']
           );
        }
    } else {
        $json[] = array(
            'validation' => 0
        );
    }
    return $json;
    
}
    
    function searchPedidoRelationDocs($Pedido) {
        // echo'holaaa';
        $json = null;
        $data = $_GET['arrData'];
        $Pedido->setBanco($data[1]);  
        $Pedido->setFecha($data[2]); 
        $Pedido->setFecha2($data[3]); 

        $moduleData = $Pedido->searchPedidoRelationDocs();
        
        // var_dump($moduleData);
        if ($moduleData) {
            foreach ($moduleData as $row) {
                $json[] = array(
                    'validation' => 1,
                    'id' => $row['id'],
                    'metodo_envio' => $row['metodo_envio'],
                    'folio' => $row['folio_parent'],
                    'layout_r' => $row['layout_r'],
                    'layout_f' => $row['layout_f'],
                    'documento' => $row['documento']
                    
                );
            }
        } else {
            $json[] = array(
                'validation' => 0,
                'message' => 'Sin Resultados'
            );
        }
        return $json;
    }