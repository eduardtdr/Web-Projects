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

<form action = "change_new_password.php" method = "POST">
        <p class = "outset">Confirm UserName : <input type = "text" name = "NUME" placeholder = "username" required></p>
        <p class = "outset">Confirm NewPassword  : <input type = "password" name = "CONFIRM" placeholder = "password" id = "index1" required></p>
		<p class = "container"><input type = "checkbox" onclick = "func()">Show Password</p>
		<br>
		<p class = "outset">Sequrity question
		<p class = "outset">Primul nr de telefon pe care l-ai avut: <input type = "text" name = "RASPUNSURI" required> </p>
        <p><input type = "submit" name = "submit" value = "Submit"></p>
</form>


 <script>
 function func() {
	 var x = document.getElementById("index1");
	 var y = document.getElementById("index2");
	  
	 if(x.type === "password") {
		 x.type = "text";
	 } else {
		 x.type = "password";
	 }
	 
	 if(y.type === "password") {
		 y.type = "text";
	 } else {
		 y.type = "password";
	 }
 }
 </script>
 
 <?php
$conn->close();
?>

</body>
</html>