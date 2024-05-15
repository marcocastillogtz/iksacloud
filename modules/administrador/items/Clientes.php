<?php
require_once('../../entidades/Estados.php');
require_once('../../entidades/Catalogos.php');
require_once('../../entidades/ListaPrecio.php');
require_once('../../entidades/Comision.php');
require_once('../../entidades/BancosClientes.php');
require_once('../../entidades/MetodoDeVenta.php');
require_once('../../entidades/Esquema.php');
require_once('../../entidades/CFDI.php');
$Estados_Object = new Estados;
$estado_data = $Estados_Object->getAll();

$Catalogos_Object = new Catalogo;
$Catalgo_data = $Catalogos_Object->getCatalogoSAT();

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

$Esquema_object = new Esquema;
$Esquema_data1 = $Esquema_object->getClienteEsquema();

$CFDI = new CFDI;
$ListCFDI = $CFDI->getCFDI();
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
            <h5 class="card-header"><i class="fa-solid fa-caret-right"></i> Comprobante Fiscal Digital por Internet (CFDI)</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo Comprobante</h5>
                <p class="card-text">Clave que describe la utilidad que se le dará a la factura electrónica para las deducciones del receptor, brindando la razón o el motivo de pago incorporado en el comprobante fiscal emitido.</p>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropCFDI" id="btnModalCFDI"><i class="fa-solid fa-plus"></i> Nuevo</a>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropTableCFDI" id="btnTableCFDI"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header"><i class="fa-solid fa-caret-right"></i> Servicio de Administracion Tributaria (SAT)</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo servicio</h5>
                <p class="card-text">Medios por los cuales se realiza el pago de los productos o servicios adquiridos; pueden ser por formas de pago convencionales(efectivo) o bien, por pagos electrónicos(tarjetas y/o tranferencias bancarias).</p>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropFormSAT" id="btnModalFormSAT"><i class="fa-solid fa-plus"></i> Nuevo</a>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropTableFormSAT" id="btnTableFormSAT"><i class="fa-solid fa-table"></i> Ver registros</a>
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
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropVenta" id="btnModalMetVenta"><i class="fa-solid fa-plus"></i> Nuevo</a>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropTableMVenta" id="btnTableMetVenta"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header"><i class="fa-solid fa-caret-right"></i> Modo esquema</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo metodo</h5>
                <p class="card-text">Indicador que muestra como será cobrado el producto adquirido por el cliente.</p>
                <!-- <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropEsquema" id="btnModalEsquema"><i class="fa-solid fa-plus"></i> Nuevo</a> -->
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropTableEsquema" id="btnTableEsquema"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header"><i class="fa-solid fa-caret-right"></i> Régimen Fiscal (SAT)</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo servicio</h5>
                <p class="card-text">Dato requerido para incorporar la clave del régimen del contribuyente emisor al que aplicará el efecto fiscal del comprobante.</p>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropRegimen" id="btnModalReg"><i class="fa-solid fa-plus"></i> Nuevo</a>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropTableRegimen" id="btnTableRegimen"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropClient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row my-2">
                        <div class="col-1">
                            <button class="btn btn-primary btn-sm" id="btnPrimerCte"><i class="fa-solid fa-backward-step"></i></button>
                            <button class="btn btn-secondary btn-sm" id="btnCteAnt"><i class="fa-solid fa-backward"></i></button>
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control text-center form-control-sm" id="idCliente" aria-describedby="idHelp" placeholder="Clave">
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control form-control-sm" id="txt_nombre_cliente" aria-describedby="nameHelp" placeholder="Nombre o Razon Social">
                        </div>
                        <div class="col-1">
                            <button class="btn btn-secondary btn-sm" id="btnCteSig"><i class="fa-solid fa-forward"></i></button>
                            <button class="btn btn-primary btn-sm" id="btnUltmCte"><i class="fa-solid fa-forward-step"></i></button>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-1"></div>
                        <div class="col-2">
                            <select type="text" class="form-select" id="estatus_select_client" aria-describedby="idEstatus">
                                <option value="none" selected>Estatus</option>
                                <option value="Activo">Activo</option>
                                <option value="Suspendido">Suspendido</option>
                            </select>
                        </div>
                        <div class="col-5">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control form-control-sm text-end" id="txt_saldo" aria-describedby="nameHelp" placeholder="$aldo">
                        </div>
                        <div class="col-1">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center active" id="list-info-list" data-bs-toggle="list" href="#list-info" role="tab" aria-controls="list-info">Informacion General <img src="../../img/iconos/outline/x16/info.png"></a>
                                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">Informacion de Saldos</a>
                                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-messages-list" data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">Informacion de Ventas</a>
                                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-settings-list" data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings">Bitacora de Movimientos</a>
                                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-contacts-list" data-bs-toggle="list" href="#list-contacts" role="tab" aria-controls="list-Contacts">Contactos</a>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-info" role="tabpanel" aria-labelledby="list-info-list"><?php include_once('tabsForms/Informacion Geneneral/Tabs.php') ?></div>
                                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">...</div>
                                <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
                                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
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
    </div>

    <div class="modal fade" id="staticBackdropTableClient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe2" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe2"><i class="fa-solid fa-users"></i> Cardex de clientes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="fdmzone-menu">
                        <div class="fdmbody-menu">
                            <div class="fdm-wrapper">
                                <div class="fdm-content">
                                    <ul class="fdm-menu">
                                        <li class="fdm-item" id="itemAdd">
                                            <i class="fa-solid fa-plus"></i>
                                            <span>Nuevo Cte</span>
                                        </li>
                                        <li class="fdm-item fdm-menu-display">
                                            <div>
                                                <span>Modificar Vista</span>
                                            </div>
                                            <i class="fa-solid fa-chevron-right"></i>
                                            <ul class="fdm-submenu">
                                                <li class="fdm-item fdm-item-sub" id="clmCve">
                                                    <span>Clave</span>
                                                </li>
                                                <li class="fdm-item fdm-item-sub" id="clmName">
                                                    <span>Nombre Completo</span>
                                                </li>
                                                <li class="fdm-item fdm-item-sub" id="clmRfc">
                                                    <span>RFC</span>
                                                </li>
                                                <li class="fdm-item fdm-item-sub" id="clmMail">
                                                    <span>Correo</span>
                                                </li>
                                                <li class="fdm-item fdm-item-sub" id="clmClss">
                                                    <span>Clasificacion</span>
                                                </li>
                                                <li class="fdm-item fdm-item-sub" id="clmEdo">
                                                    <span>Estado</span>
                                                </li>
                                                <li class="fdm-item fdm-item-sub" id="clmMun">
                                                    <span>Municipio</span>
                                                </li>
                                                <li class="fdm-item fdm-item-sub" id="clmPob">
                                                    <span>Poblacion</span>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="fdm-item">
                                            <i class="fa-solid fa-trash-can"></i>
                                            <span>Eliminar Cte</span>
                                        </li>
                                        <li class="fdm-item">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            <span>Editar Cte</span>
                                        </li>
                                    </ul>
                                    <div class="fdm-menu-item">
                                        <li class="fdm-item">
                                            <i class="fa-solid fa-gear"></i>
                                            <span>Ajustes</span>
                                        </li>
                                    </div>
                                </div>
                            </div>


                            <!-- Inicia Bootstrap -->
                            <div class="container-fluid">
                                <div style="height: 350px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Accion</th>
                                                <th class="text-center clmCve" id="clmCve_0">Clave</th>
                                                <th class="text-center clmName" id="clmName_0">Nombre Completo</th>
                                                <th class="text-center clmRfc" id="clmRfc_0">RFC</th>
                                                <th class="text-center clmMail" id="clmMail_0">Mail</th>
                                                <th class="text-center clmClss" id="clmClss_0">Clasificacion</th>
                                                <th class="text-center clmEdo" id="clmEdo_0">Estado</th>
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

    <div class="modal fade" id="staticBackdropTableRegimen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe3" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe3"><i class="fa-solid fa-users"></i> Cardex de Régimen Fiscal</h1>
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
                                        <th class="text-center">Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody id="tbRegimen">

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
                    <button type="button" class="btn btn-primary" id="btnTableGuardarRegimen">Agregar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toastCte" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
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

    <div class="modal fade" id="staticBackdropTableMVenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe5" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe5"><i class="fa-solid fa-users"></i> Cardex Modo de Venta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div style="height: 350px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
                            <table class="table table-hover table-striped">
                                <thead class="sticky-top">
                                    <tr>
                                        <th class="text-center">Accion</th>
                                        <th class="text-center">Código</th>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">Remisión</th>
                                        <th class="text-center">Factura</th>
                                    </tr>
                                </thead>
                                <tbody id="tbMetVenta">

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
                    <button type="button" class="btn btn-primary" id="btnTableGuardarMetVenta">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropVenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe6" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe6">Nuevo Modo de Venta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Código de Venta:</label>
                                <input type="text" class="form-control" id="input_idCodVenta">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Descripción:</label>
                                <input type="text" class="form-control" id="input_descripcionVenta">
                            </div>
                            <div class="row my-2">
                                <div class="col-6">
                                    <label for="message-text" class="col-form-label">Remisión:</label>
                                    <input type="number" step="0.05" min="0.0" max="1.0" class="form-control" id="input_remision">
                                </div>
                                <div class="col-6">
                                    <label for="message-text" class="col-form-label">Factura:</label>
                                    <input type="number" step="0.05" min="0.0" max="1.0" class="form-control" id="input_factura">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelNuevoMetVenta">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarMetVenta">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropRegimen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe4" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe4">Nuevo Régimen Fiscal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Clave:</label>
                                <input type="text" class="form-control" id="input_idRegimen">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Descripción:</label>
                                <input type="text" class="form-control" id="input_descripcionRegimen">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelNuevoRegimen">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarRegimen">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropTableFormSAT" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe7" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe7"><i class="fa-solid fa-users"></i> Cardex Formas de Pago SAT</h1>
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
                                        <th class="text-center">Descripción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbFormSAT">

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
                    <button type="button" class="btn btn-primary" id="btnTableGuardarFormSAT">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropFormSAT" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe8" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe8">Nueva Forma de Pago SAT</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Clave:</label>
                                <input type="text" class="form-control" id="input_idFormSAT">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Descripción:</label>
                                <input type="text" class="form-control" id="input_descripcionFormSAT">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelNuevaFormSAT">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarFormSAT">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropTableCFDI" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe9" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe9"><i class="fa-solid fa-users"></i> Cardex Uso de CFDI</h1>
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
                                        <th class="text-center">Descripción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbCFDI">

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
                    <button type="button" class="btn btn-primary" id="btnTableGuardarCFDI">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropCFDI" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe10" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe10">Nuevo Uso de CFDI</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Clave:</label>
                                <input type="text" class="form-control" id="input_idCFDI">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Descripción:</label>
                                <input type="text" class="form-control" id="input_descripcionCFDI">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelNuevoCFDI">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarCFDI">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropTableEsquema" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe11" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe11"><i class="fa-solid fa-users"></i> Cardex de Esquema</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div style="height: 350px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
                            <table class="table table-hover table-striped">
                                <thead class="sticky-top">
                                    <tr>
                                        <th class="text-center">Accion</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">P. Lista</th>
                                        <th class="text-center">Documento</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Hora</th>
                                        <th class="text-center">Estatus</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Comisión</th>
                                    </tr>
                                </thead>
                                <tbody id="tbEsquema">

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
                    <button type="button" class="btn btn-primary" id="btnTableGuardarEsquema">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropEsquema2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe13" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe13">Modificar Esquema por Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form>
                            <div class="row my-2">
                                <div class="col-7">
                                    <label for="recipient-name" class="col-form-label">Cliente:</label>
                                    <select name="" class="form-select" id="select_clienteEsq" aria-describedby="idcliente">
                                        <option value="0" selected>Selecciona un cliente</option>
                                        <?php
                                        foreach ($Esquema_data1 as $data) {
                                            echo '<option value="' . $data['cliente'] . '">' . $data['nombre_completo'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="message-text" class="col-form-label">Documento:</label>
                                    <select name="" class="form-select" id="select_documentoEsq" aria-describedby="idcliente">
                                        <option value="0" selected>Selecciona un documento</option>
                                        <option value="1">Remision</option>
                                        <option value="2">Factura</option>
                                    </select>
                                </div>

                                <div class="col-1">
                                    <label for="message-text" class="col-form-label">...</label>
                                    <button type="button" class="btn btn-secondary" id="btnBuscarEsqDoc"><i class="fa-solid fa-circle-check"></i></button>
                                </div>
                            </div>

                            <div style="height: 212px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
                            <table class="table table-hover table-striped">
                                <thead class="sticky-top">
                                    <tr>
                                        <th class="text-center">Accion</th>
                                        <th class="text-center">P. Lista</th>
                                        <th class="text-center">Estatus</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Comisión</th>
                                    </tr>
                                </thead>
                                <tbody id="tbEsquemaDoc">

                                </tbody>
                            </table>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelDocEsquema">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropEsquema" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe12" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe12">Modificar Esquema</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form>
                            <div class="row my-2">
                                <div class="col-10">
                                    <label for="message-text" class="col-form-label">Cliente:</label>
                                    <input type="text" class="form-control" id="input_clienteEsq">
                                </div>
                                <div class="col-2">
                                    <label for="message-text" class="col-form-label">Precio Lista:</label>
                                    <input type="text" class="form-control" id="input_PListaEsq">
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-6">
                                    <label for="message-text" class="col-form-label">Documento:</label>
                                    <input type="text" class="form-control" id="input_documentoEsq">
                                </div>
                                <div class="col-6">
                                    <label for="message-text" class="col-form-label">Estatus:</label>
                                    <select name="" class="form-select" id="select_estatusEsq" aria-describedby="idcliente">
                                    <option value="0"></option>
                                    <option value="1"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-6">
                                    <label for="message-text" class="col-form-label">Tipo:</label>
                                    <input type="text" class="form-control" id="input_tipoEsq">
                                </div>
                                <div class="col-6">
                                    <label for="message-text" class="col-form-label">Comisión:</label>
                                    <input type="text" class="form-control" id="input_comisionEsq">
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelNuevoEsquema">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarEsquema">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirm-->
    <div class="modal fade" id="modalDeleteCte" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <div class="modal fade" id="modalDeleteRegimen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-triangle-exclamation text-warning"></i> Eliminar Régimen Fiscal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Estas por eliminar el Régimen Fiscal seleccionado, sí lo <strong>eliminas</strong> esta acción no podra ser revocada más tarde, aún así
                        <strong>¿Deseas continuar?</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnDeleteRegimenCancel">No, Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnDeleteRegimenConfirm">Si, Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeleteMetVenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-triangle-exclamation text-warning"></i> Eliminar Modo de Venta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Estas por eliminar el Modo de Venta seleccionado, sí lo <strong>eliminas</strong> esta acción no podra ser revocada más tarde, aún así
                        <strong>¿Deseas continuar?</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnDeleteMetVentaCancel">No, Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnDeleteMetVentaConfirm">Si, Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeleteFormSAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-triangle-exclamation text-warning"></i> Eliminar Forma de Pago SAT</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Estas por eliminar la Forma de Pago seleccionada, sí la <strong>eliminas</strong> esta acción no podra ser revocada más tarde, aún así
                        <strong>¿Deseas continuar?</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnDeleteFormSATCancel">No, Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnDeleteFormSATConfirm">Si, Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeleteCFDI" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-triangle-exclamation text-warning"></i> Eliminar Uso de CFDI</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Estas por eliminar el Uso de CFDI seleccionado, sí lo <strong>eliminas</strong> esta acción no podra ser revocada más tarde, aún así
                        <strong>¿Deseas continuar?</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnDeleteCFDICancel">No, Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnDeleteCFDIConfirm">Si, Eliminar</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>