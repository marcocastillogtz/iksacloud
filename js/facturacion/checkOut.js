$(document).ready(function () {
    console.log('checkOut');
    getPedidoProgress();
});  

var arrData = [];
var claveValores = [];
var timeoutId;


function getPedidoProgress() {
    arrData=[];
    arrData.push('getPedidoProgress');

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainCheckOut.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                //  alert('Se realizo la operacion correctamente');
                                let porcentaje = item.porcentaje;
                                porcentaje = Math.floor(porcentaje);

                                var bg_progress = "";

                                if (porcentaje < 50) {
                                    bg_progress = 'bg-danger';
                                } else if (porcentaje > 51 & porcentaje < 74) {
                                    bg_progress = 'bg-warning';
                                } else if (porcentaje > 75 & porcentaje < 89) {
                                    bg_progress = 'bg-primary';
                                } else if (porcentaje > 90) {
                                    bg_progress = "bg-success";
                                }

                                template += `<tr taskId="${item.id}" percentaje="${item.porcentaje}" taskUser="${item.user}">
                                    <th class="align-middle text-center">${item.id}</th>
                                    <td class="align-middle text-center">${item.almacen}</td>
                                    <td class="align-middle text-center">${item.usuario}</td>
                                    <th class="align-middle text-center"> 
                                    <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar ${bg_progress}" style="width: ${porcentaje}%">${porcentaje}%</div>
                                    </div></th>
                                </tr>`;

                             } else {
                                template += `<tr>
                                    <th colspan="5" class="align-middle text-center">No hay más por el momento.</th>
                                </tr>`;
                             }
                             $("#tablePedidoProgress").html(template);
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
                $("#spinnerTablePedidosProgress").hide();
            } else {
                console.log('No se ocultara el spinner');
            }
    })


}

$(document).on("keyup", "#txtFolioCheckOut", function () {
    $("#txtFolioCheckOut").focus();
    let serial = $("#txtFolioCheckOut").val();
    let longitud = serial.length;

    // setTimeout(() => {
    //     if (longitud >= 13 ) {
    //         getOrder(serial);
    //     } else {
    //         alert('El folio es incorrecto');
    //     }
    // }, 2000);
    
    clearTimeout(timeoutId);

    if (longitud >= 13) {
        timeoutId = setTimeout(function (){
            getOrderByFolioCheckout(serial);
        },2000);
    } else {
        alert('El folio es incorrecto');
    }
   
});


// function getOrder(serial){
//     if(document.cookie.indexOf("getOrder")>=0){

//     }else{
//         alert("folio "+serial);
//         document.cookie = "getOrder=true";
//     }
// }


function getOrderByFolioCheckout(serial) {
    arrData = [];
    arrData.push('getOrderByFolioCheckout');
    arrData.push(serial);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainCheckOut.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                if (item.agregados == null) {
                                    item.agregados=0;
                                } else {
                                    item.agregados;
                                }
                                 if (item.estatus == "AG") {
                                    template += `
                                    <tr class="table-warning">
                                        <td class="h5 text-center" style="font-weight: bold;">${item.cantidad}</td>
                                        <td class="text-primary">${item.clave}</td>
                                        <td>${item.descripcion}</td>
                                        <td class="h5 text-center" style="font-weight: bold;">${item.agregados}</td>
                                    <tr>`;

                                 } else {
                                    template += `
                                    <tr>
                                        <td class="h5 text-center" style="font-weight: bold;">${item.cantidad}</td>
                                        <td class="text-primary">${item.clave}</td>
                                        <td>${item.descripcion}</td>
                                        <td class="h5 text-center" style="font-weight: bold;">${item.agregados}</td>
                                    <tr>`;    
                                 }

                                $("#txtPedidoCheckOut").val(item.id_detalle);
                                $("#txtClienteCheckOut").val(item.cliente);

                             } else {
                                template += `
                                <tr>
                                    <td class="h5 text-center" style="font-weight: bold;">Sin Resultados :(</td>
                                <tr>`;
                             }
                             $("#tablePedidoCheckOut").html(template);
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
                $("#spinnerTablePedidosCheckOut").hide();
            } else {
            }
    })

}


$(document).on("keyup", "#txtClaveCheckOut", function () {
    let clavve = $(this).val();
    var longitud = clavve.length;

    if (longitud > 0 && longitud <= 10) {
        seekey();
    } 
    // else {
    //     alert("Error desconocido");
    // }
});


