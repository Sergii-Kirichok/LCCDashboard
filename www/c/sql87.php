<?php
if ($str != "index.php") die();

$sql1="127.0.0.1";
$sql2="test1";
$sql3="root";
$sql4="";

$link = mysql_connect("$sql1", "$sql3", "$sql4")
or die("Could not connect : " . mysql_error());
mysql_select_db("$sql2") or die("Could not select database");
date_default_timezone_set('Europe/Kiev');

?>