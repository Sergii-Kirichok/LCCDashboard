<?php
if ($str != "index.php") exit;

		echo "<div class=div1>";
		echo "<b>Управление счетчиками</b>";
		echo "<hr>";
		if ($s4u1 > "1")
		{
			if ($act2 == "add1")
			{
				echo "Добавить регион:<br>";
				echo "<form method=POST action=index.php?act=$act&act2=add2>";
				echo "Название: ";
				echo "<input type=text name=s2 size=20 required > ";
				echo "<input type=submit value='Добавить' name=B1><br>";
				echo "</form><br>";
				echo "<br>";
				$rows1=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_2region` LIMIT 0,1"));
				if ($rows1 > "0")
				{
					echo "<kbd>СПИСОК ВСЕХ РЕГИОНОВ:</kbd>";
					echo "<br>";
					echo '<table border="1" style="border-collapse: collapse" bordercolor="#808080">';
					echo "<tr>";
					echo "<td width=100 align=center><kbd><b>ФУНКЦИИ</b></kbd></td>";
					echo "<td width=300 align=center><kbd><b>НАЗВАНИЕ</b></kbd></td>";
					echo "</tr>";
					$res3=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
					while($row3=mysql_fetch_array($res3))
					{
						$id=$row3["s1"];
						$name=$row3["s2"];
						echo "<tr>";
						echo "<td width=100 align=center><kbd>";
						echo "<a href=index.php?act=$act&act2=add15&id=$id><img src=".$gi."redir.png width=20 title='Редактировать' border=0></a>";
						echo "</kbd></td>";
						echo "<td width=300 align=left><kbd>&nbsp;".$name."</kbd></td>";
						echo "</tr>";
					}
					echo "</table>";
				} else {
					echo "<kbd>У ВАС НЕТ ДОБАВЛЕННЫХ РЕГИОНОВ!</kbd>";
				}
			} else if ($act2 == "add2") {
				$s2=$_POST["s2"];
				$s3="1";
				$s4="1";
				mysql_query("INSERT INTO `bs4_2region` (s2, s3, s4) VALUES ('$s2', '$s3', '$s4')");
				echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'">';
			} else if ($act2 == "add3") {
				echo "Создание города:<br>";
				echo "<form method=POST action=index.php?act=$act&act2=add4>";
				echo "Регион<br>";
				echo "<select size=1 name=s2>";
				$res3=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
				while($row3=mysql_fetch_array($res3))
				{
					$s1=$row3["s1"];
					$s2=$row3["s2"];
					echo "<option value='".$s1."'>".$s2."</option>";
				}
				echo "</select><br>";
				echo "Название<br>";
				echo "<input type=text name=s3 size=20 required ><br>";
				echo "<br>";
				echo "<input type=submit value='Сохранить' name=B1><br>";
				echo "</form><br>";
				$rows1=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_2region` LIMIT 0,1"));
				if ($rows1 > "0")
				{
					echo "<kbd>СПИСОК ВСЕХ ГОРОДОВ:</kbd>";
					echo "<br>";
					echo '<table border="1" style="border-collapse: collapse" bordercolor="#808080">';
					echo "<tr>";
					echo "<td width=100 align=center><kbd><b>ФУНКЦИИ</b></kbd></td>";
					echo "<td width=300 align=center><kbd><b>РЕГИОН</b></kbd></td>";
					echo "<td width=300 align=center><kbd><b>НАЗВАНИЕ</b></kbd></td>";
					echo "</tr>";
					$res3=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
					while($row3=mysql_fetch_array($res3))
					{
						$id2=$row3["s1"];
						$name=$row3["s2"];
						$res3a=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='$id2'");
						while($row3a=mysql_fetch_array($res3a))
						{
							$id=$row3a["s1"];
							$name2=$row3a["s3"];
							echo "<tr>";
							echo "<td width=100 align=center><kbd>";
							echo "<a href=index.php?act=$act&act2=add17&id=$id><img src=".$gi."redir.png width=20 title='Редактировать' border=0></a>";
							echo "</kbd></td>";
							echo "<td width=300 align=left><kbd>&nbsp;".$name."</kbd></td>";
							echo "<td width=300 align=left><kbd>&nbsp;".$name2."</kbd></td>";
							echo "</tr>";
						}
					}
					echo "</table>";
				} else {
					echo "<kbd>У ВАС НЕТ ДОБАВЛЕННЫХ ГОРОДОВ!</kbd>";
				}
			} else if ($act2 == "add4") {
				$s2=$_POST["s2"];
				$s3=$_POST["s3"];
				$s4="1";
				$s5="1";
				mysql_query("INSERT INTO `bs4_3gorod` (s2, s3, s4, s5) VALUES ('$s2', '$s3', '$s4', '$s5')");
				echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'">';
			} else if ($act2 == "add5") {
				echo "Добавление счетчика:<br>";
				echo "<form method=POST action=index.php?act=$act&act2=add6>";
				echo "Регион - город<br>";
				echo "<select size=1 name=s2>";
				$res3a=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
				while($row3a=mysql_fetch_array($res3a))
				{
					$s2=$row3a["s1"];
					$s2a=$row3a["s2"];
					$res3=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='$s2' ORDER BY s3 ASC");
					while($row3=mysql_fetch_array($res3))
					{
						$s1=$row3["s1"];
						$s3=$row3["s3"];
						echo "<option value='".$s1."'>".$s2a." - ".$s3."</option>";
					}
				}
				echo "</select><br>";
				echo "Название<br>";
				echo "<input type=text name=s3 size=20 required ><br>";
				/*
				echo "Адрес<br>";
				echo "<input type=text name=s4 size=20 required ><br>";
				*/
				echo "IP<br>";
				echo "<input type=text name=ip size=20 required ><br>";
				echo "Порт<br>";
				echo "<input type=text name=port size=4 value=23 required ><br>";
				echo "Интервал опроса (пример: 1m ,1h, 1h30m)<br>";
				echo "<input type=text name=update_interval size=10 value=5m required ><br>";
				echo "Активность<br>";
				echo "<select size=1 name=enabled>";
				echo "<option value='1'>Активен</option>";
				echo "<option value='0'>Не активен</option>";
				echo "</select><br>";
				echo "<br>";
				echo "<input type=submit value='Сохранить' name=B1><br>";
				echo "</form><br>";
			} else if ($act2 == "add6") {
				$s2=$_POST["s2"];
				$s3=$_POST["s3"];
				$s4=$_POST["s4"];
				$ipadres=$_POST["ip"];
				$port=$_POST["port"];
				$update_interval=$_POST["update_interval"];
				$enabled=$_POST["enabled"];
				$rows1c=mysql_num_rows(mysql_query("SELECT id FROM `devices` WHERE `ip`='$ipadres' LIMIT 0,1"));
				if ($rows1c > "0")
				{
					$s2b=$s2;
					$s3a=$s3;
					$s4a=$s4;
					$er1="<font color=red><kbd>Этот адрес занят!</kbd></font>";
					echo "Добавление счетчика:<br>";
					echo "<form method=POST action=index.php?act=$act&act2=add6>";
					echo "регион - город<br>";
					echo "<select size=1 name=s2>";
					$res3a=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
					while($row3a=mysql_fetch_array($res3a))
					{
						$s2=$row3a["s1"];
						$s2a=$row3a["s2"];
						$res3=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='$s2' ORDER BY s3 ASC");
						while($row3=mysql_fetch_array($res3))
						{
							$s1=$row3["s1"];
							$s3=$row3["s3"];
							if ($s1 == $s2b)
							{
								echo "<option selected value='".$s1."'>".$s2a." - ".$s3."</option>";
							} else {
								echo "<option value='".$s1."'>".$s2a." - ".$s3."</option>";
							}
						}
					}
					echo "</select><br>";
					echo "Название<br>";
					echo "<input type=text name=s3 value='".$s3a."' size=20 required ><br>";
					/*
					echo "Адрес<br>";
					echo "<input type=text name=s4 value='".$s4a."' size=20 required > $er1<br>";
					*/
					echo "IP<br>";
					echo "<input type=text name=ip size=20 value='".$ipadres."' required > $er1<br>";
					echo "Порт<br>";
					echo "<input type=text name=port size=4 value='".$port."' required ><br>";
					echo "Интервал опроса (пример: 1m ,1h, 1h30m)<br>";
					echo "<input type=text name=update_interval size=10 value='".$update_interval."' required ><br>";
					echo "Активность<br>";
					echo "<select size=1 name=enabled>";
					if ($enabled == "1")
					{
						$esel1="selected";
					} else {
						$esel0="selected";
					}
					echo "<option $esel1 value='1'>Активен</option>";
					echo "<option $esel0 value='0'>Не активен</option>";
					echo "</select><br>";
					echo "<br>";
					echo "<input type=submit value='Сохранить' name=B1><br>";
					echo "</form><br>";
				} else {
					function f_mac_proverka($mac_address,$s2,$s3,$act)
					{
						$dostupnie_simvoli=array('a', 'b', 'c', 'd', 'e', 'f', 'A', 'B', 'C', 'D', 'E', 'F', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
						$arr_mac=explode(":", $mac_address);
						$mac_string=implode($arr_mac);
						$length=iconv_strlen($mac_string);
						if ($length!=12)
						{
							echo '<meta http-equiv=Refresh content="2; url=index.php?act=2&act2=add5">';
							exit ("Некорректный мас адрес! $mac_address");
						}
						$n=0;
						while($n != 12)
						{
							if (in_array($mac_string{$n}, $dostupnie_simvoli))
							{
								echo "";
							} else {
								echo $ip_string{$n};
								echo '<meta http-equiv=Refresh content="2; url=index.php?act=2&act2=add5">';
								exit ("<p>В mac адрес был введен недопустимый символ </p>");
							}
							++$n;
						}
						$res3=mysql_query("SELECT s2 FROM `bs4_3gorod` WHERE `s1`='$s2' LIMIT 0,1");
						while($row3=mysql_fetch_array($res3))
						{
							$region=$row3["s2"];
						}
					}
//					f_mac_proverka($s4,$s2,$s3,$act);
					
					$last_seen="0000-00-00 00:00:00";
					$last_check="0000-00-00 00:00:00";
					$firmware="0.0.0";
					$ip=$_POST["ip"];
					$port=$_POST["port"];
					$update_interval=$_POST["update_interval"];
					$enabled=$_POST["enabled"];
					mysql_query("INSERT INTO `devices` 
					(`name`, `region`, `city`, `online`, `eeprom`, `barrier`, `ip`, `port`, `update_interval`, `enabled`)
					VALUES
					('$s3a', '$region', '$s2', '$online', '$eeprom', '$barrier', '$ip', '$port', '$update_interval', '$enabled')");
					echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'">';
				}
			} else if ($act2 == "add7") {
				$res3=mysql_query("SELECT * FROM `devices` WHERE `id`='$id' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$name=$row3["name"];
					$region=$row3["region"];
					$city=$row3["city"];
					$online=$row3["online"];
					$eeprom=$row3["eeprom"];
					$barrier=$row3["barrier"];
					$ip=$row3["ip"];
					$port=$row3["port"];
					$update_interval=$row3["update_interval"];
					$mac_last=$row3["mac_last"];
					$enabled=$row3["enabled"];
				}
				
				if ($_GET["er"] == "1")
				{
					$er1="<font color=red><kbd>Этот адрес занят!</kbd></font>";
				}
				if (!empty($_GET["id2"]))
				{
					$href=$_GET["id2"];
				}
				
				echo "Редавтирование счетчика:<br>";
				echo "<form method=POST action=index.php?act=$act&act2=add8&id=$id>";
				echo "регион - город<br>";
				echo "<select size=1 name=city>";
				$res3a=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
				while($row3a=mysql_fetch_array($res3a))
				{
					$s2=$row3a["s1"];
					$s2a=$row3a["s2"];
					$res3=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='$s2' ORDER BY s3 ASC");
					while($row3=mysql_fetch_array($res3))
					{
						$s1=$row3["s1"];
						$s3=$row3["s3"];
						if ($s1 == $city)
						{
							echo "<option selected value='".$s1."'>".$s2a." - ".$s3."</option>";
						} else {
							echo "<option value='".$s1."'>".$s2a." - ".$s3."</option>";
						}
					}
				}
				echo "</select><br>";
				echo "Название<br>";
				echo "<input type=text name=name value='".$name."' size=20 required ><br>";
				echo "Адрес<br>";
				echo "<input type=text name=mac_last value='".$mac_last."' size=20 required > $er1<br>";
				echo "IP<br>";
				echo "<input type=text name=ip size=20 value='".$ip."' required > $er1<br>";
				echo "Порт<br>";
				echo "<input type=text name=port size=4 value='".$port."' required ><br>";
				echo "Интервал опроса (пример: 1m ,1h, 1h30m)<br>";
				echo "<input type=text name=update_interval size=10 value='".$update_interval."' required ><br>";
				echo "Активность<br>";
				echo "<select size=1 name=enabled>";
				if ($enabled == "1")
				{
					$esel1="selected";
				} else {
					$esel0="selected";
				}
				echo "<option $esel1 value='1'>Активен</option>";
				echo "<option $esel0 value='0'>Не активен</option>";
				echo "</select><br>";
				echo "<br>";
				echo "<input type=submit value='Сохранить' name=B1><br>";
				echo "</form><br>";
				
			} else if ($act2 == "add8") {
				$res3=mysql_query("SELECT `mac_last` FROM `devices` WHERE `id`='$id' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$mac_last0=$row3["mac_last"];
				}
				$name=$_POST["name"];
				$region=$_POST["region"];
				$city=$_POST["city"];
				$ip=$_POST["ip"];
				$port=$_POST["port"];
				$mac_last=$_POST["mac_last"];
				$enabled=$_POST["enabled"];
				$update_interval=$_POST["update_interval"];
				if ($_GET["er"] == "1")
				{
					mysql_query("
					UPDATE `counters`
					SET
					`ID_Counters`=replace(`ID_Counters`, '$mac_last0', '$mac_last');
					");
					$mac_last0=$mac_last;
				}
				$res3=mysql_query("SELECT s2,s3 FROM `bs4_3gorod` WHERE `s1`='$city' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$region=$row3["s2"];
					$namegorod=$row3["s3"];
				}
				
				if ($mac_last0 != $mac_last)
				{
					echo "<div style='text-align: center;'>";
					echo "Внимание! Вы собираетесь заменить всю статистику счетчика: <b>".$namegorod." - ".$name."</b>";
					echo "<br>";
					echo "Старый адрес: $mac_last0<br>";
					echo "Новый адрес: $mac_last<br>";
					echo "</div>";
					echo "<form method=POST action=index.php?act=$act&act2=add8&id=$id&er=1>";
					echo "Регион - город<br>";
					echo "<select size=1 name=city>";
					$res3a=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
					while($row3a=mysql_fetch_array($res3a))
					{
						$s2=$row3a["s1"];
						$s2a=$row3a["s2"];
						$res3=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='$s2' ORDER BY s3 ASC");
						while($row3=mysql_fetch_array($res3))
						{
							$s1=$row3["s1"];
							$s3=$row3["s3"];
							if ($s1 == $city)
							{
								echo "<option selected value='".$s1."'>".$s2a." - ".$s3."</option>";
							} else {
								echo "<option value='".$s1."'>".$s2a." - ".$s3."</option>";
							}
						}
					}
					echo "</select><br>";
					echo "Название<br>";
					echo "<input type=text name=name value='".$name."' size=20 required ><br>";
					echo "Адрес<br>";
					echo "<input type=text name=mac_last value='".$mac_last."' size=20 required > $er1<br>";
					echo "IP<br>";
					echo "<input type=text name=ip size=20 value='".$ip."' required > $er1<br>";
					echo "Порт<br>";
					echo "<input type=text name=port size=4 value='".$port."' required ><br>";
					echo "Интервал опроса (пример: 1m ,1h, 1h30m)<br>";
					echo "<input type=text name=update_interval size=10 value='".$update_interval."' required ><br>";
					echo "Активность<br>";
					echo "<select size=1 name=enabled>";
					if ($enabled == "1")
					{
						$esel1="selected";
					} else {
						$esel0="selected";
					}
					echo "<option $esel1 value='1'>Активен</option>";
					echo "<option $esel0 value='0'>Не активен</option>";
					echo "</select><br>";
					echo "<br>";
					echo "<input type=submit value='Потвердить' name=B1><br>";
					echo "</form><br>";
				} else {
					mysql_query("UPDATE devices SET
					`name`='$name',
					`region`='$region',
					`city`='$city',
					`ip`='$ip',
					`port`='$port',
					`update_interval`='$update_interval',
					`mac_last`='$mac_last',
					`enabled`='$enabled'
					WHERE
					`id`='$id'");
					echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'&act2=add7&id='.$id.'">';
				}
			} else if ($act2 == "add9") {
				echo "<kbd><b>Добавление счетчиков</b></kbd>";
				echo "<br>";
				echo "<br>";
				echo '<table border="1" style="border-collapse: collapse" bordercolor="#808080">';
				echo "<tr>";
				echo "<td width=100 align=center><kbd><b>ФУНКЦИИ</b></kbd></td>";
				echo "<td width=160 align=center><kbd><b>СЕТЕВОЙ АДРЕС</b></kbd></td>";
				echo "<td width=200 align=center><kbd><b>ЗАПИСЕЙ СТАТИСТИКИ</b></kbd></td>";
				echo "</tr>";
				$res3=mysql_query("SELECT DISTINCT ID_Counters FROM `counters` WHERE ID_Counters NOT IN (SELECT s4 FROM `bs4_4coun`)");
				while($row3=mysql_fetch_array($res3))
				{
					$c1=$row3["ID_Counters"];
					$stat1=mysql_num_rows(mysql_query("SELECT ID_Counters FROM `counters` WHERE `ID_Counters`='$c1'"));
					echo "<tr>";
					echo "<td width=100 align=center><kbd>";
					echo "<a href=index.php?act=$act&act2=add10&id=$c1><img src=".$gi."add.png width=20 title='Добавить в базу' border=0></a>";
					echo "</kbd></td>";
					echo "<td width=160 align=left><kbd>&nbsp;$c1</kbd></td>";
					echo "<td width=200 align=left><kbd>&nbsp;$stat1</kbd></td>";
					echo "</tr>";
				}
				echo "</table>";
			} else if ($act2 == "add10") {
				echo "<kbd><b>Добавление счетчиков</b></kbd>";
				echo "<br>";
				echo "<br>";
				echo "<form method=POST action=index.php?act=$act&act2=add11&id=$id>";
				echo "Регион - город<br>";
				echo "<select size=1 name=s2>";
				$res3a=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
				while($row3a=mysql_fetch_array($res3a))
				{
					$s2=$row3a["s1"];
					$s2a=$row3a["s2"];
					$res3=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='$s2' ORDER BY s3 ASC");
					while($row3=mysql_fetch_array($res3))
					{
						$s1=$row3["s1"];
						$s3=$row3["s3"];
						echo "<option value='".$s1."'>".$s2a." - ".$s3."</option>";
					}
				}
				echo "</select><br>";
				echo "Название<br>";
				echo "<input type=text name=s3 size=20 required ><br>";
				echo "Адрес<br>";
				echo "<span style='border: 1px solid #ccc; padding: 1px; margin-top: 2px;'>".$id."</span><br>";
				echo "<br>";
				echo "<input type=submit value='Сохранить' name=B1><br>";
				echo "</form><br>";
			} else if ($act2 == "add11") {
				$s2=$_POST["s2"];
				$s3=$_POST["s3"];
				$s4=$id;
				function f_mac_proverka($mac_address,$s2,$s3,$act,$id)
				{
					$dostupnie_simvoli=array('a', 'b', 'c', 'd', 'e', 'f', 'A', 'B', 'C', 'D', 'E', 'F', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
					$arr_mac=explode(":", $mac_address);
					$mac_string=implode($arr_mac);
					$length=iconv_strlen($mac_string);
					if ($length!=12)
					{
						echo '<meta http-equiv=Refresh content="2; url=index.php?act=2&act2=add10&id='.$id.'">';
						exit ("Некорректный мас адрес!");
					}
					$n=0;
					while($n != 12)
					{
						if (in_array($mac_string{$n}, $dostupnie_simvoli))
						{
							echo "";
						} else {
							echo $ip_string{$n};
							echo '<meta http-equiv=Refresh content="2; url=index.php?act=2&act2=add10&id='.$id.'">';
							exit ("<p>В mac адрес был введен недопустимый символ </p>");
						}
						++$n;
					}
					mysql_query("INSERT INTO `bs4_4coun` (s2, s3, s4) VALUES ('$s2', '$s3', '$mac_address')");
					echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'">';
				}
				f_mac_proverka($s4,$s2,$s3,$act,$id);
			} else if ($act2 == "add12") {
				echo "<kbd><b>Дубликаты</b></kbd>";
				echo "<br>";
				echo "<br>";
				$rows2c=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_4coun` GROUP BY s4 HAVING count(*) > 1"));
				if ($rows2c > "0")
				{
					echo '<table border="1" style="border-collapse: collapse" bordercolor="#808080">';
					echo "<tr>";
					echo "<td width=100 align=center><kbd><b>ФУНКЦИИ</b></kbd></td>";
					echo "<td width=300 align=center><kbd><b>НАЗВАНИЕ СЧЕТЧИКА</b></kbd></td>";
					echo "<td width=180 align=center><kbd><b>НЕ УНИКАЛЬНЫЙ АДРЕС</b></kbd></td>";
					echo "</tr>";
					$res3=mysql_query("SELECT s4 FROM `bs4_4coun` GROUP BY s4 HAVING count(*) > 1");
					while($row3=mysql_fetch_array($res3))
					{
						$c1=$row3["s4"];
						$res3a=mysql_query("SELECT s1,s3 FROM `bs4_4coun` WHERE `s4`='$c1'");
						while($row3a=mysql_fetch_array($res3a))
						{
							$id=$row3a["s1"];
							$name=$row3a["s3"];
							echo "<tr>";
							echo "<td width=100 align=center><kbd>";
							echo "<a href=index.php?act=$act&act2=add13&id=$id><img src=".$gi."redir.png width=18 title='Сменить' border=0></a>";
							echo "</kbd></td>";
							echo "<td width=300 align=left><kbd>&nbsp;$name</kbd></td>";
							echo "<td width=180 align=left><kbd>&nbsp;$c1</kbd></td>";
							echo "</tr>";
						}
					}
					echo "</table>";
				} else {
					echo "<font color=#333333><kbd>НЕТ ДУБЛИКАТОВ!</kbd></font>";
					echo '<meta http-equiv=Refresh content="2; url=index.php?act='.$act.'">';
				}
			} else if ($act2 == "add13") {
				$res3=mysql_query("SELECT s3,s4 FROM `bs4_4coun` WHERE `s1`='$id' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$name=$row3["s3"];
					$s4=$row3["s4"];
				}
				if ($_GET["er"] == "1")
				{
					$er1="<font color=red><kbd>Этот адрес занят!</kbd></font>";
				}
				if (!empty($_GET["id2"]))
				{
					$s4=$_GET["id2"];
				}
				echo "<kbd><b>Дубликаты</b></kbd>";
				echo "<br>";
				echo "<br>";
				echo "<form method=POST action=index.php?act=$act&act2=add14&id=$id>";
				echo "Название:<br><b>".$name."</b><br>";
				echo "Адрес<br>";
				echo "<input type=text name=s4 size=20 value='".$s4."' required > $er1";
				echo "<br>";
				echo "<br>";
				echo "<input type=submit value='Сохранить' name=B1><br>";
				echo "</form><br>";
			} else if ($act2 == "add14") {
				$s4=$_POST["s4"];
				function f_mac_proverka($mac_address,$s2,$s3,$act,$id)
				{
					$dostupnie_simvoli=array('a', 'b', 'c', 'd', 'e', 'f', 'A', 'B', 'C', 'D', 'E', 'F', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
					$arr_mac=explode(":", $mac_address);
					$mac_string=implode($arr_mac);
					$length=iconv_strlen($mac_string);
					if ($length!=12)
					{
						echo '<meta http-equiv=Refresh content="2; url=index.php?act=2&act2=add13&id='.$id.'">';
						exit ("Некорректный мас адрес!");
					}
					$n=0;
					while($n != 12)
					{
						if (in_array($mac_string{$n}, $dostupnie_simvoli))
						{
							echo "";
						} else {
							echo $ip_string{$n};
							echo '<meta http-equiv=Refresh content="2; url=index.php?act=2&act2=add13&id='.$id.'">';
							exit ("<p>В mac адрес был введен недопустимый символ </p>");
						}
						++$n;
					}
					$rows1c=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_4coun` WHERE `s4`='$mac_address' LIMIT 0,1"));
					if ($rows1c > "0")
					{
						echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'&act2=add13&id='.$id.'&id2='.$mac_address.'&er=1">';
					} else {
						mysql_query("UPDATE bs4_4coun SET `s4`='$mac_address' WHERE `s1`='$id'");
						echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'&act2=add12">';
					}
				}
				f_mac_proverka($s4,$s2,$s3,$act,$id);
			} else if ($act2 == "add15") {
				$res3=mysql_query("SELECT s2 FROM `bs4_2region` WHERE `s1`='$id' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$name=$row3["s2"];
				}
				echo "<form method=POST action=index.php?act=$act&act2=add16&id=$id>";
				echo "Название: ";
				echo "<input type=text name=s2 size=20 value='".$name."' required > ";
				echo "<input type=submit value='Сохранить' name=B1><br>";
				echo "</form><br>";
			} else if ($act2 == "add16") {
				$s2=$_POST["s2"];
				mysql_query("UPDATE bs4_2region SET `s2`='$s2' WHERE `s1`='$id'");
				echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'&act2=add1">';
			} else if ($act2 == "add17") {
				$res3=mysql_query("SELECT s2,s3 FROM `bs4_3gorod` WHERE `s1`='$id' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$id2=$row3["s2"];
					$name=$row3["s3"];
				}
				echo "<form method=POST action=index.php?act=$act&act2=add18&id=$id>";
				echo "Регион<br>";
				echo "<select size=1 name=s2>";
				$res3=mysql_query("SELECT s1,s2 FROM `bs4_2region` ORDER BY s3 ASC");
				while($row3=mysql_fetch_array($res3))
				{
					$s1=$row3["s1"];
					$s2=$row3["s2"];
					if ($s1 == $id2)
					{
						echo "<option selected value='".$s1."'>".$s2."</option>";
					} else {
						echo "<option value='".$s1."'>".$s2."</option>";
					}
				}
				echo "</select><br>";
				echo "Название:<br>";
				echo "<input type=text name=s3 size=20 value='".$name."' required ><br>";
				echo "<input type=submit value='Сохранить' name=B1><br>";
				echo "</form><br>";
			} else if ($act2 == "add18") {
				$s2=$_POST["s2"];
				$s3=$_POST["s3"];
				mysql_query("UPDATE bs4_3gorod SET `s2`='$s2', `s3`='$s3' WHERE `s1`='$id'");
				echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'&act2=add3">';
			} else if ($act2 == "add19") {
				$img[0]="inf0.png";
				$img[1]="inf1.png";
				$res3=mysql_query("SELECT * FROM `devices` WHERE `id`='$id' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$name=$row3["name"];
					$region=$row3["region"];
					$city=$row3["city"];
					$online=$row3["online"];
					$barrier=$row3["barrier"];
					$eeprom=$row3["eeprom"];
					$ip=$row3["ip"];
					$port=$row3["port"];
					$update_interval=$row3["update_interval"];
					$mac_current=$row3["mac_current"];
					$mac_last=$row3["mac_last"];
					$last_seen=$row3["last_seen"];
					$last_check=$row3["last_check"];
					$firmware=$row3["firmware"];
					$enabled=$row3["enabled"];
				}
				$res3=mysql_query("SELECT s2 FROM `bs4_2region` WHERE `s1`='$region' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$name_region=$row3["s2"];
				}
				$res3=mysql_query("SELECT s3 FROM `bs4_3gorod` WHERE `s1`='$city' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$name_city=$row3["s3"];
				}
				echo "Информация по счетчику: <b>".$name." (".$name_region." - ".$name_city.")</b>";
				echo "<br>";
				echo "<br>";
				echo "<a href=index.php?act=2&act2=add7&id=$id class=href1><img src=".$gi."redir.png width=16 border=0> Редактировать</a>";
				echo "&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<a href=index.php?act=1&act2=add1&id=$mac_last class=href1><img src=".$gi."list.png width=16 border=0> Отчет</a>";
				echo "&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<a href=index.php?act=$act&act2=add20&id=$id class=href4><img src=".$gi."delet.png width=16 border=0> Удалить</a>";
				echo "<br>";
				echo "<br>";
				echo '<table border="1" style="border-collapse: collapse" bordercolor="#808080">';
				echo "<tr>";
				echo "<td width=220 align=center><kbd><b>НАЗВАНИЕ</b></kbd></td>";
				echo "<td width=200 align=center><kbd><b>ЗНАЧЕНИЕ</b></kbd></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width=220 align=left><kbd>&nbsp;Онлайн</kbd></td>";
				echo "<td width=200 align=left><kbd>&nbsp;<img src=".$gi."$img[$online] width=16 border=0></kbd></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width=220 align=left><kbd>&nbsp;Барьер</kbd></td>";
				echo "<td width=200 align=left><kbd>&nbsp;<img src=".$gi."$img[$barrier] width=16 border=0></kbd></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width=220 align=left><kbd>&nbsp;Ошибки</kbd></td>";
				echo "<td width=200 align=left><kbd>&nbsp;<img src=".$gi."$img[$eeprom] width=16 border=0></kbd></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width=220 align=left><kbd>&nbsp;IP адрес, Порт</kbd></td>";
				echo "<td width=200 align=left><kbd>&nbsp;".$ip.", ".$port."</kbd></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width=220 align=left><kbd>&nbsp;Обновление</kbd></td>";
				echo "<td width=200 align=left><kbd>&nbsp;".$update_interval."</kbd></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width=220 align=left><kbd>&nbsp;Текущий MAC-адрес</kbd></td>";
				echo "<td width=200 align=left><kbd>&nbsp;".$mac_current."</kbd></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width=220 align=left><kbd>&nbsp;Последний MAC-адрес</kbd></td>";
				echo "<td width=200 align=left><kbd>&nbsp;".$mac_last."</kbd></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width=220 align=left><kbd>&nbsp;Последний удачный опрос</kbd></td>";
				echo "<td width=200 align=left><kbd>&nbsp;".$last_seen."</kbd></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width=220 align=left><kbd>&nbsp;Последняя попытка опроса</kbd></td>";
				echo "<td width=200 align=left><kbd>&nbsp;".$last_check."</kbd></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width=220 align=left><kbd>&nbsp;Прошивка</kbd></td>";
				echo "<td width=200 align=left><kbd>&nbsp;".$firmware."</kbd></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width=220 align=left><kbd>&nbsp;Активность</kbd></td>";
				echo "<td width=200 align=left><kbd>&nbsp;<img src=".$gi."$img[$enabled] width=16 border=0></kbd></td>";
				echo "</tr>";
				echo "</table>";
				echo "<br>";

				
				if ($mac_current != $mac_last)
				{
                    //echo '<pre>';
					echo "<img src=".$gi."$img[0] width=16 border=0>";
					echo " MAC-адрес не совпадает, статистика по этому счётчику отображается не верно!<br>";
                    echo "Необходимо переконфигурировать устройство с новым МАК-адресом $mac_current";
                    //echo '</pre>';
				}

				echo "<br>";
			} else if ($act2 == "add20") {
				$res3=mysql_query("SELECT name,region,city FROM `devices` WHERE `id`='$id' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$name=$row3["name"];
					$region=$row3["region"];
					$city=$row3["city"];
				}
				$res3=mysql_query("SELECT s2 FROM `bs4_2region` WHERE `s1`='$region' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$name_region=$row3["s2"];
				}
				$res3=mysql_query("SELECT s3 FROM `bs4_3gorod` WHERE `s1`='$city' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$name_city=$row3["s3"];
				}
				echo "<div style='text-align: center;'>";
				echo "<h3>Все данные по счетчику<br>".$name." (".$name_region." - ".$name_city.")<br>будут удалены!</h3>";
				echo "<br>";
				echo "<a href=index.php?act=2&act2=add19&id=$id class=href2>Отмена</a>";
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<a href=index.php?act=2&act2=add21&id=$id class=href3>Удалить</a>";
				echo "</div>";
			} else if ($act2 == "add21") {
				$res3=mysql_query("SELECT mac_current,mac_last FROM `devices` WHERE `id`='$id' LIMIT 0,1");
				while($row3=mysql_fetch_array($res3))
				{
					$mac_current=$row3["mac_current"];
					$mac_last=$row3["mac_last"];
				}
				mysql_query("DELETE FROM `devices` WHERE `id`='$id'");
				mysql_query("DELETE FROM `counters` WHERE `ID_Counters`='$mac_current'");
				mysql_query("DELETE FROM `counters` WHERE `ID_Counters`='$mac_last'");
				echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'">';
			} else if ($act2 == "add22") {
				
			} else {
				echo "<a href=index.php?act=$act&act2=add1 class=href1><img src=".$gi."add.png width=14 border=0> Добавить / Редактировать регион</a>&nbsp;";
				$rows01=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_2region` LIMIT 0,1"));
				if ($rows01 == "1")
				{
					echo "<a href=index.php?act=$act&act2=add3 class=href1><img src=".$gi."add.png width=14 border=0> Добавить / Редактировать город</a>&nbsp;";
				}
				$rows01=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_3gorod` LIMIT 0,1"));
				if ($rows01 == "1")
				{
					echo "<a href=index.php?act=$act&act2=add5 class=href1><img src=".$gi."add.png width=14 border=0> Добавить счетчик</a>&nbsp;";
				}
				$kol1c="0";
				if ($kol1c > "0")
				{
//					echo "<a href=index.php?act=$act&act2=add9 class=href4><img src=".$gi."a2.png width=16 border=0> Счетчики не в базе (".$kol1c.")</a>&nbsp;&nbsp;";
				}
//				$rows2c=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_4coun` GROUP BY s4 HAVING count(*) > 1"));
				$rows2c="0";
				if ($rows2c > "0")
				{
//					echo "<a href=index.php?act=$act&act2=add12 class=href4><img src=".$gi."a2.png width=16 border=0> Есть дубликаты</a>&nbsp;&nbsp;";
				}
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
					echo "<td width=120 align=center><kbd><b>IP</b></kbd></td>";
					echo "<td width=120 align=center><kbd><b>MAC</b></kbd></td>";
					echo "</tr>";
					$res3a=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='$s1'");
					while($row3a=mysql_fetch_array($res3a))
					{
						$s1a=$row3a["s1"];
						$s3a=$row3a["s3"];
						$res3b=mysql_query("SELECT * FROM `devices` WHERE `city`='$s1a'");
						while($row3b=mysql_fetch_array($res3b))
						{
							$id=$row3b["id"];
							$s3b=$row3b["name"];
							$s4b=$row3b["mac_last"];
							$ip=$row3b["ip"];
							echo "<tr>";
							echo "<td width=100 align=center><kbd>";
							echo "<a href=index.php?act=$act&act2=add19&id=$id><img src=".$gi."inf.png width=20 title='Информация по счетчику' border=0></a>&nbsp;&nbsp;";
							echo "<a href=index.php?act=$act&act2=add7&id=$id><img src=".$gi."redir.png width=20 title='Редактировать' border=0></a>";
							echo "</kbd></td>";
							echo "<td width=300 align=left><kbd>&nbsp;".$s2." - ".$s3a."</kbd></td>";
							echo "<td width=200 align=left><kbd>&nbsp;".$s3b."</kbd></td>";
							echo "<td width=120 align=left><kbd>&nbsp;".$ip."</kbd></td>";
							echo "<td width=120 align=left><kbd>&nbsp;".$s4b."</kbd></td>";
							echo "</tr>";
						}
					}
					echo "</table>";
					echo "<br>";
					echo "<br>";
				}
			}
		}
		echo "</div>";
?>