var var_agregado;
var res=404;

function seekey() {
    var isPaquete;
     
    let folio = $("#txtFolioCheckOut").val();
    let clavee = $("#txtClaveCheckOut").val();
    clavee = $.trim(clavee);
    clavee = clavee.replaceAll(/'/g, "-");

    let longitud = clavee.length;
    let charP = clavee.charAt(9);
    let compare = "P";
    let n = charP.localeCompare(compare);

    if (longitud == 10 && n == 0) {
        isPaquete = 0;
        let paquete = clavee.substring(0,9);
        clavee = paquete;
    } else if(longitud == 9 && n == -1){
        isPaquete = 1;
    } 
    arrData=[];
    arrData.push('seeKey');
    arrData.push(folio);
    arrData.push(clavee);
    arrData.push(isPaquete);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainCheckOut.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                // let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                var var_respuesta = item.respuesta;
                                var var_requerido = item.requerido;
                                var var_restante = item.restante;
                                var var_ingresado = item.ingresado;
                                var_agregado = item.agregado;
                                var var_clave = item.clave;
                                var var_folio = item.folio;
                                var var_paquete = item.paquete;
                                var var_pieza = item.pieza;

                                if (var_respuesta == 'insert') {
                                    playSoundAlert('sound1');
                                    $("#modalCheckOutExistenciaProducto").modal('show');
                                    res = 1;
                                } else if(var_respuesta =='update'){
                                    playSoundAlert('sound1');
                                    $("#modalCheckOutUpdateExistenciaProducto").modal('show');
                                    res = 2;
                                }else if(var_respuesta == 'success'){
                                    alert("Se actualizo la informacion");
                                    res = 3;
                                }else {
                                    alert("Ocurrio un error fuera de nuestra comprension");
                                    res = 0;
                                }
                             } else {
                                 alert('Operacion Invalida');
                             }
                            //  resolve(item.validation);
                            resolve(res);
                            
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
                console.log('Se abrio el modal para añadir un item');
                res=404;
            } else if (response == 2){
                console.log('Se abrio un modal para actualizar un item');
                res=404;
            } else if (response == 3) {
                $("#txtClaveCheckOut").val('');
                let serial = $("#txtFolioCheckOut").val();
                let longitud = serial.length;

                    if (longitud >= 13) {
                        getOrderByFolioCheckout(serial);
                    } else {
                        alert('El folio es incorrecto');
                    }
                    res=404;
                console.log('Se desconto las piezas correctamente');
            }else{
                console.log('El servidor respondio inesperadamente');
            }            
    })
}

function playSoundAlert(sound) {
    const music = new Audio('../../sound/' + sound + '.wav');
    music.play();
}

$(document).on("click", "#btnGuardarExistenciaProductoModal", function () {
    let thisId = $("#txtPedidoCheckOut").val();
    getExistenciaProducto(thisId);
});
var var_vendedor = 0;
var var_folio_global = '';

function getExistenciaProducto(param) {
    arrData=[];
    arrData.push('getExistenciaProducto');
    arrData.push(param);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainCheckOut.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                var_vendedor = item.vendedor;
                                var_precio_lista = item.precioLista;
                                var_folio_global = item.folio;
                                resolve(var_folio_global);
                             } else {
                                 console.log('No se obtuvo ningun resultado');
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
            if (response != null) {
                console.log('Ejecutando catalogo....');
                return catalogo(var_precio_lista);
            } else {
                console.log('Fue null');
           }
    }).then((response) =>{
        let vali = response[0];
        // console.log('validacion...'+vali);
        if (vali == 1) {
            console.log('Ejecutando agregarItem...');
            return agregarItem(response);
        } else if(vali == -1){
            playSoundAlert('sound1');
            alert('Este producto no existe');
        }

    })

}

var arrDataCatalo = [];

