<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script src="https://cdn.plot.ly/plotly-2.3.0.min.js"></script>
<meta name="viewport" content="width=device-width, initial scale = 1.0">
<style>
body {
	background-image: url("1ac6665aff3e0ba176993b3a6583d2d7.jpg");
	background-position: center;
	background_repeat: no-repeat;
	background-size: cover;
}

p.outset {font-family: "Lucida Console", "Courier New", monospace;}

div {
	width = 100%;
	height = auto;
}

table{
	border-collapse: separate;
}

th,td {
	text-align: center;
	padding: 8px;
}

tr:nth-child(even){background-color: #FFFFE0}

th {
	background-color : #B8860B;
	color: white;
}
h2 {text-align: center;}

a:link{
	color: #B8860B;
}
a:visited{
	color: blue;
}
a:hover{
	color: red;
	cursor: crosshair;
}
</style>
</head>
<?php
session_start();

include "connect.php";

if(isset($_SESSION['id']) && isset($_SESSION['status'])) {
	

echo "<p class = 'outset' style = 'color:#B8860B' align = right>Logged in as: ".$_SESSION['id']."(".$_SESSION['status'].")"."</p>";

?>
<p class = "outset" align = right><a href = "Logout.php" onclick = "return confirm('Daca apesi OK te vei deloga')">Logout</a>

<h2 style="background-color:yellow">&#10071 &#10071Lista item-uri defecte&#10071 &#10071</h2>
<body>
<?php

$sql = mysqli_query($conn, "SELECT * FROM tabel1 WHERE stare = 'defect' ORDER BY ID") or die(mysqli_error($conn));
 ?>
 
<table border = '1' align = center>
<tr>
<th>ID</th>
<th>Tip</th>
<th>Model</th>
<th>SN</th>
<th>Factura</th>
<th>Data</th>
<th>Status</th>
</tr>

<?php
while($row = mysqli_fetch_array($sql)) {  
		?>
		<tr>
		<td  style = "background-color: #FFFFE0"><?php echo $row['ID']; ?></td>
		<td  style = "background-color: #FFFFE0"><?php echo $row['TIP']; ?></td>
		<td  style = "background-color: #FFFFE0"><?php echo $row['MODEL']; ?></td>
		<td  style = "background-color: #FFFFE0"><?php echo $row['SN']; ?></td>
		<td  style = "background-color: #FFFFE0"><?php echo $row['FACTURA']; ?></td>
		<td  style = "background-color: #FFFFE0"><?php echo $row['DATA']; ?></td>
		<td  style = "background-color: #FFFFE0"><?php echo $row['status']; ?></td>
		</tr>
<?php
}
?>
</table>
<h2 style="background-color:yellow">Statistica inventar</h2>
<?php	
$query1 = $conn->prepare("SELECT tip from tabel1 where tip = 'PC'");
$query1->execute();
$result1 = $query1->get_result();
$pc = 0;
$lap = 0;
$mon = 0;
while($row1 = $result1->fetch_array()){
	$pc++;
}

$query2 = $conn->prepare("SELECT tip from tabel1 where tip = 'Laptop'");
$query2->execute();
$result2 = $query2->get_result();
while($row2 = $result2->fetch_array()){
	$lap++;
}

$query3 = $conn->prepare("SELECT tip from tabel1 where tip = 'Monitor'");
$query3->execute();
$result3 = $query3->get_result();
while($row3 = $result3->fetch_array()){
	$mon++;
}

$result_nume = array();
$result_numar = array();
$result_array_user = array();
$ceva = array();

$query4 = $conn->prepare("SELECT USER from tabel2");
$query4->execute();
$result4 = $query4->get_result();
while($row4 = $result4->fetch_array()) {
	$result_array_user[] = $row4['USER'];
}

$query5 = $conn->prepare("select a.USER from tabel3 a left join tabel2 b on a.USER = b.USER where b.USER is null;");
$query5->execute();
$result5 = $query5->get_result();
while($row5 = $result5->fetch_array()) {
	$result_distinct_user[] = $row5['USER'];
}
$q = 0;
$k = 0;
$j = 1; 
$poz; 
$poz2;
for($i = 0; $i < count($result_array_user) - 1; $i++) {
	if($result_array_user[$i] != $result_array_user[$i+1]) {
		$result_nume[$k] = $result_array_user[$i];
		$result_numar[$k] = $j;
		$j = 1;
		$k++;
		$poz = $i;
		$poz2 = $k;
	} else {
		$j++;
	}
}
$result_nume[$k++] = $result_array_user[count($result_array_user) - 1];

for($j = 0; $j < count($result_distinct_user); $j++) {
	$result_nume[$k] = $result_distinct_user[$j];
	$k++;
}

for($w = 1; $w < count($result_distinct_user); $w++) {
	$result_numar[$poz2 + $w - 1] = 0;
}

$result_numar[count($result_nume) - 2] = 0;
$result_numar[count($result_nume) - 1] = 0;
for($r = 0 ; $r < count($result_numar); $r++) {
	$ceva[$q++] = $result_numar[$r];
}
?>
<div id="myPlot"></div>

<h2 style="background-color:yellow">Statistica item-uri pentru fiecare user</h2>

<div id="mySecondPlot"></div>

<script>
var xArray = ["PC-uri", "Laptop-uri", "Monitoare"];
var pc = "<?php echo "$pc"?>";
var laptop = "<?php echo "$lap"?>";
var monitor = "<?php echo "$mon"?>";
var yArray = [pc, laptop, monitor];
var layout = {title:""};
var data = [{labels:xArray, values:yArray, type:"pie"}];

Plotly.newPlot("myPlot", data, layout);
</script>

<script>

var users = <?php echo json_encode($result_nume);?>;
var items = <?php echo json_encode($result_numar);?>;
var layout = {title:""};
var data = [{labels:users, values:items, type:"pie"}];

Plotly.newPlot("mySecondPlot", data, layout);
</script>

<?php } else {
echo "<p class = 'outset'>Nu esti conectat, click <a href='ceva.php'> aici.</a></p>";
}?>

</body>
</html>