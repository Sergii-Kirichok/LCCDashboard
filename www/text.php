<?php
if ($str != "index.php") exit;

$id=$_GET["id"];
$act=$_GET["act"];
$act2=$_GET["act2"];

switch ($act)
{
	case '1':	include('m/text/'.$act.'.php'); break;
    case '2':   include('m/text/'.$act.'.php'); break;
    case '3':   include('m/text/'.$act.'.php'); break;
    case '4':   include('m/text/'.$act.'.php'); break;
    default:    include('m/text/4.php'); break; //default monitoring
}

?>
