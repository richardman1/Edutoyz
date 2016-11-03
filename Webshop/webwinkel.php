<?php
session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/includes/";
include $root . "db_connection.php";

//Het paginanummer van de productlijst ophalen, als deze leeg is wordt deze op 0 gezet. 
//Daarnaast word het eerste product dat wordt opgehaald bepaald.
if (empty($_GET["pagina"]))
{
    $pagina = 0;
    $begin  = 0;
}
else
{
    $pagina = $_GET["pagina"];
    $begin  = $pagina * 5;
}

//De producten ophalen, de query veranderd als er een catagorie of productnummer is doorgegeven. Ook wordt hier de query voor het totaal aantal gevonden producten gemaakt.
$titel = "Alle beschikbare producten:";
if (is_numeric($_GET["categorie"]))
{
    $categorieId       = $_GET["categorie"];
    $productquery      = "SELECT * FROM `Product` LEFT JOIN `ProductCatagorie` ON `Product`.`Productnummer` = `ProductCatagorie`.`Productnummer` LEFT JOIN `Catagorie` ON `Catagorie`.`Catagorienummer` = `ProductCatagorie`.`Catagorienummer`  WHERE `Catagorie`.`Catagorienummer` = $categorieId ORDER BY `Product`.`Naam` ASC LIMIT $begin , 5;";
    $productcountquery = "SELECT COUNT(*) FROM `Product` LEFT JOIN `ProductCatagorie` ON `Product`.`Productnummer` = `ProductCatagorie`.`Productnummer` LEFT JOIN `Catagorie` ON `Catagorie`.`Catagorienummer` = `ProductCatagorie`.`Catagorienummer`  WHERE `Catagorie`.`Catagorienummer` = $categorieId ORDER BY `Product`.`Naam` ASC;";
}
else if (is_numeric($_GET["pnummer"]))
{
    $pnummer           = (int) $_GET["pnummer"];
    $productquery      = "SELECT * FROM `Product` WHERE Productnummer = $pnummer ORDER BY `Product`.`Naam` ASC LIMIT $begin, 5;";
    $productcountquery = "SELECT COUNT(*) FROM `Product` WHERE Productnummer = $pnummer ORDER BY `Product`.`Naam` ASC LIMIT $begin, 5;";
    $titel             = "Gevonden resultaten:";
}
else if (!empty($_GET["product"]) && is_string($_GET["product"]))
{
    $pnummer           = mysqli_real_escape_string($link, $_GET["product"]);
    $productquery      = "SELECT * FROM `Product` WHERE Naam LIKE '%$pnummer%' ORDER BY `Product`.`Naam` ASC LIMIT $begin, 5;";
    $productcountquery = "SELECT COUNT(*) FROM `Product` WHERE Naam LIKE '%$pnummer%' ORDER BY `Product`.`Naam` ASC LIMIT $begin, 5;";
    $titel             = "Gevonden resultaten:";
}
else
{
    $productquery      = "SELECT * FROM `Product` ORDER BY `Product`.`Naam` ASC LIMIT $begin, 5;";
    $productcountquery = "SELECT COUNT(*) FROM `Product` ORDER BY `Product`.`Naam` ASC;";
}
$producthtml = "";

//Voor ieder gevonden product maken we appart vak dat wordt ingevuld door de data van het product.
$productresult = mysqli_query($link, $productquery);
echo mysqli_error($link);

if (mysqli_num_rows($productresult) == 0)
{
    $titel = "Geen producten gevonden.";
}
while ($row = mysqli_fetch_assoc($productresult))
{
    $id            = $row["Productnummer"];
    $naam          = $row["Naam"];
    $prijs         = $row["Prijs"];
    $voorraad      = $row["Voorraad"];
    $beschrijving  = $row["Beschrijving"];
    $catagorienaam = $row["Catagorienaam"];

    //Voorraad tekst bepalen op basis van de beschikbare voorraad.
    $voorraadtekst = "Op voorraad";
    if ($voorraad === 0)
    {
        $voorraadtekst = "Niet op voorraad";
    }
    else if ($voorraad < 5)
    {
        $voorraadtekst = "Beperkt op voorraad";
    }

    //Als er korting gegeven wordt op een product, wordt de prijs tekst hier aangepast.
    if ($row["Korting"] > 0)
    {
        $korting         = $row["Korting"];
        $aangepasteprijs = $prijs * ((100 - $korting) / 100);
        $prijshtml       = '<div class="prijsdiv"><h3>Prijs:</h3><br><h3 style="text-decoration: line-through;">Van: €' . $prijs . '</h3><br>'
                . '<h3>Voor: €' . number_format($aangepasteprijs, 2, ",", ".") . '</h3><br>';
    }
    else
    {
        $prijshtml = '<div class="prijsdiv"><h3>Prijs: €' . $prijs . '</h3><br>';
    }


    $producthtml .= '<form action="add.php" method="get">'
            . '<div class="product">'
            . '<img src="images_webwinkel/' . $id . '.jpg" alt="">'
            . '<span class="voorraad">' . $voorraadtekst . '</span>'
            . '<div class="beschrijving"><h3>' . $naam . '</h3><p>' . $beschrijving . '</p></div>'
            . '<div class="prijs">'
            . $prijshtml
            . '<input type="number" name="hoeveelheid" value="1"><button type="submit" name="productnr" value="' . $id . '">Bestel</button></div>'
            . '</div>'
            . '</div>'
            . '</form>';
}
//Titel van pagina aanpassen als er op een catagorie gesorteerd is.
if (!empty($categorieId))
{
    $titel = "Beschikbare producten in de catagorie $catagorienaam:";
}

