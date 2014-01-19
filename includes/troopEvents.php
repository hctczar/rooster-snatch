<?php
$eventAdder = ""
	."<form method='post'>"
	."<select name='event' onChange='populate()' id = 'event'>"
	."##eventList##"
	."</select>"
	."<select name='week' onChange='populate1()' id='week'>"
	."</select>"
	."<select name='time' id='time'>"
	."</select>"
	."<input type='number' name='campers' placeholder='# of campers/adults' min='1'>"
	."<br/>"
	."<input type='hidden' name='page' value='troopEventAdd'>"
	."<input type='submit' value='Add'>"
	."</form>"
	."<script type='text/javascript'>"
	."function populate() {var len = document.getElementById('week').length;for (var i=0; i<len; i++){document.getElementById('week').remove(0);}var len = document.getElementById('time').length;for (var i=0; i<len; i++){document.getElementById('time').remove(0);}";
	$result = mysql_query("SELECT * FROM wp_events WHERE year = '".$_SESSION["year"]."' ORDER BY name");
	$eventList = "";
	while ($row = mysql_fetch_array($result))
	{
		$eventList = $eventList."<option value='".$row['id']."'>".stripslashes($row["name"])."</option>";
		$eventString = ""
		."    if (document.getElementById('event').value == ".$row["id"].")"
		."	{";
		$result1 = mysql_query("SELECT * FROM wp_eventsMeta WHERE eventID = '".mysql_real_escape_string($row["id"])."'");
		$weekList ="\"";
		$weekables = array();
		while ($row1 = mysql_fetch_array($result1))
		{
			$weekables[] = $row1['week'];
		}
		$weekables = array_unique($weekables);
		foreach ($weekables as $week)
		{
			$eventString = $eventString."var option = document.createElement('option');option.text = 'Week ".$week."';option.value = '".$week."';document.getElementById('week').add(option);";
			$eventString = $eventString
			."		if (document.getElementById('week').value == ".$week.")"
			."		{";//mind the gap
			$result2 = mysql_query("SELECT * FROM wp_eventsMeta WHERE eventID = '".mysql_real_escape_string($row["id"])."' and week = '".mysql_real_escape_string($week)."' ORDER BY day, time");
			$timeables = array();
			while ($row2 = mysql_fetch_array($result2))
			{
				$timeables[] = array($row2['id'],$row2['day'],date('g:ia',strtotime($row2['time'])),$row2['enrollment']-$row2['taken']);
			}
			foreach ($timeables as $timer)
			{
				$dowMap = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
				$eventString = $eventString."var option = document.createElement('option');option.text = '".$dowMap[$timer[1]]." at ".$timer[2]." (". $timer[3] ." spots available)';option.value = '".$timer[0]."';document.getElementById('time').add(option);";
			}
			$eventString = $eventString
			."}";//gap minded
		}
		$eventString = $eventString
		."	}";
		$weekList = "<option value='0'>Dummy</option>\"";
		$eventString = str_replace("##weekList##",$weekList."\"",$eventString);
		$eventAdder = $eventAdder.$eventString;
	}
	$eventAdder = $eventAdder
	."}"
	."function populate1() {var len = document.getElementById('time').length;for (var i=0; i<len; i++){document.getElementById('time').remove(0);}";
	$result = mysql_query("SELECT * FROM wp_events WHERE year = '".$_SESSION["year"]."' ORDER BY name");
	$eventList = "";
	while ($row = mysql_fetch_array($result))
	{
		$eventList = $eventList."<option value='".$row['id']."'>".stripslashes($row["name"])."</option>";
		$eventString = ""
		."    if (document.getElementById('event').value == ".$row["id"].")"
		."	{";
		$result1 = mysql_query("SELECT * FROM wp_eventsMeta WHERE eventID = '".mysql_real_escape_string($row["id"])."' ORDER BY day,time ASC");
		$weekList ="\"";
		$weekables = array();
		while ($row1 = mysql_fetch_array($result1))
		{
			$weekables[] = $row1['week'];
		}
		$weekables = array_unique($weekables);
		foreach ($weekables as $week)
		{
			$eventString = $eventString
			."		if (document.getElementById('week').value == ".$week.")"
			."		{";//mind the gap
			$result2 = mysql_query("SELECT * FROM wp_eventsMeta WHERE (eventID = '".mysql_real_escape_string($row["id"])."' and week = '".mysql_real_escape_string($week)."') ORDER BY day, time");
			$timeables = array();
			while ($row2 = mysql_fetch_array($result2))
			{
				$timeables[] = array($row2['id'],$row2['day'],date('g:ia',strtotime($row2['time'])),$row2['enrollment']-$row2['taken']);
			}
			//$timeables = array_unique($timeables);
			foreach ($timeables as $timer)
			{
				$dowMap = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
				$eventString = $eventString."var option = document.createElement('option');option.text = '".$dowMap[$timer[1]]." at ".$timer[2]." (". $timer[3] ." spots available)';option.value = '".$timer[0]."';document.getElementById('time').add(option);";
			}
			$eventString = $eventString
			."}";//gap minded
		}
		$eventString = $eventString
		."	}";
		$weekList = "<option value='0'>Dummy</option>\"";
		$eventString = str_replace("##weekList##",$weekList."\"",$eventString);
		$eventAdder = $eventAdder.$eventString;
	}
	$eventAdder = $eventAdder
	."}"
	."populate();"
	."</script>";
	$eventAdder = str_replace("##eventList##",$eventList,$eventAdder);
	//##week##
	//##eventID##
	//##weekList##
	//##timeList##
	//##eventList##
	//##available##
	
	
