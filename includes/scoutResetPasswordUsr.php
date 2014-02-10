<?php
$troop = mysql_real_escape_string($_POST["troop"]);
$council = mysql_real_escape_string($_POST["council"]);
if ($council == "other")
{$council = mysql_real_escape_string($_POST["councilOther"]);}
$firstName = mysql_real_escape_string($_POST["firstName"]);
$lastName = mysql_real_escape_string($_POST["lastName"]);
$result = mysql_query("SELECT * FROM wp_troops WHERE council = '".$council."' and number = '".$troop."'");
$row = mysql_fetch_array($result);
$troopID = mysql_real_escape_string($row["id"]);
$result = mysql_query("SELECT * FROM wp_campers WHERE troopID = '".$troopID."' and firstName = '".$firstName."' and lastName = '".$lastName."'");
$row = mysql_fetch_array($result);
if(! is_array($row))
{
	$special = '<div class="alert alert-warning">Sorry! No account exists with that information</div>';
}
else
{
	$special = '<div class="alert alert-success">Your username is: '.$row["username"].'</div>';
}
echo str_replace("##special##",$special,str_replace("##which##","scout",str_replace("##troopChecked##","",str_replace("##scoutChecked##","checked",$login))));
?>