function catalogo(var_precio_lista){
    var_precio_lista
    let folio = $("#txtFolioCheckOut").val();
    let clave = $("#txtClaveCheckOut").val();
    clave = clave.replaceAll(/'/g, "-");
    clave = clave.substring(0,9);

    arrData=[];
    arrData.push('catalogo');
    arrData.push(var_precio_lista);
    arrData.push(clave);
    

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainCheckOut.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = "";
                     item.forEach((item) => {
                             if (item.validation == 1) {

                                arrDataCatalo = [];
                                
                                // arrDataCatalo.push('agregarItem');

                                arrDataCatalo.push(item.validation); // 0
                                arrDataCatalo.push(item.listaPrecio); // 1
                                arrDataCatalo.push(item.clave); // 2
                                arrDataCatalo.push(item.descripcion); // 3
                                arrDataCatalo.push(item.precio); // 4
                                arrDataCatalo.push(item.imagen); // 5
                                arrDataCatalo.push(item.precioEspecial); // 6
                                arrDataCatalo.push(item.ventaMinima); // 7
                                arrDataCatalo.push(item.familiaVenta); // 8
                                arrDataCatalo.push(item.statusVenta); // 9
                                arrDataCatalo.push(item.precioVenta); // 10 
                                arrDataCatalo.push(item.restrinccion); //11
                                arrDataCatalo.push(item.paquete); //12
                                arrDataCatalo.push(var_precio_lista);//13   /* no es lo mismo que  item.listaPrecio ?????? */
                                
                                
                             } else {
                                 alert('Operacion Invalida')
                             }
                             resolve(arrDataCatalo);
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


function agregarItem(arrData) {
    // alert('ejecutando agregarItem...');
    /*
    var doc = var_folio_global.substring(0,1);

    if (doc == "F") {
        doc = "Factura";   
    } else if (doc == "R") {
        doc = "Remision"
    }

    arrData.push(var_vendedor);
    arrData.push(doc);
    */
//    alert(var_vendedor);

    let clv = "";

    clv = $("#txtClaveCheckOut").val().substring(0,9);
    clv = clv.replaceAll(/'/g, "-");

    // let descripcion = arrData[4];
    let descripcion = arrData[3];
    let cantidad = var_agregado;
    let cliente = $("#txtClienteCheckOut").val();

    // let monto = var_agregado * arrData[5];
    let monto = var_agregado * arrData[4];
    // let precio  = arrData[5];
    let precio  = arrData[4];

    let doc = var_folio_global.substring(0,1);
    
    if (doc == "F") {
        doc = "Factura";
    } else if(doc == "R"){
        doc = "Remision";
    }

    // let restrinccion = arrData[12];
    // let familiaOferta = arrData[9];
    
    let restrinccion = arrData[11];
    let familiaOferta = arrData[8];
    let estatusOferta = arrData[9];

    let pedido = $("#txtPedidoCheckOut").val();
    // let listaPrecio = arrData[14];
    let listaPrecio = arrData[13];

    arrData = [];
    arrData.push("agregarItem"); // 0
    arrData.push(var_vendedor); //1
    arrData.push(clv);  //2
    arrData.push(descripcion); //3
    arrData.push(cantidad); //4
    arrData.push(cliente);  //5
    arrData.push(monto); //6
    arrData.push(precio);   //7
    arrData.push(doc);  //8
    arrData.push(restrinccion); //9
    arrData.push(familiaOferta);    //10
    arrData.push(pedido);   //11
    arrData.push(listaPrecio);  //12
    arrData.push(var_folio_global);//13
    arrData.push(estatusOferta);//14

    /*
    alert('este es el vendedor..'+var_vendedor);
    alert('esta es la clave...'+clv);
    alert('esta es la descripcion..'+descripcion);
    alert('esta es la cantidad..'+cantidad);
    alert('este es la cliente..'+cliente);
    alert('este es el monto..'+monto);
    alert('este es el precio..'+precio);
    alert('este es el documento..'+doc);
    alert('esta es la restrinccion'+restrinccion);
    alert('esta es la familia..'+familiaOferta);
    alert('este es el pedido...'+pedido);
    alert('esta es la lista de precios..'+listaPrecio);
    alert('este es el folio...'+var_folio_global);
    alert('este es un estatus..'+estatusOferta);
    */

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainCheckOut.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = "";
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                 alert('Se inserto correctamente la producto');
                             } else {
                                 alert('Ocurrio un problema al insertar el producto')
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
                $("#modalCheckOutExistenciaProducto").modal('hide');           
                return 1;
            } else {
                console.log('No se cerrara el modal');
                return 0;
            }
    }).then((response)=>{
        if (response == 1) {
            $("#txtClaveCheckOut").val('');
            let serial = $("#txtFolioCheckOut").val();
            let longitud = serial.length;

            if (longitud >= 13) {
                    getOrderByFolioCheckout(serial);
            } else {
                alert('El folio es incorrecto');
            }

        } else {
            console.log('No se actualizo la tabla por que no sufrio ningun cambio');
        }
    })

}

var user = null;

$(document).on("click", "#btnAvisarCheckOut", function () {
    let folio = $("#txtFolioCheckOut").val();

    takeOrder(folio);
});

function takeOrder(fol) {
    user = localStorage.getItem("user");
    
    arrData = [];
    arrData.push('takeOrder');
    arrData.push(user);
    arrData.push(fol);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainCheckOut.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                let item = JSON.parse(response);
                let template = " ";
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
            } else {
            }
    })


}

