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
        <link rel="stylesheet" type="text/css" href="css/inlogpagina.css" media="screen">

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
                    <?php
                    $sql  = "SELECT Naam FROM Product LIMIT 0,1";

                    $regels = mysqli_query($link, $sql);
                    if (mysqli_error($link))
                    {
                        echo mysqli_error($link); //Controle voor mysql fouten, voor de zekerheid + makkelijker voor als het bestand naar de server gaat. 
                    }
                    else
                    {
                        if (mysqli_num_rows($regels) == 0) // == 0 bijgezet. Aangezien we alleen willen dat "Geen factuur gevonden" alleen bij 0 getoont wordt.
                        {
                            echo "Geen facturen gevonden.";
                        }
                        else
                        {
                            $regel = mysqli_fetch_array($regels);
                            echo "<table>";
                            echo "<tr><td>" . $regel["Naam"] . "</td></tr>"; //<tr> & </tr> bijgevoegd
                        }
                    }
                    echo "</table>"
                    ?>
                </div>
            </section>
            <aside id="rightimage">
            </aside>
            <div style="clear: both;"><br></div>
        </div>
        <?php include $root . "footer.php"; ?>
    </body>
</html>