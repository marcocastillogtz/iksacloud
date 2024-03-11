$(document).ready(function () {
    var verison = "1.0.19";
    console.log(verison)
    hiddeLoadButton();
    // arrToast.push("Mensaje para el toast Hola Perla")
    // arrToast.push(icon_success)
    // showToastCte(arrToast);
});

var data = [];
var currentPage = 1;
var itemsPerPage = 6;
var accion = "insert";
var response_err = 0;
var arrToast = [];
var icon_success = "../../img/iconos/x16/check.png";
var icon_error = "../../img/iconos/x16/error.png";
var icon_info = "../../img/iconos/x16/idea.png";
var idEsquema = 0;
// Funciones
function getMunicipio(data, action) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "../../functions/administrador/crudMunicipio.php",
            type: "GET",
            data: { data, action },
            success: function (response) {
                let result = JSON.parse(response);
                let template = "";
                $('#municipio_select').empty();
                result.forEach((data) => {
                    let validation = data.validation;
                    let message = data.message;

                    if (action == 'insert' || action == 'update' || action == 'delete') {
                        resolve(message);
                    } else if (action == 'read' || action == "read_id") {

                        $('#municipio_select').append($('<option>', {
                            value: data.id,
                            text: data.name
                        }))
                        resolve(message);

                    }
                })
                $("#tbModulos").html(template);
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                reject(txtStatus)
            }
        });
    })
}

function getPoblacion(data, action) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "../../functions/administrador/crudPoblacion.php",
            type: "GET",
            data: { data, action },
            success: function (response) {
                let result = JSON.parse(response);
                let template = "";
                $('#poblacion_select').empty();
                result.forEach((data) => {
                    let validation = data.validation;
                    let message = data.message;

                    if (action == 'insert' || action == 'update' || action == 'delete') {
                        resolve(message);
                    } else if (action == 'read' || action == "read_id") {

                        $('#poblacion_select').append($('<option>', {
                            value: data.id,
                            text: data.name
                        }))
                        resolve(message);

                    }
                })
                $("#tbModulos").html(template);
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                reject(txtStatus)
            }
        });
    })
}

function crudClientes(array, action) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "../../functions/administrador/crudClientes.php",
            type: "GET",
            data: { data: array, action },
            success: function (response) {
                let result = JSON.parse(response);
                let template = "";
                let pagination = "";
                result.forEach((resultdata) => {
                    if (resultdata.action != "none") {
                        if (resultdata.validation == 0) {
                            template += `<tr taskId="0">
                            <th colspan="26" class="table text-center">${resultdata.message}</th>
                            </tr>`;
                            currentPage = 1;
                            resolve(resultdata.message + ',' + resultdata.validation)
                        } else {
                            if (resultdata.action == "insert") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read") {
                                resultdata.table.forEach((table) => {
                                    if (table.validation == 1) {
                                        let x = table.counter;
                                        let dollar = new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'USD'
                                        })
                                        let day_limit = table.f25;
                                        let credit = dollar.format(table.f26);

                                        if (table.f26 == 0) {
                                            credit = "-";
                                        }
                                        if (day_limit == 0) {
                                            day_limit = "-";
                                        }


                                        template += `<tr taskId="${table.f1}">
                                    <td class="text-center"><button type="button" class="btn btn-primary btn-sm" id="btnEditCte"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" id="btnDeleteCte"><i class="fa-solid fa-trash-can"></i></button></td>
                                    <th class="text-end clmCve" id="clmCve_${x}">${table.f1}</th>
                                    <td class="text-start clmName" id="clmName_${x}">${table.f3}</td>
                                    <td class="text-start">${table.f4}</td>
                                    <td class="text-start">${table.f5}</td>
                                    <td class="text-start">${table.f6}</td>
                                    <td class="text-start">${table.f7}</td>
                                    <td class="text-start">${table.f8}</td>
                                    <td class="text-start">${table.f9}</td>
                                    <td class="text-end">${table.f10}</td>
                                    <td class="text-start">${table.f11}</td>
                                    <td class="text-end">${table.f12}</td>
                                    <td class="text-end">${table.f13}</td>
                                    <td class="text-start">${table.f14}</td>
                                    <td class="text-start">${table.f15}</td>
                                    <td class="text-start">${table.f16}</td>
                                    <td class="text-start">${table.f17}</td>
                                    <td class="text-start">${table.f18}</td>
                                    <td class="text-start">${table.f19}</td>
                                    <td class="text-start">${table.f20}</td>
                                    <td class="text-end">${table.f21}</td>
                                    <td class="text-start">${table.f22}</td>
                                    <td class="text-start">${table.f23}</td>
                                    <td class="text-start">${table.f24}</td>
                                    <td class="text-end">${day_limit}</td>
                                    <td class="text-end">${credit}</td>
                                    </tr>`;

                                    }

                                });
                                resultdata.pages.forEach((info_page) => {
                                    pagination += `<li class="page-item ${info_page.active}"><a class="page-link" href="#" data-page="${info_page.page}" taskPag="Tskclientes">${info_page.page}</a></li>`;

                                })
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read_id") {
                                // Se vuelve a vaciar el array para llenarla de nuevo con los nuevos valores
                                data = [];
                                data.push(resultdata.res_0)
                                data.push(resultdata.res_1)
                                data.push(resultdata.res_2)
                                data.push(resultdata.res_3)
                                data.push(resultdata.res_4)
                                data.push(resultdata.res_5)
                                data.push(resultdata.res_6)
                                data.push(resultdata.res_7)
                                data.push(resultdata.res_8)
                                data.push(resultdata.res_9)
                                data.push(resultdata.res_10)
                                data.push(resultdata.res_11)
                                data.push(resultdata.res_12)
                                data.push(resultdata.res_13)
                                data.push(resultdata.res_14)
                                data.push(resultdata.res_15)
                                data.push(resultdata.res_16)
                                data.push(resultdata.res_17)
                                data.push(resultdata.res_18)
                                data.push(resultdata.res_19)
                                data.push(resultdata.res_20)
                                data.push(resultdata.res_21)
                                data.push(resultdata.res_22)
                                data.push(resultdata.res_23)
                                data.push(resultdata.res_24)
                                data.push(resultdata.res_25)
                                resolve(resultdata.message + ',' + resultdata.validation)
                            } else if (resultdata.action == "update") {
                                resolve(resultdata.message + ',' + resultdata.validation)
                            } else if (resultdata.action == "delete") {
                                resolve(resultdata.message + ',' + resultdata.validation)
                            }
                        }
                    } else {
                        resolve(resultdata.message + ',' + resultdata.validation)
                    }
                    1
                })

                if (action == "read") {
                    $("#tbClients").html(template);
                    $('.pagination').html(pagination);
                }

            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                reject(txtStatus)
            }
        });
    })
}

function getData() {
    data.push($('#idCliente').val())
    data.push($('#estatus_select_client').val())
    data.push($('#txt_nombre_cliente').val())
    data.push($('#txt_telefono').val())
    data.push($('#txt_email').val())
    data.push($('#estados_select').val())
    data.push($('#municipio_select').val())
    data.push($('#poblacion_select').val())
    data.push($('#clasificacion_select option:selected').text())
    data.push($('#txt_texto').val())
    data.push($('#select_mdv').val())
    data.push($('#select_lp_remision').val())
    data.push($('#select_lp_factura').val())
    data.push($('#select_com_remision').val())
    data.push($('#select_com_factura').val())
    data.push($('#txt_rfc').val())
    data.push($('#select_mdp').val())
    data.push($('#select_cfdi').val())
    data.push($('#select_lp_alterna').val())
    if ($('#check_lpa').is(":checked")) {
        data.push("Original")
    } else {
        data.push("Alterna")

    }
    if ($('#check_doc_fiscal').is(":checked")) {
        data.push("Remision")
    } else {
        data.push("Factura")
    }
    if ($('#check_auth').is(":checked")) {
        data.push("1")
    } else {
        data.push("0")
    }
    data.push($('#select_Banco_client').val())
    data.push($('#txt_cuenta_cliente').val())
    data.push($('#txt_limite_dias').val())
    data.push($('#txt_limite_credito').val())
    return data;
}

