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
    <div class="row">
        <div class="col-6">
            <h4><img src="../../img/iconos/x24/shoppingCar.png" alt=""> Cotizacion</h4>
        </div>
        <div class="col-6 text-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCotizacion_1" id="btnAddComponente">
                <i class="fa-solid fa-file-circle-plus"></i> Nueva Cotizacion
            </button>
        </div>
    </div>
    <hr>
    <div class="row py-2">
        <div class="col-9">
            <h4 id="pNombre">-</h4>
        </div>
        <div class="col-3 text-end">
            <div class="input-group">
                <input type="text" id="txt_subtotal_2" class="form-control" placeholder="$0.00" value="$111,201.12">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetalleTotal" id="btnInfoTot">
                    <i class="fa-solid fa-circle-info"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- INFORMACION DEL PRODUCTO -->
        <div class="col-3">
            <label for="">Clave: </label>
            <div class="input-group">
                <input type="text" id="txt_clave" class="form-control" placeholder="A001-E-NT">
                <button type="button" class="btn btn-primary" id="btn_search_cve" data-bs-toggle="modal" data-bs-target="#modalProductos">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>

        <div class="col-2">
            <label for="">Cantidad: </label>
            <input type="number" id="txt_cantidad" class="form-control" placeholder="500">
        </div>

        <div class="col-7">
            <label for="">Descripcion del Producto: </label>
            <input type="text" id="txt_descripcion" class="form-control" placeholder="LODERA CAMION S/REFLEJANTE LOGO INTERNATIONAL STADIUM-INTERNATIONAL TRUCKS" disabled>
        </div>

        <div class="col-3" hidden>
            <label for="">Importe con IVA: </label>
            <input type="text" id="total" class="form-control" placeholder="$0.00" disabled>
        </div>
        <div class="col-3" hidden>
            <label for="">Precio mas IVA: </label>
            <input type="text" id="txt_precioiva" class="form-control" placeholder="240" disabled>
        </div>
        <div class="col-3" hidden>
            <label for="">Oferta: </label>
            <input type="text" id="txt_precioOferta" class="form-control" placeholder="252.14" disabled>
        </div>
        <div class="col-3" hidden>
            <label for="">Restrinccion: </label>
            <input type="text" id="txt_Restriccion" class="form-control" placeholder="NO ES" disabled>
        </div>
        <div class="col-3" hidden>
            <label for="">Fam Oferta: </label>
            <input type="text" id="txt_FamOferta" class="form-control" placeholder="1" disabled>
        </div>
        <div class="col-12" hidden>
            <label for="">Total: </label>
            <input type="text" id="txt_total" class="form-control" placeholder="$00.00" disabled>
        </div>

    </div>
    <br>

    <div class="row">
        <div class="col-12">
            <div style="max-height: 200px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCotizacion_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Informacion del cliente
                        <div class="spinner-grow text-info" role="status" id="SpinnerLoad">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_saveData" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="modalDetalleTotal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Totales</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Remision: </label>
                            <input type="text" id="txt_tot_rem" class="form-control" placeholder="$0.00" value="$ 46,654.09">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Factura: </label>
                            <input type="text" id="txt_tot_fact" class="form-control" placeholder="$0.00" value="$ 55,644.00">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Subtotal: </label>
                            <input type="text" id="txt_subtotal" class="form-control" placeholder="$0.00" value="$ 102,298.09">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">IVA: </label>
                            <input type="text" id="txt_iva" class="form-control" placeholder="$0.00" value="$ 8,903.03">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Total de la venta: </label>
                            <input type="text" id="txt_tot_vta" class="form-control" placeholder="$0.00" value="$ 111,201.12">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_saveData" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-boxes-packing"></i> Cardex de Productos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="mb-2 table-responsive rounded text-nowrap" style="height: 450px;">
                            <div style="height: 425px; overflow-y:scroll;">
                                <table class="table table-hover table-striped table-sm">
                                    <thead class="thead-dark sticky-top">
                                        <tr>
                                            <th scope="col" class="text-center">CLAVE</th>
                                            <th scope="col" class="text-center">IMAGEN</th>
                                            <th scope="col" class="text-center">DESCRIPCION</th>
                                            <th scope="col" class="text-center">P.ESPECIAL</th>
                                            <th scope="col" class="text-center">P.OFERTA</th>
                                            <th scope="col" class="text-center">CVE SAT</th>
                                            <th scope="col" class="text-center">CVE UNIDAD</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableProducts">
                                        <!-- <tr class="align-items-center">
                                    <th class="text-center"><p class="text-primary">A001-E-NT</p></th>
                                    <td class="text-center"><img src="https://www.webipadsa.com/files/Productos/PNG/A001-E-NT.png" alt="" width="35" height="35"></td>
                                    <td class="text-center" style="max-width: 20rem;"><p class="">LODERA CAMION S/REFLEJANTE L... </p></td>
                                    <td class="text-center"><p class="text-success">$ 331.03</p></td>
                                    <td class="text-center"><p>-</p></td>
                                    <td class="text-center"><p class="text-success">25172601</p></td>
                                    <td class="text-center"><p class="text-success">H87</p></td>
                                </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination" id="pagination_kardex_products">

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_saveData" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>

</script>

</html>