<?php session_start();
if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["logged_in"])) {
    http_response_code(401);
    exit();
}
require_once("../../../private/database.php");

$target_dir = $_SERVER["DOCUMENT_ROOT"] . "/img/";
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$allowUpload = true;

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "bmp" && $imageFileType != "webp") {
    $allowUpload = false;
}

if (!(getimagesize($_FILES["picture"]["tmp_name"]) !== false)) {
    $allowUpload = false;
}

if (!$allowUpload) {
    http_response_code(401);
    echo "Something went wrong while trying to process this request.";
    exit();
}


$Database = new Database();
$title = $_POST["title"];
$tags = $_POST["tags"];
$ingredients = $_POST["ingredients"];
$mealtype = $_POST["mealType"];
$prepTime = $_POST["prepTime"];
$difficulty = $_POST["difficulty"];
$servings = $_POST["servings"];
$bereiding = $_POST["instructions"];
if (empty($title) || empty($ingredients) || empty($tags) || empty($mealtype) || empty($prepTime) || empty($difficulty) || empty($servings) || empty($bereiding)){
    echo "Something went wrong while trying to process this request.";
    exit();
}

$recept_id = $Database->insert("INSERT INTO recept(`Title`, `GebruikerID`,`Bereiding`,`Personen`,`Moeilijkheid`,`Berijdingstijd`,`MaaltijdtypeID`, `Date`)
            VALUES (?,?,?,?,?,?,?, NOW())", ["sisiiii", [$title, $_SESSION["user"], $bereiding, $servings, $difficulty, $prepTime, $mealtype]], false);

$target_file = $target_dir . $recept_id . "." . $imageFileType;

if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
    $Database->delete("DELETE FROM recept WHERE ReceptID = ?", ["i", [$recept_id]]);
    exit();
}

$tag_ids = [];

foreach ($tags as $tag) {
    if ($tag == "") continue;
    $ingredient = ucfirst($tag);
    $Database->insert("INSERT INTO tag (`Tagname`) SELECT ? WHERE NOT EXISTS ( SELECT 1 FROM tag WHERE `Tagname` = ? )", ["ss", [$tag, $tag]], false);
    $tag_ids[] = $Database->select_one("SELECT TagID FROM tag WHERE Tagname = ?", ["s", [$tag]], false)["TagID"];
    $tag_ids[] = $recept_id;
}

$ingredient_ids = [];

foreach ($ingredients as $ingredient) {
    if ($ingredient == "") continue;
    $ingredient = ucfirst($ingredient);
    $Database->insert("INSERT INTO ingredient (`Ingredient`) SELECT ? WHERE NOT EXISTS ( SELECT 1 FROM ingredient WHERE `Ingredient` = ? )", ["ss", [$ingredient, $ingredient]], false);
    $ingredient_ids[] = $Database->select_one("SELECT IngredientID FROM ingredient WHERE Ingredient = ?", ["s", [$ingredient]], false)["IngredientID"];
    $ingredient_ids[] = $recept_id;
}

$values = rtrim(str_repeat("(?, ?),", count($ingredient_ids) / 2), ',');
$Database->insert("INSERT INTO ingredientrecept(`IngredientID`,`ReceptID`) VALUES " . $values, [str_repeat("i", count($ingredient_ids)), $ingredient_ids], false);

$values = rtrim(str_repeat("(?, ?),", count($tag_ids) / 2), ',');
$Database->insert("INSERT INTO tagsrecept(`TagID`,`ReceptID`) VALUES " . $values, [str_repeat("i", count($tag_ids)), $tag_ids], false);


$Database->close();
header("Location: /recept/?recept=" . $recept_id);
die();
//$Database->insert("INSERT INTO ingredient(`Ingredrient`) VALUES (?, NOW())", ["s", [$ingredients]]);

//$Database->insert("INSERT INTO tag(`Tagname`) VALUES (?, NOW())", ["s", [$tags]]);
