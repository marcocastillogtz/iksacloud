$(document).ready(function () {
    console.log('relacion de documentos');

    // getClienteRelacionDoc();
    getBancoRelacionDoc();
    getRelacionDoc();
});

function getBancoRelacionDoc() {
    arrData = [];
    arrData.push('getBancoRelacionDoc');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainRelacionDoc.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                $('#selectBancoRelacionDocumentos').append($('<option>', {
                                    value: item.idBanco,
                                    text: item.descBanco    
                                }))     
                             } else {
                                $('#selectBancoRelacionDocumentos').append($('<option>', {
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
        }).then((response)=>{
            if (response == 1) {
            } else {
            }
    })

}

/*
function getClienteRelacionDoc() {
    arrData=[];
    arrData.push('getClienteRelacionDoc');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainRelacionDoc.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                // let template = "";
                     item.forEach((item) => {
                        if (item.validation == 1) {
                            // alert(item.cliente);
                            $('#selectClienteRelacionDocumentos').append($('<option>', {
                                value: item.cliente,
                                text: item.cliente
                            }))                      
                        } else {
                            $('#selectClienteRelacionDocumentos').append($('<option>', {
                                value: 'Sin Resultados',
                                text: 'Sin Resultados'
                            }))
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
*/

$(document).on('click','#btnBuscarRelacionDocumentos',function() {
    let banco = $("#selectBancoRelacionDocumentos").val();
    let desde = $("#txtDesdeRelacionDocumentos").val();
    let hasta = $("#txtHastaRelacionDocumentos").val();


    arrData=[];
    arrData.push('searchPedidoRelationDocs');
    arrData.push(banco);
    arrData.push(desde);
    arrData.push(hasta);

    // alert('este es el banco..' + banco);
    // alert('este es la primera fecha..'+ desde);
    // alert('este es la segunda fecha..'+ hasta);

    searchPedidoRelationDocs(arrData);
});


function searchPedidoRelationDocs(arrData) {
    
    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainRelacionDoc.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                template += `<tr taskId="${item.id}"  taskFolioo="${item.folio}">
                                    <th class="align-middle text-center">${item.id}</th>
                                    <td class="align-middle text-center">${item.metodo_envio}</td>
                                    <td class="align-middle text-center">${item.folio}</td>
                                    <td class="align-middle text-center">${item.layout_r}</td>
                                    <td class="align-middle text-center">${item.layout_f}</td>
                                    <td class="align-middle text-center">${item.documento}</td>
                                    
                                    <td class="align-middle text-center">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Selecciona una Opcion</option>
                                            <option value="Activo">Activo</option>
                                            <option value="Emitida">Emitida</option>
                                            <option value="Dev.Total">Dev.Total</option>
                                            <option value="Dev.Parcial">Dev.Parcial</option>
                                            <option value="Cancelada">Cancelada</option>
                                        </select>
                                    </td>
                                    
                                </tr>`;

                             } else {
                                template += `<tr>
                                    <th class="align-middle text-center" colspan=7 > <h3> Sin Resultados </h3> </th>
                                </tr>`;
                             }
                             $("#pedidosRelacionDocumentos").html(template);
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

function getRelacionDoc() {
    arrData=[];
    arrData.push('getRelacionDocs');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainRelacionDoc.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {

                                template += `<tr taskId="${item.id}"  taskFolioo="${item.folio}">
                                <th class="align-middle text-center">${item.id}</th>
                                <td class="align-middle text-center">${item.metodo_envio}</td>
                                <td class="align-middle text-center">${item.folio}</td>
                                <td class="align-middle text-center">${item.layout_r}</td>
                                <td class="align-middle text-center">${item.layout_f}</td>
                                <td class="align-middle text-center">${item.documento}</td>
                                
                                <td class="align-middle text-center">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Selecciona una Opcion</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Emitida">Emitida</option>
                                        <option value="Dev.Total">Dev.Total</option>
                                        <option value="Dev.Parcial">Dev.Parcial</option>
                                        <option value="Cancelada">Cancelada</option>
                                    </select>
                                </td>
                                
                            </tr>`;
                             } else {
                                 alert('Operacion Invalida')
                             }
                             
                            $("#pedidosRelacionDocumentos").html(template);
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
                $("#spinnerTableRelacionDocs").hide('false');
            } else {
            }
    })


} 