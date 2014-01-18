<?php
$troopID=$_SESSION["troopID"];
$week = $_POST["week"];
$year = $_SESSION["year"];
$result=mysql_query("SELECT * FROM wp_troopsMeta WHERE troopID = '".mysql_real_escape_string($troopID)."' and year = '".mysql_real_escape_string($year)."' and week = '".mysql_real_escape_string($week)."'");
$row = mysql_fetch_array($result);
$camp = $row["camp"];
$scoutID = substr($_SESSION["active"],1);
$rank = (int)$_POST["rank"];
$dob = 10000*(int)$_POST["yeear"]+100*(int)$_POST["moonth"]+(int)$_POST["daay"];
//$dob = 19910613;
$badgeA = $_POST["blockA"];
$badgeB = $_POST["blockB"];
$badgeC = $_POST["blockC"];
$badgeD = $_POST["blockD"];
//Delete any previous entries for that week and year by the same scout
mysql_query("DELETE FROM wp_signups WHERE (year = '".mysql_real_escape_string($year)."' and week = '".mysql_real_escape_string($week)."' and scoutID = '".mysql_real_escape_string($scoutID)."')");
//Add new entries for slots A-D
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'A' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeA)."')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'B' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeB)."')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'C' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeC)."')");
mysql_query("INSERT INTO wp_signups (year, week, block, scoutID, rank, dob, camp, badge) VALUES ('".mysql_real_escape_string($year)."', '".mysql_real_escape_string($week)."', 'D' ,'".mysql_real_escape_string($scoutID)."', '".mysql_real_escape_string($rank)."', '".mysql_real_escape_string($dob)."', '".mysql_real_escape_string($camp)."', '".mysql_real_escape_string($badgeD)."')");
$_POST["page"] = "scoutSignedup";
include("includes/scoutSignedup.php");
?>