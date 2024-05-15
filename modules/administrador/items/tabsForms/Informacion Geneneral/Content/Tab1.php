<div class="container-fluid">
    <div class="row my-2">
        <div class="col-4">
            <input type="text" class="form-control form-control-sm" id="txt_rfc" placeholder="R.F.C">
        </div>
        <div class="col-4">
            <input type="number" class="form-control form-control-sm" id="txt_rf" placeholder="Regimen Fiscal">

        </div>
        <div class="col-4">
            <input type="text" class="form-control form-control-sm" id="txt_curp" placeholder="C.U.R.P">
        </div>
    </div>

    <div class="row my-2">
        <div class="col-12">
            <input type="text" class="form-control form-control-sm" id="txt_calle" placeholder="Calle">
        </div>
    </div>

    <div class="row my-2">
        <div class="col-4">
            <input type="text" class="form-control form-control-sm" id="txt_numIn" placeholder="Num. Int.">
        </div>
        <div class="col-4">
            <input type="text" class="form-control form-control-sm" id="txt_numEx" placeholder="Num. Ext">
        </div>
        <div class="col-4">
            <input type="text" class="form-control form-control-sm" id="txt_calle" placeholder="Entre Calle">
        </div>
    </div>
    <!-- row -->
    <div class="row my-2">
        <div class="col-8">
            <input type="text" class="form-control form-control-sm" id="txt_calle2" placeholder="Y Calle">
        </div>
        <div class="col-2">
            <div class="input-group">
                <input type="text" class="form-control form-control-sm" id="txt_pais" placeholder="Pais">
                <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
        <div class="col-2">
            <input type="text" class="form-control form-control-sm" id="txt_pais_placeholder" placeholder="" disabled>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-6">
            <input type="text" class="form-control form-control-sm" id="txt_nacionalidad" placeholder="Nacionalidad">
        </div>
        <div class="col-2">

        </div>
        <div class="col-4">
            <input type="text" class="form-control form-control-sm" id="txt_cp" placeholder="Codigo Postal">
        </div>
    </div>
    <div class="row my-2">
        <div class="col-4">
            <select type="text" class="form-select form-select-sm" id="estados_select">
                <option value="0" selected disabled>Estado</option>
                <?php
                foreach ($estado_data as $data) {
                    echo '<option value="' . $data['id_Estado'] . '">' . $data['estado'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-4">
            <select type="text" class="form-select form-select-sm" id="municipio_select" disabled>
                <option value="0" selected disabled>Municipio</option>
            </select>
        </div>
        <div class="col-4">
            <select type="text" class="form-select form-select-sm" id="poblacion_select" disabled>
                <option value="0" selected disabled>Poblacion</option>
            </select>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-6">
            <input type="text" class="form-control form-control-sm" id="txt_colonia" placeholder="Colonia">
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12">
            <textarea name="" class="form-control form-control-sm" id="txt_referencia" cols="30" rows="2" placeholder="Referencia"></textarea>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-3">
            <select type="text" class="form-select form-select-sm" id="clasificacion_select">
                <option value="0" selected>Seleccionar</option>
                <option value="UNO">001</option>
                <option value="DOS">002</option>
                <option value="TRES">003</option>
                <option value="CUATRO">004</option>
                <option value="CINCO">005</option>
                <option value="SEIS">006</option>
                <option value="SIETE">007</option>
                <option value="OCHO">008</option>
                <option value="DIEZ">010</option>
                <option value="TRECE">013</option>
                <option value="CATORCE">014</option>
                <option value="QUINCE">015</option>
                <option value="DIECISEIS">016</option>
                <option value="CIEN">DI001</option>
            </select>
        </div>
        <div class="col-2">
            <input type="text" class="form-control form-control-sm" id="txt_texto" disabled placeholder="Texto">
        </div>
        <div class="col-2">
            <input type="text" class="form-control form-control-sm" id="txt_zona" placeholder="Zona">
        </div>
        <div class="col-5">
            <input type="text" class="form-control form-control-sm" id="txt_zona_field" disabled>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-4">
            <input type="text" class="form-control" id="txt_telefono" placeholder="Telefono">
        </div>
        <div class="col-4">

        </div>
        <div class="col-4">
            <input type="text" class="form-control" id="txt_fax" placeholder="Fax">
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12">
            <input type="text" class="form-control" id="txt_paginaweb" placeholder="Pagina Web">
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12">
            <fieldset>
                <legend>Tipo Empresa</legend>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="rb_1" value="option1">
                    <label class="form-check-label" for="rb_1">Matriz</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="rb_2" value="option2">
                    <label class="form-check-label" for="rb_2">Sucursal</label>
                </div>

            </fieldset>
        </div>
    </div>
</div>