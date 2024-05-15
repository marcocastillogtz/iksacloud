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
        <h4><img src="../../img/iconos/x24/contrato.png" alt=""> Documentos Facturados</h4>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="input-group">
                <div class="col-1">
                    <button type="button" class="btn btn-primary" id="btnReporteDocsFacturados">Reporte</button>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-success" id="btnUpdateTableDocsFacturados"><i class="fa-solid fa-arrows-rotate"></i></button> 
                </div>
                <div class="col-10">
                    <input type="text" id="txtSearchDocsFacturados" class="form-control" placeholder="Search..">
                </div>
                
            </div>
        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-2">
            <div style="max-height: 600px; max-width: 600px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Descripcion</th>
                        </tr>
                    </thead>
                    <tbody id="item_pedidos">
                            <tr class="table-success">
                                <td>Listo para facturar</td>
                            </tr>
                            <tr class="text text-align-center">
                                <td><i class="fa-solid fa-circle"></i> CheckOut</td>
                            </tr>
                            <tr class="text text-align-center">
                                <td><i class="fa-solid fa-circle-check"></i> Surtido</td>
                            </tr>
                            <tr class="text text-align-center">
                                <td><i class="fa-solid fa-play"></i> Para checar</td>
                            </tr>
                            <tr class="text text-align-center">
                                <td><i class="fa-solid fa-clock"></i> Surtiendose</td>
                            </tr>
                            <tr class="text text-align-center">
                                <td><i class="fa-regular fa-circle"></i> Para surtir</td>
                            </tr>
                            <tr class="text text-align-center">
                                <td><i class="fa-solid fa-circle-minus"></i> Sin verificar</td>
                            </tr>
                            <tr class="text text-align-center">
                                <td><i class="fa-solid fa-minus"></i> No requerido</td>
                            </tr>
                            <tr class="table-ligth">
                                <td>Pedido Local</td>
                            </tr>
                            <tr class="table-info">
                                <td>Pedido Foraneo</td>
                            </tr>
                            <tr class="table-warning">
                                <td>Metodo Indefinido</td>
                            </tr>
                            <tr class="text text-align-center">
                                <td><i class="fa-solid fa-circle" style="color: #FF0000;"></i> Prioridad Alta</td>
                            </tr>
                            <tr class="text text-align-center">
                                <td><i class="fa-solid fa-circle" style="color: #ffc107;"></i> Prioridad Media</td>
                            </tr>
                            <tr class="text text-align-center">
                                <td><i class="fa-solid fa-circle" style="color: #198754;"></i> Prioridad Estandar</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-10">
            <div style="max-height: 500px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Observacion</th>
                            <th scope="col">Piezas</th>
                            <th scope="col">Paquetes</th>
                            <th scope="col">Emblemas</th>
                            <th scope="col">Folio</th>
                            <th scope="col">Piezas</th>
                            <th scope="col">Paquete</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="item_docs_facturados"></tbody>
                        <tr id="spinnerTableDocsFacturados">
                            <td colspan="10">
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border" role="status" id="spinner-docs-facturados">
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
        <div class="modal fade" id="modalOpcionesDocsFacturados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Opciones</h1>
                        <input type="text" name="" id="txtIdPedidoModalDocumentosFacturados" hidden disabled>
                        <input type="text" name="" id="txtFolioModalDocumentosFacturados" hidden disabled>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Que operacion deseas realizar??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btnFacturarPedidoModal">Facturar</button>
                       <button type="button" class="btn btn-primary" id="btnVerPedidoModal">Ver Pedido</button>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Modal -->
        <div class="modal fade" id="modalPanelControlFactPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Panel de Control</h1>
                    <input type="text" name="" id="txtFolioModalPanelControl" hidden disabled>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-6">
                            <label for="">Pedido Factura (SAE)</label>
                            <input type="number" id="txtPedidoFact" class="form-control" placeholder="PR0000000001" aria-label="PR0000000001">
                        </div>
                        <div class="col-6">
                            <label for="">Pedido Remision (SAE)</label>
                            <input type="number" id="txtPedidoRem" class="form-control" placeholder="CR0000000001" aria-label="PR0000000001">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-3">
                            <label for=""># Pedido</label>
                            <input type="text" id="txtIdPedidoDocumentosFact"  class="form-control" placeholder="###" aria-label="###">
                        </div>
                        <div class="col-9">
                            <label for="">Comentario (Opcional)</label>
                            <input type="text" id="txtComentarioDocumentosFact" class="form-control" placeholder="El comentario aparecerá en el documento" aria-label="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <input class="form-check-input" type="radio" name="emisionFactura" id="emisionFactura"  value="6040"   checked>
                            <label for="">Mixto. 60-40</label>
                            
                        </div>
                        <div class="col-4">
                            <input class="form-check-input" type="radio" name="emisionFactura" id="emisionFactura" value="9010">
                            <label for="">OPE.  90-10</label>
                        </div>
                        <div class="col-4">
                            <input class="form-check-input" type="radio" name="emisionFactura" id="emisionFactura"  value="100">
                            <label for="">100% Fact / Rem</label>
                        </div>
                        <!-- emisiondefactura -->
                    </div>
                    <br>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnDocsFacturados">Facturar</button>
                </div>

                </div>
            </div>
        </div>
        

      
        


        <!-- Modal -->
        <div class="modal fade" id="modalGenerarReporteFactPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Generar Reporte</h1>
                    <!-- <input type="text" name="" id="txtFolioModalPanelControl" hidden disabled> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-6">
                            <label for="">Vendedor</label>
                            <select class="form-select" aria-label="Default select example" id="txtVendedorGenerarReporte">
                                <option selected>Selecciona un Vendedor</option>
                            </select>

                        </div>
                        <div class="col-6">
                            <label for="">Cliente</label>
                                <select class="form-select" aria-label="Default select example" id="txtClienteGenerarReporte">
                                <option selected>Selecciona un clientte</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Opciones</label>
                            <select class="form-select" aria-label="Default select example" id="selectOpcionesGenerarReporte">
                                <option selected value="0">No filtrar fechas</option>
                                <option value="1">Fechas Seleccionadas</option>
                                <option value="2">Hoy</option>
                                <option value="3">Esta Semana</option>
                                <option value="4">Esta Mes</option>  
                                <option value="5">Mes Anterior</option>
                                <option value="6">1ra  Quincena</option>
                                <option value="7">2da  Quincena</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label for="">Desde:</label>
                           <input type="date" name="" id="dateDesdeReportFactPedido" class="form-control">
                        </div>

                        <div class="col-6">
                            <label for="">Hasta:</label>
                            <input type="date" name="" id="dateHastaReportFactPedido" class="form-control">
                            
                        </div>
                        
                    </div>
                    <br>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnDocsFacturadosReporte">Facturar</button>
                </div>

                </div>
            </div>
        </div>


    </body> 
</html>