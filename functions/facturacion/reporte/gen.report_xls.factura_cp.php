<?php
require_once("../../../entidades/Pedido.php");
$Pedido = new Pedido;


if (isset($_GET['id']) && isset($_GET['fac']) && isset($_GET['rem']) && isset($_GET['comment'])&&isset($_GET['lp'])&&isset($_GET['folio'])) {
    genReportFacturaXls($Pedido);
}else{

    echo 'Sin Parametros';

}

function genReportFacturaXls($Pedido){
    $json =  null;

    $Pedido->setId($_GET['id']);
    $Pedido->setFactura($_GET['fac']);
    $Pedido->setRemision($_GET['rem']);
    $Pedido->setComment($_GET['comment']);
    $Pedido->setListaPrecio($_GET['lp']);
    $Pedido->setFolio($_GET['folio']);
    

    $Pedido->genReportFacturaXls();

    // if ($moduleData) {
    //     echo'Todo bien';
    // } else {
    //     echo'Ocurrio un problema al generar el reporte';
    // }
    

}