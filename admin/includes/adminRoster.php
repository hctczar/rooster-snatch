<?php $active = $_SESSION["active"]; echo $adminMenu; ?>

<button type='submit' value='Download Badge List' class='btn btn-primary' onclick='downloadBadges();' style='width:21em;'>Download Badge List <span class='glyphicon glyphicon-download-alt'></span></button><br/><br/>
<button type='submit' value='Download Roster' class='btn btn-primary' onclick='downloadRoster();' style='width:21em;'>Download Roster <span class='glyphicon glyphicon-download-alt'></span></button><br/>

<?php
$badgesBuilder = "'";
$badgesBuilder .= "Week,Camp,Troop,Council,First Name,Last Name,Badge,Requirements%0A";
$year = mysql_real_escape_string($_SESSION['year']);
$result = mysql_query("SELECT * FROM wp_signups WHERE year = '".$year."' AND backup = '0' AND badge != 'none' ORDER BY week, scoutID");
while ($row = mysql_fetch_array($result))
{
	$week = $row['week'];
	$camp = $row['camp'];
	$badgeID = $row['badge'];
	$camperID = mysql_real_escape_string($row['scoutID']);
	$result1 = mysql_query("SELECT * FROM wp_roster WHERE camperID = '".$camperID."' AND year = '".$year."' AND week = '".$week."'");
	$row1 = mysql_fetch_array($result1);
	$firstName = $row1['firstName'];
	$lastName = $row1['lastName'];
	$troopID = $row1['troopID'];
	$result1 = mysql_query("SELECT * FROM wp_badges WHERE id = '".$badgeID."'");
	$row1 = mysql_fetch_array($result1);
	$badge = '"'.$row1['badge'].'"';
	$result1 = mysql_query("SELECT * FROM wp_troops WHERE id = '".$troopID."'");
	$row1 = mysql_fetch_array($result1);
	$troop = $row1['number'];
	$council = $row1['council'];
	$badgesBuilder .= $week.",".$camp.",".$troop.",".$council.",".$firstName.",".$lastName.",".$badge.", %0A";
}
$badgesBuilder .= "'";
$rosterBuilder = "'";
$rosterBuilder .= "Week,Camp,Site,Troop,Council,Y/A,First Name,Last Name%0A";
$result = mysql_query("SELECT * FROM wp_troopsMeta WHERE year = '".$year."' ORDER BY camp, week, campsite");
while ($row = mysql_fetch_array($result))
{
	$week = $row['week'];
	$camp = $row['camp'];
	$site = $row['campsite']." ".$row['subsite'];
	$troopID = $row['troopID'];
	$result1 = mysql_query("SELECT * FROM wp_troops WHERE id = '".$troopID."'");
	$row1 = mysql_fetch_array($result1);
	$troop = $row1['number'];
	$council = $row1['council'];
	$result1 = mysql_query("SELECT * FROM wp_roster WHERE troopID = '".$troopID."' AND year = '".$year."' AND week = '".$week."'");
	while ($row1 = mysql_fetch_array($result1))
	{
		if ($row1['youth'] == 1){$youth='Y';}
		else {$youth='A';}
		$firstName = $row1['firstName'];
		$lastName = $row1['lastName'];
		$rosterBuilder .= $week.",".$camp.",".$site.",".$troop.",".$council.",".$youth.",".$firstName.",".$lastName."%0A";
	}
}
$rosterBuilder .= "'";
?>
<script>
function downloadRoster()
{
	var csvString = <?php echo $rosterBuilder; ?>;
	var a         = document.createElement('a');
	a.href        = 'data:attachment/csv,' + encodeURIComponent(csvString).replace(/%250A/g,'%0A');
	a.target      = '_blank';
	a.download    = 'rooster.csv';
	document.body.appendChild(a);
	a.click();
}
function downloadBadges()
{
	var csvString = <?php echo $badgesBuilder; ?>;
	var a         = document.createElement('a');
	a.href        = 'data:attachment/csv,' + encodeURIComponent(csvString).replace(/%250A/g,'%0A');
	a.target      = '_blank';
	a.download    = 'badge_schedule.csv';
	document.body.appendChild(a);
	a.click();
}
</script>