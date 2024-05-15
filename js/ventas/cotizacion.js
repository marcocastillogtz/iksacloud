$(document).ready(function () {
    console.log('Modulo de cotizacion');
    $("#SpinnerLoad").hide()
    $("#tableComponentes tr").remove();
    $('.toast').toast('show');
    $("#txt_fecha").val(getDate())
    // disabledInput()
    enabledInput()
})

function disabledInput() {
    $("#txt_clave").prop("disabled", true)
    $("#btn_search_cve").prop("disabled", true)
    $("#txt_cantidad").prop("disabled", true)
    $("#txt_subtotal_2").prop("disabled", true)
    $("#btnInfoTot").prop("disabled", true)
}

function enabledInput() {
    $("#txt_clave").prop("disabled", false)
    $("#btn_search_cve").prop("disabled", false)
    $("#txt_cantidad").prop("disabled", false)
    $("#txt_subtotal_2").prop("disabled", false)
    $("#btnInfoTot").prop("disabled", false)
}


var delayTimer;
var arrData = [];
var innerSpinner = `                        
<tr>
<th scope="row" colspan="6">
    <div class="text-center">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</th>
</tr>`;
$("#tableComponentes").html(innerSpinner);


$('#txt_idCliente').keyup(function (e) {
    var cteId = $("#txt_idCliente").val();
    if (cteId.length > 0) {
        // $('#spinnerContainer').show()
        $("#btn_saveData").prop("disabled", true)
        $("#SpinnerLoad").show()
        clearTimeout(delayTimer)
        delayTimer = setTimeout(() => {
            console.log("Buscando Cliente")
            buscarCliente(cteId).then((response) => {
                let result = response.split("-");
                if (result[0] == 0) {
                    alert(result[1]);
                    $("#SpinnerLoad").hide()
                    $("#btn_saveData").prop("disabled", false)
                } else {
                    var cteName = $("#txt_cliente").val();
                    $('#pNombre').html("Cte: (" + cteId + ")-" + cteName)
                    $("#SpinnerLoad").hide()
                    $("#btn_saveData").prop("disabled", false)
                    enabledInput()
                }
            }).catch((error) => {
                console.log('Error..' + error);
                $("#SpinnerLoad").hide()
                $("#btn_saveData").prop("disabled", false)
            })
        }, 3000);
    }

});


// document.addEventListener('keydown', function (event) {

//     if (localStorage.getItem("submodule")) {
//         if (event.key === 'F9') {
//             $("#txt_fecha").val(getDate());
//             $('#modalCotizacion_1').modal('show');
//         }
//     }else{
//         alert("Funcion no disposnible para este modulo");
//     }
// });

//@Explication: Devuelve la fecha del dia de hoy
function getDate() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();

    dd = addZero(dd);
    mm = addZero(mm);

    let date = yyyy + '/' + mm + '/' + dd
    return date;
}
//@Explication: Agrega un 0 y los devuelve los numeros siempre y cuando se menores a 10 
function addZero(i) {
    if (i < 10) {
        i = '0' + i;
        // i+= '0';
    }
    return i;

}


function mainCotizacion() {

}

