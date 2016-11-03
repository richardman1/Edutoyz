<div id="cartcomplete">
    <div class="cart">
        <div class="cart-top">
            <h2 class="cart-top-title">Checkout</h2>
            <div class="cart-top-info">
                <?php
                if (empty($_SESSION['cart']))
                {
                    echo "<br />Winkelwagen is leeg<br/>\n";
                }
                else
                {
                    $cart = explode("|", $_SESSION['cart']);

                    // Tellen inhoud winkelwagen
                    $count = count($cart);
                    if ($count == 1)
                    {
                        echo "1 product ";
                    }
                    else
                    {
                        echo "" . $count . " producten ";
                    }
                }
                ?></div>
        </div>

        <?php
        $root = $_SERVER["DOCUMENT_ROOT"] . "/includes/";
        include $root . "db_connection.php";
        $i    = 0;
        if (!empty($cart))
        {
            foreach ($cart as $products)
            {
                // Splits het product in stukjes: $product[x] --> x == 0 -> product id, x == 1 -> hoeveelheid
                $product = explode(",", $products);

                if (strlen(trim($product[1])) <> 0)
                {
                    // Get product info
                    $sql = "SELECT Korting, Productnummer, Naam, Prijs
				  FROM Product
				  WHERE Productnummer = " . $product[0];  // Weet je nog, uit die sessie

                    $result    = mysqli_query($link, $sql) or die(mysqli_error($link) . "<br>in file " . __FILE__ . " on line " . __LINE__);
                    $pro_cart  = mysqli_fetch_object($result);
                    $i++;
                    $lineprice = $product[1] * $pro_cart->Prijs;
                    if ($pro_cart->Korting > 0)
                    {
                        $korting = $pro_cart->Korting;
                        $prijs   = $pro_cart->Prijs * ((100 - $korting) / 100);
                        $regelprijs = $prijs * $product[1];
                    }
                    else
                    {
                        $prijs = $pro_cart->Prijs;
                        $regelprijs = $prijs * $product[1];
                    }
                    $total = $total + $regelprijs;
                    echo "<ul>";
                    echo "<li class=cart-item>";
                    echo "<span class=cart-item-pic>";
                    echo "<img src=images_webwinkel/" . $pro_cart->Productnummer . ".jpg>";
                    echo "</span>";
                    echo $pro_cart->Naam;
                    echo "<span class=cart-item-price>$product[1]</span>";
                    echo "</li></ul>";
                }
            }
        }
        ?>
        <div class="cart-bottom">
            <a href="cart.php" class="cart-button">Continue</a>
            <h2 id="totaal"><?php
                echo "&#8364;" . number_format($total, 2);
                ?></h2>

        </div>
    </div>
</div>