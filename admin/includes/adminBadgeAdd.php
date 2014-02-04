<?php 
for ($i = 0; $i < 20 ; $i++)
{
	if ($_POST['badge'.$i])
	{
		$badge     = mysql_real_escape_string($_POST['badge'.$i]);
		$block     = mysql_real_escape_string($_POST['block'.$i]);
		$conflicts = mysql_real_escape_string($_POST['conflicts'.$i]);
		$Area      = mysql_real_escape_string($_POST['area'.$i]);
		$camp      = mysql_real_escape_string(strtolower($_POST['camp'.$i]));
		mysql_query("INSERT INTO wp_badges (badge, block, conflicts, Area, camp) VALUES ('".$badge."', '".$block."', '".$conflicts."', '".$Area."', '".$camp."')");
	}
}
include("includes/adminBadges.php");
?>
<script>
viewTable();
</script>