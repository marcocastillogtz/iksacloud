$(document).ready(function(){
    const version = '0.0.1';
    console.log('Index.js '+version+"v");
    const register = document.getElementById("signIn");

    var conn = new WebSocket('wss://localhost:8090');

    conn.onopen = function(e){
        console.log("Connection stablished!");        
    }

    conn.onerror = function(e){
        console.log("Error de conection: "+e)
    }

    register.onclick = function() {
        var tname = $('#inputName').val()
        var tmname = $('#inputMiddleName').val();
        var tlname = $('#inputLastName').val();
        var temail = $('#inputEmail').val();
        var tphone = $('#inputNumber').val();
        var tuser = $('#inputUser').val();
        var tpassword = $('#inputPassword').val();

        var data = {
            name: tname,
            mname: tmname,
            lname: tlname,
            email: temail,
            phone: tphone,
            user: tuser,
            password: tpassword
        }

        conn.send(JSON.stringify(data));
    }

    conn.onmessage = function (e) {
        const formulario = document.getElementById("register_form");
        var data = JSON.parse(e.data);
        if(data.validation=='success'){
            formulario.reset();
        }
    }

});

function mayus(e) {
    e.value = e.value.toUpperCase();
}



