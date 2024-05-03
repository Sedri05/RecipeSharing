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

            <h3 class="par1">Recente recepten:</h3>
            <?php
            require_once "../private/database.php";
            $database = new Database();
            $recepten = $database ->select("SELECT `ReceptID`, `Title`, `Moeilijkheid`, `Foto`, `Date` FROM `recept` ORDER by Date DESC;");
            foreach ($recepten as $recept) {
            ?>
            <div class="recept-row">
                <a href="/recept/?recept=<?php echo $recept["ReceptID"] ?>">
                    <div class="column">
                        <img src="<?php echo $database->get_image($recept["ReceptID"])?>">
                    </div>
                </a>
                
                <div class="recept-info-column">
                    <h2 class="recept-info-title"> <?php echo $recept["Title"] ?> </h2>
                    <p class="recept-info"> Moeilijkheid: <?php echo $recept["Moeilijkheid"] ?> </p>
                </div>
                
            </div>
            <?php
            }
            ?>
            
            <?php if (isset($_SESSION["logged_in"])) { ?>
                <p> You are logged in</p>
            <?php } ?>
                <a href="/recept/new/index.php">Recepten toevoegen</a>
        </div>
    </div>
    <?php require("footer.php") ?>
    
</body>
</html>