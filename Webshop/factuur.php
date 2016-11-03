<?php
//Sessie starten
session_start();
//Root map speciferen voor de includes.
$root        = $_SERVER["DOCUMENT_ROOT"] . "/includes/";
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
        <link rel="stylesheet" type="text/css" href="css/factuur.css" media="screen">

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
                    <h1>FACTUUR</h1>
                    <table class="store">
                        <tbody>
                            <tr>
                                <td>
                                    EduToyz
                                    <br>
                                    Wilderen 267
                                    <br>
                                    4817VD Breda
                                    <br>
                                    Nederland
                                    <br>
                                    <br>
                                    IBAN: NL79INGB0007359831
                                    <br>
                                    KvK: 55897541
                                    <br>
                                    BTW: NL851902376B01
                                    <br>
                                </td>
                                <td align = "right" valign = "top">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $ordernummer = $_GET["Ordernummer"];
                                                $klantnummer = $_SESSION["klantnummer"];
                                                $sql         = "SELECT `Order`.`Ordernummer` , `Factuur`.`Factuurnummer` , `Order`.`Datum` , `Klant`.`Naam` , `Klant`.`Adres` , `Klant`.`Postcode` , `Klant`.`Plaats`" .
                                                        "FROM `Order` , `Factuur` , `Klant`" .
                                                        "WHERE `Order`.`Ordernummer` = '$ordernummer'" .
                                                        "AND `Factuur`.`Ordernummer` = '$ordernummer'" .
                                                        "AND `Order`.`Klantnummer` = '$klantnummer'" .
                                                        "AND `Klant`.`Klantnummer` = '$klantnummer';";

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

                                                        echo "<tr><td><b>Besteldatum:</b> " . $regel["Datum"] . "</tr></td>";
                                                        echo "<tr><td><b>Ordernummer:</b> " . $regel["Ordernummer"] . "</tr></td>";
                                                        echo "<tr><td><b>Factuurnummer:</b> " . $regel["Factuurnummer"] . "</tr></td>";
                                                    }
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="address">
                        <tbody>
                            <tr class="heading">
                                <td width="50%"><b>Besteld door</b></td>
                            </tr>
                            <?php
                            $sql    = "SELECT * FROM Klant WHERE Klantnummer = {$_SESSION["klantnummer"]}";
                            $result = mysqli_query($link, $sql);
                            $regel    = mysqli_fetch_array($result);
                            //OPMERKING Tweede querie hier weggehaald aangezien het resultaat het zelfde is als de geen hiervoor en dus overbodig.
                            echo "<td>" . $regel["Naam"] . "<br>" . $regel["Adres"] .
                            "<br>" . $regel["Postcode"] . "</br>" . $regel["Plaats"] . "<br></td>";
                            ?>
                        </tbody>
                    </table>
                    <table class="product">
                        <tbody>
                            <tr class="heading">
                                <td><b>Product(en)</b></td>
                                <td><b>Productnummer</b></td>
                                <td align="right"><b>Aantal</b></td>
                                <td align="right"><b>Prijs per stuk</b></td>
                                <td align="right"><b>Totaal</b></td>
                            </tr>
                            <?php
                            $sql1   = "SELECT `Product`.`Naam` ,  `Orderregel`.`Productnummer` ,  `Orderregel`.`Aantal` ,  `Product`.`Prijs`" .
                                    "FROM  `Product` ,  `Orderregel` " .
                                    "WHERE  `Orderregel`.`Ordernummer` =  '$ordernummer' " .
                                    "AND  `Product`.`Productnummer` =  `Orderregel`.`Productnummer` ;";
                            $rows   = mysqli_query($link, $sql1);
                            if (mysqli_error($link))
                            {
                                echo mysqli_error($link); //Controle voor mysql fouten, voor de zekerheid + makkelijker voor als het bestand naar de server gaat. 
                            }
                            else
                            {
                                if (mysqli_num_rows($rows) == 0) // == 0 bijgezet. Aangezien we alleen willen dat "Geen factuur gevonden" alleen bij 0 getoont wordt.
                                {
                                    echo "Geen facturen gevonden.";
                                }
                                else
                                {
                                    while ($row = mysqli_fetch_array($rows))
                                    {

                                        echo "<tr><td>" . $row["Naam"] . "</td>";
                                        echo "<td>" . $row["Productnummer"] . "</td>";
                                        echo "<td align='right'>" . $row["Aantal"] . "</td>";
                                        echo "<td align='right'>€" . $row["Prijs"] . "</td>";

                                        $uitkomst        = $row["Prijs"] * $row["Aantal"]; //Hier de som uitrekenen
                                        $array_totalen[] = $uitkomst; //Voor ieder product de uitkomst in de array stoppen.

                                        echo "<td align='right'>€" . $uitkomst . "</td></tr>"; //De uitkomst hier echoen.
                                    }
                                }
                            }
                            $totaal = array_sum($array_totalen);
                            ?>    
                            </tr>
                            <tr>
                                <td align="right" colspan="4"><b>Subtotaal:</b></td>
                                <td align="right">€<?php echo round($totaal / 121 * 100, 2); ?></td>
                            </tr>
                            <tr>
                                <td align="right" colspan="4"><b>BTW Hoog:</b></td>
                                <td align="right">€<?php echo round($totaal / 121 * 21, 2); ?></td>
                            </tr>
                            <tr>
                                <td align="right" colspan="4"><b>Totaal:</b></td>
                                <td align="right">€<?php echo $totaal; ?></td> <!--Het totaal echo�n-->
                            </tr>
                        </tbody></table>


                </div>
            </section>
			</article>
            <aside id="rightimage">
            </aside>
            <div style="clear: both;"><br></div>
        </div>
        <?php include $root . "footer.php"; ?>
    </body>
</html>