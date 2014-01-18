<?php
$eventID = 0;
$eventMetaID = 0;
$registered = 0;
$result = mysql_query("SELECT * FROM wp_eventsSigned WHERE id = '".mysql_real_escape_string($_POST['event'])."'");
$row = mysql_fetch_array($result);
if ($row['troopID'] == $_SESSION["active"])
{
	$eventID = $row['id'];
	$eventMetaID = $row['eventMetaID'];
	$registered = $row['registered'];
	mysql_query("DELETE FROM wp_eventsSigned WHERE id = '".mysql_real_escape_string($_POST['event'])."'");
	mysql_query("UPDATE wp_eventsMeta SET taken=(taken-'".mysql_real_escape_string($registered)."') WHERE id = '".mysql_real_escape_string($eventMetaID)."'");
	$_POST['page'] = "troopEvents";
	include("includes/troopEvents.php");
}
//If $_POST was passed an event that the troop didn't own, we can only assume javascript hacking...
else
{
	//echo "<h1>You're a horrible person and I hope you die alone!</h1>";
}
?>