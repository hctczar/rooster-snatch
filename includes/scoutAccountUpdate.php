<?php
$active = mysql_real_escape_string(substr($_SESSION["active"],1));
echo $scoutMenu;

$passcode = "";
if ($_POST["passcode1"] != "" and isset($_POST["passcode1"]))
{
	if ($_POST["passcode1"] == $_POST["passcode2"])
	{
		$passcode = $_POST["passcode1"];
		$passcode = MD5($passcode.$_SESSION["username"]);
		mysql_query("UPDATE wp_campers SET password='".$passcode."' WHERE (id='".mysql_real_escape_string($active)."')");
	}
	else
	{
		echo "password could not be reset because the two passwords did not match.";
	}
}
echo "<br/><h2>Your account has been updated</h2>";
echo "<p>If you changed your password, make sure you keep it in a cool, dark place. Currently, the only way to reset your password is to send your troop leaders an email. This might result in significant time delays before you get your new password .</p>";
?>