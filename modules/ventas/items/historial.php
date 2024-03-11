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
        <!-- <link rel="stylesheet" href="../../../css/estilosSelects.css"> -->
        <link rel="stylesheet" href="../../css/estilosSelects.css">
    </head>

    <body>
        <div class="container-fluid">
            <h4><img src="../../img/iconos/x24/calendario.png" > Historial</h4>
            <div class="col-12">
                <!-- <h3 class="badge text-bg-primary p-2"><i class="fa-regular fa-lightbulb"></i> Nota: Para mayor eficiencia se recomienda utilizar mas de un filtro</h3> -->
                <h4><span class="badge text-bg-primary"><i class="fa-regular fa-lightbulb"></i> Nota: Para mayor eficiencia se recomienda utilizar mas de un filtro</span></h4>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <form class="row g-3">
                <div class="col-3">
                    <select class="form-select" aria-label="Default select example" id="selectSeller">
                        <option value="All" selected>Vendedor</option>
                    </select>
                </div>

                <div class="col-3">
                    <select class="form-select" aria-label="Default select example" id="selectClient">
                        <option value="All" selected>Cliente</option>
                    </select>
                </div>

                <div class="col-2">
                    <select class="form-select" aria-label="Default select example" id="selectEstatus">
                        <option value="All" selected="">Estatus</option>
                        <option value="AT" class="bg-autorizados">Autorizados</option>
                        <option value="PS" class="bg-porsurtir">Por Surtir</option>
                        <option value="ST" class="bg-surtiendo">Surtido</option>
                        <option value="FT" class="bg-facturados">Facturados</option>
                        <option value="EN" class="bg-enviados">Enviados</option>
                    </select>     
                </div>

                <div class="col-2">
                    <input type="date" name="" id="dateHistorial" class="form-control">    
                </div>

                <div class="col-2">
                    <button type="button" class="btn btn-primary" id="btnBuscarPedido"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                </div>
                
            </form>
            <br>
            <div class="card">
                <table class="table table-sm justify-content-center">
                    <thead>
                        <tr>
                        <th scope="col">Pedido</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="item_pedidos_historial"></tbody>
                        <tr id="spinnerTablePedidosHistorial">
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

        <div class="modal fade" id="modalComentarioHist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añade un comentario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <input type="text" id="txtIdComentarioHistorial" class="form-control" hidden disabled>
                </div>
                <div class="modal-body">
                    <input type="text" name="" id="txtComentarioHistorial" class="form-control" placeholder="Comentario..">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnEnviarComentarioHist">Enviar</button>
                </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalErrorHistorial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Error</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h1> <i class="fa-regular fa-circle-xmark text-danger "></i> No tienes los permisos necesarios</h1>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalDeletePedidoHist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <input type="text" name="" id="txtPedidoHistDeleteModal" hidden disabled>
                </div>
                <div class="modal-body">
                    <h1>Realmente deseas eliminar el pedido ??</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnEliminarPedidoModal">Si, Eliminar</button>
                </div>
                </div>
            </div>
        </div>

    </body>
</html>