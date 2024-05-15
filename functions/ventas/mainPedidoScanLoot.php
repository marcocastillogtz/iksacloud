<?php
if (isset($_GET['arrData'])) {
        require_once("../../entidades/Pedido.php");
        $Pedido = new Pedido();

        require_once("../../entidades/Login.php");
        $Login = new login();

        $response = "";
        $data = $_GET['arrData'];

        if ($data[0] == "pedidosScanLoot") {
            $response = pedidosScanLoot($Pedido);
        }else if ($data[0] == "getInformationAlmacen"){
            $response = getInformationAlmacen($Pedido);
        }else if ($data[0] == "getLooter"){
            $response = getLooter($Login);
        }else if ($data[0] == "asignarSurtido"){
            $response = asignarSurtido($Pedido);
        }else{
            
            $response = array('action' => 'none', 'validation' => 211, 'message' => 'No se tiene el modo de filtro.');
        }
        
    echo json_encode($response);
} else {
    $response = null;
    $response[] = array('action' => 'none', 'validation' => 404, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}

function asignarSurtido($Pedido){
    $json = null;
    $data = $_GET['arrData'];
    $Pedido->setId($data[1]);
    $Pedido->setPrioridad($data[2]);

    $moduleData = $Pedido->enviarPedido();

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

function getLooter($Login){
    $json = null;
    $data = $_GET['arrData'];
    $Login->setEstatus($data[1]);
    $moduleData = $Login->getLooter1();    

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'nombre' => $row['NOMBRE'],
                'rol' => $row['roll'],
                'descripcion' => $row['descripcion'],
                'token'=> $row['token']
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

function getInformationAlmacen($Pedido){
    $json = null;
    $data = $_GET['arrData'];
    $Pedido->setId($data[1]);
    $moduleData = $Pedido->getInformationAlmacen();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'id' => $row['id'],
                'pzs' => $row['pieza'],
                'badge' => $row['emblema'],
                'paq' => $row['paquete'] 
            );
        }
    } else {
        $json[] = array(
            'validation' => 0,
            'message' =>'Sin resultados'
        );
    }
    return $json;
    
}

function pedidosScanLoot($Pedido){
    $json = null;
    $moduleData = $Pedido->pedidosScanLoot();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[]=array(
                'validation'=> 1,
                'id'=>$row['ID'],
                'cliente'=>$row['NOMBRE_COMPLETO'],
                'observacion'=>$row['OBSERVACION'],
                'fecha'=>$row['FECHA'],
                'estatus'=>$row['ESTATUS'],
                'autorizado'=>$row['AUTORIZADO'],
                'prioridad'=>$row['PRIORIDAD'],
                'vendedor'=>$row['VENDEDOR'],
            );
        }
       
    } else {
        $json[] = array(
            'validation' => 0
        );
    }
    return $json;
}