<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="reset.css" rel="stylesheet">
    <link href="Front-end.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <?php require("header.php") ?>
        <div class="content">

            <?php
            require_once "../private/database.php";
            $database = new Database();

            $recepten = $database->select("SELECT `ReceptID`, `Title`, `Moeilijkheid`,`Berijdingstijd`,`Personen`, `Foto`, `Date` FROM `recept` ORDER by Date DESC;");
            ?>
            <div class="center">
                <h3 class="par1">Recente recepten:</h3>
                <?php
                foreach ($recepten as $recept) {
                ?>
                    <a href="/recept/?recept=<?php echo $recept["ReceptID"] ?>" class="recept-row">
                        <div class="column">
                            <img src="<?php echo $database->get_image($recept["ReceptID"]) ?>">
                        </div>

                        <div class="recept-info-column">
                            <h2 class="recept-info-title"> <?php echo $recept["Title"] ?> </h2>
                            <p class="recept-info"> Moeilijkheid: <?php echo $recept["Moeilijkheid"] ?> </p>
                            <p class="recept-info"> Tijd: <?php echo $recept["Berijdingstijd"] ?> Minuten</p>
                            <p class="recept-info"> Voor <?php echo $recept["Personen"] ?> Personen</p>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
            <!--<a href="/recept/new/index.php">Recepten toevoegen</a>-->
        </div>
    </div>
    <?php require("footer.php") ?>

</body>

</html>