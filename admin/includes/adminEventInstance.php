<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;
if (! isset($eventID)){$eventID=mysql_real_escape_string($_POST['eventID']);}
$result = mysql_query("SELECT * FROM wp_events WHERE id='".$eventID."'");
$row=mysql_fetch_array($result);
$eventName=$row["name"];
if (isset($alerts)){echo $alerts;}
?>
<p>The following table shows all times that <?php echo $eventName;?> will be offered in the summer of <?php echo $_SESSION["year"];?>. If troops are enrolled in that event, they will be listed below the event time. Though MyKaJaWan does not currently support online payments, if a troop has paid for an event, you can submit the payment form below to make sure that our database reflects this.</p>
<p>If you would like to add an additional time that <?php echo $eventName;?> will be offered, click the "Add Instance" button right below this paragraph </p>
<form method="post">
<input type='hidden' name='eventID' value='<?php echo $eventID;?>'>
<button 
    type="submit" 
    value="adminEventInstanceAdd"
    name="page" class="btn btn-primary"
>
    <span
        class="glyphicon glyphicon-plus"
    >
    </span>
     Add Instance
</button>
</form>
<br/>
<input type="search" class="light-table-filter" data-table="order-table" placeholder="Week">
<br/>
<table class="table order-table">
<thead><tr><th>Week</th><th>Day</th><th>Time</th><th>Capacity</th><th></th><th></th></tr></thead>
<?php
$result=mysql_query("SELECT * FROM wp_eventsMeta WHERE year='".$_SESSION["year"]."' AND eventID='".$eventID."' ORDER BY week, day, time");
while ($row=mysql_fetch_array($result))
{
	$showPlus="display:none;";
	if ($row['taken']>0)
	{
		$showPlus="display:inline;";
	}
	$dows= array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
	echo '
	<tr class="filterable">
	<td>'.$row['week'].'</td>
	<td>'.$dows[$row['day']].'</td>
	<td>'.date("g:ia",strtotime($row['time'])).'</td>
	<td>'.$row['taken'].'/'.$row['enrollment'].'</td>
	<td><form method="post">
		<input 
			type="hidden" 
			name="eventMetaID" 
			value="'.$row['id'].'"
		>
		<button 
			type="submit" 
			value="adminEventRegisterTroop"
			name="page" class="btn btn-primary"
		>
			<span
				class="glyphicon glyphicon-plus"
			>
			</span>
			 Add Troop
		</button>
	</form></td>
	<td><form method="post">
		<input 
			type="hidden" 
			name="eventMetaID" 
			value="'.$row['id'].'"
		>
		<button 
			type="submit" 
			value="adminEventInstanceEdit"
			name="page" class="btn btn-primary"
		>
			<span
				class="glyphicon glyphicon-pencil"
			>
			</span>
			 Edit
		</button>
	</form></td>
	<td>
		<span 
			onclick="hideTroops('.$row['id'].');" 
			id="minus'.$row['id'].'" 
			style="display:none;"
		>
			-
		</span>
		<span 
			onclick="showTroops('.$row['id'].');" 
			id="plus'.$row['id'].'" 
			style="'.$showPlus.'"
		>
			+
		</span>
	</td>
	</tr>
	';
	$result1=mysql_query("SELECT * FROM wp_eventsSigned WHERE eventMetaID='".$row['id']."' ORDER BY troopID");
	$hasTroops=FALSE;
	if($row1=mysql_fetch_array($result1))
	{
		$result2=mysql_query("SELECT * FROM wp_troops WHERE id='".$row1['troopID']."'");
		$row2=mysql_fetch_array($result2);
		$troop=$row2['number'];
		$hasTroops=TRUE;
		echo '
	<tr
		style="display:none;"
		id="troops'.$row['id'].'"
	>
	<td></td>
	<td colspan="6">
		<table class="table table-striped" style="display:inline-table;">
		<tr>
			<th>Troop</th>
			<th>Registered</th>
			<th>Paid</th>
		</tr>
		<tr>
			<td>'.$troop.'</td>
			<td>'.$row1['registered'].'</td>
			<td>paid</td>
		</tr>
		';
	}
	while ($row1=mysql_fetch_array($result1))
	{
		echo '
		<tr>
			<td>'.$troop.'</td>
			<td>'.$row1['registered'].'</td>
			<td>paid</td>
		</tr>
		';
	}
	if ($hasTroops)
	{
		echo '
		</table>
	</td>
	</tr>';
	}
}
?>
</table>
<p>&nbsp; </p>
<p>&nbsp; </p>
<script>
var options = {
    valueNames: [ 'name', 'city' ]
};

var hackerList = new List('hacker-list', options);
function showTroops(id)
{
	document.getElementById('troops'+id).style.display='';
	document.getElementById('plus'+id).style.display='none';
	document.getElementById('minus'+id).style.display='';
	parent.document.getElementById("iframe1").height = "493px";
	parent.document.getElementById("iframe1").height = document.body.scrollHeight;
}
function hideTroops(id)
{
	document.getElementById('troops'+id).style.display='none';
	document.getElementById('plus'+id).style.display='';
	document.getElementById('minus'+id).style.display='none';
	parent.document.getElementById("iframe1").height = "493px";
	parent.document.getElementById("iframe1").height = document.body.scrollHeight;
}

(function(document) {
	'use strict';

	var LightTableFilter = (function(Arr) {

		var _input;

		function _onInputEvent(e) {
			_input = e.target;
			var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
			Arr.forEach.call(tables, function(table) {
				Arr.forEach.call(table.tBodies, function(tbody) {
					Arr.forEach.call(tbody.rows, _filter);
				});
			});
		}

		function _filter(row) {
			if (row.className=='filterable')
			{
				var text = row.children[0].textContent.toLowerCase(), val = _input.value.toLowerCase();
				row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
				parent.document.getElementById("iframe1").height = "493px";
				parent.document.getElementById("iframe1").height = document.body.scrollHeight;
			}
		}

		return {
			init: function() {
				var inputs = document.getElementsByClassName('light-table-filter');
				Arr.forEach.call(inputs, function(input) {
					input.oninput = _onInputEvent;
				});
			}
		};
	})(Array.prototype);

	document.addEventListener('readystatechange', function() {
		if (document.readyState === 'complete') {
			LightTableFilter.init();
		}
	});

})(document);
  </script>
