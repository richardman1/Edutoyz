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
                        <h1>Feestdagen</h1>
                        <hr>

                        <p>
                            Binnen onze webwinkel bieden we allerlei speciale producten en kortingen aan tijdens de feestdagen. <br>
                            Deze aanbiedingen en producten zijn helemaal aangepast op de seizoenen en zorgen ervoor dat uw kind optimaal kan leren met betrekking tot de seizoenen.<br> 
                            Deze producten worden toegevoegd in de periode 1 week voor de feestdag(en) en verdwijnen 1 week na de feestdag(en).
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