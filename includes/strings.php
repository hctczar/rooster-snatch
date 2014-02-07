<?php
/*-------------------------------------------------------------------
                        LOGIN
-------------------------------------------------------------------*/
$login = '
<h2>Please Log In</h2>

<form role="form" method="post">
<div class="well">
Logging in as a...
<div class="radio">
	<label>
		<input type="radio" name="type" value="troop" onClick="setText(\'troop\')"" ##troopChecked##>
		Troop Leader
	</label>
</div>
<div class="radio">
	<label>
		<input type="radio" name="type" value="scout" onClick="setText(\'scout\')"" ##scoutChecked##>
		Scout/Parent
	</label>
</div>
</div>
  <div class="form-group">
    <label for="username" id="text1">Troop Number</label>
    <input type="text" class="form-control" id="username" name="username" autocorrect="off" autocapitalize="off">
  </div>
  <div class="form-group">
    <label for="passcode">Passcode</label>
    <input type="password" class="form-control" id="passcode" name="passcode">
  </div>
  <span id=\'text2\'><input type=\'hidden\' name=\'page\' value=\'troop\'></span>
  <button class="btn btn-primary" type="submit" value="Login!"><span class="glyphicon glyphicon-user"></span> Log In</button>
</form>



'
	.""
	."<script type='text/javascript'>"
	."function setText(string) {"
	."    if (string=='troop')"
	."    {"
	."        document.getElementById('text1').innerHTML = 'Troop Number';"
	."        document.getElementById('text2').innerHTML = '<input type=\'hidden\' name=\'page\' value=\'troop\'>';"
	."    }"
	."    else if (string=='scout')"
	."    {"
	."        document.getElementById('text1').innerHTML = 'Username';"
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
	<div class="btn-group" style="margin-bottom:1em;">
		<button name="page" class="btn btn-default" value="troopAccount" type="submit" style="width:10em"><span class="glyphicon glyphicon-cog"></span><br>Settings</button>
		<button name="page" class="btn btn-default" value="troopRoster" type="submit" style="width:10em"><span class="glyphicon glyphicon-list-alt"></span><br>Roster</button>
		<button name="page" class="btn btn-default" value="troopSchedule" type="submit" style="width:10em"><span class="glyphicon glyphicon-calendar"></span><br>Schedule</button>';
		if (mysql_fetch_array(mysql_query("SELECT * FROM wp_troops WHERE id = '".mysql_real_escape_string($_SESSION["active"])."'"))['approveBadges'])
		{$troopMenu .= '<button name="page" class="btn btn-default" value="troopApproveBadges" type="submit" style="width:10em"><span class="glyphicon glyphicon-eye-open"></span><br>Approve Badges</button>';}
		$troopMenu .= 
		'<button name="page" class="btn btn-default" value="troopEvents" type="submit" style="width:10em"><span class="glyphicon glyphicon-tower"></span><br>Events</button>
		<button name="page" class="btn btn-default" value="troopCampsite" type="submit" style="width:10em"><span class="glyphicon glyphicon-home"></span><br>Campsites</button>
	</div>
</form>
';
/*-------------------------------------------------------------------
                        TROOP ACCOUNT
-------------------------------------------------------------------*/
$troopAccount = '
<form method="post" role="form">
	<div class="form-group">
		<label for="troop">Troop Number</label>
		<input type="text" id="troop" name="troop" value="##troop##" class="form-control">
	</div>
	<div class="form-group">
		<label for="email">Email Address</label>
		<input type="email" id="email" name="email" value="##email##" class="form-control">
	</div>
	<strong>Approve MB Signups</strong>
	<div class="well">
		'.getCopy('approve_MB').'
		<input type="checkbox" name="approveBadges" value="1" ##approveBadgesChecked##>Approve MB Signups<br/>
		<input type="checkbox" name="emailBadges"   value="1" ##emailBadgesChecked##>Email Pending Schedules<br/>
	</div>
	<strong>Passcode:</strong><br>
		If you would like to choose a new passcode, please type the new passcode below. <br><br>
	<div class="well">
		<div class="form-group">
			<label for="passcode1">New Passcode:</label>
			<input type=\'password\' name=\'passcode1\' id=\'passcode1\' autocomplete=\'off\' class=\'form-control\'>
		</div>
		<div class="form-group">
			<label for="passcode2">Please re-type your new passcode:</label>
			<input type=\'password\' name=\'passcode2\' id=\'passcode2\' onChange=\'matchPasscode()\' class=\'form-control\' onMouseOut=\'matchPasscode()\' autocomplete=\'off\'>
		</div>
		<div id=\'mismatch\' style=
		\'color:red\'></div>
		<input type=\'hidden\' name=\'page\' value=\'troopAccountUpdate\'>

	</div>

			<button type="submit" class="btn btn-primary">Save Changes to Account</button>

