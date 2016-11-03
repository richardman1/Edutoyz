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
            <section id="leftimage">
            </section>
            <section>
                <article>
                    <div id="ART1">
                        <!-- HIER CONTENT INVOEREN -->
                        <h1>Algemene Voorwaarden</h1>
                        <hr>
                        <h3>Betaling</h3>
                        <p>
                            De op de website vermelde prijzen zijn in euro`s en inclusief BTW.<br>
                            Betaling kan plaatsvinden door middel van overschrijving.</p><br>

                        <h3>Bestelling en levering</h3>
                        <p>
                            Na ontvangst van de bestelling ontvangt u een bevestiging van de bestelling.<br> 
                            Zodra het verschuldigde bedrag op de rekening van EduToyz is bijgeschreven, <br>
                            zullen de bestelde artikelen verzonden worden.</p><br>

                        <h3>Retourneren</h3>
                        <p>
                            Mocht een bestelling niet aan uw verwachtingen voldoen of beschadigd zijn <br>
                            dan kunt u deze op eigen kosten retourneren. Neem hiervoor eerst contact met ons op.<br>
                            U dient artikelen binnen 14 na levering aan te melden voor retour. <br>
                            EduToyz zal het retourbedrag binnen 14 dagen na ontvangst van de retourzending terugbetalen.</p><br>

                        <h3>Garantie</h3>
                        <p> 
                            EduToyz levert producten van hoge kwaliteit. Alle geleverde producten voldoen aan de normale eisen<br> 
                            van deugdelijkheid en bruikbaarheid.<br>
                            Voor de geleverde producten geldt een garantie, zoals deze door de producenten op haar producten wordt vastgesteld.<br> 
                            De afgegeven garantie doet niets af aan de wettelijke rechten die u heeft.<br>
                            <br>
                            Uitzonderingen op garantie van de producent kunnen worden gemaakt indien de slijtage als normaal kan worden beschouwd.
                            Ook kan uw product van garantie worden uitgesloten indien de factuur niet kan worden overlegd, gewijzigd is
                            of onleesbaar is gemaakt, het product gebreken vertoont die gevolg zijn van niet met de bestemming corresponderend
                            of onoordeelkundig gebruik of indien beschadiging is ontstaan door opzet, grove onachtzaamheid of nalatigheid.</p><br>

                        <h3>Aansprakelijkheid</h3>
                        <p>
                            Iedere aansprakelijkheid van EduToyz, haar medewerkers en producten voor alle schade, van welke aard ook, direct of indirect<br>
                            waaronder bedrijfsschade, gevolgschade, schade aan roerende of onroerende zaken dan wel aan personen, wordt uitdrukkelijk uitgesloten.<br>
                            EduToyz is evenmin aansprakelijk voor de schade die bij uitvoering van de overeenkomst door derden wordt veroorzaakt. <br>
                            EduToyz aanvaardt geen aansprakelijkheid voor eventuele schade voortvloeiend uit het gebruik van de producten. <br>
                            <br>
                            Iedere aansprakelijkheid van, EduToyz ten opzichte van de koper is in ieder geval beperkt tot ten hoogste het factuurbedrag dat de koper
                            uit hoofde van de betreffende overeenkomst aan EduToyz verschuldigd is. 
                            <br>
                            Voor misverstanden, verminkingen, vertragingen of niet behoorlijk overkomen van bestellingen en mededelingen ten gevolge van het gebruik
                            van internet of enig ander communicatiemiddel in het verkeer tussen u en EduToyz dan wel tussen EduToyz en derden, voor zover betrekking hebbend
                            op de relatie tussen u en EduToyz is van EduToyz niet aansprakelijk. 
                        </p><br>
                        <h3>Overmacht</h3>
                        <p>
                            EduToyz heeft in geval van overmacht het recht om, naar eigen keuze, de uitvoering van uw bestelling op te schorten,dan wel de overeenkomst zonder rechterlijke tussenkomst te ontbinden. Dit door u dit schriftelijk mee te delen en zonder dat EduToyz gehouden is tot enige schadevergoeding. 

                            Onder overmacht wordt verstaan iedere tekortkoming welke niet aan EduToyz kan worden toegerekend omdat zij niet te wijten is aan haar schuld en noch krachtens de wet, rechtshandeling of in het verkeer geldende opvattingen voor haar rekening komt. 
                            <br>
                            <br>
                        <h3>Voorbehoud</h3>
                        <p>
                            Afbeeldingen kunnen afwijken van de werkelijkheid. Eventuele prijswijzigingen, type-, druk- en zetfouten voorbehouden.</p>


                    </div>
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