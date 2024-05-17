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
            </div></div>
            
            <?php require("../footer.php") ?>
        <?php die();
        }
        require_once("../../private/database.php");
        $database = new Database();
        $data = $database->select("SELECT ReceptID, Title FROM recept");
        $search_str = $_GET["search"];
        /*usort($data, function ($a, $b) use ($search_str){
            $a = $a["Title"];
            $b = $b["Title"];
            if ($a == $b) return 0;
            elseif ($a == $search_str) return -1;
            elseif ($b == $search_str) return 1;
            return levenshtein($a, $search_str) <=> levenshtein($b, $search_str);
        });*/

        
        $distances = [];
        foreach ($data as $d){
            $distances[] = [$d, compareSentences($d["Title"], $search_str)];
        }

        usort($distances, function($a, $b) {
            return $a[1] - $b[1]; // Ascending order
        });


        print_r($distances);
        
        ?>
        <div class="container">
            <div class="results">
                <h1 class="search-title">Search Results for: </h1>
            </div>
        </div>
    </div>
    <?php require("../footer.php") ?>
</body>

</html>

<?php 
function compareSentences($sentence1, $sentence2) {
    $words1 = explode(" ", $sentence1);
    $words2 = explode(" ", $sentence2);

    $totalDistance = 0;

    foreach ($words1 as $word1) {
        $minDistance = PHP_INT_MAX;

        foreach ($words2 as $word2) {
            $levDistance = levenshtein($word1, $word2);
            if ($levDistance < $minDistance) {
                $minDistance = $levDistance;
            }
        }

        $totalDistance += $minDistance;
    }

    return $totalDistance;
}
?>