</form>'
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
	."<td><table><tr><td>Youth <input type='radio' name='youth##iter##' value='1' checked></td></tr><tr><td>Adult <input type='radio' name='youth##iter##' value='0'></td></tr></table></td>"
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
$scoutMenu = '
	<form method="post">
		<div class="btn-group" style="margin-bottom:1em;">
			<button type="submit" name="page" value="scoutAccount" class="btn-default btn" style="width:12em"><span class="glyphicon glyphicon-cog"></span><br> Account Settings</button>
			<button type="submit" name="page" value="scoutSignup" class="btn-default btn" style="width:12em"><span class="glyphicon glyphicon-ok-circle"></span><br> Merit Badge Signup</button>
			<button type="submit" name="page" value="scoutSchedule" class="btn-default btn" style="width:12em"><span class="glyphicon glyphicon-calendar"></span><br> View Schedule</button>
			<button type="submit" name="page" value="scoutCosts" class="btn-default btn" style="width:12em"><span class="glyphicon glyphicon-tag"></span><br> Merit Badge Costs</button>
		</div>
	</form>
';
/*-------------------------------------------------------------------
                        SCOUT ACCOUNT
-------------------------------------------------------------------*/
$scoutAccount = '
	<h2>Change Your Passcode</h2>
	<div class="alert alert-danger" id="mismatch" style="display:none;"></div>
<form method="post" role="form">
	<div class="form-group">
		<label for="passcode1">New Passcode:</label>
		<input type="password" name="passcode1" id="passcode1" autocomplete="off" class="form-control">
	</div>
	<div class="form-group">
		<label for="passcode2">Please re-type your password:</label>
		<input type="password" name="passcode2" id="passcode2" autocomplete="off" class="form-control" onChange="matchPasscode()" onMouseOut="matchPasscode()">
	</div>
	<input type=\'hidden\' name=\'page\' value=\'scoutAccountUpdate\'>
	<button type="submit" class="btn btn-primary" id="submit">Update Account Info</button>
</form>'
	."<script type='text/javascript'>"
	."	function matchPasscode() {"
	."		if (document.getElementById('passcode1').value != document.getElementById('passcode2').value)"
	."		{"
	."			document.getElementById('mismatch').style.display = 'block';
				document.getElementById('mismatch').innerHTML = 'Passcodes do not match';"
	."          document.getElementById('submit').disabled = true;"
	."		}"
	."		else"
	."		{"
				."document.getElementById('mismatch').style.display = 'none';"
	."			document.getElementById('mismatch').innerHTML = '';"
	."          document.getElementById('submit').disabled = false;"
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
	."<td>Rank: </td><td><select name='rank' class='form-control'>"
	."    <option value='7'>Scout</option>"
	."    <option value='6'>Tenderfoot</option>"
	."    <option value='5'>Second</option>"
	."    <option value='4'>First</option>"
	."    <option value='3'>Star</option>"
	."    <option value='2'>Life</option>"
	."    <option value='1'>Eagle</option>"
	."</select></td></tr>"
	."<tr><td>Birthdate: </td><td><input type='date' name='bday' min='1995-01-01' max='2000-12-31' class='form-control'>";
