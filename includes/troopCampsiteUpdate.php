<?php
$active = $_SESSION["active"];
mysql_query("UPDATE wp_troopsMeta SET tents = '".mysql_real_escape_string($_POST["tents"])."' WHERE (year = '".mysql_real_escape_string($_SESSION["year"])."' and troopID = '".mysql_real_escape_string($active)."' and week = '".mysql_real_escape_string($_POST["week"])."')"); 
	$_POST["page"] = "troopRoster";
	include("includes/troopRoster.php");
?>