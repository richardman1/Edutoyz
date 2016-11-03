<?php
//Sessie starten
session_start();
//Root map speciferen voor de includes.
$root = $_SERVER["DOCUMENT_ROOT"] . "/includes/";
//Database connectie bestand importeren.
include $root . "db_connection.php";
error_reporting(E_ALL);
?>
<!doctype html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <!-- Titel van de pagina -->
        <title>EduToyz</title>        
        <link rel="stylesheet" type="text/css" href="/css/Generalsheet.css" media="screen">
        <link rel="stylesheet" type="text/css" href="/css/Navigationsheet.css" media="screen">
        <link rel="stylesheet" type="text/css" href="/css/Home.css" media="screen">
        <link rel="stylesheet" type="text/css" href="/css/login.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/cartdisplay.css" media="screen">
        <!-- Javascript bestanden / code -->
        <script src="javascript/jquery.js"></script>
    </head>
    <body>
        <?php include $root . "header.php"; ?>
        <div id="mainContent">
            <div id="leftimage">
            </div>
            <section>
                <article>

                    <div id="loginblok">
                        <h1>Log in</h1>
                        <hr>
                        <p>
                            Om in te loggen voer hieronder <br />uw gebruikersnaam en wachtwoord in:
                        </p>
                        <br />
                        <form id="inlogblok" method="post" action="">
                            Uw gebruikersnaam:<br />
                            <input type="text" name="gebruikersnaam" size="25" placeholder="Gebruikersnaam" required><br />
                            Uw wachtwoord:<br />
                            <input type="password" name="wachtwoord" size="25" placeholder="Wachtwoord" required><br />
                            <input id="knoppen" type="submit" name="login" value="Log in">
                        </form>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gebruikersnaam']) && isset($_POST['wachtwoord']))
                        {
                            // We gaan de errors in een array bijhouden
                            // We kunnen dan alle foutmeldingen in één keer afdrukken.
                            $aErrors = array();

                            if (empty($_POST['gebruikersnaam']))
                            {
                                $aErrors['gebruikersnaam'] = 'Geen geldige gebruikersnaam.';
                            }

                            // Wanneer er geen foutieve invoer is gaan we naar de database.
                            if (count($aErrors) == 0)
                            {

                                $sql    = "SELECT Klantnummer, `Wachtwoord`, `Loginnaam` FROM `Klant` WHERE `Loginnaam`='" . $_POST['gebruikersnaam'] . "' AND `Wachtwoord` = '" . $_POST['wachtwoord'] . "';";
                                // Voer de query uit 
                                $result = mysqli_query($link, $sql) or die(mysqli_error($link) . "<br>in file " . __FILE__ . " on line " . __LINE__);

                                if (mysqli_num_rows($result) == 0)
                                {
                                    $aErrors['gebruikersnaam'] = 'De gebruikersnaam of het wachtwoord is onjuist.';
                                    unset($_POST['gebruikersnaam']);
                                    unset($_POST['wachtwoord']);
                                }
                                else
                                {
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                                    // Bij een ingelogde gebruiker bewaren we de naam en het klantnr in de sessie.
                                    // Hiermee kunnen we de klantnaam op het scherm tonen, en de winkelwagen aan 
                                    // het juiste klantnr koppelen, zodat de bestelling later afgerond kan worden.
                                    $_SESSION['klantnummer'] = $row["Klantnummer"];
                                    $_SESSION['naam']        = $row["Loginnaam"];
                                    // Sluit de connection
                                    echo $sql;
                                    header("location:index.php");
                                    mysqli_close($link);
                                }
                            }
                        }
                        if (isset($aErrors) and count($aErrors) > 0)
                        {
                            print '<ul class="errorlist">';
                            foreach ($aErrors as $error)
                            {
                                print '<p class="warning">' . $error . '</p>';
                            }
                            print '</ul>';
                        }
                        ?>
                    </div>

                    <div id="registratieblok">
                        <h1>Nog geen account?</h1>
                        <hr>	
                        <p>
                            Indien u nog geen account heeft om in te loggen, klik op de link hieronder om te registreren. 
                            <br /><br /><a href="registreren.php" title="Registratieformulier" name="registreren" >Registreren</a><br /><br />
                            Met uw account kunt in de webwinkel uw inkopen doen. Daarnaast wordt bij het registratieformulier
                            ook gevraagd naar enkele persoonlijke gegevens.
                        </p>
                        <br />
                        <p class="bijschrijvingen">Deze gegevens zijn in verband met uw privacy beschermt.</p>	
                    </div>

                </article>
            </section>
            <div style="width: 190px; float: right;">
                <div id="rightimage">

                </div>
                <?php include $root . "cartdisplay.php"; ?>
            </div>
            <div style="clear: both;"></div>
        </div>
        <?php include $root . "footer.php"; ?>
    </body>
</html>