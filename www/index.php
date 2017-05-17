<?php
session_start();
$str="index.php";
include ('c/sql87.php');
$gi='i/global/'; //global image path

$sql = "SELECT s1 FROM bs4_5update LIMIT 0,1";
$result = @mysql_query($sql);
if (@mysql_num_rows($result) == 0)
{
	mysql_query("
			CREATE TABLE IF NOT EXISTS `bs4_5update` (
			`s1` int(11) NOT NULL AUTO_INCREMENT,
			`s2` text NOT NULL,
			`s3` text NOT NULL,
			`s4` float NOT NULL,
			`s5` float NOT NULL,
			PRIMARY KEY (`s1`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
	");
}

// Обновление
$filename = 'update/';
if (file_exists($filename) === false)
{
	mkdir("update", 0700);
	echo '<meta http-equiv=Refresh content="0; url=index.php">';
} else {
	if ($handle = opendir('update'))
	{
		while (false !== ($file = readdir($handle)))
		{
			if ($file != "." && $file != "..")
			{
				$rows01=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_5update` WHERE `s2`='$file' LIMIT 0,1"));
				if ($rows01 == "0")
				{
					include ("update/$file");
					mysql_query("INSERT INTO `bs4_5update` (s2, s3, s4, s5) VALUES ('$file', '$s3', '$s4', '$s5')");
				}
			}
		}
		closedir($handle);
	}
}

$res3=mysql_query("SELECT s4 FROM `bs4_5update` WHERE `s5`='1' ORDER BY `s4` DESC LIMIT 0,1");

while($row3=mysql_fetch_array($res3))
{
	$s4a=$row3["s4"];
}

$s4a=$s4a + 1;
$res3=mysql_query("SELECT s4 FROM `bs4_5update` WHERE `s5`='0' ORDER BY `s4` DESC LIMIT 0,1");

while($row3=mysql_fetch_array($res3))
{
	$s4b=$row3["s4"];
}

if ($s4a == $s4b)
{
	$up1="1";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>LCC Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="/jq.js"></script>
    <script type="text/javascript" src="/mi.js"></script>
</head>
<body>

<div align="center">

<?php
//Authorirzation check
if (isset($_SESSION['user_id312']))
{
?>
    <div id="hdr" style="width:100%; margin: 0; padding:0; background-image:url(i/global/strip.png); background-repeat:repeat-x; height: 74px; width: 1200px;">
        <div style="background-image: url(i/global/lcc.png); background-repeat:no-repeat; height: 74px; width: 100%;">
            <div style="text-align:right;">
                <!-- <form action="./?action=search" method="get"><input type="hidden" name="action" value="search" /><input type="text" name="q" id="q" value="" /></form> -->
            </div>
        </div>
    </div>
<?php
}
?>

<?php
//Authorirzation check
if (isset($_SESSION['user_id312']))
{
	$id1u=$_SESSION['user_id312'];
	$id1c=$_COOKIE['PHPSESSID'];
	$rows01=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_1user` WHERE `s1`='$id1u' AND `s6`='1' AND `s7`='$id1c' LIMIT 0,1"));

	if ($rows01 == "1")
	{
		$res3=mysql_query("SELECT s4 FROM `bs4_1user` WHERE `s1`='$id1u' LIMIT 0,1");
		while($row3=mysql_fetch_array($res3))
		{
			$s4u1=$row3["s4"];
		}

		if ($_GET["update"] == "1" && $s4u1 == "3")
		{
			$res3=mysql_query("SELECT s2 FROM `bs4_5update` WHERE `s4`='$s4a' LIMIT 0,1");
			while($row3=mysql_fetch_array($res3))
			{
				$s2file=$row3["s2"];
			}
			include ("update/".$s2file);
		} else {
			if ($up1 == "1")
			{
				if ($s4u1 == "3")
				{
					$up1inf="<a href=index.php?update=1 class=href4>Доступно новое обновление! Установить сейчас?</a><br><br>";
				} else {
					$up1inf="<font color=red>Доступно новое обновление! Обратитесь к администратору для его установки</font><br><br>";
				}
			} else {
				if ($_GET["inf"] == "1")
				{
					$up1inf="<font color=green>Обновление установлено!</font><br><br>";
				}
			}
			echo "<table width=1200><tr>";
			echo "<td width=200 align=left valign=top>";
				include ("menu.php");
			echo "</td><td width=1000 align=left valign=top>";
				echo $up1inf;
				include ("text.php");
			echo "</td>";
			echo "</tr></table>";
			echo "</tr></table>";
		}
	} else {
		$rows01=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_1user` WHERE `s1`='$id1u' AND `s7`!='$id1c' LIMIT 0,1"));
		if ($rows01 == "1")
		{
			echo "<h3><font color=red>ОШИБКА 1: Перезагрузите страницу!</font></h3>";
			echo "<a href=exit.php class=href1>ПЕРЕЗАГРУЗИТЬ СТРАНИЦУ!</a>";
		} else {
			echo "<h3><font color=red>ОШИБКА 2: Ваша учетная запись заблокирована. Обратитесь к администратору!</font></h3>";
			echo "<a href=exit.php class=href1>ПЕРЕЗАГРУЗИТЬ СТРАНИЦУ!</a>";
		}
	}
} else {
	if (!empty($_POST[login]))
	{
		$login = (isset($_POST['login'])) ? mysql_real_escape_string($_POST['login']) : '';
		$query = "SELECT `s5`
					FROM `bs4_1user`
					WHERE `s2`='{$login}'
					LIMIT 1";
		$sql = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($sql) == 1)
		{
			$row = mysql_fetch_assoc($sql);
			$salt = $row['s5'];
			$password = md5(md5($_POST['password']) . $salt);
			$query = "SELECT `s1`
						FROM `bs4_1user`
						WHERE `s2`='{$login}' AND `s3`='{$password}'
						LIMIT 1";
			$sql = mysql_query($query) or die(mysql_error());
			if (mysql_num_rows($sql) == 1)
			{
				$row = mysql_fetch_assoc($sql);
				$_SESSION['user_id312'] = $row['s1'];
				mysql_query("UPDATE bs4_1user SET `s7`='".$_COOKIE['PHPSESSID']."' WHERE `s1`='".$_SESSION['user_id312']."'");
				echo '<meta http-equiv=Refresh content="0; url=index.php">';
				exit;
			} else {
				die('Такой логин с паролем не найдены в базе данных. И даём ссылку на повторную авторизацию. — <a href="index.php">Авторизоваться</a>');
			}
		} else {
			die('пользователь с таким логином не найден, даём ссылку на повторную авторизацию. — <a href="index.php">Авторизоваться</a>');
		}
	}
	
	echo "<div class=b1>";
	echo "<img src=".$gi."lcc0.png width=310 title='Редактировать' border=0>";
	echo "<form action=index.php method=post>";
	echo "<table border=0><tr>";
	echo "<td>Логин:</td><td><input type=text name=login required /></td>";
	echo "</tr><tr>";
	echo "<td>Пароль:</td><td><input type=password name=password required /></td>";
	echo "</tr><tr>";
	echo "<td colspan=2 align=center><input type=submit value=Войти class=menu1 style ='text-decoration: none' /></td>";
	echo "</tr></table></form>";
	echo "</div>";
	
	/*
	echo "<div class=b1>";
	echo "<b>Авторизируйтесь:</b><br>";
	echo "<form action=index.php method=post>";
	echo "<table><tr>";
	echo "<td>Логин:</td><td><input type=text name=login /></td>";
	echo "</tr><tr>";
	echo "<td>Пароль:</td><td><input type=password name=password /></td>";
	echo "</tr><tr>";
	echo "<td></td><td><input type=submit value=Войти /></td>";
	echo "</tr></table></form>";
	echo "</div>";
	*/
}
?>
</div>
</body>
</html>