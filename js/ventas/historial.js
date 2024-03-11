$(document).ready(function () {
    console.log('Historial');
    fillSelectSellers();
    fillSelectClient();
    historial();
});

function historial() {
    arrData=[];
    arrData.push('historialPedidos');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidosHistorial.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                let estatus = item.estatus;
                                let tableClass ='';

                                if (estatus == "AT") {
                                  estatus = "Autorizado"
                                  tableClass = 'table-success';
                                } else if (estatus == "PS") {
                                  estatus = "Por Surtir"
                                  tableClass = 'table-warning';
                                } else if (estatus == "ST") {
                                  estatus = "Surtido";
                                  tableClass = 'bg-surtiendo';
                                } else if (estatus == "TE") {
                                  estatus = "Terminado de Empacar";
                                  tableClass = 'table-dark';
                                } else if (estatus == "FT") {
                                  estatus = "Facturado";
                                  tableClass = 'table-info';
                                } else if (estatus == "EN") {
                                  estatus = "Enviado";
                                  tableClass = 'table-light';
                                }

                                template += `<tr class="${tableClass}" taskId="${item.id}">
                                        <th colspan="1"><p><small>${item.id}</small></p></th>
                                        <td colspan="1"><p><small>${item.cliente}</small></p></td>
                                        <td colspan="1"><p><small>${item.vendedor}</small></p></td>
                                        <td colspan="1"><p><small>${estatus}</small></p></td>
                                        <td colspan="1"><p><small>${item.hora}</small></p></td>
                                        <td colspan="1"><p><small>${item.fecha}</small></p></td>
                                        <td colspan="3"><p><small>${item.observacion}</small></p></td>
                                        <td colspan="4">
                                            <a id="btnGenerarFolioHistorial" class="btn btn-primary btn-circle btn_edit btn_sm" data-toggle="tooltip" data-placement="top" title="Generar Folio" >
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                            
                                            <a id="btnReport" class="btn btn-success btn-circle btn_report btn_sm" data-toggle="tooltip" data-placement="top" title="Generar Reporte" >
                                                <i class="fa-regular fa-clock"></i>
                                            </a>
                            
                                            <a id="btnEliminarPedidoHistorial" class="btn btn-danger btn-circle btn_sm" data-toggle="tooltip" data-placement="right" title="Asignar piezas y cajas" target="_blank" disabled>
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                            
                                            <a id="btnScanLoot" class="btn btn-dark btn-circle btn_sm" data-toggle="tooltip" data-placement="right" title="ScanLoot! Report" target="_blank">
                                                <strong>SL!</strong>
                                            </a>
                                        </td>
                                </tr>`;
                                
                             } else {
                                template += `<tr><td colspan="8" class="lign-middle " colspan="7"><h5 class="text-primary">No hay resultados <i class="bi bi-emoji-dizzy primary-"></i></h5></td></tr>`;
                                console.log('Operacion Invalida');
                             }
                             $("#item_pedidos_historial").html(template);
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
                $("#spinnerTablePedidosHistorial").hide();
                return 1;
            } else {
                $("#spinnerTablePedidosHistorial").hide();
                return 0;
            }
    })  
}

$("#btnBuscarPedido").click(function (e) {
    /*
    let vendedor = $("#selectSeller").val();
    let cliente = $("#selectClient").val();
    let estatus = $("#selectEstatus").val();
    let fecha = $("#dateHistorial").val();

    if (vendedor == 'Vendedor') {
        alert('Debes de seleccionar un vendededor');
    }else if(cliente == 'Cliente'){
        alert('Debes de seleccionar cliente');
    }else if(estatus =='All'){
        alert('Debes de seleccionar estatus');
    }else if(fecha == ''|| fecha == 'dd/mm/aaa'){
        alert('Debes de seleccionar un fecha valida');
    }else {
        buscarPedido(vendedor,cliente,estatus,fecha);
    }*/
    let vendedor = $("#selectSeller").val();
    let cliente = $("#selectClient").val();
    let estatus = $("#selectEstatus").val();
    let fecha = $("#dateHistorial").val();
    
    buscarPedido(vendedor,cliente,estatus,fecha);

});

