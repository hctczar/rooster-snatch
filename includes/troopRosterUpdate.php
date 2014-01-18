<?php
$active=$_SESSION['active'];
$camper=$_POST['camper'];
if ($_POST["firstName"] != "" and isset($_POST["firstName"]))
{
	$firstName = $_POST["firstName"];
	$firstName = strtolower($firstName);
	$firstName = ucfirst($firstName);
	mysql_query("UPDATE wp_roster SET firstName='".mysql_real_escape_string($firstName)."' WHERE (camperID='".mysql_real_escape_string($camper)."')");
	mysql_query("UPDATE wp_campers SET firstName='".mysql_real_escape_string($firstName)."' WHERE (id='".mysql_real_escape_string($camper)."')");
}
if ($_POST["lastName"] != "" and isset($_POST["lastName"]))
{
	$lastName = $_POST["lastName"];
	$lastName = strtolower($lastName);
	$lastName = ucfirst($lastName);
	mysql_query("UPDATE wp_roster SET lastName='".mysql_real_escape_string($lastName)."' WHERE (camperID='".mysql_real_escape_string($camper)."')");
	mysql_query("UPDATE wp_campers SET lastName='".mysql_real_escape_string($lastName)."' WHERE (id='".mysql_real_escape_string($camper)."')");
}
if ($_POST["youth"] != "" and isset($_POST["youth"]))
{
	$youth = $_POST["youth"];
	mysql_query("UPDATE wp_roster SET youth='".mysql_real_escape_string($youth)."' WHERE (camperID='".mysql_real_escape_string($camper)."')");
	mysql_query("UPDATE wp_campers SET youth='".mysql_real_escape_string($youth)."' WHERE (id='".mysql_real_escape_string($camper)."')");
}
$week1 = 0;
$week2 = 0;
$week1 = $_POST["week1"];
$week2 = $_POST["week2"];
mysql_query("DELETE FROM wp_roster WHERE camperID='".$camper."' and year = '".mysql_real_escape_string($_SESSION["year"])."'");
mysql_query("DELETE FROM wp_roster WHERE camperID='".$camper."' and year = '".mysql_real_escape_string($_SESSION["year"])."'");
if ($week1 > 0)
{
	mysql_query("INSERT INTO wp_roster (troopID, camperID, firstName, lastName, youth,year, week, sun, mon, tue, wed, thu, fri, sat) VALUES ('".mysql_real_escape_string($_SESSION["active"])."', '".mysql_real_escape_string($camper)."', '".mysql_real_escape_string($firstName)."', '".mysql_real_escape_string($lastName)."', '".mysql_real_escape_string($youth)."', '".mysql_real_escape_string($_SESSION["year"])."', '".mysql_real_escape_string($week1)."', '1', '1', '1', '1', '1', '1', '1')");
}
if ($week2 > 0)
{
	mysql_query("INSERT INTO wp_roster (troopID, camperID, firstName, lastName, youth,year, week, sun, mon, tue, wed, thu, fri, sat) VALUES ('".mysql_real_escape_string($_SESSION["active"])."', '".mysql_real_escape_string($camper)."', '".mysql_real_escape_string($firstName)."', '".mysql_real_escape_string($lastName)."', '".mysql_real_escape_string($youth)."', '".mysql_real_escape_string($_SESSION["year"])."', '".mysql_real_escape_string($week2)."', '1', '1', '1', '1', '1', '1', '1')");
}
$_POST["page"] = "troopRoster";
include("includes/troopRoster.php");
?>