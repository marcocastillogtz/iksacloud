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
            <h4><img src="../../img/iconos/x24/backTime.png" alt=""> BackOrder</h4>
        </div>
        <hr>
        <div class="row">
            <!-- <div class="col-12">
                <button type="button" class="btn btn-success" id="btnAddComponente">Añadir Componente</button>
            </div> -->
            <div class="col-6">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark sticky-top">
                        <tr>
                            <th scope="col">FOLIO</th>
                            <th scope="col">CLIENTE</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">DIAS</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="item_backOrder">
                        <tr>
                            <th scope="row" colspan="6">
                                <div class="text-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>    
            </div>
            
            <div class="col-1"></div>

            <div class="col-5">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark sticky-top">
                        <tr>
                            <th scope="col">CLAVE</th>
                            <th scope="col">PIEZA</th>
                            <th scope="col">NO.CLIENTES</th>
                            <th scope="col">CANTIDAD</th>
                        </tr>
                    </thead>
                    <tbody id="productosDemandados">
                        <tr>
                            <th scope="row" colspan="6">
                                <div class="text-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>    
            </div>
        


            <!-- Modal -->
            <div class="modal fade" id="modalBackOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Partidas Debidas</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <input type="text" name="" id="txtFolioModalBackOrderPartidasDebidas" disabled hidden>
                            <input type="text" name="" id="txtIdPedidoModalBackOrderPartidasDebidas" disabled hidden>
                        </div>
                        <div class="modal-body">
                            <div class="col-10">
                                <button type="button" class="btn btn-primary" id="btnInsertarPartida"><i class="fa-solid fa-plus"></i></button>
                            </div>
                            
                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center;">Clave</th>
                                            <th scope="col" style="text-align: center;">Por Sutir</th>
                                            <th scope="col" colspan="3" style="text-align: center;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detallePedidosBack"></tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        


            <!-- Modal -->
            <div class="modal fade" id="modalEditPartidasDebidas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Producto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <input type="text" name="" id="txtFolioModalEditPartidasDebidas" disabled hidden>
                            <input type="text" name="" id="txtIdModalEditPartidasDebidas" disabled hidden>
                        </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row g-2 mb-1 d-flex align-item-start flex-clumn align-items-center">
                                        <div class="col-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="txt_claveEdit" list="claves" name="claves">
                                                <datalist id="claves"></datalist>
                                                <label for="txt_claveEdit"><i class="bi bi-search"></i> Buscar Clave</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="txt_cantidadEdit" value="0" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                <label for="txt_cantidadEdit">Cantidad:</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="txt_descripcionEdit" value="Sin descripcion" disabled>
                                                <label for="txt_descripcionEdit">Descripcion del producto:</label>
                                            </div>
                                        </div>
                                        <div class="col-3 clearfix">
                                            <div class="form-floating float-end">
                                                <input type="text" class="form-control" id="txttotalEdit" value="$0.00" disabled>
                                                <label for="txttotalEdit">Importe con Iva: </label>
                                            </div>
                                        </div>
                                        <!-- fila 6 -->
                                        <div class="row g-2 mb-1">
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="txt_precioivaEdit" value="$0.00" disabled>
                                                    <label for="txt_precioiva">Precio mas IVA:</label>
                                                </div>
                                            </div>

                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="txt_precioOfertaEdit" value="$0.00" disabled>
                                                    <label for="txt_precioOferta">Oferta:</label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="txt_RestriccionEdit" value="S/R" disabled>
                                                    <label for="txt_RestriccionEdit">Restriccion:</label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="txt_FamOfertaEdit" value="0" disabled>
                                                    <label for="txt_FamOfertaEdit">Fam oferta:</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- fila 7 -->
                                        <div class="row g-2 mb-1">
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="txt_totalEdit" value="$00.00" disabled>
                                                    <label for="txt_totalEdit">Total:</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- fila 9 -->
                                        <div class="row g-2 mb-1">
                                            <div class="col-2 d-grid gap-2">
                                                <button type="button" class="btn btn-primary btn-block btn_update" id="btn_updateEdit">Actualizar</button>
                                            </div>
                                            <div class="col-2 d-grid gap-2">
                                                <button id="btn_cancelEdit" class="btn btn-danger btn_cancel">Cancelar</button>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-whatever="@fdm">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="modal fade" id="addItemBackorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Generar BackOrder</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-whatever="@mds"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row g-2 mb-1 d-flex align-item-start flex-clumn align-items-center">
                                    <div class="col-4">
                                        <div class="form-floating">
                                            <select id="select_envio_back" class="form-control">
                                                <option disabled value="All">Enviar por:</option>
                                                <option selected value="Personalmente">Personalmente</option>
                                                <option value="Paqueteria">Paqueteria</option>
                                            </select>
                                            <label>Método de Envio:</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="txt_folioNuevo" value="F|R---------------" disabled>
                                            <label for="txt_folioNuevo">Folio:</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="txt_idNuevo" value="00000" disabled>
                                            <label for="txt_idNuevo">Nuevo Pedido:</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 mb-1 d-flex align-item-start flex-clumn align-items-center">
                                    <div class="col-3">
                                        <div class="form-floating">
                                            <input id="txt_claveAdd" type="text" class="form-control" value="" disabled>
                                            <label for="txt_claveAdd">Clave:</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-floating">
                                            <input id="txt_cantidadAdd" type="text" class="form-control" value="0" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" disabled>
                                            <label for="txt_cantidadAdd">Cantidad:</label>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-floating">
                                            <input id="txt_descripcionAdd" type="text" class="form-control" value="Descripcion del producto." readonly="">
                                            <label for="txt_descripcionAdd">Descripcion:</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 mb-1 d-flex align-item-start flex-clumn align-items-center">
                                    <div class="col-3">
                                        <div class="form-floating">
                                            <input id="txt_precioivaAdd" type="text" class="form-control" value="0.00" readonly="">
                                            <label for="txt_precioivaAdd">Precio Neto: $</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-floating">
                                            <input id="txt_precioOfertaAdd" type="text" class="form-control" value="0.00" readonly="">
                                            <label for="txt_precioOfertaAdd">Oferta: $</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-floating">
                                            <input id="txt_RestriccionAdd" type="text" class="form-control" value="S/D." readonly="">
                                            <label for="txt_RestriccionAdd">Restr.:</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-floating">
                                            <input id="txt_FamOfertaAdd" type="text" class="form-control" value="0.00" readonly="">
                                            <label for="txt_FamOfertaAdd">Fam oferta:</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <div class="form-floating">
                                            <input id="txt_totalAdd" type="text" class="form-control" placeholder="00.00" readonly="">
                                            <label class="label label-default">Total: $</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex mb-3">
                                        <div class="ps-2">
                                            <button id="btn_genFolioAdd" class="btn btn-secondary"><i class="fa-solid fa-magnifying-glass"></i> Folio</button>
                                        </div>
                                        <div class="ps-2">
                                            <button id="btn_insertPartidaAdd" class="btn btn-success" disabled><i class="fa-solid fa-plus"></i> Agregar</button>
                                        </div>
                                        <div class="ms-auto ps-2">
                                            <button id="btn_sendOrder" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Enviar</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="modalEliminarPartida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Partida</h1>
                        <input type="text" id="txtIdFolioModalEliminarPartida" hidden disabled>
                        <input type="text" id="txtFolioModalEliminarPartida" hidden disabled>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Realmente deseas eliminar la partida??</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btnEliminarPartida">Si, Eliminar</button>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>