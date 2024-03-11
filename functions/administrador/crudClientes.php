<?php

if (isset($_GET['data'], $_GET['action'])) {
    require('../../entidades/Clientes.php');
    $Class = new Clientes;

    if ($_GET['action'] == "insert") {
        $response = saveClient($Class);
    } else if ($_GET['action'] == "read_id") {
        $response = getClientsById($Class);
    } else if ($_GET['action'] == "read") {
        $response = getClients($Class);
    } else if ($_GET['action'] == "update") {
        $response = updateClient($Class);
    } else if ($_GET['action'] == "delete") {
        $response = deleteClient($Class);
    } else if ($_GET['action'] == "import") {
        $response = importClient($Class);
    }else if ($_GET['action'] == "saveMunicipio"){
        $response = saveMunicipio($Class);
    }

    echo json_encode($response);
} else {
    $response = null;
    $response[] = array('action' => 'none', 'validation' => 200, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}

function saveMunicipio($Class){
    $json = null;

    $data = $_GET['data'];
    $estado = $data[0];
    $municipio = $data[1];

    $Class->setEstado($estado);
    $Class->setMunicipio($municipio);
    //return $estado.$municipio;

    if ($Class->saveMunicipio()) {
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

function saveClient($Class)
{

    $json = null;
    $data = $_GET['data'];
    $Class->setid_cliente($data[0]);
    $Class->setestatus($data[1]);
    $Class->setnombre_completo($data[2]);
    $Class->setrfc($data[15]);
    $Class->setmail($data[4]);
    $Class->setclasificacion($data[8]);
    $Class->setestado($data[5]);
    $Class->setmunicipio($data[6]);
    $Class->setpoblacion($data[7]);
    $Class->settelefono($data[3]);
    $Class->settexto($data[9]);
    $Class->setremision($data[11]);
    $Class->setfactura($data[12]);
    $Class->setcfdi($data[17]);
    $Class->setmdp_sat($data[16]);
    $Class->setcom_remision($data[13]);
    $Class->setcom_factura($data[14]);
    $Class->setcod_venta($data[10]);
    $Class->setlpa($data[18]);
    $Class->setmodo($data[19]);
    $Class->setdoc_alt($data[20]);
    $Class->setoperacion($data[21]);
    $Class->setbanco($data[22]);
    $Class->setcuenta_cliente($data[23]);
    $Class->setdias_limite($data[24]);
    $Class->setcredito_limite($data[25]);


    if ($Class->saveClient()) {
        $json[] = array('validation' => 1, 'message' => 'Nuevo dato guardado', 'action' => $_GET['action']);
    } else {
        $json[] = array('validation' => 0, 'message' => 'Error al guardar el dato', 'action' => $_GET['action']);
    }

    return $json;
}

function getClients($Class)
{
    $json = null;

    $data = $_GET['data'];

    $page = isset($data[0]) ? $data[0] : 1;
    $perPage = isset($data[1]) ? $data[1] : 5;

    $startIndex = ($page - 1) * $perPage;

    $Class->setIndex($startIndex);
    $Class->setLastPage($perPage);

    $clients = $Class->getViewClients();

    $totalRows = $Class->getCount();
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


    if (count($clients) > 0) {
        $data = null;
        $x=1;
        foreach ($clients as $row) {
            $counter = $x++; 
            $data[] = array(
                'f1' => $row['id_cliente'], 'f2' => $row['estatus'], 'f3' => $row['nombre_completo'], 'f4' => $row['rfc'], 'f5' => $row['mail'], 'f6' => $row['clasificacion'], 'f7' => $row['estado'], 'f8' => $row['municipio'], 'f9' => $row['poblacion'], 'f10' => $row['telefono'], 'f11' => $row['texto'], 'f12' => $row['remision'], 'f13' => $row['factura'], 'f14' => $row['cfdi'], 'f15' => $row['mdp_sat'], 'f16' => $row['com_remision'], 'f17' => $row['com_factura'], 'f18' => $row['modo_venta'], 'f19' => $row['lpa'], 'f20' => $row['modo'], 'f21' => $row['doc_alt'], 'f22' => $row['operacion'], 'f23' => $row['desc_banco'], 'f24' => $row['cuenta_cliente'], 'f25' => $row['dias_limite'], 'f26' => $row['credito_limite'],'counter'=>$counter, 'validation' => 1, 'message' => 'Valor extraido', 'action' => $_GET['action']
            );
        }


        $json[] = array(
            'table' => $data, 'pages' => $pagination, 'validation' => 1, 'message' => 'Valor extraido', 'action' => $_GET['action']
        );
    } else {
        $json[] = array(
            'validation' => 0, 'message' => 'No hay clientes registrados aun', 'action' => $_GET['action']
        );
    }

    return $json;
}

function getClientsById($Class)
{
    $json = null;

    $data = $_GET['data'];

    $idCte = $data[0];

    $Class->setid_cliente($idCte);
    $clients = $Class->getClientById();

    $json = null;
    if (count($clients) > 0) {
        foreach ($clients as $row) {
            $json[] = array(
                'res_0' => $row['id_cliente'],
                'res_1' => $row['estatus'],
                'res_2' => $row['nombre_completo'],
                'res_3' => $row['rfc'],
                'res_4' => $row['mail'],
                'res_5' => $row['clasificacion'],
                'res_6' => $row['estado'],
                'res_7' => $row['municipio'],
                'res_8' => $row['poblacion'],
                'res_9' => $row['telefono'],
                'res_10' => $row['texto'],
                'res_11' => $row['remision'],
                'res_12' => $row['factura'],
                'res_13' => $row['cfdi'],
                'res_14' => $row['mdp_sat'],
                'res_15' => $row['com_remision'],
                'res_16' => $row['com_factura'],
                'res_17' => $row['cod_venta'],
                'res_18' => $row['lpa'],
                'res_19' => $row['modo'],
                'res_20' => $row['operacion'],
                'res_21' => $row['doc_alt'],
                'res_22' => $row['banco'],
                'res_23' => $row['cuenta_cliente'],
                'res_24' => $row['dias_limite'],
                'res_25' => $row['credito_limite'],
                'validation' => 1, 'message' => 'Cliente encontrado', 'action' => $_GET['action']
            );
        }
    } else {
        $json[] = array(
            'validation' => 0, 'message' => 'No hay registros de este cliente ' . $idCte, 'action' => $_GET['action']
        );
    }

    return $json;
}

function updateClient($Class)
{
    $json = null;
    $data = $_GET['data'];
    $Class->setid_cliente($data[0]);
    $Class->setestatus($data[1]);
    $Class->setnombre_completo($data[2]);
    $Class->setrfc($data[15]);
    $Class->setmail($data[4]);
    $Class->setclasificacion($data[8]);
    $Class->setestado($data[5]);
    $Class->setmunicipio($data[6]);
    $Class->setpoblacion($data[7]);
    $Class->settelefono($data[3]);
    $Class->settexto($data[9]);
    $Class->setremision($data[11]);
    $Class->setfactura($data[12]);
    $Class->setcfdi($data[17]);
    $Class->setmdp_sat($data[16]);
    $Class->setcom_remision($data[13]);
    $Class->setcom_factura($data[14]);
    $Class->setcod_venta($data[10]);
    $Class->setlpa($data[18]);
    $Class->setmodo($data[19]);
    $Class->setdoc_alt($data[20]);
    $Class->setoperacion($data[21]);
    $Class->setbanco($data[22]);
    $Class->setcuenta_cliente($data[23]);
    $Class->setdias_limite($data[24]);
    $Class->setcredito_limite($data[25]);


    if ($Class->updateClientById()) {
        $json[] = array('validation' => 1, 'message' => 'dato Actualizado', 'action' => $_GET['action']);
    } else {
        $json[] = array('validation' => 0, 'message' => 'Error al actualizar el dato', 'action' => $_GET['action']);
    }

    return $json;
}

function deleteClient($Class)
{
    $json = null;
    $data = $_GET['data'];
    $Class->setid_cliente($data[0]);


    if ($Class->deleteClient()) {
        $json[] = array('validation' => 1, 'message' => 'El cliente ' . $data[0] . ' ha sido eliminado', 'action' => $_GET['action']);
    } else {
        $json[] = array('validation' => 0, 'message' => 'Error al eliminar el dato', 'action' => $_GET['action']);
    }

    return $json;
}


function importClient($Class)
{
    require_once '../PHPExcel-1.8/Classes/PHPExcel.php';
    $file = 'Import.xlsx';
    $inputFileType = PHPExcel_IOFactory::identify($file);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($file);
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    $num = 0;
    for ($i = 2; $i <= $highestRow; $i++) {
        $num++;
        $Class->setid_cliente($sheet->getCell("A" . $i)->getValue());
        $Class->setestatus($sheet->getCell("B" . $i)->getValue());
        $Class->setnombre_completo($sheet->getCell("C" . $i)->getValue());
        $Class->setrfc($sheet->getCell("D" . $i)->getValue());
        $Class->setmail($sheet->getCell("E" . $i)->getValue());
        $Class->setclasificacion($sheet->getCell("F" . $i)->getValue());
        $Class->setestado($sheet->getCell("G" . $i)->getValue());
        $Class->setmunicipio($sheet->getCell("H" . $i)->getValue());
        $Class->setpoblacion($sheet->getCell("I" . $i)->getValue());
        $Class->settelefono($sheet->getCell("J" . $i)->getValue());
        $Class->settexto($sheet->getCell("K" . $i)->getValue());
        $Class->setremision($sheet->getCell("L" . $i)->getValue());
        $Class->setfactura($sheet->getCell("M" . $i)->getValue());
        $Class->setcfdi($sheet->getCell("P" . $i)->getValue());
        $Class->setmdp_sat($sheet->getCell("Q" . $i)->getValue());
        $Class->setcom_remision($sheet->getCell("R" . $i)->getValue());
        $Class->setcom_factura($sheet->getCell("S" . $i)->getValue());
        $Class->setcod_venta($sheet->getCell("T" . $i)->getValue());
        $Class->setlpa($sheet->getCell("U" . $i)->getValue());
        $Class->setmodo($sheet->getCell("V" . $i)->getValue());
        $Class->setdoc_alt($sheet->getCell("W" . $i)->getValue());
        $Class->setoperacion($sheet->getCell("Y" . $i)->getValue());
        $Class->setbanco($data[22]);
        $Class->setcuenta_cliente($data[23]);
        $Class->setdias_limite($data[24]);
        $Class->setcredito_limite($data[25]);
    }


    $json[] = array(
        'validation' => $num,
    );

    return $json;

    // $json = null;
    // $data = $_GET['data'];
    // $Class->setid_cliente($data[0]);
    // $Class->setestatus($data[1]);
    // $Class->setnombre_completo($data[2]);
    // $Class->setrfc($data[15]);
    // $Class->setmail($data[4]);
    // $Class->setclasificacion($data[8]);
    // $Class->setestado($data[5]);
    // $Class->setmunicipio($data[6]);
    // $Class->setpoblacion($data[7]);
    // $Class->settelefono($data[3]);
    // $Class->settexto($data[9]);
    // $Class->setremision($data[11]);
    // $Class->setfactura($data[12]);
    // $Class->setcfdi($data[17]);
    // $Class->setmdp_sat($data[16]);
    // $Class->setcom_remision($data[13]);
    // $Class->setcom_factura($data[14]);
    // $Class->setcod_venta($data[10]);
    // $Class->setlpa($data[18]);
    // $Class->setmodo($data[19]);
    // $Class->setdoc_alt($data[20]);
    // $Class->setoperacion($data[21]);
    // $Class->setbanco($data[22]);
    // $Class->setcuenta_cliente($data[23]);
    // $Class->setdias_limite($data[24]);
    // $Class->setcredito_limite($data[25]);


    // if ($Class->saveClient()) {
    //     $json[] = array('validation' => 1, 'message' => 'Nuevo dato guardado', 'action' => $_GET['action']);
    // } else {
    //     $json[] = array('validation' => 0, 'message' => 'Error al guardar el dato', 'action' => $_GET['action']);
    // }

    // return $json;
}
