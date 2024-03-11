<?php

require('../../entidades/Modulos.php');
session_start();
if (isset($_SESSION['id_usuario'])) {
    $module_object = new Modulos;
    $module_data = $module_object->getModulosActivos();
} else {
    header('Location: ../../index.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <title>Home</title>
    <link rel="shortcut icon" href="../../img/src/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

    <link href="../../vendor/components/font-awesome/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap core JavaScript -->
    <script src="../../vendor/components/jquery/jquery.min.js"></script>
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/dashboard.js"></script>
</head>

<body data-bs-theme="dark" class="mybody bg-body-secondary">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="navbar-brand" href="#">

            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <?php echo '<img src="../../img/profiles/' . $_SESSION['img'] . '" class="rounded-circle border border-danger border-1" alt="..." width="30px;" height="30px;">'; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../../functions/logout.php" id="logOut">Cerrar Sesion <i class="fa-solid fa-arrow-right-to-bracket"></i></a></li>
                        </ul>
                    </li>
                    <?php
                    require('../../entidades/Permisos.php');
                    require('../../entidades/Submodulos.php');
                    $permision_object = new Permisos;
                    $permision_object->setUsuario($_SESSION['id_usuario']);
                    $permision_data = $permision_object->getPermisos();

                    $submodule_object = new Submodulo;

                    foreach ($module_data as $mod => $val) {
                        if ($permision_data[$val['modulo']] == "Enable") {
                            $submodule_object->setModuloId($val['id']);
                            $submodule_data = $submodule_object->getSubmodulos();
                            foreach ($submodule_data as $item) {
                            // echo '<li class="nav-item dropdown">
                            //         <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            //             ' . $val['modulo'] . '
                            //         </a>
                            //         <ul class="dropdown-menu"><li>';
                            $phpItem = str_replace(' ', '', $item['submodulo']);
                            echo '<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="' . $item['id'] . '" taskurl="../' . $val['modulo'] . '/' . $phpItem . '.php" >
                                ' . $val['modulo'] . '
                            </a>
                            <ul class="dropdown-menu"><li>';
                            }

                            // foreach ($submodule_data as $item) {
                            //     $clicked = '';

                            //     if ($item['estatus'] != 'Enable') {
                            //         $clicked = 'disabled';
                            //     }
                            //     if ($item['submodulo'] == 'divider') {
                            //         echo '<li><hr class="dropdown-divider"></li><li>';
                            //     } else {
                            //         $phpItem = str_replace(' ', '', $item['submodulo']);
                            //         echo '<a class="dropdown-item ' . $clicked . '" href="#" id="' . $item['id'] . '" taskurl="../' . $val['modulo'] . '/' . $phpItem . '.php">' . $item['icon'] . ' ' . $item['submodulo'] . '</a>';
                            //     }
                            // }
                            // echo '</li></ul>
                            echo ' </ul></li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="ml-auto">
                <div class="ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-circle-half-stroke"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center" id="item_dark">
                                        <i class="fa-solid fa-moon bi me-2 opacity-50 theme-icon"></i>
                                        Dark
                                        <i class="fa-solid fa-check fa-2xs bi ms-auto"></i>
                                    </button>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center" id="item_light">
                                        <i class="fa-solid fa-sun bi me-2 opacity-50 theme-icon"></i>
                                        Light
                                    </button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- <button type="button" class="dropdown-item d-flex align-items-center active" id="item_light">
        <i class="fa-solid fa-sun bi me-2 opacity-50 theme-icon"></i>
        Light
        <i class="fa-solid fa-check fa-2xs bi ms-auto"></i>
    </button> -->
    <main id="wrapper" style="width: 100%; height:100%">

    </main>

    <footer class="bd-footer py-4 py-md-5 mt-5 bg-body-tertiary">
        <div class="container py-4 py-md-5 px-4 px-md-3 text-body-secondary">
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <a class="d-inline-flex align-items-center mb-2 text-body-emphasis text-decoration-none" href="/" aria-label="Bootstrap">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="d-block me-2" viewBox="0 0 118 94" role="img">
                            <title>Bootstrap</title>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path>
                        </svg> -->
                        <img src="../../img/src/icon.png" alt="" width="60" height="60" class="rounded-circle m-1">
                        <span class="fs-5">CBSU (Consume Bussiness Software Unit)</span>
                    </a>
                    <ul class="list-unstyled small">
                        <li class="mb-2">Diseñado y desarrollado con el fin de poder agilizar el proceso interno de la operacion, sin olvidar la calidad y el desempeno de este software </li>
                        <li class="mb-2">Code licensed <a href="https://github.com/twbs/bootstrap/blob/main/LICENSE" target="_blank" rel="license noopener">MIT</a>, docs <a href="https://creativecommons.org/licenses/by/3.0/" target="_blank" rel="license noopener">CC BY 3.0</a>.</li>
                        <li class="mb-2">Currently v1.1.10</li>
                    </ul>
                </div>
                <!-- <div class="col-6 col-lg-2 offset-lg-1 mb-3">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/">Home</a></li>
                        <li class="mb-2"><a href="/docs/5.3/">Docs</a></li>
                        <li class="mb-2"><a href="/docs/5.3/examples/">Examples</a></li>
                        <li class="mb-2"><a href="https://icons.getbootstrap.com/">Icons</a></li>
                        <li class="mb-2"><a href="https://themes.getbootstrap.com/">Themes</a></li>
                        <li class="mb-2"><a href="https://blog.getbootstrap.com/">Blog</a></li>
                        <li class="mb-2"><a href="https://cottonbureau.com/people/bootstrap" target="_blank" rel="noopener">Swag Store</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2 mb-3">
                    <h5>Guides</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/docs/5.3/getting-started/">Getting started</a></li>
                        <li class="mb-2"><a href="/docs/5.3/examples/starter-template/">Starter template</a></li>
                        <li class="mb-2"><a href="/docs/5.3/getting-started/webpack/">Webpack</a></li>
                        <li class="mb-2"><a href="/docs/5.3/getting-started/parcel/">Parcel</a></li>
                        <li class="mb-2"><a href="/docs/5.3/getting-started/vite/">Vite</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2 mb-3">
                    <h5>Projects</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="https://github.com/twbs/bootstrap" target="_blank" rel="noopener">Bootstrap 5</a></li>
                        <li class="mb-2"><a href="https://github.com/twbs/bootstrap/tree/v4-dev" target="_blank" rel="noopener">Bootstrap 4</a></li>
                        <li class="mb-2"><a href="https://github.com/twbs/icons" target="_blank" rel="noopener">Icons</a></li>
                        <li class="mb-2"><a href="https://github.com/twbs/rfs" target="_blank" rel="noopener">RFS</a></li>
                        <li class="mb-2"><a href="https://github.com/twbs/examples/" target="_blank" rel="noopener">Examples repo</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2 mb-3">
                    <h5>Community</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="https://github.com/twbs/bootstrap/issues" target="_blank" rel="noopener">Issues</a></li>
                        <li class="mb-2"><a href="https://github.com/twbs/bootstrap/discussions" target="_blank" rel="noopener">Discussions</a></li>
                        <li class="mb-2"><a href="https://github.com/sponsors/twbs" target="_blank" rel="noopener">Corporate sponsors</a></li>
                        <li class="mb-2"><a href="https://opencollective.com/bootstrap" target="_blank" rel="noopener">Open Collective</a></li>
                        <li class="mb-2"><a href="https://stackoverflow.com/questions/tagged/bootstrap-5" target="_blank" rel="noopener">Stack Overflow</a></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </footer>
</body>

</html>