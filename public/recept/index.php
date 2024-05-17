<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="scripts.js"></script>
    <link href="/reset.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <div class="wrapper">
        <?php require("../header.php");
        if (!isset($_GET["recept"])) { ?>
            <p> 404 Site not found </p>
        <?php die();
        }
        require_once "../../private/database.php";
        $recept_id = intval($_GET["recept"]);
        //echo "<script> var ID = " . $recept_id . "; </script>";
        $database = new Database();
        $recept_info = $database->select_one("SELECT * FROM `recept` WHERE `ReceptID` = ?", ["i", [$recept_id]], false);
        $recept_tags = $database->select("SELECT `Tagname` FROM `tag` t LEFT JOIN `tagsrecept` r ON t.TagID = r.TagID WHERE r.ReceptID = ?", ["i", [$recept_id]], false);
        $ingredients = $database->select("SELECT `Ingredient` FROM `ingredient` i LEFT JOIN `ingredientrecept` r ON i.IngredientID = r.IngredientID WHERE r.ReceptID = ?", ["i", [$recept_id]], false);
        $creator = $database->select_one("SELECT `Naam`, `Achternaam` FROM `gebruiker` WHERE `GebruikerID` = ?", ["i", [$recept_info["GebruikerID"]]], false);
        $review = $database->select("SELECT * FROM `review` WHERE `ReceptID` = ?", ["i", [$recept_id]], false);
        $type = $database->select_one("SELECT `Maaltijdtype` FROM `maaltijdtype` WHERE `MaaltijdtypeID` = ?;", ["i", [$recept_info["MaaltijdtypeID"]]]);
        $reviews = $database->select("SELECT `ReviewID`, g.Naam, g.Achternaam, `Score`, `Reviewtekst`, `Date` FROM `review` r LEFT JOIN `gebruiker` g ON r.GebruikerID = g.GebruikerID WHERE `ReceptID` = ? ORDER BY `Date`", ["i", [$recept_id]]);
        
        $favoriet = false;
        if (isset($_SESSION["logged_in"])) {
            $temp = $database->select("SELECT `ReceptID`, `GebruikerID` FROM `favoriet` WHERE `ReceptID` = ? AND `GebruikerID` = ?", ["ii", [$recept_id, $_SESSION["user"]]]);
            $favoriet = count($temp) > 0;
        }
        ?>
        <title><?php echo $recept_info["Title"]; ?></title>
        <div class="centered">
            <div class="container">
                <div class="title-div">
                    <h1> <?php echo $recept_info["Title"]; ?> </h1>
                    <div class="favorite" onclick="favorite(<?php echo $recept_id; ?>)">
                        <span id="favorite" class="fixed"><?php echo (!$favoriet) ?  "favorite" : "heart_check" ?></span>
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
                    <!--
                    <div class="info-icon right">
                        <span class="material-symbols-outlined fixed"> favorite
                        </span>
                    </div>
                    -->
                    <div class="info-box right">
                        <p> <?php echo $creator["Naam"] . " " . $creator["Achternaam"] ?> </p>
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
                        <img class="image" src="<?php echo $database->get_image($recept_id) ?>" alt="dit is een test foto" />
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
                            <?php 
                            foreach($reviews as $review){ ?>
                            <div class="user-review">
                                <h3 class="review-user"><?php echo $review["Naam"] . " " . $review["Achternaam"] . " - " . $review["Score"] . "/5" ?></h3>
                                <p class="review-text"><?php echo $review["Reviewtekst"]?></p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require("../footer.php"); ?>
</body>
</html>