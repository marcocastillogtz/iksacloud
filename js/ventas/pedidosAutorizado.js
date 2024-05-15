$(document).ready(function () {
    console.log('Pedidos Autorizados');

    ShowOrderPreview().then((result) => {
        /**
         * TODO: valida la ejecucion de la funcion
         */
        if (result != 404) {
            //msg.close()
        }
    }).catch((error) => {
        // msg.close()
        // $.alert({
        //     title: 'Error',
        //     content: "No se pudo completar el proceso, Intente de nuevo. Si el error persiste Intente mas tarde"
        // })
        console.log('Error: '+error);
        alert('No se pudo completar el proceso, Intente de nuevo. Si el error persiste intente mas tarde');
    })
});

var arrData = [];

function ShowOrderPreview() {
    arrData=[];
    arrData.push('showOrderPreview');

    return new Promise(function (resolve, reject) {
        $.ajax({
            // url: "../../functions/ventas/pedidosAutorizados/pedidosAutorizados.php",
            url: "../../functions/ventas/mainPedidosAutorizados.php",
            type: "GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = "";
                item.forEach((item) => {
                    if (item.validation == 1) {
                        let formatMoney = Intl.NumberFormat('en-US');
                        let vendedor = item.vendedor;
                        let cliente = item.cliente;
                        let fecha = item.fecha;
                        let folio = item.folio;
                        let observacion = item.observacion;
                        let monto = item.monto;
                        let estatus = item.estatus;


                        if (monto == null) {
                            monto = formatMoney.format(monto)
                        } else {
                            monto = formatMoney.format(monto)
                        }

                        if (monto != 0) {
                            console.log(observacion);
                            if (observacion.includes('BK:B')) {

                                template +=
                                    `<tr class="table-info" taskId="${item.id}">
                                <td class="align-middle text-center fw-bold">${item.id}</td>
                                <td class="align-middle text-center" data-toggle="tooltip" data-placement="top" title="${item.cliente}">${cliente}</td>
                                <td class="align-middle text-center" data-toggle="tooltip" data-placement="top" title="${item.vendedor}">${vendedor}</td>
                                <td class="align-middle text-center" data-toggle="tooltip" data-placement="top" title="${item.fecha}">${fecha}</td>
                                <td class="align-middle text-center">${item.hora}</td>
                                <td class="align-middle text-center">${monto}</td>
                                <td class="align-middle text-center">
                                    <a id="btnGenerarFolio" class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="enviar" disabled data-placement="top" title="Generar Folio" data-bs-toggle="modal" data-bs-target="#myModal">
                                    <i class="fa-solid fa-barcode"></i>
                                    </a>

                                    <a id="btnEnviarPedido" class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="enviar" disabled data-placement="top" title="Generar Folio" data-bs-toggle="modal" data-bs-target="#myModal">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    </a>

                                    <a id="btnGenerarReports" class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Generar PDF" target="_blank" disabled>
                                    <i class="fa-solid fa-file-pdf"></i>
                                    </a>

                                    <a id="btnEliminarPedido" class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="right" title="Asignar piezas y cajas" target="_blank" disabled>
                                    <i class="fa-solid fa-trash"></i>
                                    </a>

                                    
                                    <!--<a id="btnTransform" class="btn btn-secondary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="">
                                    <i class="fa-solid fa-gear"></i>
                                    </a>-->

                            </tr>
                            `;

                            } else if (folio == null || folio == "") {
                                template +=
                                    `<tr taskId="${item.id}">
                                <td class="align-middle text-center fw-bold">${item.id}</td>
                                <td class="align-middle text-center" data-toggle="tooltip" data-placement="top" title="${item.cliente}">${cliente}</td>
                                <td class="align-middle" data-toggle="tooltip" data-placement="top" title="${item.vendedor}">${vendedor}</td>
                                <td class="align-middle" data-toggle="tooltip" data-placement="top" title="${item.fecha}">${fecha}</td>
                                <td class="align-middle">${item.hora}</td>
                                <td class="align-middle">${monto}</td>
                                <td class="align-middle text-center">
                                    <a id="btnGenerarFolio" class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="enviar" disabled data-placement="top" title="Generar Folio" data-bs-toggle="modal" data-bs-target="#myModal">
                                    <i class="fa-solid fa-barcode"></i>
                                    </a>

                                    <a id="btnEnviarPedido" class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="enviar" disabled data-placement="top" title="Generar Folio" data-bs-toggle="modal" data-bs-target="#myModal">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    </a>

                                    <a id="btnGenerarReports" class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Generar PDF" target="_blank" disabled>
                                    <i class="fa-solid fa-file-pdf"></i>
                                    </a>

                                    <a id="btnEliminarPedido" class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="right" title="Asignar piezas y cajas" target="_blank" disabled>
                                    <i class="fa-solid fa-trash"></i>
                                    </a>

                                    
                                    <!--<a id="btnTransform" class="btn btn-secondary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="">
                                    <i class="fa-solid fa-gear"></i>
                                    </a>-->
                            </tr>
                            `;

                            } else {
                                template +=
                                    `<tr taskId="${item.id}">
                                    <td class="align-middle text-center fw-bold">${item.id}</td>
                                    <td class="align-middle" data-toggle="tooltip" data-placement="top" title="${item.cliente}">${cliente}</td>
                                    <td class="align-middle" data-toggle="tooltip" data-placement="top" title="${item.vendedor}">${vendedor}</td>
                                    <td class="align-middle" data-toggle="tooltip" data-placement="top" title="${item.fecha}">${fecha}</td>
                                    <td class="align-middle">${item.hora}</td>
                                    <td class="align-middle">${monto}</td>
                                    <td class="align-middle text-center">
                                        <a id="btnGenerarFolio" class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="enviar" disabled data-placement="top" title="Generar Folio" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <i class="fa-solid fa-barcode"></i>
                                        </a>

                                        <a id="btnEnviarPedido" class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="enviar" disabled data-placement="top" title="Generar Folio" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <i class="fa-solid fa-paper-plane"></i>
                                        </a>
                                        
                                        <a id="btnGenerarReports" class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Generar PDF" target="_blank" disabled>
                                        <i class="fa-solid fa-file-pdf"></i>
                                        </a>

                                        <a id="btnEliminarPedido" class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="right" title="Asignar piezas y cajas" target="_blank" disabled>
                                        <i class="fa-solid fa-trash"></i>
                                        </a>

                                        
                                        <!--<a id="btnTransform" class="btn btn-secondary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="">
                                        <i class="bi bi-gear"></i>
                                        </a>-->

                                    </td>
                                </tr>
                                `;
                            }
                        } else {
                            template +=
                                `<tr class="table-danger" taskId="${item.id}">
                                <td class="align-middle text-center fw-bold">${item.id}</td>
                                <td class="align-middle" data-toggle="tooltip" data-placement="top" title="${item.cliente}">${cliente}</td>
                                <td class="align-middle" data-toggle="tooltip" data-placement="top" title="${item.vendedor}">${vendedor}</td>
                                <td class="align-middle" data-toggle="tooltip" data-placement="top" title="${item.fecha}">${fecha}</td>
                                <td class="align-middle">${item.hora}</td>
                                <td class="align-middle">${monto}</td>
                                <td class="align-middle text-center">
                                    <a id="btnEliminarPedido" class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="right" title="Asignar piezas y cajas" target="_blank" disabled>
                                    <i class="fa-solid fa-trash"></i>
                                    </a>


                                    <a id="btnTransform" class="btn btn-secondary btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="" hidden>
                                    <i class="fa-solid fa-gear"></i>
                                    </a>
                                </td>
                            </tr>
                            `;
                        }

                    } else if (item.validation == 0) {
                        template +=
                            `<tr>
                                <td class="align-middle text-center" colspan="7"><h5 class="text-primary">No hay más pedidos <i class="fa-solid fa-face-laugh-beam"></i></h5></td>
                            </tr>`;
                    }
                });
                resolve(1);
                $("#item_pedidos").html(template);
                $("#spinnerTablePedidosAutorizados").hide();
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                alert("Request: " +XMLHttpRequest);
                alert("Estatus: " + txtStatus);
                alert("Error: " + errorThrown);
                reject(404);
            },
        });
    })
}


