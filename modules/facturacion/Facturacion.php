<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="../../js/facturacion/checkOut.js"></script>
    <script src="../../js/facturacion/documentosFacturados.js"></script>
    <script src="../../js/facturacion/productoServicios.js"></script>
    <script src="../../js/facturacion/relacionDocumentos.js"></script>

</head>
<body>

    <div class="container-fluid px-5 py-2">
        <div class="row">
            <div class="col-9">
            </div>
            <div class="col-3" id="navMain">

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <div class="list-group card" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active d-flex justify-content-between align-items-center" id="list-checkOutt-list" data-bs-toggle="list" href="#list-checkOutt" role="tab" aria-controls="list-checkOutt">Check Out <img src="../../img/iconos/x24/escanear.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-docsFacturados-list" data-bs-toggle="list" href="#list-docsFacturados" role="tab" aria-controls="list-docsFacturados">Documentos Facturados <img src="../../img/iconos/x24/contrato.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-relacionDocs-list" data-bs-toggle="list" href="#list-relacionDocs" role="tab" aria-controls="list-relacionDocs">Relacion de Documentos<img src="../../img/iconos/x24/relacion.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-productServices-list" data-bs-toggle="list" href="#list-productServices" role="tab" aria-controls="list-productServices">Productos o Servicios <img src="../../img/iconos/x24/paquete.png" alt=""></a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-checkOutt" role="tabpanel" aria-labelledby="list-checkOutt-list"><?php include_once('../facturacion/items/checkOut.php'); ?></div>
                    <div class="tab-pane fade" id="list-docsFacturados" role="tabpanel" aria-labelledby="list-docsFacturados-list"><?php include_once('../facturacion/items/doumentosFacturados.php'); ?></div>
                    <div class="tab-pane fade" id="list-relacionDocs" role="tabpanel" aria-labelledby="list-relacionDocs-list"><?php include_once('../facturacion/items/relacionDocumentos.php'); ?></div>
                    <div class="tab-pane fade" id="list-productServices" role="tabpanel" aria-labelledby="list-productServices-list"><?php include_once('../facturacion/items/productosoServicios.php'); ?></div>
                </div>
            </div> 

        </div>
    </div>
</body>

</html>