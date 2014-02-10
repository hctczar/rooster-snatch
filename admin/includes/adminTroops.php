<?php
$active = $_SESSION["active"];
$year = mysql_real_escape_string($_SESSION['year']);
echo $adminMenu;

$campsites = array();
$campsites[]=array('east','Blackfoot',array('A','B','AB'));
$campsites[]=array('east','Cheyenne',array('A','B','AB'));
$campsites[]=array('east','Chippewa',array('A','B','AB'));
$campsites[]=array('east','Commanche',array('A','B','AB'));
$campsites[]=array('east','Delaware',array('A','B','AB'));
$campsites[]=array('east','Iroquois',array('A','B','AB'));
$campsites[]=array('east','Menominee',array('A','B','AB'));
$campsites[]=array('east','Mohawk',array('A','B','AB'));
$campsites[]=array('east','Shawnee',array('A','B','AB'));
$campsites[]=array('east','Sioux',array('A','B','AB'));
$campsites[]=array('west','Boone',array('A','B','C','AB','AC','BC','ABC'));
$campsites[]=array('west','Bowie',array('A','B','AB'));
$campsites[]=array('west','Bridger',array('A','B','AB'));
$campsites[]=array('west','Carson',array('A','B','AB'));
$campsites[]=array('west','Clark',array('A','B','AB'));
$campsites[]=array('west','Cody',array('A','B','C','AB','AC','BC','ABC'));
$campsites[]=array('west','Crocket',array('A'));
$campsites[]=array('west','Lewis',array('A','B','AB'));
$campsites[]=array('west','Powell',array('A','B','AB'));
$campsites[]=array('west','Fremont',array('A'));
$campsites[]=array('west','Whitney',array('A','B','AB'));
//builds a site option string to populate the select elements. ALSO builds an identical (but 1000% javascriptier and 30% more associative) array client side. Which could be fun to play with later.
$siteOptions= "";
$javaSiteArray = "<script>var sites = new Array();";
for($i=0;$i<count($campsites);$i++)
{
	$javaSiteArray .= "sites['".$campsites[$i][1]."']=['".$campsites[$i][0]."','".$campsites[$i][1]."',[";
	for ($j=0;$j<count($campsites[$i][2]);$j++)
	{
		$javaSiteArray .="'".$campsites[$i][2][$j]."',";
	}
	$javaSiteArray = trim($javaSiteArray,',');
	$javaSiteArray .= "]];";
	$siteOptions = $siteOptions."<option class='".$campsites[$i][0]."' value='".$campsites[$i][1]."'>".$campsites[$i][1]."</option>";
}
$javaSiteArray .="</script>";
echo $javaSiteArray;
//builds those site options even more
$resultNo=0;
function showSelect($week,$troop)
{
	global $weeks, $subsites, $siteOptions, $resultNo, $year, $iter;
	$troop = mysql_real_escape_string($troop);
	if (isset ($weeks[$week]))
	{
		$result = mysql_query("SELECT * FROM wp_roster WHERE year = '".$year."' AND week = '".$week."' AND troopID = '".$troop."'");
		$rosterSize = mysql_num_rows($result);
		$site = $weeks[$week];
		$subsite = $subsites[$week];
		echo "<table><tr><td><select class='siteSelect".$week."' name = '".$iter."week".$week."' id='".$resultNo."caller".$week."' onchange='buildSubSites(\"".$resultNo."subSite".$week."\",\"".$resultNo."caller".$week."\");checkConflicts(\"".$resultNo."subSite".$week."\",\"".$resultNo."caller".$week."\",\"".$week."\");'>
		<option value='".$site."'>".$site."</option>"
		.$siteOptions
		."</select></td><td>
		<select class='subsiteSelect".$week."' name = '".$iter."subSite".$week."' id='".$resultNo."subSite".$week."' onmouseover='buildSubSites(\"".$resultNo."subSite".$week."\",\"".$resultNo."caller".$week."\");' onchange='checkConflicts(\"".$resultNo."subSite".$week."\",\"".$resultNo."caller".$week."\",\"".$week."\");'><option value='".$subsite."'>".$subsite."</option></select>
		</td></tr></table>";
	}
}
function showTroopSize($week,$troop)
{
	global $weeks, $subsites, $siteOptions, $resultNo, $year;
	$troop = mysql_real_escape_string($troop);
	if (isset ($weeks[$week]))
	{
		$result = mysql_query("SELECT * FROM wp_roster WHERE year = '".$year."' AND week = '".$week."' AND troopID = '".$troop."' AND youth = '0'");
		$adultSize = mysql_num_rows($result);
		$result = mysql_query("SELECT * FROM wp_roster WHERE year = '".$year."' AND week = '".$week."' AND troopID = '".$troop."' AND youth = '1'");
		$youthSize = mysql_num_rows($result);
		echo "<table><tr><td>".$adultSize."A ".$youthSize."Y"."</td></tr></table>";
	}
}
?>

