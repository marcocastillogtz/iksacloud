<?php

if (isset($_GET['data'], $_GET['action'])) {
    require('../../entidades/Poblacion.php');
    $Class = new Poblacion;

    if ($_GET['action'] == "insert") {
        // $response = saveModule($smodulosObject);
    } else if ($_GET['action'] == "read_id") {
        $response = getPoblacionByMunicipio($Class);
    } else if ($_GET['action'] == "read") {
        // $response = readData($smodulosObject);
    } else if ($_GET['action'] == "update") {
        // $response = updateSubodule($smodulosObject);
    } else if ($_GET['action'] == "delete") {
        // $response = deleteModule($smodulosObject);
    } else if ($_GET['action'] == "savePoblacion") {
        $response = savePoblacion($Class);
    }

    echo json_encode($response);
} else {
    $response[] = null;
    $response = array('validation' => 200, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}

function savePoblacion($Class)
{
    $json = null;

    $data = $_GET['data'];
    $estado = $data[0];
    $municipio = $data[1];
    $poblacion = $data[2];

    $Class->setestadoId($estado);
    $Class->setmunicipioId($municipio);
    $Class->setPoblacion($poblacion);



    if ($Class->savePoblacion()) {
        $json[] = array(
            'validation' => 1,
            'message' => 'Nuevo dato guardado'
        );
    } else {
        $json[] = array(
            'validation' => 0,
            'message' => 'Error al guardar el dato'
        );
    }

    return $json;
}

function getPoblacionByMunicipio($Class)
{

    $json = null;
    $data = $_GET['data'];
    $municipio = $data[0];
    $Class->setmunicipioId($municipio);
    $module_data = $Class->getMunicipioById();

    if (sizeof($module_data) > 0) {
        foreach ($module_data as $row) {
            $json[] = array(
                'id' => $row['idPoblacion'], 'name' => $row['poblacion'], 'validation' => 1, 'message' => 'Poblaciones extraidos'
            );
        }
    } else {
        $json[] = array(
            'id' => 1, 'name' => 'Sin Definir', 'validation' => 1, 'message' => 'Poblaciones extraidos'
        );
    }
    return $json;
}
