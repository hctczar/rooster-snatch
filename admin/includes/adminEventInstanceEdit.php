<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;

$eventMetaID=mysql_real_escape_string($_POST['eventMetaID']);
$result=mysql_query("SELECT * FROM wp_eventsMeta WHERE id='".$eventMetaID."'");
$row=mysql_fetch_array($result);
$year=$row['year'];
$week=$row['week'];
$day=$row['day'];
$time=$row['time'];
$time= date("H:i:s",strtotime($time));
$enrollment=$row['enrollment'];
$liam=$row['taken'];
$eventID=mysql_real_escape_string($row["eventID"]);
$result=mysql_query("SELECT * FROM wp_events WHERE id='".$eventID."'");
$row=mysql_fetch_array($result);
$name=$row['name'];
$description=$row['description'];

function isSelected($num,$var)
{
	if ($var == $num) {return "selected";}
}
function isChecked($num,$var)
{
	if ($var == $num) {return "checked";}
}
?>

<form method='post'>
<span id="formSpan">
<h3>Event: <?php echo $name ?> </h3>
<span style = 'width:17.5%; display:inline-block;'><strong>Week</strong></span>
<span style = 'width:17.5%; display:inline-block;'><strong>Day</strong></span>
<span style = 'width:33%; display:inline-block;'><strong>Time</strong></span>
<span style = 'width:17.5%; display:inline-block;'><strong>Max. Size</strong></span>
<br/>
<table style='width:17.5%; display:inline-table'>
<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td><input type="radio" name="week" value="1" <?php echo isChecked(1,$week); ?>></td><td><input type="radio" name="week" value="2" <?php echo isChecked(2,$week); ?>></td><td><input type="radio" name="week" value="3" <?php echo isChecked(3,$week); ?>></td><td><input type="radio" name="week" value="4" <?php echo isChecked(4,$week); ?>></td><td><input type="radio" name="week" value="5" <?php echo isChecked(5,$week); ?>></td><td><input type="radio" name="week" value="6" <?php echo isChecked(6,$week); ?>></td></tr>
</table>
<select name='day' class='form-control' style='width:17.5%; display:inline;'>
	<option value='1' <?php echo isSelected(1,$day); ?>>Mon</option>
	<option value='2' <?php echo isSelected(2,$day); ?>>Tue</option>
	<option value='3' <?php echo isSelected(3,$day); ?>>Wed</option>
	<option value='4' <?php echo isSelected(4,$day); ?>>Thu</option>
	<option value='5' <?php echo isSelected(5,$day); ?>>Fri</option>
	<option value='6' <?php echo isSelected(6,$day); ?>>Sat</option>
	<option value='7' <?php echo isSelected(7,$day); ?>>Sun</option>
</select>
<input type='time' name='time' class='form-control' value='<?php echo $time; ?>' style='width:33%; display:inline;'>
<input type='number' name='enrollment' class='form-control' value='<?php echo $enrollment ?>' style='width:17.5%;  display:inline;' min='1'>
<br/>
</span>
<p> Fill out the form below if you want to send an email to all troops registered for this event. </p>
<script>tinymce.init({selector:"textarea.editME"});</script>
<textarea class="editME" name="emailBody" rows="16"></textarea>
<input type='hidden' name='page' value='adminEventInstanceEditIt'>
<input type='hidden' name='eventMetaID' value='<?php echo $eventMetaID; ?>'>
<button type='submit' class='btn btn-primary' style='width:17.5%;' name='toDo' value='edit'>Save Changes <span class='glyphicon glyphicon-pencil'></span></button>
<button type='submit' class='btn btn-danger' style='width:17.5%;' name='toDo' value='delete'>Delete Event <span class='glyphicon glyphicon-remove'></span></button>
</form>