function buscarCliente(idCliente) {
    arrData = [];
    arrData.push('getClients');
    arrData.push(idCliente);

    return new Promise(function (resolve, reject) {

        $.ajax({
            // url: "../../functions/ventas/cotizacion/SearchClient.php",
            url: "../../functions/ventas/mainCotizacion.php",
            type: "GET",
            data: { arrData },
            success: function (response) {
                let customer = JSON.parse(response)
                customer.forEach((customer) => {
                    let NombreCompleto = customer.Nombre;
                    let listaPrecio = customer.lislista_precio;
                    let codeError = customer.code;
                    let messageError = customer.message;
                    let validation = customer.validation;

                    if (listaPrecio == 0 || codeError == 400) {
                        alert("No se encontro coincidencias,intentalo de nuevo")
                        $('#txt_clave').prop("disabled", true);
                        $('#txt_cantidad').prop("disabled", true);
                    } else {
                        if (NombreCompleto == null) {
                            $('#txt_cliente').val("Sin Coincidencias");
                            $('#txt_vendedor').val("Sin Coincidencias");
                            $('#txt_idVendedor').val("Sin Coincidencias");
                            $('#txt_lp').val(0);
                            $('#txt_lpDescripcion').val("Sin Coincidencias");
                            $('#txt_clave').prop("disabled", false);
                            $('#txt_cantidad').prop("disabled", false);
                        } else {
                            $('#txt_cliente').val(customer.Nombre);
                            $('#txt_vendedor').val(customer.Vendedor);
                            $('#txt_idVendedor').val(customer.id);
                            $('#txt_clave').prop("disabled", false);
                            $('#txt_cantidad').prop("disabled", false);
                            if (idCliente == 'MOSTR') {
                                $('#txt_precioiva').prop("disabled", false);
                            } else {
                                $('#txt_precioiva').prop("disabled", true);
                            }

                            // if (customer.opstandar == 1 && customer.opfactura == 0) {
                            //     $('#select_documento').val(customer.doc_alt);
                            //     $('#txt_lp').val(customer.lista_precio);
                            //     $('#txt_lpDescripcion').val(customer.Descripcion);
                            // } else if (customer.opstandar == 0 && customer.opfactura == 1) {
                            //     if (customer.doc_alt == "Factura") {
                            //         $('#select_documento').val(customer.doc_alt);
                            //         $('#txt_lp').val(customer.lpa);
                            //         $('#txt_lpDescripcion').val(customer.lp_alt);
                            //     } else if (customer.doc_alt == "Remision") {
                            //         $('#select_documento').val(customer.doc_alt);
                            //         $('#txt_lp').val(customer.lpa);
                            //         $('#txt_lpDescripcion').val(customer.lp_alt);
                            //     }
                            // }
                            if (customer.opstandar == 1) {
                                $('#select_documento').val(customer.doc_alt);
                                $('#txt_lp').val(customer.lista_precio);
                                $('#txt_lpDescripcion').val(customer.Descripcion);
                            } else if (customer.opstandar == 0) {
                                if (customer.doc_alt == "Factura") {
                                    $('#select_documento').val(customer.doc_alt);
                                    $('#txt_lp').val(customer.lpa);
                                    $('#txt_lpDescripcion').val(customer.lp_alt);
                                } else if (customer.doc_alt == "Remision") {
                                    $('#select_documento').val(customer.doc_alt);
                                    $('#txt_lp').val(customer.lpa);
                                    $('#txt_lpDescripcion').val(customer.lp_alt);
                                }
                            }
                        }
                        resolve(validation + "-" + messageError);
                    }
                })

            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                alert('Request' + XMLHttpRequest);
                alert('Estatus' + txtStatus);
                alert('Error' + errorThrown);

                reject(500);
            }
        })
    })
}

function Mayus(key) {
    $("#txt_clave").val(key.toUpperCase());
}

$('#txt_clave').keyup(function (e) {
    var key = $('#txt_clave').val();

    clearTimeout(delayTimer);
    delayTimer = setTimeout(() => {
        if (key.length > 8 && key.length < 10) {
            ConsultarClave(key).then((result) => {
                if (result == 500) {
                    alert('Ocurrio un problema, intentelo mas tarde');
                }
            }).catch((error) => {
                alert('Ocurrio un problema inesperado :| =>' + error);
            })
        } else {

        }
    }, 100);
})

function ConsultarClave(clave) {
    var lp = $('#txt_lp').val();

    arrData = [];
    arrData.push('consultarClave');
    arrData.push(clave);
    arrData.push(lp);


    return new Promise(function (resolve, reject) {

        $.ajax({
            // url: "../../functions/ventas/cotizacion/searchItem.php",
            url: "../../functions/ventas/mainCotizacion.php",
            type: "GET",
            data: { arrData },
            success: function (response) {
                let producto = JSON.parse(response)
                producto.forEach(element => {
                    let formatMoney = Intl.NumberFormat('en-US');
                    let descripcion = element.ProductoDescripcion
                    if (descripcion == null) {
                        $("#txt_descripcion").val("Sin descripcion");
                        $("#txt_precioOferta").val(0.0);
                        $("#txt_FamOferta").val(0);
                        $("#txt_Restriccion").val("S/D");
                    } else {
                        $("#txt_descripcion").val(element.ProductoDescripcion);
                        $("#txt_precioiva").val(formatMoney.format(element.PrecioLista));
                        $("#txt_precioOferta").val(formatMoney.format(element.PrecioOferta));
                        $("#txt_FamOferta").val(element.FamOferta);
                        $("#txt_Restriccion").val(element.ResOferta);
                    }
                    resolve(1)
                });
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                reject(500)
            }
        })
    })
}



