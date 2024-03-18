function getAction(action, elem) {
    document.getElementById("informatie").removeAttribute('selected');
    document.getElementById("verander").removeAttribute('selected');
    document.getElementById("recepten").removeAttribute('selected');
    document.getElementById("favorieten").removeAttribute('selected');
    document.getElementById("delete").removeAttribute('selected');
    elem.setAttribute("selected", '');
    void elem.offsetHeight;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("info").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", action+".php", true);
    xhttp.send();
}

function veranderInformatie() {
    alert("hi");
}

function mijnRecepten() {
    alert("hi");
}

function favorieten() {
    alert("hi");
}

function verwijderAccount() {
    alert("hi");
}
