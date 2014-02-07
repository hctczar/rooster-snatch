<?php $active = $_SESSION["active"]; echo $adminMenu; ?>
<button class='btn btn-primary' onclick="viewTable();">View / Hide Badgers</button><br/><br/>
<script>
function viewTable()
{
	if (document.getElementById('badgeList').style.display == 'none'){document.getElementById('badgeList').style.display = 'block';}
	else {document.getElementById('badgeList').style.display = 'none';}
	parent.document.getElementById('iframe1').height = "1666px";
	parent.document.getElementById('iframe1').height = document.body.scrollHeight;
}
</script>
<div id ='badgeList' style="display:none">
<p>To filter the list, use the dropdown menus and textboxes above each column. You can show multiple merit badges at a time: just type them all out separated by commas.</p>
<script>
function filterTable()
{
	filterBadge = document.getElementById('filterBadge').value;
	var filterBadges = filterBadge.split(", ");
	filterArea = document.getElementById('filterArea').value;
	filterCamp = document.getElementById('filterCamp').value;
	filterBlock = document.getElementById('filterBlock').value;
	var filterBlocks = filterBlock.split(", ");
	var badgeRows = document.getElementsByClassName('badge-row');
	for (var i=0;i<badgeRows.length;i++)
	{
		var invisiblize=true;
		var visBadge = false;
		var visArea = false;
		var visCamp = false;
		var visBlock = false;
		if (filterBadge != "")
		{
			for (var j=0;j<filterBadges.length;j++)
			{
				if (badgeRows[i].getAttribute('badge').indexOf(filterBadges[j]) != -1){visBadge=true;}
			}
		}
		else {visBadge=true;}
		if (filterArea != "all")
		{
			if (badgeRows[i].getAttribute('area') == filterArea){visArea=true;}
		}
		else{visArea=true;}
		if (filterCamp != "all")
		{
			if (badgeRows[i].getAttribute('camp')[0].toUpperCase() + badgeRows[i].getAttribute('camp').slice(1) == filterCamp){visCamp=true;}
		}
		else{visCamp=true;}
		if (filterBlock !="")
		{
			for (var j=0;j<filterBlocks.length;j++)
			{
				if (badgeRows[i].getAttribute('block').indexOf(filterBlocks[j]) != -1){visBlock=true;}
			}
		}
		else {visBlock = true;}
		if (visBadge && visArea && visCamp && visBlock){invisiblize=false;}
		if (invisiblize){badgeRows[i].style.display = 'none';}
		if (!invisiblize){badgeRows[i].style.display = 'table-row';}
	}
	parent.document.getElementById('iframe1').height = "1666px";
	parent.document.getElementById('iframe1').height = document.body.scrollHeight;
}
</script>
<table class="table table-striped sortable">
<tr><th><input type='text' id='filterBadge' onchange='filterTable();' class='form-control'>Badger</th><th><select id='filterArea' onchange='filterTable();' class='form-control'><option value='all'>All</option><?php echo getOptions("program_areas"); ?></select>Area</th><th><select id='filterCamp' onchange='filterTable();' class='form-control'><option value='all'>All</option><?php echo getOptions("camps"); ?></select>Camp</th><th><input type='text' id='filterBlock' onchange='filterTable();' style='width:4em' class='form-control'>Block</th><th class='sorttable_nosort'>Conflicts With</th><th class='sorttable_nosort'>Delete</th></tr>
<?php
//get list-o-badges from the database and print as a row.
$result = mysql_query("SELECT * FROM wp_badges");
while ($row = mysql_fetch_array($result))
{
	echo "<tr class='badge-row' badge='".$row["badge"]."' area = '".$row["Area"]."' camp = '".$row["camp"]."' block = '".$row["block"]."'>
	<td>".$row["badge"]."</td>
	<td>".$row["Area"]."</td>
	<td>".$row["camp"]."</td>
	<td>".$row["block"]."</td>
	<td>".$row["conflicts"]."</td>
	<td><form method='post'><input type='hidden' name='page' value='adminBadgeDelete'><input type='hidden' name='badgeID' value='".$row["id"]."'><button type='submit' value='delete' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span></button></form></td>
	</tr>";
}
?>
</table>
</div>

<p>To add badges, fill out all the information below. You can add up to 20 at a time. The "conflicts with" column is used for badges that take up more than one time slot. For example, the 'A' trailblazer session conflicts with 'B'. To register a conflict, enter the conflicting blocks as capital letters. No need for commas.</p>
<form method = 'post'>
<table class="table table-striped">
<tr><th>Badger</th><th>Area</th><th>Camp</th><th>Block</th><th>Conflicts With</th></tr>
<?php 
for ($i = 0; $i < 20 ; $i++)
{
	echo "<tr>
	<td><input type='text' name='badge".$i."'></td>
	<td><select name = 'area".$i."' >".getOptions("program_areas")."</select></td>
	<td><select name = 'camp".$i."' >".getOptions("camps", false)."</select></td>
	<td><table><tr><th>A</th><th>B</th><th>C</th><th>D</th></tr><td><input type='radio' name='block".$i."' value='A'></td><td><input type='radio' name='block".$i."' value='B'></td><td><input type='radio' name='block".$i."' value='C'></td><td><input type='radio' name='block".$i."' value='D'></td><tr></tr></table></td>
	<td><input type='text' name='conflicts".$i."' placeholder = 'ABCD'></td></tr>";
}
?>
</table>
<input type='hidden' name='page' value='adminBadgeAdd'>
<button type='submit' value='add' class='btn btn-primary'>Add Badges <span class='glyphicon glyphicon-plus'></span></button>
</form>