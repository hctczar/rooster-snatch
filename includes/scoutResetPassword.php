<?php
echo str_replace("##which##","scout",str_replace("##scoutChecked##","checked",str_replace("##troopChecked##","",$login)));
?>
	<h3>Forgot Password?</h3>
<div class="well">

<form method='post' role='form'>

<p>If you've forgotten your password, enter your username below and hit "Reset Password". A new, temporary password will be emailed to your troop leader. If you were trying to log in as a troop (and not into a camper account) please make sure that you checked the appropriate radio button on the login form, and try again.</p>
<input type='hidden' name='page' value='scoutResetPasswordPwd'>

<div class="input-group">
<input type='text' name='username' placeholder='username' class='form-control'>
<span class="input-group-btn">
<input type='submit' value='Reset Password' class='btn btn-primary'>
</span>
</div>
</form>
<br/>
<form method='post' role='form'>
</div>

<h3>Forgot Username?</h3>
<div class="well">
<p>If you've forgotten your username, enter your username below and hit "Fetch Username". Robots will scour the datatables to find your username. If you were trying to log in as a troop (and not into a camper account) please make sure that you checked the appropriate radio button on the login form, and try again.</p>


<div class="form-group">
<label for='password-troop'>Troop Number:</label>
<input type='number' name='troop' placeholder=' troop' id='password-troop' class='form-control'>
</div>

<div class="form-group">
<label for="council">Council</label>
<select name='council' id='council' onChange='showOther()' class='form-control'>
	<option value='North East Illinois Council'>North East Illinois Council</option>
	<option value='other'>Other</option>
</select>
</div>


<input type='text' name='firstName' placeholder='First Name'>
<input type='text' name='lastName' placeholder='Last Name'>
<script type='text/javascript'>
function showOther() {
if (document.getElementById('council').value == 'other')
{
document.getElementById('other').innerHTML = '<input type="text" name="councilOther" placeholder="council" style="width:100%">';
}
else
{
document.getElementById('other').innerHTML = '';
}
}
</script>
<input type='hidden' name='page' value='scoutResetPasswordUsr'>
<div class="form-group">
<input type='submit' value='Fetch Username' class='btn btn-primary'>
</div>
</form>
</div>
<!-- /.well -->