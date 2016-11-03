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
        <!-- Javascript bestanden / code -->
        <script src="javascript/jquery.js"></script>
        <script>
        </script>
    </head>
    <body>
        <?php include $root . "header.php"; ?>
        <div id="mainContent">
            <section id="searchblock">
            </section>
            <section>
                <div id="ART1">
                    <!-- HIER CONTENT INVOEREN -->
                </div>
            </section>
            <aside id="rightimage">
            </aside>
            <div style="clear: both;"><br></div>
        </div>
        <?php include $root . "footer.php"; ?>
    </body>
</html>