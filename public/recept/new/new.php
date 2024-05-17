<?php session_start();
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

    $mealtype = ["ontbijt" == 1, "lunch" == 2, "avondmaal" == 3, "snack" == 4, "dessert" == 5, "voorgerecht" == 6];
    $id = $mealtype[$_POST["mealType"]];

    $Database->insert("INSERT INTO recepten('Title','Bereiding','Personen','Moeilijkheid','Berijdingstijd','MaaltijdtypeID','foto')
            VALUES (?,?,?,?,?,?,?, NOW())", ["ssiiis", [$title, $bereiding, $servings, $difficulty, $prepTime, $id, $picture]]);

    //$Database->insert("INSERT INTO ingredient('Ingredrient') VALUES (?, NOW())", ["s", [$ingredients]]);

    //$Database->insert("INSERT INTO tag('Tagname') VALUES (?, NOW())", ["s", [$tags]]);
?>