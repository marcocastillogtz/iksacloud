<?php
if (isset($_GET['arrData'])) {
    require_once("../../entidades/Pedido.php");
    $Pedido = new Pedido();

    require_once("../../entidades/Usuario.php");
    $Usuario = new Usuario();

    require_once("../../entidades/Clientes.php");
    $Cliente = new Clientes();

    $response = "";
    $data = $_GET['arrData'];

    if ($data[0] == "historialPedidos") {
        $response = historialPedidos($Pedido);
    }else if ($data[0] == "fillSelectSellers") {
        $response = fillSelectSellers($Usuario);
    }else if ($data[0] == "fillSelectClient") {
        $response = fillSelectClient($Cliente);
    }else if ($data[0] == "buscarPedido") {
        $response = buscarPedido($Pedido);
    }else if ($data[0] == "eliminarPedidoHistorialModal") {
        $response = eliminarPedidoHistorialModal($Pedido);
    }else{
        $response = array('action' => 'none', 'validation' => 211, 'message' => 'No se tiene el modo de filtro.');
    }

echo json_encode($response);
} else {
    $response = null;
    $response[] = array('action' => 'none', 'validation' => 404, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}

function eliminarPedidoHistorialModal($Pedido){
    // arrData.push('eliminarPedidoHistorialModal');
    // arrData.push(id);
    $json = null;

    $data = $_GET['arrData'];
    $Pedido->setId($data[1]);
    $moduleData = $Pedido->deleteDepositosAut();

    if ($moduleData) {
       $json[] = array(
            'validation' => 1
       );

    } else {
        $json[] = array(
            'validation'=> 0
        );
    }
    return $json;
}


function buscarPedido($Pedido){
    $json = null;
    
    $data = $_GET['arrData'];
    $Pedido->setVendedor($data[1]);
    $Pedido->setCliente($data[2]);
    $Pedido->setEstatus($data[3]);
    $Pedido->setFecha($data[4]);

    $moduleData = $Pedido->buscarPedido();
    // echo $moduleData;
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation'=> 1,
                'id'=>$row['id'],
                'cliente'=>$row['nombre_completo'],
                'vendedor'=>$row['vendedor'],
                'hora'=>$row['hora'],
                'fecha'=>$row['fecha'],
                'observacion'=>$row['observacion'],
                'estatus'=>$row['estatus'],

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

function fillSelectSellers($Usuario){
    $json = null;
    $moduleData = $Usuario->getUsers();
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'id'=> $row['ID'],
                'usuario' => $row['USUARIO'],
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

function fillSelectClient($Cliente){
    $json = null;
    $moduleData = $Cliente->fillSelectClient();
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'id' => $row['ID_CLIENTE'],
                'cliente' => $row['NOMBRE_COMPLETO']
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


function historialPedidos($Pedido){
    $json = null;
    $moduleData = $Pedido->historialPedidos();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'id' => $row['id'],
                'vendedor' => $row['vendedor'],
                'cliente' => $row['cliente'],
                'observacion' => $row['observacion'],
                'fecha' => $row['fecha'],
                'hora' => $row['hora'],
                'folio' => $row['folio'],
                'estatus' => $row['estatus'],
                'monto' => $row['monto']
            );
        }
    } else {
            $json[] = array(
                'validation' => 0,
                'message' => 'No se encontro informacion en la base de datos',
            );
    }
    return $json;
}