<?php

if (isset($_GET['data'], $_GET['action'])) {
    require('../../entidades/Municipio.php');
    $municipiosObject = new Municipios;

    require("../../entidades/Poblacion.php");
    $poblacionObject = new Poblacion;

    if ($_GET['action'] == "insert") {
        // $response = saveModule($smodulosObject);
    } else if ($_GET['action'] == "read_id") {
        $response = getMunicipioByEstado($municipiosObject);
    } else if ($_GET['action'] == "getMunicipios") {
        // $response = readData($smodulosObject);
        $response = getMunicipios($municipiosObject);
    }else if($_GET['action'] == "update"){
        // $response = updateSubodule($smodulosObject);
    }else if($_GET['action']=="delete"){
        // $response = deleteModule($smodulosObject);
    }else if($_GET['action']=="saveMunicipio"){
        $response = saveMunicipio($municipiosObject);
    }else if($_GET['action']=="getMunicipioById"){
        $response = getMunicipioById($municipiosObject);
    }else if($_GET['action']=="actualizarMunicipios"){
        $response = actualizarMunicipios($municipiosObject);
    }else if($_GET['action']=="eliminarMunicipio"){
        $response = eliminarMunicipio($municipiosObject);
    }else if($_GET['action']=="getPoblacionMunicipioById"){
        $response = getPoblacionMunicipioById($poblacionObject);
    }else if($_GET['action']=="actualizarPoblacion"){
        $response = actualizarPoblacion($poblacionObject);
    }else if($_GET['action']=="deletePoblacion"){
        $response = deletePoblacion($poblacionObject);
    }    
    echo json_encode($response);
} else {
    $response[] = null;
    $response = array('validation' => 200, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}

function deletePoblacion($poblacionObject){
    $json = null;
    $data = $_GET['data'];
    $id = $data[0];

    $poblacionObject->setidPoblacion($id);

    $module_data = $poblacionObject->deletePoblacion();

    if ($module_data) {
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

function actualizarPoblacion($poblacionObject){
    $json = null;
    $data = $_GET['data'];
    $id = $data[0];
    $poblacion = $data[1];    

    $poblacionObject->setidPoblacion($id);
    $poblacionObject->setPoblacion($poblacion);

    $module_data = $poblacionObject->updatePoblacion();
    
    if ($module_data) {
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

function getPoblacionMunicipioById($poblacionObject) {
    $json = null;
    $data = $_GET['data'];
    $estado = $data[0];
    $municipio = $data[1];

    $poblacionObject->setestadoId($estado);
    $poblacionObject->setmunicipioId($municipio);

    $module_data = $poblacionObject->getPoblacionMunicipioById();

    if ($module_data) {
        foreach ($module_data as $row) {
            $json[] = array(
                'validation' =>1,
                'idPoblacion' => $row['idPoblacion'],
                'estatus' => $row['estatus'],
                'poblacion' => $row['poblacion'],
                'municipio' => $row['municipio'],
                'estado' => $row['estado'],
            );
        }
    } else {
        $json[] = array(
            'validation' => 0,
            'message' => 'Sin resultados'
        );
    }
    return $json;
}

function eliminarMunicipio($municipiosObject){
    $json =  null;
    $data = $_GET['data'];
    $id = $data[1];
    $municipiosObject->setidMunicipio($id);
    $module_data = $municipiosObject->deleteMunicipio();

    
    if ($module_data) {
        $json[] = array(
            'validation' => 1,
            'mesagge' => 'Se elimino correctamente'
        );
    } else {
        $json[] = array(
            'validation' => 0, 
            'message' => 'Error al eliminar el registro'
        );
    }
    return $json;

}

function actualizarMunicipios($municipiosObject){
    $json = null;
    $data = $_GET['data'];
    $id = $data[1];
    $municipio = $data[2];

    $municipiosObject->setidMunicipio($id);
    $municipiosObject->setmunicipio($municipio);
    $module_data = $municipiosObject->updateMunicipio();

    // var_dump($module_data);
    
    if ($module_data) {
            $json[] = array(
                'validation' => 1,
                'mesagge' => 'Se actualizo correctamente'
            );
    } else {
        $json[] = array(
            'validation' => 0, 
            'message' => 'Error al actualizar el registro'
        );
    }
    return $json;
    
}

function getMunicipios($municipiosObject){
    $json = null;
    $data = $_GET['data'];
    $estado = $data[1];

    $municipiosObject->setidestado($estado);
    $module_data = $municipiosObject->getMunicipios();

    if ($module_data) {
        foreach ($module_data as $row) {
            $json[] = array(
                'validation' =>1,
                'idMunicipio' => $row['idMunicipio'],
                'municipio' => $row['municipio'],
                'estado' => $row['estado'],
            );
        }
    } else {
        $json[] = array(
            'validation' => 0, 
            'message' => 'Error al recuperar la informacion'
        );
    }
    return $json;
}

function getMunicipioById($municipiosObject){
    $json = null;

    $data = $_GET['data'];
    $id = $data[0];

    $municipiosObject->setidestado($id);

    if ($municipiosObject->getMunicipioById()) {
        // $json[] = array(
        //     'validation' => 1, 
        //     'message' => 'se recupero la informacion solicitada'        
        // );
        $module_data = $municipiosObject->getMunicipioById();
        foreach ($module_data as $row) {
            $json[] = array(
                'idMunicipio' => $row['idMunicipio'], 
                'municipio' => $row['municipio'], 
                'validation' => 1,
                'action' => $_GET['action']
            );
        }

    } else {
        $json[] = array(
            'validation' => 0, 
            'message' => 'Error al recuperar los registros'
        );
    }

    return $json;

}

function saveMunicipio($municipiosObject){
    $json = null;

    $data = $_GET['data'];
    $estado = $data[0];
    $municipio = $data[1];

  
    $municipiosObject->setEstado($estado);
    $municipiosObject->setMunicipio($municipio);

    if ($municipiosObject->saveMunicipio()) {
        $json[] = array(
            'validation' => 1, 
            'message' => 'Nuevo dato guardado' ,
            'action'=> $_GET['action']      
        );

    } else {
        $json[] = array(
            'validation' => 0, 
            'message' => 'Error al guardar el dato'
        );
    }

    return $json;
    
}

function getMunicipioByEstado($municipiosObject)
{

    $data = $_GET['data'];
    $id = $data[0];

    $json = null;

    $municipiosObject->setidestado($id);
    $module_data = $municipiosObject->getMunicipioById();
    foreach ($module_data as $row) {
        $json[] = array(
            'id' => $row['idMunicipio'], 'name' => $row['municipio'], 'validation' => 1, 'message' => 'Valor extraido'
        );
    }

    return $json;
}