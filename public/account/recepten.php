<?php
session_start();
$user = $_SESSION["user"];
require_once("../../private/database.php");
$database = new Database();

$recepten = $database->select(
    "SELECT `ReceptID`, `Title`, `Personen`, `Moeilijkheid`, `Berijdingstijd`, `Foto`, m.`Maaltijdtype`, `Date` FROM `recept` r LEFT JOIN `maaltijdtype` m ON r.`MaaltijdtypeID` = m.`MaaltijdtypeID` WHERE `GebruikerID` = ?",
    ["i", [$user]]
);

foreach ($recepten as $recept) {
?>
    <div class="info-text">
        <h2 class="recept-title"> <?php echo $recept["Title"] ?> </h2>
        <div class="recept-info">
            <div class="info-button"> Personen: <?php echo $recept["Personen"] ?> </div>
            <div class="info-button"> Moeilijkheid: <?php echo $recept["Moeilijkheid"] ?>/5 </div>
            <div class="info-button"> Bereidingstijd: <?php echo $recept["Berijdingstijd"] ?>mins </div>
            <div class="info-button"> Maaltijdtype: <?php echo $recept["Maaltijdtype"] ?> </div>
        </div>
    </div>
<?php
}

?>