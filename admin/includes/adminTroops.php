<?php
$active = $_SESSION["active"];
echo $adminMenu;

$siteOptions= 
		"<option value='--Not Enrolled--'>--Not Enrolled--</option>
		<option value='Blackfoot A'>Blackfoot A</option>
		<option value='Blackfoot B'>Blackfoot B</option>
		<option value='Cheyenne A'>Cheyenne A</option>
		<option value='Cheyenne B'>Cheyenne B</option>
		<option value='Chippewa A'>Chippewa A</option>
		<option value='Chippewa B'>Chippewa B</option>
		<option value='Commanche A'>Commanche A</option>
		<option value='Commanche B'>Commanche B</option>
		<option value='Delaware A'>Delaware A</option>
		<option value='Delaware B'>Delaware B</option>
		<option value='Iroquois A'>Iroquois A</option>
		<option value='Iroquois B'>Iroquois B</option>
		<option value='Menominee A'>Menominee A</option>
		<option value='Menominee B'>Menominee B</option>
		<option value='Mohawk A'>Mohawk A</option>
		<option value='Mohawk B'>Mohawk B</option>
		<option value='Shawnee A'>Shawnee A</option>
		<option value='Shawnee B'>Shawnee B</option>
		<option value='Sioux A'>Sioux A</option>
		<option value='Sioux B'>Sioux B</option>
		<option value='Boone A'>Boone A</option>
		<option value='Boone B'>Boone B</option>
		<option value='Boone C'>Boone C</option>
		<option value='Bowie A'>Bowie A</option>
		<option value='Bowie B'>Bowie B</option>
		<option value='Bridger A'>Bridger A</option>
		<option value='Bridger B'>Bridger B</option>
		<option value='Carson A'>Carson A</option>
		<option value='Carson B'>Carson B</option>
		<option value='Clark A'>Clark A</option>
		<option value='Clark B'>Clark B</option>
		<option value='Cody A'>Cody A</option>
		<option value='Cody B'>Cody B</option>
		<option value='Cody C'>Cody C</option>
		<option value='Crocket'>Crocket</option>
		<option value='Lewis A'>Lewis A</option>
		<option value='Lewis B'>Lewis B</option>
		<option value='Powell A'>Powell A</option>
		<option value='Powell B'>Powell B</option>
		<option value='Fremont'>Fremont</option>
		<option value='Whitney A'>Whitney A</option>
		<option value='Whitney B'>Whitney B</option>";
$councilOptions = 
		"<option value='North East Illinois Council'>North East Illinois</option>
		<option value='Bay Lakes Council'>Bay Lakes</option>
		<option value='Blackhawk Area Council'>Blackhawk Area</option>
		<option value='Chicago Area Council'>Chicago Area</option>
		<option value='Calument Council'>Calument</option>
		<option value='DesPlaines Valley Council'>DesPlaines Valley</option>
		<option value='Glaciers Edge Council'>Glaciers Edge</option>
		<option value='Great Lakes Field Service Council'>Great Lakes Field Service</option>
		<option value='Illowa Council'>Illowa</option>
		<option value='Northwest Suburban Council'>Northwest Suburban</option>
		<option value='Northern Star Council'>Northern Star</option>
		<option value='Potawatomi Area Council'>Potawatomi Area</option>
		<option value='Rainbow Area Council'>Rainbow Area</option>
		<option value='Three Fires Council'>Three Fires</option>
		<option value='Three Harbors Council'>Three Harbors</option>";
		
