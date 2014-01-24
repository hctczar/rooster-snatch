<?php
/*-------------------------------------------------------------------
                        LOGIN
-------------------------------------------------------------------*/
$login = ""

	."<form method='post'>"
	."<table border = '1'>"
	."<th align='left'>Login</th><td><input type='radio' name='type' value='troop' onClick='setText(\"troop\")' ##troopChecked##>Troop&nbsp;&nbsp;&nbsp;<input type='radio' name='type' value='scout' onClick='setText(\"scout\")' ##scoutChecked##>Scout</td>"
	."<tr>"
	."<td id='text1'>Troop No.</td>"
	."<td><input type='text' name='username'></td>"
	."</tr>"
	."<tr>"
	."<td>Passcode</td>"
	."<td><input type='password' name='passcode'></td>"
	."</tr>"
	."<tr>"
	."<td colspan = '2'>"
	."<div id='text2'><input type='hidden' name='page' value='troop'></div>"
	."<input type='submit' value='Login!'>"
	."</td>"
	."</tr>"
	."</table>"
	."</form>"
	.""
	."<script type='text/javascript'>"
	."function setText(string) {"
	."    if (string=='troop')"
	."    {"
	."        document.getElementById('text1').innerHTML = 'Troop No.';"
	."        document.getElementById('text2').innerHTML = '<input type=\'hidden\' name=\'page\' value=\'troop\'>';"
	."    }"
	."    else if (string=='scout')"
	."    {"
	."        document.getElementById('text1').innerHTML = 'Scout';"
	."        document.getElementById('text2').innerHTML = '<input type=\'hidden\' name=\'page\' value=\'scout\'>';"
	."    }"
	."}"
	."setText('##which##');"
	."</script>";
	//##scoutChecked##
	//##troopChecked##
	//##which##
/*-------------------------------------------------------------------
                        TROOP MENU
-------------------------------------------------------------------*/
$troopMenu = 
'<form method="post">
	<div class="btn-group">
		<button name="page" class="btn btn-default" value="troopAccount" type="submit"><span class="glyphicon glyphicon-cog"></span><br>Settings</button>
		<button name="page" class="btn btn-default" value="troopRoster" type="submit"><span class="glyphicon glyphicon-list-alt"></span><br>Roster</button>
		<button name="page" class="btn btn-default" value="troopCampsite" type="submit"><span class="glyphicon glyphicon-home"></span><br>Campsites</button>
		<button name="page" class="btn btn-default" value="troopEvents" type="submit"><span class="glyphicon glyphicon-tower"></span><br>Events</button>
		<button name="page" class="btn btn-default" value="troopSchedule" type="submit"><span class="glyphicon glyphicon-calendar"></span><br>Schedule</button>
	</div>
</form>
';
/*-------------------------------------------------------------------
                        TROOP ACCOUNT
-------------------------------------------------------------------*/
$troopAccount = ""
	."<form method='post'>"
	."Troop Number: <br/><input type='text' name='troop' value='##troop##'><br/>"
	."Email Address: <br/><input type='text' name='email' value='##email##'><br/>"
	."Council: <br/>"
	."<select name='council' id='council' onChange='showOther()'>"
	." 	<option value='##council##'>##council##</option>"
	."    <option value='North East Illinois Council'>North East Illinois Council</option>"
	."    <option value='other'>Other</option>"
	."</select>"
	."<div id='other'></div>"
	."<br/>"
	."If you would like to choose a new passcode, please type the new passcode below. <br/>"
	.""
	."New Passcode: <input type='password' name='passcode1' id='passcode1' autocomplete='off'><br/>"
	."New Passcode: <input type='password' name='passcode2' id='passcode2' onChange='matchPasscode()' onMouseOut='matchPasscode()' autocomplete='off'>"
	."<div id='mismatch' style='color:red'></div>"
	."<br/>"
	."<input type='hidden' name='page' value='troopAccountUpdate'>"
	."<div id='submit'><input type='submit' value='Sumbit Changes'></div>"
	."<script type='text/javascript'>"
	."	function showOther() {"
	."		if (document.getElementById('council').value == 'other')"
	."		{"
	."			document.getElementById('other').innerHTML = '<input type=\"text\" name=\"councilOther\" value=\"##council##\">';"
	."		}"
	."		else"
	."		{"
	."			document.getElementById('other').innerHTML = '';"
	."		}"
	."	}"
	."	function matchPasscode() {"
	."		if (document.getElementById('passcode1').value != document.getElementById('passcode2').value)"
	."		{"
	."			document.getElementById('mismatch').innerHTML = 'Passcodes do not match';"
	."          document.getElementById('submit').innerHTML = 'OOPS';"
	."		}"
	."		else"
	."		{"
	."			document.getElementById('mismatch').innerHTML = '';"
	."          document.getElementById('submit').innerHTML = '<input type=\'submit\' value=\'Sumbit Changes\'>';"
	."		}"
	."	}"
	.""
	."</script>";
	//##email##
	//##council##
	//##troop##
