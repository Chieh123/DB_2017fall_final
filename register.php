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
	<h1>註冊帳號</h1>
	</section>

	<section id="title" align="center">
		填寫完畢請按確認，並重新登入<br>
		注意，本網站英文不區分大小寫<br>
		<form action="#" method="post">
		<table width="250" height="30" align="center">
			<tr>
			<th></th>
			<th></th>
			</tr>
			<tr>
			<th></th>
			<th></th>
			</tr>
			<tr>
			<th><font color="#000000">姓名</th>
			<th><font color="#000000"><input type="text" name="name"/></th>
			</tr>
			<tr>
			<th></th>
			<th></th>
			</tr>	
			<tr>
			<th><font color="#000000">信箱</th>
			<th><font color="#000000"><input type="text" name="eMail"/></th>
			</tr>
			<tr>
			<th></th>
			<th></th>
			</tr>
			<tr>
			<th><font color="#000000">密碼</th>
			<th><font color="#000000"><input type="password" name="pwd1"/></th>
			</tr>
			<tr>
			<th></th>
			<th></th>
			</tr>
			<tr>
			<th><font color="#000000">確認密碼</th>
			<th><font color="#000000"><input type="password" name="pwd2"/></th>
			</tr>
			</table>
			
			<br>			
		
			<input type="submit" name="submit" value="提交" />
			<input type="reset" name="reset" value="清除重寫" >
			</form>
			<?php
				$number = 0;
				if($_POST){
					$name = $_POST['name'];
					$eMail = $_POST['eMail'];
					$pwd1 = $_POST['pwd1'];
					$pwd2 = $_POST['pwd2'];
					if($eMail == ''||$pwd1 =='' || $name ==''){
						echo "請重新填寫，部分欄位未填";
					}elseif($pwd1 != $pwd2){
						echo "密碼並未相符，請重新填寫表格";
					}else{
						$query1 = "select * from`USER` where `eMail` = '$eMail'";
						$result1=mysql_query($query1);
						if($result1){
							$number = mysql_num_rows($result1);
						}
						if($number != 0){
							echo "信箱已經註冊過，請重新填寫表格";
						}else{
							$query2 = "INSERT INTO `USER` (`ID(user)`, `eMail`, `password`,  `name`, `level`) VALUES (NULL, '$eMail', '$pwd1', '$name', '0')";
							$result2=mysql_query($query2);
							if($result2){
								echo "創建成功";
								echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
							}else{
echo "創建失敗<br>";
							}
						}
					}
				}
			?>
		
		

	</section>
	
	
	
	</div>
</body>