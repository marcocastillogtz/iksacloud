$(document).ready(function () {
    console.log('documentos Facturados');

    getDocFacturados();
    getVendedor();
});

var servidor = "http://localhost/iksasocket/";

function getDocFacturados() {
    arrData = [];
    arrData.push('getDocFacturados');


    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainDocFacturados.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = "";
                     item.forEach((item) => {
                        let icon_comment = '';
                        let bg_prioridad = '';
                        
                        let pzas = '';
                        let readyPza = '';

                        let pq  ='';
                        let readyPq = '';

                        let emb = '';
                        let readyEmb = '';
                        
                        let alm_a = '';
                        let alm_b = '';
                        
                        let metodoEnv = '';

                             if (item.validation == 1) {

                                if (item.observacion.length > 0) {
                                    icon_comment = '<i class="fa-regular fa-comment-dots"></i>';
                                } else {
                                    icon_comment = '<i class="fa-solid fa-minus"></i>';
                                }

                                if (item.prioridad == 3) {
                                    bg_prioridad = 'bg-danger'
                                } else if(item.prioridad == 2){
                                    bg_prioridad = 'bg-warning';
                                }else if(item.prioridad == 1){
                                    bg_prioridad = 'bg-success';
                                }

                                if (item.pieza == 0) {
                                    pzas='<i class="fa-solid fa-minus"></i>';
                                } else if(item.pieza == 1){
                                    pzas='<i class="fa-solid fa-circle"></i>';
                                } else if(item.pieza == 2){
                                    pzas='<i class="fa-solid fa-clock text-warning"></i>';
                                }else if(item.pieza == 3){
                                    pzas='<i class="fa-solid fa-circle-check text-success"></i>';
                                }

                                if (item.check_pz == 1) {
                                    readyPza = '<i class="fa-solid fa-play"></i>';
                                } else {
                                    readyPza = '';
                                }


                                if (item.paquete == 0) {
                                    pq ='<i class="fa-solid fa-minus"></i>';
                                }else if(item.paquete == 1){
                                    pq ='<i class="fa-solid fa-circle"></i>';
                                }else if(item.paquete == 2){
                                    pq ='<i class="fa-solid fa-clock text-warning"></i>';
                                }else if(item.paquete == 3){
                                    pq ='<i class="fa-solid fa-circle-check text-success"></i>';
                                }

                                if (item.check_pq == 1) {
                                   readyPq ='<i class="fa-solid fa-play"></i>'; 
                                } else {
                                    readyPq ='';
                                }


                                if (item.emblema == 0) {
                                    emb = '<i class="fa-solid fa-minus"></i>';
                                    
                                }else if(item.emblema == 1){
                                    emb = '<i class="fa-solid fa-circle"></i>';

                                }else if(item.emblema == 2){
                                    emb ='<i class="fa-solid fa-clock text-warning"></i>';

                                }else if(item.emblema == 3){
                                    emb ='<i class="fa-solid fa-circle-check text-success"></i>';

                                }

                                if (item.check_emb == 1) {
                                    readyEmb = '<i class="fa-solid fa-play text-success"></i>';
                                } else {
                                    readyEmb = '';
                                }


                                if (item.almacen_a == 0) {
                                    alm_a = '<i class="fa-solid fa-circle text-success"></i>';
                                }else if (item.almacen_a == 1) {
                                    alm_a = '<i class="fa-solid fa-circle-minus text-danger"></i>';
                                }


                                if (item.almacen_b == 0) {
                                    alm_b = '<i class="fa-solid fa-circle text-success"></i>';    
                                }else if (item.almacen_b == 0) {
                                    alm_b = '<i class="fa-solid fa-circle-minus text-danger"></i>';;
                                }
                                // alert(pzas);
                                // alert(readyPza);
                                
                                
                                if (item.metodo_envio.includes('Paqueteria') || item.metodo_envio.includes('PAQUETERIA')) {
                                    metodoEnv = 'table-info';
                                } else if(item.metodo_envio.includes('null') || item.metodo_envio == null){
                                    metodoEnv = 'table-warning';
                                }else{
                                    if (item.estatus == "TE") {
                                        metodoEnv = 'table-success';
                                    } else {
                                        metodoEnv = '';
                                    }
                                }


                                template += `<tr taskId="${item.id}"  taskFolioo="${item.folio}">
                                    <th class="align-middle text-center"><div class="position-relative">${item.id} <span class="z-3 position-absolute top-0 start-0 translate-middle badge border border-light rounded-circle ${bg_prioridad} p-1"><span class="visually-hidden">unread messages</span></span></div></th>
                                    <td class="align-middle text-center">${item.nombre_completo}</td>
                                    <td class="align-middle text-center">${icon_comment}</td>

                                    
                                    <td class="align-middle text-center">${readyPza} ${pzas}</td>
                                    <td class="align-middle text-center">${readyPq} ${pq}</td>
                                    <td class="align-middle text-center">${readyEmb} ${emb}</td>
                                    <td class="align-middle text-center">${item.folio}</td>

                                    <td class="align-middle text-center">${alm_a}</td>
                                    <td class="align-middle text-center">${alm_b}</td>

                                    <td class="align-middle text-center">
                                        <button type="button" id="btnGeneratePDFdocsFacturados" class="btn btn-danger btn-sm">
                                            <i class="fa-regular fa-file-pdf"></i>
                                        </button>
                                        <button type="button" id="btnOpcionesDocsFacturados" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                    </td>
                                    
                                </tr>`;

                             } else {
                                template += `<tr>
                                    <th class="align-middle text-center">Sin Resultados</th>
                                </tr>`;
                             }
                             $("#item_docs_facturados").html(template);
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
                $("#spinnerTableDocsFacturados").hide();
            } else {
                $("#spinnerTableDocsFacturados").hide();
            }
    })

}