echo '<table class="table table-striped">';
echo '<tr><th>Troop</th><th>Council</th><th>Email</th><th>Weeks</th><th colspan="1"></th></tr>';
$result = mysql_query("SELECT * FROM wp_troops ORDER BY council, number");
while ($row = mysql_fetch_array($result))
{
	$troopID = mysql_real_escape_string($row['id']);
	$year = mysql_real_escape_string($_SESSION['year']);
	$result1 = mysql_query("SELECT * FROM wp_troopsMeta WHERE (troopID = '".$troopID."' AND year = '".$year."') ORDER BY week");
	$weeks = array();
	while ($row1 = mysql_fetch_array($result1))
	{
		$weeks[$row1['week']] = stripslashes($row1['campsite']);
	}
	if (count($weeks) > 0)
	{
		echo "<tr><form method='post'>";
		echo "<td><input type='text' name='number' class='form-control' value='".$row['number']."' style='width:4em;'></td>";
		echo "<td><select name='council' class='form-control'>
		<option value='".stripslashes($row['council'])."'>".str_replace(" Council","",stripslashes($row['council']))."</option>"
		.$councilOptions
		."</select></td>";
		echo "<td><input type='text' name='email' class='form-control' value='".stripslashes($row['email'])."'></td>";
		echo "<td>";
		if (isset($weeks['1'])){$week1=$weeks['1'];}
		else {$week1='--Not Enrolled--';}
		echo "<select name='week1'>
		<option value='".$week1."'>".$week1."</option>"
		.$siteOptions
		."</select><br/>";
		if (isset($weeks['2'])){$week2=$weeks['2'];}
		else {$week2='--Not Enrolled--';}
		echo "<select name='week2'>
		<option value='".$week2."'>".$week2."</option>"
		.$siteOptions
		."</select><br/>";
		if (isset($weeks[3])){$week3=$weeks[3];}
		else {$week3='--Not Enrolled--';}
		echo "<select name='week3'>
		<option value='".$week3."'>".$week3."</option>"
		.$siteOptions
		."</select><br/>";
		if (isset($weeks['4'])){$week4=$weeks['4'];}
		else {$week4='--Not Enrolled--';}
		echo "<select name='week4'>
		<option value='".$week4."'>".$week4."</option>"
		.$siteOptions
		."</select><br/>";
		if (isset($weeks['5'])){$week5=$weeks['5'];}
		else {$week5='--Not Enrolled--';}
		echo "<select name='week5'>
		<option value='".$week5."'>".$week5."</option>"
		.$siteOptions
		."</select><br/>";
		if (isset($weeks['6'])){$week6=$weeks['6'];}
		else {$week6='--Not Enrolled--';}
		echo "<select name='week6'>
		<option value='".$week6."'>".$week6."</option>"
		.$siteOptions
		."</select>";
		echo "</td>";
		echo "<td><input type='hidden' name='troop' value='".$row['id']."'><input type='hidden' name='page' value='adminTroopSave'><button type='submit' value='save' class='btn btn-primary'><span class='glyphicon glyphicon-floppy-saved'></span> Save</button></form></td>";
		echo "</tr>";
	}
}
echo "</table>";

echo getCopy("add_troop");
echo "<form method='post'>";
echo "<input type='text' name='number' class='form-control' placeholder='Troop No.' style='width:33%;'>";
echo "<select name='council' class='form-control' style='width:33%;'>"
.$councilOptions
."</select>";
echo "<input type='text' name='email' class='form-control' placeholder='Email' style='width:33%;'>";
echo "Week 1: <select name='week1'>"
.$siteOptions
."</select><br/>";
echo "Week 2: <select name='week2'>"
.$siteOptions
."</select><br/>";
echo "Week 3: <select name='week3'>"
.$siteOptions
."</select><br/>";
echo "Week 4: <select name='week4'>"
.$siteOptions
."</select><br/>";
echo "Week 5: <select name='week5'>"
.$siteOptions
."</select><br/>";
echo "Week 6: <select name='week6'>"
.$siteOptions
."</select><br/>";
echo "<input type='hidden' name='page' value='adminTroopAdd'><button type='submit' value='Add Troop' class='btn btn-primary'><span glyphicon glyphicon-arrow-right></span> Add Troop</button></form>";
?>