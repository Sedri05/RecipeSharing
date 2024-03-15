<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(401);
    exit();
}

$email = $_POST["email"];
$password = $_POST["password"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];

if (!isset($email) || empty($email)){
    http_response_code(400);
    echo json_encode(array("error" => ["email", "No e-mail given!"]));
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    http_response_code(400);
    echo json_encode(array("error" => ["email", "This is not a valid e-mail adress"]));
    exit();
}

if (!isset($password) || empty($password)){
    http_response_code(400);
    echo json_encode(array("error" => ["password", "No password given!"]));
    exit();
}
if (!isset($firstname) || empty($firstname)){
    http_response_code(400);
    echo json_encode(array("error" => ["firstname", "No first name given!"]));
    exit();
}
if (!isset($lastname) || empty($lastname)){
    http_response_code(400);
    echo json_encode(array("error" => ["lastname", "No last name given!"]));
    exit();
}
$config = require("../../private/config.php");
$pepper = $config["pepper"];
$salt = bin2hex(random_bytes(32));
$pd_hash = hash_hmac("sha512", $salt.$password, $pepper);
$pd_hash = $salt . "." . $pd_hash;

require_once("../../private/database.php");
$database = new Database();

$exits = $database->select_one("SELECT `email` FROM `gebruiker` WHERE `email` = ?", ["s", [$email]]);
if ($exits !== false && !is_null($exits) && array_key_exists("email", $exits)){
    http_response_code(400);
    echo json_encode(array("error" => ["email", "There is already an account under this e-mail!"]));
    exit();
}

$database->insert("INSERT INTO `gebruiker`(`Naam`, `Achternaam`, `Email`, `Wachtwoord`, `Joindate`) VALUES (?, ?, ?, ?, NOW())", ["ssss", [$firstname, $lastname, $email, $pd_hash]]);
echo json_encode(array("success" => "login_success"));

?>