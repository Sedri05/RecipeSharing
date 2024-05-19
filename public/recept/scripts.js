function favorite(id){
    elem = document.getElementById("favorite");
    if (elem.innerHTML == "heart_check"){
        console.log("hi")
        elem.innerHTML = "favorite";
        elem.style.fontVariationSettings = "'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24";
    } else {
        console.log("hello")
        elem.innerHTML = "heart_check";
        elem.style.fontVariationSettings = '\'FILL\' 1, \'wght\' 500, \'GRAD\' 0, \'opsz\' 24';
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            var res = JSON.parse(this.responseText);
            if (res.success === undefined) {
                document.getElementById("general_error").innerHTML = "Something went wrong, please try again later!";
            }
        }
    }
    event.preventDefault();
    xmlhttp.open("POST", "favoriet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + id);
}


function required() {
    var review = document.getElementById("review");
    var score = document.getElementById("score");
  

    if (review.value == "" || score.value == "") {
        document.getElementById("error").style.display = "block";

        return false;
    }
    return true;
}
