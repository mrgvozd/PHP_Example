<?php
session_start();
if(!isset($_SESSION["pready"])) header("Location:index.php?err=3");
?>

<html>
<head><title>Сохранение</title></head>
<body>
	<div style="margin: auto;width: 250px;"> 
		<center>
			<h2><b>Сохранение персонажа</b></h2>
			<form action="arena.php" method="POST">
				<input name="slot" type="radio" value="0">Ячейка 1<br>
				<input name="slot" type="radio" value="1">Ячейка 2<br>
				<input name="slot" type="radio" value="2">Ячейка 3<br>
				<br><input name="s_submit" type="submit" value="Сохранить">
			</form>
		</center>
	</div>
</body>
</html>