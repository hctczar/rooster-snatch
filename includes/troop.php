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
		$special = '<div class="alert alert-danger"><form method="post">Incorrect username or passcode <button type="submit" class="btn btn-danger" name="page" value="troopResetPassword">Forgot Your Username Or Password?</button></form></div>';
		echo str_replace("##special##",$special,str_replace("##which##","troop",str_replace("##troopChecked##","checked",str_replace("##scoutChecked##","",$login))));
	}
	else
	{
		$_SESSION["active"] = $row['id'];
		$_SESSION["username"] = $_POST['username'];
		echo getCopy('troop_temp_login');
		echo str_replace("##type##","troop",$tempLogin);
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