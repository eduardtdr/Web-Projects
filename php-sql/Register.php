<!DOCTYPE html>
<html>
<style>
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

input[type=text] {
	box-sizing:border-box;
	border: 2px solid yellow;
	border-radius: 19px;
}

input[type=password] {
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


</style>
<body>
<?php             

include "connect.php";

$sql = mysqli_query($conn, "SELECT * FROM useri ORDER BY ID") or die(mysqli_error($conn));

?>

<h2 style="background-color:yellow">Register</h2>

 <form action = "insert_user.php" method = "POST">
        <p class = "outset">UserName  : <input type = "text" name = "NUME" placeholder = "username" required></p>
        <p class = "outset">Password  : <input type = "password" name = "PAROLA" placeholder = "password" id = "index" required> <input type = "checkbox" onclick = "func1()">Show</p>
		<p class = "outset">Confirm Password : <input type = "password" name ="PAROLA2" placeholder = "confirm password" id = "index1" required><input type = "checkbox" onclick = "func2()">Show</p>
		<br>
		<p class = "outset">Sequrity question :</p>
		<select name = "intrebare" id = "intrebare">
		<option value = 'a'>Primul numar de telefon pe care l-ai avut </option>
		<option value = 'b'>Porecla din copilarie </option>
		<option value = 'c'>Numele animalului de companie preferat </option>
		<option value = 'd'>Orasul in care te-ai nascut </option>
		<option value = 'e'>Numele trupei preferate </option>
		<option value = 'f'>Numele liceului pe care l-ai absolvit </option>
		<option value = 'g'>Filmul tau preferat </option>
		<input type = "password" name = "RASPUNSURI" id = "index2" required> <input type = "checkbox" onclick = "func3()">Show</p>
		<input type = "submit" name = "submit" value = "Submit"></p>
 </form>
 
 <script>
function func1(){
var x = document.getElementById("index"); 	
if(x.type === "password") {
	x.type = "text";
} else {
	x.type = "password";
}

}

function func2(){
var x = document.getElementById("index1"); 	
if(x.type === "password") {
	x.type = "text";
} else {
	x.type = "password";
}

}

function func3(){
var x = document.getElementById("index2"); 	
if(x.type === "password") {
	x.type = "text";
} else {
	x.type = "password";
}

}
 </script>
 
<?php
$conn->close();
?>

</body>
</html>