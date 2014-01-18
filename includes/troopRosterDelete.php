<?php
$camper = $_POST["camper"];
$active = $_SESSION["active"];
$week = $_POST["week"];
mysql_query("DELETE FROM wp_roster WHERE camperID = '".mysql_real_escape_string($camper)."' and year='".mysql_real_escape_string($_SESSION["year"])."' and week='".mysql_real_escape_string($week)."'");
$result = mysql_query("SELECT * FROM wp_roster WHERE camperID = '".mysql_real_escape_string($camper)."'");
$row = mysql_fetch_array($result);
if (! is_array($row))
{
	mysql_query("DELETE FROM wp_campers WHERE id = '".mysql_real_escape_string($camper)."'");
}
$_POST["page"] = "troopRoster";
include("includes/troopRoster.php");
?>