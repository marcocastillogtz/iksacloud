$(document).ready(function () {
    console.log('backOrder');

    showOrdersBack('*');
    showProductsDemand();
});

function showOrdersBack(clave) {
    arrData=[];
    arrData.push('showOrderBack');
    arrData.push(clave);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainBackOrder.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                template += `<tr taskId="${item.id}" taskFolio="${item.folio}">
                                    <td class="align-middle text-center">${item.folio}</td>
                                    <td>${item.cliente}</td>
                                    <td class="align-middle text-center">${item.fecha}</td>
                                    <td class="align-middle text-center">${item.retraso}</td>
                                    <td class="align-middle text-center">
                                    <button type="button" id="detallePedido" class="btn btn-success btn-sm">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                    </td>
                                </tr>`;
                             } else {
                                template += `<tr>
                                    <td class="align-middle text-center" colspan=5>Sin Resultados</td>
                                </tr>`;
                             }
                             $("#item_backOrder").html(template);
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

function showProductsDemand() {
    arrData=[];
    arrData.push('showProductsDemand');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainBackOrder.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                let cantidad = item.cantidad;
                                if (cantidad > 0) {
                                    template += `<tr taskItem="${item.clave}">
                                        <td class="td_item align-middle text-center">${item.clave}</td>
                                        <td class="align-middle text-center">${item.piezas}</td>
                                        <td class="align-middle text-center">
                                            <button type="button" id="verPedidos" class="btn btn-primary font-weight-bold">
                                                ${item.cliente}
                                            </button>
                                        </td>
                                        <td class="align-middle text-center"><p class="text-success">${item.cantidad}</p></td>
                                    </tr>`;

                                } else {
                                    template += `<tr taskItem="${item.clave}">
                                        <td class="td_item align-middle text-center">${item.clave}</td>
                                        <td class="align-middle text-center">${item.piezas}</td>
                                        <td class="align-middle text-center">
                                            <button type="button" id="verPedidos" class="btn btn-primary font-weight-bold"> <i class="fa-solid fa-people-group"></i>
                                                ${item.cliente}
                                            </button>
                                        </td>
                                        <td class="align-middle text-center">-</td>
                                    </tr>`;
                                }

                             } else {
                                template += `<tr>
                                    <td class="align-middle text-center" colspan=4>Sin Resultados</td>
                                </tr>`;
                             }
                             $("#productosDemandados").html(template);
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


$(document).on('click', '#detallePedido', function () {
    $("#txtFolioModalBackOrderPartidasDebidas").val('');
    $("#txtIdPedidoModalBackOrderPartidasDebidas").val('');

    let element = $(this)[0].parentElement.parentElement;
    let folio = $(element).attr("taskFolio");
    let id = $(element).attr("taskId");

    $("#txtFolioModalBackOrderPartidasDebidas").val(folio);
    $("#txtIdPedidoModalBackOrderPartidasDebidas").val(id);
    // alert('Este es un pedidoooo'+folio);
    getDetallePedidoBackOrder(folio);
});

function getDetallePedidoBackOrder(foliooo) {
    // alert('este es el folio...'+foliooo);
    arrData=[];
    arrData.push('getDetallePedidoBackOrder');
    arrData.push(foliooo);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainBackOrder.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1 ) {
                                    $("#LabelID").html(item.folio);

                                    template += `<tr taskFolio="${item.folio}"  taskClave="${item.clave}" taskId="${item.idDetalle}">
                                            <td class="lign-middle text-center">${item.clave}</td>
                                            <td class="lign-middle text-center">${item.cantidad}</td>
                                            <td class="align-middle text-center">

                                            <button type="button" id="resetDetallePedido" class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-arrow-rotate-left"></i>
                                            </button>
                                            <button type="button" id="editarDetallePedido" class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <button type="button" id="eliminarDetallePedido" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                        </td>
                                    </tr>`;

                             } else {
                                template += `<tr>
                                        <td class="lign-middle text-center" colspan="5">Sin resultado</td>
                                </tr>`;
                             }
                             $("#detallePedidosBack").html(template);
                             resolve(item.validation)
                        }); 
                    },
                    error: function (XMLHttpRequest, txtStatus, errorThrown) {
                            alert("Request: "+XMLHttpRequest);
                            alert("Estatus: "+txtStatus);
                            alert("Error: "+errorThrown);
                            reject(errorThrown);
                    },
                    // data-placement="right" data-bs-toggle="modal" data-bs-target="#modalBackOrder"
            }); 
        }).then((response)=>{
            if (response == 1) {
                $("#modalBackOrder").modal('show');
            } else {
            }
    })
}


