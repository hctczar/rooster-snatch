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
		echo $kennyloggin;
		echo "<div style='color:red'>incorrect username or passcode</div><br/><form method='post'><input type='hidden' name='page' value='adminResetPassword'><input type='submit' value='Forgot Your Username or Password?'></form>";
	}
	else
	{
		$_SESSION["active"] = $row['id'];
		$_SESSION["username"] = $_POST['username'];
		echo "<p>Hi! This is either your first time logging in, or you just reset your password. Please pick a permanent value for your password and hit submit.</p>"
		."<form method = 'post'>"
		."New Passcode: <input type='password' name='passcode1' id='passcode1' autocomplete='off'><br/>"
		."New Passcode: <input type='password' name='passcode2' id='passcode2' onChange='matchPasscode();' onMouseOut='matchPasscode();' autocomplete='off'>"
		."<div id='mismatch' style='color:red'></div>"
		."<input type='hidden' name='page' value='adminPasswordUpdate'>"
		."<div id='submit'><input type='submit' value='Select Password'></div>"
		."</form>"
		."<script>"
		."	function matchPasscode() {"
		."		if (document.getElementById('passcode1').value != document.getElementById('passcode2').value)"
		."		{"
		."			document.getElementById('mismatch').innerHTML = 'Passcodes do not match';"
		."          document.getElementById('submit').innerHTML = 'OOPS';"
		."		}"
		."		else"
		."		{"
		."			document.getElementById('mismatch').innerHTML = '';"
		."          document.getElementById('submit').innerHTML = '<input type=\'submit\' value=\'Select Password\'>';"
		."		}"
		."	}"
		.""
		."</script>";
	}
}
else
{
	echo $adminMenu;
	$_SESSION["active"] = $row['id'];
	$_SESSION["username"] = $_POST['username'];
}
?>