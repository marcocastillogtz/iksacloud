<?php

if (isset($_GET['arrData'])) {
        require_once("../../entidades/Pedido.php");
        $Pedido = new Pedido;
    
        require_once("../../entidades/DetallePedido.php");
        $DetallePedido = new DetallePedido; 

        require_once("../../entidades/surtirPedido.php");
        $SurtirPedido = new surtirPedido;

        require_once("../../entidades/Producto.php");
        $Producto = new Producto;

        require_once("../../entidades/Almacen.php");
        $Almacen = new Almacen;


        $response = "";
        $data = $_GET['arrData'];
        if ($data[0] == "getOrderByFolioCheckout") {
            $response = getOrderByFolioCheckout($DetallePedido);
        }else if($data[0] == "getPedidoProgress"){
            $response = getPedidoProgress($SurtirPedido);
        }else if($data[0] == "seeKey"){
            $response = seeKey($DetallePedido);
        }else if($data[0] == "getExistenciaProducto"){
            $response = getExistenciaProducto($DetallePedido);
        }else if($data[0] == "catalogo"){
            $response = catalogo($Producto);
        }else if($data[0] == "agregarItem"){
            $response = agregarItem($Producto);
        }else if($data[0] == "takeOrder"){
            $response = takeOrder($Pedido);
        }else if($data[0] == "getPackage"){
            $response = getPackage($Almacen);
        }else if($data[0] == "executeDevolucion"){
            $response = executeDevolucion($DetallePedido);
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

function executeDevolucion($DetallePedido){
    // $json = null;
    $data = $_GET['arrData'];
    // var_dump($data);

    foreach ($data[2] as $key) {
    $DetallePedido->setFolio($data[1]);
    $DetallePedido->setClave($key['key']);
    $DetallePedido->setCantidad( $key['cant']);

    $moduleData = $DetallePedido->executeDevolucion();
    
    }


    if ($moduleData) {
        $json[]  = array(
            'validation' => 1,
            'response' => $moduleData
        );
    } else {
        $json[] = array(
            'validation' => 0
        );
    }

    return $json;

}



function getPackage($Almacen){
    $json =  null;
    $data = $_GET['arrData'];
    $Almacen->setClave($data[1]);
    
    $moduleData = $Almacen->getPackage();
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'id' => $row['id'],
                'clave' => $row['clave'],
                'cantidad' => $row['cantidad']
            );
        }
    } else {
        $json[] = array(
            'validation' => 0
        );
    }
    return $json;
}

function takeOrder($Pedido) {
    $json = null;
    $data = $_GET['arrData'];

    $Pedido->setUsuario($data[1]);
    $Pedido->setFolio($data[2]);

    $moduleData = $Pedido-> takeOrder();
    if ($moduleData) {
        $json[] = array(
            'validation' => 1
        );
    } else {
        $json [] = array(
            'validation' => 0
        );
    }
    return $json;
}


function agregarItem($Producto) {
    $json = null;
    $data = $_GET['arrData'];


    $Producto->setVendedor($data[1]);
    $Producto->setClave($data[2]);
    $Producto->setDescripcion($data[3]);
    $Producto->setCantidad($data[4]); 
    $Producto->setCliente($data[5]);
    $Producto->setTotal($data[6]);
    $Producto->setPrecio($data[7]);
    $Producto->setDocumento($data[8]);
    $Producto->setRestrinccion($data[9]);
    $Producto->setOferta($data[10]);
    $Producto->setPedido($data[11]);
    $Producto->setFkListaPrecio($data[12]);
    $Producto->setFolio($data[13]);
    $Producto->setEstatusOferta($data[14]);

    $moduleData = $Producto->agregarItem();
    
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'result' => $row['result'],
                // 'idPedido' => $row['idPedido']
            );
        }
    } else {
        $json[] = array(
            'validation' => 0,
            'message' => 'Sin resultados',
        );
    }
     
    return $json;
}


function catalogo($Producto){
    $json = null;
    $data = $_GET['arrData'];
    $Producto->setFkListaPrecio($data[1]);
    $Producto->setClave($data[2]);

    $moduleData = $Producto->catalogo(); 
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'listaPrecio' =>$row['ID_LP'],
                'clave' =>$row['CLAVE'],
                'descripcion' =>$row['DESCRIPCION'],
                'precio' =>$row['PRECIO'],
                'imagen' =>$row['IMAGEN'],
                'precioEspecial' =>$row['PRICE_SPECIAL'],
                'ventaMinima' =>$row['MIN_SALE'],
                'familiaVenta' =>$row['FAME_SALE'],
                'statusVenta' =>$row['STATUS_SALE'],
                'precioVenta' =>$row['PRICE_SALE'],
                'restrinccion' =>$row['RESTRICCION'],
                'paquete' =>$row['PAQUETE'],
            );
        }
    }else{
        $json[] = array(
            'validation' => -1,
            'message' =>'Sin resultados',
        );
    }   
    return $json;
}


