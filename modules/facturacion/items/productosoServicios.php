<?php
require_once('../../entidades/Modulos.php');
require_once('../../entidades/Submodulos.php');
$Modulos_Object = new Modulos;
$modulo_data = $Modulos_Object->getNextID();
$data_select_modulos =  $Modulos_Object->getModulos();
$Submodulo_Object = new Submodulo;
$submodulo_data = $Submodulo_Object->getNextID();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <h4><img src="../../img/iconos/x24/paquete.png" alt=""> Productos o Servicios</h4>
    </div>
    <hr>
    <div class="row">
        <div class="col-2">
            <div class="input-group">
                <input type="text" id="txt_clave" class="form-control" placeholder="Escaneé folio">
            </div>
        </div>
        <div class="col-2">
            <div class="input-group">
                <input type="number" id="txt_cantidad" class="form-control" placeholder="Escaneé clave">
            </div>
        </div>
        <div class="col-2">
            <div class="input-group">
                <input type="text" id="txt_cantidad" class="form-control" placeholder="Cliente">
            </div>
        </div>
        <div class="col-2">
            <div class="input-group">
                <input type="text" id="txt_cantidad" class="form-control" placeholder="Pedido">
            </div>
        </div>
        <div class="col-2">
            <div class="input-group">
                <button type="button" class="btn btn-success form-control">Añadir</button>
            </div>
        </div>
    </div>
<br>

<div class="row">
    <div class="container-fluid">
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Clave</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Existencia</th>
                    <th scope="col">Proveedor</th>
                    </tr>
                </thead>
                <tbody id="item_pedidos"></tbody>
                    <tr id="spinnerTablePedidosAutorizados">
                        <td colspan="8">
                            <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status" id="spinner-depositos-depo-cobranza">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            </div>
                        </td>
                    </tr>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
    <div class="modal fade" id="modalGenerarFolio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Generar Folio</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Generar Folio</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarFolioModal">Guardar</button>
            </div>
            </div>
        </div>
    </div>
    

    </body> 
</html>