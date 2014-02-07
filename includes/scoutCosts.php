<?php
echo $scoutMenu;
$active = mysql_real_escape_string(substr($_SESSION["active"],1));
$year = mysql_real_escape_string($_SESSION['year']);
echo getCopy("scout_cost");
//discover what weeks scouts are camping.
$weeks = array();
$year = mysql_real_escape_string($_SESSION['year']);
$result = mysql_query("SELECT * FROM wp_roster WHERE (year = '".$year."' AND camperID = '".$active."') ORDER BY week");
while ($row = mysql_fetch_array($result))
{
	$weeks[]=$row['week'];
}
for($i=0;$i<count($weeks);$i++)
{
	echo "<h3>Week ".$weeks[$i].":</h3>";
	echo "<table class='table table-striped'><tr><th>Badge</th><th></th><th align='right'>Estimated Cost</th></tr>";
	$result = mysql_query("SELECT * FROM wp_signups WHERE year = '".$year."' AND week = '".$weeks[$i]."' AND scoutID = '".$active."' AND backup = '0'");
	$totalCost = 0;
	while ($row=mysql_fetch_array($result))
	{
		$result1 = mysql_query("SELECT * FROM wp_badges WHERE id = '".mysql_real_escape_string($row['badge'])."'");
		$row1 = mysql_fetch_array($result1);
		$badge = $row1['badge'];
		$costs = array();
		
		preg_match_all('/\$[0123456789\.]+/', $row1['cost'], $costs, PREG_PATTERN_ORDER);
		$badgeCost = 0;
		for ($j=0;$j<count($costs[0]);$j++)
		{
			$costs[0][$j]=substr($costs[0][$j],1);
			$badgeCost += (float)$costs[0][$j];
		}
		$totalCost += $badgeCost;
		if ($badgeCost > 0)
		{
			$lineItems = array();
			$lineItems = preg_split( "/(: |\n)/", $row1['cost'] );
			//$lineItems = explode(": ",$row1['cost']);
			$lineItemsPrint = '';
			$lineCostsPrint = '';
			for ($k=0 ; $k < count($lineItems) ; $k+=2)
			{
				$lineItemsPrint .= $lineItems[$k].":<br/>";
				$lineCostsPrint .= $lineItems[$k+1]."<br/>";
			}
			echo "<tr><td>".$badge."</td><td></td><td align='right'>$".number_format($badgeCost,2)."<td></tr><tr><td></td><td align='right'><em>".$lineItemsPrint."</em></td><td align='right'><em>".$lineCostsPrint."</em></td></tr>";
		}
	}
	echo "<tfoot><tr><td><strong>Total:</strong></td><td></td><td align = 'right'><strong>$".$totalCost."</strong></td></tr></tfoot>";
	echo "</table>";
}
?>