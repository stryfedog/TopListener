<!DOCTYPE html>
<head>
<title>Create Top 10 Chart in MySQL Database</title>
<script>
var xmlhttp=new XMLHttpRequest();
function showHint(str,sql_col,limit_col,row) 
{
  if (str.length==0 && sql_col.length==0) 
  {
	//alert("txtHintname"+row);
    document.getElementById("txtHintname"+row).innerHTML="";
	document.getElementById("txtHintband"+row).innerHTML="";
	
	
	if( document.getElementById("name"+row).value.length >= 1 && document.getElementById("band"+row).value.length >= 1)
	{		
		call_song(row);	
		alert("target" +document.getElementById('song_id'+1).value);
	}
    return;
  }
  
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) 
	{
      document.getElementById("txtHint"+sql_col+row).innerHTML=xmlhttp.responseText;
    }
  }
  //alert(str + " " +sql_col + " " + limit_col);
  xmlhttp.open("GET","gethint.php?find="+str+"&sql_col="+sql_col+"&limit_col="+limit_col+"&row="+row,true);
  xmlhttp.send();
}

function Set_name(str,col)
{
	//alert(str + " " + col);
	document.getElementById(col).value=str;
	showHint("","","",col.match(/[0-9]/) );
}

function call_song(row)
{
	
	xmlhttp.onreadystatechange=function()	{
		//alert(2);
		if (xmlhttp.readyState==4 && xmlhttp.status==200) 
		{
			//alert(3);
			document.getElementById("song_id" +row).value=xmlhttp.responseText;
			
		}
	}
	
	alert("getsonginfo.php?find="+document.getElementById('name'+row).value+"&find2="+document.getElementById('band'+row).value);
	xmlhttp.open("GET","getsonginfo.php?find="+document.getElementById('name'+row).value+"&find2="+document.getElementById('band'+row).value,true);
	xmlhttp.send();
	
	return;
}
</script>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_PHP_SELF) ?>">
<?php

//if(isset($_POST['Song_ID']))
{
	require "db_connect.php";
}

require_once "SqlIntoHtmltable.php";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['Username1']))
{
	$r[0]="'" . test_input($_POST['Chart_date1']) . "'" ;
	$r[1]="'" . test_input($_POST['Username1']) . "'" ;
	$r[2]="'" . test_input($_POST['List_name1']) . "'" ;
	
	$ins_sql = "insert into Charts (Song_ID, This_week,Last_week, Chart_date, Username, List_name) values(";
	$ins_sql .= test_input($_REQUEST['song_id1']) . "," . test_input($_POST['This_week1']) . ",'" . test_input($_POST['Last_week1']) . "'," . $r[0] . "," . $r[1] . "," . $r[2] . "),(";
	$ins_sql .= test_input($_REQUEST['song_id2']) . "," . test_input($_POST['This_week2']) . ",'" . test_input($_POST['Last_week2']) . "'," . $r[0] . "," . $r[1] . "," . $r[2] . "),(";
	$ins_sql .= test_input($_REQUEST['song_id3']) . "," . test_input($_POST['This_week3']) . ",'" . test_input($_POST['Last_week3']) . "'," . $r[0] . "," . $r[1] . "," . $r[2] . "),(";
	$ins_sql .= test_input($_REQUEST['song_id4']) . "," . test_input($_POST['This_week4']) . ",'" . test_input($_POST['Last_week4']) . "'," . $r[0] . "," . $r[1] . "," . $r[2] . "),(";
	$ins_sql .= test_input($_REQUEST['song_id5']) . "," . test_input($_POST['This_week5']) . ",'" . test_input($_POST['Last_week5']) . "'," . $r[0] . "," . $r[1] . "," . $r[2] . "),(";
	$ins_sql .= test_input($_REQUEST['song_id6']) . "," . test_input($_POST['This_week6']) . ",'" . test_input($_POST['Last_week6']) . "'," . $r[0] . "," . $r[1] . "," . $r[2] . "),(";
	$ins_sql .= test_input($_REQUEST['song_id7']) . "," . test_input($_POST['This_week7']) . ",'" . test_input($_POST['Last_week7']) . "'," . $r[0] . "," . $r[1] . "," . $r[2] . "),(";
	$ins_sql .= test_input($_REQUEST['song_id8']) . "," . test_input($_POST['This_week8']) . ",'" . test_input($_POST['Last_week8']) . "'," . $r[0] . "," . $r[1] . "," . $r[2] . "),(";
	$ins_sql .= test_input($_REQUEST['song_id9']) . "," . test_input($_POST['This_week9']) . ",'" . test_input($_POST['Last_week9']) . "'," . $r[0] . "," . $r[1] . "," . $r[2] . "),(";
	$ins_sql .= test_input($_REQUEST['song_id0']) . "," . test_input($_POST['This_week0']) . ",'" . test_input($_POST['Last_week0']) . "'," . $r[0] . "," . $r[1] . "," . $r[2] . "";
	$ins_sql .= ")";
	
	echo $ins_sql;
}

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
<td>Suggestions: </td><td><span id="txtHintnamealt"></span></td>
<td></td><td><span id="txtHintbandalt"></span></td>
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
<td width="250" id="test_btn" onclick="call_song('1')">Sql Test</td>
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
<input name="add" type="submit" id="add" value="Add Chart">
</td>
</tr>
</table>

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

