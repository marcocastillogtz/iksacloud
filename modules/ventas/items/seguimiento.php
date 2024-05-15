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
        <h4><img src="../../img/iconos/x24/chat.png"> Seguimiento</h4>
    </div>
    <hr>
        <div class="container-fluid">
            <form class="row g-3">
                <div class="col-3">
                    <select class="form-select" aria-label="Default select example" id="selectSellerSeguimiento">
                        <option value="All" selected>Vendedor</option>
                    </select>
                </div>

                <div class="col-3">
                    <select class="form-select" aria-label="Default select example" id="selectClientSeguimiento">
                        <option value="All" selected>Cliente</option>
                    </select>
                </div>

                <div class="col-2">
                    <input type="date" name="" id="dateSeguimiento1" class="form-control">     
                </div>

                <div class="col-2">
                    <input type="date" name="" id="dateSeguimiento2" class="form-control">    
                </div>

                <div class="col-2">
                    <button type="button" class="btn btn-primary" id="btnBuscarSeguimiento"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                </div>
                
            </form>
            <br>
        </div>
    <!-- Done -->
    <div class="container-fluid">
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Vendedor</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Logistica</th>
                    <th scope="col">Guia</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tableSeguimiento"></tbody>
                    <tr id="spinnerTableSeguimiento">
                        <td colspan="8">
                            <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status" id="spinner-seguimiento">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            </div>
                        </td>
                    </tr>
            </table>
        </div>
    </div>

        <div class="modal fade" id="modalLogistica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Logistica</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <input type="text" class="form-control" id="txtIdPedidoLogistica" disabled hidden>
                </div>
                <div class="modal-body">
                    <div class="mb-3">                        
                        <select class="form-select" aria-label="Default select example" id="selectMetodoEnvio">
                            <option value="Personalmente" selected>Personalmente</option>
                            <option value="Paqueteria">Paqueteria</option>
                        </select>
                    </div>
                    <div class="mb-3">                        
                        <select class="form-select" aria-label="Default select example" id="selectLogistica" disabled>
                            <option value="All" selected>Seleccione una logistica</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="txtGuiaLogistica" placeholder="Guia" disabled>
                    </div>
                    <div class="mb-3">
                        <div id="showArray"></div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="addGuia">Añadir Guia</button>
                    <button type="button" class="btn btn-primary" id="sendGuia">Enviar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
                </div>
            </div>
        </div>

    </body>
</html>