$(document).on("click", "#btnDevolucionCheckOut", function () {
    claveValores = [];
    document.getElementById("updateArray").innerHTML = '';
    
    // $('#txtClaveDevolucionModal').focus();

    $("#modalDevolucion").modal('show');
    $("#txtClaveDevolucionModal").focus();
});

$(document).on("keyup", "#txtClaveDevolucionModal", function () {

    this.value = this.value.toUpperCase();

    let value = $(this).val();
    let valueUpper = value.toUpperCase();

    // claveValores = []; // talvez si talvez no
    // setTimeout(getPromise(valueUpper),1000); 

/*
        if (valueUpper.length > 8) {
            return new Promise((resolve, reject) => {
                setTimeout(getPromise(valueUpper),1000);    

        }).then((response)=>{
            
            if (response == 1) {
                $("#txtClaveDevolucionModal").val("");
                $("#modalAdministradorPanel").modal('hide');
                $("#modalDevolucion").modal('hide');
            } else {
                $("#txtClaveDevolucionModal").val("");
                $("#modalAdministradorPanel").modal('hide');
                $("#modalDevolucion").modal('hide');
            }

        })
    }

*/
    let cantidad = 0;
    let clave = valueUpper.replaceAll("'","-");

    
    if (clave.length > 8) {
        //setTimeout(() => {
            return new Promise((resolve, reject) => {
                    if (clave.length < 8) {
                        alert('La clave es incorrecta');
                        resolve(0);
                    }else if(clave.length == 9){
                        // claveValores = [];
                        cantidad = 1;
                        claveValores.push({key:clave, cant: cantidad});
                        getArray(claveValores);
                        resolve(1);
                    }else if(clave.length == 10){
                        // claveValores = [];
                        clave = clave.substring(0, 9);
                        getPackage(clave).then((data) =>{
                            if (data > 0) {
                                cantidad = data;
                                claveValores.push({key:clave, cant:cantidad});
                                getArray(claveValores);
                                resolve(1);
                            } else {
                                alert('No existe registro de esta clave');
                                resolve(0);
                            }
                        })
                    }
                }).then((response)=>{
                    if (response == 1) {
                        $("#txtClaveDevolucionModal").val("");
                    } else {
                        $("#txtClaveDevolucionModal").val("");
                    }
            })
        
       // }, 1000);
    }   
});

/*
function getPromise(val) {
    let cantidad = 0;
    let clave = val.replaceAll("'","-");

    return new Promise((resolve, reject) => {

        if (clave.length < 8) {
            alert('La clave es incorrecta');
            resolve(0);
    
        } else if(clave.length ==  9){
            cantidad = 1;
            claveValores.push({key: clave, cant: cantidad});
            getArray(claveValores);
            resolve(1);
    
        }else if(clave.length == 10){
            clave = clave.substring(0, 9);
            getPackage(clave).then((data)=>{
                if (data > 0) {
                    cantidad = data;
                    claveValores.push({key:clave, cant:cantidad});
                    getArray(claveValores);
                    resolve(1);
                } else {
                    alert('No existe registro  de esta clave');
                }
            })
        }
    }).then((resolve)=>{
        if (resolve == 1) {
            $("#txtClaveDevolucionModal").val("");
        } else if(resolve == 0){
            $("#txtClaveDevolucionModal").val("");
        }
    })
}
*/

