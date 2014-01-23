<?php
echo str_replace("##which##","scout",str_replace("##scoutChecked##","checked",str_replace("##troopChecked##","",$login)));
$scout = mysql_real_escape_string($_POST["username"]);
$password = "";
		$a_z = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$int = rand(0,25);
		$password = $password.$a_z[$int];
		$int = rand(0,25);
		$password = $password.$a_z[$int];
		$int = rand(0,25);
		$password = $password.$a_z[$int];
		$password = $password.(string)(rand(0,9));
		$password = $password.(string)(rand(0,9));
		$password = $password.(string)(rand(0,9));
$passwordEncrypt = MD5($password.$scout);
mysql_query("UPDATE wp_campers SET tempPass = '".$passwordEncrypt."' WHERE username = '".$scout."'");

//figure out camper NAME and ID
$row = mysql_fetch_array(mysql_query("SELECT * FROM wp_campers WHERE username = '".$scout."'"));
$firstName = stripslashes($row["firstName"]);
$lastName = stripslashes($row["lastName"]);
$scoutID = $row["id"];
echo "camper is: ".$firstName." ".$lastName." ".$scoutID."<br/>";
//figure out troop ID
$row = mysql_fetch_array(mysql_query("SELECT * FROM wp_roster WHERE camperID = '".$scoutID."'"));
$troop = $row["troopID"];
echo "troop is: ".$troop."<br/>";
//figure out troop EMAIL
$row = mysql_fetch_array(mysql_query("SELECT * FROM wp_troops WHERE id = '".$troop."'"));
mail(stripslashes($row["email"]),"MyKaJaWan.com password reset for ".$firstName." ".$lastName."","".$firstName." ".$lastName."'s temporary passwod is: ".$password."\r\n\r\nPlease pass this information on to ".$firstName." as quickly as possible, because they will not be able to log in with their new password until you do. Once they have the new password, they can simply enter it into the login box as they would normally. Once logged in, they will be automatically prompted to chose a new password.\r\n\r\nIf you believe this message was sent in error, don't worry! Their old password will still work, and their account security has not been compromised.","From:MyKaJaWan@makajawan.com");
echo "<p>An email has been sent to your troop leader (".stripslashes($row["email"]).") with instructions on how to log in!</p>";
?>