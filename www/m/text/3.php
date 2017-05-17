<?php
if ($str != "index.php") exit;

echo "<div class=div1>";
echo "<b>Управление пользователями</b>";
echo "<hr>";
echo "<br>";
if ($s4u1 == "3")
{
	if ($act2 == "add1")
	{
		echo "<form method=POST action=index.php?act=$act&act2=add2>";
		echo "Логин<br>";
		echo "<input type=text name=login size=20 required ><br>";
		echo "Пароль<br>";
		echo "<input type=text name=password size=20 required ><br>";
		echo "Права доступа<br>";
		echo "<select size=1 name=s4>";
		echo "<option selected value='1'>Просмотр отчетов</option>";
		echo "<option value='2'>Управление счетчиками</option>";
		echo "<option value='3'>Главный администратор</option>";
		echo "</select><br>";
		echo "<br>";
		echo "<input type=submit value='Сохранить' name=B1><br>";
		echo "</form><br>";
	} else if ($act2 == "add2") {
		function GenerateSalt($n=3)
		{
			$key = '';
			$pattern = '1234567890abcdefghijklmnopqrstuvwxyz.,*_-=+';
			$counter = strlen($pattern)-1;
			for($i=0; $i<$n; $i++)
			{
				$key .= $pattern{rand(0,$counter)};
			}
			return $key;
		}
		$login = (isset($_POST['login'])) ? mysql_real_escape_string($_POST['login']) : '';
		$password = (isset($_POST['password'])) ? mysql_real_escape_string($_POST['password']) : '';
		$error = false;
		$errort = '';
		if (strlen($login) < 2 && strlen($login) > 15)
		{
			$error = true;
			$errort .= 'Длина логина должна быть не менее 2х символов. Не более 15.<br />';
		}
		if (strlen($password) < 2 && strlen($password) > 32)
		{
			$error = true;
			$errort .= 'Длина пароля должна быть не менее 2 символов. Не более 32.<br />';
		}
		$query = "SELECT `s1`
		FROM `bs4_1user`
		WHERE `s2`='{$login}'
		LIMIT 1";
		$sql = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($sql)==1)
		{
			$error = true;
			$errort .= 'Пользователь с таким логином уже существует в базе данных.<br/><a href=index.php?act=3&act2=add1>Повторить попытку</a>';
		}
		if (!$error)
		{
			$salt = GenerateSalt();
			$hashed_password = md5(md5($password) . $salt);
			$kod2=date('YmdHis');
			$query = "INSERT
			INTO `bs4_1user`
			SET
			`s2`='{$login}',
			`s3`='{$hashed_password}',
			`s4`='".$_POST['s4']."',
			`s5`='{$salt}'";
			$sql = mysql_query($query) or die(mysql_error());
			print '<h4>Пользователь добавлен в БД!</h4>';
			echo '<meta http-equiv=Refresh content="2; url=index.php?act='.$act.'">';
		} else {
			print '<h4>Возникли следующие ошибки</h4>'.$errort;
			echo "<a href=index.php?act=3&act2=add1>Повторить попытку</a>";
		}
	} else if ($act2 == "add3") {
		$res3=mysql_query("SELECT s2,s4 FROM `bs4_1user` WHERE `s1`='$id' LIMIT 0,1");
		while($row3=mysql_fetch_array($res3))
		{
			$s2=$row3["s2"];
			$s4=$row3["s4"];
		}
		if ($s4 == "1")
		{
			$sel1="selected";
		} else if ($s4 == "2") {
			$sel2="selected";
		} else if ($s4 == "3") {
			$sel3="selected";
		}
		echo "<form method=POST action=index.php?act=$act&act2=add4&id=$id>";
		echo "Права доступа пользователя <b>".$s2."</b><br>";
		echo "<select size=1 name=s4>";
		echo "<option $sel1 value='1'>Просмотр отчетов</option>";
		echo "<option $sel2 value='2'>Управление счетчиками</option>";
		echo "<option $sel3 value='3'>Главный администратор</option>";
		echo "</select><br>";
		echo "<br>";
		echo "<input type=submit value='Сохранить' name=B1><br>";
		echo "</form><br>";
	} else if ($act2 == "add4") {
		$s4=$_POST["s4"];
		mysql_query("UPDATE bs4_1user SET `s4`='$s4' WHERE `s1`='$id'");
		echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'">';
	} else if ($act2 == "add5") {
		$res3=mysql_query("SELECT s2 FROM `bs4_1user` WHERE `s1`='$id' LIMIT 0,1");
		while($row3=mysql_fetch_array($res3))
		{
			$s2=$row3["s2"];
		}
		echo "Установка пароля для <b>".$s2."</b><br>";
		echo "<br>";
		echo "<form method=POST action=index.php?act=$act&act2=add6&id=$id>";
		//			echo "Логин<br>";
		//			echo "<input type=text name=login size=20 required ><br>";
		echo "Пароль<br>";
		echo "<input type=text name=password size=20 required ><br>";
		echo "<br>";
		echo "<input type=submit value='Сохранить' name=B1><br>";
		echo "</form><br>";
	} else if ($act2 == "add6") {
		function GenerateSalt($n=3)
		{
			$key = '';
			$pattern = '1234567890abcdefghijklmnopqrstuvwxyz.,*_-=+';
			$counter = strlen($pattern)-1;
			for($i=0; $i<$n; $i++)
			{
				$key .= $pattern{rand(0,$counter)};
			}
			return $key;
		}
		$login = (isset($_POST['login'])) ? mysql_real_escape_string($_POST['login']) : '';
		$password = (isset($_POST['password'])) ? mysql_real_escape_string($_POST['password']) : '';
		$error = false;
		$errort = '';
		if (strlen($login) < 2 && strlen($login) > 15)
		{
			$error = true;
			$errort .= 'Длина логина должна быть не менее 2х символов. Не более 15.<br />';
		}
		if (strlen($password) < 2 && strlen($password) > 32)
		{
			$error = true;
			$errort .= 'Длина пароля должна быть не менее 2 символов. Не более 32.<br />';
		}
		/*
		 $query = "SELECT `s1`
		 FROM `bs4_1user`
		 WHERE `s2`='{$login}'
		 LIMIT 1";
		 $sql = mysql_query($query) or die(mysql_error());
		 if (mysql_num_rows($sql)==1)
		 {
		 $error = true;
		 $errort .= 'Пользователь с таким логином уже существует в базе данных.<br/><a href=index.php?act=3&act2=add1>Повторить попытку</a>';
		 }
		 */
		if (!$error)
		{
			$salt = GenerateSalt();
			$hashed_password = md5(md5($password) . $salt);
			$query = "UPDATE
			`bs4_1user`
			SET
			`s3`='{$hashed_password}',
			`s5`='{$salt}'
			WHERE `s1`='$id'
			";
			$sql = mysql_query($query) or die(mysql_error());
			print '<h4>Пароль изменен!</h4>';
			echo '<meta http-equiv=Refresh content="2; url=index.php?act='.$act.'">';
		} else {
			print '<h4>Возникли следующие ошибки</h4>'.$errort;
			echo "<a href=index.php?act=3&act2=add1>Повторить попытку</a>";
		}
	} else if ($act2 == "locked") {
		$res3 = mysql_query("SELECT s6 FROM `bs4_1user` WHERE `s1`='$id' LIMIT 0,1");
		while($row3 = mysql_fetch_array($res3))
		{
			$s6=$row3["s6"];
		}
		if ($s6 == "1")
		{
			mysql_query("UPDATE bs4_1user SET `s6`='0' WHERE `s1`='$id'");
		} else {
			mysql_query("UPDATE bs4_1user SET `s6`='1' WHERE `s1`='$id'");
		}
		echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'">';
	} else if ($act2 == "delet") {
		$res3=mysql_query("SELECT s2 FROM `bs4_1user` WHERE `s1`='$id' LIMIT 0,1");
		while($row3=mysql_fetch_array($res3))
		{
			$s2=$row3["s2"];
		}
		echo "<h1>Удалить ".$s2."?</h1>";
		echo "<a href=index.php?act=$act&act2=delet2&id=$id class=href3>Удалить</a>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<a href=index.php?act=$act class=href2>Отмена</a>";
	} else if ($act2 == "delet2") {
		mysql_query("DELETE FROM `bs4_1user` WHERE `s1`='$id'");
		echo '<meta http-equiv=Refresh content="0; url=index.php?act='.$act.'">';
	} else {
		echo "<a href=index.php?act=$act&act2=add1 class=href1><img src=".$gi."add.png width=14 title='Добавить пользователя' border=0> Создать пользователя</a>";
		echo "<br>";
		echo "<br>";
		echo '<table border="1" style="border-collapse: collapse" bordercolor="#808080">';
		echo "<tr>";
		echo "<td width=160 align=center><kbd><b>ФУНКЦИИ</b></kbd></td>";
		echo "<td width=200 align=center><kbd><b>ЛОГИН</b></kbd></td>";
		echo "<td width=200 align=center><kbd><b>СТАТУС</b></kbd></td>";
		echo "<td width=110 align=center><kbd><b>АКТИВНОСТЬ</b></kbd></td>";
		echo "</tr>";
		$res3=mysql_query("SELECT * FROM `bs4_1user`");
		while($row3=mysql_fetch_array($res3))
		{
			$id=$row3["s1"];
			$s2=$row3["s2"];
			$s4=$row3["s4"];
			$s6=$row3["s6"];
			if ($s4 == "1")
			{
				$s4="Только отчеты";
			} else if ($s4 == "2") {
				$s4="Управление счетчиками";
			} else if ($s4 == "3") {
				$s4="Главный администратор";
			}
			if ($s6 == "1")
			{
				$s6="<font color=green>Активен</font>";
			} else {
				$s6="<font color=red>Заблокирован</font>";
			}
			echo "<tr>";
			echo "<td width=160 align=center><kbd>";
			echo "<a href=index.php?act=$act&act2=add3&id=$id><img src=".$gi."redir.png width=20 title='Редактировать' border=0></a>&nbsp;";
			echo "<a href=index.php?act=$act&act2=add5&id=$id><img src=".$gi."pas.png width=20 title='Установка пароля' border=0></a>&nbsp;";
			echo "<a href=index.php?act=$act&act2=locked&id=$id><img src=".$gi."locked.png width=20 title='Заблокировать / Разблокировать' border=0></a>&nbsp;";
			echo "<a href=index.php?act=$act&act2=delet&id=$id><img src=".$gi."delet.png width=20 title='Удалить' border=0></a>";
			echo "</kbd></td>";
			echo "<td width=200 align=left><kbd>&nbsp;".$s2."</kbd></td>";
			echo "<td width=200 align=left><kbd>&nbsp;".$s4."</kbd></td>";
			echo "<td width=110 align=left><kbd>&nbsp;".$s6."</kbd></td>";
			echo "</tr>";
		}
	}
	echo "</div>";
}

?>