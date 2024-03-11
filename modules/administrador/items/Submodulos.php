<?php
require_once('../../entidades/Modulos.php');
require_once('../../entidades/Submodulos.php');
$Modulos_Object = new Modulos;
$modulo_data = $Modulos_Object->getNextID();
$data_select_modulos =  $Modulos_Object->getModulos();
$Submodulo_Object = new Submodulo;
$submodulo_data = $Submodulo_Object->getNextID();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <h4><i class="fa-solid fa-star text-warning"></i> Administrar</h4>
    </div>
    <hr>
    <!-- Done -->
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header">Modulo</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo Modulo</h5>
                <p class="card-text">Los modulos son la cabeza de un menu, sin ellas no podrás ingresar a los submodulos</p>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropModule"> <i class="fa-solid fa-pencil"></i> Registrar</a>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticTableModule" id="btnTableMod"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>
    <br>
    <!-- Done -->
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header">Submodulos</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo Submodulo</h5>
                <p class="card-text">Los Submodulos ayudan a poder ingresar parte del sistema.</p>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropSmodulos"> <i class="fa-solid fa-pencil"></i> Registrar</a>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticTableSModule" id="btnTableSmod"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header">Permisos</h5>
            <div class="card-body">
                <h5 class="card-title">Nuevo permisos</h5>
                <p class="card-text">Otorgar permisos a los usuarios ayudan a poder mantener un mejor control administrativo.</p>
                <a href="#" class="btn btn-success"> <i class="fa-solid fa-pencil"></i> Registrar</a>
                <a href="#" class="btn btn-primary"><i class="fa-solid fa-table"></i> Ver registros</a>
            </div>
        </div>
    </div>



    <!-- Modal del Modulos -->
    <div class="modal fade" id="staticBackdropModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Modulo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="nivelForm" class="form-label">Nivel:</label>
                                <input type="number" class="form-control" id="nivelForm" placeholder="0" value="<?php foreach ($modulo_data as $data) {
                                                                                                                    echo $data['nextid'];
                                                                                                                } ?>" readonly>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mb-3">
                                <label for="ModuloName" class="form-label">Nombre del modulo:</label>
                                <input type="text" class="form-control" id="ModuloName" placeholder="Modulo" oninput="genPath()">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="mb-3">
                                <label for="pathModule" class="form-label">Path:</label>
                                <input type="text" class="form-control" id="pathModule" placeholder="../" disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-4">
                                <label for="SelectEstatus" class="form-label">Estatus:</label>
                                <select name="SelectEstatus" id="selectEstatus" class="form-select">
                                    <option value="Enable" selected>Activo</option>
                                    <option value="Disabled">Suspendido</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnSave">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticTableModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticTableModule">Registros</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Modulo</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">localizacion</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="tbModulos">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de submodulos -->
    <div class="modal fade" id="staticBackdropSmodulos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Sumodulo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="nivelFormSmodulo" class="form-label">IDSMD:</label>
                                <input type="number" class="form-control" id="nivelFormSmodulo" placeholder="0" value="<?php foreach ($submodulo_data as $data) {
                                                                                                                            echo $data['nextid'];
                                                                                                                        } ?>" readonly>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mb-3">
                                <label for="SModuloName" class="form-label">Nombre del Submodulo:</label>
                                <input type="text" class="form-control" id="SModuloName" placeholder="Submodulo" oninput="genPath()">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <label for="SelectSModulo" class="form-label">Modulos:</label>
                            <select name="SelectSModulo" id="SelectSModulo" class="form-select">
                                <option value="0" selected>Seleccionar...</option>
                                <?php foreach ($data_select_modulos as $data) {
                                    echo '<option value="' . $data['id'] . '">' . $data['modulo'] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <div class="mb-4">
                                <label for="SelectEstatusSmodulo" class="form-label">Estatus:</label>
                                <select name="SelectEstatusSmodulo" id="SelectEstatusSmodulo" class="form-select">
                                    <option value="Enable" selected>Activo</option>
                                    <option value="Disabled">Suspendido</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="mb-3">
                                <label for="iconSModule" class="form-label">Icon from Fonts-icons:</label>
                                <input type="text" class="form-control" id="iconSModule" placeholder='<i class="fa-solid fa-code"></i>'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCloseSModule" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnSaveSModule">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticTableSModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticTableSModule">Registros</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Submodulo</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">Modulo</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="tbSModulos">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

</body>
<script>

</script>

</html>