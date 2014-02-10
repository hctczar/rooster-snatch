<?php
if (! is_array($_POST['weeks'])){$_POST['weeks']=array();}
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

function updateTroop($week, $troopID)
{
	global $year, $number, $council, $email, $site, $subsite;
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
}
function insertTroop($week)
{
	global $troopID, $year, $site, $subsite;
	if (in_array($week,$_POST['weeks']))
	{
		mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, subsite, camp, tents) VALUES ('".$troopID."', '".$year."', '".$week."', '".$site[$week]."', '".$subsite[$week]."', '".getCamp($site[$week])."', '0')");
	}
}
$result = mysql_query("SELECT * FROM wp_troops WHERE number = '".$number."' AND council = '".$council."'");
$row = mysql_fetch_array($result);
//if the troop already exists, just copypasta some code in from adminTroopSave.php. Because we just want to update the troop, not make a brand new one with new login and stuff. There is one big difference though: this code will not delete entries from wp_troopsMeta, it will only insert and update them. This, in effect, allows you to merge weeks.
if (is_array($row))
{
	mysql_query("UPDATE  wp_troops set email = '".$email."'");
	updateTroop(1, mysql_real_escape_string($row['id']));
	updateTroop(2, mysql_real_escape_string($row['id']));
	updateTroop(3, mysql_real_escape_string($row['id']));
	updateTroop(4, mysql_real_escape_string($row['id']));
	updateTroop(5, mysql_real_escape_string($row['id']));
	updateTroop(6, mysql_real_escape_string($row['id']));
}
//ooookay, so the troop didn't previously exist. That's what we were expecting
else
{
	//let's generate a unique login
	$login = $number;

	if (is_array(mysql_fetch_array(mysql_query("SELECT * FROM wp_troops WHERE login = '".$login."'"))))
	{
		//let's try easy to remember first: troop+council abbreviation. We'll get the abbreviation by exploding the council and picking up what's left.
		$words = explode(" ", $council);
		$acronym = "";
		foreach ($words as $w)
		{
			$acronym = $acronym.$w[0];
		}
		$login = $login.$acronym;
	}
	$loginTest = $login;
	//And if two councils have the same login? Let's just start adding some numbers to it
	$nonce = 1;
	while (is_array(mysql_fetch_array(mysql_query("SELECT * FROM wp_troops WHERE login = '".$loginTest."'"))))
	{
		$loginTest = $login.$nonce;
		$nonce +=1;
	}
	//we broke the loop! So $loginTest must be unique. And hey, by the way, how do you catch a unique rabbit? You nique up on it!
	$login = $loginTest;
	//Generate a random password that is three letters and three numbers long
		$password = "";
		$a_z = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$int = rand(0,25);
		$password = $password.$a_z[$int];
		$int = rand(0,25);
		$password = $password.$a_z[$int];
		$int = rand(0,25);
		$password = $password.$a_z[$int];
		$password = $password.(string)(rand(0,9));
		$password = $password.(string)(rand(0,9));
		$password = $password.(string)(rand(0,9));
		$passwordEncrypt = MD5($password.$login);
	//I think we have everything we need now. Yippee!
	mysql_query("INSERT INTO wp_troops (email, number, council, login, tempPass) VALUES ('".$email."', '".$number."', '".$council."', '".$login."', '".$passwordEncrypt."')");
	//Now let's tackle the meta data
	//first let's get that pesky troop id...
	$row=mysql_fetch_array(mysql_query("SELECT * FROM wp_troops WHERE login = '".$login."'"));
	$troopID=mysql_real_escape_string($row['id']);

	insertTroop(1);
	insertTroop(2);
	insertTroop(3);
	insertTroop(4);
	insertTroop(5);
	insertTroop(6);
	//And now to send a strongly worded email...
	$email;
	$subject = getCopy('email_subj_troop_enrolled');
	$customString="<li>Username: <strong>".$login."</strong></li><li>Password: <strong>".$password."</strong></li>";
	$message = getCopy('email_body_troop_enrolled').$customString;
	$headers = "From:MyKaJaWan@makajawan.com \r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1 \r\n";
	mail($email,$subject,$message,$headers);
}
include("includes/adminTroops.php");
?>