function signup() {
    firstname = document.getElementById("firstname").value;
    lastname = document.getElementById("lastname").value;
    username = document.getElementById("email").value;
    password = document.getElementById("password").value;
    password_confirm = document.getElementById("confirm_password").value;

    if (!checkPassword()) return;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            console.log(this.responseText);
            var res = JSON.parse(this.responseText);

            if (res.success !== undefined) {
                window.location.href = "/index.php";
            } else if (res.error !== undefined) {
                var err_result = res["error"];
                document.getElementById(err_result[0] + "_error").innerHTML = err_result[1];
            } else {
                document.getElementById("general_error").innerHTML = "Something went wrong, please try again later!";
            }
        }
    };
    xmlhttp.open("POST", "signup.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("email=" + username + "&password=" + password + "&firstname=" + firstname + "&lastname=" + lastname);
}

function checkPassword() {
    password = document.getElementById("password").value;
    password_confirm = document.getElementById("confirm_password").value;

    if (password != password_confirm) {
        document.getElementById("confirm_password_error").innerHTML = "Passwords do not match!";
        return false;
    } else {
        document.getElementById("confirm_password_error").innerHTML = "";
        return true;
    }
}
