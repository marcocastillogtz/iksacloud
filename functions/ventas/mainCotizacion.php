<?php

if (isset($_GET['arrData'])) {
    // require_once("../entidades/Partidas.php");
    // $Partida = new Partidas();
    require_once("../../entidades/Clientes.php");
    $Clientes = new Clientes;

    require_once('../../entidades/Producto.php');
    $Producto = new Producto;

    require_once('../../entidades/Pedido.php');
    $Pedido = new Pedido;

    $response = "";
    $data = $_GET['arrData'];
    if ($data[0] == "getClients") {
        $response = valDoc($Clientes);
    } else if ($data[0] == "consultarClave") {
        $response = consultarClave($Producto);
    } else if ($data[0] == "getIdOrder") {
        $response = getIdOrder($Pedido);
    } else if ($data[0] == "searchObservacion") {
        $response = searchObservacion($Pedido);
    } else if ($data[0] == "getTotal") {
        $response = getTotal($Pedido);
    } else if ($data[0] == "getKardex") {
        $response = getKardex($Producto);
    }



    // else if($data[0] == "getComponentPartida"){
    //     $response = getComponentPartida($Partida);
    // }
    else {
        $response = array('action' => 'none', 'validation' => 211, 'message' => 'No se tiene el modo de filtro.');
    }

    echo json_encode($response);
} else {
    $response = null;
    $response[] = array('action' => 'none', 'validation' => 404, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}


function getTotal($Pedido)
{
    $json =  null;
    $data = $_GET['arrData'];
    $Pedido->setId($data[1]);

    $moduleData = $Pedido->getTotal();
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'total' => $row[0]
            );
        }
    } else {
        $json[] = array(
            'validation' => 0
        );
    }
    return $json;
    // $call_monto = "CALL TOTAL($var_id);";
    // detallePedido
}

function searchObservacion($Pedido)
{
    $json = null;
    $data = $_GET['arrData'];

    $Pedido->setId($data[1]);

    $moduleData = $Pedido->searchObservacion();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'comentario' => $row['OBSERVACION']
            );
        }
    } else {
        $json[] = array(
            'validation' => 0
        );
    }

    return $json;
}


function getIdOrder($Pedido)
{
    $json = null;
    $data = $_GET['arrData'];

    $Pedido->setCliente($data[1]);
    $Pedido->setVendedor($data[2]);
    $Pedido->setDocumento($data[3]);
    $Pedido->setClave($data[4]);
    $Pedido->setDescripcion($data[5]);
    $Pedido->setPrecioIva($data[5]); // crear
    $Pedido->setCantidad($data[6]); //crear
    $Pedido->setMonto($data[7]); //crear
    $Pedido->setRestriccion($data[8]); //
    $Pedido->setFamOferta($data[9]); //
    $Pedido->setListaPrecio($data[10]); //
    $Pedido->setEnvio($data[11]); //

    $moduleData = $Pedido->getIdOrder();
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



function consultarClave($Producto)
{
    $json = null;
    $data = $_GET['arrData'];
    $Producto->setClave($data[1]);
    $Producto->setPrecio($data[2]);

    $moduleData = $Producto->getInfoClave();
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'Clave' => $row['CLAVE'],
                'ProductoDescripcion' => $row['DESCRIPCION'],
                'PrecioLista' => $row['PRECIO'],
                'PrecioEspecial' => $row['PRICE_SPECIAL'],
                'FamOferta' => $row['FAME_SALE'],
                'PrecioOferta' => $row['PRICE_SALE'],
                'ResOferta' => $row['RESTRICCION'],


            );
        }
    } else {
        $json[] = array(
            'validation' => 0,
            'message' => 'Ocurrio un problema al reuperar la informacion :('
        );
    }
    return $json;
}

function valDoc($Clientes)
{
    $json = null;

    $data = $_GET['arrData'];
    $Clientes->setid_cliente($data[1]);

    $moduleData = $Clientes->valDoc();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            //  searchClient($row['DOC_ALT'],$Clientes); 
            return searchClient($row['DOC_ALT'], $Clientes);
        }
    } else {
        $json[] = array(
            'validation' => 0,
            'message' => 'El dato no esta previemente registrado'
        );
    }
    return $json;
}

function searchClient($var_documento, $Clientes)
{
    // $dato = $_GET['idCliente'];
    // $documento = $var_documento;
    $data = $_GET['arrData'];
    $Clientes->setid_cliente($data[1]);
    $Clientes->setdoc_alt($var_documento);

    $moduleData = $Clientes->searchClient();
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'Nombre' => $row['nombre_completo'],
                'lista_precio' => $row['listaPrecioo'],
                'Descripcion' => $row['tipo'],
                'id' => $row['ID'],
                'Vendedor' => $row['NOMBRE_VENDEDOR'],
                'lpa' => $row['lpa'],
                'opstandar' => $row['operacion'],
                'opfactura' => $row['operacion'],
                'doc_alt' => $row['doc_alt'],
                'lp_alt' => $row['tipo2'],

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

function getKardex($Producto)
{
    $json = null;
    $data = $_GET['arrData'];

    $page = isset($data[1]) ? $data[1] : 1;
    $perPage = isset($data[2]) ? $data[2] : 215;

    $startIndex = ($page - 1) * $perPage;

    $Producto->setIndex($startIndex);
    $Producto->setLastPage($perPage);
    $Producto->setFkListaPrecio($data[1]);
    $kardex = $Producto->getKardex();

    $totalRows = $Producto->getCount();

    foreach ($totalRows as $count) {
        $totalRows = $count['counts'];
    }

    $totalPages = ceil($totalRows / $perPage);
    $pagination = null;
    $active = "";

    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $page) {
            $active = "active";
        } else {
            $active = "";
        }

        $pagination[] = array('page' => $i, 'active' => $active);
    }


    if (count($kardex) > 0) {
        $data = null;

        foreach ($kardex as $row) {
            $data[] = array(
                'validation' => 1,
                'clave' => $row['clave'],
                'estado' => $row['estado'],
                'descripcionn' => mb_convert_encoding($row['descripcion'],'ISO-8859-1', 'UTF-8'),
                'precio' => $row['precio'],
                'precioOferta' => $row['precio_oferta'],
                'claveSAT' => $row['clave_sat'],
                'claveUnidad' => $row['clave_unidad'],
                'imagen' => $row['imagen']
            );
        }

        $json[] = array(
            'table' => $data, 'pages' => $pagination, 'validation' => 1, 'message' => 'Valor extraido'
        );
    }else{
        $json[] = array(
            'validation' => 0, 'message' => 'No hay productos registrados aun'
        );
    }




    // if ($kardex) {
    //     foreach ($kardex as $row) {
    //         $json[] = array(
    //             'validation' => 1,
    //             'f1' => $row['clave'],
    //             'f2' => $row['estado'],
    //             'f3' => $row['descripcion'],
    //             'f4' => $row['precio'],
    //             'f5' => $row['precio_oferta'],
    //             'f6' => $row['clave_sat'],
    //             'f7' => $row['clave_unidad'],
    //             'f8' => $row['imagen']
    //         );
    //     }
    // } else {
    //     $json[] = array(
    //         'validation' => 0,
    //         'message' => 'Sin Resultados'
    //     );
    // }
    return $json;
}