$(document).on("click", "#btnGenerarFolio", function () {
    let elelment = $(this)[0].parentElement.parentElement;
    let id = $(elelment).attr("taskId");
    $("#title_res").remove();
    const ToastAuth = $('#toastAuth')
    const toastAuth = new bootstrap.Toast(ToastAuth)
    SaveFolio(id).then((result) => {
        if (result == 1) {
            return PakageandPiece(id)
        }
    }).then((result_2) => {
        if (result_2 == 1) {
            return setIndicator(id)
        }
    }).then((indicator) => {
        if (indicator == 1) {
            return ShowOrderPreview()
        }
    }).then((finish) => {
        if (finish == 1) {
            $(".toast-result").append("<p id='title_res'>El pedido " + id + " ha completado el proceso satisfactorimente</p>")
            toastAuth.show()
        } else {
            $(".toast-result").append("<p id='title_res'>No se pudo actualizar los datos de la tabla, actualice la pagina (F5)</p>")
            toastAuth.show()
        }

    }).catch((error) => {
        // $.alert({
        //     title: "Error",
        //     content: "No se pudo completar el proceso intentelo de nuevo. Si el error persiste intentelo mas tarde."
        // })
        alert('No se pudo completar el proceso intentelo de nuevo. Si el error persiste intentelo mas tarde.');
        console.log('Error' + error);
    });
});

