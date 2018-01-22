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
	<h1>優惠清單<a href="logout.php">登出</a>  <br><br></h1>
	</section>	
	<section id="form" align="center">
<table width="500" align="center">
<tr>
<th><font color="#000000"><a href="member.php">會員中心</a></th>
<th><font color="#000000"><a href="qpon.php">優惠卷相關</a></th>
<th><font color="#000000"><a href="benefit.php">好禮相關相關</a></th>
</tr>
</table><br><br><br>
			<form action="" method="post">
				單位: <select name="class">
				<option value="1">餐廳</option>
				<option value="0">遊樂場所</option>
				<option value="2" selected >不分類別</option>
				<input type="text" size="35" name="place" value = 單位名稱><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" name="submit" value = "搜尋">
			</form>
			
			<table width="500" border="1" align="center">
			<tr>
			<th><font color="#000000">優惠編號</th>
			<th><font color="#000000">單位類型</th>
			<th><font color="#000000">單位名稱</th>
			<th><font color="#000000">優惠內容</th>
			<th><font color="#000000">單位價格</th>
			</tr>
			<?php
				$qponno = 0;
				$result2 = false;
				$result3 = false;
				if(isset($_POST['submit'])){
					$class = $_POST['class'];
					$place = $_POST['place'];
					if($class == 1){
						if($place != ''){
echo "餐廳優惠卷但限制地點名稱<br>";
							$query1 = " select `ID(restaurant)` as `place_id` from `RESTAURANT`where `name` like '%".$place."%' ";
						}else{
echo "餐廳優惠卷<br>";
							$query1 = " select `ID(restaurant)` as `place_id` from `RESTAURANT` ";
						}
					}elseif($class == 0){
						if($place != ''){
echo "旅遊景點優惠卷但限制地點名稱<br>";
							$query1 = "select `ID(amusementAttraction)` as `place_id` from `AMUSEMENT_ATTRACTION` where `name` like '%".$place."%' ";
						}else{
echo "旅遊景點優惠卷<br>";
							$query1 = "select `ID(amusementAttraction)` as `place_id` from `AMUSEMENT_ATTRACTION`";
						}
					}else{
						if($place != ''){
echo "所有類別優惠卷但限制地點名稱<br>";
							$query1 = "(select `ID(amusementAttraction)` as `place_id` from `AMUSEMENT_ATTRACTION` where `name` like '%".$place."%' ) UNION (select `ID(restaurant)` from `RESTAURANT`where `name` like '%".$place."%')";
						}else{
echo "所有類別優惠卷<br>";
							$query1 = "(select `ID(amusementAttraction)` as `place_id` from `AMUSEMENT_ATTRACTION`  ) UNION (select `ID(restaurant)` from `RESTAURANT` ) ";
						}
					}
				}else{
echo "所有類別優惠卷<br>";
					$query1 = "(select `ID(amusementAttraction)`as `place_id` from `AMUSEMENT_ATTRACTION`  ) UNION (select `ID(restaurant)` from `RESTAURANT`)";
				}
				$result1=mysql_query($query1);
				if($result1){
$i = 0;	
					$noqpon = 0;
					while ($row = mysql_fetch_array($result1)) {
$j = 0;
$i = $i + 1;
echo "<br> place".$i;
						$place_id = $row['place_id'];
						$query2 = "select * from `QPON` where `ID(restaurant||amusementAttraction)` = $place_id";
						$result2=mysql_query($query2);
						if($result2){
echo "相關優惠卷";
$number = mysql_num_rows($result2);
echo " 優惠卷數量 ".$number."<br>";
							if(mysql_num_rows($result2) > 0){
								$noqpon = 1;
							for($j = 1; $j <= mysql_num_rows($result2); $j++){
								$rs=mysql_fetch_array($result2);
     							$qpon_id = $rs['ID(qpon)'];
     							$class = $rs['restaurant||amusementAttraction'];
     							$place_id_1 = $rs['ID(restaurant||amusementAttraction)'];
     							$qpon = $rs['qpon'];
     							$money = $rs['money'];
        							echo "<tr>";
        							echo "<td>".$qpon_id."</td>";
        							echo "<td>";
        							if($class) echo "餐廳";
        							else echo "旅遊景點";
        							echo"</td>";
        							echo "<td>";
        							if($class){
        								$query3="select `name` from `RESTAURANT` where `ID(restaurant)` = $place_id_1";
        							}else{
        								$query3="select `name` from `AMUSEMENT_ATTRACTION` where `ID(amusementAttraction)` = $place_id_1";				
        							}
        							$result3=mysql_query($query3);
								if($result3){
									$place=mysql_fetch_row($result3);
									echo $place[0];
								}
        							echo "</td>";
        							echo "<td>".$qpon."</td>";
      		  					echo "<td>".$money."</td>";
        							echo "</tr>";
    								}
    							}
						}
					}
					if($noqpon == 0){
						echo "現在沒有相關的優惠資訊，請重新搜尋";
					}
				}else{
					echo "查無資料，請重新搜尋";
				}			
			?>
		 </table>
	</section>	
	
	</div>
</body>