<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);

for ($i = 0 ; $i < count($_POST['date']) ; $i++)
{
	$dateID = mysql_real_escape_string($_POST['dateID'][$i]);
	$date = mysql_real_escape_string($_POST['date'][$i]);
	mysql_query ("UPDATE wp_dates SET date = '".$date."' WHERE id = '".$dateID."'");
}
include("includes/adminDates.php");
?>