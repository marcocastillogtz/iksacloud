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
        <h4><img src="../../img/iconos/x24/escanear.png" alt=""> CheckOut</h4>
    </div>
    <hr> 
    <div class="row">
        <div class="col-2">
            <div class="input-group">
                <input type="text" id="txtFolioCheckOut" class="form-control" placeholder="Escaneé folio">
            </div>
        </div>
        <div class="col-2">
            <div class="input-group">
                <input type="text" id="txtClaveCheckOut" class="form-control" placeholder="Escaneé clave">
            </div>
        </div>
        <div class="col-2">
            <div class="input-group">
                <input type="text" id="txtClienteCheckOut" class="form-control text-center" placeholder="Cliente" >
            </div>
        </div>
        <div class="col-2">
            <div class="input-group">
                <input type="text" id="txtPedidoCheckOut" class="form-control text-center" placeholder="Pedido">
            </div>
        </div>
        <div class="col-2">  
            <button type="button" class="btn btn-success form-control text-center" id="btnAvisarCheckOut">Avisar</button> 
        </div>

        <div class="col-2">
            <button type="button" class="btn btn-primary form-control text-center" id="btnDevolucionCheckOut">Devolucion</button>
        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-4">
            <div style="max-height: 200px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Almacen</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Progress</th>
                        </tr>
                    </thead>
                    <tbody id="tablePedidoProgress"></tbody>
                        <tr id="spinnerTablePedidosProgress">
                            <td colspan="8">
                                <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status" id="spinner-depositos-progress">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                </div>
                            </td>
                        </tr>
                </table>
            </div>
        </div>

        <div class="col-8">
            <div style="max-height: 600px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Clave</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Agregado</th>
                        </tr>
                    </thead>
                    <tbody id="tablePedidoCheckOut"></tbody>
                        <tr id="spinnerTablePedidosCheckOut">
                            <td colspan="8">
                                <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status" id="spinner-depositos-check-out">
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
        <div class="modal fade" id="modalCheckOutExistenciaProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Este producto no existe en el pedido</h4>
                    <h5>Deseas cobrarlo ??</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ahorita no joven</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarExistenciaProductoModal">Si, Por favor</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalCheckOutUpdateExistenciaProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Deseas agregarle más cantidad a este producto?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ahorita no joven</button>
                    <button type="button" class="btn btn-primary" id="btnUpdateExistenciaProductoModal">Si, Por favor</button>
                </div>
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


        <!-- Modal -->
        <div class="modal fade" id="modalDevolucion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Devolucion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Introduzca la clave que deseas devolver</h4>
                    <input type="text" name="" class="form-control" id="txtClaveDevolucionModal" autofocus>
                    <br>
                    <div id="updateArray"><table></table></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarDevolucionModal">Guardar</button>
                </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="modalAdministradorPanel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Iniciar Sesion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Usuario</h4>
                    <input type="text" name="" class="form-control" id="txtUsuarioDevolucionModal" value="kgomez" required disabled>
                    <br>
                    <h4>Contraseña</h4>
                    <input type="password" name="" class="form-control" id="txtPassDevolucionModal" required>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnIniciarSesionAdminPanel">Iniciar Sesion</button>
                </div>
                </div>
            </div>
        </div>


    </body> 
</html>