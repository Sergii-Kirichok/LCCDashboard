<?php
session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;  charset=utf-8">
<title>Выход</title>
</head>
<body>
<?php
mysql_query("UPDATE bs4_1user SET `s7`='0' WHERE `s1`='".$_SESSION['user_id312']."'");
unset($_SESSION["user_id312"]);
print '<meta http-equiv=Refresh content="0; url=index.php">';
?>
</body>
</html>