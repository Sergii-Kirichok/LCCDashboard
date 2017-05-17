<?php

function ShowMoritoringTable($DevArr,$regions,$cityes,$header,$allowNull=true)
{
    global $date;
    global $gi;
    $img[0]="inf0.png";
    $img[1]="inf1.png";
    global $errorTable;

    if(!is_array($DevArr) and !$allowNull)
    {
        return;
    }
    else
    {
        // echo "$act&act2=add19&id=$id></a>";

        echo '<kbd>'.$header.'</kbd><br>';
        echo '<table border="1" style="border-collapse: collapse" bordercolor="#808080">';
        echo "<tr>";
        echo "<td width=50 align=center><kbd><b>ОНЛАЙН</b></kbd></td>";
        echo "<td width=50 align=center><kbd><b>БАРЬЕР</b></kbd></td>";
        echo "<td width=50 align=center><kbd><b>EEPROM</b></kbd></td>";
        echo "<td width=280 align=center><kbd><b>РЕГИОН - ГОРОД</b></kbd></td>";
        echo "<td width=210 align=center><kbd><b>СЧЕТЧИК</b></kbd></td>";
        echo "<td width=200 align=center><kbd><b>IP / MAC</b></kbd></td>";
        echo "<td width=60 align=center><kbd><b>IN</b></kbd></td>";
        echo "<td width=60 align=center><kbd><b>OUT</b></kbd></td>";
        echo "</tr>";
        if(is_array($DevArr))
        {
            foreach ($DevArr as $a)
            {
                $inout=getCountersDay($a['mac_last'],$date);
				if ($a['mac_last'] == $a['mac_current'])
				{
					
				} else {
					$style_color="background: #FFD700;";
                    $errorTable++;
				}

                $style_NO_line = 'style ="text-decoration: none; color: blue;"';
				$ahs = '<a '.$style_NO_line.' href=index.php?act=2&act2=add19&id='.$a['id'].'><div style="width: 100%;"><kbd>';
                $ahe ='</kbd></div></a>';


                echo '<tr class=tr1>';
                echo '<td width=50 align=center>'.$ahs.'<img src='.$gi.$img[$a['online']].' width=20>'.$ahe.'</td>';
                echo '<td width=50 align=center>'.$ahs.'<img src='.$gi.$img[$a['barrier']].' width=20>'.$ahe.'</td>';
                echo '<td width=50 align=center>'.$ahs.'<img src='.$gi.$img[$a['eeprom']].' width=20>'.$ahe.'</td>';
                echo '<td width=280 align=left>'.$ahs.'&nbsp;'.$regions[$a['region']]['s2'].' - '.$cityes[$a['city']]['s3'].$ahe.'</td>';
                echo '<td width=210 align=left>'.$ahs.'&nbsp;'.$a['name'].'</td>';
                echo '<td width=200 align=left style="'.$style_color.'">'.$ahs.'&nbsp;'.$a['ip'].'<br>&nbsp;'.$a['mac_last'].$ahe.'</td>';
                echo '<td width=60 align=center><kbd>'.($inout['in'] > 0 ? $inout['in'] : '0').'</kbd></td>';
                echo '<td width=60 align=center><kbd>'.($inout['out'] > 0 ? $inout['out'] : '0').'</kbd></td>';
                echo '</tr>';
            }
        }

        echo "</table>";
        //echo "<br>";
        echo "<br>";
    }
}

$devOk   = getDevices(1);
$devErr  = getDevices(0);
$devInact= getDevices(1,0);
$regions = getRegions();
$cityes  = getCity();

$date=date('Y-m-d');


$errorTable = 0;


ShowMoritoringTable($devErr,$regions,$cityes,'ТРЕБУЮЩИЕ ВНИМАНИЯ:',false);
ShowMoritoringTable($devOk,$regions,$cityes,'АКТИВНЫЕ:');
ShowMoritoringTable($devInact,$regions,$cityes,'НЕ ПОДЛЕЖАЩИЕ ОПРОСУ:');
if($errorTable)
{
    echo "<table>";
        echo '<tr>';
            echo '<td width=10 align=center style="background: #FFD700;"></td>';
            echo '<td> - Не совпадают МАК-адреса привязанного к устройству и полученного от него</td>';
        echo '</tr>';

    echo "</table>";
}



?>