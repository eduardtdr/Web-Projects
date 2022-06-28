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
    echo "<p class = 'outset' align = right><a href = 'Logout.php' onclick = 'return confirm('Daca apesi OK te vei deloga')'>Logout</a>";

?>

<p class = "outset" style = "color:#B8860B">Cauta item dupa Id/User/LastName/FirstName<input id = "myInput" type = "text" placeholder = "Search"></p>
<br><br>

<?php             


$sql = $conn->prepare("SELECT * from tabel3 ORDER BY ID");
$sql->execute();
$result = $sql->get_result();

echo '<h2 style="background-color:yellow">Tabel3</h2>';

echo "<table border = '1' align = center>
<tr>
<th>ID</th>
<th>User</th>
<th>Last Name</th>
<th>First Name</th>
<th>Status</th>
<th>Edit</th>

</tr>";

$query2 = $conn->prepare("SELECT USER FROM tabel3");
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
		<td style = "background-color: #FFFFE0"><?php echo $row['USER']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['LNAME']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['FNAME']; ?></td>
		<td style = "background-color: #FFFFE0"><?php echo $row['STATUS']; ?></td>
	    <?php if ($_SESSION['status'] == "admin" || $_SESSION['status'] == "user_privilegiat") {?>
		<td style = "background-color: #FFFFE0"><a href='edit_tabel3.php?USER=<?php echo $row["USER"]; ?>'>Edit</a></td>
		<?php } 
		else if ($_SESSION['status'] == "user_neprivilegiat") {?>
		<td style = "background-color: #FFFFE0"><a href='Tabel3.php'>Edit</a></td>
		<?php } ?>
		</tr>
		</tbody>
<?php
	}
      

echo "</table>";

?>

<h3 style="background-color:yellow">User nou</h3>
<?php if($_SESSION['status'] == "admin" || $_SESSION['status'] == "user_privilegiat") { ?>
<form action="insert_tabel3.php" method = "POST">
<?php } ?>
	<p class = "outset">USER : <input type="text" name="USER" placeholder="new user" required>
	LNAME : <input type="text" name="LNAME" placeholder="new last name" required>
	FNAME : <input type="text" name="FNAME" placeholder="new first name" required>
	<input type="submit" name="submit" value="Submit"> </p>
</form>

<h3 style="background-color:yellow">Sterge user</h3>
<?php if($_SESSION['status'] == "admin" || $_SESSION['status'] == "user_privilegiat") {?>
<form action="delete_tabel3.php" method = "POST">
<?php } ?>
	<p class = "outset">ID : <input type="text" name="ID" placeholder="id">
	<input type="submit" name="submit" value="Submit"></p>
</form>


<?php } else {
echo "<p class = 'outset'>Nu esti conectat, click <a href='ceva.php'> aici.</a></p>";       
}?>

  <script type="text/javascript">
  $(function() {
     $( "#search_user3" ).autocomplete({
       source: 'searchbyuser3.php',
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