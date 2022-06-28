<!DOCTYPE html>
<html>
<style>

select {
	border: 2px solid yellow;
	border-radius: 20px;
}

body {
	background-image: url("1ac6665aff3e0ba176993b3a6583d2d7.jpg");
	background-position: center;
	background_repeat: no-repeat;
	background-size: cover;
}

h2 {text-shadow: 1px 1px; text-align: center; border-style: outset}
p.outset {font-family: "Lucida Console", "Courier New", monospace;}
div {
	margin-top: 35px;
}
a:link{
	color: yellow;
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

input[type=submit]{
	background-color:yellow;
	border: none;
	text-align: center;
	cursor: crosshair;
	margin: 4px 2px;
}
input[type=text] {
	box-sizing:border-box;
	border: 2px solid yellow;
	border-radius: 19px;
}

input[type=submit]:hover{
	background-color:#FFD700;
	border: 2px solid black;
}
</style>
<body>
<?php

include "connect.php";

$user = isset($_GET['USER']) ? $_GET['USER'] : '';

$query = $conn->prepare("SELECT * FROM tabel3 WHERE USER = ?");
$query->bind_param('s',$user);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_array();

if(isset($_POST['update']))
{
$lname = mysqli_real_escape_string($conn, $_POST['LNAME']);
$fname = mysqli_real_escape_string($conn, $_POST['FNAME']);
$status = mysqli_real_escape_string($conn, $_POST['STATUS']);

$edit = $conn->prepare("update tabel3 set LNAME = ?, FNAME = ?, STATUS =? where USER = ?");
$edit->bind_param('ssss',$lname,$fname,$status,$user);
$edit->execute();

/*
$update = $conn->prepare("DELETE w.* FROM tabel2 as w inner join tabel3 as e on w.user = e.user where e.status = 'neangajat'");
$update->execute();
*/
$update = $conn->prepare("UPDATE tabel2 w inner join tabel3 e on w.user = e.user set w.nume_pc = '&#10071 disponibil' where e.status = 'neangajat'");
$update->execute();

if($edit) {

mysqli_close($conn);
header("location:Tabel3.php");
exit; }

else {
echo mysqli_error();
}
}
?>

<form method="POST">
  <input type="text" name="LNAME" value="<?php echo $row['LNAME'] ?>" placeholder="lname">
  <input type="text" name="FNAME" value="<?php echo $row['FNAME'] ?>" placeholder="fname">
  <select name = "STATUS" id = "STATUS">
	<option value = 'angajat'>Angajat</option>
	<option value = 'neangajat'>Neangajat</option>
</select>
  <input type="submit" name="update" value="Update">
</form>
</body>
</html>