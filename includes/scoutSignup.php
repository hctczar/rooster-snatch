<?php
echo $scoutMenu;
$scoutSignupEcho=$scoutSignup;
$active = substr($_SESSION["active"],1);
$result = mysql_query("SELECT * FROM wp_roster WHERE camperID='".mysql_real_escape_string($active)."' ORDER by week");
if ($row = mysql_fetch_array($result))
{
	$week1=$row["week"];
	$_SESSION["troopID"]=$row["troopID"];
}
if ($row = mysql_fetch_array($result))
{
	$week2=$row["week"];
}
else
{
	$scoutSignupEcho=str_replace("<option value='##week2##'>Week ##week2##</option>","",$scoutSignupEcho);
}
$scoutSignupEcho=str_replace("##week1##",$week1,$scoutSignupEcho);
$scoutSignupEcho=str_replace("##week2##",$week2,$scoutSignupEcho);
$result = mysql_query("SELECT * FROM wp_badges WHERE block = 'A' ORDER BY badge");
$stringAdder="<option value='none'>None</option>";
while ($row = mysql_fetch_array($result))
{
	$stringAdder=$stringAdder."<option value='".$row["badge"]."'>".$row["badge"]."</option>";
}
$scoutSignupEcho=str_replace("##blockA##",$stringAdder,$scoutSignupEcho);
$result = mysql_query("SELECT * FROM wp_badges WHERE block = 'B' ORDER BY badge");
$stringAdder="<option value='none'>None</option>";
while ($row = mysql_fetch_array($result))
{
	$stringAdder=$stringAdder."<option value='".$row["badge"]."'>".$row["badge"]."</option>";
}
$scoutSignupEcho=str_replace("##blockB##",$stringAdder,$scoutSignupEcho);
$result = mysql_query("SELECT * FROM wp_badges WHERE block = 'C' ORDER BY badge");
$stringAdder="<option value='none'>None</option>";
while ($row = mysql_fetch_array($result))
{
	$stringAdder=$stringAdder."<option value='".$row["badge"]."'>".$row["badge"]."</option>";
}
$scoutSignupEcho=str_replace("##blockC##",$stringAdder,$scoutSignupEcho);
$result = mysql_query("SELECT * FROM wp_badges WHERE block = 'D' ORDER BY badge");
$stringAdder="<option value='none'>None</option>";
while ($row = mysql_fetch_array($result))
{
	$stringAdder=$stringAdder."<option value='".$row["badge"]."'>".$row["badge"]."</option>";
}
$scoutSignupEcho=str_replace("##blockD##",$stringAdder,$scoutSignupEcho);
echo $scoutSignupEcho;
?>