$('#txt_cantidad').keyup(function (e) {
    /*
    var cantidad = $('#txt_cantidad').val();
   
    clearTimeout(delayTimer);
    delayTimer = setTimeout(() => {
        if (cantidad.length > 0) {
            alert('esta es la cantidad..'+cantidad);
        } else {
            
        }
    }, 100);
    */
    Total();
    var clave = $("#txt_clave").val()
    var descripcion = $("#txt_descripcion").val()
    var pedido = $("#txt_pedido").val()

    //@Comment: 13 representa le tecla Enter
    if (e.keyCode === 13) {
        e.preventDefault()
        if (clave.length == 9) {
            if (descripcion != "Sin descripcion") {
                let cantidad = $('#txt_cantidad').val()
                if (cantidad > 0) {
                    if (pedido == null || pedido == "" || pedido == 0) {
                        var cliente = $("#txt_idCliente").val()
                        if (cliente.length > 0) {
                            $('#spinnerContainer').show()
                            idOrder().then((result) => {
                                if (result > 0 || result != null || result != "") {
                                    $('#txt_idPedido').val(result);
                                    $('#pPedido').show()
                                    $('#pPedido').html("Pedido: " + $('#txt_idPedido').val())
                                    return searchObservacion(result)
                                } else {
                                    $('#txt_idPedido').val("0");
                                }
                            }).then((result_1) => {
                                if (result_1 == 1) {
                                    return getTotal()
                                }
                            }).then((result_3) => {
                                if (result_3 == 1)
                                    return fetchItems()
                            }).then((finish) => {
                                if (finish != 500) {
                                    $('#spinnerContainer').hide()
                                    return focus()
                                }
                            }).catch((error) => {
                                // $.alert({
                                //     title: 'Error!',
                                //     content: error,
                                // });
                                alert('Error..' + error);
                            })
                        } else {
                            // $.alert({
                            //     title: 'Mensaje!',
                            //     content: "Asigna un cliente.",
                            // });
                            alert('Asigna un cliente');
                        }
                    } else {
                        $('#spinnerContainer').show()
                        AgregarItem().then((task1) => {
                            if (task1 == 0) {
                                // $.alert({
                                //     title: 'Mensaje!',
                                //     content: "La cantidad debe ser mayor a 0",
                                // });
                                alert('La cantidad debe ser  mayor a 0');
                                $("#txt_idPedido").val(task1);
                            } else if (task1 == 1) {
                                // $.alert({
                                //     title: 'Mensaje!',
                                //     content: "Se inserto la partida.",
                                // });
                                alert('Se inserto la partida');
                                $("#txt_idPedido").val(task1);
                            } else if (task1 == 2) {
                                // $.alert({
                                //     title: 'Mensaje!',
                                //     content: "No se pudo insertar la partida",
                                // });
                                alert('No se pudo insertar la partida');
                                $("#txt_idPedido").val(task1);
                            } else if (task1 == 3) {
                                // $.alert({
                                //     title: 'Mensaje!',
                                //     content: "Se actualizo satisfactoriamente",
                                // });
                                alert('Se actualizo satisfactoriamente');
                                $("#txt_idPedido").val(task1);
                            } else if (task1 == 4) {
                                // $.alert({
                                //     title: 'Mensaje!',
                                //     content: "No se pudo actualizar el dato.",
                                // });
                                alert('No se pudo actualizar el dato');
                                $("#txt_idPedido").val(task1);
                            } else if (task1 == 500) {
                                // $.alert({
                                //     title: 'Mensaje!',
                                //     content: "No se puedo completo el proceso intenta mas tarde.",
                                // });
                                alert('No se pudo completar el proceso,intenta mas tarde');
                                $("#txt_idPedido").val(0);
                            }
                            return getTotal()
                        }).then((task2) => {
                            if (task2 == 1)
                                return fetchItems()
                        }).then((task_3) => {
                            if (task_3 != 500) {
                                $('#spinnerContainer').hide()
                                $('#pPedido').show()
                                $('#pPedido').html("Pedido: " + $('#txt_idPedido').val())
                                return focus()
                            }
                        }).catch((error) => {
                            alert("Error " + error)
                            // $.alert({
                            //     title: 'Error!',
                            //     content: error,
                            // });
                        })
                    }
                } else {
                    // $.dialog('La cantidad debe ser mayor a 0');
                    alert('La cantidad debe ser mayor a 0');
                }

            } else {
                // $.alert({
                //     title: 'Mensaje!',
                //     content: "No se puede agregar un producto inexsitente " + clave,
                // });
                alert('No se puede agregar un producto inexistente ' + clave);
            }
        } else {
            //alert("El producto consta de 9 caracteres")
            // $.alert({
            //     lazyOpen: true,
            //     title: 'Mensaje!',
            //     content: "El producto consta de 9 caracteres",
            // });

            alert('El producto consta de 9 caracteres');

            $("#txt_cantidad").val();
            $("#txt_clave").val();
            $("#txt_clave").focus();
        }
    }

});

