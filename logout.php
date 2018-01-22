<?php
mysql_connect("localhost","root","");
mysql_select_db("123456");
mysql_query("set names utf8");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>吃喝玩樂在臺北</title>
<link href="index.css" rel="stylesheet" media="all">
</head>

<body bgcolor="#FFE5B5">
	<div id="main" valign="center">
	<section id="title" align="center">
	<h1>再見</h1><a href="login.php">重新登入</a>  <br><br></h1>
	<?php setcookie('id_user', "", time()-3600) ?>
	</section>
	</div>
</body>