<?php

if (isset($_GET['data'], $_GET['action'])) {
    require('../../entidades/Catalogos.php');


    $Class = new Catalogo;

    if ($_GET['action'] == "insert") {
        $response = saveRegimenFiscal($Class);
    } else if ($_GET['action'] == "read") {
        $response = getCatalogoRegimenFiscal($Class);
    } else if ($_GET['action'] == "delete") {
        $response = deleteRegimenFiscal($Class);
    } else if ($_GET['action'] == "read_id") {
        $response = getIdRegimenFiscal($Class);
    } else if ($_GET['action'] == "update") {
        $response = updateRegimenFiscal($Class);
    } else if ($_GET['action'] == "read_sat") {
        $response = getformPagoSAT($Class);
    } else if ($_GET['action'] == "insert_sat") {
        $response = saveCatalogoSAT($Class);
    } else if ($_GET['action'] == "read_id_sat") {
        $response = getIdCatalogoSAT($Class);
    } else if ($_GET['action'] == "update_sat") {
        $response = updateCatalogoSAT($Class);
    } else if ($_GET['action'] == "delete_sat") {
        $response = deleteCatalogoSAT($Class);
    } else if ($_GET['action'] == "read_cfdi") {
        $response = getCatalogoCFDI($Class);
    } else if ($_GET['action'] == "insert_cfdi") {
        $response = saveCatalogoCFDI($Class);
    } else if ($_GET['action'] == "update_cfdi") {
        $response = updateCatalogoCFDI($Class);
    } else if ($_GET['action'] == "read_id_cfdi") {
        $response = getIdCatalogoCFDI($Class);
    } else if ($_GET['action'] == "delete_cfdi") {
        $response = deleteCatalogoCFDI($Class);
    }

    echo json_encode($response);
} else {
    $response = null;
    $response[] = array('action' => 'none', 'validation' => 200, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}

function saveRegimenFiscal($Class)
{

    $json = null;

    $data = $_GET['data'];
    $Class->setc_FormaPago($data[0]);
    $Class->setDescripcion($data[1]);

    if (is_string($Class->saveRegimenFiscal())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->saveRegimenFiscal()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido guardados', 'action' => $_GET['action']);
        } else {
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function getCatalogoRegimenFiscal($Class)
{
    $json = null;
    $data = $_GET['data'];

    $page = isset($data[0]) ? $data[0] : 1;
    $perPage = isset($data[1]) ? $data[1] : 5;

    $startIndex = ($page - 1) * $perPage;

    $Class->setIndex($startIndex);
    $Class->setLastPage($perPage);

    $regimen = $Class->getCatalogoRegimenFiscal();

    $totalRows = $Class->getCountRegimenFiscal();
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

    if (count($regimen) > 0) {
        $data = null;
        foreach ($regimen as $row) {
            $data[] = array(
                'reg_0' => $row['c_RegimenFiscal'],
                'reg_1' => $row['Descripcion'],
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

function deleteRegimenFiscal($Class)
{
    $json = null;

    $data = $_GET['data'];
    $Class->setc_FormaPago($data[0]);

    if (is_string($Class->deleteRegimenFiscal())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->deleteRegimenFiscal()) {
            $json[] = array('validation' => 1, 'message' => 'El registro ha sido eliminado', 'action' => $_GET['action']);
        } else {
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function getIdRegimenFiscal($Class)
{
    $json = null;

    $data = $_GET['data'];
    $Class->setc_FormaPago($data[0]);

    $idReg = $Class->getIdRegimenFiscal();

    if (count($idReg) > 0) {
        foreach ($idReg as $row) {
            $json[] = array(
                'reg_0' => $row['c_RegimenFiscal'],
                'reg_1' => $row['Descripcion'],
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

function updateRegimenFiscal($Class)
{

    $json = null;

    $data = $_GET['data'];
    $Class->setc_FormaPago($data[0]);
    $Class->setDescripcion($data[1]);

    if (is_string($Class->updateRegimenFiscal())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->updateRegimenFiscal()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido actualizados', 'action' => $_GET['action']);
        } else {
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function getformPagoSAT($Class)
{
    $json = null;
    $data = $_GET['data'];

    $page = isset($data[0]) ? $data[0] : 1;
    $perPage = isset($data[1]) ? $data[1] : 5;

    $startIndex = ($page -1) * $perPage;

    $Class->setIndex($startIndex);
    $Class->setLastPage($perPage);

    $cSAT = $Class->getformPagoSAT();

    $totalRows = $Class->getCountCatalogoSAT();
    foreach ($totalRows as $count) {
        $totalRows = $count['counts'];
    }

    $totalPages = ceil($totalRows / $perPage);
    $pagination = null;
    $active = "";

    for ($i = 1; $i <= $totalPages ; $i++) {
        if ($i == $page) {
            $active = "active";
        } else {
            $active = "";
        }
        $pagination[] = array('page' => $i, 'active' => $active);
    }

    if (count($cSAT) > 0) {
        $data = null;
        foreach ($cSAT as $row) {
            $data[] = array(
                'SAT_0' => $row['c_FormaPago'],
                'SAT_1' => $row['Descripcion'],
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

function saveCatalogoSAT($Class)
{

    $json = null;

    $data = $_GET['data'];
    $Class->setc_FormaPago($data[0]);
    $Class->setDescripcion($data[1]);

    if (is_string($Class->saveCatalogoSAT())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->saveCatalogoSAT()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido guardados', 'action' => $_GET['action']);
        } else {
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function getIdCatalogoSAT($Class)
{
    $json = null;

    $data = $_GET['data'];
    $Class->setc_FormaPago($data[0]);

    $cSAT = $Class->getIdCatalogoSAT();

    if (count($cSAT) > 0) {
        foreach ($cSAT as $row) {
            $json[] = array(
                'SAT_0' => $row['c_FormaPago'],
                'SAT_1' => $row['Descripcion'],
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

function updateCatalogoSAT($Class)
{

    $json = null;

    $data = $_GET['data'];
    $Class->setc_FormaPago($data[0]);
    $Class->setDescripcion($data[1]);

    if (is_string($Class->updateCatalogoSAT())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->updateCatalogoSAT()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido actualizados', 'action' => $_GET['action']);
        } else {
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function deleteCatalogoSAT($Class)
{
    $json = null;

    $data = $_GET['data'];
    $Class->setc_FormaPago($data[0]);

    if (is_string($Class->deleteCatalogoSAT())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->deleteCatalogoSAT()) {
            $json[] = array('validation' => 1, 'message' => 'El registro ha sido eliminado', 'action' => $_GET['action']);
        } else {
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function getCatalogoCFDI($Class)
{
    $json = null;
    $data = $_GET['data'];

    $page = isset($data[0]) ? $data[0] : 1;
    $perPage = isset($data[1]) ? $data[1] : 5;

    $startIndex = ($page - 1) * $perPage;


    $Class->setIndex($startIndex);
    $Class->setLastPage($perPage);

    $cfdi = $Class->getCatalogoCFDI();


    $totalRows = $Class->getCountCFDI();
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


    if (count($cfdi) > 0) {
        $data = null;
        foreach ($cfdi as $row) {
            $data[] = array(
                'cfdi_0' => $row['c_UsoCFDI'],
                'cfdi_1' => $row['Descripcion'],
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

function saveCatalogoCFDI($Class)
{

    $json = null;

    $data = $_GET['data'];
    $Class->setc_FormaPago($data[0]);
    $Class->setDescripcion($data[1]);

    if (is_string($Class->saveCatalogoCFDI())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->saveCatalogoCFDI()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido guardados', 'action' => $_GET['action']);
        } else {
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function updateCatalogoCFDI($Class)
{

    $json = null;

    $data = $_GET['data'];
    $Class->setc_FormaPago($data[0]);
    $Class->setDescripcion($data[1]);

    if (is_string($Class->updateCatalogoCFDI())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->updateCatalogoCFDI()) {
            $json[] = array('validation' => 1, 'message' => 'Los datos han sido actualizados', 'action' => $_GET['action']);
        } else {
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}

function getIdCatalogoCFDI($Class)
{
    $json = null;

    $data = $_GET['data'];
    $Class->setc_FormaPago($data[0]);

    $cfdi = $Class->getIdCatalogoCFDI();

    if (count($cfdi) > 0) {
        foreach ($cfdi as $row) {
            $json[] = array(
                'cfdi_0' => $row['c_UsoCFDI'],
                'cfdi_1' => $row['Descripcion'],
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

function deleteCatalogoCFDI($Class)
{
    $json = null;

    $data = $_GET['data'];
    $Class->setc_FormaPago($data[0]);

    if (is_string($Class->deleteCatalogoCFDI())) {
        $json[] = array('validation' => 0, 'message' => $Class->getMessageERROR(), 'action' => $_GET['action']);
    } else {
        if ($Class->deleteCatalogoCFDI()) {
            $json[] = array('validation' => 1, 'message' => 'El registro ha sido eliminado', 'action' => $_GET['action']);
        } else {
            $json[] = array('validation' => -1, 'message' => 'Ocurrio un error inesperado', 'action' => $_GET['action']);
        }
    }
    return $json;
}
