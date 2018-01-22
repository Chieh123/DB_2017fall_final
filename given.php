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
	<h1>兌換清單<a href="logout.php">登出</a>  <br><br></h1>
	</section>
<table width="500" align="center">
<tr>
<th><font color="#000000"><a href="member.php">會員中心</a></th>
<th><font color="#000000"><a href="qpon.php">優惠卷相關</a></th>
<th><font color="#000000"><a href="benefit.php">好禮相關相關</a></th>
</tr>
</table><br><br><br>
	<section id="title" align="center">
		<?php
			$userID = $_COOKIE['id_user'];
			$benefit_id = $_POST['given'];
			$date = date("Y-m-d");
			$confirm = 0;
		?>
		<?php
			$query1 = "select * from`USER` where `ID(user)` = $userID";
			$query3 = " select * from `BENEFIT` where `ID(benefit)` = $benefit_id";
			$query4 = " select * from `GIVEN` where `ID(benefit)` = $benefit_id and `ID(user)` = $userID ";
			$result1=mysql_query($query1);
			$result3=mysql_query($query3);
			$result4=mysql_query($query4);
			if($result1 && $result3){
				$row1 = mysql_fetch_array($result1);
				$row3 = mysql_fetch_array($result3);
				$user_level = $row1['level'];
				$benefit_level = $row3['level'];
				$due = $row3['duedate'];
				if($date>strtotime($due)){
					echo "已超過兌換期限";
				}elseif($user_level < $benefit_level){
					echo "資格不符";
				}elseif($result4 && mysql_num_rows($result4) != 0){
					echo "已兌換過";
				}else{
					$query2 = "INSERT INTO `GIVEN` (`ID(given)`, `ID(user)`, `ID(benefit)`, `date`) VALUES (NULL, '$userID', '$benefit_id', '$date')";
					$result2=mysql_query($query2);
					$result4=mysql_query($query4);
					if($result2 && $result4 && mysql_num_rows($result4) == 1){
echo "date = ".$date;
						echo "恭喜兌換成功";
					}else{
						echo "兌換失敗，請重試";
					}
				}
			}else{
				echo "輸入資料有誤，請重新查詢";
			}
		?>				
	</section>
	<section id="form" align="center">
		<table width="500" border="1" align="center">
			<tr>
			<th><font color="#000000">好禮編號</th>
			<th><font color="#000000">好禮內容</th>
			<th><font color="#000000">兌換日期</th>
			</tr>
		<?php
			$sql="select * from `GIVEN` where `ID(user)`= $userID ORDER BY `GIVEN`.`date` DESC";
				$result=mysql_query($sql);
				if($result){
					while ($row = mysql_fetch_array($result)) {
						$given_id = $row['ID(given)'];
						$benefit_id = $row['ID(benefit)'];
						$date = $row['date'];
						$nobuy = 1;
        						echo "<tr>";
        						echo "<td>".$benefit_id."</td>";
        						echo "<td>";
        						$query3 = " select 'content' from `BENEFIT` where `ID(benefit)` = $benefit_id";
        						$result3=mysql_query($query3);
        						if($result3){
        							$content = mysql_fetch_array($result3);
        							echo $content['content'];
        						}
        						echo "</td>";
        						echo "<td>".$date."</td>";
      		  				echo "<td>";
						
					}
				}
		?>
	</table>
		
			

		
<a href="benefit.php">搜尋可以兌換的好禮</a>	

	</section>
	
	
	
	</div>
</body>