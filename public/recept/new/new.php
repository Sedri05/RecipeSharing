<?php session_start();
if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["logged_in"])) {
    http_response_code(401);
    exit();
}
require_once("../../../private/database.php");

print_r($_POST);

$Database = new Database();
$title = $_POST["title"];
$tags = $_POST["tags"];
$ingredients = $_POST["ingredients"];
$mealtype = $_POST["mealType"];
$prepTime = $_POST["prepTime"];
$difficulty = $_POST["difficulty"];
$servings = $_POST["servings"];
$bereiding = $_POST["instructions"];
if (empty($title) || empty($picture));

$recept_id = $Database->insert("INSERT INTO recept(`Title`,`Bereiding`,`Personen`,`Moeilijkheid`,`Berijdingstijd`,`MaaltijdtypeID`, `Date`)
            VALUES (?,?,?,?,?,?, NOW())", ["ssiiii", [$title, $bereiding, $servings, $difficulty, $prepTime, $mealtype]]);

echo $recept_id;

foreach ($ingredients as $ingredient){
    
}
//$Database->insert("INSERT INTO ingredient(`Ingredrient`) VALUES (?, NOW())", ["s", [$ingredients]]);

//$Database->insert("INSERT INTO tag(`Tagname`) VALUES (?, NOW())", ["s", [$tags]]);
