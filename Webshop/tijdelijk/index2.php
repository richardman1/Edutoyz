<?php
$root = $_SERVER["DOCUMENT_ROOT"] . "/includes/";
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>EduToyz</title>
        <!-- CSS bestanden oproepen -->
        <link rel="stylesheet" type="text/css" href="css/Generalsheet.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/Navigationsheet.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/Home.css" media="screen">
        <script src="javascript/jquery.js"></script>
        <script>
            $("document").ready(function() {
                $("a").click(function() {
                    var paginanaam = "";
                    if ($(this).attr("id"))
                    {
                        paginanaam = $(this).attr("id");
                    }
                    else
                    {
                        paginanaam = $(this).text();
                    }

                    $("body").append('<form id="linkform" action="" method="post"><input type="hidden" name="paginanaam" value="' + paginanaam + '"></form>');
                    $("#linkform").submit();
                });
            });
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
                        <h1>Welkom op EduToyz</h1>
                        <hr>
                        <img src="images context/Artikel1.jpg" alt="Welkom!" />
                        <p>
                            Deze webwinkel biedt u alles als het gaat om educatief speelgoed voor uw kinderen. 
                        </p>
                        <ul>
                            <li>Wij staan voor het stimuleren van de ontwikkeling van het kind!		</li> 
                            <li>Wij verkopen speelgoed t/m 12 jaar.									</li>
                            <li>Wij leveren de beste kwaliteit en hebben de voordeligste prijzen!	</li>
                        </ul>
                        Neem snel een kijkje in de webwinkel en zoek naar het beste product dat bij uw kind past.
                        <br/>
                        Maak daarbij gebruik van onze snelle zoekopties.
                        <br/><br/>
                        <h2>Deze website is gemaakt door studenten van AVANS HOGESCHOOL en wij willen u duidelijk verwijzen dat er geen echte inkopen gedaan kunnen worden in deze webwinkel.</h2>
                    </div>
                </article>
            </section>
            <div id="rightimage">

            </div>
            <div style="clear: both;">
                <br>
            </div>
        </div>
        <?php include $root . "footer.php"; ?>
    </body>
</html>
