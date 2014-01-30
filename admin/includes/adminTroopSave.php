<?php
$troopID=mysql_real_escape_string($_POST['troop']);
$year=mysql_real_escape_string($_SESSION['year']);
$number=mysql_real_escape_string((int)$_POST['number']);
$council=mysql_real_escape_string($_POST['council']);
$email=mysql_real_escape_string($_POST['email']);
$site=array();
$site[1]=mysql_real_escape_string($_POST['week1']);
$site[2]=mysql_real_escape_string($_POST['week2']);
$site[3]=mysql_real_escape_string($_POST['week3']);
$site[4]=mysql_real_escape_string($_POST['week4']);
$site[5]=mysql_real_escape_string($_POST['week5']);
$site[6]=mysql_real_escape_string($_POST['week6']);
$subsite=array();
$subsite[1]=mysql_real_escape_string($_POST['subSite1']);
$subsite[2]=mysql_real_escape_string($_POST['subSite2']);
$subsite[3]=mysql_real_escape_string($_POST['subSite3']);
$subsite[4]=mysql_real_escape_string($_POST['subSite4']);
$subsite[5]=mysql_real_escape_string($_POST['subSite5']);
$subsite[6]=mysql_real_escape_string($_POST['subSite6']);

function getCamp($site)
{
	if ($site == 'Blackfoot'){return 'east';}
	if ($site == 'Cheyenne'){return 'east';}
	if ($site == 'Chippewa'){return 'east';}
	if ($site == 'Commanche'){return 'east';}
	if ($site == 'Delaware'){return 'east';}
	if ($site == 'Iroquois'){return 'east';}
	if ($site == 'Menominee'){return 'east';}
	if ($site == 'Mohawk'){return 'east';}
	if ($site == 'Shawnee'){return 'east';}
	if ($site == 'Sioux'){return 'east';}
	if ($site == 'Boone'){return 'west';}
	if ($site == 'Bowie'){return 'west';}
	if ($site == 'Bridger'){return 'west';}
	if ($site == 'Carson'){return 'west';}
	if ($site == 'Clark'){return 'west';}
	if ($site == 'Cody'){return 'west';}
	if ($site == 'Crocket'){return 'west';}
	if ($site == 'Lewis'){return 'west';}
	if ($site == 'Powell'){return 'west';}
	if ($site == 'Fremont'){return 'west';}
	if ($site == 'Whitney'){return 'west';}
}
mysql_query("UPDATE wp_troops SET number = '".$number."', council = '".$council."', email = '".$email."' WHERE id = '".$troopID."'");
function updateTroop($week)
{
	global $troopID, $year, $number, $council, $email, $site, $subsite;
	if (in_array($week,$_POST['weeks']))
	{
		$result = mysql_query("SELECT * FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '".$week."'");
		$row = mysql_fetch_array($result);
		if (is_array($row))
		{
			mysql_query("UPDATE wp_troopsMeta SET campsite = '".$site[$week]."', subsite = '".$subsite[$week]."', camp = '".getCamp($site[$week])."' WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '".$week."'");
		}
		else
		{
			mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, subsite, camp, tents) VALUES ('".$troopID."', '".$year."', '".$week."', '".$site[$week]."', '".$subsite[$week]."', '".getCamp($site[$week])."', '0')");
		}
	}
	else
	{
		mysql_query("DELETE FROM wp_troopsMeta WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '".$week."'");
	}
}
updateTroop(1);
updateTroop(2);
updateTroop(3);
updateTroop(4);
updateTroop(5);
updateTroop(6);
include("includes/adminTroops.php");
?>