<?php
echo str_replace("##special##","",$kennyloggin);
?>
<div class="well">
<form method='post'>
<?php echo getCopy('admin_pwd_reset'); ?>
<div class="input-group">
    <input type="text" name="username" class="form-control" placeholder="Username">
    <span class="input-group-btn"><button type="submit" class="btn" id="submit" name="page" value="adminResetPasswordPwd">Reset Password</button></span>
</div>
</form>
</div>
<div class="well">
<form method='post'>
<?php echo getCopy('admin_usr_reset'); ?>
<input type="text" name="firstName" class="form-control" placeholder="First Name" style="width:45%; display:inline-block;">
<input type="text" name="lastName" class="form-control" placeholder="Last Name" style="width:45%; display:inline-block;">
<span class="input-group-btn"><button type="submit" class="btn" id="submit" name="page" value="adminResetPasswordUsr">Fetch Username</button></span>
</form>
</div>
