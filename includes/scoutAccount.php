<?php
$active = mysql_real_escape_string(substr($_SESSION["active"],1));
echo $scoutMenu;
$result = mysql_query("SELECT * FROM wp_campers WHERE (id = '".$active."')");
$row = mysql_fetch_array($result);
$email = stripslashes($row['email']);
$bday = stripslashes($row['dob']);
$rank = stripslashes($row['rank']);
function isRank($r)
{
	global $rank;
	if ($r == $rank){return "selected";}
	else {return "";}
}
?>
<form method="post" role="form">
<strong>General Information</strong><br>
<div class="well">
	<?php echo getCopy("scout_set_info"); ?>
    <div class="input-group">
		<span class="input-group-addon" style="width:8em;">Rank:</span>
        <select name="rank" class="form-control" style="width:16em;">
            <option value='7' <?php echo isRank(7); ?>>Scout</option>
            <option value='6' <?php echo isRank(6); ?>>Tenderfoot</option>
            <option value='5' <?php echo isRank(5); ?>>Second</option>
            <option value='4' <?php echo isRank(4); ?>>First</option>
            <option value='3' <?php echo isRank(3); ?>>Star</option>
            <option value='2' <?php echo isRank(2); ?>>Life</option>
            <option value='1' <?php echo isRank(1); ?>>Eagle</option>
        </select>
	</div>
    <div class="input-group">
		<span class="input-group-addon" style="width:8em;">Birthday:</span>
		<input type="date" name="bday" class="form-control" value = "<?php echo $bday;?>" style="width:16em;">
	</div>
</div>
<strong>Email</strong><br>
<div class="well">
	<?php echo getCopy("scout_set_email"); ?>
    <div class="input-group">
		<span class="input-group-addon">Email:</span>
		<input type="email" name="email" autocomplete="off" class="form-control" placeholder = "example@gmail.com" value = "<?php echo $email;?>">
	</div>
</div>
<strong>Passcode</strong><br>
<div class="well">
	<p>If you would like to choose a new passcode, please type the new passcode below. </p>
	<div class="alert alert-danger" id="mismatch" style="display:none;"></div>
	<div class="form-group">
		<label for="passcode1">New Passcode:</label>
		<input type="password" name="passcode1" id="passcode1" autocomplete="off" class="form-control" onChange="matchPasscode()" onMouseOut="matchPasscode()">
	</div>
	<div class="form-group">
		<label for="passcode2">Please re-type your password:</label>
		<input type="password" name="passcode2" id="passcode2" autocomplete="off" class="form-control" onChange="matchPasscode()" onMouseOut="matchPasscode()">
	</div>
</div>
<input type="hidden" name="page" value="scoutAccountUpdate">
<button type="submit" class="btn btn-primary" id="submit">Update Account Info</button>
</form>
<script type='text/javascript'>
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
		parent.document.getElementById('iframe1').height = '382px';
		parent.document.getElementById('iframe1').height = document.body.scrollHeight;
	}
</script>