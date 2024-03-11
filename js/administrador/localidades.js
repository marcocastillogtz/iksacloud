$(document).ready(function () {
  var version = "0.0.3";
  console.log(version);
  $("#btnSpinnerMunicipio").hide();
});

var arrToast = [];
var icon_success = "../../img/iconos/x16/check.png";
var icon_error = "../../img/iconos/x16/error.png";

$(document).on("click", "#btnSavePoblacionn", function () {
  let estado = $("#estado_poblacion_select_client").val();
  let municipio = $("#municipio_select_client").val();
  let poblacion = $("#recipient-poblacion").val();


  savePoblacion(estado, municipio, poblacion);

});

function savePoblacion(estado, municipio, poblacion) {
  data = [];

  data.push(estado);
  data.push(municipio);
  data.push(poblacion);

  crudPoblacion(data, "savePoblacion").then((result) => {
    if (result == 1) {
      alert("Se inserto la poblacion correctamente");
    } else if (result == 0) {
      alert("Ocurrio un problema al registrar la poblacion");
    }

  })
}

function crudPoblacion(data, action) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "../../functions/administrador/crudPoblacion.php",
      type: "GET",
      data: { data, action },
      success: function (response) {
        let item = JSON.parse(response);
        let template = "";
        item.forEach((item) => {
          if (item.validation == 1) {
            console.log('Success => crudPoblacion');
          } else {
            console.log('Error => crudPoblacion');
          }
        });
      },
      error: function (XMLHttpRequest, txtStatus, errorThrown) {
        alert("Request: " + XMLHttpRequest);
        alert("Estatus: " + txtStatus);
        alert("Error: " + errorThrown);
      },
    });
  });
}

$(document).on("click", "#btnCancelMunicipio", function () {
  resetForm()
})

$(document).on("click", "#btnSaveMunicipio", function () {
  let estado = $("#estado_select_client").val();
  let municipio = $("#recipient-municipio").val();

  if (validateForm() == 2) {
    data.push(estado);
    data.push(municipio);
    showSpinner()
    crudMunicipio(data, "saveMunicipio").then((result) => {
      if (result == 1) {
        hideSpinner()
        arrToast.push("El municipio " + municipio + " se ha registrado correctamente");
        arrToast.push(icon_success);
        showToastLocation(arrToast);
        resetForm();
      } else if (result == 0) {
        alert("Ocurrio un problema al registrar el municipio");
      }

      data = [];
    }).catch((error) => {
      arrToast.push("Ocurrio un error: " + error);
      arrToast.push(icon_error);
      showToastLocation(arrToast);
    });
  } 
});

$(document).on("change", "#estado_poblacion_select_client", function () {
  data = [];
  $("#municipio_select_client").empty();
  let id = $(this).val();
  data.push(id);

  crudMunicipio(data, "getMunicipioById").then((result) => {
    data = [];
  }).catch((error) => {
    arrToast.push("Ocurrio un error: " + error);
    arrToast.push(icon_error);
    showToastLocation(arrToast);
  });
});

function crudMunicipio(data, action) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "../../functions/administrador/crudMunicipio.php",
      type: "GET",
      data: { data, action },
      success: function (response) {
        let item = JSON.parse(response);
        let template = "";
        item.forEach((item) => {
          if (item.action == 'getMunicipioById') {
            if (item.validation == 1) {
              $('#municipio_select_client').append($('<option>', { value: item.idMunicipio, text: item.municipio }));
            } else if (item.validation == 0) {
              $('#municipio_select_client').append($('<option value="Sin resultados">Sin Resultados</option>'));
            }
            resolve(item.validation)
          } else if (item.action == 'saveMunicipio') {
            resolve(item.validation)
          }
        });
      },
      error: function (XMLHttpRequest, txtStatus, errorThrown) {
        alert("Request: " + XMLHttpRequest);
        alert("Estatus: " + txtStatus);
        alert("Error: " + errorThrown);
      },
    });
  });
}

