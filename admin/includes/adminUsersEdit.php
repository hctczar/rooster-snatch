<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;
$adminID = mysql_real_escape_string($_POST['user']);
$result = mysql_query("SELECT * FROM wp_admins WHERE id = '".$adminID."'");
$row = mysql_fetch_array($result);
$firstName = $row['firstName'];
$lastName = $row['lastName'];
$email = $row['email'];
$role = $row['role'];
function isSelected($value)
{
	global $role;
	if ($value == $role){return "selected";}
	else {return "";}
}
?>

<form method="post">
<div class="input-group">
  <span class="input-group-addon" style="width:8em;">First Name: </span>
  <input type="text" class="form-control" name="firstName" style="width:16em;" value="<?php echo $firstName?>">
</div>
<div class="input-group">
  <span class="input-group-addon" style="width:8em;">Last Name: </span>
  <input type="text" class="form-control" name="lastName" style="width:16em;" value="<?php echo $lastName?>">
</div>
<div class="input-group">
  <span class="input-group-addon" style="width:8em;">Email: </span>
  <input type="email" class="form-control" name="email" style="width:16em;"  value="<?php echo $email?>">
</div>
<div class="input-group">
	<span class="input-group-addon" style="width:8em;">Role: </span>
    <select name="role" class="form-control" style="width:16em;">
        <option value = "east commissioner" <?php echo isSelected("east commissioner"); ?>>east commissioner</option>
        <option value = "west commissioner" <?php echo isSelected("west commissioner"); ?>>west commissioner</option>
	    <option value = "east director" <?php echo isSelected("east director"); ?>>east director</option>
        <option value = "west director" <?php echo isSelected("west director"); ?>>west director</option>
        <option value = "reservation director" <?php echo isSelected("reservation director"); ?>>reservation director</option>
    	<option value = "seacaptain" <?php echo isSelected("seacaptain"); ?>>seacaptain</option>
    </select>
</div>
<input type="hidden" name="adminID" value="<?php echo $adminID ?>">
<input type="hidden" name="page" value="adminUserEditor">
<button type="submit" value="save" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Save</button>
</form>