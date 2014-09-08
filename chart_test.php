<html>
<head>
<title>Create Top 10 Chart in MySQL Database</title>
<script>
function showHint(str,sql_col) {
  if (str.length==0) {
    document.getElementById("txtHintname").innerHTML="";
	document.getElementById("txtHintband").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint"+sql_col).innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","gethint.php?find="+str+"&sql_col="+sql_col,true);
  xmlhttp.send();
}

function Set_name(str,col)
{
	document.getElementById(col+"_name").value=str;
	showHint("");
}

	
</script>
</head>
<body>
<form method="post" action="<?php $_PHP_SELF ?>">
<?php
/*
if(isset($_POST['add']))
{
$dbhost = 'localhost:3036';
$dbuser = 'stryfe3_CS';
$dbpass = 'stryfePUB1';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

if(! get_magic_quotes_gpc() )
{
   $tutorial_title = addslashes ($_POST['tutorial_title']);
   $tutorial_author = addslashes ($_POST['tutorial_author']);
   $test_query =  addslashes ($_POST['test_query']);
}
else
{
   $tutorial_title = $_POST['tutorial_title'];
   $tutorial_author = $_POST['tutorial_author'];
   $test_query = $_POST['test_query'];
}
$submission_date = $_POST['submission_date'];

$db_selected = mysql_select_db('stryfe3_TL', $conn);
if (!$db_selected) {
    die ('Can\'t use stryfe3_TL : ' . mysql_error());
}



$line=1;
$col_array = array('Song_ID', 'Name', 'Band', 'Album', 'Category', 'Sub_cat', 'Youtube', 'Amazon', 'Itunes', 'Google_play');

for($i=0;$i < max(array_keys($col_array)); $i++)
	{
	$col_array2[$i] = $col_array[$i] . $line;
	}

$col= 1;
	
$sql = "INSERT INTO Songs ".
       "(Song_ID, Name, Band, Album, Category, Sub_cat, Youtube, Amazon, Itunes, Google_play) ".
       "VALUES ".
       "('" . $_POST['Song_ID1' ] . "', '" .
	   $_POST[$col_array2[$col++]] . "', '" .
	   $_POST[$col_array2[$col++]] . "', '" .
	   $_POST[$col_array2[$col++]] . "', '" .
	   $_POST[$col_array2[$col++]] . "', '" .
	   $_POST[$col_array2[$col++]] . "', '" .
	   $_POST[$col_array2[$col++]] . "', '" .
	   $_POST[$col_array2[$col++]] . "', '" .
	   $_POST[$col_array2[$col++]] . "', '" .
	   $_POST[$col_array2[$col++]] . "')" ;
	   //"$_POST['Band' . $line], $_POST['Album' . $line], $_POST['Category' . $line], $_POST['Sub_cat' . $line], $_POST['Youtube' . $line], $_POST['Amazon' . $line], $_POST['Itunes' . $line], $_POST['Google_play' . $line])";

//$sql = "SELECT * from tutorials_tbl";

if($_POST[Name] != "")
{
	$retval = mysql_query( $sql, $conn );
}

if(!$retval and $_POST[Name] != "")
{
	echo 'Could not enter data: ' . "$sql \n" . mysql_error();
}
else
{
	echo "Entered data successfully\n";
}

if( $test_query != "")
{
	$query = $test_query;
}
else
{
	$query = "select Songs.*, Charts.* from Songs, Charts Where Songs.Song_ID = Charts.Song_ID ";
}

$result = mysql_query($query,$conn);

echo "<table border='1'>\n<tr>";
//echo "$query";

$row = mysql_fetch_array($result);

$i=0;
while($i <= max(array_keys($row)))
{
	$header[$i] = mysql_field_name($result, $i);
	echo "\n  <th>" . $header[$i] . "</th>";
	$i++;
}
echo "\n</tr>\n";
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
	
echo '<button onclick="this.innerHTML=Date()">The time is?</button>'
while($row = mysql_fetch_array($result)) {
  echo "<tr>";
  $i=0;
  $r=2;
    while($i <= max(array_keys($row)))
	{
		//echo "\n <th>" . mysql_field_name($result, $i) . "</th>";
		echo "<td>";
		if ( !strncasecmp($row[$i],"http",4) )
		{
			echo '<a href="' . $row[$i] . '" target="_blank">';
		}
			
		echo $row[$i]; 
		if ( !strncasecmp($row[$i],"http",4) )
		{
			echo '</a>';
		}
		
		echo "</td>\n";
		$i++;
	}
  echo "</tr>\n";
}

echo "</table>\n";
mysql_close($conn);
}
*/
{
?>

<table width="600" border="0" cellspacing="1" cellpadding="2">
<tr>
<td>Song name: </td><td><input type="text" onkeyup="showHint(this.value,'name')" id="name_name"></td>
<td>Band name: </td><td><input type="text" onkeyup="showHint(this.value,'band')" id="band_name"></td>
</tr>
<tr>
<td>Suggestions: </td><td><span id="txtHintname"></span></td>
<td></td><td><span id="txtHintband"></span></td>
</tr>
<tr>
</tr>
<tr>
</tr>
<tr>
</table>
<table>
<tr>
<td width="250" onclick="Set_name(this.innerHTML)">Sql Test</td>
<td>
<textarea rows="4" cols="50" name="test_query" id="test_query">
<?php echo "$query";?>
</textarea>
</td>
</tr>
<tr>
<td width="250"> </td>
<td> </td>
</tr>
<tr>
<td width="250"> </td>
<td>
<input name="add" type="submit" id="add" value="Add Tutorial">
</td>
</tr>
</table>
</form>
<?php
}
?>
</body>
</html>