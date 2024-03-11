$(document).ready(function () {
    console.log('v1.1.20');
});

var action = "insert";
var idModulo = 0;
var modulo = '';
var path = '';
var estatus = '';

var border_danger = 'border-danger';
var border_success = 'border-success';
var border_warning = 'border-warning';

function init() {
    idModulo = 0;
    modulo = '';
    path = '';
    estatus = '';

}

// Funciones para modulos
function crudModules(id, modulo, estatus, url, action) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "../../functions/administrador/crudModules.php",
            type: "GET",
            data: { id, modulo, estatus, url, action },
            success: function (response) {
                let result = JSON.parse(response);
                let template = "";
                result.forEach((data) => {
                    let validation = data.validation;
                    let message = data.message;

                    if (action == 'insert' || action == 'update' || action == 'delete') {
                        template += '';
                        resolve(message);
                    } else if (action == 'read') {
                        let idBtnUpdate = "";
                        let iconUpdate = "";
                        let text_class = data.status;
                        let classButonUpdate = '';
                        let text="";

                        if (text_class == "Enable") {
                            text_class = 'text-success';
                            idBtnUpdate = "btnDelete";
                            iconUpdate = '<i class="fa-solid fa-trash-can"></i>';
                            classButonUpdate = "btn-danger";
                            text="Disponible";
                        } else if (text_class == "Disabled") {
                            text_class = "text-danger";
                            idBtnUpdate = "btnUpdate";
                            iconUpdate = '<i class="fa-solid fa-rotate-right"></i>';
                            classButonUpdate = "btn-warning";
                            text="Suspendido";
                        }

                        template += `<tr taskId="${data.id}" taskModulo="${data.module}" taskStatus="${data.status}" taskUrl="${data.url}">
                            <th>${data.id}</th>
                            <td>${data.module}</td>
                            <td><p class="${text_class}">${text}</p></td>
                            <td>${data.url}</td>
                            <td><button type="button" class="btn btn-primary btn-sm" id="btnEdit"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn ${classButonUpdate} btn-sm" id="${idBtnUpdate}">${iconUpdate}</button></td>
                            </tr>`;

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

$(document).on("click", "#btnSave", function () {
    idModulo = $("#nivelForm").val()
    modulo = $("#ModuloName").val()
    path = $("#pathModule").val()
    estatus = $("#selectEstatus").val()

    crudModules(idModulo, modulo, estatus, path, action).then((result) => {
        $('#staticBackdropModule').modal('hide');
        action = "insert";
        init();
        alert(result);
    }).catch((error) => {
        alert(error);
    });
});

$(document).on("click", "#btnTableMod", function () {
    crudModules(null, null, null, null, "read").then((result) => {
        $('#staticBackdropModule').modal('hide');
    }).catch((error) => {
        alert("Error");
    });
});

function genPath() {
    $('#pathModule').val('../' + $('#ModuloName').val());
}

$(document).on("click", "#btnEdit", function () {

    $('#staticTableModule').modal('hide');
    $('#staticBackdropModule').modal('show');

    let elemento = $(this)[0].parentElement.parentElement;
    idModulo = $(elemento).attr("taskId");
    modulo = $(elemento).attr("taskModulo");
    estatus = $(elemento).attr("taskStatus");
    path = $(elemento).attr("taskUrl");


    $('#selectEstatus').prop("disabled", true);
    $('#nivelForm').val(idModulo);
    $('#ModuloName').val(modulo);
    $('#selectEstatus').val(estatus);
    $('#pathModule').val(path);

    action = "update";
});

$(document).on("click", "#btnDelete", function () {
    action = "delete";
    let elemento = $(this)[0].parentElement.parentElement;
    idModulo = $(elemento).attr("taskId");
    crudModules(idModulo, "", "Disabled", "", action).then((result) => {
        return crudModules(null, null, null, null, "read");
    }).then((result_2) => {
        action = "insert";
        init();
        // alert(result_2);
    }).catch((error) => {
        alert(error);
    });
});

$(document).on("click", "#btnUpdate", function () {
    action = "delete";
    let elemento = $(this)[0].parentElement.parentElement;
    idModulo = $(elemento).attr("taskId");
    crudModules(idModulo, "", "Enable", "", action).then((result) => {
        return crudModules(null, null, null, null, "read");
    }).then((result_2) => {
        action = "insert";
    }).catch((error) => {
        alert(error);
    });
});
// Fin de funciones de modulos 



// Funciones para submodulos
var id = 0;
var submodulo = '';
var icon = '<i class="fa-solid fa-code"></i>';

function crudSubmodules(id, smodulo, estatus, idMod, icon, action) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "../../functions/administrador/crudSubmodules.php",
            type: "GET",
            data: { id, smodulo, estatus, idMod, icon, action },
            success: function (response) {
                let result = JSON.parse(response);
                let template = "";
                result.forEach((data) => {
                    let validation = data.validation;
                    let message = data.message;


                    if (action == 'insert' || action == 'update' || action == 'delete') {
                        template += '';
                        resolve(message);
                    } else if (action == 'read') {
                        let text_class = data.estatus;
                        let estatus_mod = "";
                        let classButonUpdate = "";
                        let idBtnUpdate = "";
                        let iconUpdate = "";
                        let submoduloEstatus = "";

                        if (text_class == "Enable") {
                            text_class = "text-success";
                            classButonUpdate = "btn-danger";
                            iconUpdate = '<i class="fa-solid fa-trash-can"></i>';
                            idBtnUpdate = "btnDeleteSmod";
                        } else if (text_class = "Disabled") {
                            text_class = "text-danger";
                            classButonUpdate = "btn-warning";
                            idBtnUpdate = "btnUpdateSmod";
                            iconUpdate = '<i class="fa-solid fa-rotate-right"></i>';
                        }

                        if (data.estatus_mod == "Disabled") {
                            submoduloEstatus = "text-danger";
                            estatus_mod = "table-secondary";
                        } else if (data.estatus_mod == "Enable") {
                            submoduloEstatus = "text-success";
     
                        }


                        template += `<tr task_sb_Id="${data.id}" task_sb_Modulo="${data.submodulo}" taska_sb_Status="${data.estatus}" task_sb_Status_Mod="${data.estatus_mod}" task_sb_IDModulo="${data.idModulo}" class="${estatus_mod}">
                            <th>${data.id}</th>
                            <td>${data.submodulo}</td>
                            <td><p class="${text_class}">${data.estatus}</p></td>
                            <td><p class="${submoduloEstatus}">${data.modulo}</p></td>
                            <td><button type="button" class="btn btn-primary btn-sm" id="btnEditSm"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn ${classButonUpdate} btn-sm" id="${idBtnUpdate}">${iconUpdate}</button></td>
                            </tr>`;

                        resolve(message);
                    } else if (action == "read_id") {
                        let next_id = data.id;
                        resolve(next_id);
                    }

                })
                $("#tbSModulos").html(template);
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                reject(txtStatus)
            }
        });
    })
}

