<?php
// checkout.php
//
// Dit bestand zorgt ervoor dat de winkelwagen van de klant in een bestelling en één of meer
// bestelregels wordt opgenomen. Als dit gelukt is is de bestelling geregistreerd
// en de winkelwagen geleegd.
//
// Opdracht: op dit moment wordt de actuele prijs van een product én de totaalprijs 
// van de bestelling nog niet bij de bestelling in de database geregistreerd. 
// Zorg ervoor dat deze prijzen worden geregistreerd bij een bestelling.
//Sessie starten
session_start();
//Root map speciferen voor includes (header en footer)
$root = $_SERVER["DOCUMENT_ROOT"] . "/includes/";
//Database connectie bestand importeren.
include $root . "db_connection.php";
setlocale(LC_ALL, "en_EN");
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
            <section id="leftimage">
            </section>
            <section>
				<article>
                <div id="ART1">
                    <?php
                    // Page header:
                    echo '<h1>Bestelling afronden</h1>';
                    if (empty($_SESSION['klantnummer']))
                    {
                        echo "<p>U ben nog niet ingelogd. <a href=\"login.php\">Log eerst in</a> om uw bestelling af te ronden.</p>";
                    }
                    else
                    {
                        if (empty($_SESSION['cart']))
                        {
                            echo "<p>Er staan geen producten in de winkelwagen. Voeg eerst producten toe.</p>";
                        }
                        else
                        {
                            // Stap 1, zet de order in de bestelling tabel
                            // Een bestelling heeft ook een bestelnummer (autoincrement), besteldatum (huidige datum/tijd), 
                            // en status (default: open).
                            $sql    = "INSERT INTO `Order` (`Klantnummer`, `Datum`) VALUES ('" . $_SESSION['klantnummer'] . "', CURDATE());";
                            $result = mysqli_query($link, $sql) or die(mysqli_error($link) . "<br>in file " . __FILE__ . " on line " . __LINE__);

                            $bestelnr = mysqli_insert_id($link); // insert_id geeft de id terug van het autoincrement veld - het bestelnr dus.
                            // Stap 2, winkelwagen splitsen en de producten in bestelregels in de database zetten
                            $cart     = explode("|", $_SESSION['cart']);
                            foreach ($cart as $products)
                            {
                                // Splits het product in stukjes: $product[x] --> x == 0 -> product id, x == 1 -> hoeveelheid
                                $product       = explode(",", $products);
                                $sql2          = "SELECT Prijs 
				  FROM Product
                                  WHERE Productnummer = {$product[0]};";  // Weet je nog, uit die sessie
                                $resultProduct = mysqli_query($link, $sql2) or die(mysqli_error($link) . "<br>in file " . __FILE__ . " on line " . __LINE__);
                                $row           = mysqli_fetch_array($resultProduct);
                                $prijs         = $row["Prijs"];

                                $prijzen[] = $prijs * $product[1];

                                // Hier willen we productprijs toevoegen aan de productregel. De productprijs is de prijs van het 
                                // product. Deze zit nog niet in de sessie, en moet daar dus bij het bestellen (bijvoorbeeld 
                                // in index.php) in worden gezet.
                                // We tellen hier ook het bedrag per product op (prijs x aantal) en tellen dit op bij de totaalprijs.
                                // Je kunt in cart.php kijken hoe je dat kunt doen.
                                $sql3   = "INSERT INTO Orderregel (Ordernummer, Productnummer, Aantal, Prijs) 
                                VALUES ($bestelnr, {$product[0]}, '{$product[1]}', $prijs);";
                                $result = mysqli_query($link, $sql3) or die(mysqli_error($link) . "<br>in file " . __FILE__ . " on line " . __LINE__);
                            }
                            $sql4 = "INSERT INTO Factuur (Totaalbedrag, Ordernummer) VALUES (" . number_format(array_sum($prijzen), 2, ".", "") . "," . $bestelnr . ");";
                            mysqli_query($link, $sql4);
                            if (mysqli_error($link))
                            {
                                echo mysqli_error($link);
                            }
                            // 
                            // Op dit moment hebben we de totaalprijs berekend. Deze moeten we nu nog in een aparte
                            // query in de bestelling zetten. Je hebt $bestelnr, dus voeg daar de totaalprijs aan toe.
                            // 
                            // Bericht naar de gebruiker.
                            echo "<p>Uw bestelling is afgerond.</p>";

                            // Leeg de winkelwagen door deze uit de sessie te verwijderen.
                            // De overige gegevens in de sessie blijven behouden.
                            if (isset($_SESSION['cart']))
                            {
                                unset($_SESSION['cart']);
                            }
                            // Sluit de connection
                            mysqli_close($link);
                        }
                    }
                    ?>
                </div>
				</article>
            </section>
            <aside id="rightimage">
            </aside>
            <div style="clear: both;"><br></div>
        </div>
        <?php include $root . "footer.php"; ?>
    </body>
</html>