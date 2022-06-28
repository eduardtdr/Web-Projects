<!DOCTYPE html>
<html>
<style>
body {
	background-image: url("1ac6665aff3e0ba176993b3a6583d2d7.jpg");
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
}
a:active{
	color: yellow;
}
</style>

<!--<script>/*
function openpage() {
	x = window.open("Tabel1.php");
}
function closepage() {
	x.close();
}
var x;
function openpage() {
	window.open("Pagina.php");
	//x = window.location.assign("Pagina.php");
	//x = window.location.href = "Pagina.php";
}*/
</script>-->

<body>
<?php
session_start();
		 

include "connect.php";

 if($_POST['submit']) {
	 $nume = mysqli_real_escape_string($conn, $_POST['NUME']);
	 $parola = mysqli_real_escape_string($conn, $_POST['PAROLA']);
	 $privilegii = mysqli_real_escape_string($conn, $_POST['PRIVILEGII']);
	 $log = $conn->prepare("SELECT * FROM useri WHERE NUME = ? AND PAROLA = ? AND PRIVILEGII = ?");
	 $log->bind_param('sss',$nume,$parola,$privilegii);
	 $log->execute();
	 $result = $log->get_result();
	 if($row = $result->fetch_array()) {
		 echo "<p class = 'outset'>Inchide tu pagina asta ca eu habar n-am cum...</p>";
		 echo "<p class = 'outset'>Mersi &#128530;</p>";
		 $_SESSION['id'] = $nume;
		 $_SESSION['status'] = $privilegii;
		 /*echo '<script type = "text/javascript">','openpage();';'</script>';
		 header("Location:Pagina.php");
		 echo '<script type = "text/javascript">','openpage();','</script>'; */
	//echo '<script type = "text/javascript">window.location = "Pagina.php"; </script>';
		 } else {		 
		 echo "<p class = 'outset'>Username/parola introduse gresit sau nu ai introdus statusul care ti-a fost atribuit,<a href='Login.php'> mai incearca</a></p><br>";
		 echo "<p class = 'outset'>Nu ai cont? &#8594 <a href='Register.php'> Register</a></p>";
         echo "<p class = 'outset'>Ai uitat parola? &#8594 <a href='Change_password.php'> Schimbare parola</a></p>";
	 }
	 if(isset($_SESSION['id']) && isset($_SESSION['status'])) {
		 header("Location:Pagina.php");
	 }
	
}

?>
</body>
</html>
