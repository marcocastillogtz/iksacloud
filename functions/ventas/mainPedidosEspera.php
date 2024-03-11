<?php

if (isset($_GET['arrData'])) {
        require_once("../../entidades/Pedido.php");
        $Pedido = new Pedido();

        // require_once("../../entidades/Login.php");
        // $Login = new login();

        // require_once("../../entidades/Pedido.php");
        // $Pedido = new Pedido();

        $response = "";
        $data = $_GET['arrData'];

        if ($data[0] == "showPedidosEspera") {
            $response = showPedidosEspera($Pedido);
        }else{
            $response = array('action' => 'none', 'validation' => 211, 'message' => 'No se tiene el modo de filtro.');
        }
        
    echo json_encode($response);
} else {
    $response = null;
    $response[] = array('action' => 'none', 'validation' => 404, 'message' => 'No se recibieron parametros.');
    echo json_encode($response);
}


function showPedidosEspera($Pedido){
    $json = null;
    $moduleData = $Pedido->showPedidosEspera();

    if ($moduleData) {
        foreach ($moduleData as $row) {
            $json[] = array(
                'validation' => 1,
                'id' => $row['ID'],
                'vendedor' => $row['VENDEDOR'],
                'cliente' => $row['CLIENTE'],
                'observacion' => $row['OBSERVACION'],
                'fecha' => $row['FECHA'],
                'hora' => $row['HORA'],
                'monto' => $row['MONTO'],
                'idCliente' => $row['ID_CLIENTE'],
                'documento' => $row['DOCUMENTO'],
                'dias' => $row['DIAS'],
                'horas' => $row['HORAS']
            );
        }
    } else {
            $json[] = array(
                'validation' => 0,
                'message' => 'No se encontro informacion en la base de datos',
            );
    }
    return $json;
}