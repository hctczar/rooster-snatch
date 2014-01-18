<?php
$un = $_POST["username"];
$pw = $_POST["passcode"];
$pw = MD5($pw.$un);
$result = mysql_query("SELECT * FROM wp_campers WHERE (username = '".mysql_real_escape_string($un)."' and password = '".$pw."')");
$row = mysql_fetch_array($result);
if(! is_array($row))
{
	echo "<div style='color:red'>incorrect username or passcode: ".$pw."</div>";
	echo str_replace("##which##","scout",str_replace("##scoutChecked##","checked",str_replace("##troopChecked##","",$login)));
}
else
{
	
	$_SESSION["active"] = 'c'.(string)$row['id'];
	$_SESSION["username"] = $_POST['username'];
	echo $scoutMenu;
}
?>