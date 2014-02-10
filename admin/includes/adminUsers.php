<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;
?>
<table class='table table-striped'>
<tr><th>Name</th><th>Email</th><th>Level</th><th></th></tr>
<?php
$edit_button = '<button type="submit" value="edit" class="btn btn-primary" style="width:6em;"><span class="glyphicon glyphicon-pencil"></span> Edit</button>';
$delete_button = '<button type="submit" value="delete" class="btn btn-danger" style="width:6em;"><span class="glyphicon glyphicon-remove"></span> Delete</button>';
$result = mysql_query("SELECT * FROM wp_admins ORDER BY lastName, firstName");
while ($row = mysql_fetch_array($result))
{
	$ID = $row['id'];
	echo "<tr>
	<td>".$row['firstName']." ".$row['lastName']."</td>
	<td>".$row['email']."</td><td>".$row['role']."</td>
	<td><form method='post' style='display:inline;'>
		<input type='hidden' name='user' value='".$ID."'>
		<input type='hidden' name='page' value='adminUsersEdit'>"
		.$edit_button."
		</form>
		<form method='post' style='display:inline;'>
		<input type='hidden' name='user' value='".$ID."'>
		<input type='hidden' name='page' value='adminUsersDelete'>"
		.$delete_button."
		</form>
	</td></tr>";
}
?>
</table>

<form method="post">
<div class="input-group">
  <span class="input-group-addon" style="width:8em;">First Name: </span>
  <input type="text" class="form-control" name="firstName" style="width:16em;">
</div>
<div class="input-group">
  <span class="input-group-addon" style="width:8em;">Last Name: </span>
  <input type="text" class="form-control" name="lastName" style="width:16em;">
</div>
<div class="input-group">
  <span class="input-group-addon" style="width:8em;">Email: </span>
  <input type="email" class="form-control" name="email" style="width:16em;">
</div>
<div class="input-group">
	<span class="input-group-addon" style="width:8em;">Role: </span>
    <select name="role" class="form-control" style="width:16em;">
        <option value = "east commissioner">east commissioner</option>
        <option value = "west commissioner">west commissioner</option>
	    <option value = "east director">east director</option>
        <option value = "west director">west director</option>
        <option value = "reservation director">reservation director</option>
    	<option value = "seacaptain">seacaptain</option>
    </select>
</div>
<input type="hidden" name="page" value="adminUsersAdd">
<button type="submit" value="save" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add</button>
</form>