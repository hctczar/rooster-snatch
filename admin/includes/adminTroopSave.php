<?php
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
function updateTroop($week, $iter)
{
	global $troopID, $year, $number, $council, $email, $site, $subsite;
	if (in_array($week,$_POST['weeks'.$iter]))
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
for ($i = 0 ; isset($_POST['troop'.$i]) ; $i++)
{
	$troopID=mysql_real_escape_string($_POST['troop'.$i]);
	$year=mysql_real_escape_string($_SESSION['year']);
	$number=mysql_real_escape_string((int)$_POST['number'.$i]);
	$council=mysql_real_escape_string($_POST['council'.$i]);
	$email=mysql_real_escape_string($_POST['email'.$i]);
	$site=array();
	$site[1]=mysql_real_escape_string($_POST[$i.'week1']);
	$site[2]=mysql_real_escape_string($_POST[$i.'week2']);
	$site[3]=mysql_real_escape_string($_POST[$i.'week3']);
	$site[4]=mysql_real_escape_string($_POST[$i.'week4']);
	$site[5]=mysql_real_escape_string($_POST[$i.'week5']);
	$site[6]=mysql_real_escape_string($_POST[$i.'week6']);
	$subsite=array();
	$subsite[1]=mysql_real_escape_string($_POST[$i.'subSite1']);
	$subsite[2]=mysql_real_escape_string($_POST[$i.'subSite2']);
	$subsite[3]=mysql_real_escape_string($_POST[$i.'subSite3']);
	$subsite[4]=mysql_real_escape_string($_POST[$i.'subSite4']);
	$subsite[5]=mysql_real_escape_string($_POST[$i.'subSite5']);
	$subsite[6]=mysql_real_escape_string($_POST[$i.'subSite6']);
	mysql_query("UPDATE wp_troops SET number = '".$number."', council = '".$council."', email = '".$email."' WHERE id = '".$troopID."'");
	updateTroop(1,$i);
	updateTroop(2,$i);
	updateTroop(3,$i);
	updateTroop(4,$i);
	updateTroop(5,$i);
	updateTroop(6,$i);
}

include("includes/adminTroops.php");
?>
<script> viewTable(); </script>