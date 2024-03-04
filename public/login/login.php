<?php 

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "bad";
    http_response_code(401);
    exit();
}
$email = $_POST["email"];
$password = $_POST["password"];

if (!isset($email) || empty($email)){
    http_response_code(400);
    echo json_encode(array("bad" => "email"));
    exit();
}
if (!isset($password) || empty($password)){
    http_response_code(400);
    echo json_encode(array("bad" => "password"));
    exit();
}
$pepper = "c11cefbafd5407f876c640c41c1c4a60f9d6ee073281d3b4bce9290e799f5f5d";
//$salt = bin2hex(random_bytes(32));
//$pd_hash = hash_hmac("sha512", $salt.$password, $pepper);
//echo $salt . "<br>" . $pd_hash . "<br>";


require_once "../../private/database.php";
$database = new Database();

$compare = $database->select_one("SELECT `Wachtwoord` FROM `gebruiker` WHERE email = ?", ["i", $email]);
$ssalt = explode(".", $compare["Wachtwoord"])[0];

$pd_hash = hash_hmac("sha512", $ssalt.$password, $pepper);


if ($ssalt.".".$pd_hash === $compare["Wachtwoord"]){
    echo "wow succes";
} else {
    echo "bad :(";
}
?>