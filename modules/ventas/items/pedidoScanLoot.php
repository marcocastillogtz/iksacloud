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
        <!-- <h1><img src="../../img/iconos/x24/caja.png" alt=""> Progreso de Pedidos</h1> -->
        <h1><img src="../../img/iconos/x24/listaVerificacion.png" alt=""> Pedidos para ScanLoot</h1>
    </div>
    <hr>
    <!-- Done -->
    <div class="container-fluid">
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="align-middle text-center">Pedido</th>
                        <th scope="col" class="align-middle text-center">Cliente</th>
                        <th scope="col" class="align-middle text-center">Vendedor</th>
                        <th scope="col" class="align-middle text-center">Observaciones</th>
                        <th scope="col" class="align-middle text-center">Fecha</th>
                        <th scope="col" class="align-middle text-center">Estatus</th>
                        <th scope="col" class="align-middle text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="item_pedidos_scanloot"></tbody>
                <tr id="spinnerTablePedidosScanLoot">
                    <td colspan="8">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status" id="spinner-depositos-scanLoot">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="modal fade" id="btnOrderPedidoScanLoot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Autorizar Pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <input type="text" id="txtPorcentajePedidoPorAutorizar" disabled hidden>
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


    <div class="modal fade" id="modalAsignarSurtidor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Panel de control</h5>
                    <input type="text" id="txtIdPedidoModalAsigarScanLoot" hidden disabled>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-2">
                            <div class="col-auto">
                                <h6>Prioridad del pedido</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto mb-3">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btnradio2" id="radio_low2" autocomplete="off" value="1">
                                    <label class="btn btn-outline-success" for="radio_low2">Estandar</label>

                                    <input type="radio" class="btn-check" name="btnradio2" id="radio_medium2" autocomplete="off" value="2">
                                    <label class="btn btn-outline-primary" for="radio_medium2">Media</label>

                                    <input type="radio" class="btn-check" name="btnradio2" id="radio_max2" autocomplete="off" value="3">
                                    <label class="btn btn-outline-warning" for="radio_max2">Alta</label>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-auto">
                                    Almacen 1
                                </div>
                                <div class="col-6 mb-1">
                                    <select id="selectPiezas2" class="form-select form-select-sm" aria-label=".form-select-sm example" disabled>
                                        <option selected disabled>Escoge un looter...</option>
                                    </select>
                                </div>
                                <div class="col-auto mb-1">
                                    <button type="button" class="btn btn-primary btn-sm" id="notify_1_piezas" disabled><i class="fa-solid fa-bell"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    Almacen 2
                                </div>
                                <div class="col-6 mb-1">
                                    <select id="selectEmblemas2" class="form-select form-select-sm" aria-label=".form-select-sm example" disabled>
                                        <option selected disabled>Escoge un looter...</option>
                                    </select>
                                </div>
                                <div class="col-auto mb-1">
                                    <button type="button" class="btn btn-primary btn-sm" id="notify_2_emblemas" disabled><i class="fa-solid fa-bell"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    Almacen 3
                                </div>
                                <div class="col-6 mb-1">
                                    <select id="selectPaquetes2" class="form-select form-select-sm" aria-label=".form-select-sm example" disabled>
                                        <option selected disabled>Escoge un looter...</option>
                                    </select>
                                </div>
                                <div class="col-auto mb-1">
                                    <button type="button" class="btn btn-primary btn-sm" id="notify_3_paquetes" disabled><i class="fa-solid fa-bell"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnSaveModalAsignarSurtido">Guardar</button>
                </div>
            </div>
        </div>
    </div>


</body>

</html>


<!-- <h1><img src="../../img/iconos/x24/listaVerificacion.png" alt=""> Pedidos para ScanLoot</h1> -->