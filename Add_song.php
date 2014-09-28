<?php
/*
Written by Corey S. Colborn, Copyright 2006
// version 0.08.9
*/

$PageTitle = "Add a song";

require("db_connect.php");//This file will connect to the database, in separate file so database location and login can be changed by altering one file
require("authfs.php");	//Contains login functions
$loaded = "onunload='general:closure()'"; //javascript body onLoad variable, passed to header1.php
require("header1.php");
?>
<script src="general.js" type="text/javascript" language="javascript"></script>
<?php

	$col_array = array('Song_ID', 'Name', 'Band', 'Album', 'Category', 'Sub_cat', 'Youtube', 'Amazon', 'Itunes', 'Google_play');

	for($i=0;$i < max(array_keys($col_array)); $i++)
	{
		$col_array2[$i] = $col_array[$i] ;
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
	 
	if($_POST[Name] != "" and $_POST[Band] != "")
	{
		$retval = mysql_query( $sql, $conn );
	} 
	   
	if(!$retval and $_POST[Name] != "")
	{
		echo 'Could not enter data: ' . "$sql \n" . mysql_error();
	}
	Else if ($retval)
	{
		echo "Song added to list";
	}
	   
?>
<form method="post" action="<?php $_PHP_SELF ?>">
<table width="600" border="0" cellspacing="1" cellpadding="2">
<tr>
<th></th>
</tr>
<tr>
<td>Song name: </td><td><input name="Name" type="text" autocomplete="off" onkeyup="showHint(this.value,'name','')" id="name_name"></td>
<td>Band name: </td><td><input name="Band" type="text" autocomplete="off" onclick="showHint('','band',name_name.value )" onkeyup="showHint(this.value,'band',name_name.value )" id="band_name"></td>
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
<td>Album name</td><td><input name="Album" ></td>
</tr>
<tr>
<td>Category</td><td><select name="Category" id = "Category">
  <option value=""></option>
  <option value="Alternative">Alternative</option>
  <option value="Country">Country</option>
  <option value="Jazz">Jazz</option>
  <option value="Rock">Rock</option>
  <option value="Classical">Classical</option>
  <option value="Blues">Blues</option>
  <option value="R&B">R&B</option>
  <option value="Reggae">Reggae</option>
  <option value="World Music">World Music</option>
  <option value="Pop">Pop</option>
  <option value="New Age">New Age</option>
  <option value="Other">Other</option>
</select>
</tr>
<tr>
<td>Sub Category</td><td><input name="Sub_cat" id="Sub_cat" value= ""></td>
</tr>
<tr>
<td>Youtube link</td><td><input name="Youtube" id="Youtube"></td><td><a href="http://www.youtube.com" target="_blank">http://www.youtube.com</a></td>
</tr>
<tr>
<td>Amazon link</td><td><input name="Amazon" id="Amazon"></td><td><a href="http://www.amazon.com" target="_blank">http://www.amazon.com</a></td>
</tr>
<tr>
<td>Itunes link</td><td><input name="Itunes" id="Itunes" value="" ></td><td><a href="http://www.itunes.com" target="_blank">http://www.itunes.com</a></td>
</tr>
<tr>
<td>Google Play link</td><td><input name="Google_play" id="Google_play" value=""></td><td><a href="https://play.google.com/store/music" target="_blank">https://play.google.com/store/music</a></td>
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
<iframe height="400" width="400" src="https://www.amazon.com">
</iframe>
</form>
<?php
require("footer.php");
?>