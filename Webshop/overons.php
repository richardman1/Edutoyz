<?php
//Sessie starten
session_start();
//Root map speciferen voor de includes.
$root = $_SERVER["DOCUMENT_ROOT"] . "/includes/";
//Database connectie bestand importeren.
include $root . "db_connection.php";
?>
<!doctype html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <!-- Titel van de pagina -->
        <title>EduToyz</title>
        <!-- CSS bestanden oproepen -->
        <link rel="stylesheet" type="text/css" href="css/Generalsheet.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/Navigationsheet.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/Home.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/login.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/cartdisplay.css" media="screen">
        <!-- Javascript bestanden / code -->
        <script src="javascript/jquery.js"></script>
        <script>
        </script>
    </head>
    <body>
        <?php include $root . "header.php"; ?>
        <div id="mainContent">
            <div id="leftimage">
            </div>
            <section>
                <article>
                    <div id="ART1">
                        <h1>Over ons</h1>
                        <hr>
                        <img src="images_context/Artikel1.jpg" alt="Welkom!" />
                        <p>
                        <h3>Wie zijn wij?</h3>
                        </p>
                        Wij zijn Edutoyz, de nieuwste webwinkel als het gaat om educatief speelgoed.

                        <br/><br/>
                        Educatief speelgoed is speelgoed speciaal gemaakt om kinderen nieuwe vaardigheden aan te leren.
                        Dit kan zijn op gebieden van taal, rekenen, spelling, maar ook natuurkunde, geschiedenis, en ga zo maar door.

                        <br/><br/>
                        Edutoyz wil hierop inspelen door middel van het verkopen van educatief speelgoed speciaal voor alle leeftijden, op alle gebieden zodat uw kind optimaal kan leren en zo zijn of haar kennis kan verbreden.
                        <br/><br/>
                        Hierbij stellen wij de 3 leergebieden van de onderzoeker Jean Piaget hoog in het vaandel:
                        <ul>
                            <li>Cognitief (het leervermogen van het kind)</li>
                            <li>Sociaal-emotioneel (het gebied van praten en communiceren met de omgeving en het uiten van emoties)</li>
                            <li>(Psycho)motorisch (de fijne- en grove motoriek)</li>
                        </ul>
                        <br/>
                        Wij onderscheiden ons van de concurrent door het laagste prijzen, met een zo hoog mogelijke kwaliteit. Bovendien is onze webwinkel uniek als het gaat om bestellen:<br/>
                        Heeft u voor 00:00 besteld? Dan heeft u uw bestelling de volgende dag nog in huis.
                        <br><br>
                        Ons team bestaat uit 5 geweldige mensen die deze webshop tezamen draaiende houden en zich inzitten om ervoor te zorgen dat uw kind optimaal kan leren:
                        <ul>
                            <li>Marc Vandewall</li>
                            <li>Brian de Liefde</li>
                            <li>Gregor Hoogstad</li>
                            <li>Richard de Jongh</li>
                            <li>Dennis van der Meulen</li>
                        </ul>
                        <br>
                        Wij wensen u een prettige shopervaring en hopen dat u en uw kind(eren) nog lang plezier mogen hebben van onze producten.
                    </div>
                </article>
            </section>
            <div style="width: 190px; float: right;">
                <div id="rightimage">

                </div>
                <?php include $root . "cartdisplay.php"; ?>
            </div>
            <div style="clear: both;">
                <br>
            </div>
        </div>
        <?php include $root . "footer.php"; ?>
    </body>
</html>