$(document).ready(function () {

    var conn = new WebSocket('wss://62.72.6.24:8090');

    conn.onopen = function (e) {
        console.log("Connection stablished!");
    }

    // register.onclick = function () {
    //     var tname = $('#inputName').val()
    //     var tmname = $('#inputMiddleName').val();
    //     var tlname = $('#inputLastName').val();
    //     var temail = $('#inputEmail').val();
    //     var tphone = $('#inputNumber').val();
    //     var tuser = $('#inputUser').val();
    //     var tpassword = $('#inputPassword').val();

    //     var data = {
    //         name: tname,
    //         mname: tmname,
    //         lname: tlname,
    //         email: temail,
    //         phone: tphone,
    //         user: tuser,
    //         password: tpassword
    //     }

    //     conn.send(JSON.stringify(data));
    // }

    conn.onmessage = function (e) {
        var data = JSON.parse(e.data);

        const toastLiveExample = document.getElementById('liveToast')

        if (data.validation == 'success') { 
             const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);

            //  var toast ='<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><img src="..." class="rounded me-2" alt="..."><strong class="me-auto">Bootstrap</strong><small>11 mins ago</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Hello, world! This is a toast message.</div></div>';

            const toastbody = document.getElementById("toast-info");
            toastbody.innerHTML = "<p>"+data.name+" "+data.mname+" "+data.lname+", Se ha unido al equipo 👏</p>";
            toastBootstrap.show()
        }
    }

});