function showToastLocation(dataArray) {

  const toastLiveExample = document.getElementById('toastLocation')
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

  $("#message_toast_loc").text(dataArray[0]);
  $("#icon_toast_loc").attr("src", dataArray[1]);
  toastBootstrap.show()
  // limpia el arreglo
  arrToast = [];
}

function showSpinner() {
  $("#btnSaveMunicipio").hide();
  $("#btnSpinnerMunicipio").show();
}

function hideSpinner() {
  $("#btnSaveMunicipio").show();
  $("#btnSpinnerMunicipio").hide();
}

function resetForm() {
  $('#estado_select_client').val(0);
  $('#recipient-municipio').val("");
  $("#recipient-municipio").removeClass("border border-success border-danger")
  $("#estado_select_client").removeClass("border border-success border-danger")
}

function validateForm() {
  let text = $.trim($("#recipient-municipio").val());
  let val = 0;
  if (text.length > 5) {
    $("#recipient-municipio").addClass("border border-success");
    val += 1;
  }else{
    $("#recipient-municipio").addClass("border border-danger");
    val -= 0;
  }

  let option = $("#estado_select_client").val();

  if (option > 0) {
    $("#estado_select_client").addClass("border border-success");
    val += 1;
  }else{
    $("#estado_select_client").addClass("border border-danger");
    val -= 0;
  }

  return val;
}

var data = [];

$(document).on("click", "#btnTableMunicipio", function () {
  //getMuniciposTable();
  $("#selectEstadoModal").val('All');
  $("#tblMunicipios").html('<tr taskId="${item.idMunicipio}"><td class="text-center" colspan="3">Selecciona un Estado</td></tr>');
  
  $('#modalMunicipios').modal('show');
});

$(document).on("change", "#selectEstadoModal", function () {
  let estado = $("#selectEstadoModal").val();
  getMuniciposTable(estado);
});

