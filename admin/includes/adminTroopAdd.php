<?php
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

$result = mysql_query("SELECT * FROM wp_troops WHERE number = '".$number."' AND council = '".$council."'");
$row = mysql_fetch_array($result);
//if the troop already exists, just copypasta some code in from adminTroopSave.php. Because we just want to update the troop, not make a brand new one with new login and stuff. There is one big difference though: this code will not delete entries from wp_troopsMeta, it will only insert and update them. This, in effect, allows you to merge weeks.
if (is_array($row))
{
	$troopID = mysql_real_escape_string($row['id']);
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
	if ($week1 !=  '--Not Enrolled--'){mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, camp, tents) VALUES ('".$troopID."', '".$year."', '1', '".$week1."', '".getCamp($week1)."', '0')");}
	if ($week2 !=  '--Not Enrolled--'){mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, camp, tents) VALUES ('".$troopID."', '".$year."', '2', '".$week2."', '".getCamp($week2)."', '0')");}
	if ($week3 !=  '--Not Enrolled--'){mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, camp, tents) VALUES ('".$troopID."', '".$year."', '3', '".$week3."', '".getCamp($week3)."', '0')");}
	if ($week4 !=  '--Not Enrolled--'){mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, camp, tents) VALUES ('".$troopID."', '".$year."', '4', '".$week4."', '".getCamp($week4)."', '0')");}
	if ($week5 !=  '--Not Enrolled--'){mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, camp, tents) VALUES ('".$troopID."', '".$year."', '5', '".$week5."', '".getCamp($week5)."', '0')");}
	if ($week6 !=  '--Not Enrolled--'){mysql_query("INSERT INTO wp_troopsMeta (troopID, year, week, campsite, camp, tents) VALUES ('".$troopID."', '".$year."', '6', '".$week6."', '".getCamp($week6)."', '0')");}
	//And now to send a strongly worded email...
	$customString="Username: ".$login."\r\nPassword: ".$password;
	mail($email,getCopy('email_subj_troop_enrolled'),getCopy('email_body_troop_enrolled').$customString,"From:MyKaJaWan@makajawan.com");
}
include("includes/adminTroops.php");
?>