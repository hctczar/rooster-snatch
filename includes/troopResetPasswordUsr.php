<?php
$troop = mysql_real_escape_string($_POST["troop"]);
$council = mysql_real_escape_string($_POST["council"]);
$result = mysql_query("SELECT * FROM wp_troops WHERE council = '".$council."' and number = '".$troop."'");
$row = mysql_fetch_array($result);
if(! is_array($row))
{
	$special = '<div class="alert alert-warning">Sorry! No account exists with that information</div>';
}
else
{
	$special = '<div class="alert alert-success">Your troop\'s login is: '.$row["login"].'</div>';
}
echo str_replace("##special##",$special,str_replace("##which##","troop",str_replace("##troopChecked##","checked",str_replace("##scoutChecked##","",$login))));
?>