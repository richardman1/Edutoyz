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
        <!-- Javascript bestanden / code -->
        <script src="javascript/jquery.js"></script>
    </head>
    <body>
        <?php include("includes/header.php"); ?>
        <div id="mainContent">
            <section id="leftimage">
            </section>
            <section>
                <article id="ART1">
                    <h1>Registratieformulier</h1>
                    <hr>
                    <p>
                        Dit registratieformulier bevat enkele gegevens die nodig zijn om inkopen te doen bij EduToyz. Verder moet u een gebruikersnaam en wachtwoord aanmaken om in te kunnen loggen.
                    </p>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                            isset($_POST['gebruikersnaam'], $_POST['naam'], $_POST['wachtwoord'], $_POST['wachtwoordcontrole'], $_POST['adres'], $_POST['woonplaats'], $_POST['geboortedatum'], $_POST['telefoonnummer'], $_POST['email'], $_POST['postcode']))
                    {
                        // We gaan de errors in een array bijhouden
                        // We kunnen dan alle foutmeldingen in een keer afdrukken.
                        $aErrors = array();

                        //  Een naam bevat letters en spaties (minimaal 3)
                        if (!isset($_POST['gebruikersnaam']) or !preg_match('~^[\w ]{3,24}$~', $_POST['gebruikersnaam']))
                        {
                            $aErrors['gebruikersnaam'] = 'Uw gebruikersnaam is niet juist ingevuld';
                        }

                        //  Een naam bevat letters en spaties (minimaal 3)
                        if (!isset($_POST['naam']) or !preg_match('~^[\w ]{3,}$~', $_POST['naam']))
                        {
                            $aErrors['naam'] = 'Uw naam is niet juist ingevuld';
                        }

                        //  Een email-adres is wat ingewikkelder
                        if (!isset($_POST['email']) or !preg_match('~^[a-z0-9][a-z0-9_.\-]*@([a-z0-9]+\.)*[a-z0-9][a-z0-9\-]+\.([a-z]{2,6})$~i', $_POST['email']))
                        {
                            $aErrors['email'] = 'Het e-mailaddres is onjuist.';
                        }

                        //  Een adres heeft letters, cijfers, spaties (minimaal 5)
                        if (!isset($_POST['adres']) or !preg_match('~^[\w\d ]{5,}$~', $_POST['adres']))
                        {
                            $aErrors['adres'] = 'Het adres is onjuist.';
                        }

                        //  Een plaatsnaam heeft letters, spaties en misschien een apostrof
                        if (!isset($_POST['woonplaats']) or !preg_match('~^[\w\d\' ]*$~', $_POST['woonplaats']))
                        {
                            $aErrors['woonplaats'] = 'De woonplaats is onjuist';
                        }

                        //  Een postcode heeft vier cijfers, eventueel een spatie, en twee letters
                        if (!isset($_POST['postcode']) or !preg_match('~^\d{4} ?[a-zA-Z]{2}$~', $_POST['postcode']))
                        {
                            $aErrors['postcode'] = 'De postcode is onjuist';
                        }

                        // wachtwoord (minimaal 3)
                        if (!isset($_POST['wachtwoord']) or !preg_match('~^[\w ]{3,30}$~', $_POST['wachtwoord']))
                        {
                            $aErrors['wachtwoord'] = 'Onjuist wachtwoord ingevuld.';
                        }

                        // wachtwoord (minimaal 3)
                        if (!isset($_POST['wachtwoordcontrole']) or !preg_match('~^[\w ]{3,30}$~', $_POST['wachtwoordcontrole']))
                        {
                            $aErrors['wachtwoordcontrole'] = 'Onjuist wachtwoord ingevuld.';
                        }

                        if (count($aErrors) == 0)
                        {

                            if (mysqli_connect_errno())
                            {
                                printf("Connect failed: %s\n", mysqli_connect_error());
                            }

                            if ($_POST['wachtwoord'] != $_POST['wachtwoordcontrole'])
                            {
                                echo '<br /><div class="warning">Wachtwoorden komen niet overeen met elkaar.</div>';
                            }
                            else
                            {
                                $sql = "INSERT INTO Klant (`Loginnaam`,`Naam`, `Adres`, `Plaats`, `Wachtwoord`, `E-mailadres`,`Postcode`,`Telefoonnummer`,`Geboortedatum`) VALUES " .
                                        "('" . $_POST['gebruikersnaam'] . "', '" . $_POST['naam'] . "', '" . $_POST['adres'] . "', '" . $_POST['woonplaats'] . "', '" . $_POST['wachtwoord'] . "', '" . $_POST['email'] . "', '" . $_POST['postcode'] . "', '" . $_POST['telefoonnummer'] . "', '" . $_POST['geboortedatum'] . "');";

                                // Voer de query uit en vang fouten op 
                                if (!mysqli_query($link, $sql))
                                {
                                    $aErrors['gebruikersnaam'] = '<div class="warning">Registratie mislukt.</div>';
                                }
                                else
                                {
                                    echo '<br /><p>Het registreren van uw account is gelukt!<br /><br /><a href="login.php" title="login pagina">Klik hier</a> om terug naar log in scherm te gaan</p>';
                                    // Met myslqi_insert_id krijg je de id van het autoincrement veld terug - het klantnr.
                                    $klantnummer = mysqli_insert_id($link);

                                    $_SESSION['klantnummer'] = $klantnummer;
                                    $_SESSION['naam']        = $_POST["naam"];

                                    // Sluit de connection
                                    mysqli_close($link);
                                }
                            }
                        }
                    }

                    if (isset($aErrors) and count($aErrors) > 0)
                    {
                        print '<ul class="errorlist">';
                        foreach ($aErrors as $error)
                        {
                            print '<li class="warning">' . $error . '</li>';
                        }
                        print '</ul>';
                    }

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                            isset($_POST['gebruikersnaam'], $_POST['naam'], $_POST['wachtwoord'], $_POST['wachtwoordcontrole'], $_POST['adres'], $_POST['woonplaats'], $_POST['geboortedatum'], $_POST['telefoonnummer'], $_POST['email'], $_POST['postcode']))
                    {
                        
                    }
                    else
                    {
                        ?>
                        <br />
                        <h3>
                            Vul hier uw gegevens in:
                        </h3>
                        <form id="registratieform" method="post" action="">
                            <table id="toevoegenp" >
                                <tr><th colspan="3"><h2>Gebruikersaccount:</h2></th></tr>
                                <tr><td colspan="3"><hr></td></tr>
                                <tr><th>Uw Gebruikersnaam:					</th><td><input type="text" name="gebruikersnaam" size="24" maxlength="24" placeholder="gebruikersnaam" required>								<br></td>
                                    <td>Maximaal 24 karakters</td></tr>
                                <tr><th>Voer uw Wachtwoord in:			</th><td><input type="password" name="wachtwoord" placeholder="wachtwoord" size="30" maxlength="30" required>								<br></td>
                                    <td>Maximaal 30 karakters</td></tr>
                                <tr><th>Voer nogmaals uw Wachtwoord in <br/>(ter controle): </th><td><input type="password" name="wachtwoordcontrole" size="30" placeholder="wachtwoord" maxlength="35" required>	<br></td></tr>

                                <td><br /></td>

                                <tr><th colspan="3"><h2>Persoonlijke gegevens:</h2></th>
                                <tr><td colspan="3"><hr></td></tr>
                                <tr><th>Voer uw Naam in:				</th><td><input type="text" name="naam" placeholder="naam" size="35" maxlength="45" required>												<br></td></tr>
                                <tr><th>Voer uw Adres in:				</th><td><input type="text" name="adres" placeholder="adres" size="35" maxlength="35" required>												<br></td></tr>
                                <tr><th>Voer uw Woonplaats in:			</th><td><input type="text" name="woonplaats" placeholder="woonplaats" size="20" maxlength="35" required>									<br></td></tr>
                                <tr><th style="text-align: left;">Voer uw Postcode in:			</th><td><input type="text" name="postcode" placeholder="1234AB" size="6" maxlength="6" required>								<br></td></tr>
                                <tr><th>Voer uw Geboortedatum in:		</th><td><input type="date" name="geboortedatum" placeholder="dd-mm-yyyy" size="10" maxlength="11" required>								<br></td></tr>
                                <tr><th>Voer uw Telefoonnummer in:		</th><td><input type="tel" name="telefoonnummer" placeholder="06-12345678" size="12" maxlength="14" required>								<br></td></tr>
                                <tr><th>Voer uw E-mailadres in:			</th><td><input type="email" name="email" placeholder="Jantje@gmail.com" size="30" maxlength="45" required>									<br></td></tr>

                                <tr><td colspan="2" id="bijschrijvingen">*alle velden zijn verplicht en vreemde tekens worden niet ondersteund</td><th align="right"><input id="knoppen" align="right" type="submit" name="toevoegsubmit" value="Verstuur"></th></tr>
                            </table>
                        </form>
                        <!--						
                                                                        <br/><br/>
                        <h2>Klant verwijderen</h2>
                        <form method="post" action="">
                        Vul het klantnummer in:<input type="text" name="klantnr"><br />
                        <input type="submit" name="Verwijdersubmit" value="Verwijder"><br /><br />
                        </form>
                        -->
                        <?php
                    }
                    /*
                      if(isset ($_POST['Verwijdersubmit'])) {
                      $a = $_POST['klantnr'];
                      $query = "DELETE  FROM `klant` WHERE `klantnummer` = '$a';";
                      mysqli_query($link, $query);
                      if(mysqli_affected_rows($link)> 0) {
                      echo "De klant is verwijderd";
                      }
                      else {
                      echo "De klant kon niet worden verwijderd of bestaat niet";
                      }}
                     */
                    ?>
                </article>
            </section>
            <aside id="rightimage">
            </aside>
            <div style="clear: both;"></div>
        </div>
        <?php include $root . "footer.php"; ?>
    </body>
</html>