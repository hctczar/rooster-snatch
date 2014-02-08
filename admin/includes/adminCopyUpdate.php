<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);

for ($i = 0 ; $i < count($_POST['text']) ; $i++)
{
	$copyID = mysql_real_escape_string($_POST['copyID'][$i]);
	$text = mysql_real_escape_string($_POST['text'][$i]);
	mysql_query ("UPDATE wp_copy SET text = '".$text."' WHERE id = '".$copyID."'");
}
include("includes/adminCopy.php");
?>