<?php

if (isset($_GET['arrData'])) {
        require_once("../../entidades/DetallePedido.php");
        $DetallePedido = new DetallePedido();

        require_once("../../entidades/Login.php");
        $Login = new login();

        require_once("../../entidades/Pedido.php");
        $Pedido = new Pedido();

        $response = "";
        $data = $_GET['arrData'];

        //echo $data[0];

        if ($data[0] == "showOrderPreview") {
            $response = showOrderPreview($DetallePedido);
        }else if ($data[0] == "saveFolio"){
            $response = saveFolio($DetallePedido);
        }else if ($data[0] == "setIndicator"){
            $response = setIndicator($DetallePedido);
        }else if ($data[0] == "getLooter1"){
            $response = getLooter1($Login);
        }else if ($data[0] == "getLooter2"){
            $response = getLooter2($Login);
        }else if ($data[0] == "getLooter3"){
            $response = getLooter3($Login);
        }else if ($data[0] == "sentNotify"){
            $response = sentNotify($Login);
        }else if ($data[0] == "selectFilter"){
            $response = selectFilter($Pedido);
        }else if ($data[0] == "enviarPedido"){
            $response = enviarPedido($Pedido);
        }else if ($data[0] == "deleteDepositosAut"){
            $response = deleteDepositosAut($Pedido);
        }else{
            
            $response = array('action' => 'none', 'validation' => 211, 'message' => 'No se tiene el modo de filtro.');
        }
        
    echo json_encode($response);
} else {
    $response = null;
    $response[] = array('action' => 'none', 'validation' => 404, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}

function deleteDepositosAut($Pedido){
    $json = null;
    $data = $_GET['arrData'];
    $Pedido->setId($data[1]);
    $moduleData = $Pedido->deleteDepositosAut();
    // var_dump($moduleData);
    
    if ($moduleData) {
        $json[] = array(
            'validation'=>1
        );
    } else {
        $json[] = array(
            'validation' =>0
        );
    }
    return $json;   

}

function enviarPedido($Pedido){
    $json = null;
    $data = $_GET['arrData'];
    $Pedido->setId($data[1]);
    $Pedido->setPrioridad($data[2]);

    $moduleData = $Pedido->enviarPedido();
    // var_dump($moduleData);
    if ($moduleData) {
        $json[] = array(
            'validation'=>1
        );
    } else {
        $json[] = array(
            'validation' =>0
        );
    }
    return $json;   


}

function selectFilter($Pedido){
    $json = null;
    $data = $_GET['arrData'];
    $Pedido->setId($data[1]);
    $moduleData = $Pedido->selectFilter();  
    // var_dump($moduleData);
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'id' => $row['id'],
                'pzs' => $row['pieza'],
                'badge' => $row['emblema'],
                'paq' => $row['paquete']
            );
        }
    } else {
        $json[] = array(
            'validation' => 0,
            'id' => 0,
            'pzs' => 0,
            'badge' => 0,
            'paq' => 0
        );
    }
        
    return $json;
}

function sentNotify(){
    $to = "/topics/dispositivos";

    $json = null;
    $data = $_GET['arrData'];
    
    // $token = $_GET['token'];
    // $idOrder = $_GET['id_order'];
    // $user =  $_GET['user'];

    $token = $data[1];
    $idOrder = $data[2];
    $user =  $data[3];

    
    $response = saveLooter($token,$idOrder);
    
    if ($response != "-1") {
        if ($response != 3) {
            $data = array(
                'title' =>'A lootear!',
                'numeropedido'=> $idOrder,
                'body' => $token,
                'object' => 'Has sido asignado para surtir el pedido '.$idOrder,
                'response' => $response
            );
            enviarPush($to,$data);
        } else {
            $data = array(
                'title' => 'A lootear!',
                'numeropedido' =>$idOrder,
                'body' => $token,
                'object' => 'Has sido asignado para surtir el pedido '.$idOrder,
                'response' => $response
            );
        }
        
    } else {
        $data = array(
            'validation' => 2,
            'message' => 'Ocurrio un problema al recuperar la informacion de la base de datos.'
        );
    }

    // echo json_encode($data,true);
    return $data;
}

function enviarPush($to,$data){
    $apiKey = 'AAAAHJPjMuw:APA91bFY4-ryDT8OS17g7SLzq972UMhV1jn1rEiix8L1mu_K3kQTe-lDaf0DLSxTYLMcJvFhaHE8DqkxjqQ-uOCn06OvdjYuUI7XgmMzLA8GyO-77J9fDv4U3gxE7mWdoYtNsg6aPF9e';
    $fields = array(
        'to' => $to,
        'data' => $data,
    );

    $headers = array('Authorization: key=' . $apiKey, 'Content-Type: application/json');

    $url = 'https://fcm.googleapis.com/fcm/send';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));


    // $result = curl_exec($ch);
    curl_exec($ch);
    curl_close($ch);

}

function saveLooter($token,$idOrder){
    require_once("../../entidades/surtirPedido.php");
    $surtirPedido = new surtirPedido();

    $json = null;    
    $surtirPedido->setToken($token);
    $surtirPedido->setIdPedido($idOrder);

    $moduleData = $surtirPedido->saveLooter();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            return $row['resultadito'];
        }

    } else {
        return '-1';
    } 
}

