<?php
session_start();

$_SESSION['a'] = null;
$_SESSION['b'] = null;
unset($_SESSION['id']);

//echo '<script type = "text/javascript">window.location = "ceva.php"; </script>';

header("Location:sessionvariabletest.php");

?>