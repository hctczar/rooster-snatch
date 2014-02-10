<?php
echo $troopMenu;
$active = $_SESSION["active"];
$camper = $_POST["camper"];
$rosterEditorFinal = $rosterEditor;
$result = mysql_query("SELECT * FROM wp_troopsMeta WHERE (troopID = '".mysql_real_escape_string($active)."' and year = '".mysql_real_escape_string($_SESSION["year"])."') ORDER BY week");
$week1 = 0;
$week2 = 0;
if ($row = mysql_fetch_array($result))
{
	$week1 = $row["week"];
}
if ($row = mysql_fetch_array($result))
{
	$week2 = $row["week"];
}
$result = mysql_query("SELECT * FROM wp_campers WHERE id='".$camper."'");
$row = mysql_fetch_array($result);
//auto fill with original name
$firstName = stripslashes($row["firstName"]);
$lastName = stripslashes($row["lastName"]);
$rosterEditorFinal = str_replace("##firstName##",$firstName,$rosterEditorFinal);
$rosterEditorFinal = str_replace("##lastName##",$lastName,$rosterEditorFinal);
//auto fill youthiness
if ($row["youth"] == 1)
{
	$rosterEditorFinal = str_replace("##selectedY##","selected",$rosterEditorFinal);
	$rosterEditorFinal = str_replace("##selectedA##","",$rosterEditorFinal);
}
else
{
	$rosterEditorFinal = str_replace("##selectedY##","",$rosterEditorFinal);
	$rosterEditorFinal = str_replace("##selectedA##","selected",$rosterEditorFinal);
}
//auto fill weeks coming
$rosterEditorFinal = str_replace("##week1##",$week1,$rosterEditorFinal);
if (! $week2 > 0)
{
	$rosterEditorFinal = str_replace("Week ##week2##<input type='checkbox' name='week2' value='##week2##' ##week2checked##><br/>","",$rosterEditorFinal);
}
$rosterEditorFinal = str_replace("##week2##",$week2,$rosterEditorFinal);
$result = mysql_query("SELECT * FROM wp_roster WHERE camperID='".$camper."' and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week1)."'");
$row = mysql_fetch_array($result);
if ($row["week"] != 0)
{
	$rosterEditorFinal = str_replace("##week1checked##","checked",$rosterEditorFinal);
}
else
{
	$rosterEditorFinal = str_replace("##week1checked##","",$rosterEditorFinal);
}
$result = mysql_query("SELECT * FROM wp_roster WHERE camperID='".$camper."' and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week2)."'");
$row = mysql_fetch_array($result);
if ($row["week"] != 0)
{
	$rosterEditorFinal = str_replace("##week2checked##","checked",$rosterEditorFinal);
}
else
{
	$rosterEditorFinal = str_replace("##week2checked##","",$rosterEditorFinal);
}
$rosterEditorFinal = str_replace("##camper##",$camper,$rosterEditorFinal);

echo $rosterEditorFinal;
?>