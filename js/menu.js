$(document).ready(function () {
    console.log("init");

    saveItemMenu();
})



const contextMenu = document.querySelector(".fdm-wrapper");
subMenu = contextMenu.querySelector(".fdm-submenu");

document.addEventListener("contextmenu", e => {
    e.preventDefault();

    let x = e.offsetX, y = e.offsetY,
        winWidth = window.innerWidth,
        winHeight = window.innerHeight,
        cmWidth = contextMenu.offsetWidth;
    cmHeight = contextMenu.offsetHeight;

    if (x > (winWidth - cmWidth - subMenu.offsetWidth)) {
        subMenu.style.left = "-200px";
    } else {
        subMenu.style.left = "";
        subMenu.style.right = "-200px";
    }

    x = x > winWidth - cmWidth ? winWidth - cmWidth : x;
    y = y > winHeight - cmHeight ? winHeight - cmHeight : y;

    contextMenu.style.left = `${x}px`;
    contextMenu.style.top = `${y}px`;
    contextMenu.style.visibility = "visible";

});


document.addEventListener("click", () => contextMenu.style.visibility = "hidden");


var idItem = "";
var ArrId = [];
var text = "";
var selector = document.querySelectorAll('.fdm-item');
for (var i = 0; i < selector.length; i++) {
    selector[i].addEventListener("click", function () {
        console.log("Debug?")
        idItem = this.id;
        ColumIterator(idItem, "hide").then((resolve) => {
            if (resolve == 1) {
                var elemento = "#" + idItem;
                if (elemento.length > 1) {
                    var index = ArrId.findIndex(object => object.id === elemento);
                    if (index < 0) {// si el no existe entonces agregará el valor
                        $("#" + idItem).html('<span>' + text + '</span>');
                        ArrId.push({ id: elemento, visible: false });
                    } else {
                        let visibility = false;
                        if (ArrId[index].visible === true) {
                            $("#" + idItem).html('<span>' + text + '</span>');
                            visibility = false;
                            ArrId[index].visible = visibility;
                        } else {
                            $("#" + idItem).html('<i class="fa-solid fa-check"></i><span>' + text + '</span>');
                            visibility = true;
                            ArrId[index].visible = visibility;
                            return ColumIterator(idItem, "show");
                        }

                    }
                    console.table(ArrId);
                    localStorage.setItem("items", JSON.stringify(ArrId));
                }
            }
        }).then((response) => {
            if (response == 1) {
                console.log("Process Done!")
            } else {
                console.log("Process Failed!")
            }
        }).catch((err) => {
            console.error(err);
        })

    });
}

function ColumIterator(idItem, accion) {
    return new Promise(function (resolve, reject) {
        try {

            var Column = document.getElementsByClassName(idItem);
            for (var i = 0, max = Column.length; i < max; i++) {
                if (accion === "hide") {
                    Column[i].style.display = "none";
                    text = $("#" + idItem + " span").text();
                } else if (accion === "show") {
                    $("#" + idItem + "_" + i).removeAttr("style");
                }
            }
            resolve(1);
        } catch (error) {
            reject(error);
        }

    })

}

function saveItemMenu() {

    var idItem = "";
    var selector = document.querySelectorAll('.fdm-item-sub');
    if (localStorage.getItem("items") === null) {

        for (var i = 0; i < selector.length; i++) {
            idItem = selector[i].id;
            var elemento = "#" + idItem;
            if (elemento.length > 1) {
                var index = ArrId.findIndex(object => object.id === elemento);
                if (index < 0) {// si el no existe entonces agregará el valor
                    text = $("#" + idItem + " span").text();
                    $("#" + idItem).html('<i class="fa-solid fa-check"></i><span>' + text + '</span>');
                    ArrId.push({ id: elemento, visible: true });
                }
            }
        }
        localStorage.setItem("items", JSON.stringify(ArrId));
    }else{
        ArrId = JSON.parse(localStorage.getItem("items"));
        ArrId.forEach(element => {
            let menuItem = element.id;
            if (element.visible == true) {
                text = $(menuItem + " span").text();
                $(menuItem).html('<i class="fa-solid fa-check"></i><span>' + text + '</span>');
                accion = "show";
            } else { 
                text = $(menuItem + " span").text();
                $(menuItem).html('<span>' + text + '</span>');
                accion = "hide";
            }
        });
    }



    // for (var i = 0; i < selector.length; i++) {
    //     idItem = selector[i].id;
    //     var accion = "";


    //         ColumIterator(element.id, accion).then((result) => {
    //             if (result == 1) {
    //                 console.log("Columnas Mostradas");
    //             }
    //         }).catch((error) => {
    //             console.error(error);
    //         });
    //     });
    // }

}
