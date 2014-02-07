<?php
//ensure that signup is for an active week
$eventsLive = getDateCopy("events_live");
$eventMeta = $_POST['time'];
$result = mysql_query("SELECT * FROM wp_eventsMeta WHERE id = '".mysql_real_escape_string($eventMeta)."'");
$row = mysql_fetch_array($result);
//if it's a real event, and the week for that event is live
if (($row) && (mktime(0,0,0,date("m"),date("d")+((int)$row['week']-1)*-7,date("Y")) > $eventsLive))
{	
	$campers = (int)$_POST['campers'];
	$result = mysql_query("SELECT * FROM wp_eventsMeta WHERE id = '".mysql_real_escape_string($eventMeta)."'");
	$row = mysql_fetch_array($result);
	//more secure to get this from the DB than to assume it was passed correctly in $_POST['event']
	$event = $row['eventID'];
	if ($campers > 0 && $campers <= ($row['enrollment'] - $row['taken']))
	{
		mysql_query("INSERT INTO wp_eventsSigned (troopID, eventMetaID, eventID, registered) VALUES ('".mysql_real_escape_string($_SESSION['active'])."', '".mysql_real_escape_string($eventMeta)."', '".mysql_real_escape_string($event)."', '".mysql_real_escape_string($campers)."')");
		mysql_query("UPDATE wp_eventsMeta SET taken=(taken+'".mysql_real_escape_string($campers)."') WHERE id = '".mysql_real_escape_string($eventMeta)."'");
	}
}
$_POST['page'] = "troopEvents";
include("includes/troopEvents.php");
?>