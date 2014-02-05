<?php $active = $_SESSION["active"]; echo $adminMenu; ?>
<form method='post'>
<table class="table table-striped">
<tr><th>Badge</th><th>Cap</th></tr>
<?php
$result = mysql_query("SELECT * FROM wp_badges ORDER BY badge");
$visited = array();
$i=0;
while ($row = mysql_fetch_array($result))
{
	if (! in_array($row['badge'],$visited))
	{
		$visited[]=$row['badge'];
		echo "<tr><td><input type='hidden' name='badge".$i."' value='".$row['badge']."'>".$row['badge']."</td><td><input type='text' name = 'cap".$i."' value = '".$row['cap']."'class='form-control'></td></tr>";
		$i++;
	}
}
?>
</table>
<input type='hidden' name='page' value='adminBadgeCapUpdate'>
<button type='submit' value='add' class='btn btn-primary'>Update Caps <span class='glyphicon glyphicon-floppy-save'></span></button>
</form>