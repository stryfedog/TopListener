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

// Fill up array with names
$a[]="Anna";
$a[]="Brittany";
$a[]="Cinderella";
$a[]="Diana";
$a[]="Eva";
$a[]="Fiona";
$a[]="Gunda";
$a[]="Hege";
$a[]="Inga";
$a[]="Johanna";
$a[]="Kitty";
$a[]="Linda";
$a[]="Nina";
$a[]="Ophelia";
$a[]="Petunia";
$a[]="Amanda";
$a[]="Raquel";
$a[]="Cindy";
$a[]="Doris";
$a[]="Eve";
$a[]="Evita";
$a[]="Sunniva";
$a[]="Tove";
$a[]="Unni";
$a[]="Violet";
$a[]="Liza";
$a[]="Elizabeth";
$a[]="Ellen";
$a[]="Wenche";
$a[]="Vicky";

$sql = "select Name from Songs where Name like '" . $_REQUEST["find"] . "%' limit 10;";
$result = mysql_query($sql,$conn);
$hint="";
for($i=0; $i<10; $i++)
{
	
	if(!$row = mysql_fetch_array($result))
	{
		$i=10;
	}
	else
	{
		$name = $row['Name'];
		if ($hint==="") {
			$hint='<table style="border: 1px solid black; border-collapse: collapse"><tr><td onclick="Set_name(this.innerHTML)">'.$name;
		} 
		else 
		{
			$hint .= '</td></tr><td onclick="Set_name(this.innerHTML)">'. "$name";
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