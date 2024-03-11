<?php
require_once('../../entidades/Estados.php');
require_once('../../entidades/Catalogos.php');
require_once('../../entidades/ListaPrecio.php');
require_once('../../entidades/Comision.php');
require_once('../../entidades/BancosClientes.php');
require_once('../../entidades/MetodoDeVenta.php');
$Estados_Object = new Estados;
$estado_data = $Estados_Object->getAll();

$Catalogos_Object = new Catalogo;
$Catalgo_data = $Catalogos_Object->getCatalogoSAT();
$CatalgoCFDI_data = $Catalogos_Object->getCatalogoCFDI();

$lp_Object = new ListaPrecio;
$lp_data = $lp_Object->getListaPrecio();

$Com_Object = new Comision;
$Com_data_remision = $Com_Object->getComisionRemision();
$Com_data = $Com_Object->getComisionFactura();
$Com_data = $Com_Object->getComisionFactura();


$BancoCliente_Object = new BancosClientes;
$BcoCliente_data = $BancoCliente_Object->getBancos();

$MetodoDeVenta_object = new MetodoDeVenta;
$MetodoVenta_data = $MetodoDeVenta_object->getCodVenta();

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
        <h4><i class="fa-solid fa-circle-info text-info"></i> Administrar</h4>
    </div>
    <hr>
    <!-- Done -->
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header"><i class="fa-solid fa-caret-right"></i> Clientes</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo Cliente</h5>
                <p class="card-text">Los clientes son los datos que en todas partes deberían de estar, desde aplicaciones hasta las plataformas, ya sea para cotizar,facturar,saldos,envios,etc.</p>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropClient" id="btnModalCte"><i class="fa-solid fa-plus"></i> Nuevo</a>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropTableClient" id="btnTableClient"><i class="fa-solid fa-table"></i> Ver registros</a>
                <a href="#" class="btn btn-outline-success" id="btnExcelModal" data-bs-toggle="modal" data-bs-target="#modalImport"><i class="fa-solid fa-file-excel"></i> Importar</a>
            </div>
        </div>
    </div>
    <br>
    <!-- Done -->
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header"><i class="fa-solid fa-caret-right"></i> Comprobante Fiscal por Internet (CFDI)</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo Comporbante</h5>
                <p class="card-text">-</p>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropSmodulos"><i class="fa-solid fa-plus"></i> Nuevo</a>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticTableSModule" id="btnTableSmod"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header"><i class="fa-solid fa-caret-right"></i> Servicio de Administracion Tributaria (SAT)</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo servicio</h5>
                <p class="card-text">-</p>
                <a href="#" class="btn btn-success"><i class="fa-solid fa-plus"></i> Nuevo</a>
                <a href="#" class="btn btn-primary"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header"><i class="fa-solid fa-caret-right"></i> Modo de venta</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo metodo</h5>
                <p class="card-text">Las nuevas formas operativas ayudan a saber de que modo se le va vender al cliente.</p>
                <a href="#" class="btn btn-success"><i class="fa-solid fa-plus"></i> Nuevo</a>
                <a href="#" class="btn btn-primary"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropClient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info-tab-pane" type="button" role="tab" aria-controls="info-tab-pane" aria-selected="true">
                                <i class="fa-solid fa-user text-ligth"></i> Cliente
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="poblacion-tab" data-bs-toggle="tab" data-bs-target="#poblacion-tab-pane" type="button" role="tab" aria-controls="poblacion-tab-pane" aria-selected="true">
                                <i class="fa-solid fa-map-pin text-ligth"></i> Domicilio
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="price-tab" data-bs-toggle="tab" data-bs-target="#price-tab-pane" type="button" role="tab" aria-controls="price-tab-pane" aria-selected="true">
                                <i class="fa-solid fa-dollar-sign text-ligth"></i> Precio
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="mdp-tab" data-bs-toggle="tab" data-bs-target="#mdp-tab-pane" type="button" role="tab" aria-controls="mdp-tab-pane" aria-selected="true">
                                <i class="fa-solid fa-info text-ligth"></i> Datos fiscales
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank-tab-pane" type="button" role="tab" aria-controls="bank-tab-pane" aria-selected="true">
                                <i class="fa-solid fa-building-columns text-ligth"></i> Datos fiscales
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!-- Tab Informacion -->
                        <div class="tab-pane fade show active" id="info-tab-pane" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                            <div class="row my-2">
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label for="idCliente" class="form-label">ID Cliente</label>
                                        <input type="text" class="form-control text-center" id="idCliente" aria-describedby="idHelp">
                                        <div id="idHelp" class="form-text text-danger">*Requerido</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="estatus_select_client" class="form-label">Estatus</label>
                                        <select type="text" class="form-select" id="estatus_select_client" aria-describedby="idEstatus">
                                            <option value="Activo" selected>Activo</option>
                                            <option value="Suspendido">Suspendido</option>
                                        </select>
                                        <div id="idEstatus" class="form-text text-danger">*Requerido</div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="mb-3">
                                        <label for="txt_nombre_cliente" class="form-label">Nombre o razon social</label>
                                        <input type="text" class="form-control" id="txt_nombre_cliente" aria-describedby="nameHelp">
                                        <div id="nameHelp" class="form-text text-danger">*Requerido</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="txt_telefono" class="form-label">Telefono</label>
                                        <input type="text" class="form-control" id="txt_telefono">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="txt_email" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="txt_email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tab Domicilio -->
                        <div class="tab-pane fade" id="poblacion-tab-pane" role="tabpanel" aria-labelledby="poblacion-tab" tabindex="0">
                            <div class="row my-2">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="estados_select" class="form-label">Estado</label>
                                        <select type="text" class="form-select" id="estados_select">
                                            <option value="0" selected>Seleccionar</option>
                                            <?php
                                            foreach ($estado_data as $data) {
                                                echo '<option value="' . $data['id_Estado'] . '">' . $data['estado'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="municipio_select" class="form-label">Municipio</label>
                                        <select type="text" class="form-select" id="municipio_select">
                                            <option value="0" selected>Seleccionar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="poblacion_select" class="form-label">Poblacion</label>
                                        <select type="text" class="form-select" id="poblacion_select">
                                            <option value="0" selected>Seleccionar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Precios -->
                        <div class="tab-pane fade" id="price-tab-pane" role="tabpanel" aria-labelledby="price-tab" tabindex="0">
                            <div class="row my-2">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="clasificacion_select" class="form-label">Clasificacion</label>
                                        <select type="text" class="form-select" id="clasificacion_select">
                                            <option value="0" selected>Seleccionar</option>
                                            <option value="UNO">001</option>
                                            <option value="DOS">002</option>
                                            <option value="TRES">003</option>
                                            <option value="CUATRO">004</option>
                                            <option value="CINCO">005</option>
                                            <option value="SEIS">006</option>
                                            <option value="SIETE">007</option>
                                            <option value="OCHO">008</option>
                                            <option value="DIEZ">010</option>
                                            <option value="TRECE">013</option>
                                            <option value="CATORCE">014</option>
                                            <option value="QUINCE">015</option>
                                            <option value="DIECISEIS">016</option>
                                            <option value="CIEN">DI001</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="txt_texto" class="form-label">Texto</label>
                                        <input type="text" class="form-control" id="txt_texto" disabled>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="select_mdv" class="form-label">Modo de venta</label>
                                        <select class="form-select" id="select_mdv">
                                            <option value="0" selected>Seleccionar</option>
                                            <?php
                                            foreach ($MetodoVenta_data as $mdv) {
                                                echo '<option value="' . $mdv['codigo_venta'] . '">' . $mdv['descripcion'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="select_lp_remision" class="form-label">Remision</label>
                                        <select class="form-select" id="select_lp_remision">
                                            <option value="0" selected>Seleccionar</option>
                                            <?php
                                            foreach ($lp_data as $datalp) {
                                                echo '<option value="' . $datalp['id'] . '">' . $datalp['tipo'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="select_lp_factura" class="form-label">Factura</label>
                                        <select class="form-select" id="select_lp_factura">
                                            <option value="0" selected>Seleccionar</option>
                                            <?php
                                            foreach ($lp_data as $datalp) {
                                                echo '<option value="' . $datalp['id'] . '">' . $datalp['tipo'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="select_com_remision" class="form-label">Com. Remision</label>
                                        <select class="form-select" id="select_com_remision">
                                            <option value="0" selected>Seleccionar</option>
                                            <?php
                                            foreach ($Com_data_remision as $comR) {
                                                echo '<option value="' . $comR['codigo_comision'] . '">' . $comR['codigo_comision'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="select_com_factura" class="form-label">Com. Factura</label>
                                        <select class="form-select" id="select_com_factura">
                                            <option value="0" selected>Seleccionar</option>
                                            <?php
                                            foreach ($Com_data as $com) {
                                                echo '<option value="' . $com['codigo_comision'] . '">' . $com['codigo_comision'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Datos fiscales -->
                        <div class="tab-pane fade" id="mdp-tab-pane" role="tabpanel" aria-labelledby="mdp-tab" tabindex="0">
                            <div class="row my-2">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="txt_rfc" class="form-label">RFC</label>
                                        <input type="text" class="form-control" id="txt_rfc" placeholder="XAXX010101000" maxlength="13">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="select_mdp" class="form-label">Metodo de pago</label>
                                        <select type="text" class="form-select" id="select_mdp">
                                            <option value="0" selected>Seleccionar</option>
                                            <?php
                                            foreach ($Catalgo_data as $dataCatalogo) {
                                                echo '<option value="' . $dataCatalogo['c_FormaPago'] . '">' . $dataCatalogo['Descripcion'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="select_cfdi" class="form-label">Metodo de pago</label>
                                        <select type="text" class="form-select" id="select_cfdi">
                                            <option value="0" selected>Seleccionar</option>
                                            <?php
                                            foreach ($CatalgoCFDI_data as $cfdi) {
                                                echo '<option value="' . $cfdi['c_UsoCFDI'] . '">' . $cfdi['Descripcion'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <h4>Configuración</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="select_lp_alterna" class="form-label">Lp. Alterna</label>
                                        <select type="text" class="form-select" id="select_lp_alterna">
                                            <option value="0" selected>Seleccionar</option>
                                            <?php
                                            foreach ($lp_data as $datalp) {
                                                echo '<option value="' . $datalp['id'] . '">' . $datalp['tipo'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="check_lpa" checked>
                                        <label class="form-check-label" for="check_lpa" id="labelCheckLP">L. Precios Original</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="check_doc_fiscal" checked>
                                        <label class="form-check-label" for="check_doc_fiscal" id="labelCheckdF">Emitir a: Remision</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="check_auth" checked>
                                        <label class="form-check-label" for="check_auth" id="labelCheckAuth">Req. Autenticacion</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Datos Bancarios -->
                        <div class="tab-pane fade" id="bank-tab-pane" role="tabpanel" aria-labelledby="bank-tab" tabindex="0">
                            <div class="row my-2">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="select_Banco_client" class="form-label">Banco</label>
                                        <select type="text" class="form-select" id="select_Banco_client" aria-describedby="idHelperBanco">
                                            <option value="0" selected>Seleccionar</option>
                                            <?php
                                            foreach ($BcoCliente_data as $bco) {
                                                echo '<option value="' . $bco['id_banco'] . '">' . $bco['desc_banco'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <div id="idHelperBanco" class="form-text text-danger">*Requerido</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="txt_cuenta_cliente" class="form-label">Cuenta Cliente:</label>
                                        <input type="text" class="form-control" id="txt_cuenta_cliente" aria-describedby="idCuentaBanco">
                                        <div id="idCuentaBanco" class="form-text text-danger">*Requerido</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="txt_limite_dias" class="form-label">Limite de dias:</label>
                                        <input type="number" class="form-control" id="txt_limite_dias">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="txt_limite_credito" class="form-label">limite de credito</label>
                                        <input type="number" class="form-control" id="txt_limite_credito">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCloseCte">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnSaveCte">Agregar</button>
                    <button class="btn btn-primary" type="button" disabled id="btnSpinner">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropTableClient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe2" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe2"><i class="fa-solid fa-users"></i> Cardex de clientes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div style="height: 350px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
                            <table class="table table-hover table-striped">
                                <thead class="sticky-top">
                                    <tr>
                                        <th class="text-center">Accion</th>
                                        <th class="text-center">Clave</th>
                                        <th class="text-center">Nombre Completo</th>
                                        <th class="text-center">RFC</th>
                                        <th class="text-center">Mail</th>
                                        <th class="text-center">Clasificacion</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Municipio</th>
                                        <th class="text-center">Poblacion</th>
                                        <th class="text-center">Telefono</th>
                                        <th class="text-center">Texto</th>
                                        <th class="text-center">Lp.(Remision)</th>
                                        <th class="text-center">Lp.(Factura)</th>
                                        <th class="text-center">CFDI</th>
                                        <th class="text-center">Metodo de pago</th>
                                        <th class="text-center">Cve % Remision</th>
                                        <th class="text-center">Cve % Factura</th>
                                        <th class="text-center">Modo de venta</th>
                                        <th class="text-center">Lp.(Alterna)</th>
                                        <th class="text-center">Usar Lista</th>
                                        <th class="text-center">Emitision</th>
                                        <th class="text-center">Operacion</th>
                                        <th class="text-center">Banco</th>
                                        <th class="text-center">Cliente cta.</th>
                                        <th class="text-center">Dias limite</th>
                                        <th class="text-center">Credito limite</th>
                                    </tr>
                                </thead>
                                <tbody id="tbClients">

                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnSaveCte">Agregar</button>
                </div>
            </div>
        </div>

        <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img id="icon_toast" src="../../img/iconos/x16/check.png" class="rounded me-2" alt="..." width="16px" height="16px">
                <strong class="me-auto">CBSU</strong>
                <small>Justo Ahora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p id="message_toast"></p>
            </div>
        </div>
    </div>



    <!-- Modal Confirm-->
    <div class="modal fade" id="modalDeleteCte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-triangle-exclamation text-warning"></i> Eliminar Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Estas por eliminar este cliente,sí lo <strong>eliminas</strong> esta acción no podra ser revocada más tarde, aún así
                        <strong>¿Deseas eliminar este cliente?</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnDeleteCteCancel">No,Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnDeleteCteConfirm">Si,Eliminar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="text" id="txtImportFileExcel" hidden>
                    <h5 class="modal-title" id="staticBackdropLabel">Selecciona Archivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputImportExcel">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnExportExcel">Importar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>