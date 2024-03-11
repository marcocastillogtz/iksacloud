<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container-fluid bg-body-secondary p-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Permisos de usuario</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Usuarios con permisos</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <thead>
                                    <th class="text-center" scope="col">ID</th>
                                    <th class="text-center" scope="col">Nombre</th>
                                    <th class="text-center" scope="col">Apellidos</th>
                                    <th class="text-center" scope="col">Correo</th>
                                    <th class="text-center" scope="col">Telefono</th>
                                    <th class="text-center" scope="col">Acciones</th>
                                </thead>
                            </thead>
                            <tbody id="permision_data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="../../img/profiles/avatar_icon.png" class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast-info">

            </div>
        </div>
    </div>

    <script src="../../vendor/components/jquery/jquery.min.js"></script>
    <script src="../../js/administrador/administrador.js"></script>
</body>

</html>