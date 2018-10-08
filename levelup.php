<?php
session_start();

$tag = '';

if(isset($_POST['u_submit'])){
	if($_SESSION["pexp"]<3) {
		header("Location:arena.php?err=1");
		exit;
	}
	else{
		$_SESSION["plevel"] = $_SESSION["plevel"] + 1;
		$_SESSION["pfreeexp"] = $_SESSION["pexp"];
		$_SESSION["pexp"] = 0;
	}
}
else if(isset($_POST['u_strength'])) {
	$_SESSION["pstrength"] = $_SESSION["pstrength"] + 1;
	$_SESSION["pfreeexp"] = $_SESSION["pfreeexp"] - 1;
	if($_SESSION["pfreeexp"]==0) $tag='disabled';
}
else if(isset($_POST['u_health'])) {
	$_SESSION["phealth"] = $_SESSION["phealth"] + 1;
	$_SESSION["pfreeexp"] = $_SESSION["pfreeexp"] - 1;
	if($_SESSION["pfreeexp"]==0) $tag='disabled';
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
<head>
	<title>Повышение</title>
	<style>
		.txt{
			border: none;
			text-align: center;
			width: 30px;
			font-size: 15px;
		}
	</style>
</head>
<body>
	<div style="margin: auto;width: 250px;text-align: center;"> 
		<h2><b>Повышение уровня</b></h2>
		<div style="margin-bottom: 100px;">
			<div style="margin-bottom: 20px;">
				Свободные очки:
				<input class="txt" value="<?=$_SESSION["pfreeexp"];?>" readonly>
			</div>
			<div>
				<div style="float: left;">
					Сила
					<input class="txt" value="<?=$_SESSION["pstrength"];?>" readonly>
				</div>
				<form method="POST" style="text-align: right;">
					<input <?=$tag?> name="u_strength" type="submit" value="Поднять">
				</form>
			</div>
			<div>
				<div style="float: left;">
					Здоровье
					<input class="txt" value="<?=$_SESSION["phealth"];?>" readonly>
				</div>
				<form method="POST" style="text-align: right;">
					<input <?=$tag?> name="u_health" type="submit" value="Поднять">
				</form>
			</div>
		</div>
		<form action="arena.php" method="POST">
			<input type="submit" value="На Арену">
		</form>
	</div>
</body>
</html>