<?php
echo $troopMenu;
$eventID = 0;
$eventMetaID = 0;
$registeredInitial = 0;
$result = mysql_query("SELECT * FROM wp_eventsSigned WHERE id = '".mysql_real_escape_string($_POST['event'])."'");
$row = mysql_fetch_array($result);
if ($row['troopID'] == $_SESSION["active"])
{
	$eventID = $row['id'];
	$eventMetaID = $row['eventMetaID'];
	$registeredInitial = $row['registered'];
	$result1 = mysql_query("SELECT * FROM wp_eventsMeta WHERE id = '".mysql_real_escape_string($row['eventMetaID'])."'");
	$row1 = mysql_fetch_array($result1);
	$available = (int)$row1['enrollment'] - (int)$row1['taken'] + (int)$registeredInitial;
	echo "<h3>Use form to change the number of scouts/adults attending</h3>";
	echo "<form method = 'post'>"
	."<input type='number' value = '". $registeredInitial ."' name = 'registered' min='1' max = '". $available ."' height = '100px'>"
	."<input type='hidden' name='page' value='troopEventUpdate'><br/>"
	."<input type='hidden' name='event' value='". $eventID ."'><br/>"
	."<input type='submit' value='Sumbit Changes'>"
	."</form>";
}
//If $_POST was passed an event that the troop didn't own, we can only assume javascript hacking...
else
{
	//echo "<h1>You're a horrible person and I hope you die alone!</h1>";
}
?>