/*-------------------------------------------------------------------
                        ROSTER ADDER
-------------------------------------------------------------------*/
$rosterAdder = ""
	."<form method='post'>"
	.'<table class="table table-striped">'
	."<tr><th>First Name</th><th>Last Name</th><th>Days Camping</th><th>Youth or Adult?</th></tr>"
	."<tr>"
	."";
	$lineString = ""
	."<td><input type='text' class='form-control' placeholder='Enter First Name' name='firstName##iter##'></td>"
	."<td><input type='text' class='form-control' placeholder='Enter Last Name' name='lastName##iter##'></td>"
	."<td>
			<label class='checkbox-inline'>
				<input type='checkbox' name='week1##iter##' value='##week1##' checked>
				Week ##week1## 
			</label>
			<label class='checkbox-inline'>
				<input type='checkbox' name='week2##iter##' value='##week2##' checked>
				Week ##week2##
			</label>
		</td>"
	."<td>Youth <input type='radio' name='youth##iter##' value='1' checked>Adult <input type='radio' name='youth##iter##' value='0'></td>"
	."</tr>";
	for ($iter = 0; $iter<20;$iter++)
	{
		$rosterAdder = $rosterAdder.str_replace("##iter##",$iter,$lineString);
	}
	$rosterAdder = $rosterAdder	.""
	."</table>"
	."<input type='hidden' name='page' value='troopRosterAdd'>"
	."<button type='submit' value='add campers' class='btn btn-primary pull-right'>Add These Campers to Roster <span class='glyphicon glyphicon-arrow-right'></span></button>"
	."</form>";
	//##iter##
	//##week2##
	//##week1##
/*-------------------------------------------------------------------
                        ROSTER EDITOR
-------------------------------------------------------------------*/
$rosterEditor = ""
	."<form method='post'>"
	."First Name: <input type='text' name='firstName' value='##firstName##'><br/>"
	."Last Name: <input type='text' name='lastName' value='##lastName##'>"
	."<select name='youth'>"
	."    <option value='1' ##selectedY##>Youth</option>"
	."    <option value='0' ##selectedA##>Adult</option>"
	."</select><br/>"
	."Weeks Camping:<br/>"
	."Week ##week1##<input type='checkbox' name='week1' value='##week1##' ##week1checked##><br/>"
	."Week ##week2##<input type='checkbox' name='week2' value='##week2##' ##week2checked##><br/>"
	.""
	."<input type='hidden' name='camper' value='##camper##'>"
	."<input type='hidden' name='page' value='troopRosterUpdate'>"
	."<input type='submit' value='Sumbit Changes'>"
	."</form>";
	//##week1##
	//##selectedY##
	//##week1checked##
	//##week2checked##
	//##lastName##
	//##firstName##
	//##week2##
	//##camper##
	//##selectedA##
/*-------------------------------------------------------------------
                        SCOUT MENU
-------------------------------------------------------------------*/
$scoutMenu = ""
	."<table>"
	."<tr>"
	."<td style='width:16em'><form method='post'><input type='hidden' name='page' value='scoutAccount'><input type='submit' value='Account Settings' style='width:16em'></form></td>"
	."<td></td>"
	."<td style='width:16em'><form method='post'><input type='hidden' name='page' value='scoutSignup'><input type='submit' value='Sign Up For Merit Badges' style='width:16em'></form></td>"
	."<tr>"
	."</table>";
/*-------------------------------------------------------------------
                        SCOUT ACCOUNT
-------------------------------------------------------------------*/
$scoutAccount = ""
	."<form method='post'>"
	."If you would like to choose a new passcode, please type the new passcode below. <br/><br/>"
	.""
	."New Passcode: <input type='password' name='passcode1' id='passcode1' autocomplete='off'><br/>"
	."New Passcode: <input type='password' name='passcode2' id='passcode2' onChange='matchPasscode()' onMouseOut='matchPasscode()' autocomplete='off'>"
	."<div id='mismatch' style='color:red'></div>"
	."<br/>"
	."<input type='hidden' name='page' value='scoutAccountUpdate'>"
	."<div id='submit'><input type='submit' value='Sumbit Changes'></div>"
	."<script type='text/javascript'>"
	."	function matchPasscode() {"
	."		if (document.getElementById('passcode1').value != document.getElementById('passcode2').value)"
	."		{"
	."			document.getElementById('mismatch').innerHTML = 'Passcodes do not match';"
	."          document.getElementById('submit').innerHTML = 'OOPS';"
	."		}"
	."		else"
	."		{"
	."			document.getElementById('mismatch').innerHTML = '';"
	."          document.getElementById('submit').innerHTML = '<input type=\'submit\' value=\'Sumbit Changes\'>';"
	."		}"
	."	}"
	.""
	."</script>"
