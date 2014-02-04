<?php
$badgeID = mysql_real_escape_string($_POST['badgeID']);
echo "preparing to delete!!!!";
mysql_query("DELETE FROM wp_badges WHERE id = '".$badgeID."'");
include("includes/adminBadges.php");
?>
<script>
viewTable();
</script>