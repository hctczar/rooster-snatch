<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
?>
<?php
$firstName=mysql_real_escape_string($_POST['firstName']);
$lastName=mysql_real_escape_string($_POST['lastName']);
$email=mysql_real_escape_string($_POST['email']);
$role=mysql_real_escape_string($_POST['role']);

$login = substr(strtolower($firstName),0,3).substr(strtolower($lastName),0,3);

$nonce = 1;
$loginTest = $login;
while (is_array(mysql_fetch_array(mysql_query("SELECT * FROM wp_admins WHERE username = '".$loginTest."'"))))
{
	$loginTest = $login.$nonce;
	$nonce +=1;
}
$login = $loginTest;
//Generate a random password that is three letters and three numbers long
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
	$passwordEncrypt = MD5($password.$login);
//I think we have everything we need now. Yippee!
mysql_query("INSERT INTO wp_admins(firstName, lastName, email, username, role, tempPass) VALUES ('".$firstName."', '".$lastName."', '".$email."', '".$login."', '".$role."', '".$passwordEncrypt."')");

//And now to send a strongly worded email...
$email;
$subject = getCopy('email_subj_admin_enrolled');
$customString="<li>Username: <strong>".$login."</strong></li><li>Password: <strong>".$password."</strong></li>";
$message = getCopy('email_body_admin_enrolled').$customString;
$headers = "From:MyKaJaWan@makajawan.com \r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1 \r\n";
mail($email,$subject,$message,$headers);
include("includes/adminUsers.php");
?>