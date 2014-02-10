<?php
$un = $_POST['username'];
$pw = $_POST['passcode'];
if ($pw == '' or !isset($pw))
{
	$pw = 'the_bomb.biz';
}
$pw = MD5($pw.$un);
$result = mysql_query("SELECT * FROM wp_admins WHERE (username = '".mysql_real_escape_string($un)."' and password = '".$pw."')");
$row = mysql_fetch_array($result);	
if(! is_array($row))
{
	$result = mysql_query("SELECT * FROM wp_admins WHERE (username = '".mysql_real_escape_string($un)."' and tempPass = '".$pw."')");
	$row = mysql_fetch_array($result);
	if(! is_array($row))
	{
		$special = '<div class="alert alert-danger"><form method="post">Incorrect username or passcode <button type="submit" class="btn btn-danger" name="page" value="adminResetPassword">Forgot Your Username Or Password?</button></form></div>';
		echo str_replace("##special##",$special,$kennyloggin);
	}
	else
	{
		$_SESSION["active"] = $row['id'];
		$_SESSION["username"] = $_POST['username'];
		echo getCopy('admin_temp_login');
		echo $tempLogin;
	}
}
else
{
	echo $adminMenu;
	$_SESSION["active"] = $row['id'];
	$_SESSION["username"] = $_POST['username'];
}
?>