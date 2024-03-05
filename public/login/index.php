<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="scripts.js"></script>
</head>

<body>
    <label for="email">E-mail</label>
    <input type="text" id="email"> </input>
    <p id="email_error"></p>
    <label for="password">Password</label>
    <input type="password" id="password"> </input>
    <p id="password_error"></p>
    <input type="button" onclick="login()" value="Log in"></input>
    <p id="general_error">

    </p>
</body>

</html>