echo $troopMenu;
$active = $_SESSION["active"];
echo "<br/><table border='1' class='sortable'>";
echo "<tr><th>Event Title</th><th id='timeHeader'>Time</th><th>Signed Up</th><th colspan='2' class='sorttable_nosort'></th><tr>";
$result=mysql_query("SELECT * FROM wp_eventsSigned WHERE (troopID = '".mysql_real_escape_string($active)."') ORDER BY eventID");
while ($row = mysql_fetch_array($result))
{
	$result2=mysql_query("SELECT * FROM wp_eventsMeta WHERE id = '".mysql_real_escape_string($row["eventMetaID"])."'");
	$row2=mysql_fetch_array($result2);
	$result3=mysql_query("SELECT * FROM wp_events WHERE id = '".mysql_real_escape_string($row["eventID"])."'");
	$row3=mysql_fetch_array($result3);
	if ($row2['year'] != $_SESSION['year'])
	{
		continue;
	}
	$week = $row2['week'];
	$weekDays = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$day = $weekDays[$row2['day']];
	$sortDay = $row2['day'];
	$time = strtotime($row2['time']);
	$sortTime = (int)$time;
	$sortTime += 1000000*$sortDay + 1000000000*$week;
	$time = date('g:ia',$time);
	$registered = $row['registered'];
	$title = stripslashes($row3["name"]);
	echo "<tr><td align='center'>".$title."</td><td align='center' sorttable_customkey='".$sortTime."'>".$day." at ".$time.", Week ".$week."</td><td align='center'>".$registered."</td><td align='middle'><form method='post'><input type='hidden' name='event' value='".$row['id']."'><input type='hidden' name='page' value='troopEventEdit'><input type='submit' value='edit' style='width:8em'></form></td><td align='middle'><form method='post'><input type='hidden' name='event' value='".$row['id']."'><input type='hidden' name='page' value='troopEventDelete'><input type='submit' value='delete' style='width:8em'></form></td></tr>";				
}
echo "</table><br/>";
echo "<script>var myTH = document.getElementsByTagName('th')[0];sorttable.innerSortFunction.apply(myTH, []);</script>";
echo $eventAdder;
?>