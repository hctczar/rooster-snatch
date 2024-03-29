<?php
	/*DO NOT DO THE FOLLOWING:
	1) Edit this page unless you know what the 'p' in PHP stands for (and can write it out in set builder notation)
	2) click the "visual" tab next to the "text" tab. Ever. If you do, immediately unplug your computer
	3) text and drive
	*/
	//A little housekeeping
	session_start();
	$_SESSION["year"] = 2014; //gorsh, mickey, if only there was a way to get this dynammically or something!

	try {
		$hostname = "localhost";
		$username = "root";
		$password = "root";
		if (! $dbhandle = @mysql_connect($hostname, $username, $password))
			throw new Exception('unable to connect to the database.');
		if (! $selected = @mysql_select_db("rooster_snatch",$dbhandle))
			throw new Exception('unable to find the table.');
	} catch (Exception $e){
		try {
			$hostname = "fartram.db";
			$username = "jongunter";
			$password = "JTWh784DxwptSswq";
			if (! $dbhandle = @mysql_connect($hostname, $username, $password))
				throw new Exception('unable to connect to the database.');
			if (! $selected = @mysql_select_db("rooster_snatch",$dbhandle))
				throw new Exception('unable to find table.');;
		} catch (Exception $e){
			echo 'Sorry. The database seems to be temporarily unavailable. The server was ',  $e->getMessage();
			exit(1);
		}
	}
	//the address of the host
	$siteAddress = "http://operation-rooster-snatch.nfshost.com";
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My-Ka-Ja-Wan</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
input[type="number"] {height:30px;}
/* Much like commenting out text in Dreamweaver, applying Liam as a class makes an item grey.*/
.Liam {background-color: buttonface;}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/includes/sorttable.js"></script>
<script> document.domain = 'makajawan.com' </script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<header class="container">
<h1>My-Ka-Ja-Wan <small>Camper &amp; Troop Registration System</small></h1>
</header>

<div class="pf-content container">
	<div class="row">
		<div class="col-md-12">

<script>window.parent.$("body").animate({scrollTop:200}, 'fast');</script>

<?php
//string declarations of the HTML and JavaScript code to be displayed
include("includes/strings.php");
//utility function. Returns copy from wp_copy.
function getCopy($shortTag)
{
    $result = mysql_query("SELECT * FROM wp_copy WHERE shortTag = '".mysql_real_escape_string($shortTag)."'");
	$row = mysql_fetch_array($result);
	if (is_array($row))
		return $row['text'];
	else
		return false;
}
function getDateCopy($shortTag)
{
	$result = mysql_query("SELECT * FROM wp_dates WHERE shortTag = '".mysql_real_escape_string($shortTag)."'");
	$row = mysql_fetch_array($result);
	if (is_array($row))
		return strtotime($row['date']);
	else
		return false;
}
?>

<?php
//If you've stumbled across this page, you already know to much.

//LEAVE NOW OR YOUR COMPUTER WILL SELF DESTRUCT!!!!
?>

