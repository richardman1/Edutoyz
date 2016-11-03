<?php
//Sessie starten
session_start();
//Root map speciferen voor includes (header en footer)
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
        <link rel="stylesheet" type="text/css" href="/css/Generalsheet.css" media="screen">
        <link rel="stylesheet" type="text/css" href="/css/Navigationsheet.css" media="screen">
        <link rel="stylesheet" type="text/css" href="/css/Home.css" media="screen">
        <link rel="stylesheet" type="text/css" href="/css/cart.css"
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
                        <?php
                        echo '<h1>Winkelwagen</h1><hr>';

                        if (empty($_SESSION['cart']))
                        {
                            echo "<p>Winkelwagen is leeg</p>";
                        }
                        else
                        {
                            // Exploden
                            $cart = explode("|", $_SESSION['cart']);

                            // Wat javascriptjes voor het weghalen van producten
                            // En daarna het begin van een tabel met de inhoud
                            ?>
                            <script type="text/javascript">
                                function removeItem(item)
                                {
                                    var answer = confirm('Weet je zeker dat je dit product wilt verwijderen?')
                                    if (answer)
                                        window.location = "delete_cart_item.php?item=" + item;
                                }

                                function removeCart()
                                {
                                    var answer = confirm('Weet je zeker dat je de winkelwagen wilt leeghalen?')
                                    if (answer)
                                        window.location = "delete_cart.php";
                                }
                            </script>
                            <form id="form" method="post" name="form" action="update_cart.php">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style='width: 75px;'>&nbsp;</th>
                                            <th style='width: 300px;'>Naam</th>
                                            <th style='width: 60px;'>Prijs p/s</th>
                                            <th style='width: 60px;'>Aantal</th>
                                            <th style='width: 60px;'>Subtotaal</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Totaal (komt later terug)
                                        $total = 0;

                                        // Toon de producten in de winkelwagen
                                        $i = 0;
                                        foreach ($cart as $products)
                                        {
                                            // Splits het product in stukjes: $product[x] --> x == 0 -> product id, x == 1 -> hoeveelheid
                                            $product = explode(",", $products);

                                            if (strlen(trim($product[1])) <> 0)
                                            {
                                                // Get product info
                                                $sql      = "SELECT Productnummer, Naam, Prijs, Korting"
                                                        . " FROM Product"
                                                        . " WHERE Productnummer = " . $product[0];  // Weet je nog, uit die sessie
                                                $result   = mysqli_query($link, $sql) or die(mysqli_error($link) . "<br>in file " . __FILE__ . " on line " . __LINE__);
                                                $pro_cart = mysqli_fetch_object($result);
                                                $i++;

                                                if ($pro_cart->Korting > 0)
                                                {
                                                    $korting = $pro_cart->Korting;
                                                    $prijs   = $pro_cart->Prijs * ((100 - $korting) / 100);
                                                }
                                                else
                                                {
                                                    $prijs = $pro_cart->Prijs;
                                                }

                                                echo '<tr>'
                                                . '<td><img src="/images_webwinkel/' . $pro_cart->Productnummer . '.jpg" style="width: 50px; height: 50px;"></td>'
                                                . '<td>' . $pro_cart->Naam . '</td>'
                                                . '<td class="valuta">' . number_format($prijs, 2, ',', '.') . '</td>'
                                                . '<td><input class="hoeveelheid" type="text" name="hoeveelheid_' . $i . '" value="' . $product[1] . '" size="2" maxlength="2" /></td>'
                                                . '<td class="valuta">€ ' . number_format(($prijs * $product[1]), 2, ',', '.') . '</td>'
                                                . '<td>'
                                                . '<td><a href="javascript:removeItem(' . $i . ')"><img src="/images_context/delete.png" style="width: 20px; height: 20px;"></a></td>'
                                                . '<input type="hidden" name="productnummer_' . $i . '" value="' . $product[0] . '" />' // wat onzichtbare vars voor het updaten
                                                . '</td>'
                                                . '</tr>';

                                                // Total
                                                $total = $total + ($prijs * $product[1]);         // Totaal updaten
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="3">&nbsp;</td>
                                            <td class="totalrow"><strong>Totaal</strong></td>
                                            <td class="totalrow"><strong><?php echo number_format($total, 2, ',', '.'); ?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <ul>
                                <li><a href="javascript:removeCart()">Winkelwagen leegmaken</a><br /></li>
                                <li><a href="/checkout.php">Afrekenen</a><br /></li>
                                <li><a href="/webwinkel.php">Verder winkelen</a></li>
                            </ul>	
                            <?php
                        }
                        ?> 
                    </article>
                </div>
            </section>
            <aside id="rightimage">
            </aside>
            <div style="clear: both;"><br></div>
        </div>
        <script>
            $(".hoeveelheid").change(function() {
                $("#form").submit();
            });
        </script>
        <?php include $root . "footer.php"; ?>
    </body>
</html>