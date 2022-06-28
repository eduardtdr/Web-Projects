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

$sn = isset($_GET['SN']) ? $_GET['SN'] : '';

$query2 = $conn->prepare("SELECT USER FROM tabel3 WHERE status = 'angajat'");
$query2->execute();
$result2 = $query2->get_result();

$result_array_user = array();
while($row  = $result2->fetch_array())
{
	$result_array_user[] = $row['USER'];
}



$query = $conn->prepare("SELECT * FROM tabel2 WHERE SN = ?");
$query->bind_param('s',$sn);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_array();


if(isset($_POST['update']))
{

$nume = mysqli_real_escape_string($conn, $_POST['NUME_PC']);

$so = mysqli_real_escape_string($conn, $_POST['SO']);


$edit = $conn->prepare("update tabel2 set  NUME_PC = ?, SO = ? where SN = ?");
$edit->bind_param('sss',$nume,$so,$sn);
$edit->execute();

if($edit) {

mysqli_close($conn);
header("location:Tabel2.php");
exit; }

else {
echo mysqli_error();
}
}
?>

<form method="POST">
  <input type="text" name="NUME_PC" value='<?php echo $row['NUME_PC']; ?>'placeholder="nume_pc">
<select name ="USER" id = "USER">
 <?php
for($j = 0; $j <count($result_array_user) ; $j = $j + 1) {
?>

<option> <?php echo $result_array_user[$j]; ?></option>
<?php
}
?>
</select>
<?php //if()?>
<select name = "SO" id = "SO">
	<option value = 'Linux'>Linux</option>
	<option value = 'Windows'>Windows</option>
	<option value = '-'>- (Monitor)</option>
</select>
  <input type="submit" name="update" value="Update">
</form>
</body>
</html>