<?php
session_start();

$root   = $_SERVER["DOCUMENT_ROOT"] . "/includes/";
//Database connectie bestand importeren.
include $root . "db_connection.php";

$sql    = "SELECT * FROM `Order` WHERE Klantnummer = {$_SESSION["klantnummer"]}";
echo $sql;
$result = mysqli_query($link, $sql);
$datum  = "";
while ($row    = mysqli_fetch_array($result))
{
    if ($datum != $row["Datum"])
    {
        $datum = $row["Datum"];
        echo "<h1>$datum</h1>"
        . "<h3>Gemaakte order(s):</h3>";
    }
    echo "<span>Order {$row["Ordernummer"]}: <a href='factuur.php?Ordernummer={$row["Ordernummer"]}'>bekijken</a><br>";
}