<tr><td><input type='text' name='name1' id='name1' autocomplete="off" onkeyup="showHint(this.value,'name','','1')"><br>
<span id="txtHintname1"></span></td>
    <td><input name='band1' type='text' id='band1' autocomplete="off" onclick="showHint('','band',name1.value,'1' )" onkeyup="showHint(this.value,'band', name1.value,'1' )"><br>
<span id="txtHintband1"></span></td>
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
<td><input name='Chart_date1' type='date' id='Chart_date1' value='<?php echo date("Y-m-d")?>'></td>
<td><input name='Username1' type='text' id='Username1' value='Utest'></td>
<td><input name='List_name1' type='text' id='List_name1' value='<?php echo date("Y-m-d")?>'><input name="song_id1" type = "hidden" id="song_id1" value=""></td>

</tr>
<tr><td><input type='text' id='name2' autocomplete="off" onkeyup="showHint(this.value,'name','','2')"><br>
<span id="txtHintname2"></span></td>
    <td><input name='band2' type='text' id='band2' autocomplete="off" onclick="showHint('','band',name2.value,'2' )" onkeyup="showHint(this.value,'band', name2.value,'2' )"><br>
<span id="txtHintband2"></span></td>
<td><select name='This_week2' type='text' id='This_week2'>
  <option value="1">1</option>
  <option value="2" selected>2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>  
</select></td>
<td><select name='Last_week2' id='Last_week2'>
  <option value="1">1</option>
  <option value="2" selected>2</option>
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
<td><input name='Chart_date2' type='date' id='Chart_date2' value='<?php echo date("Y-m-d")?>'></td>
<td><input name='Username2' type='text' id='Username2' value='Utest'></td>
<td><input name='List_name2' type='text' id='List_name2' value='<?php echo date("Y-m-d")?>'><input name="song_id2" type = "hidden" id="song_id2" value=""></td>
</tr>
<tr><td><input type='text' id='name3' autocomplete="off" onkeyup="showHint(this.value,'name','','3')"><br>
<span id="txtHintname3"></span></td>
    <td><input name='band3' type='text' id='band3' autocomplete="off" onclick="showHint('','band',name3.value,'3' )" onkeyup="showHint(this.value,'band', name3.value,'3' )"><br>