function PakageandPiece(id) {
    arrData=[];
    arrData.push('saveFolio');
    arrData.push(id);
    
    return new Promise(function (resolve, reject) {
        $.ajax({
            // url: '../../functions/ventas/pedidosAutorizados/piecesNpackage.php',
            url: "../../functions/ventas/mainPedidosAutorizados.php",
            type: 'POST',
            data: { arrData },
            success: function (response) {
                let update = JSON.parse(response)
                update.forEach((item) => {
                    let validacion = item.validation;
                    resolve(validacion);
                })

            }, error: function (XMLHttpRequest, txtStatus, errorThrown) {
                console.log("Request: "+ XMLHttpRequest);
                console.log("Estatuus: "+txtStatus);
                console.log("Error: "+errorThrown);

                reject(404)
            }
        });
   })
}


function SaveFolio(id) {
    arrData=[];
    arrData.push('saveFolio');
    arrData.push(id);
    return new Promise(function (resolve, reject) {
        //var id_input = id;

        $.ajax({
            // url: '../../functions/ventas/pedidosAutorizados/updateFolio.php',
            url: "../../functions/ventas/mainPedidosAutorizados.php",
            type: 'POST',
            data: { arrData },
            success: function (response) {
                let save = JSON.parse(response)
                save.forEach((item) => {
                    let validacion = item.validation;
                    resolve(validacion)
                })

            },
            error: function (XMLHttpRequest, textStatus, errorThrow) {
                console.log("Request: " + XMLHttpRequest);
                console.log("Status: " + textStatus);
                console.log("Error: " + errorThrow);
                reject(404);
            }
        });
    })
}



function setIndicator(id_Order) {
    arrData=[];
    arrData.push('setIndicator');
    arrData.push(id_Order);

    return new Promise(function (resolve, reject) {
        $.ajax({
            // url: "../../functions/ventas/pedidosAutorizados/setIndicator.php",
            url:"../../functions/ventas/mainPedidosAutorizados.php",
            type: "GET",
            data: { arrData },
            success: function (response) {
                let result = JSON.parse(response)

                result.forEach((item) => {
                    let validacion = item.validation;
                    resolve(validacion)
                })
            },
            error: function (XMLHttpRequest, textStatus, errorThrow) {
                console.log("Request: "+XMLHttpRequest);
                console.log("Status: " + textStatus);
                console.log("Error: " + errorThrow);
                reject(404)
            },
        });
    })
}



// $(document).on("click", "#btnGenerarFolio", function () {
//     alert('btnGenerarFolio');
// });
var id_order;

$(document).on("click", "#btnEnviarPedido", function () {
    // alert('enviar Pedido');
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");
    // alert('id1..'+id);
    id_order = $(element).attr("taskId");

    getLooterSelected(id);
});