function Total() {
    let formatMoney = Intl.NumberFormat('en-US');
    var cantidad = $("#txt_cantidad").val();
    cantidad = cantidad.replace(',', '');
    var precio = $("#txt_precioiva").val();
    precio = precio.replace(',', '');
    var total = cantidad * precio;
    $("#txt_total").val(formatMoney.format(total));
}


function searchObservacion(id) {
    arrData = [];
    arrData.push('searchObservacion');
    arrData.push(id);

    return new Promise(function (resolve, reject) {
        $.ajax({
            // url: '../../functions/ventas/cotizacion/SearchObserver.php',
            url: "../../functions/ventas/mainCotizacion.php",
            type: 'GET',
            data: { arrData },
            success: function (response) {
                let observer = JSON.parse(response);
                observer.forEach(observer => {
                    $("#txt_comentario").val(observer.comentario);
                });
                resolve(1)
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                alert("Request: " + XMLHttpRequest);
                alert("Estatus: " + txtStatus);
                alert("Error: " + errorThrown);
                reject(500)
            }
        });
    })

}


function fetchItems() {
    return new Promise(function (resolve, reject) {
        var id = $("#txt_idPedido").val();
        $.ajax({
            // url: '../../functions/ventas/cotizacion/showOrder.php',
            url: "../../functions/ventas/mainCotizacion.php",
            type: 'GET',
            data: { id },
            success: function (response) {
                let item = JSON.parse(response);
                let template = '';
                item.forEach(item => {
                    let formatMoney = Intl.NumberFormat('en-US');
                    if (item.validation == 1) {
                        let precio = item.precio;

                        let monto = item.monto;
                        let estatus = item.estatus;

                        if (estatus == 'C/A') {
                            template +=
                                `<tr taskId="${item.id}">
                        <th><i class="bi bi-patch-check-fill text-primary"></i>${item.id}</th>
                        <td taskdata="${item.clave}">${item.clave} <strong><a class="text-primary" style="text-decoration:none;">(Acuerdo)</a></strong></td>
                        <td>${item.descripcion}</td>
                        <td>${formatMoney.format(precio)}</td>
                        <td>${item.cantidad}</td>
                        <td>${formatMoney.format(monto)}</td>
                        <td>
                          <a class="btn btn-primary btn-circle btn_edit" data-toggle="tooltip" data-placement="right" title="Editar ${item.clave}">
                          <i class="bi bi-pencil"></i>
                          </a>
                        </td>
                        <td>
                          <a class="btn btn-danger btn-circle btn_delete" data-toggle="tooltip" data-placement="right" title="Eliminar ${item.clave}">
                          <i class="bi bi-trash"></i>
                          </a> 
                        </td>
                      </tr>`
                        } else if (estatus == 'C/O') {
                            template +=
                                `<tr taskId="${item.id}">
                      <th><i class="bi bi-patch-check-fill text-success"></i>${item.id}</th>
                      <td taskdata="${item.clave}">${item.clave} <strong><a class="text-success" style="text-decoration:none;">(En Oferta)</a></strong></td>
                      <td>${item.descripcion}</td>
                      <td>${formatMoney.format(precio)}</td>
                      <td>${item.cantidad}</td>
                      <td>${formatMoney.format(monto)}</td>
                      <td>
                        <a class="btn btn-primary btn-circle btn_edit" data-toggle="tooltip" data-placement="right" title="Editar ${item.clave}">
                        <i class="bi bi-pencil"></i>
                        </a>
                      </td>
                      <td>
                        <a class="btn btn-danger btn-circle btn_delete" data-toggle="tooltip" data-placement="right" title="Eliminar ${item.clave}">
                        <i class="bi bi-trash"></i>
                        </a> 
                      </td>
                    </tr>`
                        } else {
                            template +=
                                `<tr taskId="${item.id}">
                        <th>${item.id}</th>
                        <td taskdata="${item.clave}">${item.clave}</td>
                        <td>${item.descripcion}</td>
                        <td>${formatMoney.format(precio)}</td>
                        <td>${item.cantidad}</td>
                        <td>${formatMoney.format(monto)}</td>
                        <td>
                          <a class="btn btn-primary btn-circle btn_edit" data-toggle="tooltip" data-placement="right" title="Editar ${item.clave}">
                          <i class="bi bi-pencil"></i>
                          </a>
                        </td>
                        <td>
                          <a class="btn btn-danger btn-circle btn_delete" data-toggle="tooltip" data-placement="right" title="Eliminar ${item.clave}">
                          <i class="bi bi-trash"></i>
                          </a> 
                        </td>
                      </tr>`
                        }
                    } else if (item.validation < 1) {
                        `<tr>
                <th>0</th>
                <td>Sib insercion</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>`
                    }
                    resolve(item.validation)
                });
                $('#item_add').html(template);
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                alert("Estatus: " + txtStatus);
                alert("Error: " + errorThrown);
                reject(500)
            }
        });
    })
}

