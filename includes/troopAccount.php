<?php
$active = $_SESSION["active"];
echo $troopMenu;
?>
<?php
$result = mysql_query("SELECT * FROM wp_troops WHERE (id = '".mysql_real_escape_string($active)."')");
$row = mysql_fetch_array($result);
$troop = stripslashes($row['number']);
$council = stripslashes($row['council']);
$login = stripslashes($row['login']);
$email = stripslashes($row['email']);
$email = explode(", ",$email);
//make sure that checkboxes default to checked, where appropriate
$approveBadgesChecked = '';
if ($row['approveBadges'] == true){$approveBadgesChecked = "checked";}
$emailBadgesChecked = '';
if ($row['emailBadges'] == true){$emailBadgesChecked = 'checked';}
?>
<form method="post" role="form">
	<div class="form-group">
		<label for="troop">Troop Number</label>
		<input type="text" id="troop" name="troop" value="<?php echo $troop; ?>" class="form-control">
	</div>
    <strong>Email Addresses</strong><br>
    <div class="well" id="emailWell">
    	<?php echo getCopy("update_email"); ?>
        <?php
		foreach ($email as $adr) {echo '
			<div class="input-group emailGroup">
				<input type="email" id="email" name="email[]" value="'.$adr.'" class="form-control" onchange="updateWell();">
				<span class="input-group-addon" onclick="clearEmail(this);"><span class="glyphicon glyphicon-remove"></span></span>
			</div>';
		}
		?>
    </div>
	<strong>Approve MB Signups</strong>
	<div class="well">
		<?php echo getCopy('approve_MB');?>
		<input type="checkbox" name="approveBadges" value="1" <?php echo $approveBadgesChecked; ?>>Approve MB Signups<br/>
		<input type="checkbox" name="emailBadges"   value="1" <?php echo $emailBadgesChecked;   ?>>Email Pending Schedules<br/>
	</div>
	<strong>Passcode</strong><br>
		
	<div class="well">
    	<p>If you would like to choose a new passcode, please type the new passcode below. </p>
        <div class="alert alert-danger" id="mismatch" style="display:none;"></div>
		<div class="form-group">
			<label for="passcode1">New Passcode:</label>
			<input type="password" name="passcode1" id="passcode1" autocomplete="off" class="form-control" onChange="matchPasscode();" onMouseOut="matchPasscode();">
		</div>
		<div class="form-group">
			<label for="passcode2">Please re-type your new passcode:</label>
			<input type="password" name="passcode2" id="passcode2" onChange="matchPasscode();" class="form-control" onMouseOut="matchPasscode();" autocomplete="off">
		</div>
		<input type="hidden" name="page" value="troopAccountUpdate">

	</div>

			<button type="submit" class="btn btn-primary" id="submit">Save Changes to Account</button>
</form>
<script type='text/javascript'>
function clearEmail(caller){
	caller.parentElement.getElementsByClassName("form-control")[0].value='';
	updateWell();
}
function updateWell() {
	var slots = document.getElementsByClassName("emailGroup");
	for (var i = 0 ; i < slots.length ; i++)
	{
		if (slots[i].getElementsByClassName("form-control")[0].value == ''){slots[i].parentNode.removeChild(slots[i]); i--;}
	}
	var well = document.getElementById("emailWell");
	var emailGroup=document.createElement("DIV");
	emailGroup.className = "input-group emailGroup";
	emailGroup.innerHTML = '<input type="email" id="email" name="email[]" class="form-control" onchange="updateWell();" placeholder="example@hotmale.com"><span class="input-group-addon" onclick="clearEmail(this);"><span class="glyphicon glyphicon-remove"></span></span>';
	well.appendChild(emailGroup);
	parent.document.getElementById('iframe1').height = '855px';
	parent.document.getElementById('iframe1').height = document.body.scrollHeight;
}
function matchPasscode() {
	if (document.getElementById('passcode1').value != document.getElementById('passcode2').value)
	{
		document.getElementById('mismatch').style.display = 'block';
		document.getElementById('mismatch').innerHTML = 'Passcodes do not match';
		document.getElementById('submit').disabled = true;
	}
	else
	{
		document.getElementById('mismatch').style.display = 'none';
		document.getElementById('mismatch').innerHTML = '';
		document.getElementById('submit').disabled = false;
	}
	parent.document.getElementById('iframe1').height = '855px';
	parent.document.getElementById('iframe1').height = document.body.scrollHeight;
}
updateWell();
</script>