function SelectFilter(id) {
    arrData=[];
    arrData.push('selectFilter');
    arrData.push(id);
    
    return new Promise((resolve, reject) => {
        $.ajax({
            // url: "../../functions/ventas/pedidosAutorizados/getLooter.php",
            url:"../../functions/ventas/mainPedidosAutorizados.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                // let template = "";
                     item.forEach((item) => {
                            let pzs = item.pzs;
                            let badge = item.badge;
                            let package = item.paq;

                            if (pzs == 1) {
                                $('#selectPiezas').removeAttr('disabled');
                                $('#notify_1').removeAttr('disabled');   
                            }

                            if (badge == 1) {
                                $('#selectEmblemas').removeAttr('disabled');
                                $('#notify_2').removeAttr('disabled');   
                            }

                            if (package == 1) {
                                $('#selectPaquetes').removeAttr('disabled');
                                $('#notify_2').removeAttr('disabled');
                            }
                            resolve(item.validation);

                        }); 
                    },
                    error: function (XMLHttpRequest, txtStatus, errorThrown) {
                            alert("Request: "+XMLHttpRequest);
                            alert("Estatus: "+txtStatus);
                            alert("Error: "+errorThrown);
                            reject(404);
                    },
            }); 

    })

}

function getLooter1(loot) {
    arrData=[];
    arrData.push('getLooter1');
    arrData.push(loot); //almacen 1

    return new Promise((resolve, reject) => {
        $.ajax({
            // url: "../../functions/ventas/pedidosAutorizados/getLootinfo.php",
            url:"../../functions/ventas/mainPedidosAutorizados.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = "";
                     item.forEach((item) => {
                        let name = item.name;
                        // let roll = item.roll;
                        let token = item.token;
                             if (item.validation == 1) {
                                //  alert('Se realizo la operacion correctamente');
                                $("#selectPiezas").append('<option value="' + token + '">' + name + '</option>');
                             }else{
                                console.log('Ocurrio un problema al obtener las piezas');
                             }

                             resolve(item.validation);
                        }); 
                    },
                    error: function (XMLHttpRequest, txtStatus, errorThrown) {
                            alert("Request: "+XMLHttpRequest);
                            alert("Estatus: "+txtStatus);
                            alert("Error: "+errorThrown);
                            reject(404);
                    },
            }); 
        })
}

function getLooter2(loot) {
    arrData=[];
    arrData.push('getLooter2');
    arrData.push(loot);

    return new Promise((resolve, reject) => {
        $.ajax({
            // url: "../../functions/ventas/pedidosAutorizados/getLootinfo.php",
            url:"../../functions/ventas/mainPedidosAutorizados.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                        let name =item.name;
                        // let roll = item.roll;
                        let token = item.token;

                            if (item.validation == 1) {
                                $("#selectEmblemas").append('<option value ="'+token+'">'+name+'</option>');       
                            } else {
                                console.log('Ocurrio un problema al obtener los emblemas');
                            }
                             resolve(item.validation);
                        }); 
                    },
                    error: function (XMLHttpRequest, txtStatus, errorThrown) {
                            alert("Request: "+XMLHttpRequest);
                            alert("Estatus: "+txtStatus);
                            alert("Error: "+errorThrown);
                            reject(404);
                    },
            }); 
    })

}

function getLooter3(loot) {
    arrData=[];
    arrData.push('getLooter3');
    arrData.push(loot);

    return new Promise((resolve, reject) => {
        $.ajax({
            // url: "../../functions/ventas/pedidosAutorizados/getLootinfo.php",
            url:"../../functions/ventas/mainPedidosAutorizados.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                            let name = item.name;
                            // let roll = item.roll;
                            let token = item.token;

                            if (item.validation == 1) {
                                $("#selectPaquetes").append('<option value="'+token+'">'+name+'</option>');
                            } else {
                                alert('Ocurrio un problema al obtener los paquetes');
                            }
                            resolve(item.validation);
                        }); 
                    },
                    error: function (XMLHttpRequest, txtStatus, errorThrown) {
                            alert("Request: "+XMLHttpRequest);
                            alert("Estatus: "+txtStatus);
                            alert("Error: "+errorThrown);
                            reject(404);
                    },
            }); 
    })

}


$('#notify_1').click(function () {
    token = $("#selectPiezas").val();
    user = $("#selectPiezas option:selected").text();
    sentNotify(token, id_order, user).then((result) => {

    }).catch((error) => {
        alert(error)
    })
});

$('#notify_2').click(function () {
    token = $("#selectEmblemas").val();
    user = $("#selectEmblemas option:selected").text();
    sentNotify(token, id_order, user).then((result) => {

    }).catch((error) => {
        alert(error)
    })
});

$('#notify_3').click(function () {
    token = $("#selectPaquetes").val();
    user = $("#selectPaquetes option:selected").text();
    sentNotify(token, id_order, user).then((result) => {

    }).catch((error) => {
        alert(error)
    })
});