<script>
function checkConflicts(subsite,site,week)
{
	activeSite = document.getElementById(site).value;
	if (!activeSite){return;}
	activeSubsite = document.getElementById(subsite).value;
	var resSites = document.getElementsByClassName('siteSelect'+week);
	var resSubsites = document.getElementsByClassName('subsiteSelect'+week);
	for (var i=0;i<resSites.length;i++)
	{
		if (document.getElementById(site) === resSites[i])
		{
			continue;
		}
		if (activeSite == resSites[i].value)
		{
			for (var j=0;j<activeSubsite.length;j++)
			{
				if (resSubsites[i].value.search(activeSubsite[j]) != -1)
				{
					alert("Another troop is signed up for "+resSites[i].value+" "+resSubsites[i].value+" during week "+week+"!");
				}
			}
		}
	}
}
function buildSubSites(label,caller)
{
	activeSite = document.getElementById(caller).value;
	subSelector = document.getElementById(label);
	stringorama= '<option value="'+subSelector.value+'">'+subSelector.value+'</option>';
	for (var i=0;i<sites[activeSite][2].length;i++)
	{
		stringorama += '<option value="'+sites[activeSite][2][i]+'">'+sites[activeSite][2][i]+'</option>';
	}
	subSelector.innerHTML=stringorama;
}
</script>
<?php
$councilOptions = 
		"<option value='NEIC Aptakisic'>NEIC Aptakisic</option>
		<option value='NEIC North Star'>NEIC North Star</option>
		<option value='NEIC Potawatomi'>NEIC Potawatomi</option>
		<option value='NEIC Provisional'>NEIC Provisional</option>
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
?>
<button class='btn btn-primary' onclick="viewTable();">View / Hide List</button>
<p>
  <script>
function viewTable()
{
	if (document.getElementById('troopList').style.display == 'none'){document.getElementById('troopList').style.display = 'block';}
	else {document.getElementById('troopList').style.display = 'none';}
	parent.document.getElementById('iframe1').height = "537px";
	parent.document.getElementById('iframe1').height = document.body.scrollHeight;
	
}
</script>
</p>
<p>
  <?php		
