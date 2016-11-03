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
            <section id="leftimage">
            </section>
            <section>
                <div id="ART1">
                    <article>
                        <h1>Kortingen<h1>
                                <hr>

                                <p>
                                    Binnen onze webwinkel bieden wij allerlei kortingen aan per periode van 4 weken.<br>
                                    Hier bieden wij onze bestaande producten aan tegen een korting afhankelijk van de periode en het soort product.<br>
                                    Deze kortingen kunt u vinden op onze aanbiedingen pagina. Deze kunt u bereiken door te klikken op 'Aanbiedingen' bovenin het scherm.
                                </p>
                                </article>
                                </div>
                                </section>
                                <div style="width: 190px; float: right;">
                                    <div id="rightimage">

                                    </div>
                                    <?php include $root . "cartdisplay.php"; ?>
                                </div>
                                <div style="clear: both;"><br></div>
                                </div>
                                <?php include $root . "footer.php"; ?>
                                </body>
                                </html>