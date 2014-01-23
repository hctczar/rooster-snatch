<?php
echo str_replace("##which##","troop",str_replace("##troopChecked##","checked",str_replace("##scoutChecked##","",$login)));
$troop = mysql_real_escape_string($_POST["username"]);
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
$passwordEncrypt = MD5($password.$troop);
mysql_query("UPDATE wp_troops SET tempPass = '".$passwordEncrypt."' WHERE login = '".$troop."'");

$row = mysql_fetch_array(mysql_query("SELECT * FROM wp_troops WHERE login = '".$troop."'"));
mail(stripslashes($row["email"]),"Troop password reset on MyKaJaWan.com","Your temporary passwod is: ".$password."\r\n\r\nTo use this password, simply log in with your troop username, and enter this password into the password field. You will be automatically prompted to chose a new password.\r\n\r\nIf you believe this message was sent in error, don't worry! Your old password will still work, and your account security is not compromised.","From:MyKaJaWan@makajawan.com");
echo "<p>An email has been sent to ".stripslashes($row["email"])." with instructions on how to log in!</p>";
?>