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
	<h1>歡迎來到吃喝玩樂在臺北<a href="logout.php">登出</a>  <br><br></h1>
	</section>
	<section id="form" align="center">
<table width="500" align="center">
<tr>
<th><font color="#000000"><a href="member.php">會員中心</a></th>
<th><font color="#000000"><a href="qpon.php">優惠卷相關</a></th>
<th><font color="#000000"><a href="benefit.php">好禮相關相關</a></th>
</tr>
</table><br><br><br>
		<?php
			$userID = $_COOKIE['id_user'];
		?>
			<table width="500" border="1" align="center">
			<tr>
			<th><font color="#000000">e-mail</th>
			<th><font color="#000000">密碼</th>
			<th><font color="#000000">姓名</th>
			<th><font color="#000000">等級</th>
			</tr>
			<?php
				$sql="select * from `USER` where (`ID(user)`='{$userID}')";
				$result=mysql_query($sql);
				$data=mysql_fetch_row($result);
				echo "<tr>";
				echo "<td>".$data[1]."</td>";
				echo "<td>".$data[2]."</td>";
				echo "<td>".$data[3]."</td>";
				echo "<td>".$data[4]."</td>";
				echo "</tr>";

			?>
</table>
	</section>
	
	
	
	</div>
</body>