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
</style>
<body>
<?php
session_start();

include "connect.php";

if(isset($_SESSION['id']) && isset($_SESSION['status'])) {

echo "<p class = 'outset' style = 'color:#B8860B' align = right>Logged in as: ".$_SESSION['id']."(".$_SESSION['status'].")"."</p>";
echo "<p class = 'outset' align = right><a href = 'Logout.php' onclick = closepage();'>Logout</a>";


?>
<h2 style="background-color:yellow">Tabele</h2>

<?php 
if ($_SESSION['status'] == 'admin') {
?>
<p class = "outset"><a href = "Statistica.php" onclick = 'return opendefecte();' title = "Statistica" >&#10071 Statistica</a></p>
<?php } else {}?>

<p class = "outset"><a href = "Tabel1.php" onclick = 'return opentabel1();' title = "Inventar">Tabel1</a></p>

<p class = "outset"><a href = "Tabel2.php" onclick = 'return opentabel2();' title = "Atribuire" >Tabel2</a></p>


<?php } else {
echo "<p class = 'outset'>Nu esti conectat, click <a href='ceva.php'> aici.</a></p>";       
}?>


<script>

var _delay = 3000;
function checkStatus(){
	$.get("status.php", function(data)){
		if(!data){
			window.location = "Logout.php";
		}
		setTimeout(function(){ checkStatus(); }, _delay);
	}
}
checkStatus();

var x;
var y;
var z;
function opentabel1() {
	x = window.open("Tabel1.php");l
}
function opentabel2() {
	y = window.open("Tabel2.php");
}
function opendefecte() {
	z = window.open("Statistica.php");
}
function closepage() {
	x.close();
}
function refreshPage() {
	x.location.href = "Tabel1.php";
}

</script>

</body>
</html>