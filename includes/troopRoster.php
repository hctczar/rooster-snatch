<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
//check if troop has 0,1, or 2 weeks in troopsMeta, updates those weeks accordingly
$result = mysql_query("SELECT * FROM wp_troopsMeta WHERE (troopID = '".mysql_real_escape_string($active)."' and year = '".mysql_real_escape_string($_SESSION["year"])."') ORDER BY week");
$week1 = 0;
$week2 = 0;

$edit_button = '<button type="submit" value="edit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Edit</button>';
$delete_button = '<button type="submit" value="delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete</button>';
$no_mb_icon = '<span class="label label-warning">No Badges</span>';
$yes_mb_icon = '<span class="label label-success">Signed Up</span>';


if ($row = mysql_fetch_array($result))
{
	$week1 = $row["week"];
}
if ($row = mysql_fetch_array($result))
{
	$week2 = $row["week"];
}
echo $troopMenu;
//downloads troop Roster
echo "<button type='submit' value='Download Roster' class='btn btn-primary' onclick='download();'>Download Roster <span class='glyphicon glyphicon-download-alt'></span></button><br/><br/>";
//prints campers in first week troop is camping for.
echo "<table class='table table-striped'>";
echo "<tr><th colspan='6'>Week $week1</th></tr>";
$result = mysql_query("SELECT * FROM wp_roster WHERE (troopID = '".mysql_real_escape_string($active)."' and youth = '0' and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week1)."') ORDER BY lastName, firstName");
while ($row = mysql_fetch_array($result))
{
	$ID = $row['camperID'];
	echo "<tr><td>".stripslashes($row['lastName']).", ".stripslashes($row['firstName'])." (Adult)</td><td>Week ".$week1."<td/><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='active' value='".$active."'><input type='hidden' name='page' value='troopRosterEdit'>$edit_button</form></td><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='page' value='troopRosterDelete'><input type='hidden' name='week' value='".$week1."'>$delete_button</form></td><td></td></tr>";
}
$result = mysql_query("SELECT * FROM wp_roster WHERE (troopID = '".mysql_real_escape_string($active)."' and youth = 1 and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week1)."') ORDER BY lastName,firstName");
while ($row = mysql_fetch_array($result))
{
	$ID = $row['camperID'];
	//Check if the scout has registered for badges
	$hasSigned = $no_mb_icon;
	$result1 = mysql_query("SELECT * FROM wp_signups WHERE (backup = '0' AND scoutID = '".mysql_real_escape_string($ID)."' and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week1)."')");
	$row1 = mysql_fetch_array($result1);
	if (is_array($row1))
	{
		$hasSigned = $yes_mb_icon;
	}
	//stop checking if the scout has registered for badges
	echo "<tr><td>".stripslashes($row['lastName']).", ".stripslashes($row['firstName'])." (Youth)</td><td>Week ".$week1."<td/><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='active' value='".$active."'><input type='hidden' name='page' value='troopRosterEdit'>$edit_button</form></td><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='page' value='troopRosterDelete'><input type='hidden' name='week' value='".$week1."'>$delete_button</form></td><td>$hasSigned</td></tr>";
}
echo "</table>";
//if troops signed up for 2 weeks, prints second week campers
if ($week2 != 0)
{
	echo "<table class='table table-striped'>";
	echo "<tr><th colspan='6'>Week $week2</th></tr>";
	$result = mysql_query("SELECT * FROM wp_roster WHERE (troopID = '".mysql_real_escape_string($active)."' and youth = 0 and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week2)."') ORDER BY lastName,firstName");
	while ($row = mysql_fetch_array($result))
	{
		$ID = $row['camperID'];
		echo "<tr><td>".stripslashes($row['lastName']).", ".stripslashes($row['firstName'])." (Adult)</td><td>Week ".$week2."<td/><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='active' value='".$active."'><input type='hidden' name='page' value='troopRosterEdit'>$edit_button</form></td><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='page' value='troopRosterDelete'><input type='hidden' name='week' value='".$week2."'>$delete_button</form></td><td></td></tr>";
	}
	$result = mysql_query("SELECT * FROM wp_roster WHERE (troopID = '".mysql_real_escape_string($active)."' and youth = 1 and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week2)."') ORDER BY lastName,firstName");
	while ($row = mysql_fetch_array($result))
	{
		$ID = $row['camperID'];
		//Check if the scout has registered for badges
		$hasSigned =$no_mb_icon;
		$result1 = mysql_query("SELECT * FROM wp_signups WHERE (scoutID = '".mysql_real_escape_string($ID)."' and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week2)."')");
		$row1 = mysql_fetch_array($result1);
		if (is_array($row1))
		{
			$hasSigned = $yes_mb_icon;
		}
		//stop checking if the scout has registered for badges
		echo "<tr><td>".stripslashes($row['lastName']).", ".stripslashes($row['firstName'])." (Youth)</td><td>Week ".$week2."<td/><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='active' value='".$active."'><input type='hidden' name='page' value='troopRosterEdit'>$edit_button</form></td><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='page' value='troopRosterDelete'><input type='hidden' name='week' value='".$week2."'>$delete_button</form></td><td>$hasSigned</td></tr>";
	}
	echo "</table>";
}
echo getCopy("add_scouts");
$rosterAdder = str_replace("##week1##",$week1,$rosterAdder);
//deletes extra week column if not applicable
if ($week2 == 0)
{
	$rosterAdder = str_replace("<td align='center'>Week ##week2##</td>","",$rosterAdder);
	$rosterAdder = preg_replace("/<td><input type='checkbox' name='week2.*' value='##week2##' checked><\/td>/U","",$rosterAdder);
	//str_replace("<td><input type='checkbox' name='week2".$iter."' value='##week2##' checked></td>","",$rosterAdder);
}
$rosterAdder = str_replace("##week2##",$week2,$rosterAdder);
echo $rosterAdder;
?>

<?php
$csvbuilder = 'Week,First Name,Last Name,Y/A%0A';
$result = mysql_query("SELECT * FROM wp_roster WHERE year = '".$year."' and troopID = '".$active."' ORDER BY week, youth, lastName, firstName");
while ($row = mysql_fetch_array($result))
{
	$week = $row['week'];
	$first = stripslashes($row['firstName']);
	$last = stripslashes($row['lastName']);
	if ($row['youth']) {$youth="Youth";}
	else {$youth="Adult";}
	$csvbuilder .= '"'.$week.'","'.$first.'","'.$last.'","'.$youth.'"%0A';
}
?>
<script>
function download()
{
	var csvString = '<?php echo $csvbuilder; ?>';
	var a         = document.createElement('a');
	a.href        = 'data:attachment/csv,' + encodeURIComponent(csvString).replace(/%250A/g,'%0A');
	a.target      = '_blank';
	a.download    = 'roster.csv';
	
	document.body.appendChild(a);
	a.click();
}
</script>