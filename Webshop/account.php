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
            <div id="leftimage">
            </div>
            <section>
                <article>
                    <div id="ART1">
                        <h1>Uw account</h1>
                        <hr>
						<p>
						Welkom bij uw account. Hier kunt u al uw gegevens zien die geregistreerd zijn.
						</p>
<?php
if (empty($_SESSION['klantnummer'])) {
	echo "<p>U bent niet ingelogd.</p>\n";
} else {
	$klantnummer = $_SESSION['klantnummer'];

	$sql = "SELECT * FROM `Klant` WHERE `klantnummer`='".$klantnummer."'";
	// Voer de query uit en sla het resultaat op 

	$result = mysqli_query($link, $sql) or die (mysqli_error($link)."<br>Error in file ".__FILE__." on line ".__LINE__);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	echo "<fieldset id='accountfield'>\n";
	echo "<table id='accounttable'>\n";
	echo "<tr><th>Loginnaam:</td>		 		<th>".$row["Loginnaam"]."</td></tr>\n";
	echo "<tr><th>Naam:</td> 					<th>".$row["Naam"]."</td></tr>\n";
	echo "<tr><th>Adres:</td>					<th>".$row["Adres"]."</td></tr>\n";
	echo "<tr><th>Postcode:</td>					<th>".$row["Postcode"]."</td></tr>\n";
	echo "<tr><th>Geboortedatum:</td>			<th>".$row["Geboortedatum"]."</td></tr>\n";
	echo "<tr><th>Plaats:</td>					<th>".$row["Plaats"]."</td></tr>\n";
	echo "<tr><th>E-mail:</td>					<th>".$row["E-mailadres"]."</td></tr>\n";
	echo "<tr><th>Telefoonnummer:</td>			<th>".$row["Telefoonnummer"]."</td></tr>\n";
	echo "</table>\n";
	echo "</fieldset>\n";
}

$sql    = "SELECT * FROM `Order` WHERE Klantnummer = {$_SESSION["klantnummer"]}";
$result = mysqli_query($link, $sql);
$datum  = "";
while ($row    = mysqli_fetch_array($result))
{
    if ($datum != $row["Datum"])
    {
        $datum = $row["Datum"];
        echo "<h1>$datum</h1>"
        . "<h3>Gemaakte order(s):</h3>";
    }
    echo "<span>Order {$row["Ordernummer"]}: <a href='factuur.php?Ordernummer={$row["Ordernummer"]}'>bekijken</a><br>";
}
?>

                </article>
            </section>
            <div style="width: 190px; float: right;">
                <div id="rightimage">

                </div>
                <?php include $root . "cartdisplay.php"; ?>
            </div>
            <div style="clear: both;">
                <br>
            </div>
        </div>
        <?php include $root . "footer.php"; ?>
    </body>
</html>