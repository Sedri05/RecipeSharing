<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="scripts.js"></script>
    <link href="/reset.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <?php require("../header.php");
    if (!isset($_GET["recept"])) { ?>
        <p> 404 Site not found </p>
    <?php die();
    }
    require_once "../../private/database.php";
    $recept_id = $_GET["recept"];
    $database = new Database();
    $recept_info = $database->select_one("SELECT * FROM `recept` WHERE `ReceptID` = ?", ["i", [$recept_id]], false);
    $recept_tags = $database->select("SELECT `Tagname` FROM `tag` t LEFT JOIN `tagsrecept` r ON t.TagID = r.TagID WHERE r.ReceptID = ?", ["i", [$recept_id]], false);
    $ingredients = $database->select("SELECT `Ingredient` FROM `ingredient` i LEFT JOIN `ingredientrecept` r ON i.IngredientID = r.IngredientID WHERE r.ReceptID = ?", ["i", [$recept_id]], false);
    $creator = $database->select_one("SELECT `Naam`, `Achternaam` FROM `gebruiker` WHERE `GebruikerID` = ?", ["i", [$recept_info["GebruikerID"]]]);

    echo "<title>" . $recept_info["Title"] . "</title>";

    print_r($recept_info);
    echo "<br> <br>";
    print_r($recept_tags);
    echo "<br> <br>";
    print_r($ingredients);
    echo "<br> <br>";
    print_r($creator);
    ?>
    <div class="centered">
        <div class="container">
            <div class="title-div">
                <h1> <?php echo $recept_info["Title"]; ?> </h1>
                <p> <?php echo $creator["Naam"] . " " . $creator["Achternaam"] ?> </p>
            </div>
            <div class="scrollmenu-div">
                <p class="scrollmenu-title">Tags</p>
                <div class="scrollmenu">
                    <?php
                    foreach ($recept_tags as $tag) {
                        echo "<p> " . $tag["Tagname"] . "</p>";
                    }
                    ?>
                </div>
            </div>
            <div class="scrollmenu-div">
                <p class="scrollmenu-title">Ingredienten</p>
                <div class="scrollmenu">
                    <?php
                    foreach ($ingredients as $ingredient) {
                        echo "<p> " . $ingredient["Ingredient"] . "</p>";
                    }
                    ?>
                </div>
            </div>
            <div>

            </div>
        </div>
    </div>

</body>

</html>