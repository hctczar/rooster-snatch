<?php
$year = mysql_real_escape_string($_SESSION['year']);
$name = mysql_real_escape_string($_POST['name']);
$description = mysql_real_escape_string($_POST['description']);
$enrollment = mysql_real_escape_string($_POST['size']);
mysql_query("INSERT INTO wp_events (name, description, year) VALUES ('".$name."', '".$description."', '".$year."')");
$result = mysql_query("SELECT * FROM wp_events WHERE name = '".$name."' AND description = '".$description."' AND year = '".$year."' ORDER BY id DESC");
$row = mysql_fetch_array($result);
$eventID = $row['id'];
function insertEventsMeta($iter,$week)
{
	global $_POST, $year, $enrollment, $day, $time, $eventID;
	if ($_POST['week'.$week.$iter] == 1)
	{
		mysql_query("INSERT INTO wp_eventsMeta (eventID, year, week, day, time, enrollment, taken) VALUES ('".$eventID."', '".$year."', '".$week."', '".$day."', '".$time."', '".$enrollment."', '0')");
	}
}
for ($i=0 ; $i < count($_POST['day']) ; $i++)
{
	if ($_POST['day'][$i] != '')
	{
		$day = mysql_real_escape_string($_POST['day'][$i]);
		$time = mysql_real_escape_string($_POST['time'][$i]);
		$time = strtotime($time);
		$time = date('Y-m-d H:i:s', $time);
		insertEventsMeta($i,1);
		insertEventsMeta($i,2);
		insertEventsMeta($i,3);
		insertEventsMeta($i,4);
		insertEventsMeta($i,5);
		insertEventsMeta($i,6);
	}
}
include("includes/adminEvents.php");
?>