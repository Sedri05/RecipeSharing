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
<p class="success" id="success"></p>
<div class="info-text">
    <h2> Naam </h2>
    <p> <?php echo  $user["Naam"] . " " . $user["Achternaam"] ?> </p>
</div>
<div class="info-text">
    <h2> Email </h2>
    <p> <?php echo $email ?> </p>
</div>
<div class="info-text">
    <h2> Join Date </h2>
    <p> <?php echo date_format(date_create($user["Joindate"]), "F jS Y H:i:s") ?> </p>
</div>