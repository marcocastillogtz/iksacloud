<div>
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="Informacion-tab" data-bs-toggle="tab" data-bs-target="#Informacion-tab-pane" type="button" role="tab" aria-controls="Informacion-tab-pane" aria-selected="true"><i class="fa-solid fa-house"></i> Datos Generales</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"><i class="fa-solid fa-file-invoice-dollar"></i> Datos de Ventas</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"><i class="fa-solid fa-clock-rotate-left"></i> Datos Historicos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false"><i class="fa-solid fa-receipt"></i> Emision de documento</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Informacion-tab-pane" role="tabpanel" aria-labelledby="Informacion-tab" tabindex="0"><?php include_once('Content/Tab1.php') ?></div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0"><?php include_once('Content/Tab2.php') ?></div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0"><?php include_once('Content/Tab3.php') ?></div>
                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0"><?php include_once('Content/Tab4.php') ?></div>
            </div>
        </div>
    </div>
</div>