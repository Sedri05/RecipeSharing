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
    event.preventDefault();
    xmlhttp.open("POST", "favoriet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + id);
}


function putReview(id) {
    event.preventDefault();
    var review = document.getElementById("review");
    var score = document.getElementById("score");
  

    if (review.value == "" || score.value == "") {
        document.getElementById("error").style.display = "block";
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            console.log(this.responseText);
            var res = JSON.parse(this.responseText);
            if (res.success === undefined) {
                //document.getElementById("review_error").innerHTML = "Something went wrong, please try again later!";
            }
        }
    }
    xmlhttp.open("POST", "postReview.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("text=" + review.value + "&score=" + score.value + "&id=" + id);
}
