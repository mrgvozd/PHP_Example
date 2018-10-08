<?php
session_set_cookie_params(180000, "/");
session_start();

// unset($_SESSION["pready"]);

function DBConnect(){
	$db_host = '127.0.0.1';
	$db_user = 'root';
	$db_password = '1234';
	$db_database = 'game';
	$link = mysqli_connect($db_host, $db_user, $db_password, $db_database);
	return $link;
}

if(isset($_POST['l_submit'])){
	$link = DBConnect();
	$slot = $_POST['slot'];
	$result = mysqli_query($link,"SELECT * FROM `players` WHERE `slot`=$slot");
	$row = mysqli_fetch_row($result);
	$_SESSION["pname"] =  $row[1];
	$_SESSION["pstrength"] = $row[2];
	$_SESSION["phealth"]  = $row[3];
	$_SESSION["plevel"] = $row[4];
	$_SESSION["pexp"] = $row[5];
	if(!mysqli_error($link)) $_SESSION["pready"] = true;
	else echo mysqli_error($link);
	mysqli_close($link);
}

if(isset($_POST['s_submit'])){
	$slot = $_POST['slot'];
	$link = DBConnect();
	$p_name = $_SESSION["pname"];
	$p_strength = $_SESSION["pstrength"];
	$p_health = $_SESSION["phealth"];
	$p_level = $_SESSION["plevel"];
	$p_exp = $_SESSION["pexp"];
	mysqli_query($link,"REPLACE INTO `players` VALUES ($slot,'$p_name',$p_strength,$p_health,$p_level,$p_exp)");
	if(!mysqli_error($link)) $_SESSION["pready"] = true;
	else echo mysqli_error($link);
	mysqli_close($link);
}

if(isset($_POST['p_submit'])){
	if(!isset($_POST['p_strength']) || !is_numeric($_POST['p_strength']) || $_POST['p_strength']<1 || $_POST['p_strength']>9){
		header("Location:index.php?err=1");
		exit;
	}
	else if(!isset($_POST['p_health']) || !is_numeric($_POST['p_health']) || $_POST['p_health']<0 || $_POST['p_health']>9){
		header("Location:index.php?err=2");
		exit;
	}
	else{
		$_SESSION["pname"] = $_POST['p_name'];
		$_SESSION["pstrength"] = $_POST['p_strength'];
		$_SESSION["phealth"] = $_POST['p_health'];
		$_SESSION["plevel"] = 1;
		$_SESSION["pexp"] = 0;
		$_SESSION["pready"] = true;
	}
}

if(!isset($_SESSION["pready"])) {
	header("Location:index.php?err=3");
	exit;
}

$text="";
if(isset($_GET['err']))	$err = (int)$_GET['err']; else $err = 0;
if($err == 1) $text = "Недостаточно опыта для повышения уровня!";

/* else if (mysqli_num_rows($result) == 1) header("Location:/arena.php");
else header("Location:index.php?err=1"); */

?>
<html>
<head><title>Арена</title></head>
<body>
	<div style="margin: auto;width: 300px;"> 
		<center>
			<h2><b><?=$_SESSION["pname"];?></b></h2>
			<div style="height: 150px;">
				<table align="center">
					<tr>
						<td>Сила:</td>
						<td><?=$_SESSION["pstrength"];?></td>
					</tr>
					<tr>
						<td>Здоровье:</td>
						<td><?=$_SESSION["phealth"];?></td>
					</tr>
					<tr>
						<td>Уровень:</td>
						<td><?=$_SESSION["plevel"];?></td>
					</tr>
					<tr>
						<td>Опыт:</td>
						<td><?=$_SESSION["pexp"];?></td>
					</tr>
				</table>
			</div>
			<div>
				<form action="battle.php" method="POST">
					<input name="b_submit" type="submit" value="В бой!">
				</form>
			</div>
			<div style="margin-bottom: 100px;">
				<form action="levelup.php" method="POST">
					<input name="u_submit" type="submit" value="Повысить уровень">
				</form>
				<font color="#FF0000"><?=$text;?></font>
			</div>
			<h2><b>Сохранение персонажа</h2></b>
			<form action="save.php" method="POST">
				<input type="submit" value="Сохранить">
			</form>
		</center>
	</div>
</body>
</html>