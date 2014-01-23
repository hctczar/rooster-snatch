<?php
echo str_replace("##which##","troop",str_replace("##troopChecked##","checked",str_replace("##scoutChecked##","",$login)));
?>
<form method='post'>
<p>If you've forgotten your password, enter your username below and hit "Reset Password". A new, temporary password will be emailed to the address specified in your troop account settings. If you were trying to log in as a camper (and not into a troop account) please make sure that you checked the appropriate radio button on the login form, and try again.</p>
<input type='text' name='username' placeholder='username'>
<input type='hidden' name='page' value='troopResetPasswordPwd'>
<input type='submit' value='Reset Password'>
</form>
<br/>
<form method='post'>
<p>If you've forgotten your username, enter your username below and hit "Fetch Username". Robots will scour the datatables to find your username. If you were trying to log in as a camper (and not into a troop account) please make sure that you checked the appropriate radio button on the login form, and try again.</p>
<input type='number' name='troop' placeholder='troop'>
<select name='council' id='council' onChange='showOther()'>
	<option value='North East Illinois Council'>North East Illinois Council</option>
	<option value='other'>Other</option>
</select>
<div id='other'></div>
<script type='text/javascript'>
function showOther() {
if (document.getElementById('council').value == 'other')
{
document.getElementById('other').innerHTML = '<input type="text" name="councilOther" placeholder="council">';
}
else
{
document.getElementById('other').innerHTML = '';
}
}
</script>
<input type='hidden' name='page' value='troopResetPasswordUsr'>
<input type='submit' value='Fetch Username'>
</form>