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
input[type=text] {
	box-sizing:border-box;
	border: 2px solid yellow;
	border-radius: 19px;
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

input[type=submit]:hover{
	background-color:#FFD700;
	border: 2px solid black;
}
</style>
<body>
<?php

include "connect.php";

$sn = isset($_GET['SN']) ? $_GET['SN'] : '';
//echo $sn;

$query = $conn->prepare("SELECT * FROM tabel1 WHERE SN = ?");
$query->bind_param('s',$sn);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_array();

if(isset($_POST['update']))
{
$id = mysqli_real_escape_string($conn, $_POST['ID']);
$tip = mysqli_real_escape_string($conn, $_POST['tip']);
$model = mysqli_real_escape_string($conn, $_POST['MODEL']);
$factura = mysqli_real_escape_string($conn, $_POST['FACTURA']);
$data = mysqli_real_escape_string($conn, $_POST['DATA']);
$status = mysqli_real_escape_string($conn, $_POST['STATUS']);
$stare = mysqli_real_escape_string($conn, $_POST['stare']);

$edit = $conn->prepare("update tabel1 set  TIP = ?, MODEL = ?, FACTURA = ?, stare = ? where SN = ?");
$edit->bind_param('ssiss',$tip,$model,$factura,$stare,$sn);
$edit->execute();
if($edit) {

mysqli_close($conn);
header("location:Tabel1.php");
exit; }

else {
echo mysqli_error();
}
}
?>

<form method="POST">
  <input type="text" name="tip" value='<?php echo $row['tip']; ?>'placeholder="tip">
  <input type="text" name="MODEL" value='<?php echo $row['MODEL']; ?>'placeholder="model">
  <input type="text" name="FACTURA" value='<?php echo $row['FACTURA']; ?>'placeholder="factura">
  <select name = "stare" id = "stare">
	<option value = 'Functional'>Functional</option>
	<option value = 'Defect'>Defect</option>
  </select>
  <input type="submit" name="update" value="Update">
</form>
</body>
</html>

