<?php 

if ($_SERVER["REQUEST_METHOD"] != "POST") {
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
$config = require("../../private/config.php");

$pepper = $config["pepper"];

require_once "../../private/database.php";
$database = new Database();

$compare = $database->select_one("SELECT `Wachtwoord` FROM `gebruiker` WHERE email = ?", ["s", [$email]]);
if (empty($compare) || is_null($compare)){
    http_response_code(400);
    echo json_encode(array("error" => "email_incorrect"));
    exit();
} elseif ($compare === false){
    http_response_code(400);
    echo json_encode(array("general_error" => "Something went wrong trying to access the database"));
    exit();
}
$ssalt = explode(".", $compare["Wachtwoord"])[0];
$pd_hash = hash_hmac("sha512", $ssalt.$password, $pepper);

if ($ssalt.".".$pd_hash === $compare["Wachtwoord"]){
    echo json_encode(array("success" => "login_success"));
} else {
    http_response_code(400);
    echo json_encode(array("error" => "password_incorrect"));
}
?>