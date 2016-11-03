<?php
//Sessie starten
session_start();
//Root map speciferen voor includes (header en footer)
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
				<article>
                <div id="ART1">
                    <!-- HIER CONTENT INVOEREN -->
                    <h1>Disclaimer</h1>
                    <hr>
                    <p>
                        Dit bericht kan informatie bevatten die niet voor u is bestemd.<br> 
                        Indien u niet de geadresseerde bent of dit bericht abusievelijk<br>
                        aan u is gezonden, wordt u verzocht dat aan de afzender te melden 
                        en het bericht te verwijderen.<br> 
                        EduToyz aanvaardt geen aansprakelijkheid voor schade, van welke aard<br> 
                        dan ook, die verband houdt met risico's verbonden aan het elektronisch 
                        verzenden van berichten.</p><br>
                </div>
				</article>
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