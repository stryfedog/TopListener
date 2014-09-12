<!DOCTYPE html>
<head>
<title>Create Top 10 Chart in MySQL Database</title>
<script>
var xmlhttp=new XMLHttpRequest();
function showHint(str,sql_col,limit_col) 
{
  if (str.length==0 && sql_col.length==0) 
  {
    document.getElementById("txtHintname").innerHTML="";
	document.getElementById("txtHintband").innerHTML="";
	
	
	if( document.getElementById("name_name").value.length >= 1 && document.getElementById("band_name").value.length >= 1)
	{		
		call_song();		
	}
    return;
  }
  
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) 
	{
      document.getElementById("txtHint"+sql_col).innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","gethint.php?find="+str+"&sql_col="+sql_col+"&limit_col="+limit_col,true);
  xmlhttp.send();
}

function Set_name(str,col)
{
	document.getElementById(col+"_name").value=str;
	showHint("","");
}

function call_song()
{
		
	xmlhttp.onreadystatechange=function() {
		
		if (xmlhttp.readyState==4 && xmlhttp.status==200) 
		{
			document.getElementById("song_id").innerHTML=xmlhttp.responseText;
			
		}
	}
	
	xmlhttp.open("GET","getsonginfo.php?find="+document.getElementById('name_name').value+"&find2="+document.getElementById('band_name').value,true);
	xmlhttp.send();
	return;
}
</script>
</head>
<body>
<form method="post" action="<?php $_PHP_SELF ?>">
<?php

//if(isset($_POST['Song_ID']))
{
	require "db_connect.php";
}

require_once "SqlIntoHtmltable.php";
/*
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

mysql_close($conn);
}
*/
{
?>

<?php

$query = "select Songs.Name, Songs.Band, This_week, Last_week, Chart_date, Username, List_name from Songs, Charts limit 10 ";
to_table($query,"","");
?>

<table width="600" border="0" cellspacing="1" cellpadding="2">
<tr>
<th></th>
<td>Song name: </td><td><input type="text" autocomplete="off" onkeyup="showHint(this.value,'name','')" id="name_name"></td>
<td>Band name: </td><td><input type="text" autocomplete="off" onclick="showHint('','band',name_name.value )" onkeyup="showHint(this.value,'band',name_name.value )" id="band_name"></td>
</tr>
<tr>
<td>Suggestions: </td><td><span id="txtHintname"></span></td>
<td></td><td><span id="txtHintband"></span></td>
</tr>
<tr>
<td><span id="song_id"></span></td>
<td><span id="chart"></span></td>
</tr>
<tr>
<td>This week postion</td><td><select>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
<tr>
<td>Last week postion</td><td><select>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="New">New</option>
</select>
</tr>
<tr>
<td>Chart Date</td><td><input value= "<?php echo date("Y-m-d")?>"></td>
</tr>
<tr>
<td>Username</td><td><input ></td>
</tr>
<tr>
<td>Private List</td><td><input type="checkbox" value="PL" id="private"></td>
</tr>
<tr>
<td>List name</td><td><input value="<?php echo date("Y-m-d")?>"></td>
</tr>
</table>
<table>
<tr>
<td width="250" id="test_btn" onclick="call_song()">Sql Test</td>
<td>
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