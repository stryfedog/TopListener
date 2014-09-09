<?php
	$dbhost = 'localhost:3036';
	$dbuser = 'stryfe3_CS';
	$dbpass = 'stryfePUB1';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);

	$db_selected = mysql_select_db('stryfe3_TL', $conn);
	if (!$db_selected) 
	{
		die ('Can\'t use stryfe3_TL : ' . mysql_error());
	}
?>