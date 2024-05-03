<?php

function sendToIndex()
{
    header('Location: /account');
}

session_start();
$user = $_SESSION["user"];
require_once("../../private/database.php");
$database = new Database();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST["naam"];
    $achternaam = $_POST["achternaam"];
    $email = $_POST["email"];
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];

    if (!isset($email) || empty($email)) {
        http_response_code(400);
        echo json_encode(array("error" => ["email", "No e-mail given!"]));
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(array("error" => ["email", "This is not a valid e-mail adress"]));
        exit();
    }
    if (!isset($old_password) || empty($old_password)) {
        http_response_code(400);
        echo json_encode(array("error" => ["password", "No password given!"]));
        exit();
    }
    if (!isset($naam) || empty($naam)) {
        http_response_code(400);
        echo json_encode(array("error" => ["firstname", "No first name given!"]));
        exit();
    }
    if (!isset($achternaam) || empty($achternaam)) {
        http_response_code(400);
        echo json_encode(array("error" => ["lastname", "No last name given!"]));
        exit();
    }

    //$database->update("UPDATE `gebruiker` SET `Wachtwoord` = '2bee824640f18a96fdaf5e64cf3751ecb777d637c85b646cad71493e7033b0a6.31b47a817dcbefbd932e64956e958b1a06027cb1af0fbb43a1f2d305fe3f9d79d3e92001c72afc342b85c75a8df80841317477490445be0a9095ed5749faa3ef' WHERE `GebruikerID` = 1", [], false);

    $update_password = false;
    if (isset($new_password) && !empty($new_password)) {
        $update_password = true;
        $hashed_new_password = $database->hash_password($new_password);
    }

    $user_info = $database->select_one("SELECT `Wachtwoord`, `Email` FROM `gebruiker` WHERE `GebruikerID` = ?", ["i", [$user]], false);
    $hashed = $user_info["Wachtwoord"];
    if (!$database->check_password($old_password, $hashed)) {
        $database->close();
        http_response_code(400);
        echo json_encode(array("error" => ["password", "Gegeven wachtwoord is incorrect!"]));
        exit();
    }

    $email_check = $database->select_one("SELECT `GebruikerID` FROM `gebruiker` WHERE `Email` = ?", ["s", [$email]], false);
    if (!empty($email_check) && $email_check["GebruikerID"] != $user) {
        $database->close();
        http_response_code(400);
        echo json_encode(array("error" => ["email", "Dit e-mail adres is al in gebruik!"]));
        exit();
    }
    //echo "UPDATE `gebruiker` SET `Naam`= ?, `Achternaam`= ?, `Email`= ?" . ($update_password ? ", `Wachtwoord`= '" . $hashed_new_password . "'" : "") . " WHERE `GebruikerID` = ?";
    $database->update(
        "UPDATE `gebruiker` SET `Naam`= ?, `Achternaam`= ?, `Email`= ?" . ($update_password ? ", `Wachtwoord`= '" . $hashed_new_password . "'" : "") . " WHERE `GebruikerID` = ?",
        ["sssi", [$naam, $achternaam, $email, $user]]
    );
    echo json_encode(array("success"=>"success"));

} else {
    
    $user = $database->select_one("SELECT `GebruikerID`, `Naam`, `Achternaam`, `Email`, `Joindate` FROM `gebruiker` WHERE `GebruikerID` = ?", ["i", [$user]]);

    $email_parts = explode("@", $user["Email"]);
    $local_part = $email_parts[0];
    $masked_local_part = strlen($local_part) > 2 ? substr($local_part, 0, 2) . str_repeat("*", strlen($local_part) - 2) : "**";
    $email = $masked_local_part . "@" . $email_parts[1];
?>
    <form onsubmit="updateInfo(this)" method="POST">
        <div class="info-text">
            <h2> Voornaam </h2>
            <input name="naam" class="text-input" type="text" value="<?php echo $user["Naam"] ?>">
            <p id="firstname_error"></p> <!--Errors hier-->
        </div>
        <div class="info-text">
            <h2> Achternaam </h2>
            <input name="achternaam" class="text-input" type="text" value="<?php echo $user["Achternaam"] ?>">
            <p id="lastname_error"></p> <!--Errors hier-->
        </div>
        <div class="info-text">
            <h2> Email </h2>
            <input name="email" class="text-input" type="text" value="<?php echo $user["Email"] ?>">
            <p id="email_error"></p>
        </div>
        <div class="info-text">
            <h2> Wachtwoord </h2>
            <input name="old_password" class="text-input" type="password">
            <p id="password_error"></p>
        </div>
        <div class="info-text">
            <h2> Nieuw wachtwoord </h2>
            <input id="pw" name="new_password" class="text-input" type="text" oninput="checkPassword()">
        </div>
        <div class="info-text">
            <h2> Herhaal wachtwoord </h2>
            <input id="her_pw" name="her_password" class="text-input" type="text" oninput="checkPassword()">
            <p class="error" id="confirm_password_error"> </p>
        </div>
        <div class="info-text submit-div">
            <input class="submit" type=submit value="Opslaan">
        </div>
        
        <p class="error" id="general_error"> </p>
        
    </form>
<?php } ?>