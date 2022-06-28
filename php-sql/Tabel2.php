
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
if(typeof jQuery == 'undefined') {
	document.write(unescape("%3Cscript src = '/js/jquery-3.4.1.min.js' type ='text/javascript'%3E%3C/script%3E"));
}
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
if(typeof jQuery == 'undefined') {
	document.write(unescape("%3Cscript src = '/js/jquery-1.12.1.min.js' type ='text/javascript'%3E%3C/script%3E"));
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
if(typeof jQuery == 'undefined') {
	document.write(unescape("%3Cscript src = '/js/jquery-3.5.1.min.js' type ='text/javascript'%3E%3C/script%3E"));
}
</script>

<script>
function openpage() {
	x = window.open("Tabe3.php");
}
</script>

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

input[type=text] {
	box-sizing:border-box;
	border: 2px solid yellow;
	border-radius: 19px;
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

<p class = "outset" style = "color:#B8860B">Cauta item dupa Id/Nume_PC/SN/User/SO<input id = "myInput" type = "text" placeholder = "Search"></p>
<br><br>
<?php             



$sql = $conn->prepare("SELECT * FROM tabel2 ORDER BY ID");
$sql->execute();
$result = $sql->get_result();


echo '<h2  style="background-color:yellow">Tabel2</h2>';

echo "<table border = '1' align = 'center'>
<tr>
<th>ID</th>
<th>Nume PC</th>
<th>SN</th>
<th><a href='Tabel3.php'>User</th>
<th>SO</th>
<th>Edit</th>
</tr>";

$query1 = $conn->prepare("SELECT SN FROM tabel1 WHERE status = 'disponibil'");
$query1->execute();
$result1 = $query1->get_result();

$query11 = $conn->prepare("SELECT stare FROM tabel1 WHERE status = 'disponibil'");
$query11->execute();
$result11 = $query11->get_result();

$result_array_sn = array();
while($row  = $result1->fetch_array())
{
	$result_array_sn[] = $row['SN'];
}

$result_array_stare = array();
while($row  = $result11->fetch_array())
{
	$result_array_stare[] = $row['stare'];
}

$query2 = $conn->prepare("SELECT USER FROM tabel3 WHERE status = 'angajat'");
$query2->execute();
$result2 = $query2->get_result();

$result_array_user = array();
while($row  = $result2->fetch_array())
{
	$result_array_user[] = $row['USER'];
}

	while($row = $result->fetch_array()) {  
		?>
		<tbody id = "myTable">
		<tr>
		<td style = "background-color: #FFFFE0"><?php echo $row['ID']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['NUME_PC']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['SN']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['USER']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['SO']; ?></td>
		<?php if ($_SESSION['status'] == "admin" || $_SESSION['status'] == "user_privilegiat") {?>
		<td style = "background-color: #FFFFE0"><a href='edit_tabel2.php?SN=<?php echo $row['SN']; ?>'>Edit</a></td>	
		<?php } ?>
		<?php if ($_SESSION['status'] == "user_neprivilegiat") {?>
		<td style = "background-color: #FFFFE0"><a href='Tabel2.php'>Edit</a></td>
		<?php } ?>
		</tr>
		</tbody>
<?php
	}

echo "</table>";
?>

<h3 style="background-color:yellow">Item nou</h3>
<?php if ($_SESSION['status'] == "admin" || $_SESSION['status'] == "user_privilegiat") {?>
<form action="insert_tabel2.php" method = "POST">
<?php } ?>
    
	<p class = "outset">NUME_PC : <input type="text" name="NUME_PC" placeholder="new nume_pc" required>

	SN :  <select name = "SN" id ="SN">
<?php
for($i = 0; $i <count($result_array_sn) ; $i = $i + 1) {
	if($result_array_stare[$i] == 'defect') {
?>
<option value = "<?php echo $result_array_sn[$i];?>">  <?php echo $result_array_sn[$i]."(".($result_array_stare[$i]).")&#10071"; ?></option>
<?php
	}
	else {
		?>
		<option value = "<?php echo $result_array_sn[$i];?>"> <?php echo $result_array_sn[$i]."(".($result_array_stare[$i]).")"; ?></option>
<?php
	}
}
?>
</select>

	USER :  <select name = "USER" id = "USER">
<?php
for($j = 0; $j <count($result_array_user) ; $j = $j + 1) {
?>
<option value = "<?php echo $result_array_user[$j];?>"> <?php echo $result_array_user[$j]; ?></option>

<?php
}
?>
</select>

	SO : <select name = "SO" type="SO">
	<option value = 'Windows'>Windows</option>
	<option value = 'Linux'>Linux</option>
	<option value = '-'>- (Monitor)</option>
	</select>
	
	<input type="submit" name="submit" value="Submit">
</p>
</form>

<h3 style="background-color:yellow">Sterge item</h3>
<?php if ($_SESSION['status'] == "admin" || $_SESSION['status'] == "user_privilegiat") {?>
<form action="delete_tabel2.php" method = "POST">
<?php } ?>
	<p class = "outset">SN : <input type="text" name="SN" placeholder="sn">
	<input type="submit" name="submit" value="Submit"> </p>
</form>

<?php } else {
echo "<p class = 'outset'>Nu esti conectat, click <a href='ceva.php'> aici.</a></p>";       
}?>

  <script type="text/javascript">
  $(function() {
     $( "#search_user" ).autocomplete({
       source: 'searchbyuser.php',
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
<br>

<?php
$conn->close();
?>

</body>
</html>