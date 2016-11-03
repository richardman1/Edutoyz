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
        <link rel="stylesheet" type="text/css" href="css/Klantenservice.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/cartdisplay.css" media="screen">
		<link rel="stylesheet" type="text/css" href="css/login.css" media="screen">
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
                <div id="klantenserviceblok">
                    <div id="ART1">
                        <h1>Klantenservice</h1>
                        <hr>
                        <h2>Bedrijfsgegegevens</h2>
                        <p>
                            EduToyz<br>
                            Wilderen 267<br>
                            4817VD Breda<br><br>
                            IBAN: NL79INGB0007359831 <br>
                            KvK: 55897541<br>
                            BTW: NL851902376B01<br>
                        </p>
                        <hr>

                        <br />
                        <p>
                            Heeft u een vraag, klacht of een opmerking?
                            Laat u het ons weten!
                        </p>
                        <br />
                        <form method="post" id="klantenserviceform">
                            <input type="text" name="naam" placeholder="Naam"><br>
                            <input type="text" name="emailadres" placeholder="E-mailadres"><br>
                            <textarea name="bericht" cols="30" rows="5" placeholder="Typ hier uw tekst"></textarea>
                            <br>
                            <input id="knoppen" type="submit" name="verzendsubmit" value="Verzenden">
                        </form>
                        <?php
                        if (!empty($_POST["verzendsubmit"]))
                        {
                            $naam       = $_POST["naam"];
                            $emailadres = $_POST["emailadres"];
                            $bericht    = $_POST["bericht"] . "\n\nDit bericht is afkomstig van $emailadres";

                            $result = mail("gregorhoogstad@gmail.com", "Opmerking $naam", $bericht);
                            if ($result == true)
                            {
                                $verstuurd = true;
                            }
                            else
                            {
                                $verstuurd = false;
                            }
                            //var_dump($result);
                        }
                        ?>

                    </div>
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
        <script>
<?php
if ($verstuurd == true)
{
    echo "alert('Bericht verstuurd');";
}
?>
        </script>
    </body>
</html>