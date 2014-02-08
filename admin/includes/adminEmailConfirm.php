<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;
?>

<?php
//Generate To List
$toList = array();
if ($_POST['troopNumber'])
{
	$number = mysql_real_escape_string($_POST['troopNumber']);
	$council = mysql_real_escape_string($_POST['council']);
	$result = mysql_query("SELECT * FROM wp_troops WHERE number = '".$number."' AND council = '".$council."'");
	$row = mysql_fetch_array($result);
	if ($row['email']){$toList[] = array(stripslashes($row['email']),$row['number']." ".$row['council']);}
	else {echo "Sorry, a Troop ".$_POST['troopNumber']." in ".$_POST['council']." council was not found in our records.";}
}
else
{
	$result = mysql_query("SELECT * FROM wp_troops ORDER BY number, council");
	while ($row = mysql_fetch_array($result))
	{
		$troopID = $row['id'];
		$good=true;
		//Ensure proper camp
		if ($_POST['camp'] != '')
		{
			$camp = mysql_real_escape_string($_POST['camp']);
			$result1 = mysql_query("SELECT * FROM wp_troopsMeta WHERE year = '".$year."' AND camp = '".$camp."' AND troopID = '".$troopID."'");
			if (! mysql_fetch_array($result1)){$good=false;}
		}
		//Ensure proper week
		$result1 = mysql_query("SELECT * FROM wp_troopsMeta WHERE year = '".$year."' AND troopID = '".$troopID."'");
		$goodWeek=false;
		$weekCount=0;
		while ($row1 = mysql_fetch_array($result1))
		{
			$weekCount += 1;
			if (in_array($row1['week'],$_POST['week'])){$goodWeek=true;}
		}
		if (! $goodWeek){$good=false;}
		//Ensure proper number of weeks
		if ($weekCount < $_POST['weeksCamping']){$good=false;}
		//Ensure proper events
		if ($_POST['event'] != '')
		{
			$eventID = mysql_real_escape_string($_POST['event']);
			$result1 = mysql_query("SELECT * FROM wp_eventsSigned WHERE troopID = '".$troopID."' AND eventID = '".$eventID."'");
			if (! mysql_fetch_array($result1)){$good=false;}
		}
		if ($good) {$toList[] = array(stripslashes($row['email']),$row['number']." ".$row['council']);}
	}
}
?>
<table class='table table-striped'>
<tr><th>Troop</th><th>Email</th></tr>
<?php
for ($i = 0 ; $i < count($toList) ; $i++)
{
	echo "<tr><td>".$toList[$i][1]."</td><td>".$toList[$i][0]."</td></tr>";
}
?>
<tfoot><tr><td><form method = 'post'>Send email to <?php echo count($toList);?> troops? <input type="hidden" name="page" value="adminEmailSend"><button type="submit" value="send" class="btn btn-primary" style="display:inline"><span class="glyphicon glyphicon-send"></span> Send</button></form>
</td></tr></tfoot></table>
<?php
//Generate Email
// email fields: from, subject, and so on
$from = $_POST['emailSender'];
$subject = $_POST['emailSubject'];
$headers = "From: $from";
$message = $_POST['emailBody'];

// boundary 
$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

// headers for attachment 
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

// multipart boundary 
$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
$message .= "--{$mime_boundary}\n";

// preparing attachments
for($x=0;$x<count($_FILES['file']['tmp_name']);$x++){
	//$file = fopen($files[$x],"rb");
	//$data = fread($file,filesize($files[$x]));
	//fclose($file);
	if ($_FILES['file']['tmp_name'][$x] != '')
	{
		$data = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'][$x])));
		$message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"".$_FILES['file']['name'][$x]."\"\n" . 
		"Content-Disposition: attachment;\n" . " filename=\"".$_FILES['file']['name'][$x]."\"\n" . 
		"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
		$message .= "--{$mime_boundary}\n";
	}
}

// send
$_SESSION['toList']=$toList;
$_SESSION['subject']=$subject;
$_SESSION['message']=$message;
$_SESSION['headers']=$headers;
?>