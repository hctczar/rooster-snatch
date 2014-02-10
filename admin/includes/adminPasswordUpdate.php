<?php
$un = $_SESSION["username"];
$pw = '';
$id = mysql_real_escape_string($_SESSION["active"]);
if ($_POST["passcode1"] != "" and isset($_POST["passcode1"]))
{
	if ($_POST["passcode1"] == $_POST["passcode2"])
	{
		$pw = $_POST["passcode1"];
		$pw = MD5($pw.$un);
		mysql_query("UPDATE wp_admins SET password='".$pw."', tempPass = '' WHERE (id='".$id."')");
		echo $adminMenu;
	}
	else
	{
		echo '<div class="alert alert-danger">Passwords do not match</div>';;
		echo $tempLogin;
	}
}
else
{
	echo '<div class="alert alert-danger">Password cannot be blank</div>';
	echo $tempLogin;
}