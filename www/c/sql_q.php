<?php
/**
 * Created by PhpStorm.
 * User: star
 * Date: 29.04.2017
 * Time: 17:47
 */

//Get reions
/*
 * Returns array of active regions
 * */
function getRegions()
{
    $q="SELECT * FROM `bs4_2region` WHERE `s4`='1'";
    $res = mysql_query($q);
    while ($s = mysql_fetch_assoc($res))
        $data[$s['s1']] = $s;
    return $data;
}

/*
 * Returns array of active cityes
 * */
function getCity()
{
    $q="SELECT * FROM `bs4_3gorod` WHERE `s5`='1'";
    $res = mysql_query($q);
    while ($s = mysql_fetch_assoc($res))
        $data[$s['s1']] = $s;
    return $data;
}


/**
 * Return array of devices
 * $type [0,1] - 1 = all is Ok, 0 = has errors
 */

function getDevices($type,$active=1)
{
    if(!$active) $q="SELECT * FROM `devices` WHERE `enabled`='0'"; //All OK devicces
    else if($type) $q="SELECT * FROM `devices` WHERE `enabled`='1' AND `online`='1' AND `barrier`='1' AND `eeprom`='1'"; //All OK devicces
    else $q="SELECT * FROM `devices` WHERE `enabled`='1' AND (`online`='0' OR `barrier`='0' OR `eeprom`='0')"; //All OK devicces
    //echo $q.'<br>';
    $res = mysql_query($q);
    while ($s = mysql_fetch_assoc($res))
        $data[$s['id']] = $s;
    return $data;
}

/*
 * Returns array IN an OUT Countersr for the special device and DATE
 * */

function getCountersDay($mac,$date)
{

    $q="SELECT SUM(`in`) as `in`, SUM(`out`) as `out` FROM `counters` WHERE `ID_Counters`='$mac' AND `date`='$date'";
    $res = mysql_query($q);
    $s = mysql_fetch_assoc($res);
    return $s;
}

?>