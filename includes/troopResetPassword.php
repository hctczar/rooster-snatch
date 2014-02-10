<?php
echo str_replace("##special##","",str_replace("##which##","troop",str_replace("##troopChecked##","checked",str_replace("##scoutChecked##","",$login))));

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
<form method='post'>
<?php echo getCopy('troop_pwd_reset'); ?>
<div class="input-group">
    <input type="text" name="username" class="form-control" placeholder="Username">
    <span class="input-group-btn"><button type="submit" class="btn" id="submit" name="page" value="troopResetPasswordPwd">Reset Password</button></span>
</div>
</form>
</div>
<div class="well">
<form method='post'>
<?php echo getCopy('troop_usr_reset'); ?>
<div class="input-group">
	<span class="input-group-btn"><input type='number' name='troop' placeholder='troop' class="form-control" style="width:8em;"></span>
	<select name='council' id='council' onChange='showOther()' class="form-control">
		<?php echo getCouncils(); ?>
	</select>
    <span class="input-group-btn"><button type="submit" class="btn" id="submit" name="page" value="troopResetPasswordUsr">Fetch Username</button></span>
</div>
</form>
</div>
