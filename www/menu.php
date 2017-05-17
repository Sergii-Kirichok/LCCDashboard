<?php
if ($str != "index.php") exit;

$rows01=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_1user` WHERE `s1`='$id1u' AND `s6`='1' AND `s7`='$id1c' LIMIT 0,1"));

if ($rows01 == "1")
{
	if ($s4u1 == "1")
	{
		echo "<a href=index.php?act=4 style='text-decoration: none;'><div class=menu1 style='text-decoration: none;'>Мониторинг</div></a>";
		echo "<a href=index.php?act=1 style='text-decoration: none;'><div class=menu1 style='text-decoration: none;'>Отчеты</div></a>";
	}
	if ($s4u1 == "2")
	{
		echo "<a href=index.php?act=4 style='text-decoration: none;'><div class=menu1 style='text-decoration: none;'>Мониторинг</div></a>";
		echo "<a href=index.php?act=1 style='text-decoration: none;'><div class=menu1 style='text-decoration: none;'>Отчеты</div></a>";
		echo "<a href=index.php?act=2 style='text-decoration: none;'><div class=menu1 style='text-decoration: none;'>Настройки</div></a>";
	}
	if ($s4u1 == "3")
	{
		echo "<a href=index.php?act=4 style='text-decoration: none;'><div class=menu1 style='text-decoration: none;'>Мониторинг</div></a>";
		echo "<a href=index.php?act=1 style='text-decoration: none;'><div class=menu1 style='text-decoration: none;'>Отчеты</div></a>";
		echo "<a href=index.php?act=2 style='text-decoration: none;'><div class=menu1 style='text-decoration: none;'>Настройки</div></a>";
		echo "<a href=index.php?act=3 style='text-decoration: none;'><div class=menu1 style='text-decoration: none;'>Пользователи</div></a>";
	}

	echo "<a href=exit.php style='text-decoration: none;'><div class=menu1 style='text-decoration: none;'>Выход</div></a>";

	}

?>