<?php

if (isset($_GET['id'], $_GET['smodulo'], $_GET['estatus'], $_GET['idMod'], $_GET['icon'], $_GET['action'])) {
    require('../../entidades/Submodulos.php');
    $smodulosObject = new Submodulo;

    if ($_GET['action'] == "insert") {
        $response = saveModule($smodulosObject);
    } else if ($_GET['action'] == "read_id") {
        $response = nextId($smodulosObject);
    } else if ($_GET['action'] == "read") {
        $response = readData($smodulosObject);
    }else if($_GET['action'] == "update"){
        $response = updateSubodule($smodulosObject);
    }else if($_GET['action']=="delete"){
        $response = deleteModule($smodulosObject);
    }
    
    echo json_encode($response);
} else {
    $response[] = null;
    $response = array('validation' => 200, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}

function saveModule($smodulosObject)
{

    $json = null;
    $smodulosObject->setId($_GET['id']);
    $smodulosObject->setSubmodulo($_GET['smodulo']);
    $smodulosObject->setEstatus($_GET['estatus']);
    $smodulosObject->setModuloId($_GET['idMod']);
    $smodulosObject->setIcon($_GET['icon']);

    if ($smodulosObject->saveModule()) {
        $json[] = array('validation' => 1, 'message' => 'Nuevo dato guardado');
    } else {
        $json[] = array('validation' => 0, 'message' => 'Error al guardar el dato');
    }

    return $json;
}


function nextId($smodulosObject)
{
    $json = null;
    $data = $smodulosObject->getNextID();


    foreach ($data as $row) {
        $json[] = array(
            'id' => $row['nextid'], 'validation' => 1, 'message' => 'Valor extraido'
        );
    }

    return $json;
}



function readData($smodulosObject)
{

    $json = null;

    $module_data = $smodulosObject->getViewSubmodulos();
    foreach ($module_data as $row) {
        $json[] = array(
            'id' => $row['id'], 'submodulo' => $row['submodulo'], 'estatus' => $row['estatus'], 'modulo' => $row['modulo'], 'idModulo' => $row['IDmod'], 'estatus_mod' => $row['estatus_mod'], 'validation' => 1, 'message' => 'Valor extraido'
        );
    }

    return $json;
}

function updateSubodule($smodulosObject)
{

    $json = null;
    $smodulosObject->setId($_GET['id']);
    $smodulosObject->setSubmodulo($_GET['smodulo']);
    $smodulosObject->setEstatus($_GET['estatus']);
    $smodulosObject->setModuloId($_GET['idMod']);
    $smodulosObject->setIcon($_GET['icon']);

    if ($smodulosObject->updateSubmodule()) {
        $json[] = array('validation' => 1, 'message' => 'Submodulo Actualizado');
    } else {
        $json[] = array('validation' => 0, 'message' => 'Error al actualizar el submodulo');
    }

    return $json;
}


function deleteModule($smodulosObject)
{

    $json = null;
    $smodulosObject->setId($_GET['id']);
    $smodulosObject->setEstatus($_GET['estatus']);

    if ($smodulosObject->deleteModule()) {
        $json[] = array('validation' => 1, 'message' => 'Submodulos Eliminado');
    } else {
        $json[] = array('validation' => 0, 'message' => 'Error al eliminar el Submodulos');
    }
    return $json;
}
