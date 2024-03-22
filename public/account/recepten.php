<?php
session_start();
$user = $_SESSION["user"];
require_once("../../private/database.php");
$database = new Database();

$recepten = $database->select("SELECT `ReceptID`, `Title`, `Personen`, `Moeilijkheid`, `Berijdingstijd`, `Foto`, `MaaltijdtypeID`, `Date` FROM `recept` WHERE `GebruikerID` = ?", ["i", [$user]], false);

foreach ($recepten as $recept){
    ?>
    <div class="info-text">
            <h1> <?php echo $recept["Title"]?>
    </div>
    <?php
}

?>