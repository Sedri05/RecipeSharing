function login(){
    username = document.getElementById("email").value;
    password = document.getElementById("password").value;
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            document.getElementById("err").innerHTML = this.responseText;
        
        }
    };
    xmlhttp.open("POST", "login.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("email=" + username + "&password=" + password);
}