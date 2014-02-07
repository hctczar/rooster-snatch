<?php
echo $troopMenu;
$year = mysql_real_escape_string($_SESSION['year']);
$active = mysql_real_escape_string($_SESSION["active"]);
$result = mysql_query("SELECT * FROM wp_roster WHERE year = '".$year."' AND troopID = '".$active."' AND youth = '1' ORDER BY week, lastName, firstName");
echo "<table class='table table-striped'>";
while ($row = mysql_fetch_array($result))
{
	$scoutID = mysql_real_escape_string($row['camperID']);
	$week = mysql_real_escape_string($row['week']);
	$result1 = mysql_query("SELECT * FROM wp_signups WHERE scoutID = '".$scoutID."' AND week = '".$week."' AND year = '".$year."' AND backup = '0' ORDER BY block");
	$row1 = mysql_fetch_array($result1);
	if (! is_array($row1))
	{
		echo "<tr><td>".$row['lastName'].", ".$row['firstName']."</td><td></td><td><span class='label label-warning'>No Badges</span></td></tr>";
	}
	else if ($row1['approved'] == '1')
	{
		echo "<tr><td>".$row['lastName'].", ".$row['firstName']."</td><td></td><td><span class='label label-success'>Approved</span></td></tr>";
	}
	else
	{
		$badge = mysql_real_escape_string($row1['badge']);
		$badge = mysql_fetch_array(mysql_query("SELECT * FROM wp_badges WHERE id = '".$badge."'"));
		$badge = $badge['badge'];
		echo "<tr><td>".$row['lastName'].", ".$row['firstName']."</td><td>Block ".$row1['block'].": ".$badge."<br/>";
		while ($row1 = mysql_fetch_array($result1))
		{
			$badge = mysql_real_escape_string($row1['badge']);
			$badge = mysql_fetch_array(mysql_query("SELECT * FROM wp_badges WHERE id = '".$badge."'"));
			$badge = $badge['badge'];
			echo "Block ".$row1['block'].": ".$badge."<br/>";
		}
		echo "</td><td><br/><form method='post'><input type='hidden' name='camper' value='".$scoutID."'><input type='hidden' name='week' value='".$week."'><button type='submit' name ='page' value='troopApproveBadgesApprove' class='btn btn-primary'><span class='glyphicon glyphicon-check'></span> Approve</button></form></td></tr>";
	}
}
echo "</table>";
