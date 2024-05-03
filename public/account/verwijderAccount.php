<?php
session_start();
$user = $_SESSION["user"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../../private/database.php");
    $database = new Database();
    $database->update("UPDATE `gebruiker` SET `Naam`='Deleted User',`Achternaam`='',`Email`='',`Wachtwoord`='' WHERE GebruikerID = ?", ["i", [$user]]);
    unset($_SESSION["logged_in"]);
    $_SESSION["user"] = "";
    session_destroy();
    echo json_encode(array("success" => "success"));
} else {
?>
    <form onsubmit="verwijderAccount()" method="POST" class="delete-form">
        <h2 class="delete-h2"> Ben je zeker dat je je account wilt verwijderen? </h2>
        <p class="delete-p">Je kan deze actie niet omkeren.</p>

        <input class="delete-submit" type=submit value="Verwijder mijn account!">

        <p class="error" id="general_error"> </p>

    </form>
<?php } ?>