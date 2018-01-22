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
	<h1>歡迎來到吃喝玩樂在臺北</h1>
	</section>
	<section id="form" align="center">
		<form action="" method="post">
			帳號: <input type="text" name="account"><br>
			密碼: <input type="password" name="pswd"><br>
		<a href="register.php">註冊會員</a>
		<input type="submit" name="submit" value = "Log in">

		</form>
		
		<?php
			if($_POST){
				$sql="select * from `USER` where (`eMail`='{$_POST['account']}'and `password`='{$_POST['pswd']}')";
				$result=mysql_query($sql);
				if (mysql_num_rows($result)>0){
					$id_user=mysql_fetch_row($result);
					echo "登入成功!!";
					#echo "test userID".$id_user[0];
					$userID = $id_user[0];
					setcookie('id_user',$userID);
					
					echo '<meta http-equiv=REFRESH CONTENT=1;url=member.php>';
				}
				else{
					echo "您的帳號或密碼有誤<br>";

echo "請重新輸入<br>";
				}
			}
		?>


		</p>
		
	</section>
	</div>
</body>