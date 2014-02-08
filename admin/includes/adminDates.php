<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;
?>
<table class = "table table-striped">
<form method = "post">
<tr><th>Description</th><th>Date</th></tr>
<?php
$result = mysql_query("SELECT * FROM wp_dates ORDER BY date");
while ($row = mysql_fetch_array($result))
{
	echo '<tr><td>'.stripslashes($row['description']).'</td><td><input type="date" name = "date[]" value="'.stripslashes($row['date']).'"><input type="hidden" name="dateID[]" value="'.$row['id'].'"></td></tr>';
}
?>
<tfoot><tr><td colspan = "2" align = "right"><input type="hidden" name="page" value="adminDatesUpdate"><button type="submit" value="save" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Save</button></td></tr></tfoot>
</form></table>