<span id="txtHintband3"></span></td>
<td><select name='This_week3' type='text' id='This_week3'>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3" selected>3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>  
</select></td>
<td><select name='Last_week3' id='Last_week3'>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3" selected>3</option>
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
<td><input name='Chart_date3' type='text' id='Chart_date3' value='<?php echo date("Y-m-d")?>'></td>
<td><input name='Username3' type='text' id='Username3' value='Utest'></td>
<td><input name='List_name3' type='text' id='List_name3' value='<?php echo date("Y-m-d")?>'><input name="song_id3" type = "hidden" id="song_id3" value=""></td>
</tr>
<tr><td><input type='text' id='name4' autocomplete="off" onkeyup="showHint(this.value,'name','','4')"><br>
<span id="txtHintname4"></span></td>
    <td><input name='band4' type='text' id='band4' autocomplete="off" onclick="showHint('','band',name4.value,'4' )" onkeyup="showHint(this.value,'band', name4.value,'4' )"><br>
<span id="txtHintband4"></span></td>
<td><select name='This_week4' type='text' id='This_week4'>
  <option value="1">1</option>
  <option value="2" selected>2</option>
  <option value="3">3</option>
  <option value="4" selected>4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>  
</select></td>
<td><select name='Last_week4' id='Last_week4'>
  <option value="1">1</option>
  <option value="2" selected>2</option>
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
<td><input name='Chart_date4' type='text' id='Chart_date4' value='<?php echo date("Y-m-d")?>'></td>
<td><input name='Username4' type='text' id='Username4' value='Utest'></td>
<td><input name='List_name4' type='text' id='List_name4' value='<?php echo date("Y-m-d")?>'><input name="song_id4" type = "hidden" id="song_id4" value=""></td>
</tr>
<tr><td><input type='text' id='name5' autocomplete="off" onkeyup="showHint(this.value,'name','','5')"><br>
<span id="txtHintname5"></span></td>
    <td><input name='band5' type='text' id='band5' autocomplete="off" onclick="showHint('','band',name5.value,'5' )" onkeyup="showHint(this.value,'band', name5.value,'5' )"><br>
<span id="txtHintband5"></span></td>
<td><select name='This_week5' type='text' id='This_week5'>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5" selected>5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>  
</select></td>
<td><select name='Last_week5' id='Last_week5'>
  <option value="1">1</option>
  <option value="2" selected>2</option>
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
<td><input name='Chart_date5' type='text' id='Chart_date5' value='<?php echo date("Y-m-d")?>'></td>
<td><input name='Username5' type='text' id='Username5' value='Utest'></td>
<td><input name='List_name5' type='text' id='List_name5' value='<?php echo date("Y-m-d")?>'><input name="song_id5" type = "hidden" id="song_id5" value=""></td>
</tr>
<tr><td><input type='text' id='name6' autocomplete="off" onkeyup="showHint(this.value,'name','','6')"><br>
<span id="txtHintname6"></span></td>
    <td><input name='band6' type='text' id='band6' autocomplete="off" onclick="showHint('','band',name6.value,'6' )" onkeyup="showHint(this.value,'band', name6.value,'6' )"><br>
<span id="txtHintband6"></span></td>
<td><select name='This_week6' type='text' id='This_week6'>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6" selected>6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>  
</select></td>
<td><select name='Last_week6' id='Last_week6'>
  <option value="1">1</option>
  <option value="2" selected>2</option>
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
<td><input name='Chart_date6' type='text' id='Chart_date6' value='<?php echo date("Y-m-d")?>'></td>
<td><input name='Username6' type='text' id='Username6' value='Utest'></td>
<td><input name='List_name6' type='text' id='List_name6' value='<?php echo date("Y-m-d")?>'><input name="song_id6" type = "hidden" id="song_id6" value=""></td>
</tr>
<tr><td><input type='text' id='name7' autocomplete="off" onkeyup="showHint(this.value,'name','','7')"><br>
<span id="txtHintname7"></span></td>
    <td><input name='band7' type='text' id='band7' autocomplete="off" onclick="showHint('','band',name7.value,'7' )" onkeyup="showHint(this.value,'band', name7.value,'7' )"><br>
