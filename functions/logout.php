<?php
require('../entidades/login.php');
session_start();
$object_login = new Login;
$object_login->setUsuario($_SESSION['user']);
$object_login->setLog("LogOut");
$object_login->updateStatus();
session_destroy();
header('Location: ../index.php');
