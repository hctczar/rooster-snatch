<?php
$un = $_POST['username'];
$pw = $_POST['passcode'];
if ($pw == '' or !isset($pw))
{
	$pw = 'the_bomb.biz';
}
$pw = MD5($pw.$un);
$result = mysql_query("SELECT * FROM wp_troops WHERE (login = '".mysql_real_escape_string($un)."' and password = '".$pw."')");
$row = mysql_fetch_array($result);	
if(! is_array($row))
{
	$result = mysql_query("SELECT * FROM wp_troops WHERE (login = '".mysql_real_escape_string($un)."' and tempPass = '".$pw."')");
	$row = mysql_fetch_array($result);
	if(! is_array($row))
	{
		echo str_replace("##which##","troop",str_replace("##troopChecked##","checked",str_replace("##scoutChecked##","",$login)));
		echo "<div style='color:red'>incorrect username or passcode</div><br/><form method='post'><input type='hidden' name='page' value='troopResetPassword'><input type='submit' value='Forgot Your Username or Password?'></form>";
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
		."<input type='hidden' name='page' value='troopPasswordUpdate'>"
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
	echo $troopMenu;
	$_SESSION["active"] = $row['id'];
	$_SESSION["username"] = $_POST['username'];
	$result1 = mysql_query("SELECT * FROM wp_troopsMeta WHERE (troopID = '".$_SESSION["active"]."') ORDER BY year DESC, week ASC");
	$weekSelect = ""
	."<form method='post'>"
	."<select name='week'>";
	while ($row1 = mysql_fetch_array($result1))
	{
		$weekDrop = " 	<option value='##week1##'>##week##</option>";
		$weekDrop = str_replace("##week1##",$row1["year"]." ".$row1["week"],$weekDrop);
		$weekDrop = str_replace("##week##",$row1["year"].", week ".$row1["week"],$weekDrop);
		$weekSelect = $weekSelect.$weekDrop;
	}
	
	$weekSelect = $weekSelect.""
	."</select>"
	."<input type='hidden' name='page' value='weekSelect'>"
	."<input type='submit' value='Select Week' style='width:16em'>"
	."</form>"
	."";
	//##week##
	//echo $weekSelect;
}
?>