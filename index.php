<?php
	/*DO NOT DO THE FOLLOWING:
	1) Edit this page unless you know what the 'p' in PHP stands for (and can write it out in set builder notation)
	2) click the "visual" tab next to the "text" tab. Ever. If you do, immediately unplug your computer
	3) text and drive
	*/
	//A little housekeeping
	session_start();
	$_SESSION["year"] = 2014; //gorsh, mickey, if only there was a way to get this dynammically or something!

	$domain = $_SERVER['HTTP_HOST'];
	$domain = strtolower($domain);
	if(substr_count($domain, 'makajawan.com') > 0) {
		$hostname = "fartram.db";
		$username = "jongunter";
		$password = "JTWh784DxwptSswq";
	} else {
		$hostname = "localhost";
		$username = "root";
		$password = "root";
	}




	$dbhandle = mysql_connect($hostname, $username, $password) 
		or die("Unable to connect to MySQL");
	$selected = mysql_select_db("rooster_snatch",$dbhandle) 
		or die("Could not select examples");
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

<script>window.parent.$("body").animate({scrollTop:0}, 'slow');</script>

<?php

//string declarations of the HTML and JavaScript code to be displayed
include("includes/strings.php");
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
		echo str_replace("##which##","troop",str_replace("##troopChecked##","checked",str_replace("##scoutChecked##","",$login)));
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
?>
		</div>
	</div>
	<!-- /.row -->
</div>
</body>
</html>