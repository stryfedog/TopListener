<?php
if(isset($_GET['find']))
{
	require "db_connect.php";
}


$find_song = $_REQUEST["find"] ;
$find_band = $_REQUEST["find2"] ;

$sql = "select * from Songs where Name = '$find_song' and Band = '$find_band'";
$result = mysql_query($sql,$conn);
//echo $sql;
if(!$row = mysql_fetch_array($result))
{
	$sid="none";
}
else
{
	$sid = $row["Song_ID"];
}
echo $sid;

?>