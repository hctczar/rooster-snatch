<?php
echo $scoutMenu;
$scoutSignupEcho=$scoutSignup;
$active = mysql_real_escape_string(substr($_SESSION["active"],1));
//discover what weeks scouts are camping.
$weeks = array();
$year = mysql_real_escape_string($_SESSION['year']);
$result = mysql_query("SELECT * FROM wp_roster WHERE (year = '".$year."' AND camperID = '".$active."') ORDER BY week");
$lastWeek=0;
while ($row = mysql_fetch_array($result))
{
	$weeks[]=$row['week'];
	//ensure that that week has been approved.
	$result1 = mysql_query("SELECT * FROM wp_signups WHERE (year = '".mysql_real_escape_string($_SESSION['year'])."' AND week = '".mysql_real_escape_string($row['week'])."' AND scoutID = '".$active."' AND backup = '0')");
	$row1 = mysql_fetch_array($result1);
	if ($row1['approved'] == 0)
	{
		echo '<div class="alert alert-warning">Scoutmaster approval required for week '.$row['week'].'.</div>';
	}
	$lastWeek=$row['week'];
}
//check to see if schedule is offish-fish
$assigned = getDateCopy("mb_assigned");
if (mktime(0,0,0,date("m"),date("d")+($lastWeek-1)*-7,date("Y")) < $assigned)
{
	echo '<div class="alert alert-warning">'.getCopy('mb_schedule_is_draft').'</div>';
}
//A function that takes a block letter as an argument and returns a registered MB
function getRegistered($block, $week, $active)
{
    $result = mysql_query("SELECT * FROM wp_signups WHERE (year = '".mysql_real_escape_string($_SESSION['year'])."' AND week = '".$week."' AND block = '".$block."' AND scoutID = '".$active."' AND backup = '0')");
	$row = mysql_fetch_array($result);
	$badgeID = $row['badge'];
	if ($badgeID == 'none')
		$return;
	$result = mysql_query("SELECT * FROM wp_badges WHERE id = '".$badgeID."'");
	$row = mysql_fetch_array($result);
	return $row['badge'];
}
//loop through weeks camping, display merit display MBs signed registered
?>
<table class = "table table-striped">
<?php
for($i=0;$i<count($weeks);$i++)
{
	echo '<tr><th colspan="2">Week ',$weeks[$i],'</th></tr><tr><td>Block A</td><td>',getRegistered('A', $weeks[$i], $active),'</td></tr><tr><td>Block B</td><td>',getRegistered('B', $weeks[$i], $active),'</td></tr><tr><td>Block C</td><td>',getRegistered('C', $weeks[$i], $active),'</td></tr><tr><td>Block D</td><td>',getRegistered('D', $weeks[$i], $active),'</td></tr>';
}
?>
</table>