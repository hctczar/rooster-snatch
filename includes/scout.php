<?php
$un = $_POST["username"];
$pw = $_POST["passcode"];
if ($pw == '' or !isset($pw))
{
	$pw = 'OhLikeTheWiz?MoreErotic.AndWithLessWomen.NoWomen,ToBeExact';
}
$pw = MD5($pw.$un);
$result = mysql_query("SELECT * FROM wp_campers WHERE (username = '".mysql_real_escape_string($un)."' and password = '".$pw."')");
$row = mysql_fetch_array($result);
if(! is_array($row))
{
	$result = mysql_query("SELECT * FROM wp_campers WHERE (username = '".mysql_real_escape_string($un)."' and tempPass = '".$pw."')");
	$row = mysql_fetch_array($result);
	if(! is_array($row))
	{
		$special = '<div class="alert alert-danger"><form method="post">Incorrect username or passcode <button type="submit" class="btn btn-danger" name="page" value="scoutResetPassword">Forgot Your Username Or Password?</button></form></div>';
		echo str_replace("##special##",$special,str_replace("##which##","scout",str_replace("##scoutChecked##","checked",str_replace("##troopChecked##","",$login))));
	}
	else
	{
		$_SESSION["active"] = 'c'.(string)$row['id'];
		$_SESSION["username"] = $_POST['username'];
		echo getCopy('scout_temp_login');
		echo str_replace("##type##","scout",$tempLogin);
	}
}
else
{
	
	$_SESSION["active"] = 'c'.(string)$row['id'];
	$_SESSION["username"] = $_POST['username'];
	echo $scoutMenu;
}
?>