$(document).on('click', '#resetDetallePedido', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");
    let folio = $(element).attr("taskFolio");
    let clave = $(element).attr("taskClave");
    
    
    // alert('reseteando..'+id);
    resetDetallePed(id,folio,clave);
});

function resetDetallePed(id,folio,clave) {
    arrData=[];
    arrData.push('resetDetallePed');
    arrData.push(id);
    arrData.push(folio);
    arrData.push(clave);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainBackOrder.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                 alert('Se reseteo correctamente');
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
                $("#txtFolioModalBackOrderPartidasDebidas").val(folio);
                getDetallePedidoBackOrder(folio);
            } else {

            }
    })

}


$(document).on('click', '#editarDetallePedido', function () {
    $("#txtFolioModalEditPartidasDebidas").val('');
    
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");
    let folio = $(element).attr("taskFolio");

    $("#txtIdModalEditPartidasDebidas").val(id);
    $("#txtFolioModalEditPartidasDebidas").val(folio);
    
    getDataProductDetallePedido(id);
});

function getDataProductDetallePedido(id) {
    // alert('Obteniendo info..'+id);
    arrData=[];
    arrData.push('getDataProductDetallePedido');  
    arrData.push(id);
    
    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainBackOrder.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                $("#txt_claveEdit").val(item.clave);
                                $("#txt_cantidadEdit").val(item.cantidad);
                                $("#txt_descripcionEdit").val(item.descripcion);
                                $("#txt_FamOfertaEdit").val(item.famOferta);
                                $("#txt_totalEdit").val(item.monto);
                                $("#txt_precioivaEdit").val(item.precio);
                             } else {
                                $("#txt_claveEdit").val('Sin Resultado');
                                $("#txt_cantidadEdit").val('Sin Resultado');
                                $("#txt_descripcionEdit").val('Sin Resultado');
                                $("#txt_FamOfertaEdit").val('Sin Resultado');
                                $("#txt_totalEdit").val('Sin Resultado');
                                $("#txt_precioivaEdit").val('Sin Resultado');
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
                $("#modalEditPartidasDebidas").modal('show');
            } else {
                console.log('No se mostrara la ventana, por que no se completo el proceso anterior');
            }
    })

}

$(document).on('click','#btnInsertarPartida', function() {
    $("#addItemBackorder").modal('show');    
/*
    let folio = $("#txtFolioModalBackOrderPartidasDebidas").val();
    let id = $("#txtIdPedidoModalBackOrderPartidasDebidas").val();
    let folioNVO = folio.replace(/F|R/g, "BK:B");

    arrData=[];
    arrData.push('getLPInsert');
    arrData.push(id);
    arrData.push(folio);
    arrData.push(folioNVO);

    getLP(arrData);
*/
    //getLP(id,folio);
    // alert('este es el folio para insertar..'+folio);
    // alert('este es el id para insertar..'+id);
});

$(document).on('click','#btn_genFolioAdd', function() {
    let folio = $("#txtFolioModalBackOrderPartidasDebidas").val();
    let id = $("#txtIdPedidoModalBackOrderPartidasDebidas").val();
    let folioNVO = folio.replace(/F|R/g, "BK:B");

    arrData=[];
    arrData.push('getLPInsert');
    arrData.push(id);
    arrData.push(folio);
    arrData.push(folioNVO);

    getLP(arrData);
});


$(document).on('click', '#btn_updateEdit', function () {
    /*
    let folio = $("#txtFolioModalEditPartidasDebidas").val();
    let clave = $("#txt_claveEdit").val();
    let cantidad = $("#txt_cantidadEdit").val();
    let descripcion = $("#txt_descripcionEdit").val();
    let precioMasIva = $("#txt_precioivaEdit").val();
    let total = $("#txt_totalEdit").val();
    */
    let folio = $("#txtFolioModalEditPartidasDebidas").val();
    let id = $("#txtIdModalEditPartidasDebidas").val();
    let folioNVO = folio.replace(/F|R/g, "BK:B");

    let cantidad = $("#txt_cantidadEdit").val();
    let total = $("#txt_totalEdit").val();
    let clave = $("#txt_claveEdit").val();

    arrData=[];
    arrData.push('getLPUpdate');
    arrData.push(id);
    arrData.push(folio);
    arrData.push(folioNVO);
    arrData.push(cantidad);
    arrData.push(total);
    arrData.push(clave);

    getLP(arrData);



    // let val_operacion = 2;

    //getLP(id,folio);
    // alert('este es el folio para actualizar..'+folio);
    // alert('este es el id para actualizar..'+id);
});

