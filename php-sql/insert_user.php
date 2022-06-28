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
	$nume = mysqli_real_escape_string($conn, $_POST['NUME']);
	$parola = mysqli_real_escape_string($conn, $_POST['PAROLA']);
	$intrebare = mysqli_real_escape_string($conn, $_POST['RASPUNSURI']);
	$parola2 = mysqli_real_escape_string($conn, $_POST['PAROLA2']);
	$status = 'user_neprivilegiat';
	if($parola != $parola2) {
		echo"<p class = 'outset'> Parolele nu corespund, <a href='Register.php'> mai incearca</a></p><br>";
	} else {
	$sql = $conn->prepare("SELECT * FROM useri WHERE NUME = ?");
	$sql->bind_param('s',$nume);
	$sql->execute();
	$result = $sql->get_result();
	if($row = $result->fetch_array()) {
	 echo "<p class = 'outset'>Username-ul este deja utilizat,<a href='Register.php'> mai incearca</a></p><br>";
	} else {
		$insert = $conn->prepare("ALTER TABLE useri AUTO_INCREMENT =0");
		$insertu1 = $conn->prepare("INSERT INTO useri (NUME, PAROLA, RASPUNSURI, PAROLA2, PRIVILEGII) VALUES (?, ?, ?, ?, ?)");
		$insertu1->bind_param('sssss',$nume,$parola,$intrebare,$parola2, $status);
		$insert->execute();
		$insertu1->execute();
	header("Location:Login.php");
	}
  }
}
mysqli_close($conn);
?>
</body>
</html>