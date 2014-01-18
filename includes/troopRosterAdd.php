<?php
$active = $_SESSION["active"];
for ($iter=0;$iter<20;$iter++)
{
	if (isset($_POST["firstName".(string)($iter)]) and $_POST["firstName".(string)($iter)]!="")
	{
		$troopID = $active;
		$firstName = strtolower($_POST["firstName".(string)($iter)]);
		$lastName = strtolower($_POST["lastName".(string)($iter)]);
		$youth = (int)$_POST["youth".(string)($iter)];
		$week1 = (int)$_POST["week1".(string)($iter)];
		$week2 = (int)$_POST["week2".(string)($iter)];
		//generate a username that is first three letters of first and last name. Does not use numbers or special characters. Because ChaO'b looks stupid
		$saniFirst=preg_replace("/[^a-zA-Z]+/", "", $firstName);
		$saniLast=preg_replace("/[^a-zA-Z]+/", "", $lastName);
		$username = substr($saniFirst,0,3).substr($saniLast,0,3);
		//prevent duplicate usernames
		$result = mysql_query("SELECT * FROM wp_campers WHERE (username = '".mysql_real_escape_string($username)."')");
		$row = mysql_fetch_array($result);
		if (stripslashes($row['username'])==$username)
		{
			$nonce=1;
			while (true)
			{
				$possibleUsername = $username.(string)($nonce);
				$result1 = mysql_query("SELECT * FROM wp_campers WHERE (username = '".mysql_real_escape_string($possibleUsername)."')");
				$row1 = mysql_fetch_array($result1);
				if (stripslashes($row1['username'])!=$possibleUsername)
				{
					$username = $possibleUsername;;
					break;
				}
				$nonce++;
			}
		}
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
		$passwordEncrypt = MD5($password.$username);
		$firstName = ucfirst($firstName);
		$lastName = ucfirst($lastName);
		$message=$message.$firstName." ".$lastName."\r\n    username: ".$username."\r\n    passcode: ".$password."\r\n\r\n";
		mysql_query("INSERT INTO wp_campers (troopID, firstName, lastName, youth, username, password) VALUES ('".mysql_real_escape_string($troopID)."', '".mysql_real_escape_string($firstName)."', '".mysql_real_escape_string($lastName)."', '".mysql_real_escape_string($youth)."', '".mysql_real_escape_string($username)."', '".$passwordEncrypt."')");
		$result = mysql_query("SELECT * FROM wp_campers WHERE (username = '".mysql_real_escape_string($username)."')");
		$row = mysql_fetch_array($result);
		$camperID = $row["id"];
		//add no more than two entries to the wp_roster table
		if ($week1 != 0)
		{
			mysql_query("INSERT INTO wp_roster (troopID, camperID, firstName, lastName, youth, year, week, sun, mon, tue, wed, thu, fri, sat) VALUES ('".mysql_real_escape_string($troopID)."', '".mysql_real_escape_string($camperID)."', '".mysql_real_escape_string($firstName)."', '".mysql_real_escape_string($lastName)."', '".mysql_real_escape_string($youth)."', '".mysql_real_escape_string($_SESSION["year"])."', '".mysql_real_escape_string($week1)."', '1', '1', '1', '1', '1', '1', '1')");
		}
		if ($week2 != 0)
		{
			mysql_query("INSERT INTO wp_roster (troopID, camperID, firstName, lastName, youth,year, week, sun, mon, tue, wed, thu, fri, sat) VALUES ('".mysql_real_escape_string($troopID)."', '".mysql_real_escape_string($camperID)."', '".mysql_real_escape_string($firstName)."', '".mysql_real_escape_string($lastName)."', '".mysql_real_escape_string($youth)."', '".mysql_real_escape_string($_SESSION["year"])."', '".mysql_real_escape_string($week2)."', '1', '1', '1', '1', '1', '1', '1')");
		}
		$_POST["page"] = "troopRosterAdded";
	}
}
//send email with passwords and stuff
$result = mysql_query("SELECT * FROM wp_troops WHERE (id = '".mysql_real_escape_string($active)."')");
$row = mysql_fetch_array($result);
mail(stripslashes($row["email"]),"Campers added to MyKaJaWan",$message,"From:MyKaJaWan@makajawan.com");
include("includes/troopRosterAdded.php");
?>