;
/*-------------------------------------------------------------------
                        SCOUT SIGNUP
-------------------------------------------------------------------*/
$scoutSignup = ""
	."<form method='post'>"
	."<table>"
	."<tr>"
	."<td>Rank: </td><td><select name='rank' style = 'width:100%'>"
	."    <option value='7'>Scout</option>"
	."    <option value='6'>Tenderfoot</option>"
	."    <option value='5'>Second</option>"
	."    <option value='4'>First</option>"
	."    <option value='3'>Star</option>"
	."    <option value='2'>Life</option>"
	."    <option value='1'>Eagle</option>"
	."</select></td></tr>"
	."<tr><td>Birthdate: </td><td><select name=\"moonth\" width = '8em'>"
	."    <option value='1'>Jan</option>"
	."    <option value='2'>Feb</option>"
	."    <option value='3'>Mar</option>"
	."    <option value='4'>Apr</option>"
	."    <option value='5'>May</option>"
	."    <option value='6'>Jun</option>"
	."    <option value='7'>Jul</option>"
	."    <option value='8'>Aug</option>"
	."    <option value='9'>Sep</option>"
	."    <option value='10'>Oct</option>"
	."    <option value='11'>Nov</option>"
	."    <option value='12'>Dec</option>"
	."</select><select name=\"daay\" width = '8em'>";
$lineString = ""
	."	<option value='##iter##'>##iter##</option>";
for ($iter = 0; $iter<31;$iter++)
{
$scoutSignup = $scoutSignup.str_replace("##iter##",$iter+1,$lineString);
}
$scoutSignup = $scoutSignup	."</select><select name=\"yeear\" width = '8em'>";
$lineString = ""
	."	<option value='##iter##'>##iter##</option>";
for ($iter = 0; $iter<18-8;$iter++)
{
$scoutSignup = $scoutSignup.str_replace("##iter##",$iter+1995,$lineString);
}
$scoutSignup = $scoutSignup	."</select></td></tr>"
	."<tr><td colspan = '2'><br/></td></tr><tr><td>Choose Week: </td><td><select style='width:100%' name='week'>"
	."<option value='##week1##'>Week ##week1##</option>"
	."<option value='##week2##'>Week ##week2##</option>"
	."</select></td></tr></table><br/><br/>"
	."Block A: <select name=\"blockA\">"
	."	##blockA##"
	."</select><br/>"
	."Block B: <select name=\"blockB\">"
	."	##blockB##"
	."</select><br/>"
	."Block C: <select name=\"blockC\">"
	."	##blockC##"
	."</select><br/>"
	."Block D: <select name=\"blockD\">"
	."	##blockD##"
	."</select><br/>"
	."<input type='hidden' name='page' value='scoutSignuper'>"
	."<input type='submit' value='Submit Preferences' style='width:16em'>"
	."</form>";	
	//##blockC##
	//##blockB##
	//##iter##
	//##blockD##
	//##blockA##
	//##week1##
	//##week2##
/*-------------------------------------------------------------------
                        CAMPSITE
-------------------------------------------------------------------*/
$campsite = ""
	."<form method ='post'>"
	."Please select a week:"
	."<select name='week' onChange='setChecked()' id='weekSelect'>"
	." 	##week1##"
	."    ##week2##"
	."</select>"
	."<p>MaKaJaWan is happy to provide and set up our green canvas wall-tents for all of our guests. However, some troops choose to bring their own tents to camp. If your troop would like to use their own tents, please select the appropriate radio button bellow.</p>"
	."<input type='radio' name='tents' value='0' ##tents0## id='tents0'>Our troop will use MaKaJaWan's canvas wall-tents<br>"
	."<input type='radio' name='tents' value='1' ##tents1## id='tents1'>Our adult leaders will bring their own tents<br>"
	."<input type='radio' name='tents' value ='2' ##tents2## id='tents2'>All of our campers will bring their own tents"
	."<br/><br/>"
	."<input type='hidden' name='page' value='troopCampsiteUpdate'>"
	."<input type='submit' value='Change Preferences'>"
	."</form>"
	.""
	."<script type='text/javascript'>"
	."function setChecked() {"
	."    if (document.getElementById('weekSelect').value == ##week1Num##)"
	."	{"
	."		document.getElementById('tents##tents1##').checked = true;"
	."	}"
	."	if (document.getElementById('weekSelect').value == ##week2Num##)"
	."	{"
	."		document.getElementById('tents##tents2##').checked = true;"
	."	}"
	."}"
	."setChecked();"
	."</script>";
	//##tents0##
	//##tents1##
	//##week2##
	//##week1##
	//##tents2##
/*-------------------------------------------------------------------
                        EVENT ADDER
-------------------------------------------------------------------*/	

?>