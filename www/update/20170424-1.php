<?php
ini_set('max_execution_time', 3600);
$s2="20170424-1.php";
$s3="Обновление 1";
$s4="1";
$s5="0";
$rows01=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_1user` WHERE `s1`='$id1u' AND `s6`='1' AND `s7`='$id1c' LIMIT 0,1"));
if ($rows01 == "1" && $_GET["update"] == "1" && $s4u1 == "3")
{

    $sql="SELECT `s1` FROM `device` LIMIT 0,1";
    $result=@mysql_query($sql);
    if (@mysql_num_rows($result) == 1)
    {
        mysql_query("drop table `device`");
    }

    $sql="SELECT `s1` FROM `bs4_4coun` LIMIT 0,1";
    $result=@mysql_query($sql);
    if (@mysql_num_rows($result) == 1)
    {
        mysql_query("drop table `bs4_4coun`");
    }

    $sql="SELECT s1 FROM `devices` LIMIT 0,1";
    $result=@mysql_query($sql);
    if (@mysql_num_rows($result) == 0) //create table devices
    {
        mysql_query("
                CREATE TABLE `devices` (  
                `id` int(11) NOT NULL AUTO_INCREMENT,  
                `name` varchar(24) DEFAULT NULL,  
                `region` int(11) DEFAULT NULL COMMENT 'Region',  
                `city` int(11) DEFAULT NULL COMMENT 'Gorod',  
                `online` int(1) NOT NULL DEFAULT '0' COMMENT '0-Offline,1-Online',  
                `barrier` int(1) NOT NULL DEFAULT '1' COMMENT '0-error,1-0k',  
                `eeprom` int(1) NOT NULL DEFAULT '1' COMMENT '0-error, 1-ok',  
                `ip` varchar(15) DEFAULT NULL,  `port` int(6) NOT NULL DEFAULT '23',  
                `update_interval` varchar(10) NOT NULL DEFAULT '1m',  
                `mac_current` varchar(17) DEFAULT NULL,  
                `mac_last` varchar(17) DEFAULT NULL,  
                `last_seen` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',  
                `last_check` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Время последнего опроса',  
                `firmware` varchar(10) DEFAULT NULL,  `enabled` int(1) NOT NULL DEFAULT '0',  
                PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8
        ");

    }
    if ($_GET["step"] == "1")
    {
        echo "Установка обновлений...";
        echo "<br>";
        echo "<progress max=100 value=25>";
        mysql_query("LOCK TABLES `counters` WRITE");
        echo '<meta http-equiv=Refresh content="1; url=index.php?update=1&step=2">';
    } else if ($_GET["step"] == "2") {
        $res3=mysql_query("SELECT *,count(*) FROM `counters` GROUP BY `ID_Counters`,`date`,`hour` HAVING count(*)>1");
        while($row3=mysql_fetch_array($res3))
        {
            $ID_Counters=$row3["ID_Counters"];
            $date=$row3["date"];
            $hour=$row3["hour"];
            $in=$row3["in"];
            $out=$row3["out"];
            mysql_query("DELETE FROM `counters` WHERE
                `ID_Counters`='$ID_Counters' AND
                `date`='$date' AND
                `hour`='$hour' AND
                `in`='$in' AND
                `out`='$out'
            ");
            mysql_query("INSERT INTO `counters` (`ID_Counters`, `date`, `hour`, `in`, `out`)
                VALUES ('$ID_Counters', '$date', '$hour', '$in', '$out')");
        }
        echo "Установка обновлений...";
        echo "<br>";
        echo "<progress max=100 value=50>";
        echo '<meta http-equiv=Refresh content="1; url=index.php?update=1&step=3">';
    } else if ($_GET["step"] == "3") {
            mysql_query("CREATE UNIQUE INDEX mac_date ON `counters` (`ID_Counters`, `date`, `hour`)");
            echo "Установка обновлений...";
            echo "<br>";
            echo "<progress max=100 value=75>";
            echo '<meta http-equiv=Refresh content="1; url=index.php?update=1&step=4">';
    } else if ($_GET["step"] == "4") {
            mysql_query("UNLOCK TABLES");
            echo "Установка обновлений...";
            echo "<br>";
            echo "<progress max=100 value=95>";
            echo '<meta http-equiv=Refresh content="1; url=index.php?update=1&step=5">';
    } else if ($_GET["step"] == "5") {
            mysql_query("UPDATE `bs4_5update` SET `s5`='1' WHERE `s4`='$s4'");
            echo "Установка обновлений...";
            echo "<br>";
            echo "<progress max=100 value=100>";
            echo '<meta http-equiv=Refresh content="1; url=index.php?inf=1">';
    } else {
            echo "<h1><font color=red>Критическое обновление! <br> Пожалуйста , перед запустком, остановите програму сбора статистики (cdumper)</font></h1>";
            echo "<a href=index.php?update=1&step=1 class=href4>Приступить к обновлению!</a>	";
    }
}
?>