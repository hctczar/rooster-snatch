<?php
$active = $_SESSION["active"];
//check if troop has 0,1, or 2 weeks in troopsMeta, updates those weeks accordingly
$result = mysql_query("SELECT * FROM wp_troopsMeta WHERE (troopID = '".mysql_real_escape_string($active)."' and year = '".mysql_real_escape_string($_SESSION["year"])."') ORDER BY week");
$week1 = 0;
$week2 = 0;
if ($row = mysql_fetch_array($result))
{
	$week1 = $row["week"];
}
if ($row = mysql_fetch_array($result))
{
	$week2 = $row["week"];
}
echo $troopMenu;
//prints campers in first week troop is camping for.
echo "<table class='table table-striped' style='width:42em'>";
echo "<tr><th colspan='6'>Week $week1</th></tr>";
$result = mysql_query("SELECT * FROM wp_roster WHERE (troopID = '".mysql_real_escape_string($active)."' and youth = '0' and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week1)."') ORDER BY lastName, firstName");
while ($row = mysql_fetch_array($result))
{
	$ID = $row['camperID'];
	echo "<tr><td>".stripslashes($row['lastName']).", ".stripslashes($row['firstName'])." (Adult)</td><td>Week ".$week1."<td/><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='active' value='".$active."'><input type='hidden' name='page' value='troopRosterEdit'><input type='submit' class='btn' value='edit' style='width:8em'></form></td><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='page' value='troopRosterDelete'><input type='hidden' name='week' value='".$week1."'><input type='submit' value='delete' class='btn btn-danger' style='width:8em'></form></td><td></td></tr>";
}
$result = mysql_query("SELECT * FROM wp_roster WHERE (troopID = '".mysql_real_escape_string($active)."' and youth = 1 and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week1)."') ORDER BY lastName,firstName");
while ($row = mysql_fetch_array($result))
{
	$ID = $row['camperID'];
	//Check if the scout has registered for badges
	$hasSigned = "<img src='http://www.makajawan.com/assets/redEx.gif' alt='Scout needs to register for badges' width = '32' height='32'>";
	$result1 = mysql_query("SELECT * FROM wp_signups WHERE (scoutID = '".mysql_real_escape_string($ID)."' and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week1)."')");
	$row1 = mysql_fetch_array($result1);
	if (is_array($row1))
	{
		$hasSigned = "<img src='http://www.makajawan.com/assets/greenCheck.gif' alt='Scout has registered for badges' width = '32' height='32'>";
	}
	//stop checking if the scout has registered for badges
	echo "<tr><td>".stripslashes($row['lastName']).", ".stripslashes($row['firstName'])." (Youth)</td><td>Week ".$week1."<td/><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='active' value='".$active."'><input type='hidden' name='page' value='troopRosterEdit'><input class='btn' type='submit' value='edit' style='width:8em'></form></td><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='page' value='troopRosterDelete'><input type='hidden' name='week' value='".$week1."'><input type='submit' value='delete' class='btn btn-danger' style='width:8em'></form></td><td>$hasSigned</td></tr>";
}
echo "</table>";
//if troops signed up for 2 weeks, prints second week campers
if ($week2 != 0)
{
	echo "<table class='table table-striped' style='width:42em'>";
	echo "<tr><th colspan='6'>Week $week2</th></tr>";
	$result = mysql_query("SELECT * FROM wp_roster WHERE (troopID = '".mysql_real_escape_string($active)."' and youth = 0 and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week2)."') ORDER BY lastName,firstName");
	while ($row = mysql_fetch_array($result))
	{
		$ID = $row['camperID'];
		echo "<tr><td>".stripslashes($row['lastName']).", ".stripslashes($row['firstName'])." (Adult)</td><td>Week ".$week2."<td/><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='active' value='".$active."'><input type='hidden' name='page' value='troopRosterEdit'><input class='btn' type='submit' value='edit' style='width:8em'></form></td><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='page' value='troopRosterDelete'><input type='hidden' name='week' value='".$week2."'><input type='submit' class='btn btn-danger' value='delete' style='width:8em'></form></td><td></td></tr>";
	}
	$result = mysql_query("SELECT * FROM wp_roster WHERE (troopID = '".mysql_real_escape_string($active)."' and youth = 1 and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week2)."') ORDER BY lastName,firstName");
	while ($row = mysql_fetch_array($result))
	{
		$ID = $row['camperID'];
		//Check if the scout has registered for badges
		$hasSigned = "<img src='http://www.makajawan.com/assets/redEx.gif' alt='Scout needs to register for badges' width = '32' height='32'>";
		$result1 = mysql_query("SELECT * FROM wp_signups WHERE (scoutID = '".mysql_real_escape_string($ID)."' and year = '".mysql_real_escape_string($_SESSION["year"])."' and week = '".mysql_real_escape_string($week2)."')");
		$row1 = mysql_fetch_array($result1);
		if (is_array($row1))
		{
			$hasSigned = "<img src='http://www.makajawan.com/assets/greenCheck.gif' alt='Scout has registered for badges' width = '32' height='32'>";
		}
		//stop checking if the scout has registered for badges
		echo "<tr><td>".stripslashes($row['lastName']).", ".stripslashes($row['firstName'])." (Youth)</td><td>Week ".$week2."<td/><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='active' value='".$active."'><input type='hidden' name='page' value='troopRosterEdit'><input class='btn' type='submit' value='edit' style='width:8em'></form></td><td align='middle'><form method='post'><input type='hidden' name='camper' value='".$ID."'><input type='hidden' name='page' value='troopRosterDelete'><input type='hidden' name='week' value='".$week2."'><input type='submit' class='btn btn-danger' value='delete' style='width:8em'></form></td><td>$hasSigned</td></tr>";
	}
	echo "</table>";
}
echo "<p> To add scouts or leaders to your roster, enter their names below, one camper per line, and then click the button labeled 'add campers'. If you have more campers than there are lines, simply add 20 campers at a time</p>";
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