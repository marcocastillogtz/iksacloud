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
        <h4><img src="../../img/iconos/x24/shoppingCar.png" alt=""> Cotizacion</h4>
    </div>
    <hr>
    <div class="row">
        <!-- <div class="col-12">
            <button type="button" class="btn btn-success" id="btnAddComponente">Añadir Componente</button>
        </div> -->
        <div class="col-3">
            <label for="">Numero Cliente: </label>
            <input type="number" id="txt_idCliente" class="form-control" placeholder="7">
        </div>
        <div class="col-3">
            <label for="">Documento: </label>
            <select name="" id="select_documento" class="form-select" disabled>
                <option value="0" selected>Seleccionar..</option>
                <option value="Factura">Factura</option>
                <option value="Remision">Remision</option>
            </select>

        </div>
        <div class="col-3">
            <label for="">Enviado por: </label>
            <select name="" id="select_envio" class="form-select">
                <option value="0" selected>Seleccionar..</option>
                <option value="Inyeccion">Personalmente</option>
                <option value="Ensamble">Paqueteria</option>
            </select>
        </div>
        <div class="col-3">
            <label for="">Fecha: </label>
            <input type="text" class="form-control" id="txt_fecha" pattern="\d{4}-\d{2}-\d{2}" disabled="">
        </div>

        <div class="col-12">
            <label for="">Comentario: </label>
            <input type="text" id="txt_comentario" class="form-control" placeholder="Enviar por FedEx">
        </div>
        
        <div class="col-12">
            <label for="">Nombre Completo: </label>
            <input type="text" id="txt_cliente" class="form-control" placeholder="PACANOWSKI LEDERMAN LEON" disabled>
        </div>

        <div class="col-4">
            <label for="">#Pedido: </label>
            <input type="text" id="txt_idPedido" class="form-control" placeholder="543" disabled>
        </div>

        <div class="col-4">
            <label for="">Lista de Precio: </label>
            <input type="text" id="txt_lp" class="form-control" placeholder="39" disabled>
        </div>

        <div class="col-4">
            <label for="">Nombre de Lista: </label>
            <input type="text" id="txt_lpDescripcion" class="form-control" placeholder="70 y 75 Mas IVA" disabled>
        </div>

        <div class="col-6">
            <label for="">Vendedor: </label>
            <input type="text" id="txt_idVendedor" class="form-control" placeholder="21" disabled>
        </div>

        <div class="col-6 p-2">
            <label for="">Nombre Vendedor: </label>
            <input type="text" id="txt_vendedor" class="form-control" placeholder="JUAN MIGUEL LEYVA TENORIO" disabled>
        </div>
        <br>
        <hr>
        <div class="col-3">
            <label for="">Clave: </label>
            <input type="text" id="txt_clave" class="form-control" placeholder="A001-E-NT">
        </div>

        <div class="col-2">
            <label for="">Cantidad: </label>
            <input type="number" id="txt_cantidad" class="form-control" placeholder="500">
        </div>

        <div class="col-4">
            <label for="">Descripcion del Producto: </label>
            <input type="text" id="txt_descripcion" class="form-control" placeholder="LODERA CAMION S/REFLEJANTE LOGO INTERNATIONAL STADIUM-INTERNATIONAL TRUCKS" disabled>
        </div>
        <div class="col-3">
            <label for="">Importe con IVA: </label>
            <input type="text" id="total" class="form-control" placeholder="$0.00" disabled>
        </div>
        <div class="col-3">
            <label for="">Precio mas IVA: </label>
            <input type="text" id="txt_precioiva" class="form-control" placeholder="240" disabled>
        </div>
        <div class="col-3">
            <label for="">Oferta: </label>
            <input type="text" id="txt_precioOferta" class="form-control" placeholder="252.14" disabled>
        </div>
        <div class="col-3">
            <label for="">Restrinccion: </label>
            <input type="text" id="txt_Restriccion" class="form-control" placeholder="NO ES" disabled>
        </div>
        <div class="col-3">
            <label for="">Fam Oferta: </label>
            <input type="text" id="txt_FamOferta" class="form-control" placeholder="1" disabled>
        </div>
        <div class="col-12">
            <label for="">Total: </label>
            <input type="text" id="txt_total" class="form-control" placeholder="$00.00" disabled>
        </div>
        
    </div>
    <br><br>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 111">
        <div id="toastComponents" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Aviso</strong>
                <small>Justo Ahora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>


        <div style="height: 600px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
            <table class="table table-hover table-striped">
                <thead class="thead-dark sticky-top">
                    <tr>
                        <th scope="col">CLAVE</th>
                        <th scope="col">DESCRIPCION</th>
                        <th scope="col">PRECIO</th>
                        <th scope="col">CANTIDAD</th>
                        <th scope="col">TOTAL</th>
                        <th scope="col">OPERACION</th>
                    </tr>
                </thead>
                <tbody id="tableComponentes">
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



</body>
<script>

</script>

</html>