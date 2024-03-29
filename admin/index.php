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
table.sortable th:not(.sorttable_nosort):not(.sorttable_sorted):not(.sorttable_sorted_reverse):after { 
    content: " \25B4\25BE" 
}
input[type="number"] {height:30px;}
/* Much like commenting out text in Dreamweaver, applying Liam as a class makes an item grey.*/
.Liam {background-color: buttonface;}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/includes/sorttable.js"></script>
<script src="/js/listjs.js"></script>
<script> document.domain = 'makajawan.com' </script>
<script src="js/bootstrap.min.js"></script>
<script src="js/tinymce/js/tinymce/tinymce.min.js"></script>
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
function getOptions($shortTag, $sort = true, $options = array())
{
	$entries = getCopy($shortTag);
	//list must be comma delineated. Let's explode those commas
	$entries = explode(",",$entries);
	if (! function_exists("cmp"))
	{
		function cmp($a, $b)
		{
			$a = ltrim(rtrim($a));
			$b = ltrim(rtrim($b));
			if ($a == $b){return 0;}
			if ($a > $b){return 1;}
			if ($a < $b){return -1;}
		}
	}
	if ($sort){usort($entries,"cmp");}
	$entryOptions = "";
	for($x=0 ; $x < count($entries) ; $x++)
	{
		//remove any leading and trailing whitespace.
		$label = ltrim(rtrim($entries[$x]));
		//let's format them as select options.
		$entries[$x] = "<option value = '".$label."'";
		for ($y=0 ; $y < count($options) ; $y++)
		{
			//Add any random options passed in.
			$entries[$x] .= " ".$options[$y]." ";
		}
		$entries[$x] .= ">".$label."</option>";
		$entryOptions .= $entries[$x];
	}
	return $entryOptions;
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
		echo str_replace("##special##","",$kennyloggin);
	}
	/*------------------------------------------------
	                  login
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "login")
	{
		include("includes/login.php");
	}
	/*------------------------------------------------
	                  ADMIN PASSWORD UPDATE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminPasswordUpdate")
	{
		include("includes/adminPasswordUpdate.php");
	}
	/*------------------------------------------------
	                  ADMIN RESET PASSWORD
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminResetPassword")
	{
		include("includes/adminResetPassword.php");
	}
	/*------------------------------------------------
	                  ADMIN RESET PASSWORD PWD
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminResetPasswordPwd")
	{
		include("includes/adminResetPasswordPwd.php");
	}
	/*------------------------------------------------
	                  ADMIN RESET PASSWORD USR
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminResetPasswordUsr")
	{
		include("includes/adminResetPasswordUsr.php");
	}
	/*------------------------------------------------
	                  ADMIN ACCOUNT
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminAccount")
	{
		include("includes/adminAccount.php");
	}
	/*------------------------------------------------
	                  ADMIN ACCOUNT UPDATE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminAccountUpdate")
	{
		include("includes/adminAccountUpdate.php");
	}
	/*------------------------------------------------
	                  ADMIN TROOPS
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminTroops")
	{
		include("includes/adminTroops.php");
	}
	/*------------------------------------------------
	                  ADMIN TROOP SAVE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminTroopSave")
	{
		include("includes/adminTroopSave.php");
	}
	/*------------------------------------------------
	                  ADMIN TROOP ADD
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminTroopAdd")
	{
		include("includes/adminTroopAdd.php");
	}
	/*------------------------------------------------
	                  ADMIN BADGES
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminBadges")
	{
		include("includes/adminBadges.php");
	}
	/*------------------------------------------------
	                  ADMIN BADGE ADD
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminBadgeAdd")
	{
		include("includes/adminBadgeAdd.php");
	}
	/*------------------------------------------------
	                  ADMIN BADGE DELETE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminBadgeDelete")
	{
		include("includes/adminBadgeDelete.php");
	}
	/*------------------------------------------------
	                  ADMIN BADGE CAP
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminBadgeCap")
	{
		include("includes/adminBadgeCap.php");
	}
	/*------------------------------------------------
	                  ADMIN BADGE CAP UPDATE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminBadgeCapUpdate")
	{
		include("includes/adminBadgeCapUpdate.php");
	}
	/*------------------------------------------------
	                  ADMIN ROSTER
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminRoster")
	{
		include("includes/adminRoster.php");
	}
	/*------------------------------------------------
	                  ADMIN EVENTS
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminEvents")
	{
		include("includes/adminEvents.php");
	}
	/*------------------------------------------------
	                  ADMIN EVENT VIEW
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminEventView")
	{
		include("includes/adminEventView.php");
	}
	/*------------------------------------------------
	                  ADMIN EVENT INSTANCE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminEventInstance")
	{
		include("includes/adminEventInstance.php");
	}
	/*------------------------------------------------
	                  ADMIN EVENT ADD
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminEventAdd")
	{
		include("includes/adminEventAdd.php");
	}
	/*------------------------------------------------
	                  ADMIN EVENT INSTANCE EDIT
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminEventInstanceEdit")
	{
		include("includes/adminEventInstanceEdit.php");
	}
	/*------------------------------------------------
	                  ADMIN EVENT INSTANCE EDIT IT
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminEventInstanceEditIt")
	{
		include("includes/adminEventInstanceEditIt.php");
	}
	/*------------------------------------------------
	                  ADMIN EVENT INSTANCE ADD
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminEventInstanceAdd")
	{
		include("includes/adminEventInstanceAdd.php");
	}
	/*------------------------------------------------
	                  ADMIN EVENT INSTANCE ADD IT
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminEventInstanceAddIt")
	{
		include("includes/adminEventInstanceAddIt.php");
	}
	/*------------------------------------------------
	                  ADMIN COPY
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminCopy")
	{
		include("includes/adminCopy.php");
	}
	/*------------------------------------------------
	                  ADMIN COPY UPDATE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminCopyUpdate")
	{
		include("includes/adminCopyUpdate.php");
	}
	/*------------------------------------------------
	                  ADMIN DATES
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminDates")
	{
		include("includes/adminDates.php");
	}
	/*------------------------------------------------
	                  ADMIN DATES UPDATE
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminDatesUpdate")
	{
		include("includes/adminDatesUpdate.php");
	}
	/*------------------------------------------------
	                  ADMIN EMAIL
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminEmail")
	{
		include("includes/adminEmail.php");
	}
	/*------------------------------------------------
	                  ADMIN EMAIL CONFIRM
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminEmailConfirm")
	{
		include("includes/adminEmailConfirm.php");
	}
	/*------------------------------------------------
	                  ADMIN EMAIL SEND
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminEmailSend")
	{
		include("includes/adminEmailSend.php");
	}
	/*------------------------------------------------
	                  ADMIN USERS
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminUsers")
	{
		include("includes/adminUsers.php");
	}
	/*------------------------------------------------
	                  ADMIN USERS ADD
	/*------------------------------------------------*/
	elseif ($_POST["page"] == "adminUsersAdd")
	{
		include("includes/adminUsersAdd.php");
	}
	/*------------------------------------------------
	                  ADMIN USERS DELETE
	/*------------------------------------------------*/
	elseif ($_POST['page'] == "adminUsersDelete")
	{
		include("includes/adminUsersDelete.php");
	}
	/*------------------------------------------------
	                  ADMIN USERS EDIT
	/*------------------------------------------------*/
	elseif ($_POST['page'] == "adminUsersEdit")
	{
		include("includes/adminUsersEdit.php");
	}
	/*------------------------------------------------
	                  ADMIN USER EDITOR
	/*------------------------------------------------*/
	elseif ($_POST['page'] == "adminUserEditor")
	{
		include("includes/adminUserEditor.php");
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