<?php
session_start();
$user = $_SESSION["user"];
require_once("../../private/database.php");
$database = new Database();
$user = $database->select_one("SELECT `GebruikerID`, `Naam`, `Achternaam`, `Email`, `Joindate` FROM `gebruiker` WHERE `GebruikerID` = ?", ["i", [$user]]);
//print_r($user);
$email_parts = explode("@", $user["Email"]);
$local_part = $email_parts[0];
$masked_local_part = strlen($local_part) > 2 ? substr($local_part, 0, 2) . str_repeat("*", strlen($local_part) - 2) : "**";
$email = $masked_local_part . "@" . $email_parts[1];
?>
<form>
<div class="info-text">
    <h2> Voornaam </h2>
    <input class="text-input" type="text" value="<?php echo $user["Naam"]?>">
</div>
<div class="info-text">
    <h2> Achternaam </h2>
    <input class="text-input" type="text" value="<?php echo $user["Achternaam"] ?>">
</div>
<div class="info-text">
    <h2> Email </h2>
    <input class="text-input" type="text" value="<?php echo $user["Email"] ?>">
</div>
<div class="info-text">
    <h2> Wachtwoord </h2>
    <input class="text-input" type="password">
</div>
<div class="info-text">
    <h2> Nieuw wachtwoord </h2>
    <input class="text-input" type="text">
</div>
<div class="info-text">
    <h2> Herhaal wachtwoord </h2>
    <input class="text-input" type="text">
</div>
<div class="info-text submit-div">
    <input class="submit" type=submit value="Opslaan">
</div>
</form>