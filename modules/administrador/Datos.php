<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="../../js/menu.js"></script> -->
    <script src="../../js/numeral.min.js"></script>
    <script src="../../js/administrador/settings.js"></script>
    <script src="../../js/administrador/clients.js?v=10"></script>
    <script src="../../js/administrador/localidades.js"></script>
    <link rel="stylesheet" href="../../css/menu.css">
    <script src="../../js/administrador/usuarios.js"></script>
</head>


<body>

    <div class="container-fluid px-5 py-2">
        <div class="row">
            <div class="col-9">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Parametros</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3" id="navMain">

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <div class="list-group card" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active d-flex justify-content-between align-items-center" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">Inicio <img src="../../img/iconos/x24/home.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-modules-list" data-bs-toggle="list" href="#list-modules" role="tab" aria-controls="list-modules">Administracion de modulos <img src="../../img/iconos/x24/dni.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-wallet-list" data-bs-toggle="list" href="#list-wallet" role="tab" aria-controls="list-wallet">Clientes <img src="../../img/iconos/x24/people.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-location-list" data-bs-toggle="list" href="#list-location" role="tab" aria-controls="list-location">Localidades <img src="../../img/iconos/x24/ubicacion.png" alt=""></a>
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="list-users-list" data-bs-toggle="list" href="#list-users" role="tab" aria-controls="list-users">Usuarios <img src="../../img/iconos/x24/cliente.png" alt=""></a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list"></div>
                    <div class="tab-pane fade" id="list-modules" role="tabpanel" aria-labelledby="list-modules-list"><?php include_once('items/Submodulos.php') ?></div>
                    <div class="tab-pane fade" id="list-wallet" role="tabpanel" aria-labelledby="list-wallet-list"><?php include_once('items/Clientes.php') ?></div>
                    <div class="tab-pane fade" id="list-location" role="tabpanel" aria-labelledby="list-location-list"><?php include_once('items/Localidades.php') ?></div>
                    <div class="tab-pane fade" id="list-users" role="tabpanel" aria-labelledby="list-users-list"><?php include_once('items/Usuarios.php') ?></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>