function getPackage(clavee) {
    arrData=[];
    arrData.push('getPackage');
    arrData.push(clavee);
    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainCheckOut.php",
            type:"GET",
            data: { arrData},
            success: function (response) {
                let item = JSON.parse(response);
                     item.forEach((item) => {
                             if (item.validation == 1) {
                                resolve(item.cantidad);
                             } else {
                                alert('Ocurrio un problema')
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
    })
}

function getArray(claveValores) {
    document.getElementById("updateArray").innerHTML = JSON.stringify(claveValores);
    return 1;
}

$(document).on("click", "#btnGuardarDevolucionModal", function () {
    $("#modalAdministradorPanel").modal('show');
});


$(document).on("click", "#btnIniciarSesionAdminPanel", function () {
    let pass12 = $("#txtPassDevolucionModal").val();
    if (pass12.length > 7) {
       let password = "KgomzMontoya";
       pass12 = pass12.replaceAll('""', "@");
       
       if (!pass12) {
            alert("Debes escribir una contraseña");
       }

       if(pass12 != password){
            alert("La contraseña es incorrecta");
       } else {
            ExecuteDevolucion();
       }

    } else {
        alert("A ocurrio un problema");
    }
});


function ExecuteDevolucion() { 
    // alert('executeee....');
    let npedido = $("#txtFolioCheckOut").val(); 
    //alert(JSON.stringify(claveValores));

    // for (let i = 0; i < claveValores.length; i++) {
    //     console.log(claveValores[i]);
    //     alert(JSON.stringify(claveValores[i]));
    // }

    arrData = [];

    // claveValores.findIndex(function(el){
    //     arrData.push('executeDevolucion');
    //     arrData.push(npedido);
    //     arrData.push(el.key);
    //     arrData.push(el.cant);

    // });

    arrData.push('executeDevolucion');
    arrData.push(npedido);
    arrData.push(claveValores);
    
    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainCheckOut.php",
            type:"GET",
            data: { arrData },
            success: function (response) {
                 let item = JSON.parse(response);
                     item.forEach((item) => {
                            if (item.validation == 1) {
                                
                                if (item.response  == 2 )    {
                                    $("#txtClaveDevolucionModal").val('');
                                    $("#updateArray").html('');
                                } else if(item.response == 1){
                                    $("#txtClaveDevolucionModal").val('');
                                    $("#updateArray").html('');
                                }else{
                                    console.log('Ocurrio un error');
                                }
                                
                            //    alert('esta es la validacion..' + item.validation);
                            //    alert('esta es la respuesta..' + item.response);
                            } else {
                                console.log('La respuesta fue invalida');
                            }
                            resolve(item.response);

                        });
                        
                        // resolve(item.response);
                    },
                 error: function (XMLHttpRequest, txtStatus, errorThrown) {
                        alert("Request: "+XMLHttpRequest);
                        alert("Estatus: "+txtStatus);
                        alert("Error: "+errorThrown);
                },
        });

    }).then((response)=>{
        if (response == 1) {
            $("#modalAdministradorPanel").modal('hide');
            $("#modalDevolucion").modal('hide');
            $("#updateArray").val();
            // claveValores = [];
            return 1;
        }else if(response == 2){
            console.log('Se devolvio correctamente la pieza');
            $("#modalAdministradorPanel").modal('hide');
            $("#modalDevolucion").modal('hide');

            $("#updateArray").val();
            // claveValores = [];
            return 0;
        } else {
            console.log('Otra Tarea');
        }
    }).then((response)=>{
        if (response == 1) {
            let folioo = $("#txtFolioCheckOut").val();
            getOrderByFolioCheckout(folioo);
        } else if(response == 2){
            let foliooo = $("#txtFolioCheckOut").val();
            getOrderByFolioCheckout(foliooo);
        }else{
            alert('No se actualizara la tabla');
        }
    })

}


    /*
    arrData = [];
    arrData.push('executeDevolucion');
    arrData.push(npedido);
    arrData.push(claveValores);

    return new Promise((resolve, reject) => {
        $.ajax({
            url:"../../functions/facturacion/mainCheckOut.php",
             type:"GET",
             data: { arrData },
             success: function (response) {
                 let item = JSON.parse(response);
                 let template = " ";
                     item.forEach((item) => {
                            if (item.validation == 1) {
                                
                            } else {
                                
                            }
                            resolve(item.validation);
                        }); 
                    },
                 error: function (XMLHttpRequest, txtStatus, errorThrown) {
                        alert("Request: "+XMLHttpRequest);
                        alert("Estatus: "+txtStatus);
                        alert("Error: "+errorThrown);
                },
        });
    })
    */