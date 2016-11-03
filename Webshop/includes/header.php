<!-- eerste stuk: container houdt in de container, navigatie, winkelwagen en het logo -->
<div id="container" style="z-index: 999;">
    <header>
        <div id="logo">
            <!-- afbeelding include door CSS -->
        </div>

        <!-- De navigatie -->
        <nav>
            <ul id="mainnav">
                <li><a href="/index.php">Home</a></li>

                <li><a href="/webwinkel.php">Webwinkel</a></li>

                <li><a href="/aanbiedingen.php">Aanbiedingen</a>
                    <ul class="subnav">
                        <li><a href="/kortingen.php">Kortingen</a></li>
                        <li><a href="/feestdagen.php">Feestdagen</a></li>
                    </ul>
                </li>

                <li><a href="/overons.php">Over ons</a></li>

                <li><a href="/klantenservice.php">Klantenservice</a>
			<ul class="subnav">
				<li><a href="/retour.php">Retourneren</a></li>
			</ul>
			</li>
                <?php
                if (!empty($_SESSION['naam']))
                {
                    echo "<li><a href='/logout.php'>Log uit</a></li>";
                }
                else
                {
                    echo "<li><a href='/login.php'>Log in</a></li>";
                }
                ?>



            </ul>
        </nav>

        <!-- Eind navigatie -->
        <div id="winkelwagen">
            <!-- Hier komt het logo van de winkelwagen -->
            <a href="/cart.php"><img src="images_context/winkelwagentje3.jpg" alt="winkelwagentje" width="140" height="90"/></a>
        </div>
    </header>
</div>

