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
select {
	border: 2px solid yellow;
	border-radius: 20px;
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
session_start();
          
include "connect.php";

$sql = mysqli_query($conn, "SELECT * FROM useri ORDER BY ID") or die(mysqli_error($conn));
?>

<h2 style="background-color:yellow">Login</h2>

 <form action = "login_user.php" method = "POST">
       <p class = "outset">UserName  : <input type = "text" name = "NUME" placeholder = "username" required></p>
       <p class = "outset">Password  : <input type = "password" name = "PAROLA" placeholder = "password" id = "index" required>
       <input type = "checkbox" onclick = func()>Show Password</p>
       <p class = "outset"> STATUS :<select name = "PRIVILEGII" id = "status">
	   <option value = 'admin'>Admin</option>
	   <option value = 'user_privilegiat'>User_privilegiat</option>
	   <option value = 'user_neprivilegiat'>User_neprivilegiat(default)</option>
	   </select>
	   <input type = "submit" name = "submit" value = "Submit" style = "margin-left:100px">
 </form>


 
 <script>
function func(){
var x = document.getElementById("index"); 	
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