function setData() {

    $('#idCliente').val(data[0])
    $('#estatus_select_client').val(data[1])
    $('#txt_nombre_cliente').val(data[2])
    $('#txt_telefono').val(data[9])
    $('#txt_email').val(data[4])
    $('#estados_select').val(data[6])
    $('#clasificacion_select').val(data[10])
    $('#txt_texto').val(data[10])
    $('#select_mdv').val(data[17])
    $('#select_lp_remision').val(data[11])
    $('#select_lp_factura').val(data[12])
    $('#select_com_remision').val(data[15])
    $('#select_com_factura').val(data[16])
    $('#txt_rfc').val(data[3])
    $('#select_mdp').val(data[14])
    $('#select_cfdi').val(data[13])
    $('#select_lp_alterna').val(data[18])

    if (data[19] == "Original") {
        $("#check_lpa").prop("checked", true);
        $('#labelCheckLP').text("L. Precios Original");
    } else if (data[19] == "Alterna") {
        $("#check_lpa").prop("checked", false);
        $('#labelCheckLP').text("L. Precios Alterna");
    }

    if (data[20] == 1) {
        $("#check_auth").prop("checked", true);
        $('#labelCheckAuth').text("Req. Autenticacion");
    } else if (data[20] == 0) {
        $("#check_auth").prop("checked", false);
        $('#labelCheckAuth').text("Sin Autenticacion");
    }

    if (data[21] == "Remision") {
        $("#check_doc_fiscal").prop("checked", true);
        $('#labelCheckdF').text("Emitir a: Remision");
    } else if (data[21] == "Factura") {
        $("#check_doc_fiscal").prop("checked", false);
        $('#labelCheckdF').text("Emitir a: Factura");
    }

    $('#select_Banco_client').val(data[22])
    $('#txt_cuenta_cliente').val(data[23])
    $('#txt_limite_dias').val(data[24])
    var price = numeral(data[25]);
    var format = price.format("$0,0.00");
    $('#txt_limite_credito').val(format)

    data = [];
    accion = "update";
}

function resetFormCte() {

    $('#idCliente').val("")
    $('#estatus_select_client').val("Activo")
    $('#txt_nombre_cliente').val("")
    $('#txt_telefono').val("")
    $('#txt_email').val("")
    $('#estados_select').val("0")
    $('#municipio_select').empty()
    $('#municipio_select').prop('disabled', true)
    $('#poblacion_select').empty()
    $('#poblacion_select').prop('disabled', true)
    $('#clasificacion_select').val("0")
    $('#txt_texto').val("")
    $('#select_mdv').val("0")
    $('#select_lp_remision').val("0")
    $('#select_lp_factura').val("0")
    $('#select_com_remision').val("0")
    $('#select_com_factura').val("0")
    $('#txt_rfc').val("")
    $('#select_mdp').val("0")
    $('#select_cfdi').val("0")
    $('#select_lp_alterna').val("0")
    $('#check_lpa').is(":checked")
    $('#check_doc_fiscal').is(":checked")
    $('#check_auth').is(":checked")
    $('#select_Banco_client').val("")
    $('#txt_cuenta_cliente').val("")
    $('#txt_limite_dias').val("")
    $('#txt_limite_credito').val("")
    data = [];

}

function showLoadButton() {
    $("#btnSaveCte").hide();
    $("#btnSpinner").show();
}

function hiddeLoadButton() {
    $("#btnSaveCte").show();
    $("#btnSpinner").hide();
}

function showCaseButton() {
    if (response_err == 0) {
        $("#btnSaveCte").removeClass('btn-primary');
        $("#btnSaveCte").addClass('btn-warning');
        $("#btnSaveCte").html('Reintentar');
    } else if (response_err == 1) {
        $("#btnSaveCte").removeClass('btn-warning');
        $("#btnSaveCte").addClass('btn-primary');
        $("#btnSaveCte").html('Agregar');
    } else if (response_err == 404) {
        $("#btnSaveCte").removeClass('btn-warning btn-primary');
        $("#btnSaveCte").addClass('btn-danger');
        $("#btnSaveCte").html('Error <i class="fa-solid fa-triangle-exclamation"></i>');
    }
}

function showToastCte(dataArray) {
    const toastLiveExample = document.getElementById('toastCte')

    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

    $("#message_toast").text(dataArray[0]);
    $("#icon_toast").attr("src", dataArray[1]);
    toastBootstrap.show()
    // limpia el arreglo
    arrToast = [];
}

function crudCatalogos(array, action) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "../../functions/administrador/crudCatalogos.php",
            type: "GET",
            data: { data: array, action },
            success: function (response) {
                let result = JSON.parse(response);
                let template = "";
                let pagination = "";
                result.forEach((resultdata) => {
                    if (resultdata.action != "none") {
                        if (resultdata.validation == 0) {
                            template += `<tr taskId="0">
                            <th colspan="26" class="table text-center">${resultdata.message}</th>
                            </tr>`;
                            currentPage = 1;
                            resolve(resultdata.message + ',' + resultdata.validation)
                        } else {
                            if (resultdata.action == "insert") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read") {
                                resultdata.table.forEach((table) => {
                                    if (table.validation == 1) {
                                        template += `<tr taskId="${table.reg_0}">
                                        <td class="text-center"><button type="button" class="btn btn-primary btn-sm" id="btnEditRegimen"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" id="btnDeleteRegimen"><i class="fa-solid fa-trash-can"></i></button></td>
                                        <th class="text-end">${table.reg_0}</th>
                                        <td class="text-start">${table.reg_1}</td>
                                        </tr>`;
                                    }
                                });
                                resultdata.pages.forEach((info_page) =>{
                                    pagination += `<li class="page-item ${info_page.active}"><a class="page-link" href="#" data-page="${info_page.page}" taskPag="TskregFiscal">${info_page.page}</a></li>`;
                                })
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read_id") {
                                data = [];
                                data.push(resultdata.reg_0)
                                data.push(resultdata.reg_1)
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "delete") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "update") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read_sat") {
                                resultdata.table.forEach((table) => {
                                    if (table.validation == 1) {
                                        template += `<tr taskId="${table.SAT_0}">
                                        <td class="text-center"><button type="button" class="btn btn-primary btn-sm" id="btnEditFormSAT"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" id="btnDeleteFormSAT"><i class="fa-solid fa-trash-can"></i></button></td>
                                        <th class="text-center">${table.SAT_0}</th>
                                        <td class="text-start">${table.SAT_1}</td>
                                        </tr>`;
                                    }
                                });
                                resultdata.pages.forEach((info_page) => {
                                    pagination += `<li class="page-item ${info_page.active}"><a class="page-link" href="#" data-page="${info_page.page}" taskPag="TskformSAT">${info_page.page}</a></li>`;
                                })
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "insert_sat") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read_id_sat") {
                                data = [];
                                data.push(resultdata.SAT_0)
                                data.push(resultdata.SAT_1)
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "update_sat") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "delete_sat") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read_cfdi") {
                                resultdata.table.forEach((table) => {
                                    if (table.validation == 1) {
                                        template += `<tr taskId="${table.cfdi_0}">
                                        <td class="text-center"><button type="button" class="btn btn-primary btn-sm" id="btnEditCFDI"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" id="btnDeleteCFDI"><i class="fa-solid fa-trash-can"></i></button></td>
                                        <th class="text-center">${table.cfdi_0}</th>
                                        <td class="text-start">${table.cfdi_1}</td>
                                        </tr>`;
                                    }
                                });
                                resultdata.pages.forEach((info_page) => {
                                    pagination += `<li class="page-item ${info_page.active}"><a class="page-link" href="#" data-page="${info_page.page}" taskPag="Tskcfdi">${info_page.page}</a></li>`;
                                })
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "insert_cfdi") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "update_cfdi") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read_id_cfdi") {
                                data = [];
                                data.push(resultdata.cfdi_0)
                                data.push(resultdata.cfdi_1)
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "delete_cfdi") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            }
                        }
                    } else {
                        resolve(resultdata.message + ',' + resultdata.validation);
                    }
                });

                if (action == "read") {
                    $("#tbRegimen").html(template);
                } else if (action == "read_sat") {
                    $("#tbFormSAT").html(template);
                } else if (action == "read_cfdi") {
                    $("#tbCFDI").html(template);
                }
                $('.pagination').html(pagination);
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                reject(txtStatus)
            }
        });
    })
}

