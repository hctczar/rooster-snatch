<?php
$active = mysql_real_escape_string(substr($_SESSION["active"],1));
echo $scoutMenu;
$result = mysql_query("SELECT * FROM wp_campers WHERE (id = '".$active."')");
$row = mysql_fetch_array($result);
$email = $row['email'];
$bday = stripslashes($row['dob']);
$rank = stripslashes($row['rank']);
$passcode = "";

if ($_POST["email"] != "" and isset($_POST["email"]))
{
	$email = mysql_real_escape_string($_POST["email"]);
	mysql_query("UPDATE wp_campers SET email='".$email."' WHERE (id='".$active."')");
}
if ($_POST["bday"] != "" and isset($_POST["bday"]))
{
	$bday = mysql_real_escape_string($_POST["bday"]);
	mysql_query("UPDATE wp_campers SET dob='".$bday."' WHERE (id='".$active."')");
}
if ($_POST["rank"] != "" and isset($_POST["rank"]))
{
	$rank = mysql_real_escape_string($_POST["rank"]);
	mysql_query("UPDATE wp_campers SET rank='".$rank."' WHERE (id='".$active."')");
}

if ($_POST["passcode1"] != "" and isset($_POST["passcode1"]))
{
	if ($_POST["passcode1"] == $_POST["passcode2"])
	{
		$passcode = $_POST["passcode1"];
		$passcode = MD5($passcode.$_SESSION["username"]);
		mysql_query("UPDATE wp_campers SET password='".$passcode."' WHERE (id='".$active."')");
	}
	else
	{
		echo "password could not be reset because the two passwords did not match.";
	}
}
echo getCopy("scout_account_update");
?>