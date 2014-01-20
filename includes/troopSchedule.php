<?php
echo $troopMenu;
$active = $_SESSION["active"];
$result = mysql_query("SELECT * FROM wp_roster WHERE troopID = '".mysql_real_escape_string($_SESSION['active'])."' and youth = '1' ORDER BY week, lastName, firstName");
$week = 0;
//csvbuilder string will be passed into download() function.
$csvbuilder = "'";
echo "<table border = '1' cellpadding='4'>";
while ($row = mysql_fetch_array($result))
{
	if ($week != $row['week'])
	//if we've reached the end of the previous week, add a break in our table.
	{
		$week =$row['week'];
		echo "<tr><th colspan = '9' align='center'>Week ".$week."</th></tr>";
		$csvbuilder = $csvbuilder."Week ".$week.",,,,,,,,%0A";
		echo "<tr><th></th><th colspan = '2'>Block A</th><th colspan = '2' class='Liam'>Block B</th><th colspan = '2'>Block C</th><th colspan = '2' class='Liam'>Block D</th>";
		$csvbuilder = $csvbuilder.",Block A,,Block B,,Block C,,Block D,%0A";
		echo "<tr><th>Name</th><th>Badge</th><th>Location</th><th class='Liam'>Badge</th><th class='Liam'>Location</th><th>Badge</th><th>Location</th><th class='Liam'>Badge</th><th class='Liam'>Location</th>";
		$csvbuilder = $csvbuilder."Name,Badge,Location,Badge,Location,Badge,Location,Badge,Location%0A";
	}
	$name = $row["lastName"].", ".$row["firstName"];
	//roll through signups to get badge ids, then roll through badges to get badge info like name and location. Do for all 4 blocks.
	$result1 = mysql_query("SELECT * FROM wp_signups WHERE scoutID = '".mysql_real_escape_string($row["camperID"])."' and week = '".mysql_real_escape_string($week)."' and block = 'A'");
	$row1 = mysql_fetch_array($result1);
	$badgeA = $row1["badge"];
	$result1 = mysql_query("SELECT * FROM wp_badges where id = '".mysql_real_escape_string($badgeA)."'");
	$row1 = mysql_fetch_array($result1);
	$badgeAName = $row1["badge"];
	$badgeALocation = $row1["camp"]." ".$row1["Area"];
	
	$result1 = mysql_query("SELECT * FROM wp_signups WHERE scoutID = '".mysql_real_escape_string($row["camperID"])."' and week = '".mysql_real_escape_string($week)."' and block = 'B'");
	$row1 = mysql_fetch_array($result1);
	$badgeB = $row1["badge"];
	$result1 = mysql_query("SELECT * FROM wp_badges where id = '".mysql_real_escape_string($badgeB)."'");
	$row1 = mysql_fetch_array($result1);
	$badgeBName = $row1["badge"];
	$badgeBLocation = $row1["camp"]." ".$row1["Area"];
	
	$result1 = mysql_query("SELECT * FROM wp_signups WHERE scoutID = '".mysql_real_escape_string($row["camperID"])."' and week = '".mysql_real_escape_string($week)."' and block = 'C'");
	$row1 = mysql_fetch_array($result1);
	$badgeC = $row1["badge"];
	$result1 = mysql_query("SELECT * FROM wp_badges where id = '".mysql_real_escape_string($badgeC)."'");
	$row1 = mysql_fetch_array($result1);
	$badgeCName = $row1["badge"];
	$badgeCLocation = $row1["camp"]." ".$row1["Area"];
	
	$result1 = mysql_query("SELECT * FROM wp_signups WHERE scoutID = '".mysql_real_escape_string($row["camperID"])."' and week = '".mysql_real_escape_string($week)."' and block = 'D'");
	$row1 = mysql_fetch_array($result1);
	$badgeD = $row1["badge"];
	$result1 = mysql_query("SELECT * FROM wp_badges where id = '".mysql_real_escape_string($badgeD)."'");
	$row1 = mysql_fetch_array($result1);
	$badgeDName = $row1["badge"];
	$badgeDLocation = $row1["camp"]." ".$row1["Area"];
	
	//print badge names and locations to table
	echo "<tr><td>".$name."</td><td>".$badgeAName."</td><td>".$badgeALocation."</td><td class='Liam'>".$badgeBName."</td><td class='Liam'>".$badgeBLocation."</td><td>".$badgeCName."</td><td>".$badgeCLocation."</td><td class='Liam'>".$badgeDName."</td><td class='Liam'>".$badgeDLocation."</td></tr>";
	$csvbuilder = $csvbuilder."\"".$name."\",".$badgeAName.",\"".$badgeALocation."\",\"".$badgeBName."\",\"".$badgeBLocation."\",\"".$badgeCName."\",\"".$badgeCLocation."\",\"".$badgeDName."\",\"".$badgeDLocation."\"%0A";
}
echo "</table>";
$csvbuilder = $csvbuilder."'";
echo "<br/>";
echo "<input type='submit' value='Download Schedule' style='width:16em' onClick='download();'>";
//build function to print out csv of schedule.
//Why is there a regex in this? Welp, if you don't escape the blank space characters, they get ignored. Andthatisabadthing. However, this also escapes the newline characters necessary for building a CSV. So we had to unescape those. Using a goddam regular expression for some reason.
echo "<script>
function download(){
var csvString = ".$csvbuilder.";
var a         = document.createElement('a');
a.href        = 'data:attachment/csv,' + encodeURIComponent(csvString).replace(/%250A/g,'%0A');
a.target      = '_blank';
a.download    = 'schedule.csv';

document.body.appendChild(a);
a.click();
}
</script>";