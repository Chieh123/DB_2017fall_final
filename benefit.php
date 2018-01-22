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
	<h1>好禮兌換<a href="logout.php">登出</a>  <br><br></h1>
	</section>

<table width="500" align="center">
<tr>
<th><font color="#000000"><a href="member.php">會員中心</a></th>
<th><font color="#000000"><a href="qpon.php">優惠卷相關</a></th>
<th><font color="#000000"><a href="benefit.php">好禮相關相關</a></th>
</tr>
</table><br><br><br>

	<section id="form" align="center">
			<form action="" method="post">
				依等級查詢：上限<input type="text" size="5" name="level_h">下限<input type="text" size="5" name="level_l"><br>
				<label for="duedate">依到期時間查詢：</label><input name =due id="duedate" type="date" min = "<?php date("Y/m/d") ?>" value = "<?php date("Y/m/d") ?>"/><br>
				<input type="submit" name="submit" value = "搜尋">
			</form>
			<table width="500" border="1" align="center">
			<tr>
			<th><font color="#000000">好禮編號</th>
			<th><font color="#000000">好禮內容</th>
			<th><font color="#000000">需要等級</th>
			<th><font color="#000000">截止時間</th>
			<th><font color="#000000">狀態</th>
			</tr>
			<?php
				$benefitno = 0;
				$result2 = false;
				$result3 = false;
				$level_l= '';
				$level_h= '';
				$thatday='';
				if(isset($_POST['submit'])){
					$level_h = $_POST['level_h'];
					$level_l = $_POST['level_l'];
					$thatday = $_POST['due'];
					if($level_h != ''){
echo "等級小於等於 ".$level_h." ";
						if($level_l != ''){
echo "    等級大於等於 ".$level_l." ";
							$query1 = " select * from `BENEFIT` where `level` <= $level_h and `level` >= $level_l";
						}else{
							$query1 = " select * from `BENEFIT` where `level` <= $level_h";							
						}
					}else{
echo "未限制最高等級<br>";
						if($level_l != ''){
echo "    等級小於等於 ".$level_l." ";
							$query1 =  "select * from `BENEFIT` where `level` >= $level_l";
						}else{
echo "未限制最低等級<br>";
							$query1 = " select * from `BENEFIT`";
						}
					}
				}
				if($level_h == '' && $level_l == ''){
					$query1 = "select * from `BENEFIT`";
				}
				if($thatday == ''){
					echo "沒有設定兌換期限，顯示三十天內到期的等級獎勵<br>";
					$thatday = date("Y-m-d",strtotime("+30 day"));
				}
				$result1=mysql_query($query1);
				if($result1){	
					$nobenefit = 0;
					$i = 0;
					while ($row = mysql_fetch_array($result1)) {
						$benefit_id[$i] = $row['ID(benefit)'];
						$level = $row['level'];
						$due = $row['duedate'];
						$benefit = $row['content'];
						if(strtotime($thatday)>strtotime($due)){
							$nobenefit = 1;
        						echo "<tr>";
        						echo "<td>".$benefit_id[$i]."</td>";
        						echo "<td>".$benefit."</td>";
        						echo "<td>".$level."</td>";
        						echo "<td>".$due."</td>";
      		  				echo "<td>";
      		  				$userID = $_COOKIE['id_user'];
      		  				$query2 = "select * from `USER` where `ID(user)` = $userID";
      		  				$result2 = mysql_query($query2);
      		  				if($result2){
      		  					$data = mysql_fetch_array($result2);
      		  					if($level > $data['level'] ){
      		  						echo "資格不符";
      		  					}elseif(strtotime('now')>strtotime($due)){
      		  						echo "已過期";
      		  					}else{
      		  						echo "資格符合";
      		  					}
      		  				}echo "</td>";
        						echo "</tr>";
							$i = $i+1;
    						}
    					}
    				}
				if($nobenefit == 0){
echo "沒有相對應的等級獎勵";
				}			
			?>
		 </table>
		 <form action="given.php" method="post">
			請輸入欲兌換的好禮編號<input type="text" name="given" />
			<input type="submit" name="submit" value="提交" />
		</form>

	</section>
	
	
	</div>
</body>