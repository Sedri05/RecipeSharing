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
    $review = $database->select_one("SELECT * FROM `review` WHERE `ReceptID` = ?", ["i", [$recept_id]]);
    echo "<title>" . $recept_info["Title"] . "</title>";
    ?>
    <div class="centered">
        <div class="container">
            <div class="title-div">
                <h1> <?php echo $recept_info["Title"]; ?> </h1>
                <p> <?php echo $creator["Naam"] . " " . $creator["Achternaam"] ?> </p>
            </div>
            <div class="ingr-tags-image">
                <div class="recept-image">
                    <img  style='height: 400px; width: 700px; object-fit: cover'src="/black-cake-2.jpg" alt="dit is een test foto"/>
                </div>
                <div class="ingr-tags">
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
                </div>
            </div>
            
            <div class="bereiding-div">
                <p class="bereiding-title">Bereiding</p>
                <div class="bereiding">
                    <p>
                        <?php echo $recept_info["Bereiding"]; ?>
                    </p>
                </div>
            </div>
            <hl>
            <div class="review-div">
                <p class="review-title">Reviews</p>
                <div class="review">
                    <p>
                        <?php echo $review["reviewtekst"]; ?>
                    </p>
                </div>

            </div>
        </div>
    </div>
                        
    <?php require("../footer.php") ?>
</body>

</html>