function sentNotify(token, id_order, user) {
    arrData=[];
    arrData.push('sentNotify');
    arrData.push(token);
    arrData.push(id_order);
    arrData.push(user);

    return new Promise(function (resolve, reject) {
        $.ajax({
            // url: "../../functions/ventas/pedidosAutorizados/enviarNotificacion.php",
            url:"../../functions/ventas/mainPedidosAutorizados.php",
            type: "GET",
            data: { arrData },
            success: function (response) {
                let result = JSON.parse(response)

                if (result.response == 1) {
                    alert("Looter notificado y asignado");
                } else if (result.response == 2) {
                    alert("Nuevo Looter modificado y asignado");
                } else if (result.response == 3) {
                    alert("El pedido ya ha sido tomado, y ya no se podra aplicar los cambios");
                } else {
                    alert("La operacion fallo");
                }
                resolve(1);
            },
            error: function (XMLHttpRequest, textStatus, errorThrow) {
                console.log("Request: " + XMLHttpRequest);
                console.log("Status: " + textStatus);
                console.log("Error: " + errorThrow);
                reject(404);
            },
        });
    })
}

// var prioridad = 1;

// $('input[type=radio]').change(function (e) {
//     prioridad = $('input:radio[name=btnradio]:checked').val();
//     let idd = id_order;
//     getLooterSelected(idd);
// });

$('input[type=radio][name="btnradio"]').change(function (e) {
    prioridad = $('input:radio[name=btnradio]:checked').val();
    let idd = id_order;
    getLooterSelected(idd);
});

function getLooterSelected(id) {
    $("#selectPiezas").empty().append('<option selected value="0" disabled>Escoge un looter...</option>');
    $('#selectPiezas').prop('selectedIndex', 0);

    $('#selectEmblemas').empty().append('<option selected value="0" disabled>Escoge un looter...</option>');
    $('#selectEmblemas').prop('selectedIndex', 0);

    $('#selectPaquetes').empty().append('<option selected value="0" disabled>Escoge un looter...</option>');
    $('#selectPaquetes').prop('selectedIndex', 0);


    $('#selectPiezas').prop('disabled', true);
    $('#notify_1').prop('disabled', true);
    $('#selectEmblemas').prop('disabled', true);
    $('#notify_2').prop('disabled', true);
    $('#selectPaquetes').prop('disabled', true);
    $('#notify_3').prop('disabled', true);
/*
    AQUI SE PUEDE MANDAR A LLAMAR SOLO UNA VEZ EL METODO Y DEPENDIENDO EL PARAMETRO ENVIADO SE REGRESARA EL RESULTADO CORRESPONDIENTE
*/
    SelectFilter(id).then((result) => {
        //alert('ejecutando  select filter..');

        return getLooter1('ALMACEN 1');
    }).then((result) => {
        //alert('ejecutando getLooter 2');

        return getLooter2('ALMACEN 2')
    }).then((data) => {
        //alert('eejecutando getLooter 3');
        return getLooter3('ALMACEN 3');

    }).catch((error) => {
        alert(error);
    })

}

$(document).on("click", "#btnSave", function () {
    let id = id_order;
    let estatus = prioridad;

    enviarPedido(id,estatus).then((result) => {
        if (result == 1) {
            prioridad = 1;
            resetFormulario();
            return ShowOrderPreview();
        }
    }).catch((error) => {
        alert(error)
    })
    

});

function enviarPedido(id, estatus) {
    arrData=[];
    arrData.push('enviarPedido');
    arrData.push(id);
    arrData.push(estatus);

    return new Promise(function (resolve, reject) {
        //var id_input = id;
    
        $.ajax({
            // url: "../../functions/ventas/pedidosAutorizados/enviarPedido.php",
            url:"../../functions/ventas/mainPedidosAutorizados.php",
            type: "GET",
            data: { arrData },
            success: function (response) {
                //alert("Se envio el pedido")
                let pedido = JSON.parse(response);
                pedido.forEach((pedido) => {
                    // let validacion = data.validation;
                    // resolve(validacion);
                    if (pedido.validation == 1) {
                        alert('se actualizo el pedido');
                        console.log('Se actualizo el pedido');
                    } else {    
                        console.log('Ocurrio un problema al actualizar el pedido');
                    }
                    resolve(pedido.validation);
                })
            },
            error: function (XMLHttpRequest, textStatus, errorThrow) {
                console.log("Request: "+XMLHttpRequest);
                console.log("Status: " + textStatus);
                console.log("Error: " + errorThrow);
                reject(404);
            },
        });
    })

}


