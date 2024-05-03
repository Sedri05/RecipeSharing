<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="scripts.js"></script>
    <link href="/reset.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <?php if (!isset($_SESSION["logged_in"])) { ?>
        <p> You are not logged in. Click <a href="../login/">Here</a> to log in.</p>
    <?php
        die();
    }

    $user = $_SESSION["user"];
    require_once("../../private/database.php");
    $database = new Database();
    $user = $database->select_one("SELECT `GebruikerID`, `Naam`, `Achternaam`, `Email`, `Joindate` FROM `gebruiker` WHERE `GebruikerID` = ?", ["i", [$user]]);
    //print_r($user);
    $email_parts = explode("@", $user["Email"]);
    $local_part = $email_parts[0];
    $masked_local_part = strlen($local_part) > 2 ? substr($local_part, 0, 2) . str_repeat("*", strlen($local_part) - 2) : "**";
    $email = $masked_local_part . "@" . $email_parts[1];
    ?>
    <div class="wrapper">
        <?php require("../header.php"); ?>
        <div class="container">
            <div class="action-select">
                <button class="action-button" selected id="informatie" onclick="getAction('informatie', this)">Mijn informatie</button>
                <button class="action-button" id="verander" onclick="getAction('veranderInformatie', this)">Verander informatie</button>
                <button class="action-button" id="recepten" onclick="getAction('recepten', this)">Mijn recepten</button>
                <button class="action-button" id="favorieten" onclick="getAction('favorieten', this)">Favorieten</button>
                <button class="action-button" id="delete" onclick="getAction('verwijderAccount', this)">Verwijder Account</button>
                <button class="action-button" id="logout" onclick="logout()">Log Out</button>
            </div>
            <div class="info" id="info">
                <div class="info-text">
                    <h2> Naam </h2>
                    <p> <?php echo  $user["Naam"] . " " . $user["Achternaam"] ?> </p>
                </div>
                <div class="info-text">
                    <h2> Email </h2>
                    <p> <?php echo $email ?> </p>
                </div>
                <div class="info-text">
                    <h2> Join Date </h2>
                    <p> <?php echo date_format(date_create($user["Joindate"]), "F jS Y H:i:s") ?> </p>
                </div>
            </div>
        </div>
    </div>
    <?php require("../footer.php"); ?>
</body>

</html>