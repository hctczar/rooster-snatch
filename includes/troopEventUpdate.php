<?php
/*echo "<script>function myFunction(){confirm('Page is: ".$_POST['page']."');}"
	."myFunction();"
	."</script>";*/
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
	if ($_POST['registered'] <= $available)
	{
		mysql_query("UPDATE wp_eventsSigned SET registered = '".mysql_real_escape_string($_POST['registered'])."' WHERE id = '".mysql_real_escape_string($eventID)."'");
		mysql_query("UPDATE wp_eventsMeta SET taken = (taken-'".mysql_real_escape_string($registeredInitial)."'+'".mysql_real_escape_string($_POST['registered'])."') WHERE id = '".mysql_real_escape_string($eventMetaID)."'");
	}
	$_POST['page'] = "troopEvents";
	include("includes/troopEvents.php");
}
//If $_POST was passed an event that the troop didn't own, we can only assume javascript hacking...
else
{
	//echo "<h1>You're a horrible person and I hope you die alone!</h1>";
}
?>