$(document).on('click', '#btnReporteDocsFacturados', function () {
    $("#modalGenerarReporteFactPedido").modal('show');

});

$(document).on('click', '#btnUpdateTableDocsFacturados', function () {
    getDocFacturados().then((data) => {        
        if (data == 1) {
            console.log('Se obtubo la informacion correctamnete');
        } else {
            console.log('No se encontraron registros');
        }

    }).catch((error)=>{
        alert('Ocurrio un problema al completar el proceso'+ error);
    })
});


$(document).on('click', '#btnGeneratePDFdocsFacturados', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");

    generatePDFDocsFacturados(id)
});

function generatePDFDocsFacturados(idOrderr) {
    let user = localStorage.getItem('name');
    var url_report = servidor+"functions/facturacion/reporte/genReporte.php?order=" + idOrderr + "&user=" + user;
    window.open(url_report, 'Orden de Cotizacion: #' + idOrderr, "status=1,toolbar=1,menubar=1");

}

$(document).on('click', '#btnOpcionesDocsFacturados', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskId");
    let folioo = $(element).attr("taskFolioo");

    $("#txtIdPedidoModalDocumentosFacturados").val(id);
    $("#txtFolioModalDocumentosFacturados").val(folioo);
    
    $("#modalOpcionesDocsFacturados").modal('show');

});

$(document).on('click','#btnFacturarPedidoModal',function() {
    // let element = $(this)[0].parentElement.parentElement;
    // let id = $(element).attr("taskId");
    // $("#txtIdPedidoDocumentosFact").val(id);

    let id = $("#txtIdPedidoModalDocumentosFacturados").val();
    $("#txtIdPedidoDocumentosFact").val(id);
    
    let folioo = $("#txtFolioModalDocumentosFacturados").val();
    $("#txtFolioModalPanelControl").val(folioo);


    $("#modalPanelControlFactPedido").modal('show');

});

// aquiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
$(document).on('click','#btnDocsFacturados',function() { 
    
    let emisionFactura = $('input[name="emisionFactura"]:checked').val();  
    
    let folio = $("#txtFolioModalPanelControl").val();
    let id = $("#txtIdPedidoDocumentosFact").val();

    let documento = folio.substring(0,1);
    let CotFactura = $("#txtPedidoFact").val();  
    let CotRemision = $("#txtPedidoRem").val();  

    if (emisionFactura == "6040") {
        // alert('seleccionaste 60-40');
        if (documento == "F") {
            if (CotFactura.length > 0 && CotRemision.length == 0) {
                CotFactura = "PR" + getZero(CotFactura);
                updateOrder(folio,id,CotFactura,CotRemision);
            } else {
                alert('Solo ingrese la cotizacion de factura');
            }
        } else if(documento == "R"){
            if (CotFactura.length > 0 && CotRemision.length > 0) {
                CotRemision = "CR" + CotRemision;
                CotFactura = "PR" + getZero(CotFactura);
           
                updateOrder(folio,id,CotFactura,CotRemision);
            } else {
                alert('Ingrese el codigo de la cotizacion de remision y factura');
            }
        }

    } else if (emisionFactura == "9010") {
        // alert('seleccionaste 90-10');
       
    }else if (emisionFactura == "100") {
        // alert('seleccionaste 100 remision');
        
    }
});



