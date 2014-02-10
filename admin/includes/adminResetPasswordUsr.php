<?php
$firstName = mysql_real_escape_string($_POST["firstName"]);
$lastName = mysql_real_escape_string($_POST["lastName"]);
$result = mysql_query("SELECT * FROM wp_admins WHERE firstName = '".$firstName."' and lastName = '".$lastName."'");
$row = mysql_fetch_array($result);
if(! is_array($row))
{
	$special = '<div class="alert alert-warning">Sorry! No account exists with that information</div>';
}
else
{
	$special = '<div class="alert alert-success">Your username is: '.$row["username"].'</div>';
}
echo str_replace("##special##",$special,$kennyloggin);
?>