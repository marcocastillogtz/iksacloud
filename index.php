<?php
require('entidades/Roles.php');
session_start();

if (isset($_SESSION['id_usuario'])) {
    header('Location: modules/dashboard/dashboard.php');
} else {
    $role_object = new Roles;
    $role_data = $role_object->get_all_rolls("where nivel=6");

    if (isset($_POST["ingresar"])) {
        require('entidades/Login.php');


        if (isset($_POST['user'], $_POST['password'])) {
            $object_login = new Login;
            $object_login->setUsuario($_POST['user']);
            $object_login->setcontrasena(md5($_POST['password']));
            $data_login = $object_login->getLogUser();
            foreach ($data_login as $value) {
                if ($value['estatus'] == 'Enable') {
                    $_SESSION['id_usuario'] = $value['id_registro'];
                    $_SESSION['img'] = $value['avatar'];
                    $_SESSION['user'] = $object_login->getUsuario();
                    $object_login->setLog("LogIn");
                    $object_login->updateStatus();
                    header('Location: modules/dashboard/dashboard.php');
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

    <link href="vendor/components/font-awesome/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Js Customized -->
    <script src="js/index.js"></script>
</head>
<nav class="navbar bg-dark" style="--bs-bg-opacity: .3;">
    <div class="container-fluid">
        <span class="navbar-text text-light">
            <h5 class="text-light">IPADSA Consumer Business Software Unit (CBSU)</h5>
        </span>
    </div>
</nav>

<body style="background-image: url('./img/src/bg-1.jpg'); background-repeat: no-repeat; background-size: cover;">
    <div class="container-lg position-absolute top-50 start-0 translate-middle-y my-0 mx-3">
        <div class="row ">
            <div class="col-4">
                <div class="card">
                    <h5 class="card-header text-center">
                        Iniciar Sesion
                    </h5>
                    <div class="card-body">
                        <form method="POST" class="row g-3" id="login_form">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"> <i class="fa-solid fa-user"></i> </span>
                                    <input type="text" name="user" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"> <i class="fa-solid fa-lock"></i> </span>
                                    <input type="password" name="password" class="form-control" placeholder="password" aria-label="password" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-12 d-grid gap-2">
                                    <button type="submit" class="btn btn-primary mb-3" name="ingresar">Ingresar</button>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-12">
                                    <p class="text-center"><a href="#" class="text-primary pe-auto link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">¿Olvidaste la contraseña?</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header text-center">
                        ¿Aún no tienes cuenta?
                    </h5>
                    <div class="card-body">
                        <form class="row g-3">
                            <div class="col-md-12">
                                <div class="col-12 d-grid gap-2">
                                    <button type="button" class="btn btn-success" id="btnRegister" data-bs-toggle="modal" data-bs-target="#exampleModal" >Registrate</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registrate</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="row g-3" id="register_form">
                        <div class="col-md-6">
                            <label for="inputName" class="form-label">Nombre(s):</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Nombre" onkeyup="mayus(this);">
                        </div>
                        <div class="col-md-6">
                            <label for="inputMiddleName" class="form-label">Apellido Paterno:</label>
                            <input type="text" class="form-control" id="inputMiddleName" placeholder="Apellido Paterno" onkeyup="mayus(this);">
                        </div>
                        <div class="col-md-12">
                            <label for="inputLastName" class="form-label">Apellido Materno:</label>
                            <input type="text" class="form-control" id="inputLastName" placeholder="Apellido Materno" onkeyup="mayus(this);">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail" class="form-label">Correo:</label>
                            <input type="mail" class="form-control" id="inputEmail" placeholder="correo@dominio.com">
                        </div>
                        <div class="col-md-6">
                            <label for="inputNumber" class="form-label">Telefono:</label>
                            <input type="text" class="form-control" id="inputNumber" placeholder="+520000000000">
                        </div>
                        <div class="col-md-4">
                            <label for="inputUser" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" id="inputUser" placeholder="@user" value="" onkeyup="mayus(this);">
                        </div>
                        <div class="col-md-4">
                            <label for="inputPassword" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="inputPassword" placeholder="****">
                        </div>
                        <div class="col-4">
                            <label for="selectRoll" class="form-label">Contraseña:</label>
                            <select class="form-select form-select" aria-label=".form-select-sm example" id="selectRoll">
                                <?php
                                foreach ($role_data as $rol) {
                                    echo '<option selected value="' . $rol['nivel'] . '" class="text-primary">' . $rol['descripcion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="signIn">Registrate</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>