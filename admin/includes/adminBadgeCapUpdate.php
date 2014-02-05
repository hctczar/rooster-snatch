<?php
$i = 0;
while (isset($_POST['badge'.$i]))
{
	$cap = mysql_real_escape_string($_POST['cap'.$i]);
	$badge = mysql_real_escape_string($_POST['badge'.$i]);
	mysql_query("UPDATE wp_badges SET cap = '".$cap."' WHERE badge = '".$badge."'");
	$i++;
}
include("includes/adminBadgeCap.php");