<?php session_start();
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(401);
    exit();
}
require_once("../../private/database.php");
$Database = new Database;
$title = $_POST["title"];
$picture = $_POST["picture"];
$tags = $_POST["tags"];
$ingredients = $_POST["ingredients"];
$mealtype = $_POST["mealType"];
$prepTime = $_POST["prepTime"];
$difficulty = $_POST["difficulty"];
$servings = $_POST["servings"];
$bereiding = $_POST["instructions"];
if (empty($title) || empty($picture));

$recept_id = $Database->insert("INSERT INTO recepten('Title','Bereiding','Personen','Moeilijkheid','Berijdingstijd','MaaltijdtypeID','foto')
            VALUES (?,?,?,?,?,?,?, NOW())", ["ssiiis", [$title, $bereiding, $servings, $difficulty, $prepTime, $id, $picture]]);

//$Database->insert("INSERT INTO ingredient('Ingredrient') VALUES (?, NOW())", ["s", [$ingredients]]);

//$Database->insert("INSERT INTO tag('Tagname') VALUES (?, NOW())", ["s", [$tags]]);
