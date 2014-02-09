<?php
echo $scoutMenu;
$scoutSignupEcho=$scoutSignup;
$active = mysql_real_escape_string(substr($_SESSION["active"],1));
$result = mysql_query("SELECT * FROM wp_campers WHERE id = '".$active."'");
$row = mysql_fetch_array($result);
$troopID=$row['troopID'];
$year = mysql_real_escape_string($_SESSION["year"]);
$weeksCamping = array();
$result = mysql_query("SELECT * FROM wp_roster WHERE year = '".$year."' AND camperID = '".$active."' ORDER BY week");
while ($row = mysql_fetch_array($result)){$weeksCamping[]=$row['week'];}
?>

<?php
function pieSort($a, $b)
{
	if (count($a) == count($b)){return 0;}
	if (count($a) < count($b)){return 1;}
	if (count($a) > count($b)){return -1;}
}
function optionSort($a, $b)
{
	if ($a[0][1] == $b[0][1]){return 0;}
	if ($a[0][1] < $b[0][1]){return -1;}
	if ($a[0][1] > $b[0][1]){return 1;}
}
function lassySort($a, $b)
{
	if ($a[0] == $b[0]){return 0;}
	if ($a[0] < $b[0]){return -1;}
	if ($a[0] > $b[0]){return 1;}
}
function getBadges($week,$block,$flag)
{
	$badges=array();
	global $troopID, $year;
	$result = mysql_query("SELECT * FROM wp_roster WHERE year = '".$year."' AND week = '".$week."' AND troopID = '".$troopID."' AND youth = '1' ORDER BY lastName, firstName");
	while ($row = mysql_fetch_array($result))
	{
		$camperID = mysql_real_escape_string($row['camperID']);
		$result1 = mysql_query("SELECT * FROM wp_campers WHERE id='".$camperID."'");
		$row1 = mysql_fetch_array($result1);
		$camperName = $row1['firstName']." ".$row1['lastName'];
		$result1 = mysql_query("SELECT * FROM wp_signups WHERE year = '".$year."' and week = '".$week."' and scoutID = '".$camperID."' and block = '".$block."' and backup = '0' and approved = '1'");
		$row1 = mysql_fetch_array($result1);
		$badgeID = $row1['badge'];
		$badgeName = '';
		$result1 = mysql_query("SELECT * FROM wp_badges WHERE id = '".$badgeID."'");
		if($row1 = mysql_fetch_array($result1))
		{
			$badgeName = $row1['badge'];
			//Add the camper to that badge's array
			if (isset($badges[$badgeID])){
				$badges[$badgeID][]=array($camperName,$badgeName);
			}
			else {
				$badges[$badgeID] = array(array($camperName,$badgeName));
			}
		}
	}
	if ($flag == 'pie')
	{
		uasort($badges,'pieSort');
		$return = 'possOpt["opt'.$week.$block.'"] = google.visualization.arrayToDataTable([["Badge", "Enrolled"],';
		foreach ($badges as $value)
		{
			$return .= "['".$value[0][1]."', ".count($value)."],";
		}
		$return = rtrim($return, ",");
		$return .= ']);';
		return $return;
	}
	if ($flag == 'options')
	{
		uasort($badges,'optionSort');
		$return = '';
		foreach ($badges as $value)
		{
			$return .= '<option value="'.$value[0][1].'">'.$value[0][1].'</option>';
		}
		return $return;
	}
	if ($flag == 'fetchLassy')
	{
		$return = '';
		foreach ($badges as $value)
		{
			$pairs='';
			uasort($value,'lassySort');
			foreach ($value as $pair)
			{
				$pairs .=$pair[0]."<br/>";
			}
			$return .= "if (badge == '".$value[0][1]."'){possOpt['opt".$week.$block."']='".$pairs."';}";
		}
		return $return;
	}
		
}
getBadges(3,'C','pie');
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
	possOpt = new Array();
	<?php
	foreach ($weeksCamping as $week)
	{
		echo getBadges($week,'A','pie');
		echo getBadges($week,'B','pie');
		echo getBadges($week,'C','pie');
		echo getBadges($week,'D','pie');
	}
	?>
	var options = {};
	var chart = new google.visualization.PieChart(document.getElementById('piechart'));
	week = document.getElementById("week").value;
	block = document.getElementById("block").value;
	chart.draw(possOpt['opt'+week+block], options);
}
</script>
<div class="input-group">
	<span class="input-group-addon" style="width:8em;">Week</span>
	<select style="width:12em;" class="form-control" id="week" onChange="updateThem();"><?php foreach ($weeksCamping as $week){echo "<option value='".$week."'>".$week."</option>";}?></select>
</div>
<div class="input-group">
	<span class="input-group-addon" style="width:8em;">Block</span>
	<select style="width:12em;" class="form-control" id="block" onChange="updateThem();">
    	<option value='A'>A</option>
    	<option value='B'>B</option>
    	<option value='C'>C</option>
    	<option value='D'>D</option>
	</select>
</div>
<table class="table table-striped">
<tr>
<td style="width:50%;"><div id="piechart" style="width: 450px; height: 250px; display:inline-block"></div></td>
<td style="width:50%;"><select class="form-control" onChange="getFriends();" id="select"></select><div class="well" id="well"></div></td>
</tr>
</table>
<script>
function updateThem()
{
	getBadgeOptions();
	getFriends();
	drawChart();
}
function getBadgeOptions()
{
	possOpt = new Array();
	<?php
	foreach ($weeksCamping as $week)
	{
		echo "possOpt['opt".$week."A']='".getBadges($week,'A','options')."'\n";
		echo "possOpt['opt".$week."B']='".getBadges($week,'B','options')."'\n";
		echo "possOpt['opt".$week."C']='".getBadges($week,'C','options')."'\n";
		echo "possOpt['opt".$week."D']='".getBadges($week,'D','options')."'\n";
	}
	?>
	week = document.getElementById("week").value;
	block = document.getElementById("block").value;
	document.getElementById("select").innerHTML = possOpt['opt'+week+block];
}
function getFriends()
{
	badge = document.getElementById("select").value;
	possOpt = new Array();
	<?php
	foreach ($weeksCamping as $week)
	{
		echo getBadges($week,'A','fetchLassy');
		echo getBadges($week,'B','fetchLassy');
		echo getBadges($week,'C','fetchLassy');
		echo getBadges($week,'D','fetchLassy');
	}
	?>
	week = document.getElementById("week").value;
	block = document.getElementById("block").value;
	document.getElementById("well").innerHTML=possOpt['opt'+week+block];
}
updateThem();
</script>