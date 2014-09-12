<html>
<head>
<title>Add New Record in MySQL Database</title>
</head>
<body>
<form method="post" action="<?php $_PHP_SELF ?>">
<?php
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

$db_selected = mysql_select_db('stryfe3_TL', $conn);
if (!$db_selected) {
    die ('Can\'t use _TL_DB : ' . mysql_error());
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
/*
//$sql = "SELECT * from tutorials_tbl";
*/
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
  //echo "<td>" . $row['tutorial_title'] . "</td>";
  //echo "<td>" . $row['tutorial_author'] . "</td>";
  //echo "<td>" . $row['submission_date'] . "</td>";
  echo "</tr>\n";
}

echo "</table>\n";
mysql_close($conn);
}

{
?>

<table width="600" border="0" cellspacing="1" cellpadding="2">
<tr>
<td width="250">Tutorial Title</td>
<td>
<input name="tutorial_title" type="text" id="tutorial_title">
</td>
</tr>
<tr>
<td width="250">Tutorial Author</td>
<td>
<input name="tutorial_author" type="text" id="tutorial_author">
</td>
</tr>
<tr>
<td width="250">Submission Date [ yyyy-mm-dd ]</td>
<td>
<input name="submission_date" type="text" id="submission_date">
</td>
</tr>
<tr>
<td width="250">Sql Test</td>
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