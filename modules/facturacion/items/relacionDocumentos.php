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
        <h4><img src="../../img/iconos/x24/relacion.png" alt=""> Relacion de Documentos</h4>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="input-group">
                <div class="col-4">
                    <select class="form-control" name="" id="selectBancoRelacionDocumentos">
                        <option value="0">Selecciona un Banco</option>
                    </select>
                </div>
                <div class="col-1 p-2">
                    <label for="">Desde:</label>
                </div>
                <div class="col-2">
                    <input class="form-control" type="date" name="" id="txtDesdeRelacionDocumentos">
                </div>
                <div class="col-1 p-2">
                    <label for="">Hasta:</label>
                </div>
                <div class="col-2">
                    <input class="form-control" type="date" name="" id="txtHastaRelacionDocumentos">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-primary form-control text-center" id="btnBuscarRelacionDocumentos">Buscar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="input-group">
                <input type="text" name="" id="" class="form-control" placeholder="Buscar..">
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
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Folio</th>
                        <th scope="col">Remision</th>
                        <th scope="col">Factura</th>
                        <th scope="col">Documento</th>
                        <th scope="col-2">Estatus</th>
                        </tr>
                    </thead>
                    <tbody id="pedidosRelacionDocumentos"></tbody>
                        <tr id="spinnerTableRelacionDocs">
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