<?php
    require_once("../../../entidades/Pedido.php");
    $Pedido = new Pedido;

    if (isset($_GET['id']) && isset($_GET['fac']) && isset($_GET['rem']) && isset($_GET['comment']) && isset($_GET['folio']) ) {
        genReportXls($Pedido);

    } else {
        echo 'Sin Parametros';
    }




function genReportXls($Pedido){


    $json =  null;
    // $data = $_GET['arrData'];
    $Pedido->setId($_GET['id']);
    $Pedido->setFolio($_GET['folio']);
    
    /* ESTO ES DE OTRA ENTIDAD */
    $Pedido->setFactura($_GET['fac']);
    $Pedido->setRemision($_GET['rem']);
    $Pedido->setComment($_GET['comment']);
    /* ESTO ES DE OTRA ENTIDAD */


    $moduleData = $Pedido->genReportXls();


    // $select_p = "SELECT * FROM PEDIDO WHERE ID='$pedido' OR FOLIO='$pedido'";
}

