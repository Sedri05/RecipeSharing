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
    <div class="wrapper">
        <?php require("../header.php")?>
        <div class="container">
            <div class="navigation">
                <label class="FirstName" for="firstname">First Name</label>
                <input class="text" type="text" id="firstname"> </input>
                <p id="firstname_error"></p> <!--Errors hier-->
                <label class="LastName" for="lastname">Last Name</label>
                <input class="text" type="text" id="lastname"> </input>
                <p id="lastname_error"></p> <!--Errors hier-->
                <label class="Email" for="email">E-mail</label>
                <input class="text" type="text" id="email"> </input>
                <p id="email_error"></p> <!--Hier komen email errors zoals, geen of incorrecte email. Maak dit rood-->
                <label class="Password" for="password">Password</label>
                <input class="text" class="" type="password" id="password" oninput="checkPassword()"> </input>
                <p id="password_error"></p> <!--Hier komen wachtwoord errors zoals, geen of incorrect wachtwoord. Maak dit rood-->
                <label class="ConPassword" for="confirm_password">Confirm Password</label>
                <input class="text" type="password" id="confirm_password" oninput="checkPassword()"> </input>
                <p id="confirm_password_error"></p>  <!--Errors hier-->
                <p>Tos hier?</p>
                <input class="button" type="button" onclick="signup()" value="Sign Up"></input>
                <p id="general_error"></p> <!--Hier komen general errors. Maak dit rood-->
                <a href="../login">Ik heb al een account.</a>
            </div>
        </div>
    </div>
    <?php
    require("../footer.php")
    ?>
</body>
</html>