function buscarPedido(vendedor,cliente,estatus,fecha){
    arrData =[];
    arrData.push('buscarPedido');
    arrData.push(vendedor);
    arrData.push(cliente);
    arrData.push(estatus);
    arrData.push(fecha);


    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidosHistorial.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                let estatus = item.estatus;
                                let tableClass ='';

                                if (estatus == "AT") {
                                  estatus = "Autorizado"
                                  tableClass = 'table-success';
                                } else if (estatus == "PS") {
                                  estatus = "Por Surtir"
                                  tableClass = 'table-warning';
                                } else if (estatus == "ST") {
                                  estatus = "Surtido";
                                  tableClass = 'bg-surtiendo';
                                } else if (estatus == "TE") {
                                  estatus = "Terminado de Empacar";
                                  tableClass = 'table-dark';
                                } else if (estatus == "FT") {
                                  estatus = "Facturado";
                                  tableClass = 'table-info';
                                } else if (estatus == "EN") {
                                  estatus = "Enviado";
                                  tableClass = 'table-light';
                                }

                                template += `<tr class="${tableClass}" taskId="${item.id}">
                                        <th colspan="1"><p><small>${item.id}</small></p></th>
                                        <td colspan="1"><p><small>${item.cliente}</small></p></td>
                                        <td colspan="1"><p><small>${item.vendedor}</small></p></td>
                                        <td colspan="1"><p><small>${estatus}</small></p></td>
                                        <td colspan="1"><p><small>${item.hora}</small></p></td>
                                        <td colspan="1"><p><small>${item.fecha}</small></p></td>
                                        <td colspan="3"><p><small>${item.observacion}</small></p></td>
                                        <td colspan="4">
                                            <a id="btnGenerarFolioHistorial" class="btn btn-primary btn-circle btn_edit btn_sm" data-toggle="tooltip" data-placement="top" title="Generar PDF" >
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                            
                                            <a id="btnReport" class="btn btn-success btn-circle btn_report btn_sm" data-toggle="tooltip" data-placement="top" title="Generar Reporte" >
                                                <i class="fa-regular fa-clock"></i>
                                            </a>
                            
                                            <a id="btnEliminarPedidoHistorial" class="btn btn-danger btn-circle btn_sm" data-toggle="tooltip" data-placement="right" title="Asignar piezas y cajas" target="_blank" disabled>
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                            
                                            <a id="btnScanLoot" class="btn btn-dark btn-circle btn_sm" data-toggle="tooltip" data-placement="right" title="ScanLoot! Report" target="_blank">
                                                <strong>SL!</strong>
                                            </a>
                                        </td>
                                </tr>`;
                             } else {
                                template += `<tr><td colspan="8" class="lign-middle " colspan="7"><h5 class="text-primary">No hay resultados <i class="bi bi-emoji-dizzy primary-"></i></h5></td></tr>`;
                                console.log('Operacion Invalida');
                             }
                             $("#item_pedidos_historial").html(template);
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

function fillSelectSellers() {
    arrData=[];
    arrData.push('fillSelectSellers');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidosHistorial.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                $("#selectSeller").append('<option value="' + item.id + '">' + item.usuario + '</option>');
                             } else {
                                 alert('Operacion Invalida');
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
            } else {
            }
    })
}

function fillSelectClient() {
    arrData=[];
    arrData.push('fillSelectClient');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidosHistorial.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                $("#selectClient").append('<option value="' + item.id + '">' + item.cliente + '</option>');
                             } else {
                                 alert('Operacion Invalida')
                             }
                             resolve(item.validation)
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
            } else {
            }
    })
}


