<?php 

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "bad";
    http_response_code(401);
    exit(401);
}
echo $_POST["username"];
?>