<?php
	//Select which "page" to display, based on $_POST values
	if (! isset($_POST["page"]))
	//generate the login page
	{
		echo str_replace("##special##","",str_replace("##which##","troop",str_replace("##troopChecked##","checked",str_replace("##scoutChecked##","",$login))));
	}
	/*------------------------------------------------
	                  SCOUT
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scout")
	{
		include("includes/scout.php");
	}
		/*------------------------------------------------
	                  SCOUT PASSWORD UPDATE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scoutPasswordUpdate")
	{
		include("includes/scoutPasswordUpdate.php");
	}
	/*------------------------------------------------
	                  SCOUT RESET PASSWORD
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scoutResetPassword")
	{
		include("includes/scoutResetPassword.php");
	}
	/*------------------------------------------------
	                  SCOUT RESET PASSWORD PWD
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scoutResetPasswordPwd")
	{
		include("includes/scoutResetPasswordPwd.php");
	}
	/*------------------------------------------------
	                  SCOUT RESET PASSWORD USR
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scoutResetPasswordUsr")
	{
		include("includes/scoutResetPasswordUsr.php");
	}
	/*------------------------------------------------
	                  SCOUT ACCOUNT
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scoutAccount")
	{
		include("includes/scoutAccount.php");
	}
	/*------------------------------------------------
	                  SCOUT ACCOUNT UPDATE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scoutAccountUpdate")
	{
		include("includes/scoutAccountUpdate.php");
	}
	/*------------------------------------------------
	                  SCOUT SIGNUP
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scoutSignup")
	{
		include("includes/scoutSignup.php");
	}
	/*------------------------------------------------
	                  SCOUT SIGNUPER
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scoutSignuper")
	{
		include("includes/scoutSignuper.php");
	}
	/*------------------------------------------------
	                  SCOUT SIGNEDUP
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scoutSignedup")
	{
		include("includes/scoutSignedup.php");
	}
	/*------------------------------------------------
	                  SCOUT SCHEDULE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scoutSchedule")
	{
		include("includes/scoutSchedule.php");
	}
	/*------------------------------------------------
	                  SCOUT COSTS
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scoutCosts")
	{
		include("includes/scoutCosts.php");
	}
	/*------------------------------------------------
	                  SCOUT TRENDING
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "scoutTrending")
	{
		include("includes/scoutTrending.php");
	}
	/*------------------------------------------------
	                  TROOP
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troop")
	{
		include("includes/troop.php");
	}
	/*------------------------------------------------
	                  TROOP PASSWORD UPDATE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopPasswordUpdate")
	{
		include("includes/troopPasswordUpdate.php");
	}
	/*------------------------------------------------
	                  TROOP RESET PASSWORD
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopResetPassword")
	{
		include("includes/troopResetPassword.php");
	}
	/*------------------------------------------------
	                  TROOP RESET PASSWORD PWD
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopResetPasswordPwd")
	{
		include("includes/troopResetPasswordPwd.php");
	}
	/*------------------------------------------------
	                  TROOP RESET PASSWORD USR
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopResetPasswordUsr")
	{
		include("includes/troopResetPasswordUsr.php");
	}
	/*------------------------------------------------
	                  WEEK SELECT (deprecated)
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "weekSelect")
	{
		$_POST["page"] = "troopRoster";
	}
	/*------------------------------------------------
	                  TROOP ACCOUNT
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopAccount")
	{
		include("includes/troopAccount.php");
	}
	/*------------------------------------------------
	                  TROOP ACCOUNT UPDATE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopAccountUpdate")
	{
		include("includes/troopAccountUpdate.php");
	}
	/*------------------------------------------------
	                  TROOP CAMPSITE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopCampsite")
	{
		include("includes/troopCampsite.php");
	}
	/*------------------------------------------------
	                  TROOP CAMPSITE UPDATE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopCampsiteUpdate")
	{
		include("includes/troopCampsiteUpdate.php");
	}
	/*------------------------------------------------
	                  TROOP ROSTER
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopRoster")
	{
		include("includes/troopRoster.php");
	}
	/*------------------------------------------------
	                  TROOP ROSTER ADD
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopRosterAdd")
	{
		include("includes/troopRosterAdd.php");
	}
	/*------------------------------------------------
	                  TROOP ROSTER ADDED
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopRosterAdded")
	{
		include("includes/troopRosterAdded.php");
	}
	/*------------------------------------------------
	                  TROOP ROSTER DELETE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopRosterDelete")
	{
		include("includes/troopRosterDelete.php");
	}
	/*------------------------------------------------
	                  TROOP ROSTER EDIT
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopRosterEdit")
	{
		include("includes/troopRosterEdit.php");
	}
	/*------------------------------------------------
	                  TROOP ROSTER UPDATE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "troopRosterUpdate")
	{
		include("includes/troopRosterUpdate.php");
	}
	/*------------------------------------------------
	                  TROOP EVENTS
	/*------------------------------------------------*/
	elseif ($_POST['page'] == "troopEvents")
	{
		include("includes/troopEvents.php");
	}
	/*------------------------------------------------
	                  TROOP EVENT DELETE
	/*------------------------------------------------*/
	elseif ($_POST['page'] == "troopEventDelete")
	{
		include("includes/troopEventDelete.php");
	}
	/*------------------------------------------------
	                  TROOP EVENT ADD
	/*------------------------------------------------*/
	elseif ($_POST['page'] == "troopEventAdd")
	{
		include("includes/troopEventAdd.php");
	}
	/*------------------------------------------------
	                  TROOP EVENT EDIT
	/*------------------------------------------------*/
	elseif ($_POST['page'] == "troopEventEdit")
	{
		include("includes/troopEventEdit.php");
	}
	/*------------------------------------------------
	                  TROOP EVENT UPDATE
	/*------------------------------------------------*/
	elseif ($_POST['page'] == "troopEventUpdate")
	{
		include("includes/troopEventUpdate.php");
	}
	/*------------------------------------------------
	                  TROOP SCHEDULE
	/*------------------------------------------------*/
	elseif ($_POST['page'] == "troopSchedule")
	{
		include("includes/troopSchedule.php");
	}
	/*------------------------------------------------
	                  TROOP APPROVE BADGES
	/*------------------------------------------------*/
	elseif ($_POST['page'] == "troopApproveBadges")
	{
		include("includes/troopApproveBadges.php");
	}
	/*------------------------------------------------
	                  TROOP APPROVE BADGES APPROVE
	/*------------------------------------------------*/
	elseif ($_POST['page'] == "troopApproveBadgesApprove")
	{
		include("includes/troopApproveBadgesApprove.php");
	}
?>
		</div>
	</div>
	<!-- /.row -->
</div>
</body>
</html>