function resetFormRegimen() {
    $('#input_idRegimen').val("")
    $('#input_descripcionRegimen').val("")
    $("#input_idRegimen").removeClass("border border-success border-danger")
    $("#input_descripcionRegimen").removeClass("border border-success border-danger")

    data = [];
}

function setDataRegimen() {
    $('#input_idRegimen').val(data[0])
    $("#input_idRegimen").prop("disabled", true);
    $('#input_descripcionRegimen').val(data[1])

    data = [];
    action = "update";
}

function crudMetodoVenta(array, action) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "../../functions/administrador/crudMetodoVenta.php",
            type: "GET",
            data: { data: array, action },
            success: function (response) {
                let result = JSON.parse(response);
                let template = "";
                let pagination = "";
                result.forEach((resultdata) => {
                    if (resultdata.action != "none") {
                        if (resultdata.validation == 0) {
                            template += `<tr taskId="0">
                            <th colspan="26" class="table text-center">${resultdata.message}</th>
                            </tr>`;
                            currentPage = 1;
                            resolve(resultdata.message + ',' + resultdata.validation)
                        } else {
                            if (resultdata.action == "insert") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read") {
                                resultdata.table.forEach((table) => {
                                    if (table.validation == 1) {
                                        template += `<tr taskId="${table.metV_0}">
                                        <td class="text-center"><button type="button" class="btn btn-primary btn-sm" id="btnEditMVenta"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" id="btnDeleteMVenta"><i class="fa-solid fa-trash-can"></i></button></td>
                                        <th class="text-center">${table.metV_0}</th>
                                        <td class="text-start">${table.metV_1}</td>
                                        <td class="text-center">${table.metV_2}</td>
                                        <td class="text-center">${table.metV_3}</td>
                                        </tr>`;
                                    }
                                });
                                resultdata.pages.forEach((info_page) => {
                                    pagination += `<li class="page-item ${info_page.active}"><a class="page-link" href="#" data-page="${info_page.page}" taskPag="TskmetVenta">${info_page.page}</a></li>`;
                                })
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read_id") {
                                data = [];
                                data.push(resultdata.metV_0)
                                data.push(resultdata.metV_1)
                                data.push(resultdata.metV_2)
                                data.push(resultdata.metV_3)
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "delete") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "update") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            }
                        }
                    } else {
                        resolve(resultdata.message + ',' + resultdata.validation);
                    }
                });

                if (action == "read") {
                    $("#tbMetVenta").html(template);
                    $('.pagination').html(pagination);
                }
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                reject(txtStatus)
            }
        });
    })
}

function setDataMetVenta() {
    $('#input_idCodVenta').val(data[0])
    $('#input_idCodVenta').prop("disabled", true);
    $('#input_descripcionVenta').val(data[1])
    $('#input_remision').val(data[2])
    $('#input_factura').val(data[3])

    data = [];
    action = "update";
}

function resetFormMetVenta() {

    $('#input_idCodVenta').val("")
    $('#input_descripcionVenta').val("")
    $('#input_remision').val("")
    $('#input_factura').val("")
    $("#input_idCodVenta").removeClass("border border-success border-danger")
    $("#input_descripcionVenta").removeClass("border border-success border-danger")
    $("#input_remision").removeClass("border border-success border-danger")
    $("#input_factura").removeClass("border border-success border-danger")
    data = [];

}

function resetFormSAT() {

    $('#input_idFormSAT').val("")
    $('#input_descripcionFormSAT').val("")
    $("#input_idFormSAT").removeClass("border border-success border-danger")
    $("#input_descripcionFormSAT").removeClass("border border-success border-danger")
    data = [];

}

function setDataFormSAT() {
    $('#input_idFormSAT').val(data[0])
    $('#input_idFormSAT').prop("disabled", true);
    $('#input_descripcionFormSAT').val(data[1])

    data = [];
    action = "update_sat";
}

function resetFormCFDI() {

    $('#input_idCFDI').val("")
    $('#input_descripcionCFDI').val("")
    $("#input_idCFDI").removeClass("border border-success border-danger")
    $("#input_descripcionCFDI").removeClass("border border-success border-danger")
    data = [];

}

function setDataCFDI() {
    $('#input_idCFDI').val(data[0])
    $('#input_idCFDI').prop("disabled", true);
    $('#input_descripcionCFDI').val(data[1])

    data = [];
    action = "update_cfdi";
}

function crudEsquema(array, action) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "../../functions/administrador/crudEsquema.php",
            type: "GET",
            data: { data: array, action },
            success: function (response) {
                let result = JSON.parse(response);
                let template = "";
                let pagination = "";
                result.forEach((resultdata) => {
                    if (resultdata.action != "none") {
                        if (resultdata.validation == 0) {
                            template += `<tr taskId="0">
                            <th colspan="26" class="table text-center">${resultdata.message}</th>
                            </tr>`;
                            currentPage = 1;
                            resolve(resultdata.message + ',' + resultdata.validation)
                        } else { 
                            if (resultdata.action == "read") {
                                resultdata.table.forEach((table) => {
                                    if (table.validation == 1) {
                                        template += `<tr taskId="${table.esq_1}">
                                        <td class="text-center"><button type="button" class="btn btn-primary btn-sm" id="btnEditEsquema"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" id="btnDeleteEsquema"><i class="fa-solid fa-trash-can"></i></button></td>
                                        <th class="text-center">${table.esq_0}</th>
                                        <td class="text-center">${table.esq_3}</td>
                                        <td class="text-center">${table.esq_4}</td>
                                        <td class="text-center">${table.esq_6}</td>
                                        <td class="text-center">${table.esq_5}</td>
                                        <td class="text-center">${table.esq_7}</td>
                                        <td class="text-center">${table.esq_8}</td>
                                        <td class="text-center">${table.esq_9}</td>
                                        </tr>`;
                                    }
                                });
                                resultdata.pages.forEach((info_page) => {
                                    pagination += `<li class="page-item ${info_page.active}"><a class="page-link" href="#" data-page="${info_page.page}" taskPag="Tskesquema">${info_page.page}</a></li>`;
                                })
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read_id") {
                                data = [];
                                data.push(resultdata.esq_0)
                                data.push(resultdata.esq_1)
                                data.push(resultdata.esq_3)
                                data.push(resultdata.esq_4)
                                data.push(resultdata.esq_5)
                                data.push(resultdata.esq_6)
                                data.push(resultdata.esq_7)
                                data.push(resultdata.esq_8)
                                data.push(resultdata.esq_9)
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "update") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read_doc") {
                                if (resultdata.validation == 1) {
                                    template += `<tr taskId="${resultdata.esq_0}">
                                        <td class="text-center"><button type="button" class="btn btn-primary btn-sm" id="btnEditDocEsquema"><i class="fa-solid fa-pen-to-square"></i></button></td>
                                        <th class="text-center">${resultdata.esq_1}</th>
                                        <td class="text-center">${resultdata.esq_2}</td>
                                        <td class="text-center">${resultdata.esq_3}</td>
                                        <td class="text-center">${resultdata.esq_4}</td>
                                        </tr>`;
                                }
                                resolve(resultdata.message + ',' + resultdata.validation);
                            }
                        }
                    } else {
                        resolve(resultdata.message + ',' + resultdata.validation);
                    }
                });

                if (action == "read") {
                    $("#tbEsquema").html(template);
                    $('.pagination').html(pagination);
                } else if (action == "read_doc") {
                    $("#tbEsquemaDoc").html(template);
                }
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                reject(txtStatus)
            }
        });
    }) 
}

