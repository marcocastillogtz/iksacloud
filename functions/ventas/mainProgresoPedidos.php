<?php
if (isset($_GET['arrData'])) {
    require_once("../../entidades/Pedido.php");
    $Pedido = new Pedido();

    require_once("../../entidades/surtirPedido.php");
    $surtirPedido = new surtirPedido();


    $response = "";
    $data = $_GET['arrData'];

    if ($data[0] == "progresoPedidos") {
        $response = progresoPedidos($Pedido);
    }else if ($data[0] == "autorizarPedido") {
        $response = autorizarPedido($surtirPedido);
    }else{
        $response = array('action' => 'none', 'validation' => 211, 'message' => 'No se tiene el modo de filtro.');
    }

    echo json_encode($response);

} else {
    $response = null;
    $response[] = array('action' => 'none', 'validation' => 404, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}


function autorizarPedido($surtirPedido){
    $json = null;
    
    $data = $_GET['arrData'];

    $surtirPedido->setIdSurtirPedido($data[1]);
    $surtirPedido->setPorcentaje($data[2]);
    $surtirPedido->setUsuario($data[3]);
    $surtirPedido->setObservaciones($data[4]);

    $moduleData = $surtirPedido->autorizarPedido();

    if ($moduleData) {
        $json[]=array(
            'validation' => 1,
        );
    } else {
        $json[]=array(
            'validation' => 0,
        );
    }
 return $json;   
}

function progresoPedidos($Pedido) {
    $json = null;
    $moduleData = $Pedido->progresoPedidos();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'idPedido' => $row['idPedido'],
                'descripcion' => $row['descripcion'],
                'usuario' => $row['usuario'],
                'porcentaje' => $row['porcentaje'],
                'autorizado' => $row['autorizado'],
                'id_surtir' => $row['id_surtirP'],
                'idUsuario' => $row['idUsuario']
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