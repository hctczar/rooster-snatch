<?php
$un = $_SESSION["username"];
$pw = '';
$id = mysql_real_escape_string(substr($_SESSION["active"],1));
if ($_POST["passcode1"] != "" and isset($_POST["passcode1"]))
{
	if ($_POST["passcode1"] == $_POST["passcode2"])
	{
		$pw = $_POST["passcode1"];
		$pw = MD5($pw.$un);
		mysql_query("UPDATE wp_campers SET password='".$pw."', tempPass = '' WHERE (id='".$id."')");
		echo $scoutMenu;
	}
	else
	{
		echo '<div class="alert alert-danger">Passwords do not match</div>';;
		echo str_replace("##type##","scout",$tempLogin);
	}
}
else
{
	echo '<div class="alert alert-danger">Password cannot be blank</div>';
	echo str_replace("##type##","scout",$tempLogin);
}