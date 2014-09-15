<!DOCTYPE html>
<head>
<title>Create Top 10 Chart in MySQL Database</title>
<script>
var xmlhttp=new XMLHttpRequest();
function showHint(str,sql_col,limit_col,row) 
{
  if (str.length==0 && sql_col.length==0) 
  {
    document.getElementById("txtHintname").innerHTML="";
	document.getElementById("txtHintband").innerHTML="";
	
	
	if( document.getElementById("Name1").value.length >= 1 && document.getElementById("Band1").value.length >= 1)
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
  //alert(str + " " +sql_col + " " + limit_col);
  xmlhttp.open("GET","gethint.php?find="+str+"&sql_col="+sql_col+"&limit_col="+limit_col+"&row="+row,true);
  xmlhttp.send();
}

function Set_name(str,col)
{
	alert(str + " " + col);
	document.getElementById(col).value=str;
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
//to_table($query,"","");
?>

<table width="600" border="0" cellspacing="1" cellpadding="2">
<tr>
<th></th>
</tr>
<tr>
<td>Song name: </td><td><input type="text" autocomplete="off" onkeyup="showHint(this.value,'name','')" id="name_name"></td>
<td>Band name: </td><td><input type="text" autocomplete="off" onclick="showHint('','band',name_name.value )" onkeyup="showHint(this.value,'band',name_name.value )" id="band_name"></td>
</tr>
<tr>
<td>Suggestions: </td><td><span id="txtHintname0"></span></td>
<td></td><td><span id="txtHintband0"></span></td>
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

<table border='1'>
<tr>
  <th>Name</th>
  <th>Band</th>
  <th>This week</th>
  <th>Last week</th>
  <th>Chart date</th>
  <th>Username</th>
  <th>List name</th>
</tr>

<?php
/*
<td>Song name: </td><td><input type="text" autocomplete="off" onkeyup="showHint(this.value,'name','')" id="name_name"></td>
<td>Band name: </td><td><input type="text" autocomplete="off" onclick="showHint('','band',name_name.value )" onkeyup="showHint(this.value,'band',name_name.value )" id="band_name"></td>
*/
?>

<tr><td><input type='text' id='name1' autocomplete="off" onkeyup="showHint(this.value,'name','','1')"><br>
<span id="txtHintname"></span></td>
    <td><input name='band1' type='text' id='band1' autocomplete="off" onclick="showHint('','band',name1.value,'1' )" onkeyup="showHint(this.value,'band', name1.value,'1' )"><br>
<span id="txtHintband"></span></td>
<td><select name='This_week1' type='text' id='This_week1'>
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
</select></td>
<td><select name='Last_week1' id='Last_week1'>
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
</td>
<td><input name='Chart_date1' type='date' id='Chart_date1' value='0000-00-00'></td>
<td><input name='Username1' type='text' id='Username1' value='Utest'></td>
<td><input name='List_name1' type='text' id='List_name1' value=''></td>
<tr><td><input name='Name2' type='text' id='Name2' value='Cardiac Arrest'></td>
<td><input name='Band2' type='text' id='Band2' value='Bad Suns'></td>
<td><input name='This_week2' type='text' id='This_week2' value='2'></td>
<td><input name='Last_week2' type='text' id='Last_week2' value='new'></td>
<td><input name='Chart_date2' type='text' id='Chart_date2' value='2014-09-02'></td>
<td><input name='Username2' type='text' id='Username2' value='Utest'></td>
<td><input name='List_name2' type='text' id='List_name2' value=''></td>
</tr>
<tr><td><input name='Name3' type='text' id='Name3' value='Cardiac Arrest'></td>
<td><input name='Band3' type='text' id='Band3' value='Bad Suns'></td>
<td><input name='This_week3' type='text' id='This_week3' value='3'></td>
<td><input name='Last_week3' type='text' id='Last_week3' value='2'></td>
<td><input name='Chart_date3' type='text' id='Chart_date3' value='0000-00-00'></td>
<td><input name='Username3' type='text' id='Username3' value='Utest'></td>
<td><input name='List_name3' type='text' id='List_name3' value=''></td>
</tr>
<tr><td><input name='Name4' type='text' id='Name4' value='Cardiac Arrest'></td>
<td><input name='Band4' type='text' id='Band4' value='Bad Suns'></td>
<td><input name='This_week4' type='text' id='This_week4' value='1'></td>
<td><input name='Last_week4' type='text' id='Last_week4' value='1'></td>
<td><input name='Chart_date4' type='text' id='Chart_date4' value='2014-09-04'></td>
<td><input name='Username4' type='text' id='Username4' value='Utest2'></td>
<td><input name='List_name4' type='text' id='List_name4' value=''></td>
</tr>
<tr><td><input name='Name5' type='text' id='Name5' value='Cardiac Arrest'></td>
<td><input name='Band5' type='text' id='Band5' value='Bad Suns'></td>
<td><input name='This_week5' type='text' id='This_week5' value='2'></td>
<td><input name='Last_week5' type='text' id='Last_week5' value='2'></td>
<td><input name='Chart_date5' type='text' id='Chart_date5' value='2014-09-04'></td>
<td><input name='Username5' type='text' id='Username5' value='Utest2'></td>
<td><input name='List_name5' type='text' id='List_name5' value=''></td>
</tr>
<tr><td><input name='Name6' type='text' id='Name6' value='Dangerous'></td>
<td><input name='Band6' type='text' id='Band6' value='Big Data'></td>
<td><input name='This_week6' type='text' id='This_week6' value='1'></td>
<td><input name='Last_week6' type='text' id='Last_week6' value='new'></td>
<td><input name='Chart_date6' type='text' id='Chart_date6' value='0000-00-00'></td>
<td><input name='Username6' type='text' id='Username6' value='Utest'></td>
<td><input name='List_name6' type='text' id='List_name6' value=''></td>
</tr>
<tr><td><input name='Name7' type='text' id='Name7' value='Dangerous'></td>
<td><input name='Band7' type='text' id='Band7' value='Big Data'></td>
<td><input name='This_week7' type='text' id='This_week7' value='2'></td>
<td><input name='Last_week7' type='text' id='Last_week7' value='new'></td>
<td><input name='Chart_date7' type='text' id='Chart_date7' value='2014-09-02'></td>
<td><input name='Username7' type='text' id='Username7' value='Utest'></td>
<td><input name='List_name7' type='text' id='List_name7' value=''></td>
</tr>
<tr><td><input name='Name8' type='text' id='Name8' value='Dangerous'></td>
<td><input name='Band8' type='text' id='Band8' value='Big Data'></td>
<td><input name='This_week8' type='text' id='This_week8' value='3'></td>
<td><input name='Last_week8' type='text' id='Last_week8' value='2'></td>
<td><input name='Chart_date8' type='text' id='Chart_date8' value='0000-00-00'></td>
<td><input name='Username8' type='text' id='Username8' value='Utest'></td>
<td><input name='List_name8' type='text' id='List_name8' value=''></td>
</tr>
<tr><td><input name='Name9' type='text' id='Name9' value='Dangerous'></td>
<td><input name='Band9' type='text' id='Band9' value='Big Data'></td>
<td><input name='This_week9' type='text' id='This_week9' value='1'></td>
<td><input name='Last_week9' type='text' id='Last_week9' value='1'></td>
<td><input name='Chart_date9' type='text' id='Chart_date9' value='2014-09-04'></td>
<td><input name='Username9' type='text' id='Username9' value='Utest2'></td>
<td><input name='List_name9' type='text' id='List_name9' value=''></td>
</tr>
<tr><td><input name='Name10' type='text' id='Name10' value='Dangerous'></td>
<td><input name='Band10' type='text' id='Band10' value='Big Data'></td>
<td><input name='This_week10' type='text' id='This_week10' value='2'></td>
<td><input name='Last_week10' type='text' id='Last_week10' value='2'></td>
<td><input name='Chart_date10' type='text' id='Chart_date10' value='2014-09-04'></td>
<td><input name='Username10' type='text' id='Username10' value='Utest2'></td>
<td><input name='List_name10' type='text' id='List_name10' value=''></td>
</tr>
</table>

<table width="600" border="0" cellspacing="1" cellpadding="2">
</body>
</html>