function getLP(arrData) {
    // let folioNVO = folioo.replace(/F|R/g, "BK:B");
    // let idd = id;

    // data=[];
    // data.push('getLP');
    // data.push(folioo);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainBackOrder.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = "";
                     item.forEach((item) => {
                            if (item.function == 'getLPUpdate') {
                                if (item.validation == 1) {
                                    alert('Se actualizo la partida correctamente');
                                } else {
                                    alert('Ocurrio un problema al actualizar la partida');
                                }
                                result = [];
                                result = [item.function, item.validation ].join('=>');
                       
                                resolve(result);

                            } else if (item.function == 'getLPInsert') {
                                if (item.validation == 1) {
                                    //  alert('Se realizo la operacion correctamente');
                                    // item.lp;
                                    // item.folio;
                                    // item.cliente;
                                    // item.vendedor;
                                    // item.documento;
                                    // item.estatus;
                                    // item.id_detalle;
                                    // item.estatusOferta
                                    //alert(item.ordenFolio);

                                    const arrOrdenFolio = item.ordenFolio.split("/");

                                    $("#txt_folioNuevo").val(arrOrdenFolio[0]);
                                    $("#txt_idNuevo").val(arrOrdenFolio[1]);
                                    
                                    $("#btn_insertPartidaAdd").prop('disabled',false);
                                    $("#txt_claveAdd").prop('disabled',false);
                                    $("#txt_cantidadAdd").prop('disabled',false);

                                 } else {
                                     alert('Operacion Invalida');
                                 }
                                 resolve(item.validation);
                            }
                             
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
            const arr = response.split("=>");

            if (arr[0]=='getLPUpdate') {
                if (arr[1] == 1) {
                    $("#modalEditPartidasDebidas").modal('hide');
                    return 420;
                } else {
                    console.log('No se cerrara el modal porque no se completo el proceso anterior');
                    return 440;
                }

            } else if(arr[0]=='getLPInsert'){
                alert('funcion de insert');

            }
    }).then((response)=>{
        if (response==420) {
            // refrestable();
            let folioq = $("#txtFolioModalBackOrderPartidasDebidas").val();
            getDetallePedidoBackOrder(folioq);
        } else {
            console.log('No se actualizara la tabla por que no sufrio ningun cambio');
        }
    })

}

$(document).on('click', '#btn_sendOrder', function () {
    let tipoEnvio = $("#select_envio").val();
    let folio = $("#txt_folioNuevo").val();
    
    if (tipoEnvio == 'All') {
        alert('Debes de seleccionar una opcion');
    } else if(folio==null || folio =='F|R---------------'){
        alert('Debes de generar un folio antes de continuar con el proceso');
    }else {
        actualizarPedido();
    }
});


function actualizarPedido() {
    let id = $("#txt_idNuevo").val();
    let metodoEnvio = $("#select_envio_back").find("option:selected").text();

    // alert('id..'+id);
    // alert('metodo envio..'+metodoEnvio);

    arrData=[];
    arrData.push('actualizarPedido');
    arrData.push(id);
    arrData.push(metodoEnvio);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainBackOrder.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                 alert('Se envio correctamente el pedido');
                             } else {
                                 alert('Ocurrio un problema al enviar el pedido')
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
                $("#addItemBackorder").modal('hide');
                $("#modalBackOrder").modal('hide');
                showOrdersBack('*');
                showProductsDemand();
            } else {
                console.log('No se cerrara el modal');
            }
    })

}

$(document).on('click', '#eliminarDetallePedido', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");
    let folio = $(element).attr("taskFolio");

    // alert('Eliminando..'+id);
    $("#txtIdFolioModalEliminarPartida").val(id);
    $("#txtFolioModalEliminarPartida").val(folio);

    $("#modalEliminarPartida").modal('show');
});

$(document).on('click', '#btnEliminarPartida', function () {

    let id = $("#txtIdFolioModalEliminarPartida").val();
    let fol = $("#txtFolioModalEliminarPartida").val();

    // alert('este es un id..' + id);
    eliminarPartida(id);
});

function eliminarPartida(idd) {
    arrData=[];
    arrData.push('eliminarPartidaBackOrder');
    arrData.push(idd);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainBackOrder.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation==1) {
                                 alert('Se elimino correctamente la partida');
                             } else {
                                 alert('Ocurrio un problema al eliminar la partida')
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
                $("#modalEliminarPartida").modal('hide');
                return 1;
            } else {
                console.log('No se cerrarar el modal');
                return 2;
            }
    }).then((response)=>{
        if (response == 1) {
            let folio = $("#txtFolioModalBackOrderPartidasDebidas").val();
            getDetallePedidoBackOrder(folio);
        } else {
            console.log('No se actualizara la tabla por que no sufrio cambios');
        }
    })

}
var delayTimer;

