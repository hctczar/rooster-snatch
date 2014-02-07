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
//make sure that checkboxes default to checked, where appropriate
$approveBadgesChecked = '';
if ($row['approveBadges'] == true){$approveBadgesChecked = "checked";}
$echoString = str_replace("##approveBadgesChecked##", $approveBadgesChecked, $echoString);
$emailBadgesChecked = '';
if ($row['emailBadges'] == true){$emailBadgesChecked = 'checked';}
$echoString = str_replace("##emailBadgesChecked##", $emailBadgesChecked, $echoString);
//make sure text boxes have the correct defaults
$echoString = str_replace("##email##", $email, $echoString);
$echoString = str_replace("##troop##", $troop, $echoString);
$echoString = str_replace("##council##", $council, $echoString);
echo $echoString;
?>