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
    <?php require("../header.php")?>
    <div class="container">
        <label for="email">E-mail</label>
        <input type="text" id="email"> </input>
        <p id="email_error"></p> <!--Hier komen email errors zoals, geen of incorrecte email. Maak dit rood-->
        <label for="password">Password</label>
        <input class="" type="password" id="password"> </input>
        <p id="password_error"></p> <!--Hier komen wachtwoord errors zoals, geen of incorrect wachtwoord. Maak dit rood-->
        <input type="button" onclick="login()" value="Log in"></input>
        <p id="general_error"></p> <!--Hier komen general errors. Maak dit rood-->
        <a href="../signup">Ik heb geen account.</a>
    </div>
</body>

</html>