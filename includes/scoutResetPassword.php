<?php
echo str_replace("##which##","scout",str_replace("##scoutChecked##","checked",str_replace("##troopChecked##","",$login)));
?>
<form method='post'>
<p>If you've forgotten your password, enter your username below and hit "Reset Password". A new, temporary password will be emailed to your troop leader. If you were trying to log in as a troop (and not into a camper account) please make sure that you checked the appropriate radio button on the login form, and try again.</p>
<input type='text' name='username' placeholder='username'>
<input type='hidden' name='page' value='scoutResetPasswordPwd'>
<input type='submit' value='Reset Password'>
</form>
<br/>
<form method='post'>
<p>If you've forgotten your username, enter your username below and hit "Fetch Username". Robots will scour the datatables to find your username. If you were trying to log in as a troop (and not into a camper account) please make sure that you checked the appropriate radio button on the login form, and try again.</p>
<input type='number' name='troop' placeholder='troop'>
<select name='council' id='council' onChange='showOther()'>
	<option value='North East Illinois Council'>North East Illinois Council</option>
	<option value='other'>Other</option>
</select>
<div id='other'></div>
<input type='text' name='firstName' placeholder='First Name'>
<input type='text' name='lastName' placeholder='Last Name'>
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
<input type='hidden' name='page' value='scoutResetPasswordUsr'>
<input type='submit' value='Fetch Username'>
</form>