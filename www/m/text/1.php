<?php
if ($str != "index.php") exit;

		echo "<div class=div1>";
		echo "<b>Просмотр отчетов</b>";
		echo "<hr>";
		if ($act2 == "add1")
		{
			if ($_GET["xls"] == "1")
			{
				$xls0agen="cont1";
				include ("xls/index.php");
				echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'&act2='.$act2.'&id='.$id.'&xls=2">';
			} else {
				$res3=mysql_query("SELECT * FROM `devices` WHERE `mac_last`='$id' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$s2=$row3["city"];
					$name=$row3["name"];
					$adres=$row3["mac_last"];
				}
				$res3=mysql_query("SELECT s2,s3 FROM `bs4_3gorod` WHERE `s1`='$s2' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$s2=$row3["s2"];
					$namec=$row3["s3"];
				}
				$res3=mysql_query("SELECT s2 FROM `bs4_2region` WHERE `s1`='$s2' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$namer=$row3["s2"];
				}
				echo "Просмотр отчета: <b>".$namer." - ".$namec." - ".$name."</b>";
				echo "<br>";
				echo "<br>";
				echo "<form method=POST action=index.php?act=$act&act2=add2&id=$id>";
				echo "<script src='calendar_ru.js' type='text/javascript'></script>";
				echo "Сортировать по дате: ";
				echo 'от <input name=date1 type="text" onfocus="this.select();lcs(this)"
				onclick="event.cancelBubble=true;this.select();lcs(this)">';
				echo " ";
				echo 'до <input name=date2 type="text" onfocus="this.select();lcs(this)"
				onclick="event.cancelBubble=true;this.select();lcs(this)">';
				echo " ";
				echo "<input type=submit value=Выбрать name=B1><br>";
				echo "<br>";
				echo "<kbd>Общий отчет по часам:</kbd>";
				echo "<br>";
				echo '<table border="1" style="border-collapse: collapse; font-size: 8pt;" bordercolor="#808080">';
				echo "<tr>";
				echo "<td width=100 align=center><kdb><b>ОПИСАНИЕ</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВОШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВЫШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>0</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>1</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>2</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>3</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>4</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>5</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>6</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>7</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>8</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>9</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>10</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>11</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>12</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>13</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>14</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>15</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>16</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>17</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>18</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>19</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>20</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>21</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>22</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>23</b></kbd></td>";
				echo "</tr>";
				
				$dt2=date('Y-m');
				// По дням
				$res3a1=mysql_query("SELECT DISTINCT date FROM `counters` WHERE `ID_Counters`='$adres' AND `date` LIKE '".$dt2."%%' ORDER BY `date` ASC");
				while($row3a1=mysql_fetch_array($res3a1))
				{
					$dt1a2=$row3a1["date"];
					$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$adres' AND `date`='$dt1a2'"));
					if ($in1[0] < "1") { $in1[0]="0"; }
					if ($in1[1] < "1") { $in1[1]="0"; }
					echo "<tr>";
					echo "<td width=100 align=center><kdb>$dt1a2</kbd></td>";
					echo "<td width=100 align=center><kdb>$in1[0]</kbd></td>";
					echo "<td width=100 align=center><kdb>$in1[1]</kbd></td>";
					for ($h=0;$h<24;$h++)
					{
						$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$adres' AND `date`='$dt1a2' AND `hour`='$h'"));
						if ($in1[0] < "1") { $in1[0]="0"; }
						if ($in1[1] < "1") { $in1[1]="0"; }
						echo "<td width=100 align=center><kdb>$in1[0]-$in1[1]</kbd></td>";
					}
					echo "</tr>";
				}

				// Всего
				$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$adres' AND `date` LIKE '".$dt2."%%'"));
				if ($in1[0] < "1") { $in1[0]="0"; }
				if ($in1[1] < "1") { $in1[1]="0"; }
				echo "<tr>";
				echo "<td width=100 align=center><kdb>ВСЕГО</kbd></td>";
				echo "<td width=100 align=center><kdb>$in1[0]</kbd></td>";
				echo "<td width=100 align=center><kdb>$in1[1]</kbd></td>";
				for ($h=0;$h<24;$h++)
				{
					$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$adres' AND `date` LIKE '".$dt2."%%' AND `hour`='$h'"));
					if ($in1[0] < "1") { $in1[0]="0"; }
					if ($in1[1] < "1") { $in1[1]="0"; }
					echo "<td width=100 align=center><kdb>$in1[0]-$in1[1]</kbd></td>";
				}
				echo "</tr>";

				echo "</table>";

				echo "<br>";
				echo "<a href=".$_SERVER['REQUEST_URI']."&xls=1 class=href2><img src=".$gi."save1.png border=0 width=16> Скачать отчет (Excel)</a>";
				if ($_GET["xls"] == "2")
				{
					echo '<meta http-equiv=Refresh content="0; url=xls/cont1.xlsx">';
				}
			}
		} else if ($act2 == "add2") {
			$dt1=$_POST["date1"];
			$dt2=$_POST["date2"];
			$dt1=$_POST["date1"];
			$dt2=$_POST["date2"];
			if (empty($dt1)) { $dt1=$_GET["date1"]; }
			if (empty($dt2)) { $dt2=$_GET["date2"]; }
			if ($_GET["xls"] == "1")
			{
				$xls0agen="cont1d";
				include ("xls/index.php");
				echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'&act2='.$act2.'&date1='.$dt1.'&date2='.$dt2.'&id='.$id.'&xls=2">';
			} else {
				$res3=mysql_query("SELECT * FROM `devices` WHERE `mac_last`='$id' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$s2=$row3["city"];
					$name=$row3["name"];
					$adres=$row3["mac_last"];
				}
				$res3=mysql_query("SELECT s2,s3 FROM `bs4_3gorod` WHERE `s1`='$s2' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$s2=$row3["s2"];
					$namec=$row3["s3"];
				}
				$res3=mysql_query("SELECT s2 FROM `bs4_2region` WHERE `s1`='$s2' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$namer=$row3["s2"];
				}
				echo "Просмотр отчета: <b>".$namer." - ".$namec." - ".$name."</b>";
				echo "<br>";
				echo "<br>";
				echo "<form method=POST action=index.php?act=$act&act2=add2&id=$id>";
				echo "<script src='calendar_ru.js' type='text/javascript'></script>";
				echo "Сортировать по дате: ";
				echo 'от <input name=date1 value="'.$date1.'" type="text" onfocus="this.select();lcs(this)"
				onclick="event.cancelBubble=true;this.select();lcs(this)">';
				echo " ";
				echo 'до <input name=date2 value="'.$date2.'" type="text" onfocus="this.select();lcs(this)"
				onclick="event.cancelBubble=true;this.select();lcs(this)">';
				echo " ";
				echo "<input type=submit value=Выбрать name=B1><br>";
				echo "<br>";
				echo "<kbd>Отчет по дате в период: <b>".$dt1.":".$dt2."</b></kbd>";
				echo "<br>";
				echo '<table border="1" style="border-collapse: collapse; font-size: 8pt;" bordercolor="#808080">';
				echo "<tr>";
				echo "<td width=100 align=center><kdb><b>ОПИСАНИЕ</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВОШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВЫШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>0</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>1</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>2</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>3</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>4</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>5</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>6</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>7</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>8</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>9</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>10</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>11</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>12</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>13</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>14</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>15</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>16</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>17</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>18</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>19</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>20</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>21</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>22</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>23</b></kbd></td>";
				echo "</tr>";

				// По дням
				$res3a1=mysql_query("SELECT DISTINCT date FROM `counters` WHERE `ID_Counters`='$adres' AND `date`>='$dt1' AND `date`<='$dt2' ORDER BY `date` ASC");
				while($row3a1=mysql_fetch_array($res3a1))
				{
					$dt1a2=$row3a1["date"];
					$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$adres' AND `date`='$dt1a2'"));
					if ($in1[0] < "1") { $in1[0]="0"; }
					if ($in1[1] < "1") { $in1[1]="0"; }
					$in0a2=$in0a2 + $in1[0];
					$out0a2=$out0a2 + $in1[1];
					echo "<tr>";
					echo "<td width=100 align=center><kdb>$dt1a2</kbd></td>";
					echo "<td width=100 align=center><kdb>$in1[0]</kbd></td>";
					echo "<td width=100 align=center><kdb>$in1[1]</kbd></td>";
					for ($h=0;$h<24;$h++)
					{
						$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$adres' AND `date`='$dt1a2' AND `hour`='$h'"));
						if ($in1[0] < "1") { $in1[0]="0"; }
						if ($in1[1] < "1") { $in1[1]="0"; }
						echo "<td width=100 align=center><kdb>$in1[0] - $in1[1]</kbd></td>";
						$in0h[$h]=$in0h[$h] + $in1[0];
						$out0h[$h]=$out0h[$h] + $in1[1];
					}
					echo "</tr>";
				}

				// Всего
				echo "<tr>";
				echo "<td width=100 align=center><kdb>ВСЕГО</kbd></td>";
				echo "<td width=100 align=center><kdb>$in0a2</kbd></td>";
				echo "<td width=100 align=center><kdb>$out0a2</kbd></td>";
				for ($h=0;$h<24;$h++)
				{
					echo "<td width=100 align=center><kdb>$in0h[$h] - $out0h[$h]</kbd></td>";
				}
				echo "</tr>";

				echo "</table>";

				echo "<br>";
				echo "<a href=".$_SERVER['REQUEST_URI']."&date1=$dt1&date2=$dt2&xls=1 class=href2><img src=".$gi."save1.png border=0 width=16> Скачать отчет (Excel)</a>";
				if ($_GET["xls"] == "2")
				{
					echo '<meta http-equiv=Refresh content="0; url=xls/cont1d.xlsx">';
				}
			}
		} else if ($act2 == "add3") {
			$dt1=date('Y-m-d');
			if ($_GET["xls"] == "1")
			{
				$xls0agen="all";
				include ("xls/index.php");
				echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'&act2='.$act2.'&xls=2">';
			} else {
				$date=date('Y-m');
				echo "Просмотр общего отчета за текущий месяц";
				echo "<br>";
				echo "<br>";
				echo "<form method=POST action=index.php?act=$act&act2=add5>";
				echo "<script src='calendar_ru.js' type='text/javascript'></script>";
				echo "Сортировать по дате: ";
				echo 'от <input name=date1 type="text" onfocus="this.select();lcs(this)"
				onclick="event.cancelBubble=true;this.select();lcs(this)">';
				echo " ";
				echo 'до <input name=date2 type="text" onfocus="this.select();lcs(this)"
				onclick="event.cancelBubble=true;this.select();lcs(this)">';
				echo " ";
				echo "<input type=submit value=Выбрать name=B1><br>";
				echo "<br>";
				echo "<kbd>Общий отчет:</kbd>";
				echo "<br>";
				echo '<table border="1" style="border-collapse: collapse; font-size: 8pt;" bordercolor="#808080">';
				echo "<tr>";
				echo "<td width=100 align=center><kdb><b>ОПИСАНИЕ</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВОШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВЫШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>0</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>1</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>2</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>3</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>4</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>5</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>6</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>7</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>8</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>9</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>10</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>11</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>12</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>13</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>14</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>15</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>16</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>17</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>18</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>19</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>20</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>21</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>22</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>23</b></kbd></td>";
				echo "</tr>";

				$res3a3=mysql_query("SELECT s1,s2 FROM `bs4_2region`");
				while($row3a3=mysql_fetch_array($res3a3))
				{
					$region[$row3a3["s1"]]=$row3a3["s2"];
				}

				$res3a1=mysql_query("SELECT s1,s2,s3 FROM `bs4_3gorod` ORDER BY `s2` ASC");
				while($row3a1=mysql_fetch_array($res3a1))
				{
					$s1a2=$row3a1["s1"];
					$s2a2=$row3a1["s2"];
					$s2reg1a1g=$row3a1["s3"];
					$res3=mysql_query("SELECT * FROM `devices` WHERE `city`='$city'");
					while($row3=mysql_fetch_array($res3))
					{
						$s3a3=$row3["name"];
						$s1a3=$row3["adres"];
						$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$s1a3' AND `date` LIKE '".$date."%%'"));
						if ($in1[0] < "1") { $in1[0]="0"; }
						if ($in1[1] < "1") { $in1[1]="0"; }
						echo "<tr>";
						echo "<td width=100 align=center><kdb>$region[$s2a2]<br>$s2reg1a1g<br>$s3a3</kbd></td>";
						echo "<td width=100 align=center><kdb>$in1[0]</kbd></td>";
						echo "<td width=100 align=center><kdb>$in1[1]</kbd></td>";
						for ($h=0;$h<24;$h++)
						{
							$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$s1a3' AND `date` LIKE '".$date."%%' AND `hour`='$h'"));
							if ($in1[0] < "1") { $in1[0]="0"; }
							if ($in1[1] < "1") { $in1[1]="0"; }
							echo "<td width=100 align=center><kdb>$in1[0] - $in1[1]</kbd></td>";
						}
						echo "</tr>";
					}
				}

				// По дням
				$res3a1=mysql_query("SELECT DISTINCT date FROM `counters` WHERE `date` LIKE '".$date."%%' ORDER BY `date` ASC");
				while($row3a1=mysql_fetch_array($res3a1))
				{
					$dt1a2=$row3a1["date"];
					$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`='$dt1a2'"));
					if ($in1[0] < "1") { $in1[0]="0"; }
					if ($in1[1] < "1") { $in1[1]="0"; }
					echo "<tr>";
					echo "<td width=100 align=center><kdb>$dt1a2</kbd></td>";
					echo "<td width=100 align=center><kdb>$in1[0]</kbd></td>";
					echo "<td width=100 align=center><kdb>$in1[1]</kbd></td>";
					for ($h=0;$h<24;$h++)
					{
						$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`='$dt1a2' AND `hour`='$h'"));
						if ($in1[0] < "1") { $in1[0]="0"; }
						if ($in1[1] < "1") { $in1[1]="0"; }
						echo "<td width=100 align=center><kdb>$in1[0] - $in1[1]</kbd></td>";
						$inall1=$inall1 + $in1[0];
						$outall1=$outall1 + $in1[1];
					}
					echo "</tr>";
				}

				// Всего
				echo "<tr>";
				echo "<td width=100 align=center><kdb>ВСЕГО</kbd></td>";
				echo "<td width=100 align=center><kdb>$inall1</kbd></td>";
				echo "<td width=100 align=center><kdb>$outall1</kbd></td>";
				for ($h=0;$h<24;$h++)
				{
					$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date` LIKE '".$date."%%' AND `hour`='$h'"));
					if ($in1[0] < "1") { $in1[0]="0"; }
					if ($in1[1] < "1") { $in1[1]="0"; }
					echo "<td width=100 align=center><kdb>$in1[0] - $in1[1]</kbd></td>";
				}
				echo "</tr>";

				echo "</table>";

				echo "<br>";
				echo "<a href=".$_SERVER['REQUEST_URI']."&xls=1 class=href2><img src=".$gi."save1.png border=0 width=16> Скачать отчет (Excel)</a>";
				if ($_GET["xls"] == "2")
				{
					echo '<meta http-equiv=Refresh content="0; url=xls/all.xlsx">';
				}
			}
		} else if ($act2 == "add5") {
			$dt1=$_POST["date1"];
			$dt2=$_POST["date2"];
			if (empty($dt1)) { $dt1=$_GET["date1"]; }
			if (empty($dt2)) { $dt2=$_GET["date2"]; }
			if ($_GET["xls"] == "1")
			{
				$xls0agen="alld";
				include ("xls/index.php");
				echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'&act2='.$act2.'&date1='.$dt1.'&date2='.$dt2.'&xls=2">';
			} else {
				echo "<kbd>Просмотр общего отчета по дате в период: <b>".$dt1.":".$dt2."</b></kbd>";
				echo "<br>";
				echo "<br>";
				echo "<form method=POST action=index.php?act=$act&act2=add5>";
				echo "<script src='calendar_ru.js' type='text/javascript'></script>";
				echo "Сортировать по дате: ";
				echo 'от <input name=date1 type="text" onfocus="this.select();lcs(this)"
				onclick="event.cancelBubble=true;this.select();lcs(this)">';
				echo " ";
				echo 'до <input name=date2 type="text" onfocus="this.select();lcs(this)"
				onclick="event.cancelBubble=true;this.select();lcs(this)">';
				echo " ";
				echo "<input type=submit value=Выбрать name=B1><br>";
				echo "<br>";
				echo '<table border="1" style="border-collapse: collapse; font-size: 8pt;" bordercolor="#808080">';
				echo "<tr>";
				echo "<td width=100 align=center><kdb><b>ОПИСАНИЕ</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВОШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВЫШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>0</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>1</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>2</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>3</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>4</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>5</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>6</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>7</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>8</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>9</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>10</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>11</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>12</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>13</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>14</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>15</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>16</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>17</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>18</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>19</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>20</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>21</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>22</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>23</b></kbd></td>";
				echo "</tr>";

				$res3a3=mysql_query("SELECT s1,s2 FROM `bs4_2region`");
				while($row3a3=mysql_fetch_array($res3a3))
				{
					$region[$row3a3["s1"]]=$row3a3["s2"];
				}

				$res3a1=mysql_query("SELECT s1,s2,s3 FROM `bs4_3gorod` ORDER BY `s2` ASC");
				while($row3a1=mysql_fetch_array($res3a1))
				{
					$s1a2=$row3a1["s1"];
					$s2a2=$row3a1["s2"];
					$s2reg1a1g=$row3a1["s3"];
					$res3=mysql_query("SELECT * FROM `devices` WHERE `city`='$city'");
					while($row3=mysql_fetch_array($res3))
					{
						$s3a3=$row3["name"];
						$s1a3=$row3["adres"];
						$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`>='$dt1' AND `date`<='$dt2' AND `ID_Counters`='$s1a3'"));
						if ($in1[0] < "1") { $in1[0]="0"; }
						if ($in1[1] < "1") { $in1[1]="0"; }
						echo "<tr>";
						echo "<td width=100 align=center><kdb>$region[$s2a2]<br>$s2reg1a1g<br>$s3a3</kbd></td>";
						echo "<td width=100 align=center><kdb>$in1[0]</kbd></td>";
						echo "<td width=100 align=center><kdb>$in1[1]</kbd></td>";
						for ($h=0;$h<24;$h++)
						{
							$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`>='$dt1' AND `date`<='$dt2' AND `ID_Counters`='$s1a3' AND `hour`='$h'"));
							if ($in1[0] < "1") { $in1[0]="0"; }
							if ($in1[1] < "1") { $in1[1]="0"; }
							echo "<td width=100 align=center><kdb>$in1[0] - $in1[1]</kbd></td>";
						}
						echo "</tr>";
					}
				}

				// По дням
				$res3a1=mysql_query("SELECT DISTINCT date FROM `counters` WHERE `date`>='$dt1' AND `date`<='$dt2' ORDER BY `date` ASC");
				while($row3a1=mysql_fetch_array($res3a1))
				{
					$dt1a2=$row3a1["date"];
					$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE  `date`='$dt1a2' ORDER BY `date` ASC"));
					if ($in1[0] < "1") { $in1[0]="0"; }
					if ($in1[1] < "1") { $in1[1]="0"; }
					echo "<tr>";
					echo "<td width=100 align=center><kdb>$dt1a2</kbd></td>";
					echo "<td width=100 align=center><kdb>$in1[0]</kbd></td>";
					echo "<td width=100 align=center><kdb>$in1[1]</kbd></td>";
					for ($h=0;$h<24;$h++)
					{
						$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`='$dt1a2' AND `hour`='$h'"));
						if ($in1[0] < "1") { $in1[0]="0"; }
						if ($in1[1] < "1") { $in1[1]="0"; }
						echo "<td width=100 align=center><kdb>$in1[0] - $in1[1]</kbd></td>";
						$inall1=$inall1 + $in1[0];
						$outall1=$outall1 + $in1[1];
					}
					echo "</tr>";
				}

				// Всего
				echo "<tr>";
				echo "<td width=100 align=center><kdb>ВСЕГО</kbd></td>";
				echo "<td width=100 align=center><kdb>$inall1</kbd></td>";
				echo "<td width=100 align=center><kdb>$outall1</kbd></td>";
				for ($h=0;$h<24;$h++)
				{
					$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`>='$dt1' AND `date`<='$dt2' AND `hour`='$h'"));
					if ($in1[0] < "1") { $in1[0]="0"; }
					if ($in1[1] < "1") { $in1[1]="0"; }
					echo "<td width=100 align=center><kdb>$in1[0] - $in1[1]</kbd></td>";
				}
				echo "</tr>";

				echo "</table>";

				echo "<br>";
				echo "<a href=".$_SERVER['REQUEST_URI']."&date1=$dt1&date2=$dt2&xls=1 class=href2><img src=".$gi."save1.png border=0 width=16> Скачать отчет (Excel)</a>";
				if ($_GET["xls"] == "2")
				{
					echo '<meta http-equiv=Refresh content="0; url=xls/alld.xlsx">';
				}
			}
			echo "<br>";

		} else if ($act2 == "add6") {
			$dt1=date('Y-m-d');
			if ($_GET["xls"] == "1")
			{
				$xls0agen="day";
				include ("xls/index.php");
				echo '<meta http-equiv=Refresh content="0; url=index.php?act=1&act2=add6&xls=2">';
			} else {
				// Текущее состояние
				echo "<br>";
				echo '<table border="1" style="border-collapse: collapse; font-size: 8pt;" bordercolor="#808080">';
				echo "<tr>";
				echo "<td width=100 align=center><kdb><b>ОПИСАНИЕ</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВОШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВЫШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>0</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>1</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>2</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>3</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>4</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>5</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>6</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>7</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>8</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>9</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>10</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>11</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>12</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>13</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>14</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>15</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>16</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>17</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>18</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>19</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>20</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>21</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>22</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>23</b></kbd></td>";
				echo "</tr>";

				// По счетчикам
				$res3a3=mysql_query("SELECT s1,s2 FROM `bs4_2region`");
				while($row3a3=mysql_fetch_array($res3a3))
				{
					$s1reg1a1=$row3a3["s1"];
					$s2reg1a1=$row3a3["s2"];
					$res3a1=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='$s1reg1a1'");
					while($row3a1=mysql_fetch_array($res3a1))
					{
						$s1a2=$row3a1["s1"];
						$s2reg1a1g=$row3a1["s3"];
						$in0="0";
						$out0="0";
						$res3=mysql_query("SELECT s3,s4 FROM `bs4_4coun` WHERE `s2`='$s1a2'");
						while($row3=mysql_fetch_array($res3))
						{
							$s3a3=$row3["s3"];
							$s1a3=$row3["s4"];
							$in0="0";
							$out0="0";
							$res4=mysql_query("SELECT * FROM `counters` WHERE `ID_Counters`='$s1a3' AND `date`='$dt1'");
							while($row4=mysql_fetch_array($res4))
							{
								$in1=$row4["in"];
								$out1=$row4["out"];
								$in0=$in0 + $in1;
								$out0=$out0 + $out1;
							}
							echo "<tr>";
							echo "<td width=100 align=center><kdb>$s2reg1a1<br>$s2reg1a1g<br>$s3a3</kbd></td>";
							echo "<td width=100 align=center><kdb>$in0</kbd></td>";
							echo "<td width=100 align=center><kdb>$out0</kbd></td>";
							$inall1a=$inall1a + $in0;
							$outall1a=$outall1a + $out0;
							for ($h=0;$h<24;$h++)
							{
								/*
								$in0="0";
								$out0="0";
								$res3c=mysql_query("SELECT * FROM `counters` WHERE `ID_Counters`='$s1a3' AND `date`='$dt1' AND `hour`='$h' LIMIT 0,1");
								while($row3c=mysql_fetch_array($res3c))
								{
									$in1=$row3c["in"];
									$out1=$row3c["out"];
									$in0=$in0 + $in1;
									$out0=$out0 + $out1;
								}
								echo "<td width=100 align=center><kdb>$in0 - $out0</kbd></td>";
								$inall1b[$h]=$inall1b[$h] + $in0;
								$outall1b[$h]=$outall1b[$h] + $out0;
								*/
								$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$s1a3' AND `date`='$dt1' AND `hour`='$h'"));
								if ($in1[0] < "1") { $in1[0]="0"; }
								if ($in1[1] < "1") { $in1[1]="0"; }
								echo "<td width=100 align=center><kdb>$in1[0] - $in1[1]</kbd></td>";
								$inall1b[$h]=$inall1b[$h] + $in1[0];
								$outall1b[$h]=$outall1b[$h] + $in1[1];
							}
							echo "</tr>";
						}
					}
				}

				// Всего
				$in0="0";
				$out0="0";
				echo "<tr>";
				echo "<td width=100 align=center><kdb>ВСЕГО</kbd></td>";
				echo "<td width=100 align=center><kdb>$inall1a</kbd></td>";
				echo "<td width=100 align=center><kdb>$outall1a</kbd></td>";
				for ($h=0;$h<24;$h++)
				{
					echo "<td width=100 align=center><kdb>$inall1b[$h] - $outall1b[$h]</kbd></td>";
				}
				echo "</tr>";

				echo "</table>";

				echo "<br>";
				echo "<a href=".$_SERVER['REQUEST_URI']."&xls=1 class=href2><img src=".$gi."save1.png border=0 width=16> Скачать отчет (Excel)</a>";
				if ($_GET["xls"] == "2")
				{
					echo '<meta http-equiv=Refresh content="0; url=xls/day.xlsx">';
				}
			}
		} else if ($act2 == "add7") {
			echo "<br>";
			echo "<form method=POST action=index.php?act=$act&act2=add8>";
			echo "Город: ";
			echo "<select size=1 name=s2>";
			$res3a=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
			while($row3a=mysql_fetch_array($res3a))
			{
				$s2=$row3a["s1"];
				$s2a=$row3a["s2"];
	//			echo "<option value='r".$s2."'>".$s2a."</option>";
				$res3=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='$s2' ORDER BY s3 ASC");
				while($row3=mysql_fetch_array($res3))
				{
					$s1=$row3["s1"];
					$s3=$row3["s3"];
					echo "<option value='".$s1."'>-&nbsp;".$s2a." - ".$s3."</option>";
				}
			}
			echo "</select> ";
			echo "<input type=submit value='Выбрать' name=B1><br>";
			echo "</form><br>";
			echo "<br>";

			echo "<br>";
			echo "<br>";
		} else if ($act2 == "add8") {
			$id=$_POST["s2"];
			if (empty($id))
			{
				$id=$_GET["id"];
			}
			if ($_GET["xls"] == "1")
			{
				$xls0agen="gorod";
				include ("xls/index.php");
				echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'&act2='.$act2.'&id='.$id.'&xls=2">';
			} else {
				echo "<form method=POST action=index.php?act=$act&act2=add8>";
				echo "Город: ";
				echo "<select size=1 name=s2>";
				$res3a=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
				while($row3a=mysql_fetch_array($res3a))
				{
					$s2=$row3a["s1"];
					$s2a=$row3a["s2"];
		//			echo "<option value='r".$s2."'>".$s2a."</option>";
					$res3=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='$s2' ORDER BY s3 ASC");
					while($row3=mysql_fetch_array($res3))
					{
						$s1=$row3["s1"];
						$s3=$row3["s3"];
						if ($s1 == $id)
						{
							echo "<option selected value='".$s1."'>-&nbsp;".$s2a." - ".$s3."</option>";
						} else {
							echo "<option value='".$s1."'>-&nbsp;".$s2a." - ".$s3."</option>";
						}
					}
				}
				echo "</select> ";
				echo "<input type=submit value='Выбрать' name=B1><br>";
				echo "</form><br>";

				$pos=strpos($id, "r");
				if ($pos === false)
				{
					$res3a=mysql_query("SELECT s3 FROM `bs4_3gorod` WHERE `s1`='$id' LIMIT 0,1");
					while($row3a=mysql_fetch_array($res3a))
					{
						$name=$row3a["s3"];
					}
					$name="Сорировка по городу: <b>".$name."</b>";
					$sort="g";
				} else {
					$id=str_replace("r", "", "$id");
					$res3a=mysql_query("SELECT s2 FROM `bs4_2region` WHERE `s1`='$id' LIMIT 0,1");
					while($row3a=mysql_fetch_array($res3a))
					{
						$name=$row3a["id"];
					}
					$name="Сорировка по региону: <b>".$name."</b>";
					$sort="r";
				}
				echo "$name";
				echo "<br>";
				echo "<br>";

				echo '<table border="1" style="border-collapse: collapse; font-size: 8pt;" bordercolor="#808080">';
				echo "<tr>";
				echo "<td width=100 align=center><kdb><b>ОПИСАНИЕ</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВОШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВЫШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>0</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>1</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>2</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>3</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>4</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>5</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>6</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>7</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>8</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>9</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>10</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>11</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>12</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>13</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>14</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>15</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>16</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>17</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>18</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>19</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>20</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>21</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>22</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>23</b></kbd></td>";
				echo "</tr>";

				// По счетчикам
				$res3=mysql_query("SELECT * FROM `devices` WHERE `city`='$id'");
				while($row3=mysql_fetch_array($res3))
				{
					$s3a3=$row3["name"];
					$s1a3=$row3["mac_last"];
					$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$s1a3'"));
					if ($in1[0] < "1") { $in1[0]="0"; }
					if ($in1[1] < "1") { $in1[1]="0"; }
					echo "<tr>";
					echo "<td width=100 align=center><kdb>$s3a3</kbd></td>";
					echo "<td width=100 align=center><kdb>$in1[0]</kbd></td>";
					echo "<td width=100 align=center><kdb>$in1[1]</kbd></td>";
					$in0all1=$in0all1 + $in1[0];
					$out0all1=$out0all1 + $in1[1];
					for ($h=0;$h<24;$h++)
					{
						$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$s1a3' AND `hour`='$h'"));
						if ($in1[0] < "1") { $in1[0]="0"; }
						if ($in1[1] < "1") { $in1[1]="0"; }
						echo "<td width=100 align=center><kdb>$in1[0] - $in1[1]</kbd></td>";
						$in0a[$h]=$in0a[$h] + $in1[0];
						$out0a[$h]=$out0a[$h] + $in1[1];
					}
					echo "</tr>";
				}

				// Всего
				echo "<tr>";
				echo "<td width=100 align=center><kdb>ВСЕГО</kbd></td>";
				echo "<td width=100 align=center><kdb>$in0all1</kbd></td>";
				echo "<td width=100 align=center><kdb>$out0all1</kbd></td>";
				for ($h=0;$h<24;$h++)
				{
					echo "<td width=100 align=center><kdb>$in0a[$h] - $out0a[$h]</kbd></td>";
				}
				echo "</tr>";

				echo "</table>";

				echo "<br>";
				echo "<a href=".$_SERVER['REQUEST_URI']."&id=$id&xls=1 class=href2><img src=".$gi."save1.png border=0 width=16> Скачать отчет (Excel)</a>";
				if ($_GET["xls"] == "2")
				{
					echo '<meta http-equiv=Refresh content="0; url=xls/gorod.xlsx">';
				}
			}
		} else if ($act2 == "add9") {
			echo "<form method=POST action=index.php?act=$act&act2=add10>";
			echo "Регион: ";
			echo "<select size=1 name=s2>";
			$res3a=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
			while($row3a=mysql_fetch_array($res3a))
			{
				$s2=$row3a["s1"];
				$s2a=$row3a["s2"];
				echo "<option value='".$s2."'>".$s2a."</option>";
			}
			echo "</select> ";
			echo "<input type=submit value='Выбрать' name=B1><br>";
			echo "</form><br>";
			echo "<br>";
		} else if ($act2 == "add10") {
			$id=$_POST["s2"];
			if (empty($id))
			{
				$id=$_GET["id"];
			}
			if ($_GET["xls"] == "1")
			{
				$xls0agen="region";
				include ("xls/index.php");
				echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'&act2='.$act2.'&id='.$id.'&xls=2">';
			} else {
				echo "<form method=POST action=index.php?act=$act&act2=add10>";
				echo "Регион: ";
				echo "<select size=1 name=s2>";
				$res3a=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
				while($row3a=mysql_fetch_array($res3a))
				{
					$s2=$row3a["s1"];
					$s2a=$row3a["s2"];
					if ($s2 == $id)
					{
						echo "<option selected value='".$s2."'>".$s2a."</option>";
					} else {
						echo "<option value='".$s2."'>".$s2a."</option>";
					}
				}
				echo "</select> ";
				echo "<input type=submit value='Выбрать' name=B1><br>";
				echo "</form><br>";
				echo "<br>";

				echo '<table border="1" style="border-collapse: collapse; font-size: 8pt;" bordercolor="#808080">';
				echo "<tr>";
				echo "<td width=100 align=center><kdb><b>ОПИСАНИЕ</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВОШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>ВЫШЛО</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>0</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>1</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>2</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>3</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>4</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>5</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>6</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>7</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>8</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>9</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>10</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>11</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>12</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>13</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>14</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>15</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>16</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>17</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>18</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>19</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>20</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>21</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>22</b></kbd></td>";
				echo "<td width=100 align=center><kdb><b>23</b></kbd></td>";
				echo "</tr>";

				// По городам
				$res3=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='".$id."'");
				while($row3=mysql_fetch_array($res3))
				{
					$s3a1=$row3["s1"];
					$s3a3=$row3["s3"];
					$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters` IN (SELECT mac_last FROM `devices` WHERE `city`='$s3a1')"));
					if ($in1[0] < "1") { $in1[0]="0"; }
					if ($in1[1] < "1") { $in1[1]="0"; }
					echo "<tr>";
					echo "<td width=100 align=center><kdb>$s3a3</kbd></td>";
					echo "<td width=100 align=center><kdb>$in1[0]</kbd></td>";
					echo "<td width=100 align=center><kdb>$in1[1]</kbd></td>";
					$in0all1=$in0all1 + $in1[0];
					$out0all1=$out0all1 + $in1[1];
					for ($h=0;$h<24;$h++)
					{
						$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters` IN (SELECT mac_last FROM `devices` WHERE `city`='$s3a1') AND `hour`='$h'"));
						if ($in1[0] < "1") { $in1[0]="0"; }
						if ($in1[1] < "1") { $in1[1]="0"; }
						echo "<td width=100 align=center><kdb>$in1[0] - $in1[1]</kbd></td>";
						$in0a[$h]=$in0a[$h] + $in1[0];
						$out0a[$h]=$out0a[$h] + $in1[1];
					}
					echo "</tr>";
				}

				// Всего
				echo "<tr>";
				echo "<td width=100 align=center><kdb>ВСЕГО</kbd></td>";
				echo "<td width=100 align=center><kdb>$in0all1</kbd></td>";
				echo "<td width=100 align=center><kdb>$out0all1</kbd></td>";
				for ($h=0;$h<24;$h++)
				{
					echo "<td width=100 align=center><kdb>$in0a[$h] - $out0a[$h]</kbd></td>";
				}
				echo "</tr>";

				echo "</table>";

				echo "<br>";
				echo "<a href=".$_SERVER['REQUEST_URI']."&id=$id&xls=1 class=href2><img src=".$gi."save1.png border=0 width=16> Скачать отчет (Excel)</a>";
				if ($_GET["xls"] == "2")
				{
					echo '<meta http-equiv=Refresh content="0; url=xls/region.xlsx">';
				}
			}
		} else {
//			echo "<a href=index.php?act=$act&act2=add6 class=href1>За сегодня</a>&nbsp;&nbsp;";
			echo "<a href=index.php?act=$act&act2=add3 class=href1>Общий отчет</a>&nbsp;&nbsp;";
			echo "<a href=index.php?act=$act&act2=add7 class=href1>Отчет по городам</a>&nbsp;&nbsp;";
			echo "<a href=index.php?act=$act&act2=add9 class=href1>Отчет по регионам</a>&nbsp;&nbsp;";
			echo "<br>";
			echo "<br>";
			$res3=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
			while($row3=mysql_fetch_array($res3))
			{
				$s1=$row3["s1"];
				$s2=$row3["s2"];
				echo "<b>".$s2.":</b>";
				echo '<table border="1" style="border-collapse: collapse" bordercolor="#808080">';
				echo "<tr>";
				echo "<td width=100 align=center><kbd><b>ФУНКЦИИ</b></kbd></td>";
				echo "<td width=300 align=center><kbd><b>РЕГИОН</b></kbd></td>";
				echo "<td width=200 align=center><kbd><b>НАЗВАНИЕ</b></kbd></td>";
				echo "<td width=200 align=center><kbd><b>АДРЕС</b></kbd></td>";
				echo "</tr>";
				$res3a=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='$s1'");
				while($row3a=mysql_fetch_array($res3a))
				{
					$s1a=$row3a["s1"];
					$s3a=$row3a["s3"];
					$res3b=mysql_query("SELECT * FROM `devices` WHERE `city`='$s1a'");
					while($row3b=mysql_fetch_array($res3b))
					{
						$s3b=$row3b["name"];
						$mac_last=$row3b["mac_last"];
						echo "<tr>";
						echo "<td width=100 align=center><kbd>";
						echo "<a href=index.php?act=$act&act2=add1&id=$mac_last><img src=".$gi."list.png width=20 title='Просмотреть отчет' border=0></a>";
						echo "</kbd></td>";
						echo "<td width=300 align=left><kbd>&nbsp;".$s2." - ".$s3a."</kbd></td>";
						echo "<td width=200 align=left><kbd>&nbsp;".$s3b."</kbd></td>";
						echo "<td width=200 align=left><kbd>&nbsp;".$mac_last."</kbd></td>";
						echo "</tr>";
					}
				}
				echo "</table>";
				echo "<br>";
				echo "<br>";
			}
		}
		echo "</div>";
?>