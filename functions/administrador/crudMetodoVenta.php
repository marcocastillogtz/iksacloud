<?php
 
if (isset($_GET['data'], $_GET['action'])) {
    require('../../entidades/MetodoDeVenta.php');
   

    $Class = new MetodoDeVenta;

    if ($_GET['action'] == "insert") {
        $response = saveMetVenta($Class);
    } else if ($_GET['action'] == "read") {
        $response = getTipoVenta($Class);
    } else if ($_GET['action'] == "delete") {
        $response = deleteMetVenta($Class);
    } else if ($_GET['action'] == "read_id") {
        $response = getIdMetVenta($Class);
    } else if ($_GET['action'] == "update") {
        $response = updateMetVenta($Class);
    }

    echo json_encode($response);
} else {
    $response = null;
    $response[] = array('action' => 'none', 'validation' => 200, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}

function saveMetVenta($Class)
{
   
    $json = null;

    $data = $_GET['data'];
    $Class->setcodigo_venta($data[0]);
    $Class->setdescripcion($data[1]);
    $Class->setcodigo_r($data[2]);
    $Class->setcodigo_f($data[3]);

    if (is_string($Class->saveMetVenta())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->saveMetVenta()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido guardados', 'action' => $_GET['action']);
        }else{
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function getTipoVenta($Class)
{
    $json = null;
    $data = $_GET['data'];

    $page = isset($data[0]) ? $data[0] : 1;
    $perPage = isset($data[1]) ? $data[1] : 5;

    $startIndex = ($page - 1) * $perPage;

    $Class->setIndex($startIndex);
    $Class->setLastPage($perPage);

    $metVenta = $Class->getTipoVenta();

    $totalRows = $Class->getCountMetVenta();
    foreach ($totalRows as $count) {
        $totalRows = $count['counts'];
    }

    $totalPages = ceil($totalRows / $perPage);
    $pagination = null;
    $active = "";

    for ($i = 1; $i <= $totalPages; $i++){
        if ($i == $page) {
            $active = "active";
        } else {
            $active = "";
        }
        $pagination[] = array('page' => $i, 'active' => $active);
    }

    if (count($metVenta) > 0) {
        $data = null;
        foreach ($metVenta as $row) {
            $data[] = array(
                'metV_0' => $row['codigo_venta'],
                'metV_1' => $row['descripcion'],
                'metV_2' => $row['codigo_r'],
                'metV_3' => $row['codigo_f'],
                'validation' => 1, 'message' => 'Registro encontrado', 'action' => $_GET['action']
            );
        }
        $json[] = array('table' => $data, 'pages' => $pagination, 'validation' => 1, 'message' => 'Datos de la pagina '.$page, 'action' => $_GET['action']);
    } else {
        $json[] = array(
            'validation' => 0, 'message' => 'No se encontro ningun registro', 'action' => $_GET['action']
        );
    }
    return $json;
}

function getIdMetVenta($Class)
{
    $json = null;

    $data = $_GET['data'];
    $Class->setcodigo_venta($data[0]);

    $codVent = $Class->getIdMetVenta();

    if (count($codVent) > 0) {
        foreach ($codVent as $row) {
            $json[] = array(
                'metV_0' => $row['codigo_venta'],
                'metV_1' => $row['descripcion'],
                'metV_2' => $row['codigo_r'],
                'metV_3' => $row['codigo_f'],
                'validation' => 1, 'message' => 'Registro encontrado', 'action' => $_GET['action']
            );
        }
    } else {
        $json[] = array(
            'validation' => 0, 'message' => 'No se encontro ningun registro', 'action' => $_GET['action']
        );
    }
    return $json;
}

function updateMetVenta($Class)
{
   
    $json = null;

    $data = $_GET['data'];
    $Class->setcodigo_venta($data[0]);
    $Class->setdescripcion($data[1]);
    $Class->setcodigo_r($data[2]);
    $Class->setcodigo_f($data[3]);

    if (is_string($Class->updateMetVenta())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->updateMetVenta()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido actualizados', 'action' => $_GET['action']);
        }else{
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function deleteMetVenta($Class)
{
   
    $json = null;

    $data = $_GET['data'];
    $Class->setcodigo_venta($data[0]);

    if (is_string($Class->deleteMetVenta())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->deleteMetVenta()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido actualizados', 'action' => $_GET['action']);
        }else{
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}