function idOrder() {
    return new Promise(function (resolve, reject) {
        /*
        var c = $('#txt_idCliente').val();
        var v = $('#txt_idVendedor').val();
        var doc = $('#select_documento').val();
        var clv = $('#txt_clave').val();
        var desc = $('#txt_descripcion').val();
        var pre = $('#txt_precioiva').val();
        pre = pre.replace(',', '');
        var cant = $('#txt_cantidad').val();
        var mont = $('#txt_total').val();
        mont = mont.replace(',', '');
        var res = $('#txt_Restriccion').val();
        var fo = $('#txt_FamOferta').val();
        var lp = $('#txt_lp').val();
        var env = $('#select_envio').val();
        */
        var cliente = $('#txt_idCliente').val();
        var vendedor = $('#txt_idVendedor').val();
        var doc = $('#select_documento').val();
        var clv = $('#txt_clave').val();
        var desc = $('#txt_descripcion').val();
        var precioIva = $('#txt_precioiva').val();
        precioIva = precioIva.replace(',', '');
        var cant = $('#txt_cantidad').val();
        var monto = $('#txt_total').val();
        monto = monto.replace(',', '');
        var restriccion = $('#txt_Restriccion').val();
        var famOferta = $('#txt_FamOferta').val();
        var lp = $('#txt_lp').val();
        var envio = $('#select_envio').val();

        arrData = [];
        arrData.push('getIdOrder');
        arrData.push(cliente);
        arrData.push(vendedor);
        arrData.push(doc);
        arrData.push(clv);
        arrData.push(desc);
        arrData.push(precioIva);
        arrData.push(cant);
        arrData.push(monto);
        arrData.push(restriccion);
        arrData.push(famOferta);
        arrData.push(lp);
        arrData.push(envio);

        $.ajax({
            // url: '../../functions/ventas/cotizacion/getIdOrder.php',
            url: "../../functions/ventas/mainCotizacion.php",
            type: 'GET',
            data: { arrData },
            success: function (response) {
                let pedido = JSON.parse(response);
                console.log(response);

                pedido.forEach(pedido => {
                    console.log(pedido.query);
                    resolve(pedido.idOrder)

                });
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                alert("Estatus: " + txtStatus);
                alert("Error: " + errorThrown);
                reject(-500);
            }
        });
    })
}


