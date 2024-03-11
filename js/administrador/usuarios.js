$(document).ready(function () {
    var version = "0.0.1";
    console.log(version)
});

var data = [];
var response_err = 0;
var arrToast = [];

var icon_success = "../../img/iconos/x16/check.png";
var icon_error = "../../img/iconos/x16/error.png";
var icon_info = "../../img/iconos/x16/idea.png";

function showToastUsers(dataArray) {
    const toastLiveExample = document.getElementById('toastUsers')

    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

    $("#messageU_toast").text(dataArray[0]);
    $("#icon_toast").attr("src", dataArray[1]);
    toastBootstrap.show()
    // limpia el arreglo
    arrToast = [];
}

function crudRoles(array, action) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "../../functions/administrador/crudRoles.php",
            type: "GET",
            data: { data: array, action },
            success: function (response) {
                let result = JSON.parse(response);
                let template = "";
                result.forEach((resultdata) => {
                    if (resultdata.action != "none") {
                        if (resultdata.validation == 0) {
                            template += `<tr taskId="0">
                            <th colspan="26" class="table text-center">${resultdata.message}</th>
                            </tr>`;
                            resolve(resultdata.message + ',' + resultdata.validation)
                        } else {
                            if (resultdata.action == "read") {
                                if (resultdata.validation == 1) {
                                    template += `<tr taskId="${resultdata.rol_0}">
                                    <td class="text-center"><button type="button" class="btn btn-primary btn-sm" id="btnEditRol"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" id="btnDeleteRol"><i class="fa-solid fa-trash-can"></i></button></td>
                                    <td class="text-start">${resultdata.rol_1}</td>
                                    </tr>`;
                                }
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "read_id") {
                                data = [];
                                data.push(resultdata.rol_0)
                                data.push(resultdata.rol_1)
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "update") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "delete") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            } else if (resultdata.action == "insert") {
                                resolve(resultdata.message + ',' + resultdata.validation);
                            }
                        }
                    } else {
                        resolve(resultdata.message + ',' + resultdata.validation);
                    }
                });

                if (action == "read") {
                    $("#tbRolUser").html(template);
                }
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                reject(txtStatus)
            }
        });
    })
}

function setDataRol() {
    $('#input_nivRol').val(data[0]);
    $('#input_nivRol').prop("disabled", true)
    $('#input_descRol').val(data[1]);

    data = [];

    action = "update";
}

function resetRol() {

    $('#input_nivRol').val("")
    $('#input_descRol').val("")
    $("#input_descRol").removeClass("border border-success border-danger")
    data = [];

}

$('#btnTableRol').on('click', function () {
    crudRoles([""], "read").then((result) => {
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

$('#btnModalRol').on('click', function () {
    $('#staticBackdropUsersLabe2').html("Nuevo Rol");
    $('#btnGuardarRol').html("Agregar");
})

$(document).on("click", "#btnEditRol", function () {
    $('#staticBackdropUsersLabe2').html("Modificar Rol del Usuario");
    $('#btnGuardarRol').html("Actualizar");
    $('#staticBackdropTableRol').modal('hide');
    $('#staticBackdropRol').modal('show');

    let elemento = $(this)[0].parentElement.parentElement;
    idRol = $(elemento).attr("taskId");

    data.push(idRol);

    crudRoles(data, "read_id").then((result) => {
        setDataRol();
    }).catch((err) => {
        alert(err);
    })
})

$('#btnGuardarRol').on('click', function () {
    let idRol = $("#input_nivRol").val();
    let descRol = $("#input_descRol").val();

    data.push(idRol);
    data.push(descRol);

    if ($('#btnGuardarRol').text() == "Actualizar") {
        crudRoles(data, "update").then((result) => {
            var spt = result.split(",");
            data = [];
            if (spt[1] == 1) {
                arrToast.push(spt[0]);
                arrToast.push(icon_success)
                showToastUsers(arrToast);
                resetRol();
            } else if (spt[1] == 0) {
                arrToast.push(spt[0])
                arrToast.push(icon_error)
                showToastUsers(arrToast)
                $("#input_descRol").addClass("border border-danger");
            } else if (spt[1] == -1) {
                arrToast.push(spt[0]);
                arrToast.push(icon_error)
                showToastUsers(arrToast);
            }
        }).catch((err) => {
            arrToast.push("" + err);
            arrToast.push(icon_error)
            showToastUsers(arrToast);
        })
    } else if ($('#btnGuardarRol').text() == "Agregar") {
        let textdescRol = $.trim($("#input_descRol").val());

        let val = 0;

        if (textdescRol.length > 0) {
            $("#input_descRol").addClass("border border-danger");
            val += 0;
        } else {
            $("#input_descRol").addClass("border border-success");
            val += 1;
        }

        if (val == 1) {
            crudRoles(data, "insert").then((result) => {
                var spt = result.split(",");
                data = [];
                if (spt[1] == 1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_success)
                    showToastUsers(arrToast);
                    $("#input_descRol").removeClass("border border-success border-danger")
                    resetRol();
                } else if (spt[1] == 0) {
                    arrToast.push(spt[0])
                    arrToast.push(icon_error)
                    showToastUsers(arrToast)
                } else if (spt[1] == -1) {
                    arrToast.push(spt[0]);
                    arrToast.push(icon_error)
                    showToastUsers(arrToast);
                    $("#input_descRol").removeClass("border border-success border-danger")
                }
            }).catch((err) => {
                arrToast.push("" + err);
                arrToast.push(icon_error)
                showToastUsers(arrToast);
            }) 
        }  
    }
})

$(document).on("click", "#btnDeleteRol", function () {
    $('#exampleModalLabelUsers').html("Eliminar Rol");
    $('#textDelete').html("el Rol");

    data = [];

    let elemento = $(this)[0].parentElement.parentElement;
    idRol = $(elemento).attr("taskId");

    data.push(idRol);
    $("#modalDeleteUsers").modal("show");
})

$('#btnDeleteConfirmUsers').on('click', function () {
    crudRoles(data, "delete").then((result) => {
        var spt = result.split(",");
        data = [];
        if (spt[1] == 1) {
            arrToast.push(spt[0]);
            arrToast.push(icon_success)
            showToastUsers(arrToast);
            $("#modalDeleteUsers").modal("hide");
            return crudRoles([""], "read");
        } else if (spt[1] == 0) {
            arrToast.push(spt[0]);
            arrToast.push(icon_error)
            showToastUsers(arrToast);
        } else if (spt[1] == -1) {
            arrToast.push(spt[0]);
            arrToast.push(icon_error)
            showToastUsers(arrToast);
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

$('#btnTableGuardarRol').on('click', function () {
    $('#staticBackdropUsersLabe2').html("Nuevo Rol");
    $('#btnGuardarRol').html("Agregar");
    $('#staticBackdropTableRol').modal('hide');
    $('#staticBackdropRol').modal('show');
    $('#nivRol').hide();
})