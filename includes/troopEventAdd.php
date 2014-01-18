<?php
$event = $_POST['event'];
$eventMeta = $_POST['time'];
$campers = (int)$_POST['campers'];
$result = mysql_query("SELECT * FROM wp_eventsMeta WHERE id = '".mysql_real_escape_string($eventMeta)."'");
$row = mysql_fetch_array($result);
if ($campers > 0 && $campers <= ($row['enrollment'] - $row['taken']))
{
	mysql_query("INSERT INTO wp_eventsSigned (troopID, eventMetaID, eventID, registered) VALUES ('".mysql_real_escape_string($_SESSION['active'])."', '".mysql_real_escape_string($eventMeta)."', '".mysql_real_escape_string($event)."', '".mysql_real_escape_string($campers)."')");
	mysql_query("UPDATE wp_eventsMeta SET taken=(taken+'".mysql_real_escape_string($campers)."') WHERE id = '".mysql_real_escape_string($eventMeta)."'");
}
$_POST['page'] = "troopEvents";
include("includes/troopEvents.php");
?>