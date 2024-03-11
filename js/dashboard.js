$(document).ready(function () {
    $('#wrapper').load('../index.php');
    getTheme();

    const version = '0.0.2';
    console.log('dashboard ' + version + "v");


    var idItem = 0;
    var selector = document.querySelectorAll('.dropdown-toggle');
    for (var i = 0; i < selector.length; i++) {
        selector[i].addEventListener("click", function () {
            idItem = this.id;
            var att = this.getAttribute('taskurl');
            $('#wrapper').load(att);
        });
    }

});

$(document).on("click", "#item_dark", function () {
    const theme = document.querySelector(".mybody");
    theme.setAttribute("data-bs-theme", "dark");
    $("#item_dark").html(`<i class="fa-solid fa-moon bi me-2 opacity-50 theme-icon"></i>Dark<i class="fa-solid fa-circle-dot fa-2xs bi ms-auto"></i>`);
    $("#item_light").html(`<i class="fa-solid fa-sun bi me-2 opacity-50 theme-icon"></i>Light`);
    localStorage.setItem("theme", "dark");
});

$(document).on("click", "#item_light", function () {
    const theme = document.querySelector(".mybody");
    theme.setAttribute("data-bs-theme", "light");
    $("#item_light").html(`<i class="fa-solid fa-sun bi me-2 opacity-50 theme-icon"></i>Light<i class="fa-solid fa-circle-dot fa-2xs bi ms-auto"></i>`);
    $("#item_dark").html(`<i class="fa-solid fa-moon bi me-2 opacity-50 theme-icon"></i>Dark`);
    localStorage.setItem("theme", "light");
});


function getTheme() {
    let theme = localStorage.getItem("theme");

    if (theme == null) {
        localStorage.setItem("theme", "dark");
    }

    if (theme == "dark") {
        const theme = document.querySelector(".mybody");
        theme.setAttribute("data-bs-theme", "dark");
        $("#item_dark").html(`<i class="fa-solid fa-moon bi me-2 opacity-50 theme-icon"></i>Dark<i class="fa-solid fa-circle-dot fa-2xs bi ms-auto"></i>`);
        $("#item_light").html(`<i class="fa-solid fa-sun bi me-2 opacity-50 theme-icon"></i>Light`);
    } else if (theme == "light") {
        const theme = document.querySelector(".mybody");
        theme.setAttribute("data-bs-theme", "light");
        $("#item_light").html(`<i class="fa-solid fa-sun bi me-2 opacity-50 theme-icon"></i>Light<i class="fa-solid fa-circle-dot fa-2xs bi ms-auto"></i>`);
        $("#item_dark").html(`<i class="fa-solid fa-moon bi me-2 opacity-50 theme-icon"></i>Dark`);

    }
}