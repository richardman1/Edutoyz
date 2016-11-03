<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/includes/db_connection.php";
if (!empty($_GET["zoekstring"]) && is_string($_GET["zoekstring"]))
{
    $string = mysqli_real_escape_string($link, $_GET["zoekstring"]);
    $sql = "SELECT Naam, Productnummer FROM Product WHERE Naam LIKE '%" . $string . "%' ORDER BY Naam ASC LIMIT 0,7;";
    $result = mysqli_query($link, $sql);
    echo mysqli_error($link);
    while ($row = mysqli_fetch_array($result))
    {
        $naam = $row["Naam"];
        $productnummer = $row["Productnummer"];
        $reulthtml[] = '<span class="link" onclick="top.location.href=\'webwinkel.php?pnummer=' . $productnummer . '\'">'.$naam.'</span>';
    }
    $html = join("<br>", $reulthtml);
    echo $html;
}