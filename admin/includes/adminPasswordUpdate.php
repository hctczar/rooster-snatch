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
		echo "password mismatch";
		echo ""
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
	echo "Password cannot be blank";
	echo ""
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