<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <h4><i class="fa-solid fa-circle-info text-info"></i> Usuarios</h4>
    </div>
    <hr>
    <!-- Done -->
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header"><i class="fa-solid fa-caret-right"></i> Roles</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo Rol</h5>
                <p class="card-text">Cargo que desempeñan los usuarios registrados, en base a sus funciones, tareas asignadas y/o resposabilidades dentro de la empresa.</p>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropRol" id="btnModalRol"><i class="fa-solid fa-plus"></i> Nuevo</a>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropTableRol" id="btnTableRol"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>
    <br>
    <!-- Modal Tables -->
    <div class="modal fade" id="staticBackdropTableRol" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropUsersLabe1" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropUsersLabe1"><i class="fa-solid fa-users"></i> Cardex Roles de Usuarios</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <div class="container-fluid">
                        <div style="height: 350px; overflow-y:scroll;" class="mb-3 table-responsive rounded text-nowrap">
                            <table class="table table-hover table-striped">
                                <thead class="sticky-top">
                                    <tr>
                                        <th class="text-center">Accion</th>
                                        <th class="text-center">Descripción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbRolUser">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnTableGuardarRol">Agregar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toastUsers" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img id="icon_toast" src="../../img/iconos/x16/check.png" class="rounded me-2" alt="..." width="16px" height="16px">
                <strong class="me-auto">CBSU</strong>
                <small>Justo Ahora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p id="messageU_toast"></p>
            </div>
        </div>
    </div>
    <!-- Modal Register -->
    <div class="modal fade" id="staticBackdropRol" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropUsersLabe2" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropUsersLabe2"> Rol </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form>
                            <div class="row my-2">
                                <div class="col-2" id="nivRol">
                                    <label for="message-text" class="col-form-label">Nivel:</label>
                                    <input type="text" class="form-control" id="input_nivRol">
                                </div>
                                <div class="col-10">
                                    <label for="message-text" class="col-form-label">Descripción:</label>
                                    <input type="text" class="form-control" id="input_descRol">
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelRol">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarRol"></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Delete -->
    <div class="modal fade" id="modalDeleteUsers" tabindex="-1" aria-labelledby="exampleModalLabelUsers" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabelUsers"><i class="fa-solid fa-triangle-exclamation text-warning"></i> Eliminar </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Estas por eliminar <h8 id="textDelete"> </h8> seleccionado, sí lo <strong>eliminas</strong> esta acción no podra ser revocada más tarde, aún así
                    <strong>¿Deseas continuar?</strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnDeleteCancelUsers">No, Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnDeleteConfirmUsers">Si, Eliminar</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>