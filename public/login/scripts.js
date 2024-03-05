function login() {
    username = document.getElementById("email").value;
    password = document.getElementById("password").value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            document.getElementById("err").innerHTML = this.responseText;
            var res = JSON.parse(this.responseText);
            if (res.success !== undefined) {
                window.location.href = "/index.php";
            } else if (res.error !== undefined) {
                var err_result = res["error"];
                switch (err_result) {
                    case "email_not_set":
                        document.getElementById("email_error").innerHTML =
                            "No email given";
                        break;

                    case "email_incorrect":
                        document.getElementById("email_error").innerHTML =
                            "E-mail is incorrect";
                        break;

                    case "password_not_set":
                        document.getElementById("password_error").innerHTML =
                            "No password given";
                        break;

                    case "password_incorrect":
                        document.getElementById("password_error").innerHTML =
                            "Password is incorrect";
                        break;
                }
            } else {
                document.getElementById("general_error").innerHTML = "Something went wrong, please try again later!";
            }
            
        }
    };
    xmlhttp.open("POST", "login.php", true);
    xmlhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );
    xmlhttp.send("email=" + username + "&password=" + password);
}
