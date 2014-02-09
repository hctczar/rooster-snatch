<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;

//a little added security to prevent spamming
$result = mysql_query("SELECT * FROM wp_admins WHERE id = '".mysql_real_escape_string($active)."'");
$row = mysql_fetch_array($result);
if ($row['role'] == 'seacaptain')
{
	for ($i = 0 ; $i < count($_SESSION['toList']) ; $i++)
	{
		$to = $_SESSION['toList'][$i][0];
		$subject = $_SESSION['subject'];
		$message = $_SESSION['message'];
		$headers = $_SESSION['headers'];
		$ok = mail($to, $subject, $message, $headers);
		if ($ok) {echo "<div class='alert alert-success'>Sent to $to</div>";}
	}
}
if (! $ok){echo "<div class='alert alert-danger'>Error sending email</div>";}
?>

