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
        <h4><img src="../../img/iconos/x24/list.png"> Pedidos en Espera</h4>
    </div>
    <hr>
    <!-- Done -->
    <div class="container-fluid">
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Vendedor</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Total</th>
                    <th scope="col">Comentario</th>
                    <th scope="col">T. Espera</th>
                    </tr>
                </thead>
                <tbody id="item_pedidos_espera"></tbody>
                    <tr id="spinnerTablePedidosEspera">
                        <td colspan="8">
                            <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status" id="spinner-depositos-depo-cobranza">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            </div>
                        </td>
                    </tr>
            </table>
        </div>
    </div>
    </body>
</html>