<?php
	/*DO NOT DO THE FOLLOWING:
	1) Edit this page unless you know what the 'p' in PHP stands for (and can write it out in set builder notation)
	2) click the "visual" tab next to the "text" tab. Ever. If you do, immediately unplug your computer
	3) text and drive
	*/
	//A little housekeeping
	session_start();
	$_SESSION["year"] = 2014; //gorsh, mickey, if only there was a way to get this dynammically or something!
	$hostname = "fartram.db";
	$username = "jongunter";
	$password = "JTWh784DxwptSswq";
	$dbhandle = mysql_connect($hostname, $username, $password) 
		or die("Unable to connect to MySQL");
	$selected = mysql_select_db("rooster_snatch",$dbhandle) 
		or die("Could not select examples");
	//the address of the host
	$siteAddress = "http://operation-rooster-snatch.nfshost.com";
?><head>

<link rel="stylesheet" href="//www.makajawan.com/plugins/addthis/css/output.css?ver=3.8">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&subset=latin%2Clatin-ext&ver=3.8">
<link rel="stylesheet" href="//www.makajawan.com/wp-includes/css/dashicons.min.css?ver=3.8">
<link rel="stylesheet" href="//www.makajawan.com/wp-includes/css/admin-bar.min.css?ver=3.8">
<link rel="stylesheet" href="//www.makajawan.com/plugins/wordpress-seo/css/adminbar.css?ver=1.4.19">
<link rel="stylesheet" href="//www.makajawan.com/assets/css/bootstrap.css">
<link rel="stylesheet" href="//www.makajawan.com/assets/css/bootstrap-responsive.css">
<link rel="stylesheet" href="//www.makajawan.com/assets/css/app.css">
<link rel="stylesheet" href="//www.makajawan.com/plugins/wp-jquery-lightbox/styles/lightbox.min.css?ver=1.4">
<style>
input[type="number"] {height:30px;}
/* Much like commenting out text in Dreamweaver, applying Liam as a class makes an item grey.*/
.Liam {background-color: buttonface;}
</style>
<script src="/includes/sorttable.js"></script>
</head>


<div class="pf-content" width=>

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
</body>