function setDataEsquema() {
    $('#input_clienteEsq').val(data[0])
    $('#input_clienteEsq').prop("disabled", true);
    $('#input_PListaEsq').val(data[2])
    $('#input_PListaEsq').prop("disabled", true);
    $('#input_documentoEsq').val(data[3])
    $('#input_documentoEsq').prop("disabled", true);
    $('#select_estatusEsq option[value="0"]').html(data[6]).prop('selected', true);
    if (data[6] == "Activo") {
        $('#select_estatusEsq option[value="1"]').html('Suspendido').prop('selected', false);
    } else {
        $('#select_estatusEsq option[value="1"]').html('Activo').prop('selected', false);
    }
    
    $('#select_estatusEsq').val()
    $('#input_tipoEsq').val(data[7])
    $('#input_tipoEsq').prop("disabled", true);
    $('#input_comisionEsq').val(data[8])

    data = [];
    action = "update";
}

function resetEsquemaCliente() {
    $('#select_clienteEsq option[value="0"]').prop('selected', true);
    $('#select_documentoEsq option[value="0"]').prop('selected', true);
    $("#tbEsquemaDoc").empty();
    $("#select_clienteEsq").removeClass("border border-success border-danger")
    $("#select_documentoEsq").removeClass("border border-success border-danger")
    data = [];

}


// Eventios de elementos de la interface
$('#estados_select').on('change', function () {
    var id = $('#estados_select').val()
    data.push(id);
    getMunicipio(data, "read_id").then((result) => {
        console.log(result);
        data = [];
        $('#municipio_select').prop('disabled', false)
    }).catch((err) => {
        console.log(err);
    })
});

$('#municipio_select').on('change', function () {
    var id = $('#municipio_select').val()
    data.push(id);
    getPoblacion(data, "read_id").then((result) => {
        console.log(result);
        data = []
        $('#poblacion_select').prop('disabled', false)
    }).catch((err) => {
        console.log(err);
    })
});

$('#clasificacion_select').on('change', function () {
    var texto = $('#clasificacion_select').val();
    if (texto == 0) {
        $('#txt_texto').val("");
    } else {
        $('#txt_texto').val(texto);
    }
});

$('#btnSaveCte').on('click', function () {
    alert($('#exampleFormControlInput1').val())

    /*showLoadButton()
    crudClientes(getData(), accion).then((result) => { accion ="update";
        var spt = result.split(",");
        response_err = spt[1];
        if (spt[1] == 1) {
            arrToast.push(spt[0]);
            arrToast.push(icon_success)
            showToastCte(arrToast);
            // alert(spt[0]);
            hiddeLoadButton();
            showCaseButton();
            $('#staticBackdropClient').modal('hide');
            resetFormCte();
        } else {
            arrToast.push(spt[0]);
            arrToast.push(icon_error)
            showToastCte(arrToast);
            showCaseButton();
        }

        data = [];
    }).catch((err) => {
        salert(err)
    });*/
})


$('#btnTableClient').on('click', function () {
    data.push(currentPage);
    data.push(itemsPerPage);

    crudClientes(data, "read").then((result) => {
        var spt = result.split(",");
        if (spt[1] == 1) {
            // Inserte alerta o accion
        } else {
            // inserte alerta o accion
        }
        data = []
    }).catch((err) => {
        alert(err)
        response_err = 404;
        showCaseButton();
    });
})

var typePagination = null;
$(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    typePagination = this.getAttribute('taskPag');
    currentPage = $(this).data('page');
    data.push(currentPage);
    data.push(itemsPerPage);

    if (typePagination == "Tskclientes") {
        crudClientes(data, "read").then((page) => {
            if (page == 1) {
    
            }
            data = []
        }).catch((err) => {
            alert(err);
        }); 
    }else if(typePagination == "Tskcfdi"){
        crudCatalogos(data, "read_cfdi").then((result) => {
            var message = result.split(",");
            if(message[1]==1){
                arrToast.push(message[0]);
                arrToast.push(icon_success);
                showToastCte(arrToast);
            }else{
                arrToast.push("No se pudo mostrar los datos");
                arrToast.push(icon_error);
                showToastCte(arrToast);
            }
            data = []
        }).catch((err) => {
            alert(err);
        });
    }else if(typePagination == "TskregFiscal"){
        crudCatalogos(data, "read").then((result) => {
            var message = result.split(",");
            if(message[1]==1){
                arrToast.push(message[0]);
                arrToast.push(icon_success);
                showToastCte(arrToast);
            }else{
                arrToast.push("No se pudo mostrar los datos");
                arrToast.push(icon_error);
                showToastCte(arrToast);
            }
            data = []
        }).catch((err) => {
            alert(err);
        });
    }else if(typePagination == "TskformSAT"){
        crudCatalogos(data, "read_sat").then((result) => {
            var message = result.split(",");
            if(message[1]==1){
                arrToast.push(message[0]);
                arrToast.push(icon_success);
                showToastCte(arrToast);
            }else{
                arrToast.push("No se pudo mostrar los datos");
                arrToast.push(icon_error);
                showToastCte(arrToast);
            }
            data = []
        }).catch((err) => {
            alert(err);
        });
    }else if(typePagination == "TskmetVenta"){
        crudMetodoVenta(data, "read").then((result) => {
            var message = result.split(",");
            if(message[1]==1){
                arrToast.push(message[0]);
                arrToast.push(icon_success);
                showToastCte(arrToast);
            }else{
                arrToast.push("No se pudo mostrar los datos");
                arrToast.push(icon_error);
                showToastCte(arrToast);
            }
            data = []
        }).catch((err) => {
            alert(err);
        });
    }else if(typePagination == "Tskesquema"){
        crudEsquema(data, "read").then((result) => {
            var message = result.split(",");
            if(message[1]==1){
                arrToast.push(message[0]);
                arrToast.push(icon_success);
                showToastCte(arrToast);
            }else{
                arrToast.push("No se pudo mostrar los datos");
                arrToast.push(icon_error);
                showToastCte(arrToast);
            }
            data = []
        }).catch((err) => {
            alert(err);
        });
    }
});

$(document).on("click", "#btnEditCte", function () {

    $('#staticBackdropTableClient').modal('hide');
    $('#staticBackdropClient').modal('show');

    let elemento = $(this)[0].parentElement.parentElement;
    let idCte = $(elemento).attr("taskId");

    data.push(idCte);

    crudClientes(data, "read_id").then((result) => {
        setData();
    }).catch((err) => {
        alert(err);
    })
});

$(document).on("click", "#btnDeleteCte", function () {
    let elemento = $(this)[0].parentElement.parentElement;
    let idCte = $(elemento).attr("taskId");

    data.push(idCte);
    $("#modalDeleteCte").modal('show');
});


$(document).on('click', '#btnCloseCte', function () {
    resetFormCte();
})

$('#btnModalCte').on('click', '#btnModalCte', function () {

})

$('#check_doc_fiscal').change(function () {
    if (this.checked) {
        $('#labelCheckdF').text("Emitir a: Remision");
    } else {
        $('#labelCheckdF').text("Emitir a: Factura");
    }
});

$('#check_lpa').change(function () {
    if (this.checked) {
        $('#labelCheckLP').text("L. Precios Original");
    } else {
        $('#labelCheckLP').text("L. Precios Alterna");
    }
});

$('#check_auth').change(function () {
    if (this.checked) {
        $('#labelCheckAuth').text("Req. Autenticacion");
    } else {
        $('#labelCheckAuth').text("Sin Autenticacion");
    }
});

$(document).on('click', '#btnDeleteCteConfirm', function () {
    crudClientes(data, "delete").then((result) => {
        var spt = result.split(",");
        data = [];
        if (spt[1] == 1) {
            data.push(currentPage);
            data.push(itemsPerPage);

            arrToast.push(spt[0]);
            arrToast.push(icon_success)
            showToastCte(arrToast);
            $("#modalDeleteCte").modal("hide");
            // $("#staticBackdropTableClient").modal("hide");
            return crudClientes(data, "read")
        } else {
            arrToast.push(spt[0]);
            arrToast.push(icon_error)
            showToastCte(arrToast);
        }

    }).then((task_2) => {
        var spt = task_2.split(",");
        if (spt[1] == 1) {
            data = []
            console.log("datos actualizados")
        }
    }).catch((err) => {
        alert(err);
    })
})

$(document).on('click', '#btnDeleteCteCancel', function () {
    $("#modalDeleteCte").modal("hide");
    // $("#staticBackdropTableClient").modal("show");
})

$(document).on('click', '#btnExportExcel', function () {

});