function updateOrder(fol,idd,cotFact,cotRem) {
    arrData = [];
    arrData.push('updateOrder');
    arrData.push(fol);
    arrData.push(idd);
    arrData.push(cotFact);
    arrData.push(cotRem);

    // alert('factura'+cotFact);
    // alert('remision'+cotRem);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainDocFacturados.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                // let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                 alert('Se actualizo correctamente');
                             } else {
                                 alert('Operacion Invalida');
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
            if (response != null) {
                // CotFactura = "PR" + getZero(CotFactura);
                return getInfoOrder(idd);
            } else {
                console.log('Fue null');
            }
    })
    
    // .then((response)=>{
        // if (response != null ) {
        // return genXLSPorte(CotRemision,CotFactura,Observacion,order);
        //     return genXLSPorte();
        // }
    // })
    
    .then((response)=>{
        if (response != null) {
            // return getOrder();
            return getDocFacturados();
        } else {
            console.log('getOrder devolvio null');
        }
    }).then((response)=>{
        if (response != null) {
            //return showMovimientos();
        }else{
            console.log('showMovimientos devolvio null');
        }
    })


}



var venddd;
var listaPreciooo;
var foliooo;


 function getInfoOrder(idd) {
    arrData = [];
    arrData.push('getInfoOrder');
    arrData.push(idd);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainDocFacturados.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                 venddd = item.vendedor;
                                 listaPreciooo = item.precioLista;
                                 foliooo = item.folio;
                                 alert('Se obtuvo la informacion correctamente');

                             } else {
                                 alert('Operacion Invalida');
                             }
                             resolve(item.validation);

                            //  alert('este es un vendedor.....'+venddd);
                            //  alert('este es una lista.....'+listaPreciooo);
                            //  alert('este es un folio...'+foliooo);
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
            if (response != null) {
                // genXLSPorte(venddd,listaPreciooo,foliooo);  
                return genXLSPorte(listaPreciooo,foliooo);    
            } else {
                console.log('Devolvio null');
            }
            
        }).then((response)=>{
            if (response == 1) {
                // getOrder(); buscar la funcion para buscar 
            } else if(response == 0){
                console.log('Ocurrio un error inesperado');
            }

        })
 }

 function genXLSPorte(listaPreciooo,foliooo) {

    let id = $("#txtIdPedidoDocumentosFact").val();
    let observacion = $("#txtComentarioDocumentosFact").val();
    let CotFactura = $("#txtPedidoFact").val();
    let CotRemision =$("#txtPedidoRem").val();

    return new Promise((resolve, reject) => {
        try {
            let listaPrecio = listaPreciooo;
            var documento = foliooo;   
            documento = documento.substring(0,1);

            if (documento == "R") {
                var url_script_xls = servidor+"functions/facturacion/reporte/gen.report_xls.inc_cp.php?id=" + id + "&fac=" + CotFactura + "&rem=" + CotRemision + "&comment=" + observacion + "&folio=" + foliooo;
                window.open(url_script_xls);

                var url_script_xls_factura = servidor+"functions/facturacion/reporte/gen.report_xls.factura_cp.php?id=" + id + "&fac=" + CotFactura + "&rem=" + CotRemision + "&comment=" + observacion + "&lp=" + listaPrecio + "&folio=" + foliooo;
                window.open(url_script_xls_factura);

                cartaMaestra(id,"Mixto",listaPrecio);
                // alert('ejecutando algo....');
                resolve(1);
            } else {
                alert("Solo se puede facturar Mixtos");
                resolve(0);
            }

        } catch (error) {
            reject(error);
        }
    })
}

function cartaMaestra(id,doc,lp) {
    // alert('Ejecutando la carta maestra..');
    // var url_report_cotizacion = servidor + "functions/facturacion/reporte/Cotizacion.report.inc.php?id="+ id + "&doc=" + doc + "&lp=" + lp;
    var url_report_cotizacion = servidor + "functions/facturacion/reporte/cotizacion.report.inc.php?id="+ id + "&doc=" + doc + "&lp=" + lp;
    // window.open(url_report_cotizacion,"Orden de Cotizacion: #" + id,"status=1,toolbar=1,menubar=1");
    window.open(url_report_cotizacion);
    return 1;
}