function getTotal() {
    arrData = [];
    let id = $('#txt_idPedido').val();

    arrData.push('getTotal');
    arrData.push(id);

    return new Promise(function (resolve, reject) {

        $.ajax({
            // url: '../../functions/ventas/cotizacion/getTotal.php',
            url: "../../functions/ventas/mainCotizacion.php",
            type: 'GET',
            data: { arrData },
            success: function (response) {
                let result = JSON.parse(response);
                result.forEach(data => {
                    let formatMoney = Intl.NumberFormat('en-US');
                    let total = formatMoney.format((data.total) * 1.16);
                    let documento = $("#select_documento option:selected").text()
                    if (documento == "Remision") {
                        $("#total").val("$" + data.total);
                    } else {
                        $("#total").val("$" + total);
                    }

                    resolve(1)
                });
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                alert('Request..' + XMLHttpRequest);
                alert("Estatus: " + txtStatus);
                alert("Error: " + errorThrown);
                reject(0)
            }
        });
    })
}



$("#btn_search_cve").on("click", function () {
    let lista = $("#txt_lp").val();
    arrData = [];
    arrData.push('getKardex');
    arrData.push(lista);

    getKardex().then((result) => {

    }).catch((error) => {
        alert(error);
    })
})

function getKardex() {

    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "../../functions/ventas/mainCotizacion.php",
            type: 'GET',
            data: { arrData },
            success: function (response) {
                let data = JSON.parse(response);
                let template = '';
                let pagination = "";
                data.forEach(item => {
                    let validation = item.validation;

                    if (validation === 1) {
                        item.table.forEach(item => {
                            var precioo = parseFloat(item.precio);
                            var precioOfertaa = parseFloat(item.precioOferta);

                            if (precioo == 0) {
                                precioo = "-";
                            } else {
                                precioo = precioo.toFixed(2)
                            }

                            if (precioOfertaa == 0) {
                                precioOfertaa = "-";
                            } else {
                                precioOfertaa = precioOfertaa.toFixed(2)
                            }

                            template += `
                        <tr class="align-middle hipervinculo" style="cursor: pointer;" idClave="${item.clave}" id="td_tabledata">
                            <th class="text-center"><a class="text-primary-emphasis hipervinculo" >${item.clave}</a></th>
                            <td class="text-center"><div class="container-custom"><img src="${item.imagen}" alt="" width="35" height="35"></div></td>
                            <td style="max-width: 20rem;"><a class="d-inline-block text-truncate hipervinculo text-secondary-emphasis" style="max-width: 400px;">${item.descripcionn}</a></td>
                            <td class="text-center"><a class="text-success hipervinculo">${precioo}</a></td>
                            <td class="text-center"><a>${precioOfertaa}</p></td>
                            <td class="text-center "><a class="text-success hipervinculo">${item.claveSAT}</a></td>
                            <td class="text-center"><a class="text-success hipervinculo">${item.claveUnidad}</a></td>
                        </tr>`
                        })
                        item.pages.forEach((info_page) => {
                            pagination += `<li class="page-item ${info_page.active}"><a class="page-link" href="#" data-page="${info_page.page}" taskPag="TskProducts">${info_page.page}</a></li>`;

                        })
                    }
                });
                resolve(1)
                $('#tableProducts').html(template);
                $('#pagination_kardex_products').html(pagination);
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                alert("Request: " + XMLHttpRequest);
                alert("Estatus: " + txtStatus);
                alert("Error: " + errorThrown);
                reject(500)
            }
        });
    })

}


$(document).on('click', '.pagination a', function (event) {
    arrData = [];
    event.preventDefault();
    typePagination = this.getAttribute('taskPag');
    currentPage = $(this).data('page');
    arrData.push('getKardex');
    arrData.push(currentPage);


    if (typePagination == "TskProducts") {
        getKardex().then((result) => {

        }).catch((error) => {
            alert(error);
        })

    }
});


$("#td_tabledata").on("click", function () {
    alert("click");
})