function getMuniciposTable(estado) {
  
  data = [];
  data.push('getMunicipios');
  data.push(estado);

  action = "getMunicipios";

  return new Promise((resolve, reject) => {
    $.ajax({
      url:"../../functions/administrador/crudMunicipio.php",
      type:"GET",
      data: { data,action },
      success: function (response) {
        let item = JSON.parse(response);
        let template = "";
           item.forEach((item) => {
               if (item.validation == 1) {
                //  alert('Se realizo la operacion correctamente');
                template += `<tr taskId="${item.idMunicipio}" taskMunicipio="${item.municipio}">
                                <td class="text-center">${item.municipio}</td>
                                <td class="text-center">${item.estado}</td>
                                <td class="text-center">
                                <button type="button" class="btn btn-primary btn-sm" id="btnEditMun"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" id="btnDeleteMun"><i class="fa-solid fa-trash-can"></i></button></td>
                              </tr>`;

               } else {
                //  alert('Operacion Invalida')
                template += `<tr taskId="${item.idMunicipio}">
                                <td class="text-center" colspan="3">Sin Resultados</td>
                              </tr>`;
               }
               $("#tblMunicipios").html(template);
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
        // $('#modalMunicipios').modal('show');
      } else {
        // $('#modalMunicipios').modal('show');
      }
  })

}

$(document).on("click", "#btnEditMun", function () {
  let elemento = $(this)[0].parentElement.parentElement;
  let idp = $(elemento).attr("taskId");
  let municipio = $(elemento).attr("taskMunicipio");
  
  $("#txtIdMunicipio").val(idp);
  $("#txtMunicipio").val(municipio);

  $('#modalEditMunicipio').modal('show');
});


$(document).on("click", "#btnActualizarMunModal", function () {

  let id = $("#txtIdMunicipio").val();
  let municipio = $("#txtMunicipio").val();

  data = [];
  data.push('actualizarMunicipios');
  data.push(id);
  data.push(municipio);

  action = "actualizarMunicipios";

  actualizarMunicipio(data,action);
});


function actualizarMunicipio(data,action){
  $("#btnActualizarMunModal").prop('disabled',true);
  $("#btnActualizarMunModal").html('Actualizando..');
  return new Promise((resolve, reject) => {
    $.ajax({
      url:"../../functions/administrador/crudMunicipio.php",
      type:"GET",
      data: { data,action },
      success: function (response) {
        let item = JSON.parse(response);
        // let template = "";
           item.forEach((item) => {
               if (item.validation == 1) {
                //  alert('Se actualizo correctamente el municipio');
                
                $('#toastMunicipios .toast-body').empty();
                const ToastLive = $('#toastMunicipios');
                const toast = new bootstrap.Toast(ToastLive);
                $(".toast-body").append("<h4>Se actualizo correctamente el municipio</h4>");
                toast.show();

               } else {
                //  alert('Ocurrio un problema al actualizar el municipio');
                $('#toastMunicipios .toast-body').empty();
                const ToastLive = $('#toastMunicipios');
                const toast = new bootstrap.Toast(ToastLive);
                $(".toast-body").append("<h4>Ocurrio un problema al actualizar el municipio</h4>");
                toast.show();

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
        $("#btnActualizarMunModal").prop('disabled',false);
        $("#btnActualizarMunModal").html('Actualizar');
        return 1;
      } else {
        console.log('No se actualizo la informacion');
        return 0;
      }
  }).then((response)=>{
    if (response == 1) {
      $("#modalEditMunicipio").modal('hide');
      return 1;
    } else {
      console.log('No se cerrar el modal');
      return 0;
    }
  }).then((response)=>{
    if (response == 1) {
      let estado = $("#selectEstadoModal").val();
      getMuniciposTable(estado);
    } else {
      console.log('No se refescara la tabla');
    }
  })

}


$(document).on("click", "#btnDeleteMun", function () {
  let elemento = $(this)[0].parentElement.parentElement;
  let idp = $(elemento).attr("taskId");
  $("#txtDeleteIdMunicipio").val(idp);

  $('#modalDeleteMunicipio').modal('show');
});


$(document).on("click", "#btnEliminarMunicipio", function () {
  let idd = $("#txtDeleteIdMunicipio").val();
  data=[];
  data.push('eliminarMunicipio');
  data.push(idd);
  
  action = 'eliminarMunicipio';

  eliminarMunicipio(data,action);
});

function eliminarMunicipio(data,action) {
  $("#btnEliminarMunicipio").prop('disabled',true);
  $("#btnEliminarMunicipio").html('Eliminando..');

  return new Promise((resolve, reject) => {
    $.ajax({
      url:"../../functions/administrador/crudMunicipio.php",
      type:"GET",
      data: { data,action },
      success: function (response) {
        let item = JSON.parse(response);
        // let template = "";
           item.forEach((item) => {
               if (item.validation == 1) {
                //  alert('Se elimino el municipio correctamente');
                $('#toastMunicipios .toast-body').empty();
                const ToastLive = $('#toastMunicipios');
                const toast = new bootstrap.Toast(ToastLive);
                $(".toast-body").append("<h4>Se elimino el municipio correctamente</h4>");
                toast.show();

               } else {
                //  alert('Ocurrio un problema al eliminar el municipio');
                $('#toastMunicipios .toast-body').empty();
                const ToastLive = $('#toastMunicipios');
                const toast = new bootstrap.Toast(ToastLive);
                $(".toast-body").append("<h4>Ocurrio un problema al eliminar el municipio</h4>");
                toast.show();

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
        $("#btnEliminarMunicipio").prop('disabled',false);
        $("#btnEliminarMunicipio").html('Eliminar');

        $("#modalDeleteMunicipio").modal('hide');
        return 1;
      } else {
        console.log('No se cerrar el modal');
        return 0;
      }
  }).then((response)=>{
    if (response == 1) {
      let estado = $("#selectEstadoModal").val();
      getMuniciposTable(estado);    
    } else {
      console.log('No se refrescara la tabla');
    }
  })
}

$(document).on("change","#estadoPoblacionModal", function() {
/*  
  data = [];
  $("#municipioPoblacionModal").empty();
  $('#municipioPoblacionModal').append($('<option value="" selected>Selecciona un municipio..</option>'));

  let id = $(this).val();
  data.push(id);
  action = 'getMunicipioById';

  getMunicipioById(data,action)
*/
let value = $(this).val();

  if (value == 'All') {
    $("#municipioPoblacionModal").empty();
    $('#municipioPoblacionModal').append($('<option value="" selected>Selecciona un municipio..</option>'));


    $("#tblPoblaciones").html('<tr taskId="${item.idMunicipio}"><td class="text-center" colspan="3">Sin Resultados</td></tr>');
  } else {
    data = [];
    $("#municipioPoblacionModal").empty();
    $('#municipioPoblacionModal').append($('<option value="" selected>Selecciona un municipio..</option>'));

    let id = $(this).val();
    data.push(id);
    action = 'getMunicipioById';

    getMunicipioById(data,action)
  }

})

function getMunicipioById(data,action) {
  return new Promise((resolve, reject) => {
  
    $.ajax({
      url:"../../functions/administrador/crudMunicipio.php",
      type:"GET",
      data: { data,action },
      success: function (response) {
        let item = JSON.parse(response);
           item.forEach((item) => {
               if (item.validation == 1) {
                $('#municipioPoblacionModal').append($('<option>', { value: item.idMunicipio, text: item.municipio }));
               } else {
                $('#municipioPoblacionModal').append($('<option value="Sin resultados">Sin Resultados</option>'));
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
        console.log('Se obtuvo informacion correctamente');
      } else {
        console.log('Ocurrio un problema al recuperar la informacion');
      }
  })

}


$(document).on("change","#municipioPoblacionModal",function() {
  let estadito = $("#estadoPoblacionModal").val();
  let municipito = $("#municipioPoblacionModal").val();

  data = [];
  data.push(estadito);
  data.push(municipito);
  action = 'getPoblacionMunicipioById';

  getPoblacionByMunicipio(data,action);

});

function getPoblacionByMunicipio(data,action) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url:"../../functions/administrador/crudMunicipio.php",
      type:"GET",
      data: { data,action },
      success: function (response) {
        let item = JSON.parse(response);
        let template = " ";
           item.forEach((item) => {
               if (item.validation) {
                //  alert('Se realizo la operacion correctamente');
                template += `<tr taskId="${item.idPoblacion}" taskPoblacion="${item.poblacion}">
                                <td class="text-center">${item.poblacion}</td>
                                <td class="text-center">
                                <button type="button" class="btn btn-primary btn-sm" id="btnEditPoblacion"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" id="btnDeletePoblacion"><i class="fa-solid fa-trash-can"></i></button></td>
                              </tr>`;
               } else {
                //  alert('Operacion Invalida')
                              template += `<tr taskId="${item.idMunicipio}">
                                <td class="text-center" colspan="3">Sin Resultados</td>
                              </tr>`;
               }
               $("#tblPoblaciones").html(template);
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




$(document).on("click","#btnEditPoblacion",function() {
  //alert("se editara la poblacion");
  $("#modalEditPoblacion").modal('show');

  let elemento = $(this)[0].parentElement.parentElement;
  let id = $(elemento).attr("taskId");
  let poblacion = $(elemento).attr("taskPoblacion");
  
  $("#txtIdPoblacion").val(id);
  $("#txtPoblacion").val(poblacion);

});

$(document).on("click","#btnActualizarPoblacionModal",function() {
  let id = $("#txtIdPoblacion").val();
  let poblacion = $("#txtPoblacion").val();

  data=[];
  data.push(id);
  data.push(poblacion);
  action = "actualizarPoblacion";

  actualizarPoblacion(data,action);
});

function actualizarPoblacion(data,action) {
  $("#btnActualizarPoblacionModal").prop('disabled',true);
  $("#btnActualizarPoblacionModal").html('Actualizando..');

  return new Promise((resolve, reject) => {
    $.ajax({
      url:"../../functions/administrador/crudMunicipio.php",
      type:"GET",
      data: { data,action },
      success: function (response) {
        let item = JSON.parse(response);
        // let template = "";
           item.forEach((item) => {
               if (item.validation == 1) {
                //  alert('Se actualizo la poblacion correctamente');
                $('#toastPoblacion .toast-body').empty();
                const ToastLive = $('#toastPoblacion');
                const toast = new bootstrap.Toast(ToastLive);
                $(".toast-body").append("<h4>Se actualizo la poblacion correctamente</h4>");
                toast.show();

               } else {
                //  alert('Ocurrio al actualizar la poblacion');
                $('#toastPoblacion .toast-body').empty();
                const ToastLive = $('#toastPoblacion');
                const toast = new bootstrap.Toast(ToastLive);
                $(".toast-body").append("<h4>Ocurrio al actualizar la poblacion</h4>");
                toast.show();

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
        $("#btnActualizarPoblacionModal").prop('disabled',false);
        $("#btnActualizarPoblacionModal").html('Actualizar');
        $("#txtPoblacion").val('');
        $("#modalEditPoblacion").modal('hide');
        return 1;
      } else {
        console.log('No se cerrar el modal');
        return 0;
      }
  }).then((response)=>{
    if (response == 1) {
      let estadito = $("#estadoPoblacionModal").val();
      let municipito = $("#municipioPoblacionModal").val();

      data = [];
      data.push(estadito);
      data.push(municipito);
      action = 'getPoblacionMunicipioById';

      getPoblacionByMunicipio(data,action);
    } else {
      console.log('No se actualizara la tabla');
    }
  })

}

$(document).on("click","#btnDeletePoblacion",function() {
  // alert("se eliminara la poblacion");
  $("#modalDeletePoblacion").modal('show');

  let elemento = $(this)[0].parentElement.parentElement;
  let id = $(elemento).attr("taskId");

  $("#txtDeleteIdPoblacion").val(id);
});


$(document).on("click","#btnEliminarPoblacion",function() {
  let idPoblacion = $("#txtDeleteIdPoblacion").val();

  // alert('este es el id de la poblacion'+idPoblacion);
  data=[];
  data.push(idPoblacion);
  action="deletePoblacion";

  deletePoblacion(data,action);
});

function deletePoblacion(data,action){
  $("#btnEliminarPoblacion").prop('disabled',true);
  $("#btnEliminarPoblacion").html('Eliminando..');

  return new Promise((resolve, reject) => {
    $.ajax({
      url:"../../functions/administrador/crudMunicipio.php",
      type:"GET",
      data: { data,action },
      success: function (response) {
        let item = JSON.parse(response);
        // let template = " ";
           item.forEach((item) => {
               if (item.validation == 1) {
                //  alert('Se elimino la poblacion correctamente');
                
                $('#toastPoblacion .toast-body').empty();
                const ToastLive = $('#toastPoblacion');
                const toast = new bootstrap.Toast(ToastLive);
                $(".toast-body").append("<h4>Se elimino la poblacion correctamente</h4>");
                toast.show();


               } else {
                //  alert('Ocurrio un problema al eliminar la poblacion')
                $('#toastPoblacion .toast-body').empty();
                const ToastLive = $('#toastPoblacion');
                const toast = new bootstrap.Toast(ToastLive);
                $(".toast-body").append("<h4>Ocurrio un problema al eliminar la poblacion</h4>");
                toast.show();

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
        $("#btnEliminarPoblacion").prop('disabled',false);
        $("#btnEliminarPoblacion").html('Eliminar');

        $("#modalDeletePoblacion").modal('hide');
        return 1;
      } else {
        console.log('No se cerrar el modal');
        return 0;
      }
  }).then((response)=>{
    if (response == 1) {
      
      let estadito = $("#estadoPoblacionModal").val();
      let municipito = $("#municipioPoblacionModal").val();

      data = [];
      data.push(estadito);
      data.push(municipito);
      action = 'getPoblacionMunicipioById';

      getPoblacionByMunicipio(data,action);

    } else if(response == 0){
      console.log('No se actualizara la tabla');
    }
  })

}

$(document).on("click", "#btnTablePoblacion", function () {
  $('#modalPoblacion').modal('show');

  let estado;
  let municipio;
  
})