$(document).on('click', '#btnGenerarFolioHistorial', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");
    

    PDF(id);
});

var server = "http://localhost/";
var user = localStorage.getItem("name");

function PDF(id) {
    var url_script_almacen = server +"iksasocket/functions/ventas/reporte/paqueteria.reporte.inc.php?id="+id+"&user="+user;
    window.open(url_script_almacen,'Almacen: #'+id,"status=1,toolbar=1,menubar=1");

    var url_script_paqueteria = server + "iksasocket/functions/ventas/reporte/gen.report.inc.php?id=" + id + "&user=" + user;
    window.open(url_script_paqueteria, 'Paqueteria: #' + id, "status=1,toolbar=1,menubar=1");

    var url_script_emblema = server + "iksasocket/functions/ventas/reporte/Emblema.report.inc.php?id=" + id + "&user=" + user;
    window.open(url_script_emblema, 'Emblemas: #' + id, "status=1,toolbar=1,menubar=1");
}  


$(document).on('click', '#btnReport', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");
    // alert('generar reporte'+id);
    let user = localStorage.getItem("rol");
    $("#txtIdComentarioHistorial").val(id);

    if(user=="1"){
        $("#modalComentarioHist").modal('show');
    }else{
        $("#modalErrorHistorial").modal('show');
    }

});

$(document).on('click','#btnEnviarComentarioHist', function(){
    let comentario = $('#txtComentarioHistorial').val();
    let orden = $("#txtIdComentarioHistorial").val();

    historialReporte(orden,comentario);
});

function historialReporte(orden,comentario){
    // arrData=[];
    // arrData.push(orden);
    // arrData.push(comentario);
    // var url_script_almacen = server +"iksasocket/functions/ventas/reporte/paqueteria.reporte.inc.php?id="+id+"&user="+user;

    var user = localStorage.getItem("name");
    var url_script_almacen = server + "iksasocket/functions/ventas/reporte/historial.report.inc.php?id=" + orden +"&obs="+comentario+ "&user=" + user;
    

    return new Promise((resolve, reject) => {
        try {
            window.open(url_script_almacen, 'Historial de Mov. pedido: ' + orden, "status=1,toolbar=1,menubar=1");
            resolve(1);
        } catch (error) {
            console.log('Ocurrio un problema al generar el PDF');
            reject(0);
        }

    }).then((response)=>{
        if (response==1) {
            $("#modalErrorHistorial").modal('hide');
        } else {
            alert('Ocurrio un problema al generar el PDF.');
        }
    })
    
}

$(document).on('click', '#btnEliminarPedidoHistorial', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");

    $("#txtPedidoHistDeleteModal").val(id);

    $("#modalDeletePedidoHist").modal('show');
});

$(document).on('click','#btnEliminarPedidoModal',function(){
    let id = $("#txtPedidoHistDeleteModal").val();
    eliminarPedidoHistorialModal(id);
});

function eliminarPedidoHistorialModal(id){
    arrData=[];
    arrData.push('eliminarPedidoHistorialModal');
    arrData.push(id);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidosHistorial.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                // let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                 alert('Se realizo la operacion correctamente');
                             } else {
                                 alert('Operacion Invalida');
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
                $("#modalDeletePedidoHist").modal('hide');
                return 1;
            } else {
                console.log('No se cerrara el modal');
                return 0;
            }
    }).then((response)=>{
        if (response == 1) {
            historial();
        } else {
            console.log('No se actualizara la tabla');
        }
    })  

}


$(document).on('click', '#btnScanLoot', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");
    ScanLootReport(id);
});

function ScanLootReport(id) {
    var user = localStorage.getItem("name");
    var url_script_almacen = server + "iksasocket/functions/ventas/reporte/Enloots/genReporte.php?order=" + id + "&user=" + user;
    window.open(url_script_almacen, 'Reporte ScanLoot: #' + id, "status=1,toolbar=1,menubar=1");
}