$('#btnTableRegimen').on('click', function () {
    data.push(currentPage);
    data.push(itemsPerPage);
    crudCatalogos(data, "read").then((result) => {
    // crudCatalogos([""], "read").then((result) => {
        var spt = result.split(",");
        if (spt[1 == 1]) {
            
        } else {

        }
        data = []
    }).catch((err) => {
        alert(err)
        response_err = 404;
    });
});

$(document).on("click", "#btnDeleteRegimen", function () {
    let elemento = $(this)[0].parentElement.parentElement;
    let idRegimen = $(elemento).attr("taskId");

    data.push(idRegimen);
    $("#modalDeleteRegimen").modal("show");
});

$(document).on("click", "#btnEditRegimen", function () {
    $('#staticBackdropTableRegimen').modal('hide');
    $('#staticBackdropRegimen').modal('show');
    $('#btnGuardarRegimen').html("Actualizar")
    $('#staticBackdropLabe4').html("Modificar Régimen Fiscal")

    let elemento = $(this)[0].parentElement.parentElement;
    let idRegimen = $(elemento).attr("taskId");

    data.push(idRegimen);

    crudCatalogos(data, "read_id").then((result) => {
        setDataRegimen();
    }).catch((err) => {
        alert(err);
    })
})

$(document).on("click", "#btnModalReg", function () {
    $("#input_idRegimen").prop("disabled", false);
    $('#btnGuardarRegimen').html("Agregar")
    $('#staticBackdropLabe4').html("Nuevo Régimen Fiscal")
    resetFormRegimen()
})

$(document).on("click", "#btnCteAnt", function () {
    let idCte = $('#idCliente').val()

    if (idCte > 1) {
        data.push(idCte - 1);
        crudClientes(data, "read_id").then((result) => {
            let spt = result.split(",");
            if (spt[1] == 1) {
                setData();
            } else {
                arrToast.push(spt[0]);
                arrToast.push(icon_info)
                showToastCte(arrToast);
                data = [];
            }
        }).catch((err) => {
            alert(err);
        })
    } else {
        arrToast.push("No hay mas clientes.");
        arrToast.push(icon_info)
        showToastCte(arrToast)
    }
})

$(document).on("click", "#btnCteSig", function () {
    let idCte = $('#idCliente').val()
    if (idCte >= 1) {
        idCte++;
        data.push(idCte);
        crudClientes(data, "read_id").then((result) => {
            let spt = result.split(",");
            if (spt[1] == 1) {
                setData();
            } else {
                arrToast.push(spt[0]);
                arrToast.push(icon_info)
                showToastCte(arrToast);
                data = [];
            }
        }).catch((err) => {
            alert(err);
        })
    } else {
        arrToast.push("Este valor no es valido.");
        arrToast.push(icon_error)
        showToastCte(arrToast)
    }
})


$(document).on('click', '#btnDeleteRegimenConfirm', function () {
    crudCatalogos(data, "delete").then((result) => {
        var spt = result.split(",");
        data = [];
        if (spt[1] == 1) {
            arrToast.push(spt[0]);
            arrToast.push(icon_success)
            showToastCte(arrToast);
            $("#modalDeleteRegimen").modal("hide");
            return crudCatalogos([""], "read");
        } else if (spt[1] == 0) {
            arrToast.push(spt[0]);
            arrToast.push(icon_error)
            showToastCte(arrToast);
        } else if (spt[1] == -1) {
            arrToast.push(spt[0]);
            arrToast.push(icon_error)
            showToastCte(arrToast);
        }
    }).then((task_2) => {
        var spt = task_2.split(",");
        if (spt[1] == 1) {
            data = []
            console.log("datos actualizados")
        }
        console.log(data);
    }).catch((err) => {
        alert(err);
    })
})

$(document).on('click', '#btnGuardarRegimen', function () {
    let idRegimen = $("#input_idRegimen").val();
    let descripcionRegimen = $("#input_descripcionRegimen").val();

    let textid = $.trim($("#input_idRegimen").val());
    let textdesc = $.trim($("#input_descripcionRegimen").val());
    let val = 0;
    if (textid.length > 0) {
        $("#input_idRegimen").addClass("border border-success");
        val += 1;
    } else {
        $("#input_idRegimen").addClass("border border-danger");
        val += 0;
    }

    if (textdesc.length > 0) {
        $("#input_descripcionRegimen").addClass("border border-success");
        val += 1;
    } else {
        $("#input_descripcionRegimen").addClass("border border-danger");
        val += 0;
    }

    if (val == 2) {
        data.push(idRegimen);
        data.push(descripcionRegimen);

        if ($('#btnGuardarRegimen').text() == 'Agregar') {
            crudCatalogos(data, "insert").then((result) => {
                var spt = result.split(",");
                data = [];
                if (spt[1] == 1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_success)
                    showToastCte(arrToast);
                    resetFormRegimen();
                    $("#input_idRegimen").removeClass("border border-success border-danger")
                    $("#input_descripcionRegimen").removeClass("border border-success border-danger")
                } else if (spt[1] == 0) {
                    arrToast.push(spt[0])
                    arrToast.push(icon_error)
                    showToastCte(arrToast)
                    $("#input_idRegimen").removeClass("border border-success border-danger")
                    $("#input_idRegimen").addClass("border border-danger");
                } else if (spt[1] == -1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_error)
                    showToastCte(arrToast);
                    $("#input_idRegimen").removeClass("border border-success border-danger")
                    $("#input_descripcionRegimen").removeClass("border border-success border-danger")
                }
            }).catch((err) => {
                arrToast.push("" + err);
                arrToast.push(icon_error)
                showToastCte(arrToast);
            })
        } else if ($('#btnGuardarRegimen').text() == 'Actualizar') {
            crudCatalogos(data, "update").then((result) => {
                var spt = result.split(",");
                data = [];
                if (spt[1] == 1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_success)
                    showToastCte(arrToast);
                    resetFormRegimen();
                    $("#input_idRegimen").removeClass("border border-success border-danger")
                    $("#input_descripcionRegimen").removeClass("border border-success border-danger")
                } else if (spt[1] == 0) {
                    arrToast.push(spt[0])
                    arrToast.push(icon_error)
                    showToastCte(arrToast)
                    $("#input_idRegimen").removeClass("border border-success border-danger")
                    $("#input_idRegimen").addClass("border border-danger");
                } else if (spt[1] == -1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_error)
                    showToastCte(arrToast);
                    $("#input_idRegimen").removeClass("border border-success border-danger")
                    $("#input_descripcionRegimen").removeClass("border border-success border-danger")
                }
            }).catch((err) => {
                arrToast.push("" + err);
                arrToast.push(icon_error)
                showToastCte(arrToast);
            })
        }
    } else {
        arrToast.push("Uno o más campos están vacíos, favor de verificarlos.");
        arrToast.push(icon_error)
        showToastCte(arrToast);
    }
})

$(document).on('click', '#btnCancelNuevoRegimen', function () {
    $('#input_idRegimen').prop("disabled", false);
    $('#btnGuardarRegimen').html("Agregar")
    $('#staticBackdropLabe4').html("Nuevo Régimen Fiscal")
    resetFormRegimen()
    return crudCatalogos([""], "read");
})

$(document).on('click', '#btnTableGuardarRegimen', function () {
    $("#staticBackdropRegimen").modal("show");
})

$('#btnTableMetVenta').on('click', function () {
    data.push(currentPage);
    data.push(itemsPerPage);
    crudMetodoVenta(data, "read").then((result) => {
    // crudMetodoVenta([""], "read").then((result) => {
        var spt = result.split(",");
        if (spt[1 == 1]) {

        } else {

        }
        data = []
    }).catch((err) => {
        alert(err)
        response_err = 404;
    });
});

