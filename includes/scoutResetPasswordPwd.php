<?php
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
//What email to use?
$email = '';
if ($row['email'])
{
	$email = stripslashes($row['email']);
	$subject = getCopy('email_subj_scout_pwd_reset_self');
	$message = getCopy('email_body_scout_pwd_reset_self');
	$special = '<div class="alert alert-success">An email has been sent to '.$email.' with instructions on how to log in!</div>';
}
else
{
	//figure out troop ID
	$row = mysql_fetch_array(mysql_query("SELECT * FROM wp_roster WHERE camperID = '".$scoutID."'"));
	$troop = $row["troopID"];
	echo "troop is: ".$troop."<br/>";
	//figure out troop EMAIL
	$row = mysql_fetch_array(mysql_query("SELECT * FROM wp_troops WHERE id = '".$troop."'"));
	$email = stripslashes($row['email']);
	$subject = getCopy('email_subj_scout_pwd_reset_troop');
	$message = getCopy('email_body_scout_pwd_reset_troop');
	$special = '<div class="alert alert-success">An email has been sent to your troop leader ('.$email.') with instructions on how to log in!</div>';
}
//Email
$subject = str_replace("##first##",$firstName,$subject);
$subject = str_replace("##last##",$lastName,$subject);
$message = str_replace("##pwd##",$password,$message);
$message = str_replace("##first##",$firstName,$message);
$message = str_replace("##last##",$lastName,$message);
$headers = "From:MyKaJaWan@makajawan.com \r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1 \r\n";
if ($email){
	mail($email,$subject,$message,$headers);
}
else {
	$special = '<div class="alert alert-warning">Sorry! No account with that username was found.</div>';
}
echo str_replace("##special##",$special,str_replace("##which##","scout",str_replace("##scoutChecked##","checked",str_replace("##troopChecked##","",$login))));
?>