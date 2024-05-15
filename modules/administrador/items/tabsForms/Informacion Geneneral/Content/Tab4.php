<div class="container-fluid">
    <div class="container-fluid border m-2">
        <div class="row my-2">
            <div class="col-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="cb_imprimir">
                    <label class="form-check-label" for="cb_imprimir">
                        Imprimir
                    </label>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="check_doc_fiscal" checked>
                    <label class="form-check-label" for="check_doc_fiscal" id="labelCheckdF">Emitir a: Remision</label>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="cb_enviar_correo">
                    <label class="form-check-label" for="cb_enviar_correo">
                        Enviar por correo electronico
                    </label>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-12">
                <div class="input-group ">
                    <input type="email" class="form-control form-control-sm" id="txt_email" placeholder="Cuenta de correo electronico" value="sin correo" disabled>
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="cb_enviar_correo_silencioso">
                    <label class="form-check-label" for="cb_enviar_correo_silencioso">
                        Enviar por correo electronico en modo silencioso
                    </label>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <p>Mecanismo de seguridad de envio</p>
            <div class="col-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">Sin encriptamiento</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">Alto (doble encriptamiento)</label>
                </div>
            </div>
        </div>
    </div>

</div>