echo '<form method="post"><table class="table table-striped sortable" id="troopList" style="display:none">';
echo '<tr><th style=width:7em;">Troop</th><th>Council</th><th class="sorttable_nosort">Email</th><th>Weeks</th><th class="sorttable_nosort">Sites</th><th colspan="1" class="sorttable_nosort" style=width:6em;">Troop Size</th></tr>';
$result = mysql_query("SELECT * FROM wp_troops ORDER BY council, number");
$iter=0;
while ($row = mysql_fetch_array($result))
{
	$troopID = mysql_real_escape_string($row['id']);
	$result1 = mysql_query("SELECT * FROM wp_troopsMeta WHERE (troopID = '".$troopID."' AND year = '".$year."') ORDER BY week");
	$weeks = array();
	$subsites = array();
	while ($row1 = mysql_fetch_array($result1))
	{
		$weeks[$row1['week']] = stripslashes($row1['campsite']);
		$subsites[$row1['week']] = stripslashes($row1['subsite']);
	}
	if (count($weeks) > 0)
	{
		echo "<tr>";
		echo "<td sorttable_customkey='".$row['number']."'><div class='input-group input-group-sm'><input type='text' name='number".$iter."' class='form-control' value='".$row['number']."' style='width:5em;'></div></td>";
		echo "<td sorttable_customkey='".stripslashes($row['council'])."'><div class='input-group input-group-sm'><select name='council".$iter."' class='form-control'>
		<option value='".stripslashes($row['council'])."'>".str_replace(" Council","",stripslashes($row['council']))."</option>"
		.$councilOptions
		."</select></div></td>";
		echo "<td><div class='input-group input-group-sm'><input type='text' name='email".$iter."' class='form-control' value='".stripslashes($row['email'])."'></div></td>";
		//find the earliest week in which a troop is camping. That week is used to sort the table by week.
		$sort_week_column=0;
		$checkWeek1 = "";
		$checkWeek2 = "";
		$checkWeek3 = "";
		$checkWeek4 = "";
		$checkWeek5 = "";
		$checkWeek6 = "";
		$sort_week_column=0;
		if (isset($weeks['6'])){$sort_week_column=60; $checkWeek6 = "checked='true' ";}
		if (isset($weeks['5'])){$sort_week_column=50 + (bool)$checkWeek6; $checkWeek5 = "checked='true' ";}
		if (isset($weeks['4'])){$sort_week_column=40; $checkWeek4 = "checked='true' ";}
		if (isset($weeks['3'])){$sort_week_column=30 + (bool)$checkWeek4; $checkWeek3 = "checked='true' ";}
		if (isset($weeks['2'])){$sort_week_column=20; $checkWeek2 = "checked='true' ";}
		if (isset($weeks['1'])){$sort_week_column=10 + (bool)$checkWeek2; $checkWeek1 = "checked='true' ";}
		echo "<td sorttable_customkey='".$sort_week_column."'>";
		echo "<table><tr><th class='sorttable_nosort'>1</th><th class='sorttable_nosort'>2</th><th class='sorttable_nosort'>3</th><th class='sorttable_nosort'>4</th><th class='sorttable_nosort'>5</th><th class='sorttable_nosort'>6</th></tr><tr>";
		echo "<td><input name='weeks".$iter."[]' type='checkbox' value='1' $checkWeek1/></td>";
		echo "<td><input name='weeks".$iter."[]' type='checkbox' value='2' $checkWeek2/></td>";
		echo "<td><input name='weeks".$iter."[]' type='checkbox' value='3' $checkWeek3/></td>";
		echo "<td><input name='weeks".$iter."[]' type='checkbox' value='4' $checkWeek4/></td>";
		echo "<td><input name='weeks".$iter."[]' type='checkbox' value='5' $checkWeek5/></td>";
		echo "<td><input name='weeks".$iter."[]' type='checkbox' value='6' $checkWeek6/></td>";
		echo "</tr></table>";
		echo "</td><td>";
		showSelect(1,$troopID);
		showSelect(2,$troopID);
		showSelect(3,$troopID);
		showSelect(4,$troopID);
		showSelect(5,$troopID);
		showSelect(6,$troopID);
		echo "</td>";
		echo "<td>";
		showTroopSize(1,$troopID);
		showTroopSize(2,$troopID);
		showTroopSize(3,$troopID);
		showTroopSize(4,$troopID);
		showTroopSize(5,$troopID);
		showTroopSize(6,$troopID);
		echo "<input type='hidden' name='troop".$iter."' value='".$row['id']."'></td>";
		echo "</tr>";
		$iter +=1;
	}
	$resultNo+=1;
	
}
echo "<tfoot><tr><td colspan='6' align='right'><input type='hidden' name='page' value='adminTroopSave'><button type='submit' value='save' class='btn btn-primary'><span class='glyphicon glyphicon-floppy-saved'></span> Save</button></form></td></tr></tfoot>";
echo "</table>";

