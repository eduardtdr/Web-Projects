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
p.outset {border-style: outset; font-family: "Lucida Console", "Courier New", monospace;}
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
</style>
<body>
<div><h2 class = "outset" style = "background-color:yellow">Welcome</h2></div>

<div><p class = "outset">Ai cont &#8594 <a href="Login.php"><span style="cursor:crosshair">Logheaza-te</a></p></div>

<p class = "outset">Nu ai cont &#8594 <a href="Register.php"><span style="cursor:crosshair">Inregistreaza-te</a></p>

<?php
/*
session_start();
$_SESSION['id'] = 1;
$_SESSION['id1'] = 1;
*/
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['status'])) {
	header("Location:Pagina.php");
}
?>
