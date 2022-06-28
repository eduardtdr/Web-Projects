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

	$tip = mysqli_real_escape_string($conn, $_POST['tip']);
	$model = mysqli_real_escape_string($conn, $_POST['MODEL']);
    $sn = mysqli_real_escape_string($conn, $_POST['SN']);
	$factura = mysqli_real_escape_string($conn, $_POST['FACTURA']);
	$stare = mysqli_real_escape_string($conn, $_POST['stare']);
	$sql = $conn->prepare("SELECT * FROM tabel1 WHERE SN = ?");
	$sql->bind_param('s',$sn);
	$sql->execute();
	$result = $sql->get_result();
	if($row = $result->fetch_array()) {
		echo "<p class = 'outset'>Doua item-uri diferite nu pot avea acelasi SN!";
		echo "<br>";
		echo "<a href = 'Tabel1.php'>Revenire la tabel initial";
	}
	else
	{ 
	$insert = $conn->prepare("ALTER TABLE tabel1 AUTO_INCREMENT = 0");
	
	$insert1 = $conn->prepare("INSERT INTO tabel1 (tip, model, sn, factura, stare) 
									VALUES (?, ?, ?, ?, ?)");
	$insert1->bind_param('sssss',$tip,$model,$sn,$factura,$stare);
    $insert->execute();
	$insert1->execute();	
		mysqli_close($conn);
		header("location:Tabel1.php");
		exit;
	}
}

mysqli_close($conn);
?>
</body>
</html>