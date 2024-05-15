<?php

if (isset($_GET['arrData'])) {
        require_once("../../entidades/Pedido.php");
        $Pedido = new Pedido;
    
        require_once("../../entidades/DetallePedido.php");
        $DetallePedido = new DetallePedido; 

        require_once("../../entidades/Clientes.php");
        $Cliente = new  Clientes;


        $response = "";
        $data = $_GET['arrData'];
        if ($data[0] == "getDocFacturados") {
            $response = getDocFacturados($Pedido);
        }else if($data[0] == "updateOrder"){
            $response = updateOrder($Pedido);
        }else if($data[0] == "getInfoOrder"){
            $response = getInfoOrder($DetallePedido);
        }else if($data[0] == "getVendedores"){
            $response = getVendedores($Pedido);
        }else if($data[0] == "getClientBySeller"){
            $response = getClientBySeller($Cliente);
        }
        // else if($data[0] == "docsFacturadosReporte"){
        //     $response = docsFacturadosReporte($Cliente);
        // }
        
        else{
            $response = array('action' => 'none', 'validation' => 211, 'message' => 'No se tiene el modo de filtro.');
        }

    echo json_encode($response);
} else {
    $response = null;
    $response[] = array('action' => 'none', 'validation' => 404, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}


function getInfoOrder($DetallePedido) {
    $json =  null;
    $data = $_GET['arrData'];
    $DetallePedido->setIdDetalle($data[1]);   
    
    $moduleData = $DetallePedido->getInfoOrder();
    
    // var_dump($moduleData);

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'vendedor' => $row['vendedor'],
                'precioLista' => $row['precioLista'],
                'folio' => $row['folio']

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



function updateOrder($Pedido){
    $json = null;
    $data = $_GET['arrData'];
    
    $Pedido->setFolio($data[1]);
    $Pedido->setId($data[2]);
    $Pedido->setFactura($data[3]);
    $Pedido->setRemision($data[4]);
    

    /*
    echo 'FOLIO..'.$data[1].'<br>';
    echo 'id..'.$data[2].'<br>';
    echo 'factura..'.$data[3].'<br>';
    echo 'remision..'.$data[4].'<br>';
    */
    
    $moduleData = $Pedido->updateOrderaaaa();

    // var_dump($moduleData);
    
    if ($moduleData) {
        genReportXlsMain($Pedido);
    } else {
        $json[] = array(
            'validation' => 0
        );
    }
    return $json;
}

function genReportXlsMain($Pedido){
    $Pedido->genReportXls();
    // $moduleData = $Pedido->genReportXls();

    // if ($moduleData) {
    //     return 1;
    // } else {
    //     return 2;
    // }
    
}

function getDocFacturados($Pedido){

    $json =  null;
    // $data = $_GET['arrData'];
    // $Pedido->setClave($data[1]);
    
    $moduleData = $Pedido->getDocFacturados();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[]  = array(
                'validation' => 1,
                'id' => $row['ID'],
                'nombre_completo' => $row['NOMBRE_COMPLETO'],
                'folio' => $row['FOLIO'],
                'fecha' => $row['FECHA'],
                'hora' => $row['HORA'],
                'prioridad' => $row['PRIORIDAD'],
                'almacen_a' => $row['ALMACEN_A'],
                'almacen_b' => $row['ALMACEN_B'],
                'piezas' => $row['PIEZAS'],
                'paquetes' => $row['PAQUETES'],
                'id_cliente' => $row['ID_CLIENTE'],
                'clasificacion' => $row['CLASIFICACION'],
                'permiso_factura' => $row['PERMISO_FACTURA'],
                'pieza' => $row['PIEZA'],
                'paquete' => $row['PAQUETE'],
                'emblema' => $row['EMBLEMA'],
                'metodo_envio' => $row['METODO_ENVIO'],
                'estatus' => $row['ESTATUS'],
                'check_pz' => $row['CHECK_PZ'],
                'check_pq' => $row['CHECK_PQ'],
                'check_emb' => $row['CHECK_EMB'],
                'observacion' => $row['OBSERVACION'],
                'pedido' => $row['PEDIDO']

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

function getVendedores($Pedido){
    $json =  null;
    
    $moduleData = $Pedido->getVendedoress();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'clasificacion' => $row['clasificacion'],
                'usuario' => $row['nombre']
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

function getClientBySeller($Cliente){
    $json = null;
    
    // sellerSelect
    $data = $_GET['arrData'];
    $Cliente->setclasificacion($data[1]);
    $moduleData = $Cliente->getClientBySeller();

    //echo $data[1];
    // var_dump($moduleData);

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'idCliente'=>$row['id_cliente'],
                'cliente'=> utf8_decode($row['nombre_completo'])
                
            );
        }
    } else {
        $json[] = array(
            'validation' => 0,
            'message' => 'Sin resultadossss'
        );
    }
    return $json;
}

// function docsFacturadosReporte(){
//     $json = null;
//     $data = $_GET['arrData'];

// }