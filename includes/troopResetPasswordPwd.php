<?php
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
//Email
$email = stripslashes($row["email"]);
$subject = getCopy('email_subj_troop_pwd_reset');
$message = getCopy('email_body_troop_pwd_reset');
$message = str_replace("##pwd##",$password,$message);
$headers = "From:MyKaJaWan@makajawan.com \r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1 \r\n";
if ($email){
	mail($email,$subject,$message,$headers);
	$special = '<div class="alert alert-success">An email has been sent to '.$email.' with instructions on how to log in!</div>';
}
else {
	$special = '<div class="alert alert-warning">Sorry! No account with that username was found.</div>';
}
echo str_replace("##special##",$special,str_replace("##which##","troop",str_replace("##troopChecked##","checked",str_replace("##scoutChecked##","",$login))));
?>