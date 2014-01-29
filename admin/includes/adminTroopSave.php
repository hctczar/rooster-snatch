<?php
$troopID=mysql_real_escape_string($_POST['troop']);
$year=mysql_real_escape_string($_SESSION['year']);
$number=mysql_real_escape_string((int)$_POST['number']);
$council=mysql_real_escape_string($_POST['council']);
$email=mysql_real_escape_string($_POST['email']);
$week1=mysql_real_escape_string($_POST['week1']);
$week2=mysql_real_escape_string($_POST['week2']);
$week3=mysql_real_escape_string($_POST['week3']);
$week4=mysql_real_escape_string($_POST['week4']);
$week5=mysql_real_escape_string($_POST['week5']);
$week6=mysql_real_escape_string($_POST['week6']);


function getCamp($site)
{
	if ($site == 'Blackfoot A'){return 'east';}
	if ($site == 'Blackfoot B'){return 'east';}
	if ($site == 'Cheyenne A'){return 'east';}
	if ($site == 'Cheyenne B'){return 'east';}
	if ($site == 'Chippewa A'){return 'east';}
	if ($site == 'Chippewa B'){return 'east';}
	if ($site == 'Commanche A'){return 'east';}
	if ($site == 'Commanche B'){return 'east';}
	if ($site == 'Delaware A'){return 'east';}
	if ($site == 'Delaware B'){return 'east';}
	if ($site == 'Iroquois A'){return 'east';}
	if ($site == 'Iroquois B'){return 'east';}
	if ($site == 'Menominee A'){return 'east';}
	if ($site == 'Menominee B'){return 'east';}
	if ($site == 'Mohawk A'){return 'east';}
	if ($site == 'Mohawk B'){return 'east';}
	if ($site == 'Shawnee A'){return 'east';}
	if ($site == 'Shawnee B'){return 'east';}
	if ($site == 'Sioux A'){return 'east';}
	if ($site == 'Sioux B'){return 'east';}
	if ($site == 'Boone A'){return 'west';}
	if ($site == 'Boone B'){return 'west';}
	if ($site == 'Boone C'){return 'west';}
	if ($site == 'Bowie A'){return 'west';}
	if ($site == 'Bowie B'){return 'west';}
	if ($site == 'Bridger A'){return 'west';}
	if ($site == 'Bridger B'){return 'west';}
	if ($site == 'Carson A'){return 'west';}
	if ($site == 'Carson B'){return 'west';}
	if ($site == 'Clark A'){return 'west';}
	if ($site == 'Clark B'){return 'west';}
	if ($site == 'Cody A'){return 'west';}
	if ($site == 'Cody B'){return 'west';}
	if ($site == 'Cody C'){return 'west';}
	if ($site == 'Crocket'){return 'west';}
	if ($site == 'Lewis A'){return 'west';}
	if ($site == 'Lewis B'){return 'west';}
	if ($site == 'Powell A'){return 'west';}
	if ($site == 'Powell B'){return 'west';}
	if ($site == 'Fremont'){return 'west';}
	if ($site == 'Whitney A'){return 'west';}
	if ($site == 'Whitney B'){return 'west';}
}
mysql_query("UPDATE wp_troops SET number = '".$number."', council = '".$council."', email = '".$email."' WHERE id = '".$troopID."'");
if ($week1 != '--Not Enrolled--')
{
	$result = mysql_query("SELECT * FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '1'");
	$row = mysql_fetch_array($result);
	if (is_array($row))
	{
		mysql_query("UPDATE wp_troopsMeta SET campsite = '".$week1."', camp = '".getCamp($week1)."' WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '1'");
	}
	else
	{
		mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, camp, tents) VALUES ('".$troopID."', '".$year."', '1', '".$week1."', '".getCamp($week1)."', '0')");
	}
}
else
{
	mysql_query("DELETE FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '1'");
}
if ($week2 != '--Not Enrolled--')
{
	$result = mysql_query("SELECT * FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '2'");
	$row = mysql_fetch_array($result);
	if (is_array($row))
	{
		mysql_query("UPDATE wp_troopsMeta SET campsite = '".$week2."', camp = '".getCamp($week2)."' WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '2'");
	}
	else
	{
		mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, camp, tents) VALUES ('".$troopID."', '".$year."', '2', '".$week2."', '".getCamp($week2)."', '0')");
	}
}
else
{
	mysql_query("DELETE FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '2'");
}
if ($week3 != '--Not Enrolled--')
{
	$result = mysql_query("SELECT * FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '3'");
	$row = mysql_fetch_array($result);
	if (is_array($row))
	{
		mysql_query("UPDATE wp_troopsMeta SET campsite = '".$week3."', camp = '".getCamp($week3)."' WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '3'");
	}
	else
	{
		mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, camp, tents) VALUES ('".$troopID."', '".$year."', '3', '".$week3."', '".getCamp($week3)."', '0')");
	}
}
else
{
	mysql_query("DELETE FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '3'");
}
if ($week4 != '--Not Enrolled--')
{
	$result = mysql_query("SELECT * FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '4'");
	$row = mysql_fetch_array($result);
	if (is_array($row))
	{
		mysql_query("UPDATE wp_troopsMeta SET campsite = '".$week4."', camp = '".getCamp($week4)."' WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '4'");
	}
	else
	{
		mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, camp, tents) VALUES ('".$troopID."', '".$year."', '4', '".$week4."', '".getCamp($week4)."', '0')");
	}
}
else
{
	mysql_query("DELETE FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '4'");
}
if ($week5 != '--Not Enrolled--')
{
	$result = mysql_query("SELECT * FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '5'");
	$row = mysql_fetch_array($result);
	if (is_array($row))
	{
		mysql_query("UPDATE wp_troopsMeta SET campsite = '".$week5."', camp = '".getCamp($week5)."' WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '5'");
	}
	else
	{
		mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, camp, tents) VALUES ('".$troopID."', '".$year."', '5', '".$week5."', '".getCamp($week5)."', '0')");
	}
}
else
{
	mysql_query("DELETE FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '5'");
}
if ($week6 != '--Not Enrolled--')
{
	$result = mysql_query("SELECT * FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '6'");
	$row = mysql_fetch_array($result);
	if (is_array($row))
	{
		mysql_query("UPDATE wp_troopsMeta SET campsite = '".$week6."', camp = '".getCamp($week6)."' WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '6'");
	}
	else
	{
		mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, camp, tents) VALUES ('".$troopID."', '".$year."', '6', '".$week6."', '".getCamp($week6)."', '0')");
	}
}
else
{
	mysql_query("DELETE FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '6'");
}
include("includes/adminTroops.php");
?>