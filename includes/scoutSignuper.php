<?php
$troopID=$_SESSION["troopID"];
$week = $_POST["week"];
$year = $_SESSION["year"];
$result=mysql_query("SELECT * FROM wp_troopsMeta WHERE troopID = '".mysql_real_escape_string($troopID)."' and year = '".mysql_real_escape_string($year)."' and week = '".mysql_real_escape_string($week)."'");
$row = mysql_fetch_array($result);
$camp = $row["camp"];
$campSelect = 0; //assumes East camper if there is a fatal error.
if ($camp == "east"){$campSelect = 0;}
if ($camp == "west"){$campSelect = 1;}
$scoutID = substr($_SESSION["active"],1);
$rank = (int)$_POST["rank"];
$dob = mysql_real_escape_string($_POST['bday']);
//Selects the appropriate MB id based on what side of the lake the scout is on (east = 0, west = 1)
$badgeAa = explode(",", $_POST["blockA"]);
$badgeA = $badgeAa[$campSelect];
$badgeBa = explode(",", $_POST["blockB"]);
$badgeB = $badgeBa[$campSelect];
$badgeCa = explode(",", $_POST["blockC"]);
$badgeC = $badgeCa[$campSelect];
$badgeDa = explode(",", $_POST["blockD"]);
$badgeD = $badgeDa[$campSelect];
//Delete any previous entries for that week and year by the same scout
mysql_query("DELETE FROM wp_signups WHERE (year = '".mysql_real_escape_string($year)."' and week = '".mysql_real_escape_string($week)."' and scoutID = '".mysql_real_escape_string($scoutID)."')");
//Add new entries for slots A-D
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'A' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeA)."')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'B' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeB)."')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'C' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeC)."')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'D' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeD)."')");
//Add new backup entries also
$badgeAa = explode(",", $_POST["blockABackup"]);
$badgeA = $badgeAa[$campSelect];
$badgeBa = explode(",", $_POST["blockBBackup"]);
$badgeB = $badgeBa[$campSelect];
$badgeCa = explode(",", $_POST["blockCBackup"]);
$badgeC = $badgeCa[$campSelect];
$badgeDa = explode(",", $_POST["blockDBackup"]);
$badgeD = $badgeDa[$campSelect];
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge, backup) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'A' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeA)."', '1')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge, backup) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'B' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeB)."', '1')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge, backup) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'C' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeC)."', '1')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge, backup) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'D' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeD)."', '1')");
$_POST["page"] = "scoutSignedup";
include("includes/scoutSignedup.php");
?>