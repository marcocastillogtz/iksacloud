<?php

if (isset($_GET['arrData'])) {
        require_once("../../entidades/Pedido.php");
        $Pedido = new Pedido();
    
        require_once("../../entidades/DetallePedido.php");
        $DetallePedido = new DetallePedido();

        require_once("../../entidades/Logistica.php");
        $Logistica = new Logistica();

        $response = "";
        $data = $_GET['arrData'];

        //echo $data[0];

        if ($data[0] == "showPedidoSeguimiento") {
            $response = showPedidoSeguimiento($Pedido);
        }else if ($data[0] == "buscarSeguimiento"){
            $response = buscarSeguimiento($Pedido);
        }else if ($data[0] == "fillSelectLogistica"){
            $response = fillSelectLogistica($Logistica);
        }else if ($data[0] == "sendGuia"){
            $response = sendGuia($Pedido);
        }else if ($data[0] == "changeStatuss"){
            $response = changeStatuss($Pedido);
        }else{
               
            $response = array('action' => 'none', 'validation' => 211, 'message' => 'No se tiene el modo de filtro.');
        }
        
    echo json_encode($response);
} else {
    $response = null;
    $response[] = array('action' => 'none', 'validation' => 404, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}

function buscarSeguimiento($Pedido){
    $json = null;
    $data = $_GET['arrData'];
    $Pedido->setVendedor($data[1]);
    $Pedido->setCliente($data[2]);
    $Pedido->setFecha($data[3]);
    $Pedido->setFecha2($data[4]);

    $moduleData = $Pedido->buscarSeguimiento();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'id' => $row['ID'],
                'cliente'=>$row['CLIENTE'],
                'nombreCliente'=> utf8_encode($row['NOMBRE_COMPLETO']),
                'estatus' => $row['ESTATUS'],
                'vendedor'=> utf8_encode($row['VENDEDOR']),
                'fecha'=>$row['FECHA'],
                'guia'=>$row['GUIA'],
                'logistica'=>$row['LOGISTICA']
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


function showPedidoSeguimiento($Pedido){
    $json = null;
    // $data = $_GET['arrData'];
    $moduleData = $Pedido->showPedidoSeguimiento();
    
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation'=>1,
                'id' => $row['id'],
                'cliente' => $row['cliente'],
                'nombreCliente' => $row['nombre_completo'],
                'estatus' => $row['estatus'],
                'vendedor' => $row['vendedor'],
                'fecha' => $row['fecha'],
                'guia' => $row['guia'],
                'logistica'=> $row['logistica']
            );
        }
        
    } else {
        $json[] = array(
            'validation' =>0,
            'message' => 'Sin resultado'
        );
    }
    return $json;   
}

function fillSelectLogistica($Logistica){
    $json = null;
    $moduleData = $Logistica->fillSelectLogistica();

    // var_dump($moduleData);

    if ($moduleData) {
       foreach ($moduleData as $row) {
            $json[] = array(
                'validation'=>1,
                'logistica'=>utf8_decode($row['logistica'])
            );
       }
    } else {
        $json[] = array(
            'validation' =>0,
            'message' =>'Sin Resultados'
        );
    }
    return $json;
}

function sendGuia($Pedido){
    $json = null;
    $data = $_GET['arrData'];
    $Pedido->setId($data[1]);
    $Pedido->setMetodoEnvio($data[2]);
    $Pedido->setLogistica($data[3]);
    $Pedido->setGuia($data[4]);

    $moduleData = $Pedido->sendGuia();

    if ($moduleData) {
        $json[] = array(
            'validation' => 1
        ); 
    } else {
        $json[] = array(
            'validation' => 0
        ); 
    }

    return $json;

}

function changeStatuss($Pedido) {
    $json = null;
    $data = $_GET['arrData'];
    $Pedido->setId($data[1]);

    $moduleData = $Pedido->changeStatuss();

    if ($moduleData) {
        $json[] = array(
            'validation' => 1
        );

    } else {
        $json[] = array(
            'validation' => 0
        );
    }
    return $json;
}