<span id="txtHintband7"></span></td>
<td><select name='This_week7' type='text' id='This_week7'>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7" selected>7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>  
</select></td>
<td><select name='Last_week7' id='Last_week7'>
  <option value="1">1</option>
  <option value="2" selected>2</option>
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
<td><input name='Chart_date7' type='text' id='Chart_date7' value='<?php echo date("Y-m-d")?>'></td>
<td><input name='Username7' type='text' id='Username7' value='Utest'></td>
<td><input name='List_name7' type='text' id='List_name7' value='<?php echo date("Y-m-d")?>'><input name="song_id7" type = "hidden" id="song_id7" value=""></td>
</tr>
<tr><td><input type='text' id='name8' autocomplete="off" onkeyup="showHint(this.value,'name','','8')"><br>
<span id="txtHintname8"></span></td>
    <td><input name='band8' type='text' id='band8' autocomplete="off" onclick="showHint('','band',name8.value,'8' )" onkeyup="showHint(this.value,'band', name8.value,'8' )"><br>
<span id="txtHintband8"></span></td>
<td><select name='This_week8' type='text' id='This_week8'>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8" selected>8</option>
  <option value="9">9</option>
  <option value="10">10</option>  
</select></td>
<td><select name='Last_week8' id='Last_week8'>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8" selected>8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="New">New</option>
</select>
</td>
<td><input name='Chart_date8' type='text' id='Chart_date8' value='<?php echo date("Y-m-d")?>'></td>
<td><input name='Username8' type='text' id='Username8' value='Utest'></td>
<td><input name='List_name8' type='text' id='List_name8' value='<?php echo date("Y-m-d")?>'><input name="song_id8" type = "hidden" id="song_id8" value=""></td>
</tr>
<tr><td><input type='text' id='name9' autocomplete="off" onkeyup="showHint(this.value,'name','','9')"><br>
<span id="txtHintname9"></span></td>
    <td><input name='band9' type='text' id='band9' autocomplete="off" onclick="showHint('','band',name9.value,'9' )" onkeyup="showHint(this.value,'band', name9.value,'9' )"><br>
<span id="txtHintband9"></span></td>
<td><select name='This_week9' type='text' id='This_week9'>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9" selected>9</option>
  <option value="10">10</option>  
</select></td>
<td><select name='Last_week9' id='Last_week9'>
  <option value="1">1</option>
  <option value="2" selected>2</option>
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
<td><input name='Chart_date9' type='text' id='Chart_date9' value='<?php echo date("Y-m-d")?>'></td>
<td><input name='Username9' type='text' id='Username9' value='Utest'></td>
<td><input name='List_name9' type='text' id='List_name9' value='<?php echo date("Y-m-d")?>'><input name="song_id9" type = "hidden" id="song_id9" value=""></td>
</tr>
<tr><td><input type='text' id='name0' autocomplete="off" onkeyup="showHint(this.value,'name','','0')"><br>
<span id="txtHintname0"></span></td>
    <td><input name='band0' type='text' id='band0' autocomplete="off" onclick="showHint('','band',name0.value,'0' )" onkeyup="showHint(this.value,'band', name0.value,'0' )"><br>
<span id="txtHintband0"></span></td>
<td><select name='This_week0' type='text' id='This_week0'>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10" selected>10</option>  
</select></td>
<td><select name='Last_week0' id='Last_week0'>
  <option value="1">1</option>
  <option value="2" selected>2</option>
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
<td><input name='Chart_date0' type='text' id='Chart_date0' value='<?php echo date("Y-m-d")?>'></td>
<td><input name='Username0' type='text' id='Username0' value='Utest'></td>
<td><input name='List_name0' type='text' id='List_name0' value='<?php echo date("Y-m-d")?>'><input name="song_id0" type = "hidden" id="song_id0" value=""></td>
</tr>
</table>
</form>
</body>
</html>