echo getCopy("add_troop");
echo "<form method='post'>";
echo "<input type='text' name='number' class='form-control' placeholder='Troop No.' style='width:33%;'>";
echo "<select name='council' class='form-control' style='width:33%;'>"
.$councilOptions
."</select>";
echo "<input type='text' name='email' class='form-control' placeholder='Email' style='width:33%;'>";
echo "<table><tr><th class='sorttable_nosort'>Select Weeks: </th><th class='sorttable_nosort'>1</th><th class='sorttable_nosort'>2</th><th class='sorttable_nosort'>3</th><th class='sorttable_nosort'>4</th><th class='sorttable_nosort'>5</th><th class='sorttable_nosort'>6</th></tr><tr>";
		echo "<td></td><td><input name='weeks[]' type='checkbox' id='checkWeek1' value='1' onchange='showAddWeeks(1)'/></td>";
		echo "<td><input name='weeks[]' type='checkbox' id='checkWeek2' value='2' onchange='showAddWeeks(2)'/></td>";
		echo "<td><input name='weeks[]' type='checkbox' id='checkWeek3' value='3' onchange='showAddWeeks(3)'/></td>";
		echo "<td><input name='weeks[]' type='checkbox' id='checkWeek4' value='4' onchange='showAddWeeks(4)'/></td>";
		echo "<td><input name='weeks[]' type='checkbox' id='checkWeek5' value='5' onchange='showAddWeeks(5)'/></td>";
		echo "<td><input name='weeks[]' type='checkbox' id='checkWeek6' value='6' onchange='showAddWeeks(6)'/></td>";
		echo "</tr></table>";
?>
</p>
<?php
function buildSelect($week)
{
	global $siteOptions;
	echo "<span id='addWeek".$week."' style='display:none;'> Week ".$week.": 
	<select name='week".$week."' id='addWeekSelect".$week."' onchange='getSubsites(\"addSubweekSelect".$week."\",\"addWeekSelect".$week."\"); checkConflicts(\"addSubweekSelect".$week."\",\"addWeekSelect".$week."\",\"".$week."\");'>"
		."<option value=''>save for later</option>"
		.$siteOptions
	."</select>
	<select name = 'subSite".$week."' id='addSubweekSelect".$week."' onchange='checkConflicts(\"addSubweekSelect".$week."\",\"addWeekSelect".$week."\",\"".$week."\");'>
		<option value=''> </option>
	</select><br/></span>";
}
buildSelect(1);
buildSelect(2);
buildSelect(3);
buildSelect(4);
buildSelect(5);
buildSelect(6);
echo "<input type='hidden' name='page' value='adminTroopAdd'><button type='submit' value='Add Troop' class='btn btn-primary'><span glyphicon glyphicon-arrow-right></span> Add Troop</button></form>";
?>
<script>
function showAddWeeks(week)
{
	if (document.getElementById('checkWeek'+week).checked == true)
	{
		document.getElementById('addWeek'+week).style.display='inline';
		parent.document.getElementById('iframe1').height = "537px";
		parent.document.getElementById('iframe1').height = document.body.scrollHeight;
	}
	if (document.getElementById('checkWeek'+week).checked == false)
	{
		document.getElementById('addWeek'+week).style.display='none';
		parent.document.getElementById('iframe1').height = "537px";
		parent.document.getElementById('iframe1').height = document.body.scrollHeight;
	}
}
function getSubsites(label,caller)
{
	activeSite = document.getElementById(caller).value;
	subSelector = document.getElementById(label);
	stringorama= '';
	for (var i=0;i<sites[activeSite][2].length;i++)
	{
		stringorama += '<option value="'+sites[activeSite][2][i]+'">'+sites[activeSite][2][i]+'</option>';
	}
	subSelector.innerHTML=stringorama;
}
</script>
