<?php
$text="";
if(isset($_GET['err']))	$err = (int)$_GET['err']; else $err = 0;
if($err == 1) $text = "Неверный параметр силы!";
if($err == 2) $text = "Неверный параметр здоровья!";
if($err == 3) $text = "Персонаж не готов!";
?>
<html>
<head><title>Персонаж</title></head>
<body>
	<div style="margin: auto;width: 150px;"> 
		<center><h2><b>Создание персонажа</h2></b></center>
		<div align="left"> 
			<form action="arena.php" method="POST">
				Имя:
				<br><input name="p_name" style="width: 150px;" autofocus><br>
				Сила:
				<br><input name="p_strength" style="width: 25px;"><br>
				Здоровье:
				<br><input name="p_health" style="width: 25px;"><br>
				<br><input name="p_submit" type="submit" value="Создать">
			</form>
		</div>
		<center><font color="#FF0000"><?=$text;?></font></center>
		<br><br><br><br><br>
		<center>
			<h2><b>Загрузка персонажа</h2></b>
			<form action="load.php" method="POST">
				<input type="submit" value="Загрузить">
			</form>
		</center>
	</div>
</body>
</html>
