<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="Front-end.css" rel="stylesheet" />
</head>

<body>
    <?php require("header.php") ?>

    <div class="content">

        <h3 class="par1">Het populairste recept:</h3>
        #float
        <img class="foto1" src="" alt="een foto">
        <span>Kleine synopsis van recept of tags van de recept</span>
        <?php if (isset($_SESSION["logged_in"])) {?>
        <p> You are logged in</p>
        <?php } ?>

        <h3>Kijk ook</h3>

        <h3>Snelle recepten</h3>

    </div>

    <footer>
        <ul>
            <li>Home</li>
            <li>Populaire</li>
            <li>Tags</li>
            <li>Over Ons</li>
            <li>Contact</li>
            <li>Inloggen</li>
        </ul>
    </footer>
</body>

</html>