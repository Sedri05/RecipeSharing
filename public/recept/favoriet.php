<?php
session_start();
if (!isset($_SESSION["logged_in"])) { ?>
    <p> You are not logged in. Click <a href="../login/">Here</a> to log in.</p>
<?php
    die();
}

$user = $_SESSION["user"];
$id = $_POST["id"];
require("../../private/database.php");
$database = new Database();
$result = $database->select("SELECT `ReceptID`, `GebruikerID` FROM `favoriet` WHERE `ReceptID` = ? AND `GebruikerID` = ?", ["ii", [$id, $user]]);
if (count($result) > 0) {
    $database->delete("DELETE FROM `favoriet` WHERE `ReceptID` = ? AND `GebruikerID` = ?", ["ii", [$id, $user]]);
} else {
    $database->insert("INSERT INTO `favoriet`(`ReceptID`, `GebruikerID`) VALUES (?,?)", ["ii", [$id, $user]]);
}
echo json_encode(array("success" => "success"));
?>