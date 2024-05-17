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
                <h1 class="title">Over ons</h1>
                <p>Welkom bij Chefly! Wij zijn Senne, Szymon en Bram en wij hebben een website gemaakt die bedoeld is om het delen van recepten en ontdekken van nieuwe recepten gemakkelijker moet maken.</p>
                <h2>Features</h2>
                <ul>
                    <li>Zelf heel gemakkelijk recepten toevoegen</li>
                    <li>Ingrediënten zijn globaal opgeslagen dus je kan recepten zoeken op welke ingrediënten je hebt.</li>
                    <li>Tags om recepten te vinden gesorteerd per categorie.</li>
                    <li>Door recepten aan je favorieten toe te voegen kan je ze opslagen voor later.</li>
                </ul>
                <h2>Het team</h2>
                <ul>
                    <li>Senne De Vriendt</li>
                    <ul>
                        <li>Secundair diploma: Industriële ICT</li>
                        <li>Richting: Application Development</li>
                        <li>E-mail: sennedevriendt@telenet.be</li>
                    </ul>
                    <li>Szymon Bartus</li>
                    <ul>
                        <li>Secundair diploma:Industriële Wetenschappen</li>
                        <li>Richting: Application Development</li>
                        <li>E-mail: szymon.bartus04@hotmail.com</li>
                    </ul>
                    <li>Bram Ryckmans</li>
                    <ul>
                        <li>Secundair diploma:Industriële Wetenschappen</li>
                        <li>Richting: Security, Systems & Services</li>
                        <li>E-mail: bram.ryckmans@gmail.com</li>
                    </ul>
                </ul>
            </div>
        </div>


    </div>
    <?php
    require("../footer.php")
    ?>
</body>

</html>