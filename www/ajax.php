<?php
$str="index.php";
include ('c/sql87.php');
include ('./c/sql_q.php');
$gi='i/global/'; //global image path
$id1u=$_GET["id1u"];
$id1c=$_GET["id1c"];
$res3=mysql_query("SELECT s4 FROM `bs4_1user` WHERE `s1`='$id1u' AND `s6`='1' AND `s7`='$id1c' LIMIT 0,1");
while($row3=mysql_fetch_array($res3))
{
	$s4u1=$row3["s4"];
}
//Need to add the authorisation check

$action = $_GET['action'] ? $_GET['action'] : '';

if (!preg_match('/[-a-z0-9]/',$action)) die();

if (file_exists('m/ajax-'.$action.'.php')) {
	include('m/ajax-'.$action.'.php');
}

?>