$(document).on('click', '#btnGuardarMetVenta', function () {
    let codMetVenta = $("#input_idCodVenta").val();
    let descripcionVenta = $("#input_descripcionVenta").val();
    let reMetVenta = $("#input_remision").val();
    let facMetVenta = $("#input_factura").val();

    let textidVent = $.trim($("#input_idCodVenta").val());
    let textdescVent = $.trim($("#input_descripcionVenta").val());
    let suma = parseFloat(reMetVenta) + parseFloat(facMetVenta);

    let val = 0;
    if (textidVent.length > 0) {
        $("#input_idCodVenta").addClass("border border-success");
        val += 1;
    } else {
        $("#input_idCodVenta").addClass("border border-danger");
        val += 0;
    }

    if (textdescVent.length > 0) {
        $("#input_descripcionVenta").addClass("border border-success");
        val += 1;
    } else {
        $("#input_descripcionVenta").addClass("border border-danger");
        val += 0;
    }

    if (reMetVenta.length > 0) {
        $("#input_remision").addClass("border border-success");
        val += 1;
    } else {
        $("#input_remision").addClass("border border-danger");
        val += 0;
    }

    if (facMetVenta.length > 0) {
        $("#input_factura").addClass("border border-success");
        val += 1;
    } else {
        $("#input_factura").addClass("border border-danger");
        val += 0;
    }

    if (suma == 1) {
        $("#input_factura").addClass("border border-success");
        $("#input_remision").addClass("border border-success");
        $("#input_factura").removeClass("border border-success border-danger")
        $("#input_remision").removeClass("border border-success border-danger")
        val += 1;
    } else {
        $("#input_factura").addClass("border border-danger");
        $("#input_remision").addClass("border border-danger");
        val += 0;
    }

    if (val == 5) {
        data.push(codMetVenta);
        data.push(descripcionVenta);
        data.push(reMetVenta);
        data.push(facMetVenta);

        if ($('#btnGuardarMetVenta').text() == 'Agregar') {
            crudMetodoVenta(data, "insert").then((result) => {
                var spt = result.split(",");
                data = [];
                if (spt[1] == 1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_success)
                    showToastCte(arrToast);
                    resetFormMetVenta();
                    $("#input_idCodVenta").removeClass("border border-success border-danger")
                    $("#input_descripcionVenta").removeClass("border border-success border-danger")
                } else if (spt[1] == 0) {
                    arrToast.push(spt[0])
                    arrToast.push(icon_error)
                    showToastCte(arrToast)
                    $("#input_idCodVenta").removeClass("border border-success border-danger")
                    $("#input_idCodVenta").addClass("border border-danger");
                } else if (spt[1] == -1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_error)
                    showToastCte(arrToast);
                    $("#input_idCodVenta").removeClass("border border-success border-danger")
                    $("#input_descripcionVenta").removeClass("border border-success border-danger")
                }
            }).catch((err) => {
                arrToast.push("" + err);
                arrToast.push(icon_error)
                showToastCte(arrToast);
            })
        } else if ($('#btnGuardarMetVenta').text() == 'Actualizar') {
            crudMetodoVenta(data, "update").then((result) => {
                var spt = result.split(",");
                data = [];
                if (spt[1] == 1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_success)
                    showToastCte(arrToast);
                    resetFormMetVenta();
                    $("#input_idCodVenta").removeClass("border border-success border-danger")
                    $("#input_descripcionVenta").removeClass("border border-success border-danger")
                    // $("#staticBackdropVenta").modal("hide");
                    // $("#staticBackdropTableMVenta").modal("show");
                    // return crudMetodoVenta([""], "read");
                } else if (spt[1] == 0) {
                    arrToast.push(spt[0])
                    arrToast.push(icon_error)
                    showToastCte(arrToast)
                    $("#input_idCodVenta").removeClass("border border-success border-danger")
                    $("#input_idCodVenta").addClass("border border-danger");
                } else if (spt[1] == -1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_error)
                    showToastCte(arrToast);
                    $("#input_idCodVenta").removeClass("border border-success border-danger")
                    $("#input_descripcionVenta").removeClass("border border-success border-danger")
                }
            }).catch((err) => {
                arrToast.push("" + err);
                arrToast.push(icon_error)
                showToastCte(arrToast);
            })
        }
    } else {
        arrToast.push("Uno o más campos no cumplen con la información requerida, favor de verificarlos.");
        arrToast.push(icon_error)
        showToastCte(arrToast);
    }
})

$(document).on("click", "#btnEditMVenta", function () {
    $('#staticBackdropTableMVenta').modal('hide');
    $('#staticBackdropVenta').modal('show');
    $('#btnGuardarMetVenta').html("Actualizar")
    $('#staticBackdropLabe6').html("Modificar Modo de Venta")
    $("#input_idCodVenta").removeClass("border border-success border-danger")
    $("#input_descripcionVenta").removeClass("border border-success border-danger")
    $("#input_remision").removeClass("border border-success border-danger")
    $("#input_factura").removeClass("border border-success border-danger")

    let elemento = $(this)[0].parentElement.parentElement;
    let codMetVenta = $(elemento).attr("taskId");

    data.push(codMetVenta);

    crudMetodoVenta(data, "read_id").then((result) => {
        setDataMetVenta();
    }).catch((err) => {
        alert(err);
    })
})

$(document).on("click", "#btnModalMetVenta", function () {
    $('#input_idCodVenta').prop("disabled", false);
    $('#btnGuardarMetVenta').html("Agregar")
    $('#staticBackdropLabe6').html("Nuevo Modo de Venta")
    resetFormMetVenta()
})

$(document).on("click", "#btnDeleteMVenta", function () {
    data = [];
    let elemento = $(this)[0].parentElement.parentElement;
    let codMetVenta = $(elemento).attr("taskId");

    data.push(codMetVenta);
    $("#modalDeleteMetVenta").modal("show");
})

$(document).on('click', '#btnDeleteMetVentaConfirm', function () {
    crudMetodoVenta(data, "delete").then((result) => {
        var spt = result.split(",");
        data = [];
        if (spt[1] == 1) {
            arrToast.push(spt[0]);
            arrToast.push(icon_success)
            showToastCte(arrToast);
            $("#modalDeleteMetVenta").modal("hide");
            return crudMetodoVenta([""], "read");
        } else if (spt[1] == 0) {
            arrToast.push(spt[0]);
            arrToast.push(icon_error)
            showToastCte(arrToast);
        } else if (spt[1] == -1) {
            arrToast.push(spt[0]);
            arrToast.push(icon_error)
            showToastCte(arrToast);
        }
    }).then((task_2) => {
        var spt = task_2.split(",");
        if (spt[1] == 1) {
            data = []
            console.log("datos actualizados")
        }
        console.log(data);
    }).catch((err) => {
        alert(err);
    })
})

$(document).on('click', '#btnTableGuardarMetVenta', function () {
    $("#staticBackdropVenta").modal("show");
})

$(document).on('click', '#btnCancelNuevoMetVenta', function () {
    $('#input_idCodVenta').prop("disabled", false);
    $('#btnGuardarMetVenta').html("Agregar")
    $('#staticBackdropLabe6').html("Nuevo Modo de Venta")
    resetFormMetVenta()
    return crudMetodoVenta([""], "read");
})

$('#btnTableFormSAT').on('click', function () {
    data.push(currentPage);
    data.push(itemsPerPage);
    crudCatalogos(data, "read_sat").then((result) => {
    // crudCatalogos([""], "read_sat").then((result) => {
        var spt = result.split(",");
        if (spt[1 == 1]) {

        } else {

        }
        data = []
    }).catch((err) => {
        alert(err)
        response_err = 404;
    });
});

