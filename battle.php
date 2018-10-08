<?php
session_set_cookie_params(180000, "/");
session_start();

// unset($_SESSION["pready"]);
$text="";
if(isset($_POST['b_submit'])){
	$e_strength = rand(1,9);
	$e_health = rand(1,9);
	if($_SESSION["pstrength"] > $e_health) {
		$text = "Победа!";
		$_SESSION["pexp"] = $_SESSION["pexp"] + 1;
	}
	else if($e_strength > $_SESSION["phealth"]) {
		$text = "Поражение!";
		$_SESSION["pexp"] = 0;
	}
	else $text = "Ничья";
}
else if(!isset($_SESSION["pready"])){
	header("Location:index.php?err=3");
	exit;
}
else {
	header("Location:arena.php");
	exit;
}
?>
<html>
<head><title>Бой</title></head>
<body>
	<div style="margin: auto;width: 300px;text-align: center;"> 
		<h2><b>БОЙ</b></h2>
		<div style="height: 150px">
			<div style="float:left;">
				<table align="center">
					<tr>
						<td colspan="2" align="center" height="75">Игрок</td>
					</tr>
					<tr>
						<td>Сила:</td>
						<td><?=$_SESSION["pstrength"];?></td>
					</tr>
					<tr>
						<td>Здоровье:</td>
						<td><?=$_SESSION["phealth"];?></td>
					</tr>
				</table>
			</div>
			<div style="float:right;">
				<table align="center">
					<tr>
						<td colspan="2" align="center" height="75">Противник</td>
					</tr>
					<tr>
						<td>Сила:</td>
						<td><?=$e_strength;?></td>
					</tr>
					<tr>
						<td>Здоровье:</td>
						<td><?=$e_health;?></td>
					</tr>
				</table>
			</div>
		</div>
		<h2><b><?=$text?></h2></b>
		<form action="arena.php" method="POST">
			<input type="submit" value="Продолжить">
		</form>
	</div>
</body>
</html>