<?php
require_once('../../entidades/Estados.php');

$Estados_Object = new Estados;
$estado_data = $Estados_Object->getAll();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container-fluid">
        <h4><i class="fa-solid fa-circle-info text-info"></i> Localidades</h4>
    </div>
    <hr>

    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header"><i class="fa-solid fa-caret-right"></i> Municipio</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo Municipio</h5>
                <p class="card-text">En esta seccion podras dar de alta algun municipio que no este en nuestros registros.</p>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropMunicipio"><i class="fa-solid fa-plus"></i> Nuevo</a>
                <a href="#" class="btn btn-primary" id="btnTableMunicipio"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>
    <br>

    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header"><i class="fa-solid fa-caret-right"></i> Poblacion</h5>
            <div class="card-body">
                <h5 class="card-title">Nueva Poblacion</h5>
                <p class="card-text">En esta seccion podras dar de alta alguna poblacion que no este en nuestros registros.</p>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropPoblacion"><i class="fa-solid fa-plus"></i> Nuevo</a>
                <a href="#" class="btn btn-primary" id="btnTablePoblacion"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>
    <br>



    <div class="modal fade" id="staticBackdropMunicipio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe2" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe2">Añadir Muncipio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Estado:</label>
                                <select name="" class="form-select" id="estado_select_client" aria-describedby="idEstado">
                                    <option value="0" selected>Selecciona un estado..</option>
                                    <?php
                                    foreach ($estado_data as $data) {
                                        echo '<option value="' . $data['id_Estado'] . '">' . $data['estado'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Municipio:</label>
                                <input type="text" class="form-control" id="recipient-municipio">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancelMunicipio">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnSaveMunicipio">Agregar</button>
                    <button class="btn btn-primary" type="button" disabled id="btnSpinnerMunicipio">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span class="visually-hidden" role="status">Loading...</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>


    <div class="modal fade" id="staticBackdropPoblacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabe2" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabe2">Añadir Poblacion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Estado:</label>
                                <select name="" class="form-select" id="estado_poblacion_select_client" aria-describedby="idEstado">
                                    <option value="" selected>Selecciona un estado..</option>
                                    <?php
                                    foreach ($estado_data as $data) {
                                        echo '<option value="' . $data['id_Estado'] . '">' . $data['estado'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Municipio:</label>
                                <select name="" class="form-select" id="municipio_select_client" aria-describedby="idMunicipio">
                                    <option value="" selected>Selecciona un municipio..</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Poblacion:</label>
                                <input type="text" class="form-control" id="recipient-poblacion">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnSavePoblacionn">Agregar</button>
                </div>
            </div>
        </div>
    </div>



    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toastLocation" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img id="icon_toast_loc" src="../../img/iconos/x16/check.png" class="rounded me-2" alt="..." width="16px" height="16px">
                <strong class="me-auto">CBSU</strong>
                <small>Justo Ahora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p id="message_toast_loc"></p>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalMunicipios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Municipios</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container p-2">
                <select name="" class="form-select" id="selectEstadoModal" aria-describedby="idEstado">
                    <option value="All" selected>Selecciona un estado..</option>
                    <?php
                    foreach ($estado_data as $data) {
                        echo '<option value="' . $data['id_Estado'] . '">' . $data['estado'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            
            <div class="modal-body">
                <div style="height: 350px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Municipo</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tblMunicipios">
                                <tr>
                                    <th scope="row" colspan="5">
                                        <div class="text-center">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </tbody>

                        </table>
                    </div>
            </div>
            <nav aria-label="Page navigation">
                        <ul class="pagination">
                        </ul>
                    </nav>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 111">
            <div id="toastMunicipios" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Aviso</strong>
                    <small>Justo Ahora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body"></div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modalPoblacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Poblaciones</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select name="" class="form-select" id="estadoPoblacionModal" aria-describedby="idEstado">
                        <option value="All" selected>Selecciona un estado..</option>
                        <?php
                        foreach ($estado_data as $data) {
                            echo '<option value="' . $data['id_Estado'] . '">' . $data['estado'] . '</option>';
                        }
                        ?>
                    </select>
                        <br>
                        <select name="" class="form-select" id="municipioPoblacionModal" aria-describedby="idEstado">
                            <option value="All" selected>Selecciona un municipio..</option>
                        </select>
                        <br>
                    <div style="height: 350px; overflow-y:scroll;" class="mb-2 table-responsive rounded text-nowrap">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Poblacion</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tblPoblaciones">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 111">
            <div id="toastPoblacion" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Aviso</strong>
                    <small>Justo Ahora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body"></div>
            </div>
        </div>

        </div>
    </div>


<div class="modal fade" id="modalEditPoblacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Poblacion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <input type="text" class="form-control" id="txtIdPoblacion" disabled hidden>
      </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Poblacion</label>
                    <input type="text" class="form-control" id="txtPoblacion" placeholder="Caltenco">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnActualizarPoblacionModal">Actualizar</button>
            </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDeletePoblacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Poblacion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <input type="text" class="form-control" id="txtDeleteIdPoblacion" disabled hidden>
      </div>
      <div class="modal-body">
        <h1>Realmente deseas eliminar el Poblacion??</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnEliminarPoblacion">Si,Eliminar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalEditMunicipio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Municipio</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <input type="text" class="form-control" id="txtIdMunicipio" disabled hidden>
      </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Municipio</label>
                    <input type="text" class="form-control" id="txtMunicipio" placeholder="Amecameca">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnActualizarMunModal">Actualizar</button>
            </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDeleteMunicipio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Municipio</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <input type="text" class="form-control" id="txtDeleteIdMunicipio" disabled hidden>
      </div>
      <div class="modal-body">
        <h1>Realmente deseas eliminar el Municipio??</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnEliminarMunicipio">Si,Eliminar</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>