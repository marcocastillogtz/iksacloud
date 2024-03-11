$(document).ready(function () {

    var conn = new WebSocket('wss://62.72.6.24:8090');

    conn.onopen = function (e) {
        console.log("Connection stablished!");
    }

    conn.onmessage = function (e) {
        var data = JSON.parse(e.data);

        const toastLiveExample = document.getElementById('liveToast')

        if (data.validation == 'success') {

            getUsers().then((result) => {
                console.log("Datos encontrados")
            }).catch((error) => {
                console.log(error);
            });

            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);

            const toastbody = document.getElementById("toast-info");
            toastbody.innerHTML = "<p>" + data.name + " " + data.mname + " " + data.lname + ", Se ha unido al equipo 👏</p>";
            toastBootstrap.show()
        }
    }

    getUsers().then((result) => {
        console.log("Datos encontrados")
    }).catch((error) => {
        console.log(error);
    });


});


function getUsers() {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: '../../functions/administrador/check_permission.php',
            type: 'GET',
            success: function (response) {
                let item = JSON.parse(response);
                let template = '';
                item.forEach(item => {
                    let formatMoney = Intl.NumberFormat('en-US');

                    console.log(item.name);
                    var client_asigned = item.agrement_client;
                    var class_online = "";
                    var status_online = "";
                    var class_roll = item.description;
                    var icon_star ="";

                    if (client_asigned == "*") {
                        client_asigned = "Todos";
                    }

                    if (item.log == "LogIn") {
                        var class_online = "text-success";
                        var status_online = "En linea";
                    } else {
                        var class_online = "text-secondary";
                        var status_online = "Desconectado";
                    }


                    if(class_roll=="ADMINISTRADOR"){
                        class_roll="btn-primary";
                        icon_star ='<i class="fa-solid fa-star"></i>';
                    }else{
                        icon_star='<i class="fa-solid fa-user"></i>';
                        class_roll="btn-secondary";
                    }


                    template +=
                        `<tr>
                            <th class="align-middle text-center" scope="row">
                                <label>${item.id_user}</label>
                                <a class="btn btn-secondary btn-sm" data-bs-toggle="collapse" href="#collapseExample${item.id_user}" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa-solid fa-eye"></i></a>
                            </th>
                            <td class="align-middle text-center" scope="row">${item.name}</td>
                            <td class="align-middle text-center" scope="row">${item.middle_name} ${item.last_name}</td>
                            <td class="align-middle text-center" scope="row">${item.mail}</td>
                            <td class="align-middle text-center" scope="row">${item.phone}</td>
                            <td class="align-middle text-center" scope="row">
                                <button type="button" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="collapse" id="collapseExample${item.id_user}">
                                    <table class="table mb-0 table-sm table-bordered">
                                        <thead>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Estatus</th>
                                            <th class="text-center">Usuario</th>
                                            <th class="text-center">Contraseña</th>
                                            <th class="text-center">Clasificacion</th>
                                            <th class="text-center">Texto</th>
                                            <th class="text-center">Roll</th>
                                            <th class="text-center">Cliente asignado</th>
                                            <th class="text-center">Sesion</th>
                                            <th class="text-center">Acciones</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="align-middle text-center">${item.id_register}</th>
                                                <td class="align-middle text-center"><label class="text-success">${item.status_user}</label></td>
                                                <td class="align-middle text-center"><label class="text-warning">${item.user}</label></td>
                                                <td class="align-middle text-center">${item.password}</td>
                                                <td class="align-middle text-center"><label class="text-success">${item.classification}</label></td>
                                                <td class="align-middle text-center"><label class="text-secondary">${item.text}</label></td>
                                                <td class="align-middle text-center"><a class="btn ${class_roll} btn-sm" data-bs-toggle="collapse" href="#collapseExample${item.id_register}" role="button" aria-expanded="false" aria-controls="collapseExample">${icon_star} ${item.description}</a></td>
                                                <td class="align-middle text-center">${client_asigned}</td>
                                                <td class="align-middle text-center"><strong class="${class_online}"><i class="fa-regular fa-circle-dot ${class_online}"></i> ${status_online}</strong></td>
                                                <td class="align-middle text-center">
                                                    <button type="button" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="10">
                                                    <div class="collapse table-responsive-xl" id="collapseExample${item.id_register}">
                                                        <table class="table mb-0 table-sm table-bordered">
                                                            <thead>
                                                                <th class="text-center">Admin</th>
                                                                <th class="text-center">Vtas</th>
                                                                <th class="text-center">Cbza</th>
                                                                <th class="text-center">Fact</th>
                                                                <th class="text-center">CkOut</th>
                                                                <th class="text-center">Plan&Serv</th>
                                                                <th class="text-center">admivo</th>
                                                                <th class="text-center">Paq</th>
                                                                <th class="text-center">Bcos</th>
                                                                <th class="text-center">SL!</th>
                                                                <th class="text-center">PUA!</th>
                                                                <th class="text-center">KYC!</th>
                                                                <th class="text-center">C&P</th>
                                                                <th class="text-center">Acciones</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <select class="form-select" aria-label="Default select example">
                                                                            <option selected value="Enable">Enable</option>
                                                                            <option value="Disabled">Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>
                                                                        <button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>`;
                    resolve(item.id_user);
                });
                $('#permision_data').html(template);
            },
            error: function (XMLHttpRequest, txtStatus, errorThrown) {
                alert("Estatus: " + txtStatus);
                alert("Error: " + errorThrown);
                reject(500)
            }
        });
    })
}



