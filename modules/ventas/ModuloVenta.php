<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="../../js/menu.js"></script> -->
    <!-- <script src="../../js/numeral.min.js"></script>
    <script src="../../js/administrador/settings.js"></script>
    <script src="../../js/administrador/clients.js?v=10"></script>
    <script src="../../js/administrador/localidades.js"></script>
    <link rel="stylesheet" href="../../css/menu.css">
    <script src="../../js/administrador/usuarios.js"></script> -->
    
    <script src="../../js/ventas/cotizacion.js"></script>
    <script src="../../js/ventas/pedidosAutorizado.js"></script>
    <script src="../../js/ventas/pedidosEspera.js"></script>
    <script src="../../js/ventas/historial.js"></script>
    <script src="../../js/ventas/backOrder.js"></script>
    <script src="../../js/ventas/seguimiento.js"></script>
    <script src="../../js/ventas/progresoPedidos.js"></script>
    <script src="../../js/ventas/pedidoScanLoot.js"></script>
    <link rel="stylesheet" href="../../css/customSheet.css">
</head>
<body>

    <div class="container-fluid px-5 py-2">
        <div class="row">
            <div class="col-9">
                <!-- <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Parametros</li>
                    </ol>
                </nav> -->
            </div>
            <div class="col-3" id="navMain">

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <div class="list-group card" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active d-flex justify-content-between align-items-center" id="list-cotizacion-list" data-bs-toggle="list" href="#list-cotizacion" role="tab" aria-controls="list-cotizacion">Cotizacion <img src="../../img/iconos/x24/shoppingCar.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-pedidosAutorizados-list" data-bs-toggle="list" href="#list-pedidosAutorizados" role="tab" aria-controls="list-pedidosAutorizados">Pedidos Autorizados <img src="../../img/iconos/x24/checkList.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-pedidosEspera-list" data-bs-toggle="list" href="#list-pedidosEspera" role="tab" aria-controls="list-pedidosEspera">Pedidos en Espera<img src="../../img/iconos/x24/list.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-historial-list" data-bs-toggle="list" href="#list-historial" role="tab" aria-controls="list-historial">Historial <img src="../../img/iconos/x24/calendario.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-backOrder-list" data-bs-toggle="list" href="#list-backOrder" role="tab" aria-controls="list-backOrder">BackOrder <img src="../../img/iconos/x24/backTime.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-seguimiento-list" data-bs-toggle="list" href="#list-seguimiento" role="tab" aria-controls="list-seguimiento">Seguimiento <img src="../../img/iconos/x24/chat.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-progresoPedidos-list" data-bs-toggle="list" href="#list-progresoPedidos" role="tab" aria-controls="list-progresoPedidos">Progreso de Pedidos <img src="../../img/iconos/x24/caja.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-pedidoScanLoot-list" data-bs-toggle="list" href="#list-pedidoScanLoot" role="tab" aria-controls="list-pedidoScanLoot">Pedidos para ScanLoot <img src="../../img/iconos/x24/listaVerificacion.png" alt=""></a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-cotizacion" role="tabpanel" aria-labelledby="list-cotizacion-list"><?php include_once('../ventas/items/cotizacion.php'); ?></div>
                    <div class="tab-pane fade" id="list-pedidosAutorizados" role="tabpanel" aria-labelledby="list-pedidosAutorizados-list"><?php include_once('../ventas/items/pedidosAutorizados.php'); ?></div>
                    <div class="tab-pane fade" id="list-pedidosEspera" role="tabpanel" aria-labelledby="list-pedidosEspera-list"><?php include_once('../ventas/items/pedidosEspera.php'); ?></div>
                    <div class="tab-pane fade" id="list-historial" role="tabpanel" aria-labelledby="list-historial-list"><?php include_once('../ventas/items/historial.php'); ?></div>
                    <div class="tab-pane fade" id="list-backOrder" role="tabpanel" aria-labelledby="list-backOrder-list"><?php include_once('../ventas/items/backOrder.php'); ?></div>
                    <div class="tab-pane fade" id="list-seguimiento" role="tabpanel" aria-labelledby="list-seguimiento-list"><?php include_once('../ventas/items/seguimiento.php'); ?></div>
                    
                    <div class="tab-pane fade" id="list-progresoPedidos" role="tabpanel" aria-labelledby="list-progresoPedidos-list"><?php include_once('../ventas/items/progresoPedidos.php'); ?></div>
                    <div class="tab-pane fade" id="list-pedidoScanLoot" role="tabpanel" aria-labelledby="list-pedidoScanLoot-list"><?php include_once('../ventas/items/pedidoScanLoot.php'); ?></div>

                </div>
            </div> 

        </div>
    </div>
</body>

</html>