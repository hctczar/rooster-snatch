<?php
/*-------------------------------------------------------------------
                        LOGIN
-------------------------------------------------------------------*/
$kennyloggin = '
<h2>Please Log In</h2>

<form role="form" method="post">
  <div class="form-group">
    <label for="username" id="text1">Username</label>
    <input type="text" class="form-control" id="username" name="username" autocorrect="off" autocapitalize="off">
  </div>
  <div class="form-group">
    <label for="passcode">Passcode</label>
    <input type="password" class="form-control" id="passcode" name="passcode">
  </div>
  <span id=\'text2\'><input type=\'hidden\' name=\'page\' value=\'login\'></span>
  <button class="btn btn-primary" type="submit" value="Login!"><span class="glyphicon glyphicon-user"></span> Log In</button>
</form>



';
/*-------------------------------------------------------------------
                        ADMIN MENU
-------------------------------------------------------------------*/
$adminMenu = 
'<form method="post">
	<div class="btn-group" style="margin-bottom:1em;">
		<button name="page" class="btn btn-default" value="adminAccount" type="submit" style="width:10em"><span class="glyphicon glyphicon-cog"></span><br>Settings</button>
		<button name="page" class="btn btn-default" value="adminTroops" type="submit" style="width:10em"><span class="glyphicon glyphicon-briefcase"></span><br>Add Troops</button>
		<button name="page" class="btn btn-default" value="adminEvents" type="submit" style="width:10em"><span class="glyphicon glyphicon-calendar"></span><br>Add Events</button>
		<button name="page" class="btn btn-default" value="adminBadges" type="submit" style="width:10em"><span class="glyphicon glyphicon-fire"></span><br>Add Badgers</button>
		<button name="page" class="btn btn-default" value="adminBadgeCap" type="submit" style="width:10em"><span class="glyphicon glyphicon-dashboard"></span><br>MB Caps $ Costs</button>
		<button name="page" class="btn btn-default" value="adminRoster" type="submit" style="width:10em"><span class="glyphicon glyphicon-list-alt"></span><br>View Rosters</button>
		<button name="page" class="btn btn-default" value="adminCopy" type="submit" style="width:10em"><span class="glyphicon glyphicon-pencil"></span><br>Write Copy</button>
		<button name="page" class="btn btn-default" value="adminDates" type="submit" style="width:10em"><span class="glyphicon glyphicon-time"></span><br>Set Dates</button>
		<button name="page" class="btn btn-default" value="adminEmail" type="submit" style="width:10em"><span class="glyphicon glyphicon-envelope"></span><br>Send Emails</button>
	</div>
</form>
';
/*-------------------------------------------------------------------
                        ADMIN ACCOUNT
-------------------------------------------------------------------*/
$adminAccount = '
<form method="post" role="form">
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
		<div id="mismatch" style="color:red"></div>
		<input type="hidden" name="page" value="adminAccountUpdate">

	</div>

			<button type="submit" class="btn btn-primary" id="submit">Save Changes to Account</button>

</form>
<script type="text/javascript">
	function matchPasscode() {
		if (document.getElementById("passcode1").value != document.getElementById("passcode2").value)
		{
			document.getElementById("mismatch").innerHTML = "Passcodes do not match";
          document.getElementById("submit").disabled = true;
		}
		else
		{
			document.getElementById("mismatch").innerHTML = "";
          document.getElementById("submit").disabled = false;
		}
		parent.document.getElementById("iframe1").height = "493px";
		parent.document.getElementById("iframe1").height = document.body.scrollHeight;
	}
	</script>';
	//##email##
	//##council##
	//##troop##


?>