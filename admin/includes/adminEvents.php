<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;
?>
<form method='post'>
<span id="formSpan">
<input type='text' name='name' class='form-control' placeholder='Event Name' style='width:67%;'><br/>
<input type='number' name='size' class='form-control' placeholder='Max Size' style='width:67%;' min='1'><br/>
<textarea name='description' class='form-control' placeholder='Enter a description of the event' style='width:67%;' rows='4'></textarea><br/>
<button type='button' class='btn btn-primary' onclick='newTime();' style='width:17.5%;'>More <span class='glyphicon glyphicon-plus-sign'></span></button>
<span style = 'width:33%; display:inline-block;'></span>
<button type='button' class='btn btn-danger' onclick='killTime();'style='width:17.5%;'>Less <span class='glyphicon glyphicon-minus-sign'></span></button><br/>
<span style = 'width:17.5%; display:inline-block;'><strong>Day</strong></span><span style = 'width:33%; display:inline-block;'><strong>Time</strong></span><span style = 'width:17.5%; display:inline-block;'><strong>Weeks</strong></span><br/>
<select name='day[]' class='form-control' style='width:17.5%; display:inline;'>
	<option value='1'>Mon</option>
	<option value='2'>Tue</option>
	<option value='3'>Wed</option>
	<option value='4'>Thu</option>
	<option value='5'>Fri</option>
	<option value='6'>Sat</option>
	<option value='7'>Sun</option>
</select>
<input type='time' name='time[]' class='form-control' value='12:00:00' style='width:33%; display:inline;'>
<table style='width:17.5%; display:inline-table'>
<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td><input type="checkbox" name="week10" value="1" checked></td><td><input type="checkbox" name="week20" value="1" checked></td><td><input type="checkbox" name="week30" value="1" checked></td><td><input type="checkbox" name="week40" value="1" checked></td><td><input type="checkbox" name="week50" value="1" checked></td><td><input type="checkbox" name="week60" value="1" checked></td></tr>
</table><br/>
</span>
<input type='hidden' name='page' value='adminEventAdd'>
<button type='submit' class='btn btn-primary' style='width:17.5%;'>Add Event <span class='glyphicon glyphicon-plus'></span></button>
</form>
<p>&nbsp; </p>
<p>&nbsp; </p>
<script>
function killTime()
{
	x=document.getElementsByClassName('moar');
	if (x.length > 0)
	{
		x=x[x.length-1];
		x.parentNode.removeChild(x);
	}
	parent.document.getElementById('iframe1').height = document.body.scrollHeight;
}
function newTime()
{
	y=document.createElement("SPAN");
	y.className = 'moar';
	document.getElementById('formSpan').appendChild(y);
	x=document.getElementsByClassName('moar');
	iter=x.length;
	x=x[x.length-1];
	x.innerHTML=x.innerHTML
+"<select name='day[]' class='form-control' style='width:17.5%; display:inline;'>"
+"	<option value=''>Day</option>"
+"	<option value='1'>Mon</option>"
+"	<option value='2'>Tue</option>"
+"	<option value='3'>Wed</option>"
+"	<option value='4'>Thu</option>"
+"	<option value='5'>Fri</option>"
+"	<option value='6'>Sat</option>"
+"	<option value='7'>Sun</option>"
+"</select> "
+"<input type='time' name='time[]' class='form-control' value='12:00:00' style='width:33%; display:inline;'> "
+"<table style='width:17.5%; display:inline-table'>"
+"<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>"
+"<tr><td><input type='checkbox' name='week1"+iter+"' value='1' checked></td><td><input type='checkbox' name='week2"+iter+"' value='1' checked></td><td><input type='checkbox' name='week3"+iter+"' value='1' checked></td><td><input type='checkbox' name='week4"+iter+"' value='1' checked></td><td><input type='checkbox' name='week5"+iter+"' value='1' checked></td><td><input type='checkbox' name='week6"+iter+"' value='1' checked></td></tr>"
+"</table></br>"
;
parent.document.getElementById('iframe1').height = document.body.scrollHeight;
}
  </script>
