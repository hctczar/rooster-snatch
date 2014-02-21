<?php
$eventID=$_POST['eventID'];
$year=mysql_real_escape_string($_SESSION['year']);
$week=mysql_real_escape_string($_POST['week']);
$day=mysql_real_escape_string($_POST['day']);
$time=mysql_real_escape_string($_POST['time']);
$time = strtotime($time);
$time = date('Y-m-d H:i:s', $time);
$enrollment=mysql_real_escape_string($_POST['enrollment']);
$alerts='';

mysql_query("INSERT INTO wp_eventsMeta (eventID, year, week, day, time, enrollment, taken) VALUES ('".$eventID."', '".$year."', '".$week."', '".$day."', '".$time."', '".$enrollment."', '0')");

include("includes/adminEventInstance.php");