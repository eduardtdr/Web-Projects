<!DOCTYPE html>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

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
session_start();

include "connect.php";

if(isset($_SESSION['id']) && isset($_SESSION['status'])) {

echo "<p class = 'outset' style = 'color:#B8860B' align = right>Logged in as: ".$_SESSION['id']."(".$_SESSION['status'].")"."</p>";

?>
<p class = "outset" align = right><a href = "Logout.php" onclick = "return confirm('Daca apesi OK te vei deloga')">Logout</a>

<p class = "outset"style = "color:#B8860B">Cauta item dupa Id/Tip/Model/SN/Factura/Data/Satus/Stare<input id = "myInput" type = "text" placeholder = "Search"></p>
<br><br>
<?php             



$sql = $conn->prepare("SELECT * from tabel1 ORDER BY ID");
$sql->execute();
$result = $sql->get_result();

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
		<td style = "background-color: #FFFFE0"><?php echo $row['TIP']; ?></td>
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
		<td style = "background-color: #FFFFE0"><a href='Tabel1.php'>Edit</a></td>
		<?php } ?>
		</tr>
		</tbody>
		
<?php
	}
echo"</table>";
?>



<h3 style="background-color:yellow">Item nou</h3>


<?php if($_SESSION['status'] == "admin" || $_SESSION['status'] == "user_privilegiat") { ?>
<form action="insert_tabel1.php" method = "POST">
<?php } ?>
	<p class = "outset">TIP :<select name = "tip" id = "tip">
	<option value = 'Monitor'>Monitor</option>
	<option value = 'Laptop'>Laptop</option>
	<option value = 'PC'>PC</option>
	</select>
	
	MODEL : <input type="text" name="MODEL" placeholder="new model" required>
	
	SN : <input type="text" name="SN" placeholder="new sn" required>
	
	FACTURA : <input type="text" name="FACTURA" placeholder="new factura" required>
	
	STARE : <select name = "stare" id = "stare">
	<option value = 'Functional'>Functional</option>
	<option value = 'Defect'>Defect</option>
	</select>
	<input type="submit" name="submit" value="Submit">

	</p>
	</form>

<h3 style="background-color:yellow">Sterge item</h3>

<?php if($_SESSION['status'] == "admin" || $_SESSION['status'] == "user_privilegiat") { ?>
<form action="delete_tabel1.php" method = "POST">
<?php } ?>
	<p class = "outset">ID : <input type="text" name="ID" placeholder="id">
	<input type="submit" name="submit" value="Submit"> </p>
</form>

<?php } else {
echo "<p class = 'outset'>Nu esti conectat, click <a href='ceva.php'> aici.</a></p>";       
}?>

<script type="text/javascript">
  $(function() {
     $( "#search_sn" ).autocomplete({
       source: 'searchbysn.php',
     });
  });
</script>
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
<script>
var _delay = 3000;
function checkLoginStatus() {
	$.get("status.php", function(data) {
		if(!data) {
			window.location = "Logout.php";
		}
		setTimeout(function(){ checkLoginStatus(); }, _delay);
	});
}
checkLoginStatus();
</script>
<br>

<?php
$conn->close();
?>

</body>
</html>