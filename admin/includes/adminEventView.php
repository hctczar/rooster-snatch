<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;
?>
<p>Select an event below to view enrollment, manage troop payments, and change event details.</p>
<?php
$result=mysql_query("SELECT * FROM wp_events ORDER BY name");
while ($row=mysql_fetch_array($result))
{
	echo '
	<form method="post">
	<button name="page" class="btn btn-default" value="adminEventInstance" type="submit" style="width:10em">'.$row['name'].'</button>
	<input type="hidden" name="eventID" value="'.$row['id'].'"/>
	</form>
	';
}
?>
