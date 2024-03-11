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
        <h4><i class="fa-solid fa-star text-warning"></i> Seguimiento</h4>
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


</body>
<script>

</script>

</html>