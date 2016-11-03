<?php
include $_SERVER["DOCUMENT_ROOT"]."/includes/db_connection.php";
if(!empty($_GET["zoekstring"]) && is_string($_GET["zoekstring"]))
{
    $string = mysqli_real_escape_string($_GET["zoekstring"]);
    echo $sql = "SELECT Naam FROM Poduct WHERE Naam LIKE '%$string%' ORDER BY Naam ASC LIMIT 0,7;";
    $result = mysqli_query($sql);
    echo mysqli_error($link);
    while($row = mysqli_fetch_array($result))
    {
        $naam = $row["Naam"];
        $reulthtml[] = "<span>$naam</span>";
    }
    $html = join("<br>", $reulthtml);
    echo $html;
}
echo "test";