function resetVar() {
    id = 0;
    submodulo = '';
    icon = '<i class="fa-solid fa-code"></i>';
}

function resetForm() {
    $("#nivelFormSmodulo").val("")
    $("#SModuloName").val("")
    $("#SelectSModulo").val("0")
    $("#SelectEstatusSmodulo").val("Enable")
    $("#iconSModule").val("")
}

function removeClass() {
    $("#SModuloName").removeClass(border_danger);
    $("#iconSModule").removeClass(border_danger);
    $("#SelectSModulo").removeClass(border_danger);
}

$(document).on("click", "#btnSaveSModule", function () {

    var contador = 0;
    id = $("#nivelFormSmodulo").val()
    submodulo = $("#SModuloName").val()
    idModulo = $("#SelectSModulo").val()
    estatus = $("#SelectEstatusSmodulo").val()
    icon = $("#iconSModule").val()

    if (submodulo.length == 0) {
        $("#SModuloName").addClass(border_danger);
    } else {
        $("#SModuloName").removeClass(border_danger);
        contador += 1;
    }

    if (idModulo == 0) {
        $("#SelectSModulo").addClass(border_danger);
    } else {
        $("#SelectSModulo").removeClass(border_danger);
        contador += 1;
    }

    if (icon.length == 0) {
        $("#iconSModule").addClass(border_danger);
    } else {
        $("#iconSModule").removeClass(border_danger);
        contador += 1;
    }


    if (contador == 3) {
        crudSubmodules(id, submodulo, estatus, idModulo, icon, action).then((result) => {
            $('#staticBackdropSModule').modal('hide');
            action = "read_id";
            return crudSubmodules("", "", "", "", "", action);
        }).then((result_2) => {
            action = "insert";
            init();
            resetVar();
            removeClass();
            resetForm();
            $("#nivelFormSmodulo").val(result_2);
        }).catch((error) => {
            alert(error);
        });
    }
});

$(document).on("click", "#btnTableSmod", function () {
    crudSubmodules(null, null, null, null, null, "read").then((result) => {
        $('#staticBackdropSmodulos').modal('hide');
    }).catch((error) => {
        alert("Error");
    });
});

$(document).on("click", "#btnEditSm", function () {
    $('#staticTableSModule').modal('hide');
    $('#staticBackdropSmodulos').modal('show');

    let elemento = $(this)[0].parentElement.parentElement;
    id = $(elemento).attr("task_sb_Id");
    submodulo = $(elemento).attr("task_sb_Modulo");
    estatus = $(elemento).attr("taska_sb_Status");
    idModulo = $(elemento).attr("task_sb_IDModulo");


    $('#nivelFormSmodulo').val(id);
    $('#SModuloName').val(submodulo);
    $('#SelectEstatusSmodulo').val(estatus);
    $('#SelectSModulo').val(idModulo);

    action = "update";

});

$(document).on("click", "#btnUpdateSmod", function () {
    action = "delete";
    let elemento = $(this)[0].parentElement.parentElement;
    idModulo = $(elemento).attr("task_sb_Id");
    crudSubmodules(idModulo, "", "Enable", "","", action).then((result) => {
        return crudSubmodules(null, null, null, null,null, "read");
    }).then((result_2) => {
        action = "insert";
        init();
        // alert(result_2);
    }).catch((error) => {
        alert(error);
    });
});

$(document).on("click", "#btnDeleteSmod", function () {
    action = "delete";
    let elemento = $(this)[0].parentElement.parentElement;
    idModulo = $(elemento).attr("task_sb_Id");
    crudSubmodules(idModulo, "", "Disabled", "", "",action).then((result) => {
        return crudSubmodules(null, null, null, null,null, "read");
    }).then((result_2) => {
        action = "insert";
        init();
        // alert(result_2);
    }).catch((error) => {
        alert(error);
    });
});
// Fin de funciones de submodulos 