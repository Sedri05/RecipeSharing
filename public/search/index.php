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
    // Split sentences into words
    $words1 = explode(" ", $sentence1);
    $words2 = explode(" ", $sentence2);

    // Variable to hold the total Levenshtein distance
    $totalDistance = 0;

    // Loop through each word in the first sentence
    foreach ($words1 as $word1) {
        $minDistance = PHP_INT_MAX;

        // Compare it to each word in the second sentence
        foreach ($words2 as $word2) {
            // Calculate Levenshtein distance
            $levDistance = levenshtein($word1, $word2);

            // If this distance is less than the current minimum, update minimum
            if ($levDistance < $minDistance) {
                $minDistance = $levDistance;
            }
        }

        // Add the minimum distance for this word to the total distance
        $totalDistance += $minDistance;
    }

    // Return the total Levenshtein distance
    return $totalDistance;
}
?>