<?php
if(isset($_GET['find']))
{
	$dbhost = 'localhost:3036';
	$dbuser = 'stryfe3_CS';
	$dbpass = 'stryfePUB1';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);

	$db_selected = mysql_select_db('stryfe3_TL', $conn);
	if (!$db_selected) 
	{
		die ('Can\'t use stryfe3_TL : ' . mysql_error());
	}
}

$limit_col = $_REQUEST["limit_col"];
$col1 = $_REQUEST["sql_col"] ;
$find = $_REQUEST["find"] ;

$sql = "select distinct $col1 from Songs where $col1 like '$find%' and name like '$limit_col%' limit 10;";
//echo $sql;
$result = mysql_query($sql,$conn);
$hint="";
$col_quote = "'" . $_REQUEST["sql_col"] ."'";
for($i=0; $i<10; $i++)
{
	
	if(!$row = mysql_fetch_array($result))
	{
		$i=10;
	}
	else
	{
		$name = $row[$_REQUEST["sql_col"]];
		if ($hint==="") {
			$hint='<table style="border: 1px solid black; border-collapse: collapse"><tr><td onclick="Set_name(this.innerHTML,'.$col_quote.')">'.$name;
		} 
		else 
		{
			$hint .= '</td></tr><td onclick="Set_name(this.innerHTML,'.$col_quote.')">'. "$name";
		}
	}
}
	

// get the q parameter from URL
$q="";//$_REQUEST["find"]; 

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q=strtolower($q); $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name,0,$len))) {
      if ($hint==="") {
        $hint=$name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}

// Output "no suggestion" if no hint were found
// or output the correct values
echo $hint==="" ? "no suggestion" : $hint;
?>