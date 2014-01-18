<?php
$active = $_SESSION["active"];
$result = mysql_query("SELECT * FROM wp_troops WHERE (id = '".mysql_real_escape_string($active)."')");
$row = mysql_fetch_array($result);
$troop = stripslashes($row['number']);
if ($_POST["troop"] != "" and isset($_POST["troop"]))
{
	$troop = $_POST["troop"];
	mysql_query("UPDATE wp_troops SET number='".mysql_real_escape_string($troop)."' WHERE (id='".mysql_real_escape_string($active)."')");
}
$email = stripslashes($row['email']);
if ($_POST["email"] != "" and isset($_POST["email"]))
{
	$email = $_POST["email"];
	mysql_query("UPDATE wp_troops SET email='".mysql_real_escape_string($email)."' WHERE (id='".mysql_real_escape_string($active)."')");
}
$council = stripslashes($row['council']);
if ($_POST["council"] != "" and isset($_POST["council"]))
{
	if ($_POST["council"] != "other")
	{
		$council = $_POST["council"];
	}
	else
	{
		$council = $_POST["councilOther"];
	}
	mysql_query("UPDATE wp_troops SET council='".mysql_real_escape_string($council)."' WHERE (id='".mysql_real_escape_string($active)."')");
}
$passcode = "";
if ($_POST["passcode1"] != "" and isset($_POST["passcode1"]))
{
	if ($_POST["passcode1"] == $_POST["passcode2"])
	{
		$passcode = $_POST["passcode1"];
		$passcode = MD5($passcode.$_SESSION["username"]);
		mysql_query("UPDATE wp_troops SET password='".$passcode."' WHERE (id='".mysql_real_escape_string($active)."')");
	}
	else
	{
		echo "password could not be reset because the two passwords did not match.";
	}
}
echo $troopMenu;
echo "<br/><h2>Your account has been updated</h2>";
echo "<p>Updating your troop number will <em>not</em> change your username. It will only effect how your troop number will appear on camp documents like merit badge progress report</p><p>If you changed your password, make sure you keep it in a cool, dark place. Although we can manually reset your password to a temporary value, there might be a significiant time delay involved.</p>";
?>