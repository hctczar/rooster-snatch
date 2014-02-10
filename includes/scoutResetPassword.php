<?php
echo str_replace("##special##","",str_replace("##which##","scout",str_replace("##scoutChecked##","checked",str_replace("##troopChecked##","",$login))));

function getCouncils()
{
	$councils=array();
	$result = mysql_query("SELECT * FROM wp_troops");
	while ($row = mysql_fetch_array($result))
	{
		if (strpos($row['council'],"NEIC") === false){$councils[]=$row['council'];}
	}
	$councils=array_unique($councils);
	asort($councils);
	$return = "
	<option value='NEIC Aptakisic'>NEIC Aptakisic</option>\n
	<option value='NEIC North Star'>NEIC North Star</option>\n
	<option value='NEIC Potawatomi'>NEIC Potawatomi</option>\n
	<option value='NEIC Provisional'>NEIC Provisional</option>\n
	";
	foreach ($councils as $council)
	{
		$return .= "<option value='".$council."'>".$council."</option>\n";
	}
	return $return;
}
?>
<div class="well">
<?php echo getCopy('scout_pwd_reset'); ?>
<form method='post'>
<div class="input-group">
    <input type="text" name="username" class="form-control" placeholder="Username">
    <span class="input-group-btn"><button type="submit" class="btn" id="submit" name="page" value="scoutResetPasswordPwd">Reset Password</button></span>
</div>
</form>
</div>
<div class="well">
<?php echo getCopy('scout_usr_reset'); ?>
<form method='post'>
<input type='number' name='troop' placeholder='troop' class="form-control" style="width:22%; display:inline-block;">
<select name='council' id='council' onChange='showOther()' class="form-control" style="width:68%; display:inline-block;">
    <?php echo getCouncils(); ?>
</select>
<input type="text" name="firstName" class="form-control" placeholder="First Name" style="width:45%; display:inline-block;">
<input type="text" name="lastName" class="form-control" placeholder="Last Name" style="width:45%; display:inline-block;">
<span class="input-group-btn"><button type="submit" class="btn" id="submit" name="page" value="scoutResetPasswordUsr">Fetch Username</button></span>
</form>
</div>