$scoutSignup = $scoutSignup	."</select></td></tr>"
	."<tr><td colspan = '2'><br/></td></tr><tr><td>Choose Week: </td><td><select class='form-control' name='week' id='weekSelect' onChange='fillBadges();'>"
	."<option value='##week1##'>Week ##week1##</option>"
	."<option value='##week2##'>Week ##week2##</option>"
	."</select></td></tr></table><br/><br/>"
	//So this is ugly. Let's explain. Each block is labeled, and then we drop down a line. Good so far. Each select element has a label (1st choice or 2nd choice). Now, we want that label to be on the same line as the element is's labeling. Unfortunately, bootstraps goes ahead and makes form elements render as blocks, not inline. So if you skip over that div for now, you'll notice that we've had to make each select element display as inline. Even then, though, the element takes up the full width of the page, forcing it onto its own line. So we had to manually set the width to 75%. Cool. Now, though, you'll notice that '1st choice: ' and '2nd choice,' despite having the same number of characters, are not necessarily the same length in most fonts. So we have to add some spacing in order to get both select elements to line up. (note that we can't just position the elements because if they are ever forced to drop down a line--I'm looking at you, iPhone--they'll no longer line up) The span, being an inline element, doesn't actually have a settable width. So that's why we had to make it an inline-block element. So we have everything where we want it, yay!. Now all we have to do is populate the select elements with a whole bunch of option elements, using php. And then add a little bit of javascript (and a lot more php) to get the right one to default!
	.'<label for="blockA" id="text1">Block A: </label><br/><label for="blockA">1st Choice: </label><span style="width:10px; display:inline-block;"> </span><span id="blockASpan"></span>'
	."<select name=\"blockA\" class='form-control' id='blockA' style='width:75%; display:inline;' onchange='checkConflicts(\"blockA\");'><option value='none,none' id='A' conflicts=''>None</option>##blockA##</select><br/><label for='blockABackup'>2nd Choice: </label><span style='width:5px; display:inline-block;'> </span><select name=\"blockABackup\" class='form-control' id='blockABackup' style='width:75%; display:inline;'><option value='none,none' id='bA'>None</option>##blockAb##</select><br/>"
	//then just rinse and repeat for the other blocks
	.'<br/><label for="blockB" id="text1">Block B: </label><br/><label for="blockB">1st Choice: </label><span style="width:10px; display:inline-block;"> </span><span id="blockBSpan"></span>'
	."<select name=\"blockB\" class='form-control' id='blockB' style='width:75%; display:inline;' onchange='checkConflicts(\"blockB\");'><option value='none,none' id='B' conflicts=''>None</option>##blockB##</select><br/><label for='blockBBackup'>2nd Choice: </label><span style='width:5px; display:inline-block;'> </span><select name=\"blockBBackup\" class='form-control' id='blockBBackup' style='width:75%; display:inline;'><option value='none,none' id='bB'>None</option>##blockBb##</select><br/>"
	//up to bat: block C, block D is on deck
	.'<br/><label for="blockC" id="text1">Block C: </label><br/><label for="blockC">1st Choice: </label><span style="width:10px; display:inline-block;"> </span><span id="blockCSpan"></span>'
	."<select name=\"blockC\" class='form-control' id='blockC' style='width:75%; display:inline;' onchange='checkConflicts(\"blockC\");'><option value='none,none' id='C' conflicts=''>None</option>##blockC##</select><br/><label for='blockCBackup'>2nd Choice: </label><span style='width:5px; display:inline-block;'> </span><select name=\"blockCBackup\" class='form-control' id='blockCBackup' style='width:75%; display:inline;'><option value='none,none' id='bC'>None</option>##blockCb##</select><br/>"
	//block D in da house!
	.'<br/><label for="blockD" id="text1">Block D: </label><br/><label for="blockD">1st Choice: </label><span style="width:10px; display:inline-block;"> </span><span id="blockDSpan"></span>'
	."<select name=\"blockD\" class='form-control' id='blockD' style='width:75%; display:inline;' onchange='checkConflicts(\"blockD\");'><option value='none,none' id='D' conflicts=''>None</option>##blockD##</select><br/><label for='blockDBackup'>2nd Choice: </label><span style='width:5px; display:inline-block;'> </span><select name=\"blockDBackup\" class='form-control' id='blockDBackup' style='width:75%; display:inline;'><option value='none,none' id='bD'>None</option>##blockDb##</select><br/>"
	."<br/><button type='submit' class='btn btn-primary' name='page' value='scoutSignuper'>Register</button>"
	."</form>"
	."<script type='text/javascript'>
	function checkConflicts(block)
	{
		conA = '';
		conB = '';
		conC = '';
		conD = '';
		conflicts = document.getElementById('blockA').selectedOptions[0].getAttribute('conflicts');
		if (conflicts.search('A') != -1){conA = document.getElementById('blockA').selectedOptions[0].innerHTML;}
		if (conflicts.search('B') != -1){conB = document.getElementById('blockA').selectedOptions[0].innerHTML;}
		if (conflicts.search('C') != -1){conC = document.getElementById('blockA').selectedOptions[0].innerHTML;}
		if (conflicts.search('D') != -1){conD = document.getElementById('blockA').selectedOptions[0].innerHTML;}
		conflicts = document.getElementById('blockB').selectedOptions[0].getAttribute('conflicts');
		if (conflicts.search('A') != -1){conA = document.getElementById('blockB').selectedOptions[0].innerHTML;}
		if (conflicts.search('B') != -1){conB = document.getElementById('blockB').selectedOptions[0].innerHTML;}
		if (conflicts.search('C') != -1){conC = document.getElementById('blockB').selectedOptions[0].innerHTML;}
		if (conflicts.search('D') != -1){conD = document.getElementById('blockB').selectedOptions[0].innerHTML;}
		conflicts = document.getElementById('blockC').selectedOptions[0].getAttribute('conflicts');
		if (conflicts.search('A') != -1){conA = document.getElementById('blockC').selectedOptions[0].innerHTML;}
		if (conflicts.search('B') != -1){conB = document.getElementById('blockC').selectedOptions[0].innerHTML;}
		if (conflicts.search('C') != -1){conC = document.getElementById('blockC').selectedOptions[0].innerHTML;}
		if (conflicts.search('D') != -1){conD = document.getElementById('blockC').selectedOptions[0].innerHTML;}
		conflicts = document.getElementById('blockD').selectedOptions[0].getAttribute('conflicts');
		if (conflicts.search('A') != -1){conA = document.getElementById('blockD').selectedOptions[0].innerHTML;}
		if (conflicts.search('B') != -1){conB = document.getElementById('blockD').selectedOptions[0].innerHTML;}
		if (conflicts.search('C') != -1){conC = document.getElementById('blockD').selectedOptions[0].innerHTML;}
		if (conflicts.search('D') != -1){conD = document.getElementById('blockD').selectedOptions[0].innerHTML;}
		if (conA) {document.getElementById('blockA').style.display='none'; document.getElementById('blockA').options[0].selected=true; document.getElementById('blockASpan').innerHTML='This block is taken up by '+conA;}
		else {document.getElementById('blockA').style.display='inline'; document.getElementById('blockASpan').innerHTML='';}
		if (conB) {document.getElementById('blockB').style.display='none'; document.getElementById('blockB').options[0].selected=true; document.getElementById('blockBSpan').innerHTML='This block is taken up by '+conB;}
		else {document.getElementById('blockB').style.display='inline'; document.getElementById('blockBSpan').innerHTML='';}
		if (conC) {document.getElementById('blockC').style.display='none'; document.getElementById('blockC').options[0].selected=true; document.getElementById('blockCSpan').innerHTML='This block is taken up by '+conC;}
		else {document.getElementById('blockC').style.display='inline'; document.getElementById('blockCSpan').innerHTML='';}
		if (conD) {document.getElementById('blockD').style.display='none'; document.getElementById('blockD').options[0].selected=true; document.getElementById('blockDSpan').innerHTML='This block is taken up by '+conD;}
		else {document.getElementById('blockD').style.display='inline'; document.getElementById('blockDSpan').innerHTML='';}
	}
	"
	."function fillBadges() {"
	."	##badgesByWeek##"
	."	var week=document.getElementById('weekSelect').value;"
	."	document.getElementById('A'+badgeA[week]).selected=true;"
	."	document.getElementById('B'+badgeB[week]).selected=true;"
	."	document.getElementById('C'+badgeC[week]).selected=true;"
	."	document.getElementById('D'+badgeD[week]).selected=true;"
	."	document.getElementById('bA'+badgeAb[week]).selected=true;"
	."	document.getElementById('bB'+badgeBb[week]).selected=true;"
	."	document.getElementById('bC'+badgeCb[week]).selected=true;"
	."	document.getElementById('bD'+badgeDb[week]).selected=true;"
	."}"
	."fillBadges(); checkConflicts('blockA');"
	."</script>";
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
	."<select name='week' onChange='setChecked()' id='weekSelect'  class='form-control' style='display:inline; width:14em;'>"
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