$(document).on('click', '#btnGuardarFormSAT', function () {
    let codFormSAT = $("#input_idFormSAT").val();
    let descFormSAT = $("#input_descripcionFormSAT").val();

    let textidFormSAT = $.trim($("#input_idFormSAT").val());
    let textdescFormSAT = $.trim($("#input_descripcionFormSAT").val());

    let val = 0;
    if (textidFormSAT.length > 0) {
        $("#input_idFormSAT").addClass("border border-success");
        val += 1;
    } else {
        $("#input_idFormSAT").addClass("border border-danger");
        val += 0;
    }

    if (textdescFormSAT.length > 0) {
        $("#input_descripcionFormSAT").addClass("border border-success");
        val += 1;
    } else {
        $("#input_descripcionFormSAT").addClass("border border-danger");
        val += 0;
    }

    if (val == 2) {
        data.push(codFormSAT);
        data.push(descFormSAT);

        if ($('#btnGuardarFormSAT').text() == 'Agregar') {
            crudCatalogos(data, "insert_sat").then((result) => {
                var spt = result.split(",");
                data = [];
                if (spt[1] == 1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_success)
                    showToastCte(arrToast);
                    resetFormSAT();
                    $("#input_idFormSAT").removeClass("border border-success border-danger")
                    $("#input_descripcionFormSAT").removeClass("border border-success border-danger")
                } else if (spt[1] == 0) {
                    arrToast.push(spt[0])
                    arrToast.push(icon_error)
                    showToastCte(arrToast)
                    $("#input_idFormSAT").removeClass("border border-success border-danger")
                    $("#input_idFormSAT").addClass("border border-danger");
                } else if (spt[1] == -1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_error)
                    showToastCte(arrToast);
                    $("#input_idFormSAT").removeClass("border border-success border-danger")
                    $("#input_descripcionFormSAT").removeClass("border border-success border-danger")
                }
            }).catch((err) => {
                arrToast.push("" + err);
                arrToast.push(icon_error)
                showToastCte(arrToast);
            })
        } else if ($('#btnGuardarFormSAT').text() == 'Actualizar') {
            crudCatalogos(data, "update_sat").then((result) => {
                var spt = result.split(",");
                data = [];
                if (spt[1] == 1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_success)
                    showToastCte(arrToast);
                    resetFormSAT();
                    $("#input_idFormSAT").removeClass("border border-success border-danger")
                    $("#input_descripcionFormSAT").removeClass("border border-success border-danger")
                } else if (spt[1] == 0) {
                    arrToast.push(spt[0])
                    arrToast.push(icon_error)
                    showToastCte(arrToast)
                    $("#input_idFormSAT").removeClass("border border-success border-danger")
                    $("#input_idFormSAT").addClass("border border-danger");
                } else if (spt[1] == -1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_error)
                    showToastCte(arrToast);
                    $("#input_idFormSAT").removeClass("border border-success border-danger")
                    $("#input_descripcionFormSAT").removeClass("border border-success border-danger")
                }
            }).catch((err) => {
                arrToast.push("" + err);
                arrToast.push(icon_error)
                showToastCte(arrToast);
            })
        }
    } else {
        arrToast.push("Uno o más campos no cumplen con la información requerida, favor de verificarlos.");
        arrToast.push(icon_error)
        showToastCte(arrToast);
    }
})

$(document).on("click", "#btnEditFormSAT", function () {
    $('#staticBackdropTableFormSAT').modal('hide');
    $('#staticBackdropFormSAT').modal('show');
    $('#btnGuardarFormSAT').html("Actualizar")
    $('#staticBackdropLabe8').html("Modificar Forma de Pago SAT")

    let elemento = $(this)[0].parentElement.parentElement;
    let idFormSAT = $(elemento).attr("taskId");

    data.push(idFormSAT);

    crudCatalogos(data, "read_id_sat").then((result) => {
        setDataFormSAT();
    }).catch((err) => {
        alert(err);
    })
})

$(document).on("click", "#btnDeleteFormSAT", function () {
    let elemento = $(this)[0].parentElement.parentElement;
    let idFormSAT = $(elemento).attr("taskId");

    data.push(idFormSAT);
    $("#modalDeleteFormSAT").modal("show");
});

$(document).on('click', '#btnDeleteFormSATConfirm', function () {
    crudCatalogos(data, "delete_sat").then((result) => {
        var spt = result.split(",");
        data = [];
        if (spt[1] == 1) {
            arrToast.push(spt[0]);
            arrToast.push(icon_success)
            showToastCte(arrToast);
            $("#modalDeleteFormSAT").modal("hide");
            return crudCatalogos([""], "read_sat");
        } else if (spt[1] == 0) {
            arrToast.push(spt[0]);
            arrToast.push(icon_error)
            showToastCte(arrToast);
        } else if (spt[1] == -1) {
            arrToast.push(spt[0]);
            arrToast.push(icon_error)
            showToastCte(arrToast);
        }
    }).then((task_2) => {
        var spt = task_2.split(",");
        if (spt[1] == 1) {
            data = []
            console.log("datos actualizados")
        }
        console.log(data);
    }).catch((err) => {
        alert(err);
    })
})

$(document).on("click", "#btnModalFormSAT", function () {
    $('#input_idFormSAT').prop("disabled", false);
    $('#btnGuardarFormSAT').html("Agregar")
    $('#staticBackdropLabe8').html("Nueva Forma de Pago SAT")
    resetFormSAT()
})

$(document).on('click', '#btnTableGuardarFormSAT', function () {
    $("#staticBackdropFormSAT").modal("show");
})

$(document).on('click', '#btnCancelNuevaFormSAT', function () {
    $('#input_idFormSAT').prop("disabled", false);
    $('#btnGuardarFormSAT').html("Agregar")
    $('#staticBackdropLabe8').html("Nueva Forma de Pago SAT")
    resetFormSAT()
    return crudCatalogos([""], "read_sat");
})

$('#btnTableCFDI').on('click', function () {
    data.push(currentPage);
    data.push(itemsPerPage);
    crudCatalogos(data, "read_cfdi").then((result) => {
        var spt = result.split(",");
        if (spt[1 == 1]) {
            
        } else {

        }
        data = []
    }).catch((err) => {
        alert(err)
        response_err = 404;
    });
});

$(document).on('click', '#btnGuardarCFDI', function () {
    let codCFDI = $("#input_idCFDI").val();
    let descCFDI = $("#input_descripcionCFDI").val();

    let textidCFDI = $.trim($("#input_idCFDI").val());
    let textdescCFDI = $.trim($("#input_descripcionCFDI").val());

    let val = 0;
    if (textidCFDI.length > 0) {
        $("#input_idCFDI").addClass("border border-success");
        val += 1;
    } else {
        $("#input_idCFDI").addClass("border border-danger");
        val += 0;
    }

    if (textdescCFDI.length > 0) {
        $("#input_descripcionCFDI").addClass("border border-success");
        val += 1;
    } else {
        $("#input_descripcionCFDI").addClass("border border-danger");
        val += 0;
    }

    if (val == 2) {
        data.push(codCFDI);
        data.push(descCFDI);

        if ($('#btnGuardarCFDI').text() == 'Agregar') {
            crudCatalogos(data, "insert_cfdi").then((result) => {
                var spt = result.split(",");
                data = [];
                if (spt[1] == 1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_success)
                    showToastCte(arrToast);
                    resetFormCFDI();
                    $("#input_idCFDI").removeClass("border border-success border-danger")
                    $("#input_descripcionCFDI").removeClass("border border-success border-danger")
                } else if (spt[1] == 0) {
                    arrToast.push(spt[0])
                    arrToast.push(icon_error)
                    showToastCte(arrToast)
                    $("#input_idCFDI").removeClass("border border-success border-danger")
                    $("#input_idCFDI").addClass("border border-danger");
                } else if (spt[1] == -1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_error)
                    showToastCte(arrToast);
                    $("#input_idCFDI").removeClass("border border-success border-danger")
                    $("#input_descripcionCFDI").removeClass("border border-success border-danger")
                }
            }).catch((err) => {
                arrToast.push("" + err);
                arrToast.push(icon_error)
                showToastCte(arrToast);
            })
        } else if ($('#btnGuardarCFDI').text() == 'Actualizar') {
            crudCatalogos(data, "update_cfdi").then((result) => {
                var spt = result.split(",");
                data = [];
                if (spt[1] == 1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_success)
                    showToastCte(arrToast);
                    resetFormCFDI();
                    $("#input_idCFDI").removeClass("border border-success border-danger")
                    $("#input_descripcionCFDI").removeClass("border border-success border-danger")
                } else if (spt[1] == 0) {
                    arrToast.push(spt[0])
                    arrToast.push(icon_error)
                    showToastCte(arrToast)
                    $("#input_idCFDI").removeClass("border border-success border-danger")
                    $("#input_idCFDI").addClass("border border-danger");
                } else if (spt[1] == -1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_error)
                    showToastCte(arrToast);
                    $("#input_idCFDI").removeClass("border border-success border-danger")
                    $("#input_descripcionCFDI").removeClass("border border-success border-danger")
                }
            }).catch((err) => {
                arrToast.push("" + err);
                arrToast.push(icon_error)
                showToastCte(arrToast);
            })
        }
    } else {
        arrToast.push("Uno o más campos no cumplen con la información requerida, favor de verificarlos.");
        arrToast.push(icon_error)
        showToastCte(arrToast);
    }
})

