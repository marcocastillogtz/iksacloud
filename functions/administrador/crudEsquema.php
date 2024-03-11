<?php

if (isset($_GET['data'], $_GET['action'])) {
    require('../../entidades/Esquema.php');

    $Class = new Esquema;

    if ($_GET['action'] == "read") {
        $response = getEsquema($Class);
    } else if ($_GET['action'] == "read_id") {
        $response = getIdEsquema($Class);
    } else if ($_GET['action'] == "update") {
        $response = updateEsquema($Class);
    } else if ($_GET['action'] == "read_doc") {
        $response = getEsquemaDocum($Class);
    }

    echo json_encode($response);
} else {
    $response[] = null;
    $response = array('validation' => 200, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}

function getEsquema($Class)
{
    $json = null;
    $data = $_GET['data'];

    $page = isset($data[0]) ? $data[0] : 1;
    $perPage = isset($data[1]) ? $data[1] : 5;

    $startIndex = ($page - 1) * $perPage;

    $Class->setIndex($startIndex);
    $Class->setLastPage($perPage);

    $esquem = $Class->getEsquema();

    $totalRows = $Class->getCountEsquema();
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

    if (count($esquem) > 0) {
        $data = null;
        foreach ($esquem as $row) {
            $data[] = array(
                'esq_0' => $row['nombre_completo'],
                'esq_1' => $row['id'],
                'esq_2' => $row['cliente'],
                'esq_3' => $row['precio_lista'],
                'esq_4' => $row['documento'],
                'esq_5' => $row['hora'],
                'esq_6' => $row['fecha'],
                'esq_7' => $row['estatus'],
                'esq_8' => $row['tipo'],
                'esq_9' => $row['comision_esquema'],
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

function getIdEsquema($Class)
{
    $json = null;

    $data = $_GET['data'];
    $Class->setid_Esquema($data[0]);

    $esquem = $Class->getIdEsquema();

    if (count($esquem) > 0) {
        foreach ($esquem as $row) {
            $json[] = array(
                'esq_0' => $row['nombre_completo'],
                'esq_1' => $row['id'],
                'esq_2' => $row['cliente'],
                'esq_3' => $row['precio_lista'],
                'esq_4' => $row['documento'],
                'esq_5' => $row['hora'],
                'esq_6' => $row['fecha'],
                'esq_7' => $row['estatus'],
                'esq_8' => $row['tipo'],
                'esq_9' => $row['comision_esquema'],
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

function updateEsquema($Class)
{  
    $json = null;

    $data = $_GET['data'];
    $Class->setid_Esquema($data[0]);
    $Class->setPrecioLista($data[1]);
    $Class->setEstatus($data[2]);
    $Class->setComisionEsq($data[3]);

    if (is_string($Class->updateEsquema())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->updateEsquema()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido actualizados', 'action' => $_GET['action']);
        }else{
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function getEsquemaDocum($Class)
{
    $json = null;

    $data = $_GET['data'];
    $Class->setid_Cliente($data[0]);
    $Class->setDocumento($data[1]);

    $esquem = $Class->getEsquemaDocum();

    if (count($esquem) > 0) {
        foreach ($esquem as $row) {
            $json[] = array(
                'esq_0' => $row['id'],
                'esq_1' => $row['precio_lista'],
                'esq_2' => $row['estatus'],
                'esq_3' => $row['tipo'],
                'esq_4' => $row['comision_esquema'],
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