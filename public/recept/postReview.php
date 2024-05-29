<?php
session_start();
if (!isset($_SESSION["logged_in"])) { ?>
    <p> You are not logged in. Click <a href="../login/">Here</a> to log in.</p>
<?php
    die();
}

$user = $_SESSION["user"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["text"]) || empty($_POST["score"] || empty($_POST["id"]))){
        exit();
    }

    $text = $_POST["text"];
    $score = $_POST["score"];
    $id = $_POST["id"];

    require_once("../../private/database.php");
    $database = new Database();
    $database->insert("INSERT INTO `review` (`GebruikerID`, `ReceptID`, `Score`, `Reviewtekst`, `Date`) VALUES (?, ?, ?, ?, NOW())", ["iiis", [$user, $id, $score, $text]]);
    $res = $database->select_one("SELECT Naam, Achternaam FROM gebruiker WHERE GebruikerID = ?", ["i", [$user]]);
    echo json_encode(array("success" => $res["Naam"] . " " . $res["Achternaam"]));
}

?>