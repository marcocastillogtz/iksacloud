<?php

if (isset($_GET['arrData'])) {
        require_once("../../entidades/Pedido.php");
        $Pedido = new Pedido;
        
        require_once("../../entidades/DetallePedido.php");
        $DetallePedido = new DetallePedido; 

        $response = "";
        $data = $_GET['arrData'];
        if ($data[0] == "showOrderBack") {
            $response = showOrderBack($Pedido);
        }else if($data[0] == "showProductsDemand"){
            $response = showProductsDemand($Pedido);
        }else if($data[0] == "getDetallePedidoBackOrder"){
            $response = getDetallePedidoBackOrder($Pedido);
        }else if($data[0] == "getDataProductDetallePedido"){
            $response = getDataProductDetallePedido($DetallePedido);
        }else if($data[0] == "getLPInsert"){
            $response = getLPInsert($DetallePedido);
        }else if($data[0] == "getLPUpdate"){
            $response = getLPUpdate($DetallePedido);
        }else if($data[0] == "actualizarPedido"){
            $response = actualizarPedido($Pedido);
        }else if($data[0] == "resetDetallePed"){
            $response = resetDetallePed($DetallePedido);
        }else if($data[0] == "eliminarPartidaBackOrder"){
            $response = eliminarPartidaBackOrder($DetallePedido);
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

function eliminarPartidaBackOrder($DetallePedido){
    $json = null;
    $data = $_GET['arrData'];

    $DetallePedido->setId($data[1]);
    $moduleData=$DetallePedido->eliminarPartidaBackOrder();

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

function resetDetallePed($DetallePedido){
    $json= null;
    $data = $_GET['arrData'];

    $DetallePedido->setId($data[1]);
    $DetallePedido->setFolio($data[2]);
    $DetallePedido->setClave($data[3]);
    
    $moduleData=$DetallePedido->resetDetallePed();

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

function actualizarPedido($Pedido){
    $json = null;
    $data = $_GET['arrData'];   

    $Pedido->setId($data[1]);
    $Pedido->setMetodoEnvio($data[2]);

    $moduleData=$Pedido->actualizarPedido();

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



function getLPUpdate($DetallePedido){
    $json = null;
    $data = $_GET['arrData'];
    // cantidad
    $DetallePedido->setId($data[1]);
    $DetallePedido->setFolioDevolucion($data[2]);
    // $DetallePedido->setFolioDevolucion($data[3]);
    $DetallePedido->setCantidad($data[4]);

    $moduleData = $DetallePedido->getLPUpdate();


    if ($moduleData) {
        $json[] = array(
            'validation' => 1,
            'function' => 'getLPUpdate'
        );
    } else {
        $json[] = array(
            'validation' => 0,
            'function' => 'getLPUpdate'
        );
    }
    return $json;
}

function getLPInsert($DetallePedido){
    $json = null;
    $data = $_GET['arrData'];

    $DetallePedido->setId($data[1]);
    $DetallePedido->setFolio($data[2]);
    $DetallePedido->setFolioDevolucion($data[3]);

    $moduleData = $DetallePedido->getLPInsert(); 

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'function' => 'getLPInsert',
                'ordenFolio' =>$row['ordenFolio']
            );
        }
    } else {
        $json[] = array(
            'validation' => 0
        );
    }

    return $json;
    
}


function getDataProductDetallePedido($DetallePedido){
    $json = null;
    $data = $_GET['arrData'];
    $DetallePedido->setId($data[1]);
    $moduleData = $DetallePedido->getDataProductDetallePedido();

    // var_dump($moduleData);
    if ($moduleData) {
        foreach ($moduleData as $row) {
           $json[] = array(
                'validation' => 1,
                'clave' => $row['CLAVE'],
                'descripcion' => $row['DESCRIPCION'],
                'precio' => $row['PRECIO'],
                'cantidad' => $row['CANTIDAD'],
                'monto' => $row['MONTO'],
                'famOferta' => $row['FAM_OFERTA'], 
           );
        }
    } else {
        $json[]=array(
            'validation' => 0,
            'message' =>'Sin Resultado'
        );
    }
    
    return $json;
}


function getDetallePedidoBackOrder($Pedido){
    $json = null;
    $data = $_GET['arrData'];
    $Pedido->setFolio($data[1]);
    $moduleData = $Pedido->getDetallePedidoBackOrder();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'folio' =>$row['FOLIO'],
                'clave' => $row['CLAVE'],
                'cantidad' => $row['CANTIDAD'],
                'idpedido' => $row['ID_DETALLE'],
                'idDetalle'=> $row['ID']
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


function showOrderBack($Pedido){
    $json =  null;
    $data = $_GET['arrData'];
    $Pedido->setClave($data[1]);
    $moduleData = $Pedido->showOrderBack();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' =>1,
                'folio' => $row['FOLIO'],
                'cliente' => utf8_decode($row['NOMBRE_COMPLETO']),
                'fecha' =>  $row['FECHA'],
                'retraso' => $row['RETRASO'],
                'documento' => $row['DOCUMENTO'],
                'id' => $row['ID']
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

function showProductsDemand($Pedido){
    $json = null;
    $moduleData = $Pedido->showProductsDemand();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] =  array(
                'validation' => 1,
                'clave' => $row['CLAVE'],
                'piezas' => $row['CANTIDAD'],
                'cliente' => $row['NCLIENTE']
            );
        }
        
    } else {
        $json[] =  array(
            'validation' => 0,
            'message' => 'Sin resultados',
        );
        
    }
    return $json;
}


function getLP($Pedido){
    $json = null;
    $moduleData = $Pedido->getLP();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'lp'=> $row['LP'],
                'folio'=> $row['FOLIO'],
                'cliente'=> $row['CLIENTE'],
                'vendedor'=> $row['VENDEDOR'],
                'documento'=> $row['DOCUMENTO'],
                'estatus'=> $row['ESTATUS'],
                'id_detalle'=> $row['ID_DETALLE'],
                'estatusOferta'=> $row['ESTATUS_OFERTA']
            );
        }
    } else {
        $json[] = array(
            'validation' => 0,
            'message' =>'No se obtuvo informacion de la base de datos'
        );
    }
    
}