<?php
// logout.php
session_start();

if (empty($_SESSION['klantnummer']))
	echo "<p>U bent uitgelogd.</p>";
else 
	session_unset($_SESSION['klantnummer']);

if (empty($_SESSION['naam']))
	echo "<p>U bent nu uitgelogd.</p>";
else 
	session_unset($_SESSION['naam']);

// Direct door naar de homepagina.
header("Location: index.php"); 

?> 