$(document).on('keyup','#txt_claveAdd',function() {
    var key = $('#txt_claveAdd').val();
    Mayuscula(key);
    clearTimeout(delayTimer);
    delayTimer = setTimeout(function() {
        if (key.length > 8 && key.length < 10) {
            consultarClave();
        } else {
            $("#txt_cantidadAdd").val("");
            $("#txt_descripcionAdd").val("");
            $("#txt_precioivaAdd").val("");
            $("#txt_precioOfertaAdd").val("");
            $("#txt_RestriccionAdd").val("");
            $("#txt_FamOfertaAdd").val("");
            $("#txt_totalAdd").val(""); 
        }
    },100);
});

function consultarClave() {
    let clave = $("#txt_claveAdd").val(); 
    let folio = $("#txt_folioNuevo").val();

    arrData=[];
    arrData.push('consultarClave');
    arrData.push(clave);
    arrData.push(folio);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainBackOrder.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = "";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                let formatMoney = Intl.NumberFormat('en-US');

                                $("#txt_descripcionAdd").val(item.descripcion);
                                $("#txt_precioivaAdd").val(formatMoney.format(item.precioEspecial));
                                // $("#txt_precioOfertaAdd").val(formatMoney.format(item.PrecioOferta));
                                $("#txt_precioOfertaAdd").val(formatMoney.format(item.precioVenta));
                                $("#txt_FamOfertaAdd").val(item.familiaVenta);
                                $("#txt_RestriccionAdd").val(item.restriccion);

                             } else {
                                $("#txt_descripcionAdd").val("Sin descripcion");
                                $("#txt_precioOfertaAdd").val(0.0);
                                $("#txt_FamOfertaAdd").val(0);
                                $("#txt_RestriccionAdd").val("S/D");
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

function Mayuscula(key) {
    $("#txt_claveAdd").val(key.toUpperCase());
}

$(document).on('keyup','#txt_cantidadAdd',function() {
    TotalAdd();
    $("#btn_genFolioAdd").prop("disabled", true);
    $("#btn_insertPartidaAdd").prop("disabled", false);
});

function TotalAdd() {
    let formatMoney = Intl.NumberFormat('en-US');
    let cantidad = $("#txt_cantidadAdd").val();
    let precio = $("#txt_precioivaAdd").val();
    
    $("#txt_totalAdd").val(formatMoney.format(cantidad * precio));
}

$(document).on('click', '#btn_insertPartidaAdd', function () {
    // let element = $(this)[0].parentElement.parentElement;
    // let id = $(element).attr("taskId");
    // let folio = $(element).attr("taskFolio");

    let folio = $("#txt_folioNuevo").val();
    let id = $("#txt_idNuevo").val();
    let clave = $("#txt_claveAdd").val();
    let cantidad = $("#txt_cantidadAdd").val();
    let descripcion = $("#txt_descripcionAdd").val();
    let precioIva = $("#txt_precioivaAdd").val();
    let precioOfer = $("#txt_precioOfertaAdd").val();
    let restAdd = $("#txt_RestriccionAdd").val();
    let famOfer = $("#txt_FamOfertaAdd").val();
    let total = $("#txt_totalAdd").val().replaceAll(",","");

    if (folio == null || folio == 'F|R---------------' && id == null || id == '00000') {
        alert('Debes de generar un folio antes de añadir un producto');
    } else {
        insertPartidaAdd(id,folio,clave,cantidad,descripcion,precioIva,precioOfer,restAdd,famOfer,total);
    }

});


function insertPartidaAdd(id,fol,clv,cant,desc,precioIva,precioOfer,restAdd,famOfer,total) {
    arrData=[];
    arrData.push('insertPartidaAdd');
    arrData.push(id);
    arrData.push(fol);
    arrData.push(clv);
    arrData.push(cant);
    arrData.push(desc);
    arrData.push(precioIva);
    arrData.push(precioOfer);
    arrData.push(restAdd);
    arrData.push(famOfer);
    arrData.push(total);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainBackOrder.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                 alert('Se registro correctamente el producto');
                             } else {
                                 alert('Ocurrio un problema al registrar el producto')
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
                return limpiarModalAgregarPartida();
            } else {
                console.log('No se limpiaran los campos del modal');
                return 0;
            }
    })

}


function limpiarModalAgregarPartida() {
    $("#txt_claveAdd").val('');
    $("#txt_cantidadAdd").val('');
    $("#txt_descripcionAdd").val('');
    $("#txt_precioivaAdd").val('');
    $("#txt_precioOfertaAdd").val('');
    $("#txt_RestriccionAdd").val(''); 
    $("#txt_FamOfertaAdd").val(''); 
    $("#txt_totalAdd").val('');    
 
    return 1;
}


$(document).on('click', '#verPedidos', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");
    let folio = $(element).attr("taskFolio");


    alert('este es el detalle..'+id);
});

