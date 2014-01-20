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
function fillOptions($block){
	$result = mysql_query("SELECT * FROM wp_badges WHERE block = '".mysql_real_escape_string($block)."' ORDER BY badge");
	$stringAdder="<option value='none,none'>None</option>";
	$listOBadges = array();
	while ($row = mysql_fetch_array($result))
	{
		//if a MB with that name already exists in our list-o-badges, (i.e. if it was already found accross the lake,) skip it
		if (in_array($row["badge"],$listOBadges))
		{
			continue;
		}
		//If (and only if) the badge isn't taught on both sides of the lake, this will display where it actually is taught
		$camp = "";
		//assume that the badge is not taught in a particular camp, so set id to 0
		$idEast = 0;
		$idWest = 0;
		$idRes = 0;
		//if that badge IS taught at that camp, figure out the id for the badge with that name in the correct camp
		$result1 = mysql_query("SELECT * FROM wp_badges WHERE block = '".mysql_real_escape_string($block)."' and badge = '".mysql_real_escape_string($row["badge"])."' and camp = 'east'");
		$row1 = mysql_fetch_array($result1);
		if(is_array($row1)){$idEast = $row1['id'];}
		$result1 = mysql_query("SELECT * FROM wp_badges WHERE block = '".mysql_real_escape_string($block)."' and badge = '".mysql_real_escape_string($row["badge"])."' and camp = 'west'");
		$row1 = mysql_fetch_array($result1);
		if(is_array($row1)){$idWest = $row1['id'];}
		$result1 = mysql_query("SELECT * FROM wp_badges WHERE block = '".mysql_real_escape_string($block)."' and badge = '".mysql_real_escape_string($row["badge"])."' and camp = 'res'");
		$row1 = mysql_fetch_array($result1);
		if(is_array($row1)){$idRes = $row1['id'];}
		//if the badge is only taught in one camp, set its sister camp id = to its own id
		if ($idEast == 0)
		{
			if ($idWest == 0)
			{
				$idEast = $idRes;
				$camp = " (Res)";
			}
			else
			{
				$idEast = $idWest;
				$camp = " (West)";
			}
		}
		if ($idWest == 0)
		{
			if ($idEast == 0 || $idEast == $idRes)
			{
				$idWest = $idRes;
				$camp = " (Res)";
			}
			else
			{
				$idWest = $idEast;
				$camp = " (East)";
			}
		}
		$stringAdder=$stringAdder."<option value='".$idEast.",".$idWest."'>".$row["badge"].$camp."</option>";
		//add the badge with that name to our list-o-badges
		$listOBadges[] = $row['badge'];
	}
	return $stringAdder;
}
$scoutSignupEcho=str_replace("##blockA##",fillOptions("A"),$scoutSignupEcho);
$scoutSignupEcho=str_replace("##blockB##",fillOptions("B"),$scoutSignupEcho);
$scoutSignupEcho=str_replace("##blockC##",fillOptions("C"),$scoutSignupEcho);
$scoutSignupEcho=str_replace("##blockD##",fillOptions("D"),$scoutSignupEcho);

echo $scoutSignupEcho;
?>