function resetFormulario() {

    $('#selectPiezas').empty().append('<option selected value="0" disabled>Escoge un looter...</option>');
    $('#selectPiezas').prop('selectedIndex', 0);

    $('#selectEmblemas').empty().append('<option selected value="0" disabled>Escoge un looter...</option>');
    $('#selectEmblemas').prop('selectedIndex', 0);

    $('#selectPaquetes').empty().append('<option selected value="0" disabled>Escoge un looter...</option>');
    $('#selectPaquetes').prop('selectedIndex', 0);

    $('#selectPiezas').prop('disabled', true);
    $('#selectEmblemas').prop('disabled', true);
    $('#selectPaquetes').prop('disabled', true);

    $('#notify_1').prop('disabled', true);
    $('#notify_2').prop('disabled', true);
    $('#notify_3').prop('disabled', true);
    $('#radio_low').prop('checked', true);

}


$(document).on("click", "#btnGenerarReports", function () {
    // alert('generar Reportes');
    let elelment = $(this)[0].parentElement.parentElement;
    let id = $(elelment).attr("taskId");
    PDF(id);
});

function PDF(id) {
    // var server = "http://192.168.0.38/";
    var server = "http://localhost/";

    var user = localStorage.getItem("name");

    // var url_script_almacen = server + "KachaWeb/functions/ventas/PedidosAutorizados/paqueteria.reporte.inc.php?id=" + id + "&user=" + user;
    var url_script_almacen = server + "iksasocket/functions/ventas/reporte/paqueteria.reporte.inc.php?id=" + id + "&user=" + user;
    window.open(url_script_almacen, 'Almacen: #' + id, "status=1,toolbar=1,menubar=1");


    // var url_script_paqueteria = server + "KachaWeb/functions/ventas/PedidosAutorizados/gen.report.inc.php?id=" + id + "&user=" + user;
    var url_script_paqueteria = server + "iksasocket/functions/ventas/reporte/gen.report.inc.php?id=" + id + "&user=" + user;
    window.open(url_script_paqueteria, 'Paqueteria: #' + id, "status=1,toolbar=1,menubar=1");


    // var url_script_emblema = server + "KachaWeb/functions/ventas/PedidosAutorizados/Emblema.report.inc.php?id=" + id + "&user=" + user;
    var url_script_emblema = server + "iksasocket/functions/ventas/reporte/Emblema.report.inc.php?id=" + id + "&user=" + user;
    window.open(url_script_emblema, 'Emblemas: #' + id, "status=1,toolbar=1,menubar=1");
}


$(document).on("click", "#btnEliminarPedido", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");
    $("#idDepositoEliminar").val(id);
    $("#modalEliminarPedidos").modal('show');
});

$(document).on('click',"#btnEliminarDepositos",function() {
    let id = $("#idDepositoEliminar").val();
    deleteDepositosAutorizados(id);
});

function deleteDepositosAutorizados(id) {
    arrData=[];
    arrData.push('deleteDepositosAut');
    arrData.push(id);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidosAutorizados.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                // let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                 alert('Se elimino el pedido correctamente');
                             } else {
                                 alert('Ocurrio un problema al eliminar el pedido')
                             }
                             resolve(item.validation);
                        }); 
                    },
                    error: function (XMLHttpRequest, txtStatus, errorThrown) {
                            alert("Request: "+XMLHttpRequest);
                            alert("Estatus: "+txtStatus);
                            alert("Error: "+errorThrown);
                            reject(errorThrown);
                    },
            }); 
        }).then((response)=>{
            if (response == 1) {
                $("#modalEliminarPedidos").modal('hide');
                console.log('se cerro el modal');
                return 1;
            } else {
                console.log('No se cerrar el modal');
                return 0;
            }
    }).then((response)=>{
        if (response == 1) {
            console.log('se actualizo la tabla');
            ShowOrderPreview();
        } else {
            console.log('Ocurrio un problema');
        }
    })


}


$(document).on("click", "#btnTransform", function () {
    alert('transform');
});
