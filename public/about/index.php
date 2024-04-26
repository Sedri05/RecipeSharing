<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/reset.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <?php
        require("../header.php")
        ?>
        <div class="container">
            <div class="content">
                <h1>Over ons</h1>
                <p>Welkom bij Chefly! Wij zijn Senne, Szymon en Bram en wij hebben een website gemaakt die bedoeld is om het delen van recepten en ontdekken van nieuwe recepten gemakkelijker moet maken.</p>
                <h2>Features</h2>
                <ul>
                    <li>Zelf heel gemakkelijk recepten toevoegen</li>
                    <li>Ingrediënten zijn globaal opgeslagen dus je kan recepten zoeken op welke ingrediënten je hebt.</li>
                    <li>Tags om recepten te vinden gesorteerd per categorie.</li>
                </ul>
            </div>
        </div>


    </div>
    <?php
    require("../footer.php")
    ?>
</body>

</html>