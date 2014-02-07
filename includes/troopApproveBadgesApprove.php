<?php
$year = mysql_real_escape_string($_SESSION['year']);
$active = mysql_real_escape_string($_SESSION['active']);
$camperID = mysql_real_escape_string($_POST['camper']);
$week = mysql_real_escape_string($_POST['week']);
//Ensure that user is authorized to approve this signup
$result = mysql_query("SELECT * FROM wp_roster WHERE troopID = '".$active."' AND camperID = '".$camperID."'");
$row = mysql_fetch_array($result);
if (is_array($row))
{
	mysql_query("UPDATE wp_signups SET approved = '1' WHERE week = '".$week."' and scoutID = '".$camperID."'");
}
else //stupid hackers, trying to send false camperIDs to edit
{
	echo "Access error: please ensure that cookies are enabled for your machine";
}
include("includes/troopApproveBadges.php");
