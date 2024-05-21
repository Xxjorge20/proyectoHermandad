function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var visits = getCookie("visits");
    if (visits == "") {
        visits = 1;
    } else {
        visits = parseInt(visits) + 1;
    }
    setCookie("visits", visits, 365);

    // Mensajes de bienvenida
    if (visits == 1) {
        document.getElementById("visitCount").innerHTML = "Bienvenido a la hermandad, esta es tu primera visita.";
    }
    if (visits == 50) {
        document.getElementById("visitCount").innerHTML = "Felicidades, has visitado la hermandad 50 veces. pasa por la hermandad para recibir tu regalo.";
    }
    if (visits == 100) {
        document.getElementById("visitCount").innerHTML = "Felicidades, has visitado la hermandad 100 veces. pasa por la hermandad para recibir tu regalo.";
    }
    if (visits == 200) {
        document.getElementById("visitCount").innerHTML = "Felicidades, has visitado la hermandad 200 veces. pasa por la hermandad para recibir tu regalo.";
    }
    if (visits == 500) {
        document.getElementById("visitCount").innerHTML = "Felicidades, has visitado la hermandad 500 veces. pasa por la hermandad para recibir tu regalo.";
    }
    if (visits == 1000) {
        document.getElementById("visitCount").innerHTML = "Felicidades, has visitado la hermandad 1000 veces. pasa por la hermandad para recibir tu regalo.";
    }
    else {
        document.getElementById("visitCount").innerHTML = "Has visitado la hermandad " + visits + " veces.";
    }
}

window.onload = function() {
    checkCookie();
};
