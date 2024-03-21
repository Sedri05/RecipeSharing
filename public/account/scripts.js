function getAction(action, elem) {
    document.getElementById("informatie").removeAttribute("selected");
    document.getElementById("verander").removeAttribute("selected");
    document.getElementById("recepten").removeAttribute("selected");
    document.getElementById("favorieten").removeAttribute("selected");
    document.getElementById("delete").removeAttribute("selected");
    elem.setAttribute("selected", "");
    void elem.offsetHeight;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("info").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", action + ".php", true);
    xhttp.send();
}

function updateInfo(form) {
    event.preventDefault();

    var naam = form.elements["naam"].value;
    var achternaam = form.elements["achternaam"].value;
    var email = form.elements["email"].value;
    var old_password = form.elements["old_password"].value;
    var new_password = form.elements["new_password"].value;
    var her_password = form.elements["her_password"].value;

    if (!checkPassword()) return;

    console.log(naam + " " + achternaam + " " + email + " " + old_password + " " + new_password + " " + her_password);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            console.log(this.responseText);
            var res = JSON.parse(this.responseText);
            if (res.success !== undefined) {
                document.getElementById("verander").removeAttribute("selected");
                document.getElementById("informatie").setAttribute("selected", "");
                xhttp2 = new XMLHttpRequest();
                xhttp2.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("info").innerHTML = this.responseText;
                        document.getElementById("success").innerHTML = "Je info is succesvol geupdate!";
                    }
                };
                xhttp2.open("GET", "informatie.php", true);
                xhttp2.send();
            } else if (res.error !== undefined) {
                var err_result = res["error"];
                document.getElementById(err_result[0] + "_error").innerHTML = err_result[1];
            } else {
                document.getElementById("general_error").innerHTML = "Something went wrong, please try again later!";
            }
        }
    };
    xmlhttp.open("POST", "veranderInformatie.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("email=" + email + "&old_password=" + old_password + "&naam=" + naam + "&achternaam=" + achternaam + "&new_password=" + new_password);
}

function checkPassword() {
    password = document.getElementById("pw").value;
    password_confirm = document.getElementById("her_pw").value;

    if (password != password_confirm) {
        document.getElementById("confirm_password_error").innerHTML = "Passwords do not match!";
        return false;
    } else {
        document.getElementById("confirm_password_error").innerHTML = "";
        return true;
    }
}
