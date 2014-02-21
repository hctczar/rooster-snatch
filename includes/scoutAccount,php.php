<?php
$active = mysql_real_escape_string(substr($_SESSION["active"],1));
echo $scoutMenu;
$result = mysql_query("SELECT * FROM wp_campers WHERE (id = '".$active."')");
$row = mysql_fetch_array($result);
$echoString = $scoutAccount;
echo $echoString;
?>