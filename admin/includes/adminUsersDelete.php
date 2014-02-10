<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
$adminID = mysql_real_escape_string($_POST['user']);
mysql_query("DELETE FROM wp_admins WHERE id = '".$adminID."'");
include("includes/adminUsers.php");
?>