<html>
<head>
<title>Add New Record in MySQL Database</title>
</head>
<body>
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

/*
$sql = "INSERT INTO tutorials_tbl ".
       "(tutorial_title, tutorial_author, submission_date) ".
       "VALUES ".
       "('$tutorial_title','$tutorial_author','$submission_date');";

//$sql = "SELECT * from tutorials_tbl";
*/
$db_selected = mysql_select_db('stryfe3_TL', $conn);
if (!$db_selected) {
    die ('Can\'t use stryfe3_TL : ' . mysql_error());
}
//$retval = mysql_query( $sql, $conn );

/*
if(!$retval)
{
  die('Could not enter data: ' . "$sql \n" . mysql_error());
}
*/
echo "Entered data successfully\n";

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
while($i <= max(array_keys($row)))
{
	echo "\n <th>" . mysql_field_name($result, $i) . "</th>";
	$i++;
}
echo "\n </tr>";
	$i=0;
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
<form method="post" action="<?php $_PHP_SELF ?>">
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