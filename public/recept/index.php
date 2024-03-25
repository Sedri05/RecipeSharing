<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="scripts.js"></script>
    <link href="/reset.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <div class="wrapper">
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
        $creator = $database->select_one("SELECT `Naam`, `Achternaam` FROM `gebruiker` WHERE `GebruikerID` = ?", ["i", [$recept_info["GebruikerID"]]], false);
        $review = $database->select("SELECT * FROM `review` WHERE `ReceptID` = ?", ["i", [$recept_id]], false);
        $type = $database->select_one("SELECT `Maaltijdtype` FROM `maaltijdtype` WHERE `MaaltijdtypeID` = ?;", ["i", [$recept_info["MaaltijdtypeID"]]]);
        ?>
        <div class="centered">
            <div class="container">
                <div class="title-div">
                    <div class="title">
                        <h1> <?php echo $recept_info["Title"]; ?> </h1>
                    </div>
                    <div class="creator">
                        <p> <?php echo $creator["Naam"] . " " . $creator["Achternaam"] ?> </p>
                    </div>
                </div>
                <div class="info">
                    <div class="info-box">
                        <p> <?php echo $type["Maaltijdtype"]; ?> </p>
                    </div>
                    <div class="info-box">
                        <p> <?php echo $recept_info["Berijdingstijd"]; ?>min </p>
                    </div>
                    <div class="info-box">
                        <p> Moeilijkheid: <?php echo $recept_info["Moeilijkheid"]; ?>/5 </p>
                    </div>
                    <div class="info-box">
                        <p> Aantal personen: <?php echo $recept_info["Personen"]; ?> </p>
                    </div>
                </div>
                <div class="ingr-tags-div">
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
                <div class="blue-box">
                <div class="bereiding-div">
                    <img class="image" src="/pasta-met-zalm-1.jpg" alt="dit is een test foto" />
                    <p class="bereiding-title">Bereiding</p>

                    <p>
                        <?php echo str_replace("\n", "<br>", $recept_info["Bereiding"]); ?>
                    </p>

                </div>
                </div>
                <div class="blue-box">
                <div class="review-div">
                    <p class="review-title">Reviews</p>
                    <div class="review">
                        <p>

                        </p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <?php require("../footer.php"); ?>
</body>

</html>