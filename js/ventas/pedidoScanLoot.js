$(document).ready(function () {
    console.log('Pedidos para ScanLoot');
    pedidosScanloot();
});

function pedidosScanloot() {
    arrData=[];
    arrData.push('pedidosScanLoot');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidoScanLoot.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                let icon;
                                let iconClass;
                                let tableClass;
                                let pdfClass;

                                if (item.estatus == 'ST') {
                                   icon = '<i class="fa-solid fa-check"></i>';
                                   iconClass = 'btn btn-success btn-sm rounded-circle';
                                   pdfClass ='btn btn-success btn-sm';
                                } else {
                                    icon = '<i class="fa-solid fa-stopwatch"></i>';
                                    iconClass = 'btn btn-warning btn-sm rounded-circle';
                                    pdfClass='btn btn-danger btn-sm';
                                }

                                if (item.validation == 1 && item.auth == 1 || item.auth == null) {
                                    // let tableClass ='table-default';
                                    tableClass ='';
                                } else if(item.validation == 1 && item.auth == 0){
                                    tableClass = 'table-info';
                                }

                                template += `<tr class="${tableClass}" taskId="${item.id}">
                                    <th class="align-middle text-center">${item.id}</th>
                                    <td class="align-middle">${item.cliente}</td>
                                    <td class="align-middle">${item.vendedor}</td>
                                    <td class="align-middle">${item.observacion}</td>
                                    <th class="align-middle text-center text-danger">${item.fecha}</th>
                                    <th class="align-middle text-center">
                                        <button type="button" class="${iconClass}" data-toggle="tooltip" data-placement="top">
                                            ${icon}
                                        </button>
                                    </th>
                                    <td colspan="2" class="align-middle text-center">
                                        <button type="button" id="btnPdfPedidoScanLoot" class="${pdfClass}" data-toggle="tooltip" data-placement="top" title="PDF">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </button>
                                        <button type="button" id="btnOrderPedidoScanLoot" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Mas opciones">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                    </td>
                                </tr>`;
                             } else {
                                template +=`<tr>
                                    <td class="align-middle text-center" colspan="8"><h5 class="text-primary">No hay más pedidos <i class="fa-solid fa-face-laugh-beam"></i></h5></td>
                                </tr>`;
                             }
                             $("#item_pedidos_scanloot").html(template);
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
                $("#spinnerTablePedidosScanLoot").hide();
            } else {
                $("#spinnerTablePedidosScanLoot").hide();
            }
    })

}

var serviceUrl = "http://localhost/iksasocket/";

$(document).on('click','#btnPdfPedidoScanLoot',function() {
    // alert('generando PDF');
    let element = $(this)[0].parentElement.parentElement;
    let idOder = $(element).attr("taskId");
    let user = localStorage.getItem('name');

    var url_report = serviceUrl + "functions/ventas/reporte/Enloots/genReporte.php?order=" + idOder + "&user=" + user;
    window.open(url_report, 'Orden de Cotizacion: #'+ idOder, "status=1,toolbar=1,menubar=1");
    // var url_report = serviceUrl + "functions/ventas/Enloots/genReporte.php?order=" + idOder + "&user=" + user;
    // window.open(url_report, 'Orden de Cotizacion: #' + idOder, "status=1,toolbar=1,menubar=1")

});


$(document).on('click','#btnOrderPedidoScanLoot',function() {
    let element = $(this)[0].parentElement.parentElement;
    let idOder = $(element).attr("taskId");
    // alert(idOder);

    $("#selectPiezas2").empty().append('<option selected value="0" disabled>Escoge un looter...</option>');
    $("#selectEmblemas2").empty().append('<option selected value="0" disabled>Escoge un looter...</option>');
    $("#selectPaquetes2").empty().append('<option selected value="0" disabled>Escoge un looter...</option>');

    $('#selectPiezas2').prop('disabled', true);
    $('#notify_1_piezas').prop('disabled', true);

    $('#selectEmblemas2').prop('disabled', true);
    $('#notify_2_emblemas').prop('disabled', true);

    $('#selectPaquetes2').prop('disabled', true);
    $('#notify_3_paquetes').prop('disabled', true);


    $("#txtIdPedidoModalAsigarScanLoot").val(idOder); 
    $("#modalAsignarSurtidor").modal('show');
});

var arrInforAlm;
var prioridad;

$('input[type=radio][name="btnradio2"]').change(function (e) {
    prioridad = $('input:radio[name=btnradio2]:checked').val();
    let id = $("#txtIdPedidoModalAsigarScanLoot").val();
    getInformationAlmacen(id).then((response) => {
        return getLooterPieza('ALMACEN 1');
    }).then((result)=>{
        if (result == 1) {
            return getLooterEmblemas('ALMACEN 2');
        } else {
            return 0;
        }
    }).then((result)=>{
        if (result == 1) {
            return getLooterPaquetes('ALMACEN 3');
        } else {
            return 1;
        }
    })
});