$(document).on('click','#btnVerPedidoModal',function() {

    $("#modalOpcionesDocsFacturados").modal('hide');

    $('#list-docsFacturados-list').removeClass('show active');
    $('#list-docsFacturados').removeClass('show active');
    
    $('#list-checkOutt').addClass('show active');
    $('#list-checkOutt-list').addClass('show active');

    let folio = $("#txtFolioModalDocumentosFacturados").val();

    $("#txtFolioCheckOut").val(folio);

    let folioFill = $("#txtFolioCheckOut").val();

    if (folioFill.length > 5) {
        $("#txtFolioCheckOut").keyup();
    }else{
        alert('Ocurrio un problema al ingresar el folio');
    }

    /*

    $('#list-docsFacturados').removeClass('show active');
    $('#list-checkOutt').addClass('show active');
  
    $("#modalOpcionesDocsFacturados").modal('hide');

    let folio = $("#txtFolioModalDocumentosFacturados").val();

    $("#txtFolioCheckOut").val(folio);

    let folioFill = $("#txtFolioCheckOut").val();

    if (folioFill.length > 5) {
        $("#txtFolioCheckOut").keyup();
    }else{
        alert('Ocurrio un problema al escribir');
    }
    */

});


function getZero(Pedido) {
    let serial = Pedido;
    let longitud = serial.length;
 
   if (longitud == 10) {
        serial = "";
    } else if (longitud == 9) {
        serial = "0";
    } else if (longitud == 8) {
        serial = "00";
    } else if (longitud == 7) {
        serial = "000";
    } else if (longitud == 6) {
        serial = "0000";
    } else if (longitud == 5) {
        serial = "00000";
    } else if (longitud == 4) {
        serial = "000000";
    } else if (longitud == 3) {
        serial = "0000000";
    } else if (longitud == 2) {
        serial = "00000000";
    } else if (longitud == 1) {
        serial = "000000000";
    }
    return serial + Pedido;
}


$(document).on('click','#btnDocsFacturadosReporte',function() {
    let vendedor = $("#txtVendedorGenerarReporte").val();
    let cliente = $("#txtClienteGenerarReporte").val();
    
    let opciones = $("#selectOpcionesGenerarReporte").val();
    let desde = $("#dateDesdeReportFactPedido").val();
    let hasta = $("#dateHastaReportFactPedido").val();
    

    if (opciones > 1 || opciones < 1 || desde != "" || hasta != "") {
        if (desde.length == 0) {
            desde = null;    
        }

        if (hasta.length == 0) {
            hasta = null;
        }

        var reportt = servidor + "functions/facturacion/reporte/genReportPedidos.php?fechaInicio=" + desde + "&fechaFinal=" + hasta + 
        "&cliente=" + cliente + "&vendedor=" + vendedor + "&factura=" + factura + "&remision=" + remision;

        window.open(reportt,'Reporte General de cobranza',"status=1,toolbar=1,menubar=1");

        // var reporte = servidor + "/functions/facturacion/facturas/genReportPedidos.php?fechaInicio="
        //     + fechaInicio + "&fechaFinal=" + fechaFinal + "&cliente=" + cliente + "&vendedor=" + vendedor;
        // window.open(reporte, 'Reporte General de cobranza', "status=1,toolbar=1,menubar=1");

    } else {
        alert("Se requiere un rango de fecha");
    }
});


function getVendedor() {
    arrData = [];
    arrData.push('getVendedores');

    return new Promise(function (resolve, reject) {
        $.ajax({
            // url: "../../functions/administrador/crudMunicipio.php",
            url:"../../functions/facturacion/mainDocFacturados.php",
            type: "GET",
            data: { arrData },
            success: function (response) {
                let result = JSON.parse(response);
                // let template = "";
                // $('#txtVendedorGenerarReporte').empty();
                result.forEach((data) => {
                    let validation = data.validation;
                    let message = data.message;

                    if (validation == 1) {
                        $('#txtVendedorGenerarReporte').append($('<option>', {
                            value: data.clasificacion,
                            text: data.usuario
                        }))                      
                    } else {
                        $('#txtVendedorGenerarReporte').append($('<option>', {
                            value: 'Sin Resultados',
                            text: 'Sin Resultados'
                        }))
                    }
  
                    resolve(message);

                    
                })
                // $("#tbModulos").html(template);
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                alert(XMLHttpRequest);
                alert(errorThrown);
                reject(txtStatus);
            }
        });
    })
}


$(document).on('change','#txtVendedorGenerarReporte',function() {
    $('#txtClienteGenerarReporte').empty();
    let sellerSelect = $(this).val();
    // alert(sellerSelect);

    arrData = [];
    arrData.push('getClientBySeller');
    arrData.push(sellerSelect);

    getClientBySeller(arrData);
});

function getClientBySeller(arrData) {
    // alert('ejecutando funcion');
    
    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainDocFacturados.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                // let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                // alert(item.cliente);
                                $('#txtClienteGenerarReporte').append($('<option>', {
                                    value: item.idCliente,
                                    text: item.cliente
                                }))  
                             } else {
                                $('#txtClienteGenerarReporte').append($('<option>', {
                                    value: 'Sin Resultados',
                                    text: 'Sin Resultados'
                                }))  
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