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
            <h1><img src="../../img/iconos/x24/caja.png" alt=""> Progreso de Pedidos</h1>
        </div>
        <hr>
        <!-- Done -->
        <div class="container-fluid">
            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col" class="align-middle text-center">Pedido</th>
                        <th scope="col" class="align-middle text-center">Almacen</th>
                        <th scope="col" class="align-middle text-center">Usuario</th>
                        <th scope="col" class="align-middle text-center">Porcentaje</th>
                        <th scope="col" class="align-middle text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="item_progreso_pedidos"></tbody>
                        <tr id="spinnerTableProgresoPedidos">
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

        <div class="modal fade" id="modalAutorizarPedidoScanLoot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Autorizar Pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <input type="text"  id="txtPorcentajePedidoPorAutorizar" disabled hidden>
                    <input type="text"  id="txtUsuarioPedidoPorAutorizar" disabled hidden>
                    <input type="text"  id="txtIdPedidoPorAutorizar" disabled hidden>
                </div>
                <div class="modal-body">
                    <h4>Motivo por la que no se completo el pedido ??</h4>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="txtComentario" style="height: 100px"></textarea>
                        <label for="txtComentario">Comentario</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnAutorizarPedidoModal">Enviar</button>
                </div>
                </div>
            </div>
        </div>


    </body>
</html>
