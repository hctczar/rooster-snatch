<?php
$active = mysql_real_escape_string(substr($_SESSION["active"],1));
$troopID=$_SESSION["troopID"];
$email='';
$week = $_POST["week"];
$year = $_SESSION["year"];
$result=mysql_query("SELECT * FROM wp_campers where id = '".$active."'");
$row = mysql_fetch_array($result);
$rank = $row['rank'];
$dob = $row['dob'];
$result=mysql_query("SELECT * FROM wp_troopsMeta WHERE troopID = '".mysql_real_escape_string($troopID)."' and year = '".mysql_real_escape_string($year)."' and week = '".mysql_real_escape_string($week)."'");
$row = mysql_fetch_array($result);
$camp = $row["camp"];
$campSelect = 0; //assumes East camper if there is a fatal error.
if ($camp == "east"){$campSelect = 0;}
if ($camp == "west"){$campSelect = 1;}
$scoutID = substr($_SESSION["active"],1);
//Selects the appropriate MB id based on what side of the lake the scout is on (east = 0, west = 1)
$badgeAa = explode(",", $_POST["blockA"]);
$badgeA = $badgeAa[$campSelect];
$badgeBa = explode(",", $_POST["blockB"]);
$badgeB = $badgeBa[$campSelect];
$badgeCa = explode(",", $_POST["blockC"]);
$badgeC = $badgeCa[$campSelect];
$badgeDa = explode(",", $_POST["blockD"]);
$badgeD = $badgeDa[$campSelect];
//Ensure there are no conflicts
$conflicts = '';
$result = mysql_query("SELECT * FROM wp_badges WHERE id = '".$badgeA."'");
$row = mysql_fetch_array($result);
$conflicts .= $row['conflicts'];
$result = mysql_query("SELECT * FROM wp_badges WHERE id = '".$badgeB."'");
$row = mysql_fetch_array($result);
$conflicts .= $row['conflicts'];
$result = mysql_query("SELECT * FROM wp_badges WHERE id = '".$badgeC."'");
$row = mysql_fetch_array($result);
$conflicts .= $row['conflicts'];
$result = mysql_query("SELECT * FROM wp_badges WHERE id = '".$badgeD."'");
$row = mysql_fetch_array($result);
$conflicts .= $row['conflicts'];
//If there were conflicts, make sure that conflicting slots are forced to be 'none'
//why is the if test so sketchy? because php sucks balls. strpos returns false if it doesn't find the substring. But it returns 0 (which == false) if it finds the substring at position 0. Why doesn't it just return -1 instead of false? We'll never know.
if (strpos($conflicts,'A')===false){} else {$badgeA='none';}
if (strpos($conflicts,'B')===false){} else {$badgeB='none';}
if (strpos($conflicts,'C')===false){} else {$badgeC='none';}
if (strpos($conflicts,'D')===false){} else {$badgeD='none';}
//Check to see if signup should be pre-approved
$result = mysql_query("SELECT * FROM wp_troops WHERE id = '".mysql_real_escape_string($_SESSION['troopID'])."'");
$row = mysql_fetch_array($result);
$approved = 1;
if ($row['approveBadges'] == 1){$approved = 0;}
if ($row['emailBadges'] == 1){$email = stripslashes($row['email']);}
//Delete any previous entries for that week and year by the same scout
mysql_query("DELETE FROM wp_signups WHERE (year = '".mysql_real_escape_string($year)."' and week = '".mysql_real_escape_string($week)."' and scoutID = '".mysql_real_escape_string($scoutID)."')");
//Add new entries for slots A-D
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge, approved) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'A' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeA)."', '".$approved."')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge, approved) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'B' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeB)."', '".$approved."')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge, approved) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'C' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeC)."', '".$approved."')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge, approved) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'D' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeD)."', '".$approved."')");
//Add new backup entries also
$badgeAa = explode(",", $_POST["blockABackup"]);
$badgeA = $badgeAa[$campSelect];
$badgeBa = explode(",", $_POST["blockBBackup"]);
$badgeB = $badgeBa[$campSelect];
$badgeCa = explode(",", $_POST["blockCBackup"]);
$badgeC = $badgeCa[$campSelect];
$badgeDa = explode(",", $_POST["blockDBackup"]);
$badgeD = $badgeDa[$campSelect];
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge, backup, approved) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'A' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeA)."', '1', '".$approved."')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge, backup, approved) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'B' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeB)."', '1', '".$approved."')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge, backup, approved) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'C' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeC)."', '1', '".$approved."')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge, backup, approved) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'D' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeD)."', '1', '".$approved."')");
$_POST["page"] = "scoutSignedup";
//Email the troop, if requested
if ($email)
{
	$result = mysql_query("SELECT * FROM wp_campers WHERE id = '".$scoutID."'");
	$row=mysql_fetch_array($result);
	$subject = str_replace("##name##", $row['firstName']." ".$row['lastName'], getCopy('email_subj_mb_reg'));
	$message = str_replace("##name##", $row['firstName']." ".$row['lastName'], getCopy('email_body_mb_reg'));
	$headers = "From:MyKaJaWan@makajawan.com \r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1 \r\n";
	mail($email,$subject,$message,$headers);
}
include("includes/scoutSignedup.php");
?>