<!DOCTYPE html>
<html>
<script>
var x;
function closepage() {
	x.close();
}
</script>
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
<body>
<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['status']);
//echo '<script type = "text/javascript">window.location = "ceva.php"; </script>';
header("Location:ceva.php");
?>
</body>
</html>