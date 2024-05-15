$(document).ready(function () {
    console.log('seguimiento');

    // showOrdersBack('*');
    // showProductsDemand();
    // showPedidoSeguimiento();
    fillSelectLogistica();

    var arrData=[];
    arrData=[];
    arrData.push('showPedidoSeguimiento');
    showPedidoSeguimiento(arrData).then((response)=>{
        if (response == 1) {
            return fillSelectSellersSeguimiento();
        } else {
            console.log('No se lleno el select de vendedores del modulo de seguimiento');
        }
    }).then((response)=>{
        if (response == 1) {
            fillSelectClientSeguimiento();
        } else {
            console.log('No se lleno el select de clientes del modulo de seguimiento');
        }
    })
});



function showPedidoSeguimiento(arrData) {
    // arrData=[];
    // arrData.push('showPedidoSeguimiento');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainSeguimiento.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation==1) {
                                if (item.guia==null) {
                                    item.guia ="Sin Guia";
                                } else {
                                    item.guia;
                                }
                                template += `<tr taskId="${item.id}">
                                    <th>${item.id}</th>
                                    <td>${item.nombreCliente}</td>
                                    <td>${item.vendedor}</td>
                                    <td>${item.estatus}</td>
                                    <td>${item.fecha}</td>
                                    <td>${item.logistica}</td>
                                    <td>${item.guia}</td>
                                    <td>
                                        <button type="button" id="btnPaqueteriaSeguimiento" class="btn btn-success btn-sm">
                                            <i class="fa-solid fa-truck-fast"></i>
                                        </button>

                                        <button type="button" id="btnChangeStatusSeguimiento" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </button>
                                    </td>
                                </tr>`;
                             } else {
                                template += `<tr>
                                    <th class="align-middle text-center" colspan="8"><h5>No hay resultados <i class="bi bi-binoculars"></i></h5></td>
                                </tr>`;
                             }
                             resolve(item.validation);
                             $("#tableSeguimiento").html(template);
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
                $("#spinnerTableSeguimiento").hide();
                return 1;
            } else {
                $("#spinnerTableSeguimiento").hide();
                return 0;
            }
    })


}

function  fillSelectSellersSeguimiento() {
    arrData=[];
    arrData.push('fillSelectSellers');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidosHistorial.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                $("#selectSellerSeguimiento").append('<option value="' + item.id + '">' + item.usuario + '</option>');
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
        })
}

function fillSelectClientSeguimiento() {
    arrData=[];
    arrData.push('fillSelectClient');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidosHistorial.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                $("#selectClientSeguimiento").append('<option value="' + item.id + '">' + item.cliente + '</option>');
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
        })
}


