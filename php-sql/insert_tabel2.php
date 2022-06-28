<!DOCTYPE html>
<html>
<style>
body {
	background-image: url("1ac6665aff3e0ba176993b3a6583d2d7.jpg");
}
h2 {text-shadow: 1px 1px; text-align: center; border-style: outset}
p.outset {font-family: "Lucida Console", "Courier New", monospace;}
a:link{
	color: #B8860B;
}
a:visited{
	color: blue;
}
a:hover{
	color: red;
}
a:active{
	color: yellow;
}
</style>
<body>
<?php
include "connect.php";

if(isset($_POST['submit'])) {
	$id = mysqli_real_escape_string($conn, $_POST['ID']);
	$nume_pc = mysqli_real_escape_string($conn, $_POST['NUME_PC']);
	$sn = mysqli_real_escape_string($conn, $_POST['SN']);
    $user = mysqli_real_escape_string($conn, $_POST['USER']);	
	$so = mysqli_real_escape_string($conn, $_POST['SO']);
	$insert = $conn->prepare("ALTER TABLE tabel2 AUTO_INCREMENT = 0");
	$insert21 = $conn->prepare("INSERT INTO tabel2 (NUME_PC, SN, USER, SO) VALUES (?,?,?,?)");
	$insert22 = $conn->prepare("UPDATE tabel1 a INNER JOIN tabel2 b ON a.sn = b.sn SET a.status='utilizat'");
	$insert21->bind_param('ssss', $nume_pc, $sn, $user, $so);
	$insert->execute();
	$insert21->execute();
	$insert22->execute();
	if(!$insert) {
		echo mysqli_error();
	}
	else
	{
		mysqli_close($conn);
		header("location:Tabel2.php");
		exit;
	}
}

mysqli_close($conn);
?>
</body>
</html>