<?php
$active = mysql_real_escape_string($_SESSION["active"]);
$year = mysql_real_escape_string($_SESSION["year"]);
$week = mysql_real_escape_string($_POST["week"]);
$tents = mysql_real_escape_string($_POST["tents"]);

mysql_query("UPDATE wp_troopsMeta SET tents = '".$tents."' WHERE (year = '".$year."' and troopID = '".$active."' and week = '".$week."')"); 
include("includes/troopCampsite.php");
?>