$(document).on("click", "#btnBuscarSeguimiento", function () {
    let vendededor = $("#selectSellerSeguimiento").val();
    let cliente = $("#selectClientSeguimiento").val();
    let date1 = $("#dateSeguimiento1").val();
    let date2 = $("#dateSeguimiento2").val();
    
    //buscarSeguimiento(vendededor,cliente,date1,date2);
    arrData=[];
    arrData.push('buscarSeguimiento');
    arrData.push(vendededor);
    arrData.push(cliente);
    arrData.push(date1);
    arrData.push(date2);

    showPedidoSeguimiento(arrData)
    
});
/*
function buscarSeguimiento(vendededor,cliente,date1,date2) {
    arrData=[];
    arrData.push('buscarSeguimiento');
    arrData.push(vendededor);
    arrData.push(cliente);
    arrData.push(date1);
    arrData.push(date2);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainSeguimiento.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                 template += `<tr taskId=${item.id} taskData=${item.estatus}>
                                        <th>${item.id}</th>
                                        <td>${item.nombre}</td>
                                        <td>${item.estatus}</td>
                                        <td>${item.vendedor}</td>
                                        <td>${item.fecha}</td>
                                        <td>${item.guia}</td>
                                        <td>${item.logistica}</td>
                                        <td class="align-middle text-center">
                                        <button type="button" id="btnPaqueteriaSeguimiento" class="btn btn-success btn-sm">
                                            <i class="fa-solid fa-truck-fast"></i>
                                        </button>

                                        <button type="button" id="btnChangeStatusSeguimiento" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </button>
                                    </td>
                                </tr>`;

                             } else {
                                template += `<tr>
                                    <th class="align-middle text-center" colspan="8"><h5>No hay resultados <i class="bi bi-binoculars"></i></h5></td>
                                </tr>`;
                             }
                             resolve(item.validation);
                             $("#tableSeguimiento").html(template);
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
*/
function fillSelectLogistica() {
    arrData=[];
    arrData.push('fillSelectLogistica');


    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainSeguimiento.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                    var sel = $("#selectLogistica");
                    item.forEach((item) => {
                             if (item.validation == 1) {
                                sel.append('<option value="' + item.logistica.replace("?", "ñ") + '">' + item.logistica.replace("?", "ñ") + "</option>" );
                             } else {
                                sel.append('<option value="Sin Resultados">Sin Resultados</option>');
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

$(document).on("click", "#btnPaqueteriaSeguimiento", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");
    
    $("#modalLogistica").modal('show');
    $("#txtIdPedidoLogistica").val(id);
    $("#showArray").html('');
    $("#showArray").attr("taskGuia",guiaReplace);
    guiaValores = [];
});
/*
$(document).on("change", "#selectMetodoEnvio", function () {
    if ($(this).val() == 'Paqueteria') {
        $("#selectLogistica").prop('disabled',false);
        $("#txtGuiaLogistica").prop('disabled',false);
    } else {
        $("#selectLogistica").val('All');
        $("#selectLogistica").prop('disabled',true);

        $("#txtGuiaLogistica").val('');
        $("#txtGuiaLogistica").prop('disabled',true);
    }
});
*/
$(document).on("change", "#selectMetodoEnvio", function () {
    $("#showArray").html('');
    $("#showArray").attr("taskGuia",'');
    guiaValores = [];

    if ($(this).val() == 'Paqueteria') {
        $("#selectLogistica").prop('disabled',false);
        $("#txtGuiaLogistica").prop('disabled',false);

        $("#addGuia").prop('disabled',false);
        $("#showArray").html('');
        $("#showArray").attr("taskGuia",'');
        guiaValores = [];
    } else {
        $("#selectLogistica").val('All');
        $("#selectLogistica").prop('disabled',true);

        $("#txtGuiaLogistica").val('');
        $("#txtGuiaLogistica").prop('disabled',true);

        $("#addGuia").prop('disabled',true);

        $("#showArray").html('');
        $("#showArray").attr("taskGuia",'');
        guiaValores = [];
    }
});

var guiaValores = [];

$(document).on("click", "#addGuia", function () {
   if ($("#txtGuiaLogistica").val() == null || $("#txtGuiaLogistica").val() == "") {
        alert('Debes de escribir una guia');
   } else {
        var guia = $("#txtGuiaLogistica").val();
        guiaValores.push(guia);

        let guiaString = guiaValores.toString();
        guiaReplace = guiaString.replaceAll(",", "/");

        $("#showArray").html(guiaReplace);
        $("#showArray").attr("taskGuia",guiaReplace);
        // guiaValores = [];

        $("#txtGuiaLogistica").val("");

   }
});

$(document).on("click", "#sendGuia", function () {

    let id = $("#txtIdPedidoLogistica").val();
    let metodoEnvio = $("#selectMetodoEnvio").val();
    let logistica = $("#selectLogistica").val();
    let guiaLog = $("#showArray").attr("taskGuia");

    if (metodoEnvio ==''|| metodoEnvio == null) {
        metodoEnvio = 'Personalmente';
    }
    
    if(logistica == '' || logistica == 'All' || logistica == null) {
        logistica = 'S/LG';
    }

    if (guiaLog == '' || guiaLog == null) {
        guiaLog = 'Sin Guia';
    }

    if (metodoEnvio == 'Paqueteria') {
        if (logistica == 'All'|| logistica == 'S/LG' || logistica == '') {
            alert('Debes seleccionar una logistica');
        } else {
            if (guiaLog=='Sin Guia' || guiaLog ==''||guiaLog==null) {
                alert('La guia no debe estar vacia');
            } else {
                arrData=[];
                arrData.push('sendGuia');
                arrData.push(id);
                arrData.push(metodoEnvio);
                arrData.push(logistica);
                arrData.push(guiaLog);

                sendGuia(arrData);
            }
        }
    } else if(metodoEnvio == 'Personalmente'){
        logistica = 'S/LG';
        guiaLog = 'Sin Guia';
        
        arrData=[];
        arrData.push('sendGuia');
        arrData.push(id);
        arrData.push(metodoEnvio);
        arrData.push(logistica);
        arrData.push(guiaLog);

        sendGuia(arrData);
    }
    // arrData=[];
    // arrData.push('sendGuia');
    // arrData.push(id);
    // arrData.push(metodoEnvio);
    // arrData.push(logistica);
    // arrData.push(guiaLog);

    // sendGuia(arrData);
 });

 function sendGuia(arrData) {
    
    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainSeguimiento.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                alert('Se actualizo correctamente');
                                $("#showArray").html(''); 
                                $("#showArray").attr("taskGuia",'');
                                guiaValores = [];
                             } else {
                                 alert('Ocurrio un problema al actualizar');
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
                $("#modalLogistica").modal('hide');
                return 1;
            } else {
                console.log('No se cerrar el modal');
                return 0;
            }
    }).then((response)=>{
        if (response == 1) {
            $("#selectMetodoEnvio").val('Personalmente');
            $("#selectLogistica").val('All');
            $("#selectLogistica").prop('disabled',true);
            $("#txtGuiaLogistica").val('');
            $("#txtGuiaLogistica").prop('disabled',true);
            $("#addGuia").prop('disabled',true);
            
            $("#showArray").html(''); 
            $("#showArray").attr("taskGuia",'');
            guiaValores = [];

            $("#taskguia").val('');
            return 1;
        } else {
            console.log('No se limpiaran los campos');
            return 0;
        }
    }).then((response)=>{
        if (response == 1) {
            let vendededor = $("#selectSellerSeguimiento").val();
            let cliente = $("#selectClientSeguimiento").val();
            let date1 = $("#dateSeguimiento1").val();
            let date2 = $("#dateSeguimiento2").val();
            
            arrData=[];
            arrData.push('buscarSeguimiento');
            arrData.push(vendededor);
            arrData.push(cliente);
            arrData.push(date1);
            arrData.push(date2);

            return showPedidoSeguimiento(arrData);
        } else {
            console.log('No se actualizara la tabla');
        }
    })

 }

 $(document).on("click", "#btnChangeStatusSeguimiento", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");

    changeStatuss(id);
 })

 function changeStatuss(id) {
    arrData = [];
    arrData.push('changeStatuss');
    arrData.push(id);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainSeguimiento.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                // let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                 alert('Se actualizo correctamente');
                             } else {
                                 alert('Ocurrio un problema al actualizar')
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
                let vendededor = $("#selectSellerSeguimiento").val();
                let cliente = $("#selectClientSeguimiento").val();
                let date1 = $("#dateSeguimiento1").val();
                let date2 = $("#dateSeguimiento2").val();
                
                arrData=[];
                arrData.push('buscarSeguimiento');
                arrData.push(vendededor);
                arrData.push(cliente);
                arrData.push(date1);
                arrData.push(date2);

                return showPedidoSeguimiento(arrData);
            } else {
                console.log('No se actualizara la tabla');
            }
    })

 }
 
