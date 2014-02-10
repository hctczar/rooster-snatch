<?php
echo $troopMenu;
echo getCopy("campers_added");
echo '
	<form method="post">
		<input type="hidden" name="page" value="troopRoster"><br/>
		<button type="submit" value="edit" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> View Roster</button>
	</form>';
?>