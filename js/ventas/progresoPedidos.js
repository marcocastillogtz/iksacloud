$(document).ready(function () {
    console.log('Pedidos Espera');
    progresoPedidos();
});

var arrData=[];

function progresoPedidos() {
    arrData = [];
    arrData.push('progresoPedidos');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainProgresoPedidos.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                            if (item.validation == 1 && item.autorizado==0) {
                                template += `<tr taskId="${item.idPedido}" porcentaje="${item.porcentaje}" taskRow="${item.id_surtir}" taskUser="${item.idUsuario}">
                                <th class="align-middle text-center">${item.idPedido}</th>
                                <td class="align-middle text-center">${item.descripcion}</td>
                                <td class="align-middle text-center">${item.usuario}</td>
                                <th class="align-middle text-center">${item.porcentaje} %</th>
                                <td span="2" class="align-middle text-center">
                                <button type="button" id="btnAuthOrder" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Autorizar pedido" >
                                    <i class="fa-regular fa-circle-check"></i> Autorizar
                                </button >
                                </td>
                                </tr>`;
                            } else if(item.validation == 1 && item.autorizado==1){
                                template += `<tr taskId="${item.idPedido}" porcentaje="${item.porcentaje}" taskRow="${item.id_surtir}" taskUser="${item.idUsuario}"">
                                <th class="align-middle text-center">${item.idPedido}</th>
                                <td class="align-middle text-center">${item.descripcion}</td>
                                <td class="align-middle text-center">${item.usuario}</td>
                                <th class="align-middle text-center">${item.porcentaje} %</th>
                                <td span="2" class="align-middle text-center">
                                <button type="button" id="btnAuthOrder" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Autorizar pedido" disabled>
                                    <i class="fa-regular fa-circle-check"></i> Hecho
                                </button >
                                </td>
                                </tr>`;
                            }else if (item.validation == 0) {
                                template += `<tr class="table-info" taskId="${item.id_surtir}">
                                <td class="lign-middle text-center" colspan="7"><h5 class="text-primary">No hay resultados <i class="bi bi-emoji-dizzy primary-"></i></h5></td>
                                </tr>`;
                            }
                            $("#item_progreso_pedidos").html(template);
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
                $("#spinnerTableProgresoPedidos").hide();
            } else {
                $("#spinnerTableProgresoPedidos").hide();
            }
    })

}

$(document).on('click', '#btnAuthOrder', function () {
    let element = $(this)[0].parentElement.parentElement;
    let idOder = $(element).attr("taskId");
    let porcentaje = $(element).attr("porcentaje");
    let idUser = $(element).attr("taskUser");

    $("#txtPorcentajePedidoPorAutorizar").val(porcentaje);
    $("#txtUsuarioPedidoPorAutorizar").val(idUser);
    $("#txtIdPedidoPorAutorizar").val(idOder);

    if (porcentaje < 75) {
        $("#modalAutorizarPedidoScanLoot").modal('show');
    } else {
        alert('No es necesario autorizar el pedido por que cumple mas del 75 %');
    }
 
});


$(document).on('click','#btnAutorizarPedidoModal',function() {
    let id = $("#txtIdPedidoPorAutorizar").val();
    let porcentaje = $("#txtPorcentajePedidoPorAutorizar").val();
    let user = $("#txtUsuarioPedidoPorAutorizar").val();
    let comentario = $("#txtComentario").val();

    

    arrData = [];
    arrData.push('autorizarPedido');
    arrData.push(id);
    arrData.push(porcentaje);
    arrData.push(user);
    arrData.push(comentario);

    autorizarPedido(arrData);
});

function autorizarPedido(arrData) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainProgresoPedidos.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                 alert('Se añadio el comentario correctamente');
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
                $("#modalAutorizarPedidoScanLoot").modal('hide');
                return 1;
            } else {
                console.log('No se cerrara el modal porque no se actualizo de manera adecuada');
                return 0;
            }
    }).then((response)=>{
        if (response == 1) {
            return progresoPedidos(); 
        } else {
            console.log('No se resfrescara la tabla :(');
        }
    })

}