$(document).on("click", "#btnEditCFDI", function () {
    $('#staticBackdropTableCFDI').modal('hide');
    $('#staticBackdropCFDI').modal('show');
    $('#btnGuardarCFDI').html("Actualizar")
    $('#staticBackdropLabe10').html("Modificar Uso de CFDI")

    let elemento = $(this)[0].parentElement.parentElement;
    let idCFDI = $(elemento).attr("taskId");

    data.push(idCFDI);

    crudCatalogos(data, "read_id_cfdi").then((result) => {
        setDataCFDI();
    }).catch((err) => {
        alert(err);
    })
})

$(document).on("click", "#btnDeleteCFDI", function () {
    let elemento = $(this)[0].parentElement.parentElement;
    let idCFDI = $(elemento).attr("taskId");

    data.push(idCFDI);
    $("#modalDeleteCFDI").modal("show");
});

$(document).on('click', '#btnDeleteCFDIConfirm', function () {
    crudCatalogos(data, "delete_cfdi").then((result) => {
        var spt = result.split(",");
        data = [];
        if (spt[1] == 1) {
            arrToast.push(spt[0]);
            arrToast.push(icon_success)
            showToastCte(arrToast);
            $("#modalDeleteCFDI").modal("hide");
            return crudCatalogos([""], "read_cfdi");
        } else if (spt[1] == 0) {
            arrToast.push(spt[0]);
            arrToast.push(icon_error)
            showToastCte(arrToast);
        } else if (spt[1] == -1) {
            arrToast.push(spt[0]);
            arrToast.push(icon_error)
            showToastCte(arrToast);
        }
    }).then((task_2) => {
        var spt = task_2.split(",");
        if (spt[1] == 1) {
            data = []
            console.log("datos actualizados")
        }
        console.log(data);
    }).catch((err) => {
        alert(err);
    })
})

$(document).on("click", "#btnModalCFDI", function () {
    $('#input_idCFDI').prop("disabled", false);
    $('#btnGuardarCFDI').html("Agregar")
    $('#staticBackdropLabe10').html("Nuevo Uso de CFDI")
    resetFormCFDI()
})

$(document).on('click', '#btnTableGuardarCFDI', function () {
    $("#staticBackdropCFDI").modal("show");
})

$(document).on('click', '#btnCancelNuevoCFDI', function () {
    $('#input_idCFDI').prop("disabled", false);
    $('#btnGuardarCFDI').html("Agregar")
    $('#staticBackdropLabe10').html("Nuevo Uso de CFDI")
    resetFormCFDI()
    return crudCatalogos([""], "read_cfdi");
})

$('#btnTableEsquema').on('click', function () {
    data.push(currentPage);
    data.push(itemsPerPage);
    crudEsquema(data, "read").then((result) => {
        var spt = result.split(",");
        if (spt[1 == 1]) {
            
        } else {

        }
        data = []
    }).catch((err) => {
        alert(err)
        response_err = 404;
    });
});

$(document).on("click", "#btnEditEsquema", function () {
    $('#staticBackdropTableEsquema').modal('hide');
    $('#staticBackdropEsquema').modal('show');

    let elemento = $(this)[0].parentElement.parentElement;
    idEsquema = $(elemento).attr("taskId");

    data.push(idEsquema);

    crudEsquema(data, "read_id").then((result) => {
        setDataEsquema();
    }).catch((err) => {
        alert(err);
    })
})

$(document).on('click', '#btnGuardarEsquema', function () {
    let estEsq = document.getElementById("select_estatusEsq").selectedOptions[0].text;
    let comEsq = $("#input_comisionEsq").val();
    let precEsq = $("#input_PListaEsq").val();
    let idEsq = idEsquema;
    

    let textcomEsq = $.trim($("#input_comisionEsq").val());
    let textprecEsq = $.trim($("#input_PListaEsq").val());

    let val = 0;
    if (textcomEsq.length > 0) {
        $("#input_comisionEsq").addClass("border border-success");
        val += 1;
    } else {
        $("#input_comisionEsq").addClass("border border-danger");
        val += 0;
    }

    if (textprecEsq.length > 0) {
        $("#input_PListaEsq").addClass("border border-success");
        val += 1;
    } else {
        $("#input_PListaEsq").addClass("border border-danger");
        val += 0;
    }

    if (val == 2) {
        data.push(idEsq);
        data.push(precEsq);
        data.push(estEsq);
        data.push(comEsq);
        
        crudEsquema(data, "update").then((result) => {
            var spt = result.split(",");
            console.log(data);
            data = [];
            if (spt[1] == 1) {
                arrToast.push(spt[0]);
                arrToast.push(icon_success)
                showToastCte(arrToast);
                // resetFormCFDI();
                $("#input_comisionEsq").removeClass("border border-success border-danger")
                $("#input_PListaEsq").removeClass("border border-success border-danger")
            } else if (spt[1] == 0) {
                arrToast.push(spt[0])
                arrToast.push(icon_error)
                showToastCte(arrToast)
                $("#input_PListaEsq").removeClass("border border-success border-danger")
                $("#input_PListaEsq").addClass("border border-danger");
            } else if (spt[1] == -1) {
                arrToast.push(spt[0]);
                arrToast.push(icon_error)
                showToastCte(arrToast);
                $("#input_comisionEsq").removeClass("border border-success border-danger")
                $("#input_PListaEsq").removeClass("border border-success border-danger")
            }
        }).catch((err) => {
            arrToast.push("" + err);
            arrToast.push(icon_error)
            showToastCte(arrToast);
        })
    } else {
        arrToast.push("Uno o más campos no cumplen con la información requerida, favor de verificarlos.");
        arrToast.push(icon_error)
        showToastCte(arrToast);
    }
})

$(document).on('click', '#btnTableGuardarEsquema', function () {
    $('#staticBackdropTableEsquema').modal('hide');
    $("#staticBackdropEsquema2").modal("show");
})

$('#btnBuscarEsqDoc').on('click', function () {
    $("#select_clienteEsq").removeClass("border border-success border-danger")
    $("#select_documentoEsq").removeClass("border border-success border-danger")
    let cliEsq = $('#select_clienteEsq').val();
    let docuEsq = document.getElementById("select_documentoEsq").selectedOptions[0].text;

    let val = 0;

    if (cliEsq == 0) {
        $("#select_clienteEsq").addClass("border border-danger");
        val += 0;
    } else {
        $("#select_clienteEsq").addClass("border border-success");
        val += 1;
    }

    if (docuEsq == 'Selecciona un documento') {
        $("#select_documentoEsq").addClass("border border-danger");
        val += 0;
    } else {
        $("#select_documentoEsq").addClass("border border-success");
        val += 1;
    }

    if (val == 2) {
        data.push(cliEsq);
        data.push(docuEsq);
    
        crudEsquema(data, "read_doc").then((result) => {
            var spt = result.split(",");
            if (spt[1 == 1]) {
                $("#select_clienteEsq").addClass("border border-success");
            $("#select_documentoEsq").addClass("border border-success");
            } else {
                
            }
            data = []
            
        }).catch((err) => {
            alert(err)
            response_err = 404;
        });
    } else {
        arrToast.push("Falta seleccionar algún dato, favor de verificarlos.");
        arrToast.push(icon_error)
        showToastCte(arrToast);
    }

});

$(document).on("click", "#btnEditDocEsquema", function () {
    $('#staticBackdropEsquema').modal('show');

    let elemento = $(this)[0].parentElement.parentElement;
    idEsquema = $(elemento).attr("taskId");

    data.push(idEsquema);

    crudEsquema(data, "read_id").then((result) => {
        setDataEsquema();
    }).catch((err) => {
        alert(err);
    })
})

$(document).on("click", "#btnCancelDocEsquema", function () {
    resetEsquemaCliente();
})