function getLooter1($Login){
    $json = null;
    $data = $_GET['arrData'];
    $Login->setEstatus($data[1]);
    $moduleData = $Login->getLooter1();  
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'name' => $row['NOMBRE'],
                'rol' => $row['roll'],
                'descripcion' => $row['descripcion'],
                'token' => $row['token']
            );
        }
    } else {
        $json[] = array(
            'validation' => 0
        );
    }
    return $json;
}

function getLooter2($Login){
    $json = null;
    $data = $_GET['arrData'];
    $Login->setEstatus($data[1]);
    $moduleData = $Login->getLooter2();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[]=array(
                'validation' => 1,
                'name' => $row['NOMBRE'],
                'rol' => $row['roll'],
                'descripcion' => $row['descripcion'],
                'token' => $row['token']
            );
        }
    } else {
        $json[]=array(
            'validation' => 0,
            'message' =>'No se pudo recuperar la informacion de la base de datos'
        );
    }
    return $json;
}

function getLooter3($Login){
    $json = null;
    $data = $_GET['arrData'];
    $Login->setEstatus($data[1]);  
    $moduleData = $Login->getLooter3();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[]=array(
                'validation' => 1,
                'name' => $row['NOMBRE'],
                'rol' => $row['roll'],
                'descripcion' => $row['descripcion'],
                'token' => $row['token']
            );
        }
    } else {
        $json[]=array(
            'validation' => 0,
            'message'=>'No se pudo recuperar la informacion de la base de datos'
        );
    }
      return $json;
}


function setIndicator($DetallePedido){
    $json = null;
    $data = $_GET['arrData'];
    $DetallePedido->setId($data[1]);

    $moduleData = $DetallePedido->setIndicator();

    if ($moduleData) {
        $json[] = array(
            'validation'=>1
        );
    } else {
        $json[] = array(
            'validation' =>0
        );
    }
    return $json;   
}

function saveFolio($DetallePedido){
    $json = null;

    $data = $_GET['arrData'];
    $DetallePedido->setIdDetalle($data[1]);

    $moduleData = $DetallePedido->saveFolio();
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'clave' => $row['CLAVE']                
            );
            getQuatityKeyOrder($row['CLAVE'],$DetallePedido);
            getQuantityStore($row['CLAVE'],$DetallePedido);
            setPieceAndPackage($row['CLAVE'],$DetallePedido);
        }
        
    } else {
        $json[] = array(
            'validation'=> 0,
        );
    }
    
}

function getQuatityKeyOrder($clave,$DetallePedido){
    $json = null;
    $data = $_GET['arrData'];
    $id = $data[1];

    $DetallePedido->setClave($clave);
    $DetallePedido->setIdDetalle($id);
    $moduleData = $DetallePedido->getQuantityStore();
    
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $GLOBALS["var_cantidad"] = $row['CANTIDAD'];
        }
    } else {
        $json[]=array(
            'validation'=> 0
        );
    }
    
}

function getQuantityStore($clave,$DetallePedido){
    $json = NULL;
    $DetallePedido->setClave($clave);
    $moduleData = $DetallePedido->getQuantityStore();
    
    if ($moduleData) {
        foreach ($moduleData as $row) {
            $GLOBALS['var_paquete'] = $row['CANTIDAD'];
        }
    } else {
        $json[]=array(
            'validation'=>0
        );
    }
}


function setPieceAndPackage($clave,$DetallePedido){
    $json = null;
    $var_paquete = $GLOBALS["var_paquete"];
    // $query_udpate = '';
    
    if ($var_paquete == 0) {
        $var_package = $var_paquete;
        $var_pieza = (($var_package * $var_paquete) - $GLOBALS["var_cantidad"]) * -1;
    } else {
        $var_package = intval($GLOBALS["var_cantidad"] / $var_paquete);
        $var_pieza = (($var_package * $var_paquete) - $GLOBALS['var_cantidad']) * -1;
    }
    

    if ($var_package > 0 and $var_pieza>0) {
        $DetallePedido->setClave($clave);
        $moduleData = $DetallePedido->setPieceAndPackage0();

        if ($moduleData) {
            $json[] = array(
                'validation'=> 1
            );
        } else {
            $json[] = array(
                'validation'=> 0
            );
            return $json;
        }
        
    } else if($var_package > 0){
        $DetallePedido->setClave($clave);
        $moduleData = $DetallePedido->setPieceAndPackage1();

    }else if($var_pieza > 0){
        $DetallePedido->setClave($clave);
        $moduleData = $DetallePedido->setPieceAndPackage2();
    }
}


function showOrderPreview($DetallePedido){
    $json = null;
    $moduleData = $DetallePedido->showOrderPreview();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[]=array(
                'validation'=> 1,
                'id' => $row['ID'],
                'vendedor' => $row['VENDEDOR'],
                'cliente' => $row['cliente'],
                'observacion' => $row['OBSERVACION'],
                'fecha' => $row['FECHA'],
                'hora' => $row['HORA'],
                'folio' => $row['FOLIO'],
                'monto' => $row['MONTO'],
                'estatus' => $row['ESTATUS']
            );
        }
    } else {
        $json[]=array(
            'validation'=> 0,
        );
    }
    return $json;
}