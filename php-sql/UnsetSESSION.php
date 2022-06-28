<!DOCTYPE html>
<html>
<body>
<?php
include "connect.php";
session_start();
$_SESSION['id'] = '';
$_SESSION['status'] = '';
echo '<script type = "text/javascript">window.location = "Pagina.php"; </script>';
?>
</body>
</html>