function getExistenciaProducto($DetallePedido){
    $json  = null;
    $data = $_GET['arrData'];
    // $select_p = "SELECT VENDEDOR,PRECIOLISTA,FOLIO FROM DETALLE_PEDIDO WHERE ID_DETALLE={$var_idOrder} LIMIT 1";    
    $DetallePedido->setIdDetalle($data[1]);
    $moduleData = $DetallePedido->getExistenciaProducto();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            // VENDEDOR,PRECIOLISTA,FOLIO
            $json[] = array(
                'validation' => 1,
                'vendedor' => $row['VENDEDOR'],
                'precioLista' => $row['PRECIOLISTA'],
                'folio' => $row['FOLIO'],
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

function seeKey($DetallePedido){
    $json = null;
    $data = $_GET['arrData'];
    $DetallePedido->setFolio($data[1]);
    $DetallePedido->setClave($data[2]);
    $DetallePedido->setPaquete($data[3]);
    
    $moduleData = $DetallePedido->seeKey();

    //var_dump($moduleData);

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $porciones = explode("/",$row['RESULT']);
            // var_dump($row['RESULT']);

            $json[] = array(
                'validation' => 1,
                'requerido' => $porciones[0],
                'restante' => $porciones[1],
                'ingresado' => $porciones[2],
                'agregado' => $porciones[3],
                'clave' => $porciones[4],
                'folio' => $porciones[5],
                'respuesta' => $porciones[6],
                'paquete' => $porciones[7],
                'pieza' => $porciones[8]
            );
        }
    } else {
        $json[]= array(
            'validation' => 0,
            'message' => 'Sin Resultados'
        );
    }
    return $json;
}


function getPedidoProgress($SurtirPedido) {
    $json = null;
    // $data = $_GET['arrData'];
    $moduleData = $SurtirPedido->getPedidoProgress();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'id'=>$row['idPedido'],
                'almacen'=>$row['descripcion'],
                'usuario'=>$row['usuario'],
                'porcentaje'=>$row['porcentaje'],
                'autorizado'=>$row['autorizado'],
                'idSutir'=>$row['id_surtirP'],
                'idUsuario'=>$row['idUsuario']
            );
        }

    } else {
       $json[]=array(
            'validation' => 0,
            'message' => 'Sin resultado'
       );
    }
    return $json;
}

function getOrderByFolioCheckout($DetallePedido){
    $json = null;
    $data = $_GET['arrData'];
    $DetallePedido->setId($data[1]);
    $moduleData = $DetallePedido->getOrderByFolioCheckout();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'id' => $row['id'],
                'vendedor'=> $row['vendedor'],
                'clave'=> $row['clave'],
                'descripcion'=> $row['descripcion'],
                'precio'=> $row['precio'],
                'cantidad'=> $row['cantidad'],
                'fecha'=> $row['fecha'],
                'cliente'=> $row['cliente'],
                'id_detalle'=> $row['id_detalle'],
                'estatus'=> $row['estatus'],
                'monto'=> $row['monto'],
                'folio'=> $row['folio'],
                'restriccion'=> $row['restriccion'],
                'fam_oferta'=> $row['fam_oferta'],
                'estatus_oferta'=> $row['estatus_oferta'],
                'paquete'=> $row['paquete'],
                'pieza'=> $row['pieza'],
                'porcentaje'=> $row['porcentaje'],
                'comision'=> $row['comision'],
                'preciolista'=> $row['preciolista'],
                'movimiento'=> $row['movimiento'],
                'agregados'=> $row['agregados'],
                'notificacion'=> $row['notificacion'],
                'comision_f'=> $row['comision_f'],
                'porcentaje_f'=> $row['porcentaje_f'],
                'paquete_sl'=> $row['paquete_sl'],
                'pieza_sl'=> $row['pieza_sl'],
                'folio_devolucion'=> $row['folio_devolucion'],
                'cantidad_devolucion'=> $row['cantidad_devolucion'],
                'motivo_devolucion'=> $row['motivo_devolucion'],
                'fecha_devolucion'=> $row['fecha_devolucion']
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