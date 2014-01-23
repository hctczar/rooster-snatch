<?php
echo str_replace("##which##","troop",str_replace("##troopChecked##","checked",str_replace("##scoutChecked##","",$login)));
$troop = mysql_real_escape_string($_POST["troop"]);
$council = mysql_real_escape_string($_POST["council"]);
if ($council == "other")
{$council = mysql_real_escape_string($_POST["councilOther"]);}
$result = mysql_query("SELECT * FROM wp_troops WHERE council = '".$council."' and number = '".$troop."'");
$row = mysql_fetch_array($result);
if(! is_array($row))
{
	echo "Sorry! No account exists with that information";
}
else
{
	echo "Your troop's login is: ".$row["login"];
}
?>