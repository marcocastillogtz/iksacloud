<div class="container-fluid">
    <div class="container-fluid border m-2">
        <div class="row my-2">
            <div class="col-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="cb_ddc">
                    <label class="form-check-label" for="cb_ddc">
                        Manejo de Credito
                    </label>
                </div>
            </div>
            <div class="col-4">

            </div>
            <div class="col-4">
                <input type="input" class="form-control form-control-sm" id="txt_dia_revision" placeholder="Dia de Revision">
            </div>
        </div>
        <div class="row my-2">
            <div class="col-3">
                <input type="number" class="form-control form-control-sm" id="txt_limite_dias" placeholder="Dias de credito" disabled value="0">
            </div>
            <div class="col-6">

            </div>
            <div class="col-3">
                <input type="number" class="form-control form-control-sm" id="txt_dia_pago" placeholder="Dia de pago">
            </div>
        </div>
        <div class="row my-2">
            <div class="col-5">
                <input type="text" class="form-control form-control-sm" id="txt_limite_credito" placeholder="limite de credito" disabled disabled value="0.00">
            </div>
            <div class="col-2"></div>
            <div class="col-5">
                <div class="input-group ">
                    <input type="number" class="form-control form-control-sm" id="txt_saldo" placeholder="Saldo">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-6">
                <label for="select_mdp" class="form-label">Metodo de pago</label>
                <select type="text" class="form-select form-select-sm" id="select_mdp">
                    <option value="0" selected>Seleccionar</option>
                    <?php
                    foreach ($Catalgo_data as $dataCatalogo) {
                        echo '<option value="' . $dataCatalogo['c_FormaPago'] . '">' . $dataCatalogo['c_FormaPago'] . " " . strtoupper($dataCatalogo['Descripcion']) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-6">
                <label for="select_mdp" class="form-label">Uso de CFDI</label>
                <select type="text" class="form-select form-select-sm" id="select_cfdi">
                    <option value="0" selected>Seleccionar</option>
                    <?php
                    foreach ($ListCFDI as $cfdi) {
                        echo '<option value="' . $cfdi['c_UsoCFDI'] . '">' . $cfdi['c_UsoCFDI'] . " " . strtoupper($cfdi['Descripcion']) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-6">
                <select type="text" class="form-select form-select-sm" id="bancos_select">
                    <option value="0" selected disabled>Selecciona un banco</option>
                    <?php
                    foreach ($BcoCliente_data as $data) {
                        echo '<option value="' . $data['id_banco'] . '">' . $data['desc_banco'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-6">
                <input type="text" class="form-control form-control-sm" id="txt_cuenta_cliente" aria-describedby="idCuentaBanco" placeholder="Numero de cuenta">
            </div>
        </div>
    </div>
    <hr>
    <div class="row my-2">
        <div class="col-4">
            <select class="form-select form-select-sm" id="select_mdv">
                <option value="0" selected>Modo de venta...</option>
                <?php
                foreach ($MetodoVenta_data as $mdv) {
                    echo '<option value="' . $mdv['codigo_venta'] . '">' . $mdv['descripcion'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-6">
            <select class="form-select form-select-sm" id="select_lp_remision">
                <option value="0" selected>Lp Remision...</option>
                <?php
                foreach ($lp_data as $datalp) {
                    echo '<option value="' . $datalp['id'] . '">' . $datalp['tipo'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-6">
            <select class="form-select form-select-sm" id="select_lp_factura">
                <option value="0" selected>Lp Factura...</option>
                <?php
                foreach ($lp_data as $datalp) {
                    echo '<option value="' . $datalp['id'] . '">' . $datalp['tipo'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-6">
            <select class="form-select form-select-sm" id="select_com_remision">
                <option value="0" selected>% Descuento Remision....</option>
                <?php
                foreach ($Com_data_remision as $comR) {
                    echo '<option value="' . $comR['codigo_comision'] . '">' . $comR['codigo_comision'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-6">
            <select class="form-select form-select-sm" id="select_com_factura">
                <option value="0" selected>% Descuento Factura...</option>
                <?php
                foreach ($Com_data as $com) {
                    echo '<option value="' . $com['codigo_comision'] . '">' . $com['codigo_comision'] . '</option>';
                }
                ?>
            </select>

        </div>
    </div>
    <div class="row my-2">
        <div class="col-6">
            <select class="form-select form-select-sm" id="select_lp_alterna">
                <option value="0" selected>Lista de precio Alterna...</option>
                <?php
                foreach ($lp_data as $datalp) {
                    echo '<option value="' . $datalp['id'] . '">' . $datalp['tipo'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-6">
            <input type="text" class="form-control form-control-sm" id="txt_cuenta_contable" aria-describedby="idCuentaContable" placeholder="Cuenta contable">
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="check_lpa" checked>
                <label class="form-check-label" for="check_lpa" id="labelCheckLP">L. Precios Original</label>
            </div>
        </div>
        <div class="col-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="check_auth" checked>
                <label class="form-check-label" for="check_auth" id="labelCheckAuth">Req. Autenticacion</label>
            </div>
        </div>
    </div>
</div>