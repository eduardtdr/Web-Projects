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
h3 {border-style: outset}
p.outset {font-family: "Lucida Console", "Courier New", monospace;}
div {
	margin-top: 35px;
}
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
a:active{
	color: yellow;
}

input[type=text] {
	box-sizing:border-box;
	border: 2px solid yellow;
	border-radius: 19px;
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
</style>

<body>
<?php
include "connect.php";

if(isset($_POST['submit'])) {
	$sn = mysqli_real_escape_string($conn, $_POST['SN']);
	$filter = $conn->prepare("SELECT * FROM tabel1 WHERE SN = ?");
	$filter->bind_param('s',$sn);
	$filter->execute();
	$result = $filter->get_result();
	if(!$filter) {
		echo mysqli_error();
	}
	else {
		
	echo '<h2  style="background-color:yellow">Tabel1</h2>';
	
	echo "<table border = '1' align = center>
<tr>
<th>ID</th>
<th>Tip</th>
<th>Model</th>
<th>SN</th>
<th>Factura</th>
<th>Data</th>
<th>Status</th>
<th>Stare</th>
<th>Edit</th>
</tr>";

	while($row = $result->fetch_array()) {  
		?>
		<tbody id = "myTable">
		<tr>
		<td style = "background-color: #FFFFE0"><?php echo $row['ID']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['tip']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['MODEL']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['SN']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['FACTURA']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['DATA']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['status']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['stare']; ?></td>
		<?php if ($_SESSION['status'] == "admin" || $_SESSION['status'] == "user_privilegiat") {?>
		<td style = "background-color: #FFFFE0"><a href='edit_tabel1.php?SN=<?php echo $row['SN']; ?>'>Edit</a></td>
		<?php } ?>
		<?php if ($_SESSION['status'] == "user_neprivilegiat") {?>
		<td style = "background-color: #FFFFE0"><a href='Filtru1.php'>Edit</a></td>
		<?php } ?>
		</tr>
		<tbody>
		<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php
	}


echo "</table>";
echo "<br>";
echo "<a href = 'Tabel1.php'>Revenire la tabel initial";
	}
}
mysqli_close($conn);
?>
</body>
</html>