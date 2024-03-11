<?php

if (isset($_GET['id'], $_GET['modulo'], $_GET['estatus'], $_GET['url'],$_GET['action'])) {
    require('../../entidades/Modulos.php');
    require('../../entidades/Permisos.php');
    $moduloObject = new Modulos;
    $permission = new Permisos;
    if ($_GET['action'] == "insert") {
        $response = saveModule($moduloObject,$permission);
    } else if ($_GET['action'] == "update") {
        $response = updateModule($moduloObject);
    } else if ($_GET['action'] == "delete") {
        $response = deleteModule($moduloObject);
    } else if ($_GET['action'] == "read") {
        $response = readData($moduloObject);
    }

    echo json_encode($response);
} else {
    $response[] = null;
    $response = array('validation' => 200, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}

function saveModule($moduloObject,$permission)
{

    $json = null;
    $moduloObject->setId($_GET['id']);
    $moduloObject->setModulo($_GET['modulo']);
    $moduloObject->setEstatus($_GET['estatus']);
    $moduloObject->setUrl($_GET['url']);

    if ($moduloObject->saveModule() && $permission->addColumn($_GET['modulo'])) {
        $json[] = array('validation' => 1, 'message' => 'Nuevo dato guardado');
    } else {
        $json[] = array('validation' => 0, 'message' => 'Error al guardar el dato');
    }

    return $json;
}

function updateModule($moduloObject)
{

    $json = null;
    $moduloObject->setId($_GET['id']);
    $moduloObject->setModulo($_GET['modulo']);
    $moduloObject->setEstatus($_GET['estatus']);
    $moduloObject->setUrl($_GET['url']);

    if ($moduloObject->updateModule()) {
        $json[] = array('validation' => 1, 'message' => 'Modulo Actualizado');
    } else {
        $json[] = array('validation' => 0, 'message' => 'Error al actualizar el modulo');
    }

    return $json;
}

function deleteModule($moduloObject)
{

    $json = null;
    $moduloObject->setId($_GET['id']);
    $moduloObject->setEstatus($_GET['estatus']);

    if ($moduloObject->deleteModule()) {
        $json[] = array('validation' => 1, 'message' => 'Modulo Eliminado');
    } else {
        $json[] = array('validation' => 0, 'message' => 'Error al eliminar el modulo');
    }
    return $json;
}

function readData($moduloObject)
{

    $json = null;

    $module_data = $moduloObject->getModulos();
    foreach ($module_data as $mod) {
        $json[]=array(
            'id'=>$mod['id'],'module'=>$mod['modulo'],'status'=>$mod['estatus'],'url'=>$mod['url'],'validation' => 1, 'message' => 'Valor extraido'
        );
    }

    return $json;
}