function getInformationAlmacen(idd) {
    arrData = [];
    arrData.push('getInformationAlmacen');
    arrData.push(idd);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidoScanLoot.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                        let pzs = item.pzs;
                        let badge = item.badge;
                        let package = item.paq;

                        if (item.validation == 1) {
                            if (pzs == 1) {
                                $('#selectPiezas2').removeAttr('disabled');
                                $('#notify_1_piezas').removeAttr('disabled');   
                            }

                            if (badge == 1) {
                                $('#selectEmblemas2').removeAttr('disabled');
                                $('#notify_2_emblemas').removeAttr('disabled');   
                            }

                            if (package == 1) {
                                $('#selectPaquetes2').removeAttr('disabled');
                                $('#notify_3_paquetes').removeAttr('disabled');
                            }

                        } else {
                            console('No se desactivara los selects');
                        }      

                            // arrInforAlm=[];
                            // arrInforAlm.push(pzs);
                            // arrInforAlm.push(badge);
                            // arrInforAlm.push(package);

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
        })
    }

function getLooterPieza(loot) {
    arrData=[];
    arrData.push('getLooter');
    arrData.push(loot);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidoScanLoot.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                $("#selectPiezas2").append('<option value="'+item.token+'">'+item.nombre+'</option>');
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
                            reject(errorThrown);
                    },
            }); 
        })
}


function getLooterEmblemas(loot) {
    arrData=[];
    arrData.push('getLooter');
    arrData.push(loot);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidoScanLoot.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                $("#selectEmblemas2").append('<option value="'+item.token+'">'+item.nombre+'</option>');
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
                            reject(errorThrown);
                    },
            }); 
        })
}


function getLooterPaquetes(loot) {
    arrData=[];
    arrData.push('getLooter');
    arrData.push(loot);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidoScanLoot.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                $("#selectPaquetes2").append('<option value="'+item.token+'">'+item.nombre+'</option>');
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
                            reject(errorThrown);
                    },
            }); 
        })
}



$('#notify_1_piezas').click(function () {
    let id_order =  $("#txtIdPedidoModalAsigarScanLoot").val(); 
    token = $("#selectPiezas2").val();
    user = $("#selectPiezas2 option:selected").text();
    sentNotify(token, id_order, user).then((result) => {

    }).catch((error) => {
        alert(error)
    })
});

$('#notify_2_emblemas').click(function () {
    let id_order =  $("#txtIdPedidoModalAsigarScanLoot").val(); 
    token = $("#selectEmblemas2").val();
    user = $("#selectEmblemas2 option:selected").text();
    sentNotify(token, id_order, user).then((result) => {

    }).catch((error) => {
        alert(error)
    })
});

$('#notify_3_paquetes').click(function () {
    let id_order =  $("#txtIdPedidoModalAsigarScanLoot").val(); 
    token = $("#selectPaquetes2").val();
    user = $("#selectPaquetes2 option:selected").text();
    sentNotify(token, id_order, user).then((result) => {

    }).catch((error) => {
        alert(error)
    })
});



$('#btnSaveModalAsignarSurtido').click(function () {
    let id = $("#txtIdPedidoModalAsigarScanLoot").val();
    let estatus = prioridad;

    arrData = [];
    arrData.push('asignarSurtido');
    arrData.push(id);
    arrData.push(estatus);
    asignacionSurtidoo(arrData);

});


function asignacionSurtidoo(arrData) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidoScanLoot.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                 alert('Se asigno el pedido correctamente');
                             } else {
                                 alert('Ocurrio un problema al asignar el pedido');
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
                prioridad = 1;
                resetFormularioModalAsignarSurtido();
                return pedidosScanloot();
            } else {
                console.log('No se resetear el formulario ya que ocurrio un problema');
            }
    });
}

function resetFormularioModalAsignarSurtido() {

    $('#selectPiezas2').empty().append('<option selected value="0" disabled>Escoge un looter...</option>');
    $('#selectPiezas2').prop('selectedIndex', 0);

    $('#selectEmblemas2').empty().append('<option selected value="0" disabled>Escoge un looter...</option>');
    $('#selectEmblemas2').prop('selectedIndex', 0);

    $('#selectPaquetes2').empty().append('<option selected value="0" disabled>Escoge un looter...</option>');
    $('#selectPaquetes2').prop('selectedIndex', 0);

    $('#selectPiezas2').prop('disabled', true);
    $('#selectEmblemas2').prop('disabled', true);
    $('#selectPaquetes2').prop('disabled', true);

    $('#notify_1_piezas').prop('disabled', true);
    $('#notify_2_emblemas').prop('disabled', true);
    $('#notify_3_paquetes').prop('disabled', true);
}