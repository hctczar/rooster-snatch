<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;

$eventMetaID=$_POST['eventMetaID'];
?>