<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search results</title>
    <script src="scripts.js"></script>
    <link href="/reset.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <?php
        require("../header.php");
        if (!isset($_GET["search"]) && !isset($_GET["tags"])) { ?>
            <div class="container">
                <div class="results">
                    <p> Please enter a search query. </p>
                </div>
            </div>
    </div>
<?php require("../footer.php");
            die();
        }
        require_once("../../private/database.php");
        $database = new Database();
        $data = $database->select("SELECT ReceptID, Title, Bereiding, Personen, Moeilijkheid, Berijdingstijd FROM recept", [], false);
        $tags = $database->select("SELECT tr.ReceptID, t.Tagname FROM tagsrecept tr LEFT JOIN tag t ON tr.TagID = t.TagID", [], false);
        $ingredients = $database->select("SELECT tr.ReceptID, t.Ingredient FROM ingredientrecept tr LEFT JOIN ingredient t ON tr.IngredientID = t.IngredientID; ");
        $result = [];

        foreach ($data as $recipe) {
            $receptID = $recipe["ReceptID"];
            $result[$receptID] = $recipe;
            $result[$receptID]["Tags"] = [];
        }

        foreach ($ingredients as $ingr) {
            $receptID = $ingr["ReceptID"];
            if (isset($result[$receptID])) {
                $result[$receptID]["Ingredient"][] = $ingr["Ingredient"];
            }
        }

        foreach ($tags as $tag) {
            $receptID = $tag["ReceptID"];
            if (isset($result[$receptID])) {
                $result[$receptID]["Tags"][] = $tag["Tagname"];
            }
        }

        $search_str = $_GET["search"];

        $distances = [];
        foreach ($result as $d) {
            $distances[] = [$d, compareRecept($d, $search_str)];
        }

        usort($distances, function ($a, $b) {
            return $a[1] - $b[1]; // Ascending order
        });

?>
<div class="container">
    <div class="results">
        <h1 class="search-title">Search Results for: <?php echo $search_str ?></h1>
        <?php
        function dec_str($string, $length = 100)
        {
            if (strlen($string) > $length) {
                return substr($string, 0, $length) . '..';
            } else {
                return $string;
            }
        }
        $i = 0;
        foreach ($distances as $recept) {
            $i++;
            if ($i > 50) break;
            $bereiding_afgekort = dec_str($recept[0]["Bereiding"], 100);
            echo "
            <a href='/recept/?recept= " . $recept[0]["ReceptID"] . "''>
            <div class = 'result'>
                <div class = 'text-content'>
                    <p class = 'title'>" . $recept[0]["Title"] . "
                    </p>
                    <div class='row-info'>
                    <p class = 'info'> Aantal personen: " . $recept[0]["Personen"] . "
                    </p>
                    <p class = 'info'> Moeilijkheid: " . $recept[0]["Moeilijkheid"] . "</p>
                    <p class = 'info'> Tijd: " . $recept[0]["Berijdingstijd"] . " min</p>
                    </div>
                    <p class = 'bereiding'> " . $bereiding_afgekort . "</p>
                </div>
                <img src='" . $database->get_image($recept[0]["ReceptID"]) . " '>
            </div>";
        }
        ?>
    </div>
</div>
</div>
<?php require("../footer.php") ?>
</body>

</html>

<?php

function compareRecept($recept1, $recept2)
{
    $searchables2 = array_merge(explode(" ", $recept1["Title"]), $recept1["Tags"], $recept1["Ingredient"]);
    $searchables2 = array_map("strtolower", $searchables2);
    $searchables1 = explode(" ", strtolower($recept2));

    $totalDistance = 0;
    foreach ($searchables1 as $s1) {
        $minDistance = PHP_INT_MAX;
        foreach ($searchables2 as $s2) {
            $levDistance = levenshtein($s1, $s2);
            if ($levDistance < $minDistance) {
                $minDistance = $levDistance;
            }
        }
        $totalDistance += $minDistance;
    }
    return $totalDistance;
}
