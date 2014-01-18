<?php
$active = $_SESSION["active"];
echo $troopMenu;
$result = mysql_query("SELECT * FROM wp_troopsMeta WHERE (year = '".mysql_real_escape_string($_SESSION["year"])."' and troopID = '".mysql_real_escape_string($active)."') ORDER BY week");
$campsiteEcho = $campsite;
$tents1='';
$tents2='';
if ($row = mysql_fetch_array($result))
{
	$week1=$row['week'];
	$tents1=$row['tents'];
	$campsiteEcho = str_replace("##week1##","<option value='".$week1."'>Week ".$week1." at ".stripslashes($row['campsite'])."</option>",$campsiteEcho);
	$campsiteEcho = str_replace("##week1Num##",$week1,$campsiteEcho);
}
else 
	$campsiteEcho = str_replace("##week1##","",$campsiteEcho);
if ($row = mysql_fetch_array($result))
{
	$week2=$row['week'];
	$tents2=$row['tents'];
	$campsiteEcho = str_replace("##week2##","<option value='".$week2."'>Week ".$week2." at ".stripslashes($row['campsite'])."</option>",$campsiteEcho);
	$campsiteEcho = str_replace("##week2Num##",$week2,$campsiteEcho);
}
else
	$campsiteEcho = str_replace("##week2##","",$campsiteEcho);
$campsiteEcho = str_replace("##week##",stripslashes($row['campsite']),$campsiteEcho);
$campsiteEcho = str_replace("##tents1##",$tents1,$campsiteEcho);
$campsiteEcho = str_replace("##tents2##",$tents2,$campsiteEcho);
preg_replace("/##tents.##/","",$campsiteEcho);
echo $campsiteEcho;
?>