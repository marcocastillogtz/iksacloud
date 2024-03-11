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
        <h4><img src="../../img/iconos/x24/checkList.png" alt=""> Pedidos Autorizados</h4>
    </div>
    <hr>
    
    <!-- Done -->
    <!-- <div class="container-fluid">
        <div class="card">
            <h5 class="card-header">Listado de Pedidos Autorizados</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo Modulo</h5>
                <p class="card-text">Los modulos son la cabeza de un menu, sin ellas no podrás ingresar a los submodulos</p>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropModule"> <i class="fa-solid fa-pencil"></i> Registrar</a>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticTableModule" id="btnTableMod"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div> -->

    <div class="container-fluid">
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Pedido</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Vendedor</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Total</th>
                    <th scope="col-2">Evento</th>
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
    
        <!-- Modal -->
        <div class="modal fade" id="modalEnviarPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Enviar Pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Enviando Pedido</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnEnviarPedidoModal">Guardar</button>
                </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="modalGenerarPDF" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Generar PDF</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Generar PDF</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGenerarPDFModal">Guardar</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalEliminarPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Eliminar Pedido</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnEliminarPedidoModal">Eliminar</button>
                </div>
                </div>
            </div>
        </div>




    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Panel de control</h5>
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
                                    <input type="radio" class="btn-check" name="btnradio" id="radio_low" autocomplete="off" value="1">
                                    <label class="btn btn-outline-success" for="radio_low">Estandar</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="radio_medium" autocomplete="off" value="2">
                                    <label class="btn btn-outline-primary" for="radio_medium">Media</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="radio_max" autocomplete="off" value="3">
                                    <label class="btn btn-outline-warning" for="radio_max">Alta</label>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-auto">
                                    Almacen 1
                                </div>
                                <div class="col-6 mb-1">
                                    <select id="selectPiezas" class="form-select form-select-sm" aria-label=".form-select-sm example" disabled>
                                        <option selected disabled>Escoge un looter...</option>
                                    </select>
                                </div>
                                <div class="col-auto mb-1">
                                    <button type="button" class="btn btn-primary btn-sm" id="notify_1" disabled><i class="fa-solid fa-bell"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    Almacen 2
                                </div>
                                <div class="col-6 mb-1">
                                    <select id="selectEmblemas" class="form-select form-select-sm" aria-label=".form-select-sm example" disabled>
                                        <option selected disabled>Escoge un looter...</option>
                                    </select>
                                </div>
                                <div class="col-auto mb-1">
                                    <button type="button" class="btn btn-primary btn-sm" id="notify_2" disabled><i class="fa-solid fa-bell"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    Almacen 3
                                </div>
                                <div class="col-6 mb-1">
                                    <select id="selectPaquetes" class="form-select form-select-sm" aria-label=".form-select-sm example" disabled>
                                        <option selected disabled>Escoge un looter...</option>
                                    </select>
                                </div>
                                <div class="col-auto mb-1">
                                    <button type="button" class="btn btn-primary btn-sm" id="notify_3" disabled><i class="fa-solid fa-bell"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnSave">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="toastAuth" class="toast align-items-center text-white bg-primary border-0 position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body toast-result">

            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>


    <!-- Modal -->
        <div class="modal fade" id="modalEliminarPedidos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Deposito</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <input type="text" name="" id="idDepositoEliminar" disabled hidden>
                </div>
                <div class="modal-body">
                    <h2>Realmente deseas eliminar el deposito??</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnEliminarDepositos">Si,Eliminar</button>
                </div>
                </div>
            </div>
        </div>
    <!-- Fin Modal -->

    </body> 
</html>