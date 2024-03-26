<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="reset.css" rel="stylesheet">
    <link href="Front-end.css" rel="stylesheet" >
</head>

<body>
    <div class="wrapper">
        <?php require("header.php") ?>

        <div class="content">

            <h3 class="par1">Het populairste recept:</h3>
            <?php
            require_once "../private/database.php";
            $database = new Database();
            $recepten = $database ->select("SELECT `ReceptID`, `Title`, `Moeilijkheid`, `Foto`, `Date` FROM `recept` ORDER by Date DESC;");
            foreach ($recepten as $recept) {
            ?>
            <div class="recept-row">
                <a href="/recept/?recept= <?php echo $recept["ReceptID"] ?>"><img class="foto1" src="/pasta-met-zalm-1.jpg" alt="een foto"> </a>
                <h2 class="recept-title"> <?php echo $recept["Title"] ?> </h2>
            </div>
            <?php
            }
            ?>
            
            <?php if (isset($_SESSION["logged_in"])) { ?>
                <p> You are logged in</p>
            <?php } ?>
            <h3>Kijk ook</h3>

            <h3>Snelle recepten</h3>
        </div>
    </div>
    <?php require("footer.php") ?>
    
</body>

</html>