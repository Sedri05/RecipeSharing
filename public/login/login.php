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
    echo json_encode(array("error" => "email_not_set"));
    exit();
}
if (!isset($password) || empty($password)){
    http_response_code(400);
    echo json_encode(array("error" => "password_not_set"));
    exit();
}
$pepper = "c11cefbafd5407f876c640c41c1c4a60f9d6ee073281d3b4bce9290e799f5f5d";

require_once "../../private/database.php";
$database = new Database();

$compare = $database->select_one("SELECT `Wachtwoord` FROM `gebruiker` WHERE email = ?", ["s", $email]);
if (empty($compare) || is_null($compare)){
    echo json_encode(array("error" => "email_incorrect"));
    exit();
} elseif ($compare === false){
    echo json_encode(array("general_error" => "Something went wrong trying to access the database"));
    exit();
}
$ssalt = explode(".", $compare["Wachtwoord"])[0];
$pd_hash = hash_hmac("sha512", $ssalt.$password, $pepper);

if ($ssalt.".".$pd_hash === $compare["Wachtwoord"]){
    echo json_encode(array("success" => "login_success"));
} else {
    echo json_encode(array("error" => "password_incorrect"));
}
?>