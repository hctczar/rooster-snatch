<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;
?>
<form method = "post" enctype="multipart/form-data">
<div class="well" id="troopWell">
<p><strong> Enter a troop number to send to a single troop.</strong></p>
Troop: <input type="text" name="troopNumber" class="form-control" style="display:inline; width:5em;" id="troopNumber" onChange="hideMultiples();">

<select name="council" class="form-control" style="display:inline; width:20em;"><?php echo getOptions('councils',false); ?></select>

</div>
<p align = "center" id="bigO"><strong>OR</strong></p>
<div class="well" id="multiplesWell">
<p><strong> Select options below to limit the emails to troops that meet those criteria.</strong></p>
Troops staying in: <select name="camp" class="form-control" style="width:20em; display:inline;"><option value = ''>All</option> <?php echo getOptions('camps',false) ?></select><br/>
Troops camping during weeks: <table style="display:inline-table"><tr><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th></tr><tr>
<td><input type="checkbox" name="week[]" value="1" checked></td>
<td><input type="checkbox" name="week[]" value="2" checked></td>
<td><input type="checkbox" name="week[]" value="3" checked></td>
<td><input type="checkbox" name="week[]" value="4" checked></td>
<td><input type="checkbox" name="week[]" value="5" checked></td>
<td><input type="checkbox" name="week[]" value="6" checked></td></tr></table><br/>
Troops camping for at least <input type="number" value = "1" min="0" max="6" name="weeksCamping" id="weeksCamping" class="form-control" style="width:4em; display:inline;" onChange="pluralize();"> week<span id="plural"></span>. <br/>
<?php
$eventOptions = '';
$result = mysql_query("SELECT * FROM wp_events ORDER BY name");
while ($row = mysql_fetch_array($result))
{
	$eventOptions .= '<option value = "'.$row['id'].'">'.$row['name'].'</option>';
}
?>
Troops registered for <select name="event" class="form-control" style="width:20em; display:inline;"><option value = ''>Any or No</option><?php echo $eventOptions; ?></select> event.<br/>
</div>
<div class="well" id="emailWell">
<p><strong> Compose your email below</strong></p>
<div class="input-group">
  <span class="input-group-addon">Subject:</span>
  <input type="text" name="emailSubject" class="form-control" placeholder="A subject line for the email">
</div>
<div class="input-group">
  <span class="input-group-addon">Sender:</span>
  <input type="text" name="emailSender" class="form-control" value="MyKaJaWan@makajawan.com" placeholder="The email address that the message will be sent from">
</div>
<span id="attachments">
<div class="input-group attachment">
  <span class="input-group-addon">Attach:</span>
  <input type="file" name="file[]" id="file" class="form-control" onchange="moreAttachments();">
  <span class="input-group-addon glyphicon glyphicon-remove" onclick="clearAttach(this);"></span>
</div>
</span>
<script>tinymce.init({selector:"textarea.editME"});</script>
<textarea class="editME" name="emailBody" rows="16"></textarea>
<input type="hidden" name="page" value="adminEmailConfirm"><br/>
<button type="submit" value="send" class="btn btn-primary" style="width:100%;"><span class="glyphicon glyphicon-send"></span> Send</button>
</div>
<script>
function clearAttach(caller)
{
	caller.parentElement.children[1].value='';
	moreAttachments();
}
function moreAttachments()
{	
	x=document.getElementsByClassName('attachment');
	attachements = 0;
	slots = x.length;
	for (i = 0 ; i < x.length ; i++)
	{
		if (typeof x[i].children[1].value != 'undefined' && x[i].children[1].value == '')
		{
			x[i].parentNode.removeChild(x[i]);
			slots -= 1;
		}
		if (typeof x[i] != 'undefined' && x[i].children[1].value != '')
		{
			attachements += 1;
		}
	}
	if (slots <= attachements)
	{
		y=document.createElement("DIV");
		y.className="input-group attachment";
		y.innerHTML='<span class="input-group-addon">Attach:</span><input type="file" name="file[]" id="file" class="form-control" onchange="moreAttachments();"><span class="input-group-addon glyphicon glyphicon-remove" onclick="clearAttach(this);"></span>';
		document.getElementById("attachments").appendChild(y);
	}
parent.document.getElementById('iframe1').height = document.body.scrollHeight;
}
function pluralize()
{
	//this function adds an 's' next to the word 'week' if the number before 'week' != '1.' This is how English works
	x=document.getElementById('weeksCamping').value;
	if (x != 1){document.getElementById("plural").innerHTML='s';}
	else {document.getElementById("plural").innerHTML='';}
}
function hideMultiples()
{
	//this function shows or hides the filter options. It hides them if a single troop # has been entered
	x=document.getElementById('troopNumber');
	if (x.value.replace(/\s+/g, "") == "")
	{
		document.getElementById('multiplesWell').style.display="block";
		document.getElementById('bigO').style.display="block";
	}
	else
	{
		document.getElementById('multiplesWell').style.display="none";
		document.getElementById('bigO').style.display="none";
	}
}
</script>
</form>