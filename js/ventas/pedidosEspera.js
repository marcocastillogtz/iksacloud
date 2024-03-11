$(document).ready(function () {
    console.log('Pedidos Espera');
    showPedidosEspera();
});

function showPedidosEspera() {
    arrData=[];
    arrData.push('showPedidosEspera');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/ventas/mainPedidosEspera.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                    let formatMoney = Intl.NumberFormat('en-US');
                                    let dias = item.dias;
                                    let horas = item.horas;
                                    let comentario = item.observacion;
                                    let total = item.monto;

                                    if (comentario == null || comentario == "") {
                                        comentario = "-";
                                    }
                                    
                                    if (total == 0) {
                                        total = "-";
                                    } else {
                                        total = formatMoney.format(total);
                                    }

                                    template += `<tr taskId="1">
                                        <th>${item.id}</th>
                                        <td>${item.cliente}</td>
                                        <td>${item.vendedor}</td>
                                        <td>${item.fecha}</td>
                                        <td>${item.hora}</td>
                                        <td class="text-end">${total}</td>
                                        <td>${comentario}</td>
                                        <td>${dias} dias y ${horas} hrs</td>
                                    </tr>`;

                             } else {
                                 template +=`<tr>
                                                <td class="align-middle text-center" colspan="8"><h5 class="text-primary">No hay más pedidos <i class="fa-solid fa-face-laugh-beam"></i></h5></td>
                                            </tr>`;

                             }
                             
                        }); 
                        resolve(item.validation);
                        $("#item_pedidos_espera").html(template);
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
                $("#spinnerTablePedidosEspera").hide();
                console.log('Se recupero informacion de la base de datos');
            } else {
                $("#spinnerTablePedidosEspera").hide();
                console.log('No se obtubo informacion');
            }
    })

}