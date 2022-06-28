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
	
	$user = mysqli_real_escape_string($conn, $_POST['USER']);
	$lname = mysqli_real_escape_string($conn, $_POST['LNAME']);
    $fname = mysqli_real_escape_string($conn, $_POST['FNAME']);	
    $sql = $conn->prepare("SELECT * FROM tabel3 WHERE USER = ?");
	$sql->bind_param('s',$user);
	$sql->execute();
	$result = $sql->get_result();
	$status = 'angajat';
	if($row = $result->fetch_array()) {
		echo "<p class = 'outset'>User-ul este deja existent in tabel!";
		echo "<br>";
		echo "<a href = 'Tabel3.php'>Revenire la tabel initial";
	}
	else {
		$insert = $conn->prepare("ALTER TABLE tabel3 AUTO_INCREMENT = 0");
		$insert3 = $conn->prepare("INSERT INTO tabel3 (USER, LNAME, FNAME, STATUS)
		                           VALUES(?,?,?,?)");
		//$actualizare = $conn->prepare("UPDATE ");
		$insert3->bind_param('ssss',$user,$lname,$fname,$status);
		$insert->execute();
		$insert3->execute();
		mysqli_close($conn);
		header("location:Tabel3.php");
		exit;
	}
	
	
}

mysqli_close($conn);
?>
</body>
</html>