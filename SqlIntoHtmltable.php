<?php
{
//$query select query to pass to table
//$boxtype inside the <TD> tags
//$table_options full html info and settings on table to pass back
//	ex:	<table border='1'>
function to_table($query, $boxtype, $table_options)
	{
	require "db_connect.php";

		//$query = "select Songs.Name, Songs.Band, This_week, Last_week, Chart_date, Username, List_name from Songs, Charts limit 10 ";

	//$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	$result = mysql_query($query,$conn);
	
	if($table_options != null)
	{
	echo "$table_options\n<tr>";
	}
	else
	{
		echo "<table border='1'>\n<tr>";
	}
	//echo "$query";

	$row = mysql_fetch_array($result);

	$i=0;
	while($i <= max(array_keys($row)))
	{
		$header[$i] = mysql_field_name($result, $i);
		echo "\n  <th>" . str_replace('_', " ", $header[$i]) . "</th>";
		$i++;
	}
	echo "\n</tr>\n<tr>";
		$i=0;
		$r=1;
		while($i <= max(array_keys($row)))
		{
			//echo "\n <th>" . mysql_field_name($result, $i) . "</th>";
			echo "<td>";
			if ( !strncasecmp($row[$i],"http",4) )
			{
				echo '<a href="' . $row[$i] . '" target="_blank">_link_</a>';
			}
				
			echo "<input name='$header[$i]$r' type='text' id='$header[$i]$r' value='$row[$i]'>" ; //.$row[$i]; 
			//if ( !strncasecmp($row[$i],"http",4) )
			//{
			//	echo '</a>';
			//}
			
			echo "</td>\n";
			$i++;
		}
		
	//echo '<button onclick="this.innerHTML=Date()">The time is?</button>';
	$r=2;
	while($row = mysql_fetch_array($result)) {
	  echo "<tr>";
	  $i=0;
	  
		while($i <= max(array_keys($row)))
		{
			//echo "\n <th>" . mysql_field_name($result, $i) . "</th>";
			echo "<td>";
			if ( !strncasecmp($row[$i],"http",4) )
			{		
				echo '<a href="' . $row[$i] . '" target="_blank">';
			}
			echo "<input name='$header[$i]$r' type='text' id='$header[$i]$r' value='$row[$i]'>" ;	
			//echo $row[$i]; 
			if ( !strncasecmp($row[$i],"http",4) )
			{
				echo '</a>';
			}
			
			echo "</td>\n";
			$i++;
			
		}
		$r++;
	  echo "</tr>\n";
	}

	echo "</table>\n";
	}
}
//to_table("select Songs.Name, Songs.Band, This_week, Last_week, Chart_date, Username, List_name from Songs, Charts limit 10 ","","");
?>