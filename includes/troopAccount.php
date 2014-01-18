<?php
$active = $_SESSION["active"];
echo $troopMenu;
$result = mysql_query("SELECT * FROM wp_troops WHERE (id = '".mysql_real_escape_string($active)."')");
$row = mysql_fetch_array($result);
$troop = stripslashes($row['number']);
$council = stripslashes($row['council']);
$login = stripslashes($row['login']);
$email = stripslashes($row['email']);
$echoString = $troopAccount;
$echoString = str_replace("##email##", $email, $echoString);
$echoString = str_replace("##troop##", $troop, $echoString);
$echoString = str_replace("##council##", $council, $echoString);
echo $echoString;
?>