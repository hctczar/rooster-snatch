<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
?>
<?php
$firstName=mysql_real_escape_string($_POST['firstName']);
$lastName=mysql_real_escape_string($_POST['lastName']);
$email=mysql_real_escape_string($_POST['email']);
$role=mysql_real_escape_string($_POST['role']);
$adminID=mysql_real_escape_string($_POST['adminID']);

mysql_query("UPDATE wp_admins SET firstName = '".$firstName."' WHERE id = '".$adminID."'");
mysql_query("UPDATE wp_admins SET lastName = '".$lastName."' WHERE id = '".$adminID."'");
mysql_query("UPDATE wp_admins SET email = '".$email."' WHERE id = '".$adminID."'");
mysql_query("UPDATE wp_admins SET role = '".$role."' WHERE id = '".$adminID."'");

include("includes/adminUsers.php");
?>