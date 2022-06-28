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
	$parola = mysqli_real_escape_string($conn, $_POST['CONFIRM']);
	$nume = mysqli_real_escape_string($conn, $_POST['NUME']);
	$intrebare = $_POST['RASPUNSURI'];
	$sql = $conn->prepare("SELECT * FROM useri WHERE RASPUNSURI = ? AND NUME = ?");
    $sql->bind_param('ss',$intrebare,$nume);
	$sql->execute();
	$result = $sql->get_result();
	if($row = $result->fetch_array()) {
	$update = $conn->prepare("UPDATE useri SET PAROLA = ? WHERE NUME = ?");
	$update->bind_param('ss',$parola,$nume);
	$update->execute();
	header("Location:Login.php");
	} else {
		echo "<p class = 'outset'> Raspunsul dat nu corespunde cu cel al user-ului $nume!</p><br>";
		echo " <a href='Register.php'> <p class = 'outset'> Inregistreaza-te!";
	}
}
mysqli_close($conn);
?>
</body>
</html>