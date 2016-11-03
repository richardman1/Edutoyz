<?php
//Sessie starten
session_start();
//Root map speciferen voor includes (header en footer)
$root = $_SERVER["DOCUMENT_ROOT"] . "/includes/";
//Database connectie bestand importeren.
include $root . "db_connection.php";

$productquery = "SELECT * FROM `Product` WHERE Korting > 0 ORDER BY `Product`.`Naam` ASC;";
$producthtml  = "";

//Voor ieder gevonden product maken we appart vak dat wordt ingevuld door de data van het product.
$productresult = mysqli_query($link, $productquery);
echo mysqli_error($link);
while ($row           = mysqli_fetch_assoc($productresult))
{
    //Gegevens ophalen.
    $id           = $row["Productnummer"];
    $naam         = $row["Naam"];
    $prijs        = $row["Prijs"];
    $voorraad     = $row["Voorraad"];
    $beschrijving = $row["Beschrijving"];
    $korting      = $row["Korting"];

    //Voorraad bepalen.
    $voorraadtekst = "Op voorraad";
    if ($voorraad === 0)
    {
        $voorraadtekst = "Niet op voorraad";
    }
    else if ($voorraad < 5)
    {
        $voorraadtekst = "Beperkt op voorraad";
    }

    //html voor de producten aanmaken.
    $aangepasteprijs = $prijs * ((100 - $korting) / 100);
    $producthtml .= '<form action="add.php" method="get">'
            . '<div class="product">'
            . '<img src="images_webwinkel/' . $id . '.jpg" alt="">'
            . '<span class="voorraad">' . $voorraadtekst . '</span>'
            . '<div class="beschrijving"><h3>' . $naam . '</h3><p>' . $beschrijving . '</p></div>'
            . '<div class="prijs">'
            . '<div class="prijsdiv"><h3>Prijs:</h3><br><h3 style="text-decoration: line-through;">Van: €' . $prijs . '</h3><br>'
            . '<h3>Voor: €' . number_format($aangepasteprijs, 2, ",", ".") . '</h3><br>'
            . '<input type="number" name="hoeveelheid" value="1"><button type="submit" name="productnr" value="' . $id . '">Bestel</button></div>'
            . '</div>'
            . '</div>'
            . '</form>';
}
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
        <link rel="stylesheet" type="text/css" href="css/webwinkel.css" media="screen">
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
            <section id="productlijst"> 
                <article>
                    <?php setlocale(LC_ALL, "nl_NL"); ?>
                    <h1>Aanbiedingen voor <?php echo strftime("%A %e %B", strtotime("-7 days")) . " tot " . strftime("%A %e %B", strtotime("+7 days")); ?>:</h1>
                    <?php echo $producthtml; ?>
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