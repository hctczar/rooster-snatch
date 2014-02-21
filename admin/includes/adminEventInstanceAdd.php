<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;
$eventID=mysql_real_escape_string($_POST['eventID']);
$result=mysql_query("SELECT * FROM wp_events WHERE id='".$eventID."'");
$row=mysql_fetch_array($result);
$name=$row['name'];
$description=$row['description'];

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
<tr><td><input type="radio" name="week"></td><td><input type="radio" name="week" value="2"></td><td><input type="radio" name="week" value="3"></td><td><input type="radio" name="week" value="4" ></td><td><input type="radio" name="week" value="5" ></td><td><input type="radio" name="week" value="6"></td></tr>
</table>
<select name='day' class='form-control' style='width:17.5%; display:inline;'>
	<option value='1' >Mon</option>
	<option value='2' >Tue</option>
	<option value='3' >Wed</option>
	<option value='4' >Thu</option>
	<option value='5' >Fri</option>
	<option value='6' >Sat</option>
	<option value='7' >Sun</option>
</select>
<input type='time' name='time' class='form-control' value='12:00:00' style='width:33%; display:inline;'>
<input type='number' name='enrollment' class='form-control' value='0' style='width:17.5%;  display:inline;' min='1'>
<br/>
</span>
<input type='hidden' name='page' value='adminEventInstanceAddIt'>
<input type='hidden' name='eventID' value='<?php echo $eventID; ?>'>
<button type='submit' class='btn btn-primary' style='width:17.5%;' name='toDo' value='edit'>Add Instance <span class='glyphicon glyphicon-plus'></span></button>
</form>