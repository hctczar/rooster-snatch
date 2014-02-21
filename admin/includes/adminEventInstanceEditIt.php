<?php
$eventMetaID=mysql_real_escape_string($_POST['eventMetaID']);
$result=mysql_query("SELECT * FROM wp_eventsMeta WHERE id='".$eventMetaID."'");
$row=mysql_fetch_array($result);
$eventID=$row['eventID'];
$week=mysql_real_escape_string($_POST['week']);
$day=mysql_real_escape_string($_POST['day']);
$time=mysql_real_escape_string($_POST['time']);
$time = strtotime($time);
$time = date('Y-m-d H:i:s', $time);
$enrollment=mysql_real_escape_string($_POST['enrollment']);
$success=false;
$alerts='';
//if delete
if ($_POST['toDo']=="delete")
{
	if(mysql_query("DELETE FROM wp_eventsMeta WHERE id='".$eventMetaID."'")){$alerts='<div class="alert alert-success">Event deleted succesfully!</div>'; $success=true;}
	else {$alerts='<div class="alert alert-danger">Oops! Something bad happened. Please try again.</div>';}
}
//if edit
if ($_POST['toDo']=="edit")
{
	
	if ((int)$enrollment < (int)$row['taken'])
	{
		$alerts='<div class="alert alert-danger">Sorry, but you can\'t set the max size less than current enrollment.</div>';
	}
	else
	{	if(mysql_query("UPDATE wp_eventsMeta set week='".$week."', day='".$day."', time='".$time."', enrollment='".$enrollment."' WHERE id='".$eventMetaID."'")){$alerts='<div class="alert alert-success">Event edited succesfully!</div>'; $success=true;}
		else {$alerts='<div class="alert alert-danger">Oops! Something bad happened. Please try again.</div>';}
	}
}
//emails away, mon capitain!
if ($_POST["emailBody"] && $success)
{
	$to='';
	$result=mysql_query("SELECT * FROM wp_eventsSigned WHERE eventMetaID='".$eventMetaID."'");
	while ($row=mysql_fetch_array($result))
	{
		$result1=mysql_query("SELECT * FROM wp_troops WHERE id='".$row['troopID']."'");
		$row1=mysql_fetch_array($result1);
		$to .= $row1['email'].", ";
	}
	$to=trim($to);
	$to=trim($to,',');
	$headers = "From: MyKaJaWan@makajawan.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$subject = getCopy("email_subj_admin_edit_event");
	$message = $_POST["emailBody"];
	
	mail($to,$subject,$message,$headers);
}
include("includes/adminEventInstance.php");