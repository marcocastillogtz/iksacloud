<?php

if (isset($_GET['data'], $_GET['action'])) {
    require('../../entidades/Roles.php');

    $Class = new Roles;

    if ($_GET['action'] == "read") {
        $response = getRole($Class);
    } else if ($_GET['action'] == "read_id") {
        $response = getIdRole($Class);
    } else if ($_GET['action'] == "update") {
        $response = updateRole($Class);
    } else if ($_GET['action'] == "delete") {
        $response = deleteRole($Class);
    } else if ($_GET['action'] == "insert") {
        $response = insertRole($Class);
    }
    echo json_encode($response);
} else {
    $response = null;
    $response[] = array('action' => 'none', 'validation' => 200, 'message' => 'No recibieron parametros.');
    echo json_encode($response);
}


function getRole($Class)
{
    $json = null;

    $rol = $Class->getRole();

    if (count($rol) > 0) {
        foreach ($rol as $row) {
            $json[] = array(
                'rol_0' => $row['nivel'],
                'rol_1' => $row['descripcion'],
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

function getIdRole($Class)
{
    $json = null;

    $data = $_GET['data'];
    $Class->setNivel($data[0]);

    $idRol = $Class->getIdRole();

    if (count($idRol) > 0) {
        foreach ($idRol as $row) {
            $json[] = array(
                'rol_0' => $row['nivel'],
                'rol_1' => $row['descripcion'],
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

function updateRole($Class)
{
    $json = null;

    $data = $_GET['data'];
    $Class->setNivel($data[0]);
    $Class->setDescripcion($data[1]);

    if (is_string($Class->updateRole())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->updateRole()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido actualizados', 'action' => $_GET['action']);
        }else{
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function deleteRole($Class)
{
    $json = null;

    $data = $_GET['data'];
    $Class->setNivel($data[0]);

    if (is_string($Class->deleteRole())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->deleteRole()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido actualizados', 'action' => $_GET['action']);
        }else{
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function insertRole($Class)
{

    $json = null;

    $data = $_GET['data'];
    $Class->setDescripcion($data[1]);

    if (is_string($Class->insertRole())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->insertRole()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido guardados', 'action' => $_GET['action']);
        } else {
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}