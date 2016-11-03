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
					<h1>Retourneren</h1>
				   <hr>
				 <?php if (empty($_SESSION['klantnummer']))
                    {
                        echo "<p>U ben nog niet ingelogd. <a href=\"login.php\">Log eerst in</a> om uw bestelling af te ronden.</p>";
                    }
                    else
                    {
					echo "<p>
				   Bent u niet tevreden en wilt u uw product terugsturen? Dan kunt u het product terugsturen naar onderstaand adres:</p>";
				   
					?>
					Vult u hieronder de productnummers in van de producten die u wilt terugsturen. Gebruikt u hiervoor de productnummers die op de factuur vermeld staan. <br>
					Vult u ook het totaal aantal producten in dat u wilt terugsturen.<br><br>
					<form id="inlogblok" method="post" action="">
                            De productnummers van de producten die u wilt terugsturen:<br />
                            <input type="text" name="producten" required><br />
                            Totaal aantal producten:<br />
                            <input type="text" name="aantal" required><br />
                            <input id="knoppen" type="submit" name="login" value="Verstuur">
                        </form>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['producten']) && !empty($_POST['aantal']))
                        {
						$explproduct = explode(",", $_POST['producten']);
						$datumpje = date("d-m-Y");
						foreach($explproduct as $value){
						 $sql = "INSERT INTO `retour` (`Klantnummer`, `Productnummer`, `Aantal`, `Datum`) VALUES ('" . $_SESSION['klantnummer'] . "', '" . $value . "', '" . $_POST['aantal'] . "', '" . $datumpje . "');";
                            $result = mysqli_query($link, $sql) or die(mysqli_error($link) . "<br>in file " . __FILE__ . " on line " . __LINE__);
						}
						}
						}
					?>
				   </article>
                   </div>
            </section>
            <aside id="rightimage">
            </aside>
            <div style="clear: both;"><br></div>
        </div>
        <?php include $root . "footer.php"; ?>
    </body>
</html>