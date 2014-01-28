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
function fillOptions($block,$backup){
	$result = mysql_query("SELECT * FROM wp_badges WHERE block = '".mysql_real_escape_string($block)."' ORDER BY badge");
	$stringAdder="";
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
		$stringAdder=$stringAdder."<option id='".$backup.$block.$row["badge"]."' value='".$idEast.",".$idWest."'>".$row["badge"].$camp."</option>";
		//add the badge with that name to our list-o-badges
		$listOBadges[] = $row['badge'];
	}
	return $stringAdder;
}
$scoutSignupEcho=str_replace("##blockA##",fillOptions("A",''),$scoutSignupEcho);
$scoutSignupEcho=str_replace("##blockB##",fillOptions("B",''),$scoutSignupEcho);
$scoutSignupEcho=str_replace("##blockC##",fillOptions("C",''),$scoutSignupEcho);
$scoutSignupEcho=str_replace("##blockD##",fillOptions("D",''),$scoutSignupEcho);
$scoutSignupEcho=str_replace("##blockAb##",fillOptions("A",'b'),$scoutSignupEcho);
$scoutSignupEcho=str_replace("##blockBb##",fillOptions("B",'b'),$scoutSignupEcho);
$scoutSignupEcho=str_replace("##blockCb##",fillOptions("C",'b'),$scoutSignupEcho);
$scoutSignupEcho=str_replace("##blockDb##",fillOptions("D",'b'),$scoutSignupEcho);
//generate list of weeks for javascript funtion fillBadges();
$year = mysql_real_escape_string($_SESSION['year']);
$result129 = mysql_query("SELECT * FROM wp_roster WHERE (year = '".$year."' AND camperID = '".$active."') ORDER BY week");
$badgeA=array();
$badgeB=array();
$badgeC=array();
$badgeD=array();
$badgeAb=array();
$badgeBb=array();
$badgeCb=array();
$badgeDb=array();
function getReg($block, $week, $active, $backup)
{
	$year = mysql_real_escape_string($_SESSION['year']);
	$result = mysql_query("SELECT * FROM wp_signups WHERE (year = '".$year."' AND week = '".$week."' AND block = '".$block."' AND scoutID = '".$active."' AND backup = '".$backup."')");
	$row = mysql_fetch_array($result);
	if (is_array($row))
	{
		$result1=mysql_query("SELECT * FROM wp_badges WHERE id = '".mysql_real_escape_string($row["badge"])."'");
		$row1=mysql_fetch_array($result1);
		return "".$week." :'".$row1['badge']."'";
	}
}
while ($row129 = mysql_fetch_array($result129))
{
	$week = mysql_real_escape_string($row129['week']);
	$badgeA[]=getReg('A', $week, $active, '0');
	$badgeB[]=getReg('B', $week, $active, '0');
	$badgeC[]=getReg('C', $week, $active, '0');
	$badgeD[]=getReg('D', $week, $active, '0');
	$badgeAb[]=getReg('A', $week, $active, '1');
	$badgeBb[]=getReg('B', $week, $active, '1');
	$badgeCb[]=getReg('C', $week, $active, '1');
	$badgeDb[]=getReg('D', $week, $active, '1');
}
$badgesByWeek="var badgeA={";
for($i=0;$i<count($badgeA);$i++)
{
	$badgesByWeek=$badgesByWeek.$badgeA[$i].",";
}
$badgesByWeek=rtrim($badgesByWeek, ",");
$badgesByWeek=$badgesByWeek."};var badgeB={";
for($i=0;$i<count($badgeB);$i++)
{
	$badgesByWeek=$badgesByWeek.$badgeB[$i].",";
}
$badgesByWeek=rtrim($badgesByWeek, ",");
$badgesByWeek=$badgesByWeek."};var badgeC={";
for($i=0;$i<count($badgeC);$i++)
{
	$badgesByWeek=$badgesByWeek.$badgeC[$i].",";
}
$badgesByWeek=rtrim($badgesByWeek, ",");
$badgesByWeek=$badgesByWeek."};var badgeD={";
for($i=0;$i<count($badgeD);$i++)
{
	$badgesByWeek=$badgesByWeek.$badgeD[$i].",";
}
$badgesByWeek=rtrim($badgesByWeek, ",");
$badgesByWeek=$badgesByWeek."};var badgeAb={";
for($i=0;$i<count($badgeD);$i++)
{
	$badgesByWeek=$badgesByWeek.$badgeAb[$i].",";
}
$badgesByWeek=rtrim($badgesByWeek, ",");
$badgesByWeek=$badgesByWeek."};var badgeBb={";
for($i=0;$i<count($badgeD);$i++)
{
	$badgesByWeek=$badgesByWeek.$badgeBb[$i].",";
}
$badgesByWeek=rtrim($badgesByWeek, ",");
$badgesByWeek=$badgesByWeek."};var badgeCb={";
for($i=0;$i<count($badgeD);$i++)
{
	$badgesByWeek=$badgesByWeek.$badgeCb[$i].",";
}
$badgesByWeek=rtrim($badgesByWeek, ",");
$badgesByWeek=$badgesByWeek."};var badgeDb={";
for($i=0;$i<count($badgeD);$i++)
{
	$badgesByWeek=$badgesByWeek.$badgeDb[$i].",";
}
$badgesByWeek=rtrim($badgesByWeek, ",");
$badgesByWeek=$badgesByWeek."};";
$scoutSignupEcho=str_replace("##badgesByWeek##",$badgesByWeek,$scoutSignupEcho);
echo "<br/>";
echo $scoutSignupEcho;
?>