//Maximaal gevonden rijen bepalen.
$result  = mysqli_query($link, $productcountquery);
$maxrows = mysqli_fetch_array($result);
$pages   = $maxrows[0] / 5;

//Volgende- en vorige pagina elementen aanmaken. 
$vorige = "";
if ($pagina !== 0)
{
    $vorige = '<button class="vorige" type="button">vorige</button>';
}
$volgende = '<button class="volgende" type="button">volgende</button>';
if ($pagina >= ($pages - 1))
{
    $volgende = "";
}

//Alle categorieën ophalen
$categorieQuery  = "SELECT Catagorienummer, Catagorienaam FROM Catagorie";
$categorieResult = mysqli_query($link, $categorieQuery);
$catagorieHTML   = "";

//Voor alle categorieën weergave html maken
while ($rij = mysqli_fetch_array($categorieResult))
{
    $naam = $rij["Catagorienaam"];
    $id   = $rij["Catagorienummer"];

    //Kijken of er een categorie geselcteerd is en de code van die categorie dik maken.
    if ($id === $categorieId)
    {
        $catagorieHTML .= '<li><span onclick="top.location.href=\'/webwinkel.php\'" style="font-weight: bold;">' . $naam . '</span></li>';
    }
    else
    {
        $catagorieHTML .= '<li><span onclick="top.location.href=\'/webwinkel.php?categorie=' . $id . '\'">' . $naam . '</span></li>';
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>EduToyz</title>
        <!-- CSS bestanden oproepen -->
        <link rel="stylesheet" type="text/css" href="css/Generalsheet.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/Navigationsheet.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/webwinkel.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/cartdisplay.css" media="screen">
        <script src="javascript/jquery.js"></script>
        <script>
        </script>
    </head>
    <body>
        <?php include $root . "header.php"; ?>
        <div id="mainContent" style="z-index: 1;">
            <div id="leftblock">
                <div id="searchblock">
                    <div id="searchengine">
                        <ul class="catagorieList">
                            <h3>Categorie</h3>
							<hr>
                            <?php echo $catagorieHTML; ?>
                        </ul>
                    </div>
                    <hr>
                    <div id="searchengine">
                        <ul class="catagorieList">
                            <h3 style="margin-bottom: 3px;">Zoek naar product</h3>
							<hr>
                            <form>
                                <input id="zoekveld" name="product" type="text" placeholder="Productnaam" value="<?php echo $_GET["product"]; ?>" autocomplete="off">
                            </form>
                            <div id="results">

                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <section id="productlijst">
                <article>
                    <h1><?php echo $titel; ?></h1>
                    <?php echo $producthtml; ?>
                </article>
                <?php echo $vorige . " " . $volgende; ?>
            </section>
            <script type="text/javascript">
                var paginanummer = <?php echo $pagina; ?>;
<?php
$catagorieString = "";
if (!empty($_GET["catagorie"]))
{
    $catagorieString = "&catagorie={$_GET["catagorie"]}";
}
else if (!empty($_GET["product"]))
{
    $catagorieString = "&product={$_GET["product"]}";
}
?>

                $(".volgende").click(function() {
                    paginanummer++;
                    top.location.href = "/webwinkel.php?pagina=" + paginanummer + "<?php echo $catagorieString; ?>";
                });

                $(".vorige").click(function() {
                    paginanummer--;
                    top.location.href = "/webwinkel.php?pagina=" + paginanummer + "<?php echo $catagorieString; ?>";
                });
            </script>
            <div style="width: 190px; float: right;">
                <div id="rightimage">

                </div>
                <?php include $root . "cartdisplay.php"; ?>
            </div>
            <div style="clear: both;">
            </div>
        </div>
        <script>
            $("#zoekveld").on("keyup", function() {
                zoekstring = $(this).val();
                $.ajax({
                    method: 'get',
                    url: 'zoekproduct.php',
                    data: {
                        'zoekstring': zoekstring
                    },
                    success: function(data) {
                        $("#results").html(data);
                    }
                });
            });
        </script>
        <?php include $root . "footer.php"; ?>
    </body>
</html>